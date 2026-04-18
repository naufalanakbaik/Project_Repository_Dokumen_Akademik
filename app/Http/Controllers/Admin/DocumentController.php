<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use App\Models\User;
use App\Models\DocumentLog;

class DocumentController extends Controller
{

    // --- List dafar semua dokumen pengguna (status -> aprroved/rejected)
    public function index(Request $request)
    {
        $query = Document::with(['user', 'category'])
            ->whereIn('status', ['approved', 'rejected']);

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Tambahan filter kategori
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $documents = $query->latest()->paginate(5);
        $categories = Category::all();

        return view('admin.documents.index', compact('documents', 'categories'));
    }


    // --- Form tambah dokumen
    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('admin.documents.create', compact('categories', 'users'));
    }


    // --- Proses (store) menyimpan data dokumen ke table database (khusus admin status -> approved)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        $document = Document::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'file' => $filePath,
            'status' => 'approved', // admin langsung approve
        ]);

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'upload',
        ]);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }


    // --- Detail dokumen
    public function show($id)
    {
        $document = Document::with(['user', 'category'])->findOrFail($id);

        return view('admin.documents.show', compact('document'));
    }


    // --- Form edit dokumen
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $categories = Category::all();
        $users = User::all();

        return view('admin.documents.edit', compact('document', 'categories', 'users'));
    }


    // --- Proses memperbarui data dokumen ke table database
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file);

            $filePath = $request->file('file')->store('documents', 'public');
            $document->file = $filePath;
        }

        $document->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }


    // --- Menampilkan halaman VALIDATION (khusus admin) -> Hanya menampilkan dokumen dengan status PENDING
    public function validation(Request $request)
    {
        // Ambil data dokumen + relasi user & category
        // Fokus hanya dokumen yang belum divalidasi (pending)
        $query = Document::with(['user', 'category'])
            ->where('status', 'pending');

        // Fitur pencarian berdasarkan title
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Ambil data terbaru + pagination
        $documents = $query->latest()
            ->paginate(10)
            ->withQueryString(); // agar search tidak hilang saat pindah halaman

        // Tampilkan ke view validation admin
        return view('admin.documents.validation', compact('documents'));
    }


    // --- Update status dokumen (approve / reject) Hanya boleh dilakukan oleh admin
    public function updateStatus(Request $request, $id)
    {
        // Validasi role (lapisan tambahan selain middleware)
        if (auth()->user()->role !== 'admin') {
            abort(403); // Forbidden jika bukan admin
        }

        // Ambil dokumen berdasarkan ID
        $document = Document::findOrFail($id);

        // Validasi input dari form
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Cegah update jika status sama (menghindari query tidak perlu)
        if ($document->status === $request->status) {
            return back()->with('info', 'Status tidak berubah.');
        }

        // Rules penting:
        // Dokumen hanya boleh divalidasi jika masih pending
        // Mencegah: approve ulang, dan manipulasi status
        if ($document->status !== 'pending') {
            return back()->with('error', 'Dokumen sudah divalidasi sebelumnya.');
        }

        // Update status dokumen
        $document->update([
            'status' => $request->status
        ]);

        // Logging aktivitas validasi
        DocumentLog::create([
            'user_id' => auth()->id(), // admin yang melakukan aksi
            'document_id' => $document->id,
            'action' => 'validate_' . $request->status,
            // contoh:
            // validate_approved
            // validate_rejected
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status dokumen berhasil diperbarui.');
    }


    // --- Download dokumen berupa (pdf)
    public function download($id)
    {
        $document = Document::findOrFail($id);

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'download',
        ]);

        return Storage::disk('public')->download($document->file);
    }


    // --- Proses hapus data dokumen dari table database
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::disk('public')->delete($document->file);
        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}

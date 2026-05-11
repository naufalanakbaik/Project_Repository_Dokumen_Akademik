<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use App\Models\User;
use App\Models\DocumentLog;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{

    // ---> List dafar semua dokumen pengguna (status -> aprroved/rejected)
    public function index(Request $request)
    {
        $search = trim($request->search);
        $status = $request->status;
        $categoryId = $request->category_id;

        $documents = Document::query()
            ->with([
                'user:id,name',
                'category:id,name'
            ])

            // Default status yang ditampilkan
            ->whereIn('status', ['approved', 'rejected'])

            // Search title
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })

            // Filter kategori
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })

            // Filter status
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Ambil kategori seperlunya saja
        $categories = Category::select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('admin.documents.index', compact(
            'documents',
            'categories'
        ));
    }

    // ---> Form tambah dokumen
    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('admin.documents.create', compact('categories', 'users'));
    }


    // ---> Proses (store) menyimpan data dokumen ke table database (khusus admin status -> approved)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tahun_terbit' => [
                'required',
                'integer',
                'between:2000,' . date('Y'),
            ],
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        // Upload file
        $filePath = $request->file('file')->store('documents', 'public');

        // Simpan dokumen
        $document = Document::create([
            'title' => $request->title,
            'tahun_terbit' => $request->tahun_terbit,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'file' => $filePath,
            'status' => 'approved',
        ]);

        // Log aktivitas
        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'upload',
        ]);

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }


    // ---> Detail dokumen
    public function show($id)
    {
        $document = Document::with(['user', 'category'])
            ->withCount([
                'logs as downloads_count' => function ($query) {
                    $query->where('action', 'download');
                }
            ])
            ->findOrFail($id);

        return view('admin.documents.show', compact('document'));
    }


    // ---> Menampilkan Form edit dokumen
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $categories = Category::all();
        $users = User::all();

        return view('admin.documents.edit', compact('document', 'categories', 'users'));
    }


    // ---> Proses memperbarui data dokumen ke table database
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'tahun_terbit' => [
                'required',
                'integer',
                'between:2000,' . date('Y'),
            ],
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        // Data update
        $data = [
            'title' => $request->title,
            'tahun_terbit' => $request->tahun_terbit,
            'category_id' => $request->category_id,
        ];

        // Jika upload file baru
        if ($request->hasFile('file')) {

            // Hapus file lama
            if ($document->file && Storage::disk('public')->exists($document->file)) {
                Storage::disk('public')->delete($document->file);
            }

            // Upload file baru
            $data['file'] = $request->file('file')
                ->store('documents', 'public');
        }

        // Update database
        $document->update($data);

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }


    // ---> Proses hapus data dokumen dari table database
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::disk('public')->delete($document->file);
        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }


    // ---> Menampilkan halaman Validation (khusus admin) -> Hanya menampilkan dokumen dengan status PENDING
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
        return view('admin.validation-documents.validation', compact('documents'));
    }


    // ---> Update status dokumen (approve / reject) Hanya boleh dilakukan oleh admin
    public function updateStatus(Request $request, $id)
    {
        // dd($request->method());
        // Validasi role (lapisan tambahan selain middleware)
        if (auth()->user()->role !== 'admin') {
            abort(403); // Forbidden jika bukan admin
        }

        // Ambil dokumen berdasarkan ID
        $document = Document::findOrFail($id);

        // Validasi input dari form
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'reject_note' => 'required_if:status,rejected|nullable|string|max:1000',
        ]);

        // Cegah update jika status sama (menghindari query tidak perlu)
        if ($document->status === $request->status) {
            return back()->with('info', 'Status tidak berubah.');
        }

        // Rules penting:
        // - dokumen hanya boleh divalidasi jika masih pending
        // - mencegah: approve ulang, dan manipulasi status
        if ($document->status !== 'pending') {
            return back()->with('error', 'Dokumen sudah divalidasi sebelumnya.');
        }

        // Update status dokumen
        if ($request->status === 'rejected') {
            $document->update([
                'status' => 'rejected',
                'reject_note' => $request->reject_note,
                'rejected_at' => now(),
                'rejected_by' => auth()->id(),
            ]);
        } else {
            $document->update([
                'status' => 'approved',
                'reject_note' => null,
                'rejected_at' => null,
                'rejected_by' => null,
            ]);
        }

        // Logging aktivitas validasi
        DocumentLog::create([
            'user_id' => auth()->id(), // admin yang melakukan aksi
            'document_id' => $document->id,
            'action' => 'validate_' . $request->status,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status dokumen berhasil diperbarui.');
    }


    // ---> Detail validasi dokumen (halaman review sebelum approve/reject)
    public function showValidation($id)
    {
        // Ambil dokumen beserta relasi user & category
        // eager loading untuk menghindari N+1 query
        $document = Document::with(['user', 'category'])
            ->findOrFail($id);

        /**
         * Proteksi utama: Hanya dokumen dengan status "pending" yang boleh diakses halaman validasi.
         * 
         * Tujuan:
         * - Mencegah admin membuka ulang dokumen yang sudah divalidasi
         * - Menjaga integritas workflow (review → approve/reject hanya sekali)
         */
        if ($document->status !== 'pending') {

            // Redirect ke halaman list validation (bukan route yang salah)
            return redirect()
                ->route('admin.validation-documents.validation')
                ->with('error', 'Dokumen sudah divalidasi sebelumnya.');
        }

        // Tampilkan halaman detail validasi
        return view('admin.validation-documents.show', compact('document'));
    }


    // ---> Download dokumen berupa (pdf)
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


    public function preview($id)
    {
        // Ambil dokumen
        $document = Document::findOrFail($id);

        // Path file
        $path = storage_path('app/public/' . $document->file);

        // Validasi file exists
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Validasi hanya PDF
        if (strtolower(pathinfo($path, PATHINFO_EXTENSION)) !== 'pdf') {
            abort(403, 'Preview hanya tersedia untuk file PDF.');
        }

        // Simpan log aktivitas
        DocumentLog::create([
            'user_id'     => auth()->id(),
            'document_id' => $document->id,
            'action'      => 'preview',
        ]);

        // Tampilkan PDF di browser
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use App\Models\DocumentLog;

class DocumentController extends Controller
{
    // --- List daftar dokumen saya (pribadi)
    public function index(Request $request)
    {
        $query = Document::with('category')
            ->where('user_id', Auth::id());

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $documents = $query->latest()
            ->paginate(5)
            ->withQueryString();

        return view('mahasiswa.documents.index', compact('documents'));
    }


    // --- Daftar dokumen (global mahasiswa)
    public function global(Request $request)
    {
        $query = Document::with(['user', 'category'])
            ->where('status', 'approved'); // WAJIB: hanya approved

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $documents = $query->latest()
            ->paginate(12)
            ->withQueryString();

        return view('mahasiswa.katalog.global', compact('documents'));
    }


    // --- Detail dokumen khusus (seluruh pengguna)
    public function showGlobal($id)
    {
        $document = Document::with(['user', 'category'])
            ->where('status', 'approved')
            ->findOrFail($id);

        return view('mahasiswa.katalog.show-global', compact('document'));
    }


    // --- Form tambah dokumen
    public function create()
    {
        $categories = Category::all();

        return view('mahasiswa.documents.create', compact('categories'));
    }


    // --- Proses (store) menyimpan data dokumen ke table database (default status -> pending)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        $document = Document::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'file' => $filePath,
            'status' => 'pending',
        ]);

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'upload',
        ]);

        return redirect()->route('mahasiswa.documents.index')
            ->with('success', 'Dokumen berhasil diupload dan menunggu validasi.');
    }
    
    // --- Menampikan form edit dokumen
    public function edit($id)
    {
        $document = Document::where('user_id', auth()->id())
            ->findOrFail($id);

        // RULE: approved tidak boleh edit
        if ($document->status === 'approved') {
            return back()->with('error', 'Dokumen yang sudah disetujui tidak dapat diubah.');
        }

        $categories = Category::all();

        return view('mahasiswa.documents.edit', compact('document', 'categories'));
    }

    // --- Proses update data dokumen
    public function update(Request $request, $id)
    {
        $document = Document::where('user_id', auth()->id())
            ->findOrFail($id);

        // RULE 1: approved LOCK TOTAL
        if ($document->status === 'approved') {
            return back()->with('error', 'Dokumen yang sudah disetujui tidak dapat diubah.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'status' => 'pending', // 🔥 reset ke pending setelah edit
            'reject_note' => null,
            'rejected_at' => null,
            'rejected_by' => null,
        ];

        // jika upload file baru
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file);
            $data['file'] = $request->file('file')->store('documents', 'public');
        }

        $document->update($data);

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'update',
        ]);

        return redirect()->route('mahasiswa.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui dan kembali ke status pending.');
    }


    // --- Detail dokumen saya (pribadi)
    public function show($id)
    {
        $document = Document::with(['user', 'category'])->findOrFail($id);

        // SECURITY
        if ($document->status !== 'approved' && $document->user_id !== auth()->id()) {
            abort(403);
        }

        return view('mahasiswa.documents.show', compact('document'));
    }


    // --- Preview / menampilkan (pdf) dokumen
    public function preview($id)
    {
        $document = Document::findOrFail($id);

        if ($document->status !== 'approved' && $document->user_id !== auth()->id()) {
            abort(403);
        }

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'preview',
        ]);

        return response()->file(
            storage_path('app/public/' . $document->file)
        );
    }


    // --- Downlaod dokumen (pdf)
    public function download($id)
    {
        $document = Document::findOrFail($id);

        if ($document->status !== 'approved' && $document->user_id !== auth()->id()) {
            abort(403);
        }

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'download',
        ]);

        return Storage::disk('public')->download($document->file);
    }
}

<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Category;
use App\Models\DocumentLog;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // --- List daftar dokumen saya (pribadi)
    public function index(Request $request)
    {
        $query = Document::with('category')
            ->where('user_id', Auth::id());

        // SEARCH
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // FILTER CATEGORY
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $documents = $query->latest()
            ->paginate(5)
            ->withQueryString();

        // ambil category untuk dropdown
        $categories = Category::all();

        return view('dosen.documents.index', compact('documents', 'categories'));
    }

    // --- Daftar dokumen (seluruh pengguna)
    public function global(Request $request)
    {
        $query = Document::with(['user', 'category']);

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter Category (INI YANG KAMU TAMBAHKAN)
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // RULE WAJIB (SECURITY)
        $query->where(function ($q) {
            $q->where('status', 'approved')
                ->orWhere('user_id', auth()->id());
        });

        $documents = $query->latest()
            ->paginate(9)
            ->withQueryString();

        // Kirim categories ke view
        $categories = Category::all();

        return view('dosen.katalog.global', compact('documents', 'categories'));
    }


    // --- Detail dokumen khusus (seluruh pengguna)
    public function showGlobal($id)
    {
        $document = Document::with(['user', 'category'])->findOrFail($id);

        // RULE GLOBAL
        if ($document->status !== 'approved' && $document->user_id !== auth()->id()) {
            abort(403);
        }

        return view('dosen.katalog.show-global', compact('document'));
    }

    /**
     * Form upload
     */
    public function create()
    {
        $categories = Category::all();

        return view('dosen.documents.create', compact('categories'));
    }

    /**
     * Simpan dokumen (langsung approved)
     */
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
            'status' => 'approved', // 🔥 langsung approved
        ]);

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'upload',
        ]);

        return redirect()->route('dosen.documents.index')
            ->with('success', 'Dokumen berhasil diupload.');
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);

        // SECURITY: hanya pemilik
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('dosen.documents.edit', compact('document', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        // SECURITY
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        // Update file jika ada
        if ($request->hasFile('file')) {

            // Hapus file lama
            if ($document->file && Storage::disk('public')->exists($document->file)) {
                Storage::disk('public')->delete($document->file);
            }

            $filePath = $request->file('file')->store('documents', 'public');
            $document->file = $filePath;
        }

        // Update data
        $document->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            // status tetap approved (jangan diubah)
        ]);

        return redirect()->route('dosen.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Detail dokumen
     */
    public function show($id)
    {
        $document = Document::with(['user', 'category'])->findOrFail($id);

        if ($document->status !== 'approved') {
            abort(403);
        }

        return view('dosen.documents.show', compact('document'));
    }

    /**
     * Preview dokumen
     */
    public function preview($id)
    {
        $document = Document::findOrFail($id);

        if ($document->status !== 'approved') {
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

    /**
     * Download dokumen
     */
    public function download($id)
    {
        $document = Document::findOrFail($id);

        if ($document->status !== 'approved') {
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

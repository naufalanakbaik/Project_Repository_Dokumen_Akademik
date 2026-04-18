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
    /**
     * List dokumen
     * - Hanya lihat approved
     */
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

        return view('dosen.documents.index', compact('documents'));
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
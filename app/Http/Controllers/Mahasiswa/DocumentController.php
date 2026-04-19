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


    // --- Daftar dokumen (seluruh pengguna)
    public function global(Request $request)
    {
        $query = Document::with(['user', 'category']);

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // RULE WAJIB (SECURITY)
        $query->where(function ($q) {
            $q->where('status', 'approved')
                ->orWhere('user_id', auth()->id());
        });

        $documents = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('mahasiswa.katalog.global', compact('documents'));
    }


    // --- Detail dokumen khusus (seluruh pengguna)
    public function showGlobal($id)
    {
        $document = Document::with(['user', 'category'])->findOrFail($id);

        // RULE GLOBAL
        if ($document->status !== 'approved' && $document->user_id !== auth()->id()) {
            abort(403);
        }

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

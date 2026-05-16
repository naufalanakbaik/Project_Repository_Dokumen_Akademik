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
    // --- List daftar dokumen saya (pribadi) dengan AJAX
    public function index(Request $request)
    {
        $query = Document::with('category')
            ->where('user_id', auth()->id());

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $documents = $query->latest()->paginate(10);

        $categories = Category::all();

        // Jika request dari AJAX, render partial view untuk update daftar saja
        if ($request->ajax()) {
            return view('dosen.documents.partials.list', compact('documents'))->render();
        }

        // Jika request biasa, render view penuh
        return view('dosen.documents.index', compact('documents', 'categories'));
    }


    // --- Daftar dokumen global seluruh pengguna
    public function global(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Query Dasar
        |--------------------------------------------------------------------------
        */
        // $query = Document::with(['user', 'category'])
        //     ->where('status', 'approved');
        $query = Document::with([
            'user',
            'category'
        ])
            ->withCount('favoritedBy')
            ->withExists([
                'favoritedBy as is_favorited' => function ($query) {
                    $query->where('user_id', auth()->id());
                }
            ])
            ->where('status', 'approved');

        /*
        |--------------------------------------------------------------------------
        | Search Judul / Nama User
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // Search judul dokumen
                $q->where('title', 'like', '%' . $search . '%')
                    // Search nama user
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filter Category
        |--------------------------------------------------------------------------
        */
        if ($request->filled('category')) {

            $query->where('category_id', $request->category);
        }

        /*
        |--------------------------------------------------------------------------
        | Filter Tahun Terbit
        |--------------------------------------------------------------------------
        */
        if ($request->filled('tahun')) {

            $query->where('tahun_terbit', $request->tahun);
        }

        /*
        |--------------------------------------------------------------------------
        | Data Dokumen
        |--------------------------------------------------------------------------
        */
        $documents = $query->latest()
            ->paginate(12)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Data Category Filter
        |--------------------------------------------------------------------------
        */
        $categories = Category::orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Tahun Filter
        |--------------------------------------------------------------------------
        */
        $years = Document::where('status', 'approved')
            ->whereNotNull('tahun_terbit')
            ->distinct()
            ->orderByDesc('tahun_terbit')
            ->pluck('tahun_terbit');

        // $favorites = auth()->user()
        //     ->favoriteDocuments()
        //     ->pluck('documents.id')
        //     ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */
        return view('dosen.katalog.global', compact(
            'documents',
            'categories',
            'years',
            // 'favorites'
        ));
    }


    // --- Detail dokumen khusus (seluruh pengguna global)
    public function showGlobal($id)
    {
        $document = Document::with(['user', 'category'])->findOrFail($id);

        // Rule global
        if ($document->status !== 'approved' && $document->user_id !== auth()->id()) {
            abort(403);
        }

        return view('dosen.katalog.show-global', compact('document'));
    }


    // -- Form unggah dokumen
    public function create()
    {
        $categories = Category::all();
        return view('dosen.documents.create', compact('categories'));
    }


    // -- Proses simpan dokumen (Dosen -> Approved)
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
        $filePath = $request->file('file')
            ->store('documents', 'public');

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
            ->route('dosen.documents.index')
            ->with('success', 'Dokumen berhasil diupload.');
    }


    // -- Form edit dokumen
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


    // -- Proses perbarui dokumen
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        // SECURITY
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

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

        // Update file jika ada
        if ($request->hasFile('file')) {

            // Hapus file lama
            if (
                $document->file &&
                Storage::disk('public')->exists($document->file)
            ) {
                Storage::disk('public')->delete($document->file);
            }

            // Upload file baru
            $data['file'] = $request->file('file')
                ->store('documents', 'public');
        }

        // Update database
        $document->update($data);

        return redirect()
            ->route('dosen.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }


    // -- Detail dokumen saya
    public function show($id)
    {
        $document = Document::with(['user', 'category'])->findOrFail($id);

        if ($document->status !== 'approved') {
            abort(403);
        }

        return view('dosen.documents.show', compact('document'));
    }


    // -- Preview dokumen
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


    // -- Download dokumen
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


    // -- Tambah dokumen ke favorit
    public function favorite($id)
    {
        auth()->user()
            ->favoriteDocuments()
            ->syncWithoutDetaching([$id]);

        return back()->with(
            'success',
            'Dokumen berhasil ditambahkan ke favorit.'
        );
    }


    // -- Hapus dokumen dari favorit
    public function unfavorite($id)
    {
        auth()->user()
            ->favoriteDocuments()
            ->detach($id);

        return back()->with(
            'success',
            'Dokumen berhasil dihapus dari favorit.'
        );
    }


    // -- Halaman daftar dokumen favorit
    public function favorites()
    {
        $documents = auth()->user()
            ->favoriteDocuments()
            ->with([
                'user',
                'category'
            ])
            ->withCount('favoritedBy')
            ->latest()
            ->paginate(9);

        return view(
            'dosen.katalog.favorites',
            compact('documents')
        );
    }
}

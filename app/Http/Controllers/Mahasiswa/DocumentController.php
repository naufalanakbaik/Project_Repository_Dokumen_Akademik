<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Category;
use App\Models\DocumentLog;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    // --- List daftar dokumen saya (pribadi) dengan AJAX
    public function index(Request $request)
    {
        $query = Document::with('category')
            ->where('user_id', auth()->id());

        // SEARCH
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // CATEGORY
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // STATUS (tambahan dari kamu)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $documents = $query->latest()->paginate(10);
        $categories = Category::all();

        // AJAX RESPONSE
        if ($request->ajax()) {
            return view(
                'mahasiswa.documents.partials.table',
                compact('documents')
            )->render();
        }

        return view('mahasiswa.documents.index', compact(
            'documents',
            'categories'
        ));
    }


    // --- Daftar dokumen global seluruh pengguna
    public function global(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Query Dasar
        |--------------------------------------------------------------------------
        */
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


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */
        return view('mahasiswa.katalog.global', compact(
            'documents',
            'categories',
            'years',
            // 'favorites'
        ));
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

            'tahun_terbit' => [
                'required',
                'integer',
                'between:2000,' . date('Y'),
            ],

            'category_id' => 'required|exists:categories,id',

            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        DB::beginTransaction();

        try {

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

                // default workflow mahasiswa
                'status' => 'pending',

                // reset rejection state
                'reject_note' => null,
                'rejected_at' => null,
                'rejected_by' => null,
            ]);

            // Simpan log aktivitas
            DocumentLog::create([
                'user_id' => auth()->id(),
                'document_id' => $document->id,
                'action' => 'upload',
            ]);

            DB::commit();

            return redirect()
                ->route('mahasiswa.documents.index')
                ->with(
                    'success',
                    'Dokumen berhasil diupload dan menunggu validasi.'
                );
        } catch (\Exception $e) {

            DB::rollBack();

            // Hapus file jika database gagal
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan saat mengupload dokumen.'
                );
        }
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

        // RULE: approved tidak boleh diedit
        if ($document->status === 'approved') {
            return back()->with(
                'error',
                'Dokumen yang sudah disetujui tidak dapat diubah.'
            );
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

            // Reset approval
            'status' => 'pending',
            'reject_note' => null,
            'rejected_at' => null,
            'rejected_by' => null,
        ];

        // Upload file baru
        if ($request->hasFile('file')) {

            // Hapus file lama jika ada
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

        // Log aktivitas
        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'update',
        ]);

        return redirect()
            ->route('mahasiswa.documents.index')
            ->with(
                'success',
                'Dokumen berhasil diperbarui dan kembali ke status pending.'
            );
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

<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Category;
use App\Models\User;
use App\Models\DocumentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Menampilkan daftar dokumen berdasarkan role dan filter.
     */
    public function index(Request $request)
    {
        $query = Document::with(['user', 'category']);

        // Filter berdasarkan pencarian judul
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Mahasiswa hanya melihat dokumen yang sudah disetujui, ATAU miliknya sendiri
        if (auth()->user()->role === 'mahasiswa') {
            $query->where(function ($q) {
                $q->where('status', 'approved')
                    ->orWhere('user_id', auth()->id());
            });
        }

        // Admin dan Kaprodi bisa melihat semua (biasanya)
        // Dosen bisa melihat semua dokumen mahasiswa (approved) dan sesama dosen
        if (auth()->user()->role === 'dosen') {
            $query->where('status', 'approved');
        }

        $documents = $query->latest()->paginate(10);
        $categories = Category::all();

        // Tentukan view berdasarkan role
        $view = 'mahasiswa.documents.index';
        if (auth()->user()->role === 'admin') $view = 'admin.documents.index';
        if (auth()->user()->role === 'dosen') $view = 'dosen.documents.index';
        if (auth()->user()->role === 'kaprodi') $view = 'kaprodi.documents.index';

        return view($view, compact('documents', 'categories'));
    }

    /**
     * Menampilkan form untuk mengunggah dokumen baru.
     */
    public function create()
    {
        $categories = Category::all();

        // Tentukan view berdasarkan role
        $view = 'mahasiswa.documents.create';
        if (auth()->user()->role === 'dosen') $view = 'dosen.documents.create';

        return view($view, compact('categories'));
    }

    /**
     * Menyimpan dokumen baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        // 2. Upolad file
        $filePath = $request->file('file')->store('documents', 'public');

        // 3. Simpan data
        $document = auth()->user()->documents()->create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'file' => $filePath,
            'status' => 'pending',
        ]);

        // 4. Log aktivitas
        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'upload',
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah dan sedang menunggu validasi.');
    }

    /**
     * Validasi dokumen (Approve/Reject) oleh Admin.
     */
    public function updateStatus(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $document->update(['status' => $request->status]);

        // Catat di log
        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => $request->status,
        ]);

        return back()->with('success', 'Status dokumen berhasil diperbarui.');
    }

    /**
     * Preview file (pdf) dokumen.
     */
    public function preview($id)
    {
        $document = Document::findOrFail($id);

        // (Opsional tapi penting) Validasi akses berdasarkan role
        if (auth()->user()->role === 'mahasiswa') {
            if ($document->status !== 'approved' && $document->user_id !== auth()->id()) {
                abort(403);
            }
        }

        if (auth()->user()->role === 'dosen') {
            if ($document->status !== 'approved') {
                abort(403);
            }
        }

        // Catat aktivitas preview
        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'preview',
        ]);

        // Ambil path file
        $path = storage_path('app/public/' . $document->file);

        // Return file (preview di browser)
        return response()->file($path);
    }

    /**
     * Mengunduh file dokumen.
     */
    public function download($id)
    {
        $document = Document::findOrFail($id);

        // Catat aktivitas unduh
        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'download',
        ]);

        return Storage::disk('public')->download($document->file);
    }
}

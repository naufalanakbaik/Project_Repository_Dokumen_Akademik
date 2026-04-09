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
        // 1. VALIDASI
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        // 2. UPLOAD FILE
        $filePath = $request->file('file')->store('documents', 'public');

        // 3. SIMPAN DATA (FIXED)
        $document = auth()->user()->documents()->create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'file' => $filePath, // ✅ SESUAI DATABASE
            'status' => 'pending',
        ]);

        // 4. LOG
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

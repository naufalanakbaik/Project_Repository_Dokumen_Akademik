<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * List semua dokumen (monitoring)
     */
    public function index(Request $request)
    {
        $query = Document::with(['user', 'category']);

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 🔥 Kaprodi lihat SEMUA (termasuk pending & rejected)
        $documents = $query->latest()->paginate(10);

        return view('kaprodi.documents.index', compact('documents'));
    }

    /**
     * Preview dokumen
     */
    public function preview($id)
    {
        $document = Document::findOrFail($id);

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

        DocumentLog::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
            'action' => 'download',
        ]);

        return Storage::disk('public')->download($document->file);
    }

}
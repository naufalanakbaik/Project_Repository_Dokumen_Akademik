<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;

use App\Models\Document;
use App\Models\Category;
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

        return view('kaprodi.documents.index', compact(
            'documents',
            'categories'
        ));
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

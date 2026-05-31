<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Daftar kategori + search + pagination
     */
    public function index(Request $request)
    {
        $query = Category::query()
            ->withCount('documents');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $totalDocuments = Document::count();

        return view('kaprodi.categories.index', compact(
            'categories',
            'totalDocuments'
        ));
    }

    /**
     * Detail kategori + dokumen terkait + statistik
     */
    public function show($id)
    {
        $category = Category::withCount('documents')->findOrFail($id);

        $documents = Document::where('category_id', $category->id)
            ->with('user:id,name')
            ->latest()
            ->paginate(10);

        $statusCounts = Document::where('category_id', $category->id)
            ->selectRaw("status, count(*) as total")
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('kaprodi.categories.show', compact(
            'category',
            'documents',
            'statusCounts'
        ));
    }
}

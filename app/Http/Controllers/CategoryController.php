<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // ---> List kategori + search + total dokumen
    public function index(Request $request)
    {
        $search = trim($request->search);

        $categories = Category::query()
            ->select('id', 'name', 'created_at')

            // Hitung total dokumen tanpa N+1 query
            ->withCount('documents')

            // Search kategori
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })

            ->latest()
            ->paginate(10) // Pagination
            ->withQueryString(); // Agar query search tetap ada saat pagination

        return view('admin.categories.index', compact('categories'));
    }

    // ---> Form tambah kategori
    public function create()
    {
        return view('admin.categories.create');
    }

    // ---> Simpan kategori
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        $validated['name'] = trim($validated['name']);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    // ---> Form edit kategori
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // ---> Update kategori
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $validated['name'] = trim($validated['name']);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    // ---> Detail kategori
    public function show(Category $category)
    {
        // Hitung total dokumen kategori
        $category->loadCount('documents');

        return view('admin.categories.show', compact('category'));
    }

    // ---> Hapus kategori
    public function destroy(Category $category)
    {
        // Cegah hapus kategori yang masih digunakan
        if ($category->documents()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan dokumen.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    // ---> Landing page utama menampilkan dokumen terbaru dan statistik
    public function index()
    {
        $documents = Document::with(['user', 'category'])
            ->where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'documents' => Document::where('status', 'approved')->count(),
            'categories' => Category::count(),
            'users' => User::count(),
        ];

        return view('landing.index', compact(
            'documents',
            'stats'
        ));
    }


    // --->  Menampilkan daftar dokumen publik dengan fitur pencarian dan filter
    public function repository(Request $request)
    {
        $query = Document::with(['user', 'category'])
            ->where('status', 'approved');

        // Search publik
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhereHas('category', function ($category) use ($request) {
                        $category->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $documents = $query->latest()->paginate(12);

        return view('landing.repository', compact('documents'));
    }


    // ---> Menampilkan detail dokumen publik
    public function show($id)
    {
        $document = Document::with(['user', 'category'])
            ->where('status', 'approved')
            ->findOrFail($id);

        return view('landing.show', compact('document'));
    }
}
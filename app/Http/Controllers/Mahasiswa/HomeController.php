<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Document;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Statistik
        $stats = [
            'documents' => Document::where('status', 'approved')->count(),
            'categories' => Category::count(),
            'users' => User::count(),
        ];

        // Dokumen terbaru
        $documents = Document::with(['user', 'category'])
            ->where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        return view('mahasiswa.home.index', compact(
            'stats',
            'documents'
        ));
    }
}
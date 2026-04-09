<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\DocumentLog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard statistik.
     */
    public function index()
    {
        // Statistik Dasar
        $stats = [
            'total_documents' => Document::count(),
            'total_users' => User::count(),
            'total_uploads' => DocumentLog::where('action', 'upload')->count(),
            'total_downloads' => DocumentLog::where('action', 'download')->count(),
        ];

        // Distribusi dokumen berdasarkan kategori
        $categoryDistribution = Category::withCount('documents')->get();

        // Aktivitas terbaru (Log)
        $recentActivities = DocumentLog::with(['user', 'document'])
            ->latest()
            ->limit(10)
            ->get();

        // Tentukan view berdasarkan role
        $role = auth()->user()->role;
        $view = "{$role}.dashboard.index";

        // Mahasiswa mungkin punya dashboard sederhana
        if ($role === 'mahasiswa') {
            $stats['my_documents'] = Document::where('user_id', auth()->id())->count();
            $stats['approved'] = Document::where('user_id', auth()->id())->where('status', 'approved')->count();
        }

        return view($view, compact('stats', 'categoryDistribution', 'recentActivities'));
    }
}

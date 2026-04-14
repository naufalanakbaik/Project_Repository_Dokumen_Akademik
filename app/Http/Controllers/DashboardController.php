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
    // public function index()
    // {
    //     // Statistik Dasar
    //     $stats = [
    //         'total_documents' => Document::count(),
    //         'total_users' => User::count(),
    //         'total_uploads' => DocumentLog::where('action', 'upload')->count(),
    //         'total_downloads' => DocumentLog::where('action', 'download')->count(),
    //     ];

    //     // Distribusi dokumen berdasarkan kategori
    //     $categoryDistribution = Category::withCount('documents')->get();

    //     // Aktivitas terbaru (Log)
    //     $recentActivities = DocumentLog::with(['user', 'document'])
    //         ->latest()
    //         ->limit(10)
    //         ->get();

    //     // Tentukan view berdasarkan role
    //     $role = auth()->user()->role;
    //     $view = "{$role}.dashboard.index";

    //     // Mahasiswa mungkin punya dashboard sederhana
    //     if ($role === 'mahasiswa') {
    //         $stats['my_documents'] = Document::where('user_id', auth()->id())->count();
    //         $stats['approved'] = Document::where('user_id', auth()->id())->where('status', 'approved')->count();
    //     }

    //     return view($view, compact('stats', 'categoryDistribution', 'recentActivities'));
    // }

    public function index()
    {
        $user = auth()->user();

        // ======================
        // Statistik Global
        // ======================
        $stats = [
            'total_documents'   => Document::count(),
            'total_users'       => User::count(),
            'total_uploads'     => DocumentLog::where('action', 'upload')->count(),
            'total_downloads'   => DocumentLog::where('action', 'download')->count(),
        ];

        // ======================
        // Khusus Mahasiswa
        // ======================
        if ($user->role === 'mahasiswa') {
            $stats['my_documents'] = Document::where('user_id', $user->id)->count();
            $stats['approved']     = Document::where('user_id', $user->id)
                ->where('status', 'approved')
                ->count();
        }

        // ======================
        // Distribusi Kategori
        // ======================
        $categoryDistribution = Category::withCount('documents')
            ->orderByDesc('documents_count')
            ->get();

        // ======================
        // Aktivitas Terbaru
        // ======================
        $recentActivities = DocumentLog::with(['user', 'document'])
            ->latest()
            ->limit(10)
            ->get();

        // ======================
        // View berdasarkan role
        // ======================
        if ($user->role === 'admin') {
            return view('admin.dashboard.index', compact(
                'stats',
                'categoryDistribution',
                'recentActivities'
            ));
        }

        if ($user->role === 'dosen') {
            return view('dosen.dashboard.index', compact(
                'stats',
                'categoryDistribution',
                'recentActivities'
            ));
        }

        if ($user->role === 'mahasiswa') {
            return view('mahasiswa.dashboard.index', compact(
                'stats',
                'categoryDistribution',
                'recentActivities'
            ));
        }

        abort(403); // fallback keamanan
    }

    public function monitoringPengguna()
    {
        // ======================
        // Statistik User
        // ======================
        $userStats = [
            'total_users'   => User::count(),
            'admin'         => User::where('role', 'admin')->count(),
            'kaprodi'     => User::where('role', 'kaprodi')->count(),
            'dosen'         => User::where('role', 'dosen')->count(),
            'mahasiswa'     => User::where('role', 'mahasiswa')->count(),
        ];

        // ======================
        // Data User (untuk tabel)
        // ======================
        $users = User::latest()
            ->select('id', 'name', 'email', 'role', 'created_at')
            ->get();

        // ======================
        // Aktivitas User Terbaru
        // ======================
        $userActivities = DocumentLog::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard.monitoring-pengguna', compact(
            'users',
            'userStats',
            'userActivities'
        ));
    }
}

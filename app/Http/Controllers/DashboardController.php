<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\DocumentLog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use App\Models\Category;
// use App\Models\Document;
// use App\Models\DocumentLog;
// use App\Models\User;
// use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

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

    /**
     * Menampilkan dashboard statistik.
     */
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
            $stats['approved'] = Document::where('user_id', $user->id)
                ->where('status', 'approved')
                ->count();
        }

        // ======================
        // Distribusi Kategori Umum
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

        // =====================================================
        // DATA KHUSUS ADMIN UNTUK CHART.JS
        // =====================================================
        // Tahun sekarang dan tahun sebelumnya
        $currentYear = Carbon::now()->year;
        $lastYear = $currentYear - 1;

        // -----------------------------------------------------
        // 1. Upload Dokumen per Bulan (Tahun Ini vs Tahun Lalu)
        // -----------------------------------------------------
        $uploadsThisYear = Document::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month');

        $uploadsLastYear = Document::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', $lastYear)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Pastikan selalu ada 12 bulan agar chart tidak rusak
        $monthlyUploads = [
            'this_year' => [],
            'last_year' => [],
        ];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyUploads['this_year'][] = $uploadsThisYear[$i] ?? 0;
            $monthlyUploads['last_year'][] = $uploadsLastYear[$i] ?? 0;
        }

        // -----------------------------------------------------
        // 2. Status Dokumen (Approved, Pending, Rejected, Archived)
        // -----------------------------------------------------

        // Gunakan array default agar urutan selalu konsisten
        $documentStatus = [
            'approved' => 0,
            'pending' => 0,
            'rejected' => 0,
            // 'archived' => 0,
        ];

        $statusResult = Document::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        foreach ($statusResult as $status => $total) {
            if (array_key_exists($status, $documentStatus)) {
                $documentStatus[$status] = $total;
            }
        }

        // -----------------------------------------------------
        // 3. Distribusi Dokumen per Kategori
        // -----------------------------------------------------
        $categoryChart = Category::withCount('documents')
            ->orderByDesc('documents_count')
            ->pluck('documents_count', 'name');

        // -----------------------------------------------------
        // 4. Tren Download per Bulan
        // -----------------------------------------------------
        $downloadResult = DocumentLog::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->where('action', 'download')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyDownloads = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyDownloads[] = $downloadResult[$i] ?? 0;
        }

        // ======================
        // View berdasarkan role
        // ======================
        if ($user->role === 'admin') {
            return view('admin.dashboard.index', compact(
                'stats',
                'categoryDistribution',
                'recentActivities',
                'monthlyUploads',
                'documentStatus',
                'categoryChart',
                'monthlyDownloads'
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

        if ($user->role === 'kaprodi') {
            return view('kaprodi.dashboard.index', compact(
                'stats',
                'categoryDistribution',
                'recentActivities'
            ));
        }

        abort(403);
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

<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = Auth::user();

        $hour = now('Asia/Jakarta')->hour;

        $greeting = match (true) {
            $hour >= 5 && $hour < 12 => 'Selamat Pagi',
            $hour >= 12 && $hour < 15 => 'Selamat Siang',
            $hour >= 15 && $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };

        $currentYear = now()->year;

        /*
        |--------------------------------------------------------------------------
        | Base Query Dokumen Dosen
        |--------------------------------------------------------------------------
        */
        $documentQuery = Document::query()
            ->where('user_id', $userId);

        /*
        |--------------------------------------------------------------------------
        | Statistik Dashboard Dosen
        |--------------------------------------------------------------------------
        | Berisi:
        | - Total dokumen dosen
        | - Dokumen approved
        | - Dokumen pending
        | - Dokumen rejected
        |--------------------------------------------------------------------------
        */
        $stats = [
            'my_documents' => (clone $documentQuery)->count(),

            'approved' => (clone $documentQuery)
                ->where('status', 'approved')
                ->count(),

            'pending' => (clone $documentQuery)
                ->where('status', 'pending')
                ->count(),

            'rejected' => (clone $documentQuery)
                ->where('status', 'rejected')
                ->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Total Download Dokumen Dosen
        |--------------------------------------------------------------------------
        | Menghitung total download dari seluruh dokumen milik dosen
        |--------------------------------------------------------------------------
        */
        $stats['downloads'] = DocumentLog::query()
            ->where('action', 'download')
            ->whereHas('document', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Saya (Recent Activities)
        |--------------------------------------------------------------------------
        | Menampilkan aktivitas terbaru dosen:
        | - upload
        | - download
        | - view dokumen
        |--------------------------------------------------------------------------
        */
        $recentActivities = DocumentLog::query()
            ->with([
                'document.category'
            ])
            ->where('user_id', $userId)
            ->latest()
            ->take(7)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Grafik Upload Dokumen Dosen
        |--------------------------------------------------------------------------
        | Data upload dokumen per bulan
        |--------------------------------------------------------------------------
        */
        $monthlyUploads = Document::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('user_id', $userId)
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month');

        $uploadChartData = $this->generateMonthlyChart($monthlyUploads);

        /*
        |--------------------------------------------------------------------------
        | Grafik Download Dokumen Dosen
        |--------------------------------------------------------------------------
        | Data download dokumen per bulan
        |--------------------------------------------------------------------------
        */
        $monthlyDownloads = DocumentLog::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('action', 'download')
            ->whereHas('document', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total', 'month');

        $downloadChartData = $this->generateMonthlyChart($monthlyDownloads);

        /*
        |--------------------------------------------------------------------------
        | Data Status Dokumen Dosen
        |--------------------------------------------------------------------------
        | Digunakan untuk doughnut chart:
        | - approved
        | - pending
        | - rejected
        |--------------------------------------------------------------------------
        */
        $statusChartData = [
            $stats['approved'],
            $stats['pending'],
            $stats['rejected'],
        ];

        /*
        |--------------------------------------------------------------------------
        | Dokumen Terpopuler Dosen
        |--------------------------------------------------------------------------
        | Dokumen dengan total download terbanyak
        |--------------------------------------------------------------------------
        */
        $popularDocuments = Document::query()
            ->with('category')
            ->withCount([
                'logs as downloads_count' => function ($query) {
                    $query->where('action', 'download');
                }
            ])
            ->where('user_id', $userId)
            ->orderByDesc('downloads_count')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Quick Insights Dashboard Dosen
        |--------------------------------------------------------------------------
        | Berisi:
        | - dokumen paling populer
        | - upload terbaru
        | - kategori paling aktif
        |--------------------------------------------------------------------------
        */
        $mostDownloaded = $popularDocuments->first();

        $latestUpload = Document::query()
            ->where('user_id', $userId)
            ->latest()
            ->first();

        $topCategory = Document::query()
            ->select('category_id', DB::raw('COUNT(*) as total'))
            ->with('category')
            ->where('user_id', $userId)
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Monitoring Mahasiswa
        |--------------------------------------------------------------------------
        | Menampilkan daftar mahasiswa beserta:
        | - total dokumen
        | - total aktivitas/log
        |--------------------------------------------------------------------------
        */
        $studentActivities = User::query()
            ->where('role', 'mahasiswa')
            ->withCount([
                'documents',
                'logs'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Saya - Upload Terbaru
        |--------------------------------------------------------------------------
        | Digunakan pada tab:
        | "Aktivitas Saya"
        |--------------------------------------------------------------------------
        */
        $recentUploads = Document::query()
            ->with('category')
            ->withCount([
                'logs as downloads_count' => function ($query) {
                    $query->where('action', 'download');
                }
            ])
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Saya - Status Validasi Dokumen
        |--------------------------------------------------------------------------
        | Menampilkan status validasi dokumen terbaru dosen
        |--------------------------------------------------------------------------
        */
        $latestValidationDocuments = Document::query()
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Mahasiswa - Mahasiswa Paling Aktif
        |--------------------------------------------------------------------------
        | Diurutkan berdasarkan jumlah aktivitas/log terbanyak
        |--------------------------------------------------------------------------
        */
        $topStudents = User::query()
            ->where('role', 'mahasiswa')
            ->withCount([
                'documents',
                'logs'
            ])
            ->orderByDesc('logs_count')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Mahasiswa - Upload Terbaru Mahasiswa
        |--------------------------------------------------------------------------
        | Menampilkan dokumen terbaru yang diupload mahasiswa
        |--------------------------------------------------------------------------
        */
        $latestStudentUploads = Document::query()
            ->with([
                'user',
                'category'
            ])
            ->whereHas('user', function ($query) {
                $query->where('role', 'mahasiswa');
            })
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Mahasiswa - Mahasiswa Tidak Aktif
        |--------------------------------------------------------------------------
        | Mahasiswa yang belum memiliki aktivitas/log
        |--------------------------------------------------------------------------
        */
        $inactiveStudents = User::query()
            ->where('role', 'mahasiswa')
            ->withCount([
                'documents',
                'logs'
            ])
            ->having('logs_count', '=', 0)
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Mahasiswa - Timeline Aktivitas
        |--------------------------------------------------------------------------
        | Menampilkan aktivitas terbaru mahasiswa:
        | - upload
        | - download
        | - view dokumen
        |--------------------------------------------------------------------------
        */
        $studentRecentActivities = DocumentLog::query()
            ->with([
                'user',
                'document'
            ])
            ->whereHas('user', function ($query) {
                $query->where('role', 'mahasiswa');
            })
            ->latest()
            ->take(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Return View Dashboard
        |--------------------------------------------------------------------------
        */
        return view('dosen.dashboard.index', compact(
            'user',
            'greeting',

            'stats',
            'recentActivities',
            'uploadChartData',
            'downloadChartData',
            'statusChartData',
            'popularDocuments',
            'mostDownloaded',
            'latestUpload',
            'topCategory',
            'studentActivities',

            // Aktivitas Saya
            'recentUploads',
            'latestValidationDocuments',

            // Aktivitas Mahasiswa
            'topStudents',
            'latestStudentUploads',
            'inactiveStudents',
            'studentRecentActivities',
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Monthly Chart
    |--------------------------------------------------------------------------
    | Helper untuk generate data chart bulanan
    |--------------------------------------------------------------------------
    */
    private function generateMonthlyChart($data): array
    {
        $chart = [];

        for ($month = 1; $month <= 12; $month++) {
            $chart[] = $data[$month] ?? 0;
        }

        return $chart;
    }
}

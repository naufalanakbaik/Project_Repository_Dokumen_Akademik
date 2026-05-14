<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Document;
// use App\Models\User;
use App\Models\DocumentLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */
        $myDocuments = Document::where('user_id', $userId)->count();

        $approved = Document::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();

        $pending = Document::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $rejected = Document::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Total Downloads
        |--------------------------------------------------------------------------
        */
        $totalDownloads = DocumentLog::whereHas('document', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('action', 'download')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Recent Activities
        |--------------------------------------------------------------------------
        */
        $recentActivities = DocumentLog::with([
            'document.category'
        ])
            ->where('user_id', $userId)
            ->latest()
            ->take(7)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Upload Activity Chart
        |--------------------------------------------------------------------------
        */
        $monthlyUploads = Document::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $uploadChartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $uploadChartData[] = $monthlyUploads[$i] ?? 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Download Activity Chart
        |--------------------------------------------------------------------------
        */
        $monthlyDownloads = DocumentLog::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->where('action', 'download')
            ->whereHas('document', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $downloadChartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $downloadChartData[] = $monthlyDownloads[$i] ?? 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Status Chart
        |--------------------------------------------------------------------------
        */
        $statusChartData = [
            $approved,
            $pending,
            $rejected
        ];

        /*
        |--------------------------------------------------------------------------
        | Popular Documents
        |--------------------------------------------------------------------------
        */
        $popularDocuments = Document::with([
            'category'
        ])
            ->withCount([
                'logs as downloads_count' => function ($q) {
                    $q->where('action', 'download');
                }
            ])
            ->where('user_id', $userId)
            ->orderByDesc('downloads_count')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Quick Insights
        |--------------------------------------------------------------------------
        */
        $mostDownloaded = $popularDocuments->first();

        $latestUpload = Document::where('user_id', $userId)
            ->latest()
            ->first();

        $topCategory = Document::select('category_id', DB::raw('COUNT(*) as total'))
            ->where('user_id', $userId)
            ->groupBy('category_id')
            ->with('category')
            ->orderByDesc('total')
            ->first();

        /*
|--------------------------------------------------------------------------
| Monitoring Mahasiswa
|--------------------------------------------------------------------------
*/

        $studentActivities = \App\Models\User::withCount([
            'documents',
            'logs'
        ])
            ->where('role', 'mahasiswa')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */
        return view('dosen.dashboard.index', [
            'stats' => [
                'my_documents' => $myDocuments,
                'approved' => $approved,
                'pending' => $pending,
                'rejected' => $rejected,
                'downloads' => $totalDownloads,
            ],

            'recentActivities' => $recentActivities,

            'uploadChartData' => $uploadChartData,

            'downloadChartData' => $downloadChartData,

            'statusChartData' => $statusChartData,

            'popularDocuments' => $popularDocuments,

            'mostDownloaded' => $mostDownloaded,

            'latestUpload' => $latestUpload,

            'topCategory' => $topCategory,

            'studentActivities' => $studentActivities,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
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
        | Return View
        |--------------------------------------------------------------------------
        */
        return view('mahasiswa.dashboard.index', [
            'stats' => [
                'my_documents' => $myDocuments,
                'approved' => $approved,
                'pending' => $pending,
                'rejected' => $rejected,
            ],

            'recentActivities' => $recentActivities,

            'uploadChartData' => $uploadChartData,

            'statusChartData' => $statusChartData,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Document;
use App\Models\Category;
use App\Models\DocumentLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;


class DashboardController extends Controller
{
    public function index()
    {
        $totalDocuments = Document::count();

        $totalMahasiswa = User::where(
            'role',
            'mahasiswa'
        )->count();

        $totalDosen = User::where(
            'role',
            'dosen'
        )->count();

        $totalDownloads = DocumentLog::where(
            'action',
            'download'
        )->count();

        // Upload per bulan
        $monthlyUploads = Document::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('month')
            ->pluck(
                'total',
                'month'
            );

        // Kategori
        $categories = Category::withCount(
            'documents'
        )->get();

        // Dokumen terbaru
        $latestDocuments = Document::with([
            'user',
            'category'
        ])
            ->latest()
            ->take(5)
            ->get();

        // Statistik Status Dokumen
        $statusCounts = Document::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view(
            'kaprodi.dashboard.index',
            compact(
                'totalDocuments',
                'totalMahasiswa',
                'totalDosen',
                'totalDownloads',
                'monthlyUploads',
                'categories',
                'latestDocuments',
                'statusCounts'
            )
        );
    }


    public function exportReport()
    {
        // Card statistik
        $totalDocuments = Document::count();

        $totalMahasiswa = User::where(
            'role',
            'mahasiswa'
        )->count();

        $totalDosen = User::where(
            'role',
            'dosen'
        )->count();

        $totalDownloads = DocumentLog::where(
            'action',
            'download'
        )->count();


        // Line chart upload per bulan
        $monthlyUploads = Document::select(
            DB::raw("MONTH(created_at) as month"),
            DB::raw("count(*) as total")
        )
            ->groupBy('month')
            ->pluck(
                'total',
                'month'
            );


        // Bar chart kategori
        $categories = Category::withCount(
            'documents'
        )->get();


        // Aktivitas terbaru
        $latestDocuments = Document::with([
            'user',
            'category'
        ])
            ->latest()
            ->take(5)
            ->get();


        return view(
            'kaprodi.report.index',
            compact(
                'totalDocuments',
                'totalMahasiswa',
                'totalDosen',
                'totalDownloads',
                'monthlyUploads',
                'categories',
                'latestDocuments'
            )
        );
    }
}

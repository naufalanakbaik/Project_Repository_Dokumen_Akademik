@extends('kaprodi.layouts.app')

@section('title', 'Dashboard Monitoring')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
@endpush

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 space-y-8 bg-gray-50/50 min-h-screen">
    
    {{-- ═══ Page Header & Welcome ═══ --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-gray-200">
        <div>
            <nav class="flex mb-3" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-xs font-medium text-gray-500">
                    <li><span class="flex items-center"><span class="material-symbols-outlined !text-sm mr-1">grid_view</span> Kaprodi</span></li>
                    <li><span class="material-symbols-outlined !text-xs text-gray-400">chevron_right</span></li>
                    <li class="text-gray-900">Dashboard</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Halo, {{ Auth::user()->name }} 👋
            </h1>
            <p class="mt-2 text-sm text-gray-600">
                Selamat datang kembali. Berikut adalah ringkasan performa dan aktivitas repositori dokumen hari ini.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700">
                <span class="material-symbols-outlined !text-lg text-blue-500">calendar_today</span>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
            <a href="/" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-xl shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                <span class="material-symbols-outlined !text-lg mr-2">description</span>
                Ekspor Laporan
            </a>
        </div>
    </div>

    {{-- ═══ Stats Overview Grid ═══ --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        {{-- Total Documents --}}
        <div class="relative overflow-hidden bg-white px-6 py-8 rounded-2xl border border-gray-200 shadow-sm group hover:border-blue-200 transition-all duration-300">
            <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Dokumen</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ number_format($totalDocuments) }}</h3>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-blue-100/80 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined !text-2xl">description</span>
                </div>
            </div>
            <div class="mt-6 flex items-center text-sm font-medium text-blue-600 relative z-10">
                <span class="material-symbols-outlined !text-lg mr-1">trending_up</span>
                <span>Update berkala</span>
            </div>
        </div>

        {{-- Students --}}
        <div class="relative overflow-hidden bg-white px-6 py-8 rounded-2xl border border-gray-200 shadow-sm group hover:border-indigo-200 transition-all duration-300">
            <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Mahasiswa</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ number_format($totalMahasiswa) }}</h3>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-indigo-100/80 rounded-xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined !text-2xl">school</span>
                </div>
            </div>
            <div class="mt-6 flex items-center text-sm font-medium text-indigo-600 relative z-10">
                <span class="material-symbols-outlined !text-lg mr-1">group</span>
                <span>Terdaftar</span>
            </div>
        </div>

        {{-- Lecturers --}}
        <div class="relative overflow-hidden bg-white px-6 py-8 rounded-2xl border border-gray-200 shadow-sm group hover:border-emerald-200 transition-all duration-300">
            <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Dosen</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ number_format($totalDosen) }}</h3>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-emerald-100/80 rounded-xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined !text-2xl">person_pin</span>
                </div>
            </div>
            <div class="mt-6 flex items-center text-sm font-medium text-emerald-600 relative z-10">
                <span class="material-symbols-outlined !text-lg mr-1">check_circle</span>
                <span>Aktif</span>
            </div>
        </div>

        {{-- Downloads --}}
        <div class="relative overflow-hidden bg-white px-6 py-8 rounded-2xl border border-gray-200 shadow-sm group hover:border-amber-200 transition-all duration-300">
            <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Downloads</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ number_format($totalDownloads) }}</h3>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-amber-100/80 rounded-xl text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined !text-2xl">download</span>
                </div>
            </div>
            <div class="mt-6 flex items-center text-sm font-medium text-amber-600 relative z-10">
                <span class="material-symbols-outlined !text-lg mr-1">analytics</span>
                <span>Total akses</span>
            </div>
        </div>
    </div>

    {{-- ═══ Status Breakdown & Charts ═══ --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Main Analytics (Left Col) --}}
        <div class="lg:col-span-8 space-y-8">
            
            {{-- Document Status Breakdown --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400">query_stats</span>
                        <h2 class="text-lg font-semibold text-gray-900">Breakdown Status</h2>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-4 rounded-xl bg-orange-50/50 border border-orange-100 flex flex-col items-center text-center">
                        <span class="text-sm font-semibold text-orange-600 mb-1">Pending</span>
                        <span class="text-3xl font-bold text-gray-900">{{ $statusCounts['pending'] ?? 0 }}</span>
                        <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                            <div class="bg-orange-500 h-full rounded-full" style="width: {{ $totalDocuments > 0 ? (($statusCounts['pending'] ?? 0) / $totalDocuments) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-100 flex flex-col items-center text-center">
                        <span class="text-sm font-semibold text-emerald-600 mb-1">Approved</span>
                        <span class="text-3xl font-bold text-gray-900">{{ $statusCounts['approved'] ?? 0 }}</span>
                        <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                            <div class="bg-emerald-500 h-full rounded-full" style="width: {{ $totalDocuments > 0 ? (($statusCounts['approved'] ?? 0) / $totalDocuments) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="p-4 rounded-xl bg-rose-50/50 border border-rose-100 flex flex-col items-center text-center">
                        <span class="text-sm font-semibold text-rose-600 mb-1">Rejected</span>
                        <span class="text-3xl font-bold text-gray-900">{{ $statusCounts['rejected'] ?? 0 }}</span>
                        <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                            <div class="bg-rose-500 h-full rounded-full" style="width: {{ $totalDocuments > 0 ? (($statusCounts['rejected'] ?? 0) / $totalDocuments) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload Trend Chart --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Tren Upload Dokumen</h2>
                        <p class="text-sm text-gray-500">Aktivitas unggahan tahun ini ({{ date('Y') }})</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                        Jumlah Upload
                    </div>
                </div>
                <div class="p-8">
                    <div class="h-[350px]">
                        <canvas id="uploadChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Latest Documents Table --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400">folder_open</span>
                        <h2 class="text-lg font-semibold text-gray-900">Dokumen Terbaru</h2>
                    </div>
                    <a href="{{ route('kaprodi.documents.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors inline-flex items-center gap-1 group">
                        Lihat Semua
                        <span class="material-symbols-outlined !text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    @if($latestDocuments->isEmpty())
                        <div class="py-16 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gray-50 border border-gray-100 mb-4 text-gray-300">
                                <span class="material-symbols-outlined !text-4xl">folder_open</span>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada dokumen yang diunggah</p>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Judul Dokumen</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pemilik</th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3.5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($latestDocuments as $doc)
                                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center border border-blue-100">
                                                    <span class="material-symbols-outlined !text-lg">article</span>
                                                </div>
                                                <div class="max-w-xs overflow-hidden">
                                                    <p class="text-sm font-semibold text-gray-900 truncate" title="{{ $doc->title }}">{{ $doc->title }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($doc->category)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                                                    {{ $doc->category->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-600 border border-blue-200">
                                                    {{ strtoupper(substr($doc->user?->name ?? '?', 0, 1)) }}
                                                </div>
                                                <span class="text-sm text-gray-600">{{ $doc->user?->name ?? '—' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                            {{ $doc->created_at->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            @php
                                                $statusClass = match($doc->status) {
                                                    'approved' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                    'rejected' => 'bg-rose-100 text-rose-700 border-rose-200',
                                                    default => 'bg-amber-100 text-amber-700 border-amber-200'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider border {{ $statusClass }}">
                                                {{ $doc->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar (Right Col) --}}
        <div class="lg:col-span-4 space-y-8">
            
            {{-- Quick Actions --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Akses Cepat</h2>
                </div>
                <div class="p-6 grid grid-cols-2 gap-4">
                    <a href="{{ route('kaprodi.documents.index') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:border-blue-200 hover:shadow-md transition-all duration-300 group">
                        <span class="material-symbols-outlined !text-3xl text-blue-500 group-hover:scale-110 transition-transform mb-2">folder_open</span>
                        <span class="text-xs font-bold text-gray-700">Repositori</span>
                    </a>
                    <a href="{{ route('kaprodi.monitoring.mahasiswa') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:border-indigo-200 hover:shadow-md transition-all duration-300 group">
                        <span class="material-symbols-outlined !text-3xl text-indigo-500 group-hover:scale-110 transition-transform mb-2">manage_accounts</span>
                        <span class="text-xs font-bold text-gray-700">Monitoring</span>
                    </a>
                    <a href="{{ route('kaprodi.activity') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:border-emerald-200 hover:shadow-md transition-all duration-300 group">
                        <span class="material-symbols-outlined !text-3xl text-emerald-500 group-hover:scale-110 transition-transform mb-2">history</span>
                        <span class="text-xs font-bold text-gray-700">Log Activity</span>
                    </a>
                    <a href="{{ route('kaprodi.profile.show', Auth::id()) }}" class="flex flex-col items-center justify-center p-4 rounded-2xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:border-amber-200 hover:shadow-md transition-all duration-300 group">
                        <span class="material-symbols-outlined !text-3xl text-amber-500 group-hover:scale-110 transition-transform mb-2">account_circle</span>
                        <span class="text-xs font-bold text-gray-700">Profil Saya</span>
                    </a>
                </div>
            </div>

            {{-- Category Distribution Chart --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Distribusi Kategori</h2>
                </div>
                <div class="p-6">
                    @if ($categories->sum('documents_count') > 0)
                        <div class="relative h-[280px] flex items-center justify-center">
                            <canvas id="categoryChart"></canvas>
                            {{-- Center Stats --}}
                            <div class="absolute flex flex-col items-center pointer-events-none">
                                <span class="text-3xl font-bold tracking-tight text-gray-900">
                                    {{ $categories->sum('documents_count') }}
                                </span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                    Total Dokumen
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                             <span class="material-symbols-outlined text-gray-300 !text-5xl mb-3">donut_large</span>
                            <p class="text-sm font-medium text-gray-500">Belum ada data kategori</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Recent Activity Feed --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h2>
                    <span class="material-symbols-outlined text-gray-400">timeline</span>
                </div>
                <div class="p-6">
                    @if ($latestDocuments->isEmpty())
                        <div class="text-center py-6">
                            <p class="text-sm text-gray-400">Belum ada aktivitas</p>
                        </div>
                    @else
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach ($latestDocuments as $doc)
                                    <li>
                                        <div class="relative pb-8">
                                            @if (!$loop->last)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-100" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-lg bg-blue-600 flex items-center justify-center ring-4 ring-white">
                                                        <span class="material-symbols-outlined text-white !text-lg">upload_file</span>
                                                    </span>
                                                </div>
                                                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">
                                                            <span class="font-bold text-gray-900">{{ $doc->user?->name }}</span> mengunggah dokumen baru
                                                        </p>
                                                        <p class="mt-1 text-xs text-blue-600 font-medium truncate max-w-[200px]">
                                                            {{ $doc->title }}
                                                        </p>
                                                    </div>
                                                    <div class="whitespace-nowrap text-right text-[10px] font-bold text-gray-400 uppercase">
                                                        {{ $doc->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('kaprodi.activity') }}" class="mt-6 flex items-center justify-center w-full px-4 py-2 border border-gray-200 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
                            Lihat Semua Aktivitas
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ═══ SCRIPTS ═══ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Config Chart JS Global Fonts
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#6b7280';

    /* ─── Upload Trend Chart ─── */
    (function() {
        const canvas = document.getElementById('uploadChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 350);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.15)');
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

        const rawData = @json($monthlyUploads);
        const data = Array.from({ length: 12 }, (_, i) => rawData[i + 1] ?? 0);

        new Chart(canvas, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Dokumen Diunggah',
                    data: data,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#2563eb',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: '#2563eb',
                    pointHoverBorderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 12 },
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#f3f4f6', drawBorder: false },
                        ticks: { stepSize: 5 }
                    },
                    x: {
                        grid: { display: false, drawBorder: false }
                    }
                }
            }
        });
    })();

    /* ─── Category Breakdown Chart ─── */
    (function() {
        const canvas = document.getElementById('categoryChart');
        if (!canvas) return;

        const labels = @json($categories->pluck('name'));
        const counts = @json($categories->pluck('documents_count'));
        
        // Premium Color Palette
        const palette = [
            '#2563eb', // blue
            '#818cf8', // indigo
            '#c084fc', // purple
            '#fb7185', // rose
            '#fb923c', // orange
            '#fbbf24', // amber
            '#4ade80', // green
            '#2dd4bf', // teal
        ];

                            callbacks: {
                                label: ctx =>
                                    `${ctx.label}: ${ctx.parsed} dokumen`
                            }
                        }
                    }
                }
            });
        })();
    </script>
@endsection

@extends('kaprodi.layouts.app')
@section('title', 'Dashboard Monitoring')

@push('styles')
    <style>
        /* ─── Design Tokens ─── */
        :root {
            --border: #e5e7eb;
            --border-hover: #d1d5db;
            --surface: #ffffff;
            --surface-subtle: #f9fafb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            --radius-card: 12px;
            --shadow-card: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-card-hover: 0 4px 16px rgba(0,0,0,.08), 0 2px 6px rgba(0,0,0,.04);
            --transition: all .18s cubic-bezier(.4,0,.2,1);
        }

        /* ─── Base Card ─── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            transition: var(--transition);
        }
        .card:hover {
            border-color: var(--border-hover);
            box-shadow: var(--shadow-card-hover);
        }

        /* ─── Stat Cards ─── */
        .stat-card {
            position: relative;
            overflow: hidden;
            cursor: default;
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }
        .stat-card .icon-wrap {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .stat-card .stat-label {
            font-size: 11.5px;
            font-weight: 500;
            letter-spacing: .02em;
            color: var(--text-secondary);
        }
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -.03em;
            color: var(--text-primary);
            line-height: 1.1;
        }
        .stat-card .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 10.5px;
            font-weight: 500;
            padding: 2px 8px;
            border-radius: 99px;
            border: 1px solid;
        }

        /* ─── Quick Actions ─── */
        .quick-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--surface);
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }
        .quick-action-btn:hover {
            background: var(--surface-subtle);
            border-color: var(--border-hover);
            color: var(--text-primary);
        }
        .quick-action-btn .material-symbols-outlined {
            font-size: 16px !important;
            color: #6b7280;
        }

        /* ─── Chart Card ─── */
        .chart-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            transition: var(--transition);
        }
        .chart-card:hover {
            box-shadow: var(--shadow-card-hover);
        }
        .chart-card-header {
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--border);
        }
        .chart-card-body {
            padding: 18px 20px;
        }

        /* ─── Table ─── */
        .data-table thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-muted);
            padding: 10px 16px;
            background: var(--surface-subtle);
            border-bottom: 1px solid var(--border);
        }
        .data-table thead th:first-child { border-left: none; }
        .data-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background .12s ease;
        }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #f9fafb; }
        .data-table tbody td {
            padding: 11px 16px;
            font-size: 13.5px;
            color: #374151;
        }

        /* ─── Badge ─── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2.5px 9px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 500;
            border: 1px solid;
        }
        .badge-blue   { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
        .badge-amber  { background: #fffbeb; color: #b45309; border-color: #fde68a; }
        .badge-green  { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
        .badge-violet { background: #f5f3ff; color: #6d28d9; border-color: #ddd6fe; }
        .badge-rose   { background: #fff1f2; color: #be123c; border-color: #fecdd3; }
        .badge-gray   { background: #f9fafb; color: #4b5563; border-color: #e5e7eb; }

        /* ─── Activity Feed ─── */
        .activity-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-dot {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ─── Section Divider ─── */
        .section-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        /* ─── Empty State ─── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            text-align: center;
            gap: 10px;
        }
        .empty-state .empty-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--surface-subtle);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
        }

        /* ─── Skeleton Loader ─── */
        @keyframes shimmer {
            0%   { background-position: -600px 0; }
            100% { background-position: 600px 0; }
        }
        .skeleton {
            border-radius: 6px;
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 600px 100%;
            animation: shimmer 1.4s infinite ease-in-out;
        }

        /* ─── Page header ─── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 24px;
        }

        /* ─── Divider ─── */
        .divider { height: 1px; background: var(--border); }

        /* chart container fix height */
        .chart-wrap { position: relative; }
    </style>
@endpush

@section('content')
<div class="space-y-6 pb-6">

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="page-header">
        <div>
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-1.5">
                <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                <span>Kaprodi</span>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <span class="text-gray-600 font-medium">Dashboard</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Dashboard Monitoring</h1>
            <p class="text-sm text-gray-400 mt-0.5">Ringkasan statistik & aktivitas repositori dokumen akademik</p>
        </div>
        <div class="flex items-center gap-2 text-xs text-gray-400 bg-white border border-gray-200 rounded-lg px-3.5 py-2 shadow-sm">
            <span class="material-symbols-outlined !text-[14px] text-gray-400">event</span>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

        {{-- Total Dokumen --}}
        <div class="card stat-card p-5">
            <div class="flex items-start justify-between mb-3">
                <div class="icon-wrap bg-amber-50 border border-amber-100">
                    <span class="material-symbols-outlined text-amber-500 !text-[20px]">description</span>
                </div>
                <span class="stat-badge text-amber-600 border-amber-200 bg-amber-50">
                    <span class="material-symbols-outlined !text-[11px]">trending_up</span>Aktif
                </span>
            </div>
            <p class="stat-label">Total Dokumen</p>
            <div class="stat-value mt-0.5">{{ $totalDocuments }}</div>
        </div>

        {{-- Mahasiswa --}}
        <div class="card stat-card p-5">
            <div class="flex items-start justify-between mb-3">
                <div class="icon-wrap bg-blue-50 border border-blue-100">
                    <span class="material-symbols-outlined text-blue-500 !text-[20px]">school</span>
                </div>
                <span class="stat-badge text-blue-600 border-blue-200 bg-blue-50">
                    <span class="material-symbols-outlined !text-[11px]">group</span>Users
                </span>
            </div>
            <p class="stat-label">Mahasiswa</p>
            <div class="stat-value mt-0.5">{{ $totalMahasiswa }}</div>
        </div>

        {{-- Dosen --}}
        <div class="card stat-card p-5">
            <div class="flex items-start justify-between mb-3">
                <div class="icon-wrap bg-emerald-50 border border-emerald-100">
                    <span class="material-symbols-outlined text-emerald-500 !text-[20px]">person_pin</span>
                </div>
                <span class="stat-badge text-emerald-600 border-emerald-200 bg-emerald-50">
                    <span class="material-symbols-outlined !text-[11px]">verified</span>Aktif
                </span>
            </div>
            <p class="stat-label">Dosen</p>
            <div class="stat-value mt-0.5">{{ $totalDosen }}</div>
        </div>

        {{-- Downloads --}}
        <div class="card stat-card p-5">
            <div class="flex items-start justify-between mb-3">
                <div class="icon-wrap bg-violet-50 border border-violet-100">
                    <span class="material-symbols-outlined text-violet-500 !text-[20px]">download</span>
                </div>
                <span class="stat-badge text-violet-600 border-violet-200 bg-violet-50">
                    <span class="material-symbols-outlined !text-[11px]">insights</span>Total
                </span>
            </div>
            <p class="stat-label">Download</p>
            <div class="stat-value mt-0.5">{{ $totalDownloads }}</div>
        </div>

    </div>

    {{-- ═══ QUICK ACTIONS ═══ --}}
    <div class="card px-5 py-4">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                <span class="material-symbols-outlined !text-[16px] text-gray-400">bolt</span>
                Quick Actions
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('kaprodi.documents.index') }}" class="quick-action-btn">
                    <span class="material-symbols-outlined">folder_open</span>
                    Daftar Dokumen
                </a>
                <a href="{{ route('kaprodi.monitoring.mahasiswa') }}" class="quick-action-btn">
                    <span class="material-symbols-outlined">manage_accounts</span>
                    Monitoring Mahasiswa
                </a>
                <a href="{{ route('kaprodi.activity') }}" class="quick-action-btn">
                    <span class="material-symbols-outlined">history</span>
                    Log Aktivitas
                </a>
                <a href="{{ route('kaprodi.profile.show', Auth::id()) }}" class="quick-action-btn">
                    <span class="material-symbols-outlined">account_circle</span>
                    Profil Saya
                </a>
            </div>
        </div>
    </div>

    {{-- ═══ CHARTS ROW ═══ --}}
    <div class="grid lg:grid-cols-3 gap-4">

        {{-- Line Chart: Upload Trend --}}
        <div class="chart-card lg:col-span-2">
            <div class="chart-card-header flex items-center justify-between">
                <div>
                    <h2 class="text-[13.5px] font-semibold text-gray-800">Tren Upload Dokumen</h2>
                    <p class="text-[11.5px] text-gray-400 mt-0.5">Jumlah unggahan bulanan — tahun {{ date('Y') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1.5 text-[11px] text-gray-400">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                        Upload
                    </div>
                    <div class="icon-wrap bg-amber-50 border border-amber-100">
                        <span class="material-symbols-outlined text-amber-500 !text-[16px]">show_chart</span>
                    </div>
                </div>
            </div>
            <div class="chart-card-body chart-wrap">
                <canvas id="uploadChart" height="105"></canvas>
            </div>
        </div>

        {{-- Doughnut Chart: Category --}}
        <div class="chart-card">
            <div class="chart-card-header flex items-center justify-between">
                <div>
                    <h2 class="text-[13.5px] font-semibold text-gray-800">Kategori Dokumen</h2>
                    <p class="text-[11.5px] text-gray-400 mt-0.5">Distribusi per kategori</p>
                </div>
                <div class="icon-wrap bg-blue-50 border border-blue-100">
                    <span class="material-symbols-outlined text-blue-500 !text-[16px]">donut_large</span>
                </div>
            </div>
            <div class="chart-card-body">
                @if($categories->sum('documents_count') > 0)
                    <canvas id="categoryChart"></canvas>
                @else
                    <div class="empty-state py-8">
                        <div class="empty-icon">
                            <span class="material-symbols-outlined text-gray-300 !text-[22px]">donut_large</span>
                        </div>
                        <p class="text-sm text-gray-400 font-medium">Belum ada data kategori</p>
                        <p class="text-xs text-gray-300">Kategori akan muncul setelah dokumen diunggah</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ═══ BOTTOM ROW: Dokumen Terbaru + Activity Feed ═══ --}}
    <div class="grid lg:grid-cols-3 gap-4">

        {{-- Dokumen Terbaru (2/3) --}}
        <div class="chart-card lg:col-span-2">
            <div class="chart-card-header flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="icon-wrap bg-gray-100 border border-gray-200" style="width:34px;height:34px;border-radius:8px;">
                        <span class="material-symbols-outlined text-gray-500 !text-[16px]">folder_open</span>
                    </div>
                    <div>
                        <h2 class="text-[13.5px] font-semibold text-gray-800">Dokumen Terbaru</h2>
                        <p class="text-[11.5px] text-gray-400">5 dokumen terakhir yang diunggah</p>
                    </div>
                </div>
                <a href="{{ route('kaprodi.documents.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 hover:text-blue-700 transition bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg border border-blue-100">
                    Lihat Semua
                    <span class="material-symbols-outlined !text-[13px]">arrow_forward</span>
                </a>
            </div>

            @if($latestDocuments->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <span class="material-symbols-outlined text-gray-300 !text-[24px]">folder_open</span>
                    </div>
                    <p class="text-sm font-medium text-gray-400">Belum ada dokumen</p>
                    <p class="text-xs text-gray-300">Dokumen yang diunggah mahasiswa akan muncul di sini</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full data-table">
                        <thead>
                            <tr>
                                <th class="text-left w-8">#</th>
                                <th class="text-left">Judul Dokumen</th>
                                <th class="text-left">Kategori</th>
                                <th class="text-left">Pemilik</th>
                                <th class="text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestDocuments as $i => $doc)
                                <tr>
                                    <td class="text-xs text-gray-300 font-mono">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="flex items-center gap-2.5">
                                            <div class="flex items-center justify-center w-7 h-7 rounded-md bg-amber-50 border border-amber-100 flex-shrink-0">
                                                <span class="material-symbols-outlined text-amber-400 !text-[14px]">article</span>
                                            </div>
                                            <span class="font-medium text-gray-800 line-clamp-1 max-w-[220px]" title="{{ $doc->title }}">
                                                {{ $doc->title }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($doc->category)
                                            <span class="badge badge-blue">{{ $doc->category->name }}</span>
                                        @else
                                            <span class="badge badge-gray">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1.5">
                                            <div class="w-5 h-5 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                                <span class="text-white text-[9px] font-bold leading-none">
                                                    {{ strtoupper(substr($doc->user?->name ?? '?', 0, 1)) }}
                                                </span>
                                            </div>
                                            <span class="text-gray-600 text-[13px]">{{ $doc->user?->name ?? '—' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-gray-400 text-xs whitespace-nowrap">
                                        {{ $doc->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Activity Feed (1/3) --}}
        <div class="chart-card">
            <div class="chart-card-header flex items-center justify-between">
                <div>
                    <h2 class="text-[13.5px] font-semibold text-gray-800">Aktivitas Terbaru</h2>
                    <p class="text-[11.5px] text-gray-400 mt-0.5">Dokumen yang baru diproses</p>
                </div>
                <div class="icon-wrap bg-emerald-50 border border-emerald-100" style="width:34px;height:34px;border-radius:8px;">
                    <span class="material-symbols-outlined text-emerald-500 !text-[16px]">timeline</span>
                </div>
            </div>
            <div class="chart-card-body">
                @if($latestDocuments->isEmpty())
                    <div class="empty-state py-8">
                        <div class="empty-icon">
                            <span class="material-symbols-outlined text-gray-300 !text-[22px]">timeline</span>
                        </div>
                        <p class="text-sm text-gray-400 font-medium">Belum ada aktivitas</p>
                        <p class="text-xs text-gray-300 mt-0.5">Feed akan muncul setelah ada dokumen</p>
                    </div>
                @else
                    <div class="space-y-0">
                        @foreach($latestDocuments as $doc)
                            @php
                                $colors = ['bg-blue-50 border border-blue-100', 'bg-amber-50 border border-amber-100', 'bg-emerald-50 border border-emerald-100', 'bg-violet-50 border border-violet-100', 'bg-rose-50 border border-rose-100'];
                                $iconColors = ['text-blue-400', 'text-amber-400', 'text-emerald-400', 'text-violet-400', 'text-rose-400'];
                                $idx = $loop->index % 5;
                            @endphp
                            <div class="activity-item">
                                <div class="activity-dot {{ $colors[$idx] }}" style="width:32px;height:32px;border-radius:8px;">
                                    <span class="material-symbols-outlined {{ $iconColors[$idx] }} !text-[15px]">upload_file</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[12.5px] font-medium text-gray-700 truncate leading-tight">{{ $doc->title }}</p>
                                    <p class="text-[11px] text-gray-400 mt-0.5">
                                        {{ $doc->user?->name ?? 'Unknown' }} &middot;
                                        <span class="text-gray-300">{{ $doc->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('kaprodi.activity') }}"
                        class="mt-4 flex items-center justify-center gap-1.5 text-xs font-medium text-gray-500 hover:text-gray-700 transition py-2 border border-gray-100 rounded-lg hover:bg-gray-50">
                        <span class="material-symbols-outlined !text-[13px]">list</span>
                        Lihat semua aktivitas
                    </a>
                @endif
            </div>
        </div>

    </div>

</div>

{{-- ═══ SCRIPTS ═══ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    /* ─── Palette ─── */
    const COLORS = ['#3b82f6','#f59e0b','#10b981','#8b5cf6','#ef4444','#ec4899','#f97316'];

    /* ─── Upload Line Chart ─── */
    (function () {
        const canvas = document.getElementById('uploadChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const grad = ctx.createLinearGradient(0, 0, 0, 260);
        grad.addColorStop(0, 'rgba(245,158,11,.18)');
        grad.addColorStop(1, 'rgba(245,158,11,0)');

        const rawData = @json(array_values($monthlyUploads->toArray()));
        const data = Array.from({ length: 12 }, (_, i) => rawData[i] ?? 0);

        new Chart(canvas, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Upload',
                    data,
                    fill: true,
                    backgroundColor: grad,
                    borderColor: '#f59e0b',
                    borderWidth: 2,
                    pointRadius: 3.5,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f59e0b',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#f59e0b',
                    tension: .42
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#f9fafb',
                        bodyColor: '#d1d5db',
                        titleFont: { size: 12, weight: '600' },
                        bodyFont: { size: 11 },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: ctx => `${ctx.parsed.y} dokumen`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: 11 }, color: '#9ca3af' },
                        grid: { color: 'rgba(0,0,0,.04)', drawBorder: false }
                    },
                    x: {
                        ticks: { font: { size: 11 }, color: '#9ca3af' },
                        grid: { display: false }
                    }
                }
            }
        });
    })();

    /* ─── Category Doughnut ─── */
    (function () {
        const canvas = document.getElementById('categoryChart');
        if (!canvas) return;

        new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: @json($categories->pluck('name')),
                datasets: [{
                    data: @json($categories->pluck('documents_count')),
                    backgroundColor: COLORS,
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 5
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 14,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 11 },
                            color: '#6b7280'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#f9fafb',
                        bodyColor: '#d1d5db',
                        titleFont: { size: 12, weight: '600' },
                        bodyFont: { size: 11 },
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: ctx => ` ${ctx.parsed} dokumen`
                        }
                    }
                }
            }
        });
    })();
</script>

@endsection

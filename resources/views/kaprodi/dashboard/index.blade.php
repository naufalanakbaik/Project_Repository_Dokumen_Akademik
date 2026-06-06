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
            --radius-card: 9px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --shadow-card-hover: 0 4px 16px rgba(0, 0, 0, .08), 0 2px 6px rgba(0, 0, 0, .04);
            --transition: all .18s cubic-bezier(.4, 0, .2, 1);
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
            font-weight: 600;
            letter-spacing: -.03em;
            color: var(--text-primary);
            line-height: 1.1;
        }

        .stat-card .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 10px;
            font-weight: 500;
            padding: 3px 8px;
            border-radius: 20px;
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

        .data-table thead th:first-child {
            border-left: none;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background .12s ease;
        }

        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .data-table tbody tr:hover {
            background: #f9fafb;
        }

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

        .badge-blue {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .badge-amber {
            background: #fffbeb;
            color: #b45309;
            border-color: #fde68a;
        }

        .badge-green {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }

        .badge-violet {
            background: #f5f3ff;
            color: #6d28d9;
            border-color: #ddd6fe;
        }

        .badge-rose {
            background: #fff1f2;
            color: #be123c;
            border-color: #fecdd3;
        }

        .badge-gray {
            background: #f9fafb;
            color: #4b5563;
            border-color: #e5e7eb;
        }

        /* ─── Activity Feed ─── */
        .activity-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

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
            0% {
                background-position: -600px 0;
            }

            100% {
                background-position: 600px 0;
            }
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
        .divider {
            height: 1px;
            background: var(--border);
        }

        /* chart container fix height */
        .chart-wrap {
            position: relative;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6 pb-6">

        {{-- ═══ Page Header ═══ --}}
        <div class="page-header">
            <div>
                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-1.5">
                    <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                    <span>Kaprodi</span>
                    <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                    <span class="text-gray-700 font-medium">Dashboard</span>
                </div>
                <h1 class="text-[22px] font-semibold text-gray-900 tracking-tight">Dashboard Monitoring</h1>
                <p class="text-[13px] text-blue-500">Ringkasan statistik & aktivitas repositori dokumen akademik</p>
            </div>
            <div
                class="flex items-center gap-2 text-xs text-gray-500 bg-white border border-gray-200 rounded-md px-3.5 py-2 shadow-sm">
                <span class="material-symbols-outlined !text-[14px] text-gray-400">calendar_check</span>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        {{-- ═══ Grid cards ═══ --}}
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

            {{-- Total Dokumen --}}
            <div class="card stat-card p-5">
                <div class="flex items-start justify-between mb-3">
                    <div class="icon-wrap bg-amber-50 border border-amber-100">
                        <span class="material-symbols-outlined text-amber-500 !text-[20px]">description</span>
                    </div>
                    <span class="stat-badge text-amber-600 border border-amber-200 bg-amber-50">
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
                    <span class="stat-badge text-blue-600 border border-blue-200 bg-blue-50">
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
                    <span class="stat-badge text-emerald-600 border border-emerald-200 bg-emerald-50">
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
                    <span class="stat-badge text-violet-600 border border-violet-200 bg-violet-50">
                        <span class="material-symbols-outlined !text-[11px]">insights</span>Total
                    </span>
                </div>
                <p class="stat-label">Download</p>
                <div class="stat-value mt-0.5">{{ $totalDownloads }}</div>
            </div>

        </div>

        {{-- ═══ Quick Actions ═══ --}}
        <div class="card px-5 py-4">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                    <span class="material-symbols-outlined !text-[16px] text-gray-400">bolt</span>
                    Quick Actions
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <a href="{{ route('kaprodi.documents.index') }}" class="quick-action-btn">
                        <span class="material-symbols-outlined">folder_open</span>
                        Daftar Dokumen
                    </a>
                    <a href="{{ route('kaprodi.users.mahasiswa') }}" class="quick-action-btn">
                        <span class="material-symbols-outlined">manage_accounts</span>
                        Monitoring Mahasiswa
                    </a>
                    <a href="{{ route('kaprodi.activity.index') }}" class="quick-action-btn">
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

        {{-- ═══ Charts Section ═══ --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Upload Trend --}}
            <div class="lg:col-span-2 bg-white border border-gray-200 rounded-[9px] shadow-md overflow-hidden">
                <div class="flex items-start justify-between px-6 py-5 border-b border-gray-100">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">
                            Tren Upload Dokumen
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Aktivitas unggahan dokumen selama tahun {{ date('Y') }}
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-violet-50 flex items-center justify-center border border-violet-100">
                        <span class="material-symbols-outlined text-violet-500 !text-[20px]">
                            monitoring
                        </span>
                    </div>
                </div>
                {{-- Chart --}}
                <div class="p-6">
                    <div class="h-[340px]">
                        <canvas id="uploadChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Category Distribution --}}
            <div class="bg-white border border-gray-200 rounded-[9px] shadow-md overflow-hidden">
                <div class="flex items-start justify-between px-6 py-5 border-b border-gray-100">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">
                            Kategori Dokumen
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Distribusi berdasarkan kategori
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center border border-indigo-100">
                        <span class="material-symbols-outlined text-indigo-500 !text-[20px]">
                            donut_large
                        </span>
                    </div>
                </div>
                {{-- Content --}}
                <div class="p-6">
                    @if ($categories->sum('documents_count') > 0)
                        <div class="relative h-[320px] flex items-center justify-center">
                            <canvas id="categoryChart"></canvas>
                            {{-- Center Stats --}}
                            <div class="absolute flex flex-col items-center pointer-events-none">
                                <span class="text-4xl font-bold tracking-tight text-gray-900">
                                    {{ $categories->sum('documents_count') }}
                                </span>
                                <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Dokumen
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-14 text-center">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-gray-300">
                                    donut_large
                                </span>
                            </div>
                            <p class="mt-4 text-sm font-medium text-gray-500">
                                Belum ada data kategori
                            </p>
                            <p class="mt-1 text-xs text-gray-400">
                                Data akan muncul setelah dokumen diunggah
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- ═══ Bottom Row: Dokumen Terbaru + Activity Feed ═══ --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Dokumen Terbaru --}}
            <div class="lg:col-span-2 bg-white border border-gray-200 rounded-[9px] shadow-md overflow-hidden">

                {{-- Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full border border-blue-200 bg-blue-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600 !text-[18px]">
                                description
                            </span>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-gray-900">
                                Dokumen Terbaru
                            </h2>
                            <p class="text-xs text-gray-500 mt-0.5">
                                5 dokumen terakhir yang diunggah
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('kaprodi.documents.index') }}"
                        class="inline-flex items-center gap-1 px-3 py-2 text-xs font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        Lihat Semua
                        <span class="material-symbols-outlined !text-[14px]">
                            subdirectory_arrow_right
                        </span>
                    </a>
                </div>

                @if ($latestDocuments->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 px-6">
                        <div class="w-14 h-14 rounded-2xl bg-gray-50 border border-gray-200 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-gray-400">
                                folder_open
                            </span>
                        </div>
                        <h3 class="text-sm font-medium text-gray-700">
                            Belum ada dokumen
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">
                            Dokumen yang diunggah mahasiswa akan muncul di sini
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100 bg-gray-50/50 text-[11px] uppercase tracking-wider text-gray-500">
                                    <th class="px-6 py-3 text-left font-medium w-14">
                                        No
                                    </th>
                                    <th class="px-6 py-3 text-left font-medium">
                                        Dokumen
                                    </th>
                                    <th class="px-6 py-3 text-left font-medium">
                                        Kategori
                                    </th>
                                    <th class="px-6 py-3 text-left font-medium">
                                        Pemilik
                                    </th>
                                    <th class="px-6 py-3 text-left font-medium">
                                        Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($latestDocuments as $i => $doc)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="text-xs text-gray-400 font-mono">
                                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-9 h-9 rounded-md border border-red-200 bg-red-50 flex items-center justify-center flex-shrink-0">
                                                    <span class="material-symbols-outlined text-red-500 !text-[18px]">
                                                        article
                                                    </span>
                                                </div>

                                                <div class="min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate"
                                                        title="{{ $doc->title }}">
                                                        {{ $doc->title }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-0.5">
                                                        Dokumen Akademik
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($doc->category)
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-slate-700 text-xs font-medium">
                                                    {{ $doc->category->name }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 bg-gray-50 text-gray-400 text-xs">
                                                    Tidak Ada
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700 
                                                    border border-amber-300 flex items-center justify-center flex-shrink-0">
                                                    <span class="text-xs font-semibold">
                                                        {{ strtoupper(substr($doc->user?->name ?? '?', 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">
                                                        {{ $doc->user?->name ?? 'Unknown User' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        Pemilik Dokumen
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-[12.5px] text-gray-500">
                                                {{ $doc->created_at->format('d M Y') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Activity Feed --}}
            <div class="bg-white border border-gray-200 rounded-[9px] shadow-md overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-900">
                                Aktivitas Terbaru
                            </h2>
                            <p class="text-xs text-gray-500 mt-0.5">
                                5 Dokumen yang baru diproses
                            </p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-green-50 border border-green-200 flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-600 !text-[18px]">
                                timeline
                            </span>
                        </div>
                    </div>
                </div>
                @if ($latestDocuments->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 px-6">
                        <div class="w-12 h-12 rounded-full border border-green-200 bg-green-50 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-green-600">
                                timeline
                            </span>
                        </div>
                        <p class="text-sm font-medium text-gray-700">
                            Belum ada aktivitas
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Aktivitas dokumen akan muncul di sini
                        </p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($latestDocuments as $doc)
                            <div class="px-6 py-4 hover:bg-gray-50 transition">
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-gray-500 !text-[16px]">
                                            upload_file
                                        </span>
                                    </div>

                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">
                                            {{ $doc->title }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $doc->user?->name ?? 'Unknown' }}
                                            <span class="mx-1 text-gray-300">•</span>
                                            {{ $doc->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-4 border-t border-gray-100">

                        <a href="/"
                            class="flex items-center justify-center gap-2 w-full px-4 py-2.5 text-xs font-medium text-gray-700 border border-gray-200 rounded-xl hover:bg-gray-50 transition">

                            <span class="material-symbols-outlined !text-[14px]">
                                list
                            </span>

                            Lihat Semua Aktivitas

                        </a>

                    </div>

                @endif

            </div>

        </div>
    </div>

    {{-- ═══ SCRIPTS ═══ --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        /* ─────────────────────────────
                        Pastel Palette (GitHub Style)
                    ───────────────────────────── */
        const COLORS = [
            '#c4b5fd',
            '#ddd6fe',
            '#a5b4fc',
            '#bfdbfe',
            '#bae6fd',
            '#bbf7d0',
            '#fde68a',
            '#fecdd3',
            '#fdba74',
            '#d9f99d'
        ];

        /* ─────────────────────────────
            Upload Trend Chart
        ───────────────────────────── */
        (function() {
            const canvas = document.getElementById('uploadChart');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 260);
            gradient.addColorStop(0, 'rgba(168, 85, 247, 0.20)');
            gradient.addColorStop(1, 'rgba(168, 85, 247, 0)');

            const rawData = @json(array_values($monthlyUploads->toArray()));

            const data = Array.from({
                length: 12
            }, (_, i) => rawData[i] ?? 0);

            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                    ],
                    datasets: [{
                        data,
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: '#a855f7',
                        borderWidth: 2.5,
                        tension: 0.45,

                        pointRadius: 3,
                        pointHoverRadius: 6,

                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#a855f7',
                        pointBorderWidth: 2,

                        pointHoverBackgroundColor: '#a855f7',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,

                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },

                    plugins: {
                        legend: {
                            display: false
                        },

                        tooltip: {
                            backgroundColor: '#111827',
                            titleColor: '#ffffff',
                            bodyColor: '#e5e7eb',
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: false,

                            callbacks: {
                                label: ctx => `${ctx.parsed.y} dokumen`
                            }
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,

                            ticks: {
                                precision: 0,
                                color: '#9ca3af',
                                font: {
                                    size: 11
                                }
                            },

                            border: {
                                display: false
                            },

                            grid: {
                                color: 'rgba(107,114,128,0.08)',
                                drawBorder: false
                            }
                        },

                        x: {
                            ticks: {
                                color: '#9ca3af',
                                font: {
                                    size: 11
                                }
                            },

                            border: {
                                display: false
                            },

                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        })();

        /* ─────────────────────────────
            Category Doughnut Chart
        ───────────────────────────── */
        (function() {
            const canvas = document.getElementById('categoryChart');
            if (!canvas) return;

            new Chart(canvas, {
                type: 'doughnut',
                data: {
                    labels: @json($categories->pluck('name')),
                    datasets: [{
                        data: @json($categories->pluck('documents_count')),
                        backgroundColor: COLORS,
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '78%',

                    plugins: {
                        legend: {
                            display: false
                        },

                        tooltip: {
                            backgroundColor: '#111827',
                            titleColor: '#ffffff',
                            bodyColor: '#e5e7eb',
                            padding: 12,
                            cornerRadius: 10,

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

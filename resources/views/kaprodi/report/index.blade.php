@extends('kaprodi.layouts.app')
@section('title', 'Laporan & Statistik')

@push('styles')
<style>
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
        --shadow-card-hover: 0 4px 16px rgba(0,0,0,.08);
        --transition: all .18s cubic-bezier(.4,0,.2,1);
    }
    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-card);
        transition: var(--transition);
    }
    .card:hover { box-shadow: var(--shadow-card-hover); }

    /* Stat Cards */
    .stat-card { cursor: default; overflow: hidden; position: relative; }
    .stat-card:hover { transform: translateY(-2px); }
    .icon-wrap {
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .stat-label { font-size: 11.5px; font-weight: 500; letter-spacing: .02em; color: var(--text-secondary); }
    .stat-value { font-size: 28px; font-weight: 700; letter-spacing: -.03em; color: var(--text-primary); line-height: 1.1; }
    .stat-badge {
        display: inline-flex; align-items: center; gap: 3px;
        font-size: 10.5px; font-weight: 500; padding: 2px 8px;
        border-radius: 99px; border: 1px solid;
    }

    /* Chart Card */
    .chart-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-card); box-shadow: var(--shadow-card); overflow: hidden; transition: var(--transition); }
    .chart-card:hover { box-shadow: var(--shadow-card-hover); }
    .chart-card-header { padding: 16px 20px 14px; border-bottom: 1px solid var(--border); }
    .chart-card-body { padding: 18px 20px; }

    /* Table */
    .data-table thead th {
        font-size: 11px; font-weight: 600; text-transform: uppercase;
        letter-spacing: .06em; color: var(--text-muted); padding: 10px 16px;
        background: var(--surface-subtle); border-bottom: 1px solid var(--border);
    }
    .data-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background .12s ease; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table tbody td { padding: 11px 16px; font-size: 13.5px; color: #374151; }

    .badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 2.5px 9px; border-radius: 6px;
        font-size: 11.5px; font-weight: 500; border: 1px solid;
    }
    .badge-blue { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
    .badge-gray { background:#f9fafb; color:#4b5563; border-color:#e5e7eb; }
</style>
@endpush

@section('content')
<div class="space-y-6 pb-6">

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-1.5">
                <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                <span>Kaprodi</span>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <span class="text-gray-600 font-medium">Laporan & Statistik</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Laporan & Statistik</h1>
            <p class="text-sm text-gray-400 mt-0.5">Ringkasan data dan analitik repositori dokumen akademik</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <span class="text-xs text-gray-400 bg-white border border-gray-200 rounded-lg px-3 py-2 flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined !text-[14px] text-gray-400">event</span>
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

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

    {{-- ═══ CHARTS ═══ --}}
    <div class="grid lg:grid-cols-2 gap-4">

        {{-- Line Chart --}}
        <div class="chart-card">
            <div class="chart-card-header flex items-center justify-between">
                <div>
                    <h2 class="text-[13.5px] font-semibold text-gray-800">Tren Upload Dokumen</h2>
                    <p class="text-[11.5px] text-gray-400 mt-0.5">Unggahan bulanan — {{ date('Y') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1.5 text-[11px] text-gray-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span>Upload
                    </span>
                    <div class="icon-wrap bg-amber-50 border border-amber-100">
                        <span class="material-symbols-outlined text-amber-500 !text-[16px]">show_chart</span>
                    </div>
                </div>
            </div>
            <div class="chart-card-body">
                <canvas id="uploadChart" height="120"></canvas>
            </div>
        </div>

        {{-- Bar Chart --}}
        <div class="chart-card">
            <div class="chart-card-header flex items-center justify-between">
                <div>
                    <h2 class="text-[13.5px] font-semibold text-gray-800">Dokumen per Kategori</h2>
                    <p class="text-[11.5px] text-gray-400 mt-0.5">Distribusi total dokumen</p>
                </div>
                <div class="icon-wrap bg-blue-50 border border-blue-100">
                    <span class="material-symbols-outlined text-blue-500 !text-[16px]">bar_chart</span>
                </div>
            </div>
            <div class="chart-card-body">
                <canvas id="categoryChart" height="120"></canvas>
            </div>
        </div>
    </div>

    {{-- ═══ DOKUMEN TERBARU + EXPORT ═══ --}}
    <div class="grid lg:grid-cols-3 gap-4">

        {{-- Table --}}
        <div class="chart-card lg:col-span-2">
            <div class="chart-card-header flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="icon-wrap bg-gray-100 border border-gray-200" style="width:34px;height:34px;border-radius:8px;">
                        <span class="material-symbols-outlined text-gray-500 !text-[16px]">folder_open</span>
                    </div>
                    <div>
                        <h2 class="text-[13.5px] font-semibold text-gray-800">Dokumen Terbaru</h2>
                        <p class="text-[11.5px] text-gray-400">5 dokumen terakhir diunggah</p>
                    </div>
                </div>
                <a href="{{ route('kaprodi.documents.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg border border-blue-100 transition">
                    Lihat Semua
                    <span class="material-symbols-outlined !text-[13px]">arrow_forward</span>
                </a>
            </div>
            @if($latestDocuments->isEmpty())
                <div class="flex flex-col items-center gap-2 py-12 text-center">
                    <div class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                        <span class="material-symbols-outlined text-gray-300 !text-[20px]">folder_off</span>
                    </div>
                    <p class="text-sm text-gray-400">Belum ada dokumen</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full data-table">
                        <thead>
                            <tr>
                                <th class="text-left">Judul</th>
                                <th class="text-left">Kategori</th>
                                <th class="text-left">Pemilik</th>
                                <th class="text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestDocuments as $doc)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-md bg-amber-50 border border-amber-100 flex items-center justify-center flex-shrink-0">
                                                <span class="material-symbols-outlined text-amber-400 !text-[13px]">article</span>
                                            </div>
                                            <span class="font-medium text-gray-800 text-[13px] line-clamp-1 max-w-[200px]">{{ $doc->title }}</span>
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
                                                <span class="text-white text-[9px] font-bold leading-none">{{ strtoupper(substr($doc->user?->name ?? '?', 0, 1)) }}</span>
                                            </div>
                                            <span class="text-[13px] text-gray-600">{{ $doc->user?->name ?? '—' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-xs text-gray-400 whitespace-nowrap">{{ $doc->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Export Panel --}}
        <div class="chart-card">
            <div class="chart-card-header">
                <h2 class="text-[13.5px] font-semibold text-gray-800">Export Data</h2>
                <p class="text-[11.5px] text-gray-400 mt-0.5">Unduh laporan dalam format CSV</p>
            </div>
            <div class="chart-card-body space-y-4">
                <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-emerald-500 !text-[18px]">table_chart</span>
                        <span class="text-sm font-medium text-emerald-800">Laporan CSV</span>
                    </div>
                    <p class="text-xs text-emerald-600 leading-relaxed">
                        Ekspor seluruh data statistik dokumen, mahasiswa, dosen, dan aktivitas download ke format CSV.
                    </p>
                </div>

                <div class="space-y-2 text-xs text-gray-500">
                    @foreach(['Data dokumen (judul, kategori, pengunggah)', 'Data mahasiswa & dosen', 'Statistik download per dokumen', 'Rekap bulanan upload'] as $item)
                        <div class="flex items-start gap-1.5">
                            <span class="material-symbols-outlined !text-[12px] text-emerald-400 mt-0.5 flex-shrink-0">check_circle</span>
                            {{ $item }}
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('kaprodi.report.export') }}"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                    <span class="material-symbols-outlined !text-[16px]">download</span>
                    Export CSV
                </a>

                <p class="text-[10.5px] text-gray-400 text-center">
                    Data terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
                </p>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const COLORS = ['#3b82f6','#f59e0b','#10b981','#8b5cf6','#ef4444','#ec4899','#f97316'];

    /* ─── Upload Line Chart ─── */
    (function () {
        const canvas = document.getElementById('uploadChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const grad = ctx.createLinearGradient(0, 0, 0, 260);
        grad.addColorStop(0, 'rgba(245,158,11,.18)');
        grad.addColorStop(1, 'rgba(245,158,11,0)');
        const raw = @json(array_values($monthlyUploads->toArray()));
        const data = Array.from({ length: 12 }, (_, i) => raw[i] ?? 0);
        new Chart(canvas, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{ label:'Upload', data, fill:true, backgroundColor:grad,
                    borderColor:'#f59e0b', borderWidth:2, pointRadius:3.5,
                    pointBackgroundColor:'#fff', pointBorderColor:'#f59e0b',
                    pointBorderWidth:2, pointHoverRadius:6, pointHoverBackgroundColor:'#f59e0b', tension:.42 }]
            },
            options: {
                responsive:true, maintainAspectRatio:true,
                plugins: {
                    legend:{display:false},
                    tooltip:{ backgroundColor:'#111827', titleFont:{size:12,weight:'600'},
                        bodyFont:{size:11}, padding:10, cornerRadius:8, displayColors:false,
                        callbacks:{ label: c => `${c.parsed.y} dokumen` } }
                },
                scales: {
                    y:{ beginAtZero:true, ticks:{precision:0, font:{size:11}, color:'#9ca3af'}, grid:{color:'rgba(0,0,0,.04)', drawBorder:false} },
                    x:{ ticks:{font:{size:11}, color:'#9ca3af'}, grid:{display:false} }
                }
            }
        });
    })();

    /* ─── Category Bar Chart ─── */
    (function () {
        const canvas = document.getElementById('categoryChart');
        if (!canvas) return;
        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: @json($categories->pluck('name')),
                datasets: [{
                    label: 'Dokumen',
                    data: @json($categories->pluck('documents_count')),
                    backgroundColor: COLORS,
                    borderRadius: 6,
                    borderSkipped: false,
                    maxBarThickness: 36
                }]
            },
            options: {
                responsive:true, maintainAspectRatio:true,
                plugins: {
                    legend:{display:false},
                    tooltip:{ backgroundColor:'#111827', titleFont:{size:12,weight:'600'},
                        bodyFont:{size:11}, padding:10, cornerRadius:8, displayColors:false,
                        callbacks:{ label: c => `${c.parsed.y} dokumen` } }
                },
                scales: {
                    y:{ beginAtZero:true, ticks:{precision:0, font:{size:11}, color:'#9ca3af'}, grid:{color:'rgba(0,0,0,.04)', drawBorder:false} },
                    x:{ ticks:{font:{size:11}, color:'#9ca3af', maxRotation:30}, grid:{display:false} }
                }
            }
        });
    })();
</script>
@endsection

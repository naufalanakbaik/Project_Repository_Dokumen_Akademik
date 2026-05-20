@extends('kaprodi.layouts.app')
@section('title', 'Laporan & Statistik')

@push('styles')
    <style>
        .report-stat {
            position: relative;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .report-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px -5px rgba(0, 0, 0, .08);
        }

        .report-stat::after {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            opacity: .08;
        }

        .report-stat.amber::after {
            background: #f59e0b;
        }

        .report-stat.blue::after {
            background: #3b82f6;
        }

        .report-stat.emerald::after {
            background: #10b981;
        }

        .report-stat.violet::after {
            background: #8b5cf6;
        }

        .report-stat .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chart-panel {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 24px;
            transition: box-shadow .2s ease;
        }

        .chart-panel:hover {
            box-shadow: 0 6px 20px -4px rgba(0, 0, 0, .06);
        }

        .report-tbl thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #6b7280;
        }

        .report-tbl tbody tr {
            transition: background .15s ease;
        }

        .report-tbl tbody tr:hover {
            background: #f9fafb;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-7">

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-xl border border-gray-200/80 bg-white px-6 py-5 mb-6 shadow-sm">
            <div
                class="absolute -top-12 -right-12 w-44 h-44 bg-gradient-to-br from-emerald-200 to-teal-100 rounded-full blur-3xl opacity-30">
            </div>

            <div class="relative flex items-start justify-between gap-5">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 mb-3 rounded-full border border-emerald-200 bg-emerald-50">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[11px] font-semibold tracking-wide uppercase text-emerald-700">Reports &
                            Analytics</span>
                    </div>
                    <h1 class="text-[30px] font-semibold text-gray-900 tracking-tight">Laporan & Statistik Sistem</h1>
                    <p class="text-[13px] text-blue-500 leading-relaxed">Monitoring laporan dokumen akademik program studi</p>
                </div>
                <div
                    class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-emerald-200 bg-emerald-50">
                    <span class="material-symbols-outlined text-emerald-600 !text-[23px]">analytics</span>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-dashed border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Sistem Aktif
                    </div>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <span class="material-symbols-outlined !text-[15px]">calendar_month</span>
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>


        {{-- Statistik Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

            <div class="report-stat amber bg-white rounded-2xl border border-gray-200/80 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-icon bg-amber-50 border border-amber-200">
                        <span class="material-symbols-outlined text-amber-600 !text-[20px]">description</span>
                    </div>
                    <span class="material-symbols-outlined text-amber-300 !text-[20px]">trending_up</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalDocuments }}</h3>
                <p class="text-xs text-gray-500 mt-1">Total Dokumen</p>
            </div>

            <div class="report-stat blue bg-white rounded-2xl border border-gray-200/80 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-icon bg-blue-50 border border-blue-200">
                        <span class="material-symbols-outlined text-blue-600 !text-[20px]">school</span>
                    </div>
                    <span class="material-symbols-outlined text-blue-300 !text-[20px]">group</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalMahasiswa }}</h3>
                <p class="text-xs text-gray-500 mt-1">Mahasiswa</p>
            </div>

            <div class="report-stat emerald bg-white rounded-2xl border border-gray-200/80 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-icon bg-emerald-50 border border-emerald-200">
                        <span class="material-symbols-outlined text-emerald-600 !text-[20px]">person</span>
                    </div>
                    <span class="material-symbols-outlined text-emerald-300 !text-[20px]">verified</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalDosen }}</h3>
                <p class="text-xs text-gray-500 mt-1">Dosen</p>
            </div>

            <div class="report-stat violet bg-white rounded-2xl border border-gray-200/80 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-icon bg-violet-50 border border-violet-200">
                        <span class="material-symbols-outlined text-violet-600 !text-[20px]">download</span>
                    </div>
                    <span class="material-symbols-outlined text-violet-300 !text-[20px]">insights</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalDownloads }}</h3>
                <p class="text-xs text-gray-500 mt-1">Download</p>
            </div>
        </div>

        {{-- Charts --}}
        <div class="grid lg:grid-cols-2 gap-6">

            {{-- Line Chart --}}
            <div class="chart-panel">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-[15px] font-semibold text-gray-900">Tren Upload Dokumen</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Aktivitas unggahan bulanan {{ date('Y') }}</p>
                    </div>
                    <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-amber-50 border border-amber-200">
                        <span class="material-symbols-outlined text-amber-600 !text-[18px]">show_chart</span>
                    </div>
                </div>
                <canvas id="uploadChart"></canvas>
            </div>

            {{-- Bar Chart --}}
            <div class="chart-panel">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-[15px] font-semibold text-gray-900">Kategori Dokumen</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Distribusi dokumen per kategori</p>
                    </div>
                    <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 border border-blue-200">
                        <span class="material-symbols-outlined text-blue-600 !text-[18px]">bar_chart</span>
                    </div>
                </div>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        {{-- Dokumen Terbaru --}}
        <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-gray-100">
                        <span class="material-symbols-outlined text-gray-600 !text-[18px]">folder_open</span>
                    </div>
                    <div>
                        <h2 class="text-[15px] font-semibold text-gray-900">Dokumen Terbaru</h2>
                        <p class="text-xs text-gray-400">Dokumen yang baru diunggah</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full report-tbl">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-100">
                            <th class="px-6 py-3 text-left">Judul</th>
                            <th class="px-6 py-3 text-center">Kategori</th>
                            <th class="px-6 py-3 text-center">Pemilik</th>
                            <th class="px-6 py-3 text-center">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($latestDocuments as $doc)
                            <tr>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 flex-shrink-0">
                                            <span
                                                class="material-symbols-outlined text-amber-500 !text-[16px]">article</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800">{{ $doc->title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                        {{ $doc->category?->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-center text-sm text-gray-600">{{ $doc->user?->name }}</td>
                                <td class="px-6 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5 text-sm text-gray-400">
                                        <span class="material-symbols-outlined !text-[14px]">schedule</span>
                                        {{ $doc->created_at->format('d M Y') }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Export Button --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('kaprodi.report.export') }}"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700
                text-white text-sm font-medium shadow-sm hover:shadow-md transition-all duration-200">
                <span class="material-symbols-outlined !text-[18px]">download</span>
                Export CSV
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // ─── Line Chart ───
        const uploadCtx = document.getElementById('uploadChart');
        const gradient = uploadCtx.getContext('2d').createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(245,158,11,.3)');
        gradient.addColorStop(1, 'rgba(245,158,11,0)');

        new Chart(uploadCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Upload',
                    data: @json(array_values($monthlyUploads->toArray())),
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#f59e0b',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f59e0b',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#f59e0b',
                    tension: .4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: {
                            size: 12,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 11
                        },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,.04)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#9ca3af'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });

        // ─── Bar Chart ───
        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: @json($categories->pluck('name')),
                datasets: [{
                    label: 'Dokumen',
                    data: @json($categories->pluck('documents_count')),
                    backgroundColor: ['#3b82f6', '#ef4444', '#f97316', '#eab308', '#10b981', '#8b5cf6',
                        '#ec4899'
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                    maxBarThickness: 40
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: {
                            size: 12,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 11
                        },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,.04)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#9ca3af'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });
    </script>

@endsection

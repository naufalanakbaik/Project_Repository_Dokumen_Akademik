@extends('admin.layouts.app')
@section('title', 'Dashboard Dokumen')


@section('content')

    {{-- Header --}}
    <div class="mb-5">
        <h1 class="text-2xl font-semibold text-gray-950">
            Dashboard Admin
        </h1>
        <p class="text-[13px] text-gray-600 mt-0.5">
            Hai <span class="font-medium text-blue-600">{{ auth()->user()->name }}</span>, berikut ringkasan sistem.
        </p>
    </div>

    {{-- Statistic card --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
        {{-- Total Dokumen --}}
        <div
            class="bg-white border border-green-300 rounded-xl p-5 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-[13px] text-gray-500">Total Dokumen</p>
                <h2 class="text-xl font-semibold text-gray-900 mt-1">
                    {{ $stats['total_documents'] }}
                </h2>
            </div>
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-green-50 border border-green-300 hover:bg-green-100 cursor-pointer transition">
                <span class="material-icons !text-xl text-green-600">description</span>
            </div>
        </div>

        {{-- Total User --}}
        <div
            class="bg-white border border-blue-300 rounded-xl p-5 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-[13px] text-gray-500">Total Pengguna</p>
                <h2 class="text-xl font-semibold text-gray-900 mt-1">
                    {{ $stats['total_users'] }}
                </h2>
            </div>
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-blue-50 border border-blue-300  hover:bg-blue-100 cursor-pointer transition">
                <span class="material-icons !text-xl text-blue-600">groups</span>
            </div>
        </div>

        {{-- Upload --}}
        <div
            class="bg-white border border-yellow-300 rounded-xl p-5 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-[13px] text-gray-500">Total Upload</p>
                <h2 class="text-xl font-semibold text-gray-900 mt-1">
                    {{ $stats['total_uploads'] }}
                </h2>
            </div>
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-yellow-50 border border-yellow-300  hover:bg-yellow-100 cursor-pointer transition">
                <span class="material-icons !text-xl text-yellow-600">upload_file</span>
            </div>
        </div>

        {{-- Download --}}
        <div
            class="bg-white border border-red-300 rounded-xl p-5 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-[13px] text-gray-500">Total Unduh</p>
                <h2 class="text-xl font-semibold text-gray-900 mt-1">
                    {{ $stats['total_downloads'] }}
                </h2>
            </div>
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-red-50 border border-red-300  hover:bg-red-100 cursor-pointer transition">
                <span class="material-icons !text-xl text-red-600">download</span>
            </div>
        </div>
    </div>

    {{-- Summary aktiviats bulanan dan status distribusi --}}
    <div class="mb-6 bg-white border border-gray-300 rounded-lg shadow-sm p-5">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-sm font-semibold text-gray-800">
                    Ringkasan Dokumen
                </h2>
                <p class="text-[12px] text-gray-400 mt-0.5">
                    Statistik singkat aktivitas dokumen dalam sistem
                </p>
            </div>

            <span class="text-xs px-2.5 py-1 bg-gray-50 border border-gray-300 rounded-md text-gray-500">
                Updated just now
            </span>
        </div>

        {{-- Information content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Left: Aktivitas bulanan --}}
            <div class="space-y-3">

                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-500">Aktivitas Bulan Ini</p>
                    <span class="text-xs text-blue-600 font-medium">Realtime</span>
                </div>

                <div class="flex items-end gap-6">
                    <div>
                        <p class="text-[11px] text-gray-400">Upload</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $monthUploads ?? 0 }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] text-gray-400">Total</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $totalUploads ?? 0 }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] text-gray-400">Rata-rata</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $avgUploads ?? 0 }}
                        </p>
                    </div>
                </div>

                {{-- Mini progress --}}
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-blue-600 h-1.5 rounded-full"
                        style="width: {{ $totalUploads > 0 ? ($monthUploads / $totalUploads) * 100 : 0 }}%">
                    </div>
                </div>
            </div>

            {{-- Right: Status distribution --}}
            <div class="space-y-3">

                <p class="text-xs text-gray-500">
                    Distribusi Status Dokumen
                </p>

                {{-- Approved --}}
                <div>
                    <div class="flex justify-between text-[12px] mb-1">
                        <span class="text-gray-600">Approved</span>
                        <span class="text-gray-800 font-medium">
                            {{ $documentStatus['approved'] }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        <div class="bg-green-500 h-1.5 rounded-full"
                            style="width: {{ $stats['total_documents'] > 0 ? ($documentStatus['approved'] / $stats['total_documents']) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>

                {{-- Pending --}}
                <div>
                    <div class="flex justify-between text-[12px] mb-1">
                        <span class="text-gray-600">Pending</span>
                        <span class="text-gray-800 font-medium">
                            {{ $documentStatus['pending'] }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        <div class="bg-yellow-400 h-1.5 rounded-full"
                            style="width: {{ $stats['total_documents'] > 0 ? ($documentStatus['pending'] / $stats['total_documents']) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>

                {{-- Rejected --}}
                <div>
                    <div class="flex justify-between text-[12px] mb-1">
                        <span class="text-gray-600">Rejected</span>
                        <span class="text-gray-800 font-medium">
                            {{ $documentStatus['rejected'] }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        <div class="bg-red-400 h-1.5 rounded-full"
                            style="width: {{ $stats['total_documents'] > 0 ? ($documentStatus['rejected'] / $stats['total_documents']) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Analytics-->
    <div class="mb-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Upload Dokumen per Bulan (Tahun Ini vs Tahun Lalu) -->
        <div class="lg:col-span-2 bg-white border border-gray-300 rounded-lg p-5 shadow-sm">

            <!-- Upload per Bulan -->
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800">
                        Upload Dokumen per Bulan
                    </h2>
                    <p class="text-[12px] text-gray-400 mt-0.5">
                        Perbandingan tahun ini dan tahun lalu
                    </p>
                </div>
                <span class="text-xs px-2.5 py-1.5 bg-gray-50 rounded-lg border border-gray-300 text-gray-500">
                    12 bulan terakhir
                </span>
            </div>

            <!-- Mini stats -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                    <p class="text-xs text-gray-400">Total Upload</p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{-- {{ $totalUploads }} --}}
                    </p>
                </div>
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                    <p class="text-xs text-gray-400">This Month</p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{-- {{ $monthUploads }} --}}
                    </p>
                </div>
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                    <p class="text-xs text-gray-400">Average</p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{-- {{ $avgUploads }} --}}
                    </p>
                </div>
            </div>

            <!-- Line chart -->
            <div class="h-[280px]">
                <canvas id="uploadChart"></canvas>
            </div>
        </div>

        <!-- Distribusi Approved -->
        <div class="bg-white border border-gray-300 rounded-lg p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800">
                        Status Dokumen
                    </h2>
                    <p class="text-[12px] text-gray-400 mt-0.5">
                        Distribusi berdasarkan status dokumen
                    </p>
                </div>
            </div>

            <!-- Optional mini info (biar balance) -->
            <div class="grid grid-cols-3 gap-3 mb-3">
                <div class="bg-green-50 border border-green-300 rounded-md py-1 px-1 text-center">
                    <p class="text-[10px] text-gray-700">Approved</p>
                    <p class="text-sm font-semibold text-green-600">
                        {{ $documentStatus['approved'] }}
                    </p>
                </div>
                <div class="bg-yellow-50 border border-yellow-300 rounded-md py-1 px-1 text-center">
                    <p class="text-[10px] text-gray-700">Pending</p>
                    <p class="text-sm font-semibold text-yellow-600">
                        {{ $documentStatus['pending'] }}
                    </p>
                </div>
                <div class="bg-red-50 border border-red-300 rounded-md py-1 px-1 text-center">
                    <p class="text-[10px] text-gray-700">Rejected</p>
                    <p class="text-sm font-semibold text-red-600">
                        {{ $documentStatus['rejected'] }}
                    </p>
                </div>
            </div>

            <!-- Chart -->
            <div class="p-1.5">
                <div class="h-[280px] flex items-center justify-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Downlaod dan distribusi jenis dokumen --}}
    <div class="mb-6 bg-white border border-gray-300 rounded-lg shadow-sm p-5">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-sm font-semibold text-gray-800">
                    Aktivitas Download Dokumen
                </h2>
                <p class="text-[12px] text-gray-400 mt-0.5">
                    Ringkasan download dan distribusi jenis dokumen
                </p>
            </div>

            <span class="text-xs px-2.5 py-1 bg-gray-50 border border-gray-300 rounded-md text-gray-500">
                12 bulan terakhir
            </span>
        </div>

        {{-- Information content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Left: Total Download --}}
            <div class="space-y-3">

                <p class="text-xs text-gray-500">Aktivitas Download</p>

                <div class="flex items-end gap-6">
                    <div>
                        <p class="text-[11px] text-gray-400">Total</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $totalDownloads ?? 0 }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] text-gray-400">Bulan Ini</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $monthDownloads ?? 0 }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] text-gray-400">Rata-rata</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $avgDownloads ?? 0 }}
                        </p>
                    </div>
                </div>

                {{-- Mini progres --}}
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-indigo-600 h-1.5 rounded-full"
                        style="width: {{ $totalDownloads > 0 ? ($monthDownloads / $totalDownloads) * 100 : 0 }}%">
                    </div>
                </div>
            </div>

            {{-- Right: Distribudsi kategori --}}
            <div class="space-y-3">

                <p class="text-xs text-gray-500">
                    Distribusi Jenis Dokumen
                </p>

                @foreach ($categoryDistribution as $cat)
                    <div>
                        <div class="flex justify-between text-[12px] mb-1">
                            <span class="text-gray-600">{{ $cat->name }}</span>
                            <span class="text-gray-800 font-medium">
                                {{ $cat->documents_count }}
                            </span>
                        </div>

                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-gray-700 h-1.5 rounded-full"
                                style="width: {{ $stats['total_documents'] > 0 ? ($cat->documents_count / $stats['total_documents']) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>

    <!-- Analytics-->
    <div class="mb-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Distribusi Kategori -->
        <div class="bg-white border border-gray-300 rounded-lg p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800">
                        Distribusi Jenis Dokumen
                    </h2>
                    <p class="text-[12px] text-gray-400 mt-0.5">
                        Jumlah dokumen berdasarkan kategori
                    </p>
                </div>
            </div>

            <!-- Chart -->
            <div class="p-1.5">
                <div class="h-[280px] flex items-center justify-center">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Download per Bulan -->
        <div class="lg:col-span-2 bg-white border border-gray-300 rounded-lg p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800">
                        Tren Download per Bulan
                    </h2>
                    <p class="text-[12px] text-gray-400 mt-0.5">
                        Total download dokumen selama tahun ini
                    </p>
                </div>
                <span class="text-xs px-2.5 py-1.5 bg-gray-50 rounded-lg border border-gray-300 text-gray-500">
                    12 bulan terakhir
                </span>
            </div>

            <!-- Line chart -->
            <div class="h-[280px]">
                <canvas id="downloadChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Insight table dowload dok terbaru & aktivitas terbaru user --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Table downlaod dokumen terbaru --}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
            <div class="px-5 py-3 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800">
                    Dokumen Terbaru
                </h3>
                <span class="text-xs text-gray-400">
                    7 data terakhir
                </span>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse ($latestDocuments as $doc)
                    <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition">
                        {{-- Left --}}
                        <div class="flex flex-col max-w-[75%]">
                            <span class="text-sm text-gray-800 truncate font-medium capitalize">
                                {{ $doc->title }}
                            </span>
                            <span class="text-[11px] text-gray-400 mt-0.5">
                                {{ $doc->category->name ?? 'Tanpa Kategori' }}
                            </span>
                        </div>
                        {{-- Right --}}
                        <span class="text-[11px] text-gray-400 whitespace-nowrap">
                            {{ $doc->created_at->diffForHumans() }}
                        </span>
                    </div>
                @empty
                    <div class="px-5 py-6 text-center text-sm text-gray-400">
                        Belum ada dokumen
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Table aktivitas terbaru --}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
            <div class="px-5 py-3 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800">
                    Aktivitas Terbaru
                </h3>
                <span class="text-xs text-gray-400">
                    5 aktivitas terakhir
                </span>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse ($recentActivities as $act)
                    <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition">
                        {{-- Left --}}
                        <div class="flex flex-col max-w-[75%]">
                            <span class="text-sm text-gray-800">
                                <span class="font-medium">
                                    {{ $act->user->name ?? 'System' }}
                                </span>
                                <span class="pl-1 text-[13px] text-gray-600 capitalize">
                                    &RightArrowBar; {{ $act->action }}
                                </span>
                            </span>
                            <span class="text-[11px] text-gray-400 mt-0.5 uppercase">
                                {{ $act->document->title ?? 'Dokumen' }}
                            </span>
                        </div>

                        {{-- Right --}}
                        <span class="text-[11px] text-gray-400 whitespace-nowrap">
                            {{ $act->created_at->diffForHumans() }}
                        </span>
                    </div>
                @empty
                    <div class="px-5 py-6 text-center text-sm text-gray-400">
                        Belum ada aktivitas
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // =====================================================
        // Data dari Laravel
        // =====================================================
        const monthlyUploads = @json($monthlyUploads);
        const documentStatus = @json($documentStatus);
        const categoryChart = @json($categoryChart);
        const monthlyDownloads = @json($monthlyDownloads);

        // Label bulan (konsisten untuk semua chart)
        const monthLabels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        // Deteksi dark mode (untuk styling tooltip & grid)
        const isDark = document.documentElement.classList.contains('dark');

        // =====================================================
        // Global Style Chart.js (biar konsisten semua chart)
        // =====================================================
        Chart.defaults.font.family = 'Inter, sans-serif';
        Chart.defaults.color = '#64748B';
    </script>

    {{-- Line chart -> Upload Dokumen perBulan (Tahun Ini vs Tahun Lalu) --}}
    <script>
        // =====================================================
        // Chart Upload Dokumen (Refined - Purple & Red Theme)
        // =====================================================

        const uploadCtx = document.getElementById('uploadChart').getContext('2d');

        // =====================================================
        // Gradient UNGU (Primary - Tahun Ini)
        // =====================================================
        const gradientPurple = uploadCtx.createLinearGradient(0, 0, 0, 280);
        gradientPurple.addColorStop(0, "rgba(139, 92, 246, 0.30)");
        gradientPurple.addColorStop(1, "rgba(139, 92, 246, 0.02)");

        new Chart(uploadCtx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                        // =============================
                        // DATA TAHUN INI (PRIMARY)
                        // =============================
                        label: 'Tahun Ini',
                        data: monthlyUploads.this_year,

                        borderColor: '#8B5CF6', // ungu solid
                        backgroundColor: gradientPurple,

                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,

                        // Titik lebih subtle
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#8B5CF6',
                        pointBorderColor: '#fff'
                    },
                    {
                        // =============================
                        // DATA TAHUN LALU (SECONDARY)
                        // =============================
                        label: 'Tahun Lalu',
                        data: monthlyUploads.last_year,

                        borderColor: '#EF4444', // merah
                        borderWidth: 2,
                        borderDash: [6, 6],
                        tension: 0.4,
                        fill: false,

                        pointRadius: 2.5,
                        pointHoverRadius: 4,
                        pointBackgroundColor: '#EF4444',
                        pointBorderColor: '#fff'
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                // =================================================
                // Interaksi hover (smooth tracking)
                // =================================================
                interaction: {
                    mode: 'index',
                    intersect: false
                },

                plugins: {
                    // Legend disembunyikan → UI lebih clean
                    legend: {
                        display: false
                    },

                    // Tooltip modern
                    tooltip: {
                        backgroundColor: isDark ? '#111827' : '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#e5e7eb',
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: isDark ? '#9ca3af' : '#6b7280',
                            font: {
                                size: 11
                            }
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            color: isDark ? '#9ca3af' : '#6b7280',
                            font: {
                                size: 11
                            }
                        },

                        grid: {
                            color: isDark ?
                                'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.05)'
                        }
                    }
                }
            }
        });
    </script>

    {{-- Donut chart -> Distribusi Kategori --}}
    <script>
        // =====================================================
        // Chart Status Dokumen (Ultra Soft + Elegant Border)
        // =====================================================

        const statusCtx = document.getElementById('statusChart');

        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Approved', 'Pending', 'Rejected'],

                datasets: [{
                    data: [
                        documentStatus.approved,
                        documentStatus.pending,
                        documentStatus.rejected,
                    ],

                    // =================================================
                    // Warna SUPER SOFT (lebih calm & tidak mencolok)
                    // =================================================
                    backgroundColor: [
                        '#86EFAC', // soft green
                        '#FDE68A', // soft yellow
                        '#FBCFE8', // very soft pink
                    ],

                    // =================================================
                    // Border lebih halus & premium
                    // =================================================
                    borderColor: '#F8FAFC', // hampir putih (tidak terlalu kontras)
                    borderWidth: 1.5,

                    hoverOffset: 6
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',

                plugins: {
                    // =================================================
                    // LEGEND (RAPI & RINGAN)
                    // =================================================
                    legend: {
                        position: 'bottom',
                        align: 'center',
                        labels: {
                            padding: 12,

                            usePointStyle: true,
                            pointStyle: 'circle',

                            // Ukuran toolip
                            boxWidth: 7,
                            boxHeight: 7,

                            font: {
                                size: 11,
                                weight: '500'
                            },

                            color: '#64748B'
                        }
                    },

                    // =================================================
                    // TOOLTIP (CLEAN & INFORMATIVE)
                    // =================================================
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#e5e7eb',
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false,

                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percent = total ?
                                    ((value / total) * 100).toFixed(1) :
                                    0;

                                return `${context.label}: ${value} (${percent}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // =====================================================
        // Chart Distribusi Kategori
        // =====================================================
        new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(categoryChart),
                datasets: [{
                    data: Object.values(categoryChart),
                    backgroundColor: [
                        '#93C5FD',
                        '#C4B5FD',
                        '#86EFAC',
                        '#FDE68A',
                        '#F9A8D4',
                        '#BFDBFE',
                        '#DDD6FE',
                        '#BBF7D0'
                    ],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    <script>
        // =====================================================
        // Chart Download (Modern Gradient Line)
        // =====================================================
        const downloadCtx = document.getElementById('downloadChart').getContext('2d');

        // Gradient hijau
        const downloadGradient = downloadCtx.createLinearGradient(0, 0, 0, 280);
        downloadGradient.addColorStop(0, "rgba(34, 197, 94, 0.35)");
        downloadGradient.addColorStop(1, "rgba(34, 197, 94, 0.02)");

        new Chart(downloadCtx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Jumlah Download',
                    data: monthlyDownloads,
                    borderColor: '#22c55e',
                    backgroundColor: downloadGradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,

                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#22c55e',
                    pointBorderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    mode: 'index',
                    intersect: false
                },

                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#111827' : '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#e5e7eb',
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: isDark ? '#9ca3af' : '#6b7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: isDark ? '#9ca3af' : '#6b7280'
                        },
                        grid: {
                            color: isDark ?
                                'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.05)'
                        }
                    }
                }
            }
        });
    </script>
@endpush

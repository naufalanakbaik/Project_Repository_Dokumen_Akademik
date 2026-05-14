@extends('mahasiswa.layouts.app')
@section('title', 'Aktivitas Saya')

@section('content')

    {{-- Header + Quick Action --}}
    <section
        class="relative overflow-hidden bg-gradient-to-br from-yellow-50 via-amber-50 to-white border-b border-yellow-100 mb-6">

        {{-- Soft Decoration --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-yellow-200/50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[350px] h-[350px] bg-amber-200/50 rounded-full blur-3xl pointer-events-none">
        </div>

        {{-- Content --}}
        <div class="relative w-full max-w-[77rem] mx-auto px-6 py-16 lg:py-14">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-10">

                {{-- Left --}}
                <div class="w-full max-w-3xl pt-2">
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-300 bg-white/80 backdrop-blur-sm 
                        text-yellow-700 text-sm font-medium shadow-sm mb-6">
                        <span class="material-symbols-outlined !text-[18px] text-yellow-600">
                            auto_stories
                        </span>
                        Repository Akademik Digital
                    </div>

                    {{-- Heading --}}
                    <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold leading-tight tracking-tight text-gray-900">

                        @php
                            $hour = now('Asia/Jakarta')->format('H');
                            if ($hour >= 5 && $hour < 12) {
                                $greeting = 'Selamat Pagi';
                            } elseif ($hour >= 12 && $hour < 15) {
                                $greeting = 'Selamat Siang';
                            } elseif ($hour >= 15 && $hour < 18) {
                                $greeting = 'Selamat Sore';
                            } else {
                                $greeting = 'Selamat Malam';
                            }
                        @endphp

                        {{ $greeting }}
                        <span class="text-amber-700">
                            {{ auth()->user()->name }}
                        </span>
                    </h1>

                    {{-- Description --}}
                    <p class="mt-4 text-xs lg:text-sm leading-relaxed text-gray-600 max-w-2xl">
                        Kelola, upload, dan pantau aktivitas dokumen akademik Anda
                        melalui dashboard repository Program Studi Manajemen Informatika
                        Fakultas Ilmu Komputer Universitas Sriwijaya.
                    </p>

                    {{-- Mini Stats --}}
                    <div class="flex flex-wrap items-center gap-8 mt-6">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-11 h-11 rounded-full bg-white border border-blue-100 shadow-sm flex items-center justify-center text-blue-700">
                                <span class="material-symbols-outlined !text-[20px]">
                                    description
                                </span>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500">
                                    Total Dokumen
                                </p>
                                <h4 class="text-sm font-semibold text-gray-700">
                                    {{ $stats['my_documents'] ?? 0 }}
                                </h4>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-11 h-11 rounded-full bg-white border border-green-100 shadow-sm flex items-center justify-center text-green-700">
                                <span class="material-symbols-outlined !text-[20px]">
                                    verified
                                </span>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500">
                                    Disetujui
                                </p>
                                <h4 class="text-sm font-semibold text-gray-700">
                                    {{ $stats['approved'] ?? 0 }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Info Card --}}
                <div
                    class="relative w-full lg:max-w-sm bg-white/90 backdrop-blur-sm rounded-xl border border-amber-200 shadow-md p-6">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined !text-[22px]">
                                timeline
                            </span>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-500">
                                Aktivitas Repository Saya
                            </p>
                            <h3 class="text-xl font-semibold text-gray-800">
                                Dashboard Mahasiswa
                            </h3>
                            <p class="text-[12.5px] text-gray-600 leading-relaxed mt-1.5">
                                Pantau seluruh aktivitas upload dan download dokumen
                                akademik Anda secara real-time.
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-dashed border-gray-200 my-5"></div>

                    {{-- Info --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-[13px] text-gray-600">
                                <span class="material-symbols-outlined !text-[18px] text-blue-700">
                                    upload
                                </span>
                                Upload Dokumen
                            </div>
                            <span class="text-sm font-semibold text-gray-600">
                                {{ $stats['my_documents'] ?? 0 }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-[13px] text-gray-600">
                                <span class="material-symbols-outlined !text-[18px] text-green-700">
                                    verified
                                </span>
                                Dokumen Disetujui
                            </div>
                            <span class="text-sm font-semibold text-gray-600">
                                {{ $stats['approved'] ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Quick Actions --}}
            <div class="mt-9">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-amber-700">
                        left_click
                    </span>
                    <h3 class="text-[13px] font-semibold text-gray-900 uppercase tracking-wide">
                        Quick Actions
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Upload --}}
                    <a href="{{ route('mahasiswa.documents.create') }}"
                        class="group bg-white border border-gray-200 hover:border-amber-300 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300">
                        <div
                            class="w-12 h-12 rounded-full bg-blue-50 text-blue-700 border border-blue-100 flex items-center justify-center mb-4 
                            group-hover:scale-105 transition">
                            <span class="material-symbols-outlined">
                                upload_file
                            </span>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800">
                            Upload Dokumen
                        </h4>
                        <p class="text-xs text-gray-500 mt-2">
                            Tambahkan dokumen akademik baru ke repository.
                        </p>
                    </a>

                    {{-- Cari Repository --}}
                    <a href="{{ route('mahasiswa.katalog.global') }}"
                        class="group bg-white border border-gray-200 hover:border-amber-300 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300">
                        <div
                            class="w-12 h-12 rounded-full bg-purple-50 text-purple-700 border border-purple-100 flex items-center justify-center mb-4 
                            group-hover:scale-105 transition">
                            <span class="material-symbols-outlined">
                                search
                            </span>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800">
                            Cari Repository
                        </h4>
                        <p class="text-xs text-gray-500 mt-2">
                            Temukan dokumen akademik mahasiswa dan dosen.
                        </p>
                    </a>

                    {{-- Dokumen Saya --}}
                    <a href="{{ route('mahasiswa.documents.index') }}"
                        class="group bg-white border border-gray-200 hover:border-amber-300 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300">
                        <div
                            class="w-12 h-12 rounded-full bg-green-50 text-green-700 border border-green-100 flex items-center justify-center mb-4 
                            group-hover:scale-105 transition">
                            <span class="material-symbols-outlined">
                                folder_managed
                            </span>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800">
                            Dokumen Saya
                        </h4>
                        <p class="text-xs text-gray-500 mt-2">
                            Kelola seluruh dokumen yang telah Anda upload.
                        </p>
                    </a>

                    {{-- Status --}}
                    <a href="{{ route('mahasiswa.documents.index') }}"
                        class="group bg-white border border-gray-200 hover:border-amber-300 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300">
                        <div
                            class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-700 border border-yellow-100 flex items-center justify-center mb-4 
                            group-hover:scale-105 transition">
                            <span class="material-symbols-outlined">
                                pending_actions
                            </span>
                        </div>
                        <h4 class="text-sm font-semibold text-gray-800">
                            Status Validasi
                        </h4>
                        <p class="text-xs text-gray-500 mt-2">
                            Pantau proses validasi dokumen oleh admin.
                        </p>
                    </a>
                </div>
            </div>
        </div>

    </section>

    {{-- Grid Stats --}}
    <section class="w-full max-w-[78rem] mx-auto px-6 mt-10 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

            {{-- Total Dokumen --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute top-0 right-0 w-28 h-28 bg-blue-200 rounded-full blur-3xl opacity-60"></div>

                <div class="relative">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Dokumen
                            </p>
                            <h2 class="mt-2 text-3xl font-semibold text-gray-800">
                                {{ $stats['my_documents'] ?? 0 }}
                            </h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center border border-blue-200">
                            <span class="material-symbols-outlined !text-[24px]">
                                description
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                        Dokumen akademik tersimpan
                    </div>
                </div>
            </div>

            {{-- Approved --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute top-0 right-0 w-28 h-28 bg-green-200 rounded-full blur-3xl opacity-60"></div>

                <div class="relative">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Disetujui
                            </p>
                            <h2 class="mt-2 text-3xl font-semibold text-green-700">
                                {{ $stats['approved'] ?? 0 }}
                            </h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-full bg-green-50 text-green-700 flex items-center justify-center border border-green-200">
                            <span class="material-symbols-outlined !text-[24px]">
                                verified
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                        Dokumen berhasil diverifikasi
                    </div>
                </div>
            </div>

            {{-- Pending --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute top-0 right-0 w-28 h-28 bg-yellow-200 rounded-full blur-3xl opacity-60"></div>

                <div class="relative">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Menunggu
                            </p>
                            <h2 class="mt-2 text-3xl font-semibold text-yellow-600">
                                {{ ($stats['my_documents'] ?? 0) - ($stats['approved'] ?? 0) }}
                            </h2>
                        </div>

                        <div
                            class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-700 flex items-center justify-center border border-yellow-200">
                            <span class="material-symbols-outlined !text-[24px]">
                                schedule
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                        Menunggu validasi admin
                    </div>
                </div>
            </div>

            {{-- Rejected --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute top-0 right-0 w-28 h-28 bg-red-100 rounded-full blur-3xl opacity-60"></div>

                <div class="relative">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Ditolak
                            </p>
                            <h2 class="mt-2 text-3xl font-semibold text-red-600">
                                {{ $stats['rejected'] ?? 0 }}
                            </h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-full bg-red-50 text-red-700 flex items-center justify-center border border-red-200">
                            <span class="material-symbols-outlined !text-[24px]">
                                cancel
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                        Dokumen ditolak admin
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Charts --}}
    <section class="w-full max-w-[78rem] mx-auto px-6 mt-8 mb-6">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Upload Activity --}}
            <div class="xl:col-span-2 relative overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                {{-- Soft Decoration --}}
                <div class="absolute top-0 right-0 w-52 h-52 bg-amber-100/50 rounded-full blur-3xl"></div>
                <div class="relative">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Aktivitas Upload
                            </h3>
                            <p class="text-[13px] text-gray-500 mt-0.5 leading-relaxed">
                                Statistik upload dokumen repository tahun {{ now()->year }}
                            </p>
                        </div>

                        <div
                            class="w-12 h-12 rounded-full bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined">
                                timeline
                            </span>
                        </div>
                    </div>
                    {{-- Chart --}}
                    <div class="h-[320px]">
                        <canvas id="uploadChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Donut Chart --}}
            <div class="relative overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                {{-- Soft Decoration --}}
                <div class="absolute bottom-0 right-0 w-40 h-40 bg-pink-200/50 rounded-full blur-3xl"></div>
                <div class="relative">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Status Dokumen
                            </h3>
                            <p class="text-[13px] text-gray-500 mt-0.5 leading-relaxed">
                                Distribusi validasi dokumen repository.
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 rounded-full bg-rose-50 border border-rose-200 text-rose-700 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined">
                                donut_large
                            </span>
                        </div>
                    </div>
                    {{-- Chart --}}
                    <div class="h-[320px] flex items-center justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Table Activity --}}
    <section class="w-full max-w-[78rem] mx-auto px-6 mb-6">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[18px] text-gray-500">
                            history
                        </span>
                        <h2 class="text-[15px] font-semibold text-gray-900">
                            Aktivitas Terbaru
                        </h2>
                    </div>
                    <p class="text-[13px] text-blue-500 mt-0.5">
                        Riwayat aktivitas upload dan download dokumen repository.
                    </p>
                </div>

                {{-- Action --}}
                <a href="{{ route('mahasiswa.documents.index') }}"
                    class="inline-flex items-center gap-1 px-4 py-2 rounded-lg border border-gray-200 bg-white
                    text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Lihat Semua
                    <span class="material-symbols-outlined !text-[16px]">
                        arrow_right_alt
                    </span>
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">

                    {{-- Table Head --}}
                    <thead class="bg-gray-50/70 border-b border-gray-100">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500">
                                Dokumen
                            </th>
                            <th
                                class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500">
                                Aktivitas
                            </th>
                            <th
                                class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500">
                                Waktu
                            </th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentActivities->where('user_id', auth()->id()) as $log)
                            <tr class="hover:bg-gray-50/70 transition">
                                {{-- Dokumen --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-3">
                                        {{-- Icon --}}
                                        <div
                                            class="w-10 h-10 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[19px] text-gray-600">
                                                description
                                            </span>
                                        </div>

                                        {{-- Content --}}
                                        <div class="min-w-0">
                                            <h3 class="text-sm font-medium text-gray-900 leading-5 line-clamp-1">
                                                {{ $log->document->title ?? 'Dokumen tidak tersedia' }}
                                            </h3>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $log->document->category->name ?? 'Kategori tidak tersedia' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Aktivitas --}}
                                <td class="px-6 py-4">
                                    @if ($log->action == 'upload')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-blue-200 bg-blue-50
                                            text-[11px] font-medium text-blue-700">
                                            <span class="material-symbols-outlined !text-[14px]">
                                                upload
                                            </span>
                                            Upload
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-gray-200 bg-gray-50
                                            text-[11px] font-medium text-gray-700">
                                            <span class="material-symbols-outlined !text-[14px]">
                                                download
                                            </span>
                                            Download
                                        </span>
                                    @endif
                                </td>

                                {{-- Waktu --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $log->created_at->diffForHumans() }}
                                        </span>
                                        <span class="text-xs text-gray-400 mt-0.5">
                                            {{ $log->created_at->format('d M Y • H:i') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-16">
                                    <div class="flex flex-col items-center text-center">
                                        {{-- Icon --}}
                                        <div
                                            class="w-16 h-16 rounded-2xl border border-gray-200 bg-gray-50 flex items-center justify-center mb-4">
                                            <span class="material-symbols-outlined text-gray-400 !text-[34px]">
                                                inbox
                                            </span>
                                        </div>
                                        {{-- Text --}}
                                        <h3 class="text-sm font-semibold text-gray-800">
                                            Belum Ada Aktivitas
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-2 max-w-sm leading-relaxed">
                                            Aktivitas upload dan download dokumen akan muncul di halaman ini.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        /*
            |--------------------------------------------------------------------------
            | Upload Chart
            |--------------------------------------------------------------------------
            */
        const uploadCtx = document.getElementById('uploadChart');

        new Chart(uploadCtx, {
            type: 'line',

            data: {
                labels: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'Mei',
                    'Jun',
                    'Jul',
                    'Agu',
                    'Sep',
                    'Okt',
                    'Nov',
                    'Des'
                ],

                datasets: [{
                    label: 'Upload Dokumen',

                    data: @json($uploadChartData),

                    borderColor: '#F59E0B',

                    backgroundColor: 'rgba(245, 158, 11, 0.12)',

                    fill: true,

                    tension: 0.4,

                    borderWidth: 3,

                    pointRadius: 4,

                    pointHoverRadius: 6,
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            stepSize: 1
                        },

                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Status Chart
        |--------------------------------------------------------------------------
        */
        const statusCtx = document.getElementById('statusChart');

        new Chart(statusCtx, {
            type: 'doughnut',

            data: {
                labels: [
                    'Approved',
                    'Pending',
                    'Rejected'
                ],

                datasets: [{
                    data: @json($statusChartData),

                    backgroundColor: [
                        '#86EFAC',
                        '#FDE68A',
                        '#FDA4AF'
                    ],

                    hoverBackgroundColor: [
                        '#4ADE80',
                        '#FACC15',
                        '#FB7185'
                    ],

                    borderColor: '#ffffff',

                    borderWidth: 6,

                    hoverOffset: 6,
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                cutout: '74%',

                layout: {
                    padding: 10
                },

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,

                            pointStyle: 'circle',

                            padding: 24,

                            color: '#6B7280',

                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    },

                    tooltip: {
                        backgroundColor: '#111827',
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                    }
                }
            }
        });
    </script>
@endpush

@extends('mahasiswa.layouts.app')
@section('title', 'Aktivitas Saya')

@section('content')

    {{-- Header + Quick Action --}}
    <section class="relative overflow-hidden border-b border-yellow-100 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('img/fiks.webp') }}');">

        {{-- Soft Decoration --}}
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-100/70 via-white/50 to-white/10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-300/70 via-transparent to-transparent"></div>

        {{-- Content --}}
        <div class="relative w-full max-w-[77rem] mx-auto px-4 sm:px-6 py-10 lg:py-14">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-8 lg:gap-10">

                {{-- Left --}}
                <div class="w-full max-w-3xl pt-2">
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-yellow-300 bg-white/90 backdrop-blur-md px-5 py-2 
                        text-sm font-semibold text-yellow-700 shadow-[0_8px_30px_rgba(0,0,0,0.08)] mb-7">
                        <span class="material-symbols-outlined text-yellow-600 !text-[18px]">auto_stories</span>
                        Repository Akademik Digital
                    </div>

                    {{-- Heading --}}
                    <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold leading-tight tracking-tight text-gray-950">

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
                        <span class="text-orange-600">
                            {{ auth()->user()->name }}
                        </span>
                    </h1>

                    {{-- Description --}}
                    <p class="mt-4 text-sm lg:text-sm leading-relaxed text-gray-800 font-medium max-w-2xl">
                        Kelola, upload, dan pantau aktivitas dokumen akademik Anda
                        melalui dashboard repository Program Studi Manajemen Informatika
                        Fakultas Ilmu Komputer Universitas Sriwijaya.
                    </p>

                    {{-- Mini Stats --}}
                    <div class="flex flex-wrap items-center gap-4 sm:gap-8 mt-6">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-11 h-11 rounded-full bg-white border border-blue-100 shadow-sm flex items-center justify-center text-blue-700">
                                <span class="material-symbols-outlined !text-[20px]">
                                    description
                                </span>
                            </div>

                            <div>
                                <p class="text-xs font-medium text-gray-800">
                                    Total Dokumen
                                </p>
                                <h4 class="text-sm font-semibold text-gray-800">
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
                                <p class="text-xs font-medium text-gray-800">
                                    Disetujui
                                </p>
                                <h4 class="text-sm font-semibold text-gray-800">
                                    {{ $stats['approved'] ?? 0 }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Info Card --}}
                <div
                    class="relative w-full lg:max-w-sm bg-white backdrop-blur-sm rounded-xl border border-yellow-300 shadow-md p-8">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 border border-amber-200 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined !text-[22px]">
                                timeline
                            </span>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-600">
                                Aktivitas Saya
                            </p>
                            <h3 class="text-xl font-semibold text-gray-800">
                                Dashboard Mahasiswa
                            </h3>
                            <p class="text-[12px] text-gray-600 font-medium leading-relaxed mt-1.5">
                                Pantau seluruh aktivitas upload dan download dokumen
                                akademik Anda secara real-time.
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-dashed border-gray-400 my-5"></div>

                    {{-- Info --}}
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-[12.5px] font-medium text-gray-700">
                                <span class="material-symbols-outlined !text-[19px] text-blue-700">
                                    upload_file
                                </span>
                                Upload Dokumen
                            </div>
                            <span class="text-sm font-semibold text-gray-800">
                                {{ $stats['my_documents'] ?? 0 }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-[12.5px] font-medium text-gray-700">
                                <span class="material-symbols-outlined !text-[19px] text-green-700">
                                    verified
                                </span>
                                Dokumen Disetujui
                            </div>
                            <span class="text-sm font-semibold text-gray-800">
                                {{ $stats['approved'] ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Quick Actions --}}
            <div class="mt-8 lg:mt-9">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center border border-amber-200">
                            <span class="material-symbols-outlined text-[20px]">
                                bolt
                            </span>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-950 tracking-wide">
                                Quick Actions
                            </h3>
                            <p class="text-xs font-medium text-gray-700">
                                Akses fitur utama dengan cepat.
                            </p>
                        </div>
                    </div>
                    <span
                        class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-[11px] font-medium text-gray-700">
                        4 Actions
                    </span>
                </div>

                {{-- Main content --}}
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
                    {{-- Upload --}}
                    <a href="{{ route('mahasiswa.documents.create') }}"
                        class="group relative overflow-hidden rounded-xl border border-blue-300 bg-white p-6 transition-all duration-300 
                        hover:-translate-y-1 hover:border-gray-300 hover:shadow-[0_12px_40px_rgba(0,0,0,.06)]">

                        <div class="mb-6 inline-flex h-11 w-11 items-center justify-center rounded-xl border border-blue-300 bg-blue-50 text-blue-600
                            group-hover:bg-blue-100 group-hover:text-blue-700 transition">
                            <span class="material-symbols-outlined text-[23px]">upload_file</span>
                        </div>

                        <h3 class="text-base font-semibold text-gray-900">
                            Upload Dokumen
                        </h3>

                        <p class="mt-2 text-[13px] leading-1 font-medium text-gray-600">
                            Tambahkan dokumen baru ke repository akademik.
                        </p>

                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-xs font-medium text-gray-400">
                                Create
                            </span>
                            <span class="material-symbols-outlined text-gray-300 transition-all duration-300 group-hover:translate-x-1 group-hover:text-black">
                                arrow_forward
                            </span>
                        </div>
                    </a>

                    {{-- Repository --}}
                    <a href="{{ route('mahasiswa.katalog.global') }}"
                        class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 transition-all duration-300 
                        hover:-translate-y-1 hover:border-gray-300 hover:shadow-[0_12px_40px_rgba(0,0,0,.06)]">

                        <div class="mb-6 inline-flex h-11 w-11 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 text-gray-600
                            group-hover:bg-gray-100 group-hover:text-gray-700 transition">
                            <span class="material-symbols-outlined text-[23px]">search</span>
                        </div>

                        <h3 class="text-base font-semibold text-gray-900">
                            Cari Repository
                        </h3>

                        <p class="mt-2 text-[13px] leading-1 font-medium text-gray-600">
                            Temukan dokumen mahasiswa maupun dosen.
                        </p>

                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-xs font-medium text-gray-400">
                                Browse
                            </span>
                            <span
                                class="material-symbols-outlined text-gray-300 transition-all duration-300 group-hover:translate-x-1 group-hover:text-black">
                                arrow_forward
                            </span>
                        </div>
                    </a>

                    {{-- Documents --}}
                    <a href="{{ route('mahasiswa.documents.index') }}"
                        class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 transition-all duration-300 
                        hover:-translate-y-1 hover:border-gray-300 hover:shadow-[0_12px_40px_rgba(0,0,0,.06)]">

                        <div class="mb-6 inline-flex h-11 w-11 items-center justify-center rounded-xl border border-green-300 bg-green-50 text-green-600
                            group-hover:bg-green-100 group-hover:text-green-700 transition">
                            <span class="material-symbols-outlined text-[23px]">folder_managed</span>
                        </div>

                        <h3 class="text-base font-semibold text-gray-900">
                            Dokumen Saya
                        </h3>

                        <p class="mt-2 text-[13px] leading-1 font-medium text-gray-600">
                            Kelola seluruh dokumen yang pernah diunggah.
                        </p>

                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-xs font-medium text-gray-400">
                                Manage
                            </span>
                            <span
                                class="material-symbols-outlined text-gray-300 transition-all duration-300 group-hover:translate-x-1 group-hover:text-black">
                                arrow_forward
                            </span>
                        </div>
                    </a>

                    {{-- Validation --}}
                    <a href="{{ route('mahasiswa.documents.index') }}"
                        class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 transition-all duration-300 
                        hover:-translate-y-1 hover:border-gray-300 hover:shadow-[0_12px_40px_rgba(0,0,0,.06)]">

                        <div class="mb-6 inline-flex h-11 w-11 items-center justify-center rounded-xl border border-amber-300 bg-yellow-50 text-yellow-600
                            group-hover:bg-yellow-100 group-hover:text-yellow-700 transition">
                            <span class="material-symbols-outlined text-[23px]">pending_actions</span>
                        </div>

                        <h3 class="text-base font-semibold text-gray-900">
                            Status Validasi
                        </h3>

                        <p class="mt-2 text-[13px] leading-1 font-medium text-gray-600">
                            Pantau proses persetujuan dokumen Anda.
                        </p>

                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-xs font-medium text-gray-400">
                                Monitor
                            </span>
                            <span
                                class="material-symbols-outlined text-gray-300 transition-all duration-300 group-hover:translate-x-1 group-hover:text-black">
                                arrow_forward
                            </span>
                        </div>
                    </a>

                </div>
            </div>
        </div>

    </section>

    {{-- Grid Stats --}}
    <section class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 mt-6 lg:mt-10 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">

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
                            class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center border border-blue-300">
                            <span class="material-symbols-outlined !text-[24px]">
                                description
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 font-medium text-xs text-gray-500">
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
                            class="w-12 h-12 rounded-full bg-green-100 text-green-700 flex items-center justify-center border border-green-300">
                            <span class="material-symbols-outlined !text-[24px]">
                                verified
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 font-medium text-xs text-gray-500">
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
                            class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center border border-yellow-300">
                            <span class="material-symbols-outlined !text-[24px]">
                                schedule
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 font-medium text-xs text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                        Menunggu validasi admin
                    </div>
                </div>
            </div>

            {{-- Rejected --}}
            <div
                class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute top-0 right-0 w-28 h-28 bg-red-200 rounded-full blur-3xl opacity-60"></div>

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
                            class="w-12 h-12 rounded-full bg-red-100 text-red-700 flex items-center justify-center border border-red-300">
                            <span class="material-symbols-outlined !text-[24px]">
                                cancel
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 font-medium text-xs text-gray-500">
                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                        Dokumen ditolak admin
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Charts --}}
    <section class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 mt-6 lg:mt-8 mb-6">
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
                            <p class="text-[12px] text-gray-500 font-medium leading-relaxed">
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
                    <div class="h-[250px] sm:h-[320px]">
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
                            <p class="text-[12px] text-gray-500 font-medium leading-relaxed">
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
                    <div class="h-[250px] sm:h-[320px] flex items-center justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Table Activity --}}
    <section class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 mb-10">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Header --}}
            <div
                class="px-5 sm:px-6 py-4 sm:py-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[22px] text-gray-600">
                            history
                        </span>
                        <h2 class="text-lg font-semibold text-gray-800">
                            Aktivitas Terbaru
                        </h2>
                    </div>
                    <p class="text-[12px] font-medium leading-relaxed text-blue-500">
                        Riwayat aktivitas upload dan download dokumen repository.
                    </p>
                </div>

                {{-- Action --}}
                <a href="{{ route('mahasiswa.documents.index') }}"
                    class="inline-flex items-center gap-1 px-4 py-2 rounded-lg border border-gray-200 bg-white
                    text-[13px] font-medium text-gray-700 hover:bg-gray-50 transition">
                    Lihat Semua
                    <span class="material-symbols-outlined !text-[16px]">
                        arrow_right_alt
                    </span>
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px]">

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

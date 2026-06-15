@extends('dosen.layouts.app')
@section('title', 'Monitoring Dashboard')

@section('content')
    {{-- Header + Quick Action --}}
    <section class="relative overflow-hidden border-b border-yellow-100 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('img/fiks.webp') }}');">

        {{-- Soft Decoration --}}
        <div class="absolute inset-0 bg-gradient-to-r from-white/50 via-white/30 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-200 via-amber-50/20 to-transparent"></div>

        {{-- Content --}}
        <div class="relative w-full max-w-[77rem] mx-auto px-4 sm:px-6 py-10 lg:py-16">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-8 lg:gap-10">

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
                        <span class="text-amber-700">
                            {{ auth()->user()->name }}
                        </span>
                    </h1>

                    {{-- Description --}}
                    <p class="mt-4 text-xs lg:text-sm leading-relaxed text-gray-900 max-w-2xl">
                        Kelola, upload, dan pantau aktivitas dokumen akademik Anda
                        melalui dashboard repository Program Studi Manajemen Informatika
                        Fakultas Ilmu Komputer Universitas Sriwijaya.
                    </p>

                    {{-- Mini Stats --}}
                    <div class="flex flex-wrap items-center gap-4 sm:gap-8 mt-6">
                        <a href="{{ route('dosen.documents.create') }}"
                            class="flex items-center gap-1.5 hover:translate-x-2 transition-all duration-300">
                            <div
                                class="w-11 h-11 rounded-full bg-white border border-blue-100 shadow-sm flex items-center justify-center text-blue-700">
                                <span class="material-symbols-outlined !text-[20px]">
                                    upload_file
                                </span>
                            </div>

                            <div>
                                <p class="text-[11px] text-gray-800">
                                    ->
                                </p>
                                <p class="text-xs text-gray-800">
                                    Unggah
                            </div>
                        </a>

                        <a href="{{ route('dosen.katalog.global') }}"
                            class="flex items-center gap-1.5 hover:translate-x-2 transition-all duration-300">
                            <div
                                class="w-11 h-11 rounded-full bg-white border border-purple-100 shadow-sm flex items-center justify-center text-purple-700">
                                <span class="material-symbols-outlined !text-[20px]">
                                    search
                                </span>
                            </div>

                            <div>
                                <p class="text-[11px] text-gray-800">
                                    ->
                                </p>
                                <p class="text-xs text-gray-800">
                                    Search
                            </div>
                        </a>

                        <a href="{{ route('dosen.documents.index') }}"
                            class="flex items-center gap-1.5 hover:translate-x-2 transition-all duration-300">
                            <div
                                class="w-11 h-11 rounded-full bg-white border border-green-100 shadow-sm flex items-center justify-center text-green-700">
                                <span class="material-symbols-outlined !text-[20px]">
                                    folder_managed
                                </span>
                            </div>

                            <div>
                                <p class="text-[11px] text-gray-800 ">
                                    ->
                                </p>
                                <p class="text-xs text-gray-800">
                                    Dokumen
                            </div>
                        </a>

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
                                Dashboard Dosen
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

        </div>

    </section>

    {{-- Grid Stats --}}
    <section class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 -mt-10 lg:-mt-10 relative z-10">
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
    <section class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 mt-6 lg:mt-8 mb-10">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Upload vs Download Chart --}}
            <div class="xl:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Aktivitas Upload
                        </h3>
                        <p class="text-[13px] text-gray-500 leading-relaxed">
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

                {{-- Info --}}
                <div class="px-6 pt-5 flex flex-wrap items-center gap-5">
                    {{-- Upload --}}
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-amber-300"></span>
                        <div>
                            <p class="text-xs text-gray-500">
                                Upload Dokumen
                            </p>
                            <h4 class="text-sm font-medium text-gray-800">
                                {{ $stats['my_documents'] ?? 0 }}
                            </h4>
                        </div>
                    </div>

                    {{-- Download --}}
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-blue-300"></span>
                        <div>
                            <p class="text-xs text-gray-500">
                                Total Download
                            </p>
                            <h4 class="text-sm font-medium text-gray-800">
                                {{ $stats['downloads'] ?? 0 }}
                            </h4>
                        </div>
                    </div>
                </div>

                {{-- Chart --}}
                <div class="p-4 sm:p-6 pt-4">
                    <div class="h-[250px] sm:h-[340px]">
                        <canvas id="analyticsChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Status Donut Chart --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
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
                <div class="px-6 pt-8">
                    <div class="h-[200px] sm:h-[250px] flex items-center justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

                {{-- Footer Stats --}}
                <div class="px-6 pb-6 pt-4 space-y-3">
                    {{-- Approved --}}
                    <div class="flex items-center justify-between p-3 rounded-2xl border border-green-100 bg-green-50/60">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-300"></span>
                            <p class="text-sm text-gray-700">
                                Disetujui
                            </p>
                        </div>
                        <span class="text-sm font-semibold text-green-700">
                            {{ $stats['approved'] ?? 0 }}
                        </span>
                    </div>

                    {{-- Pending --}}
                    <div
                        class="flex items-center justify-between p-3 rounded-2xl border border-yellow-100 bg-yellow-50/60">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-yellow-300"></span>
                            <p class="text-sm text-gray-700">
                                Pending
                            </p>
                        </div>
                        <span class="text-sm font-semibold text-yellow-700">
                            {{ $stats['pending'] ?? 0 }}
                        </span>
                    </div>

                    {{-- Rejected --}}
                    <div class="flex items-center justify-between p-3 rounded-2xl border border-rose-100 bg-rose-50/60">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-300"></span>
                            <p class="text-sm text-gray-700">
                                Ditolak
                            </p>
                        </div>
                        <span class="text-sm font-semibold text-rose-700">
                            {{ $stats['rejected'] ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Quick Insights --}}
    <section class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 mt-6 lg:mt-8 mb-10">

        {{-- Section Header --}}
        <div class="flex items-center justify-between mb-3">
            <div class="ml-2">
                <h2 class="text-[20px] font-semibold tracking-tight text-gray-800">
                    Quick Insights
                </h2>
                <p class="text-[13px] text-gray-500">
                    Ringkasan aktivitas dan performa repository dosen.
                </p>
            </div>
            <div
                class="hidden md:flex items-center gap-2 px-4 py-2 rounded-full border border-amber-200 bg-amber-50 text-amber-700 text-xs font-medium">
                <span class="material-symbols-outlined !text-[18px]">
                    insights
                </span>
                Repository Analytics
            </div>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Most Downloaded --}}
            <div
                class="group relative overflow-hidden bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md 
                transition-all duration-300">

                {{-- Background Blur --}}
                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-60 group-hover:opacity-80 transition">
                </div>

                <div class="relative">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-8">
                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 text-blue-700 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined !text-[28px]">
                                workspace_premium
                            </span>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-[11px] font-semibold 
                            text-blue-700">
                            Popular
                        </span>
                    </div>

                    {{-- Content --}}
                    <div>
                        <p class="text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-3">
                            Dokumen Terpopuler
                        </p>
                        <h3 class="text-lg font-semibold text-gray-800 leading-snug">
                            {{ $mostDownloaded?->title ?? 'Belum tersedia' }}
                        </h3>
                        <p class="text-[12px] text-gray-500 mt-3 leading-relaxed">
                            Dokumen yang paling banyak diakses mahasiswa pada repository akademik.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Latest Upload --}}
            <div
                class="group relative overflow-hidden bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md 
                transition-all duration-300">

                {{-- Background Blur --}}
                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-amber-200 rounded-full blur-3xl opacity-60 group-hover:opacity-80 transition">
                </div>

                <div class="relative">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-8">
                        <div
                            class="w-14 h-14 rounded-2xl bg-amber-50 border border-amber-100 text-amber-700 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined !text-[28px]">
                                upload
                            </span>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-[11px] font-semibold 
                            text-amber-700">
                            Recent
                        </span>
                    </div>

                    {{-- Content --}}
                    <div>
                        <p class="text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-3">
                            Upload Terbaru
                        </p>
                        <h3 class="text-lg font-semibold text-gray-800 leading-snug">
                            {{ $latestUpload?->title ?? 'Belum tersedia' }}
                        </h3>
                        <p class="text-[12px] text-gray-500 mt-3 leading-relaxed">
                            Dokumen terakhir yang diunggah ke repository oleh dosen.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Top Category --}}
            <div
                class="group relative overflow-hidden bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md
                transition-all duration-300">

                {{-- Background Blur --}}
                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-100 rounded-full blur-3xl opacity-60 group-hover:opacity-80 transition">
                </div>

                <div class="relative">
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-8">
                        <div
                            class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center 
                            shadow-sm">
                            <span class="material-symbols-outlined !text-[28px]">
                                category
                            </span>
                        </div>
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-[11px] font-semibold
                            text-emerald-700">
                            Active
                        </span>
                    </div>

                    {{-- Content --}}
                    <div>
                        <p class="text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-3">
                            Kategori Dominan
                        </p>
                        <h3 class="text-lg font-semibold text-gray-800 leading-snug">
                            {{ $topCategory?->category?->name ?? 'Belum tersedia' }}
                        </h3>
                        <p class="text-[12px] text-gray-500 mt-3 leading-relaxed">
                            Kategori dokumen dengan aktivitas dan publikasi paling tinggi.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </section>

    {{-- Activity Workspace --}}
    <section 
        x-data="{
            tab: localStorage.getItem('dashboardTab') || 'mine',
        
            changeTab(value) {
                this.tab = value;
                localStorage.setItem('dashboardTab', value);
            }
        }" 
        class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 mt-6 lg:mt-8 mb-10">

        {{-- --> Header Button --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-[20px] font-semibold tracking-tight text-gray-800">
                    Repository Activity Workspace
                </h2>
                <p class="text-[13px] text-gray-500 mt-1">
                    Pantau aktivitas repository dosen dan mahasiswa secara real-time.
                </p>
            </div>

            {{-- Toggle Button --}}
            <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                {{-- Aktivitas Saya --}}
                <button @click="changeTab('mine')"
                    :class="tab === 'mine'?
                        'bg-amber-600 text-white border-amber-200 shadow-sm' :
                        'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'"
                    class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl border text-[13px] sm:text-[14px] font-medium transition-all duration-200">
                    <span class="material-symbols-outlined !text-[18px]">
                        person
                    </span>
                    Aktivitas Saya
                </button>

                {{-- Aktivitas Mahasiswa --}}
                <button @click="changeTab('students')"
                    :class="tab === 'students'?
                        'bg-amber-600 text-white border-amber-200 shadow-sm' :
                        'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'"
                    class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl border text-[13px] sm:text-[14px] font-medium transition-all duration-200">
                    <span class="material-symbols-outlined !text-[18px]">
                        groups
                    </span>
                    Aktivitas Mahasiswa
                </button>
            </div>
        </div>

        {{-- --> Aktivitas Saya --}}
        <div x-show="tab === 'mine'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">

                {{-- Header --}}
                <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                            Aktivitas Repository Saya
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">
                            Ringkasan aktivitas upload dan dokumen repository Anda.
                        </p>
                    </div>

                    <div
                        class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-amber-50 border border-amber-100 text-amber-700
                        flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined !text-[20px] sm:!text-[24px]">
                            timeline
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="divide-y divide-gray-100">
                    @forelse($recentUploads as $document)
                        <div class="px-5 sm:px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 hover:bg-gray-50 transition">

                            {{-- Left --}}
                            <div class="flex items-start gap-4 min-w-0">
                                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-100 
                                    shrink-0">
                                    <span class="material-symbols-outlined !text-[20px]">
                                        upload_file
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-800 truncate">
                                        {{ $document->title }}
                                    </h4>
                                    <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-gray-500">
                                        <span>
                                            {{ $document->category->name ?? 'Kategori' }}
                                        </span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span>
                                            {{ $document->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Right --}}
                            <div class="flex items-center gap-2 shrink-0">
                                {{-- Status --}}
                                @if ($document->status === 'approved')
                                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl
                                        bg-green-50 border border-green-100 text-green-700 text-xs font-medium">
                                        <span class="material-symbols-outlined !text-[16px]">
                                            verified
                                        </span>
                                        Disetujui
                                    </div>
                                @elseif ($document->status === 'pending')
                                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl
                                        bg-yellow-50 border border-yellow-100 text-yellow-700 text-xs font-medium">
                                        <span class="material-symbols-outlined !text-[16px]">
                                            schedule
                                        </span>
                                        Pending
                                    </div>
                                @else
                                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl
                                        bg-red-50 border border-red-100 text-red-700 text-xs font-medium">
                                        <span class="material-symbols-outlined !text-[16px]">
                                            cancel
                                        </span>
                                        Ditolak
                                    </div>
                                @endif

                                {{-- Download --}}
                                <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl
                                    bg-blue-50 border border-blue-100 text-blue-700 text-xs font-medium">
                                    <span class="material-symbols-outlined !text-[16px]">
                                        download
                                    </span>
                                    {{ $document->download_count ?? 0 }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-16">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-gray-400 !text-[30px]">
                                        inbox
                                    </span>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-800">
                                    Belum Ada Aktivitas
                                </h3>
                                <p class="text-sm text-gray-500 mt-1 max-w-sm">
                                    Aktivitas repository Anda akan muncul setelah dokumen mulai diunggah.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- --> Aktivitas Mahasiswa --}}
        <div x-show="tab === 'students'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                {{-- Top Stundents --}}
                <div class="xl:col-span-1 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                    {{-- Header --}}
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Mahasiswa Aktif
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Mahasiswa dengan aktivitas repository tertinggi.
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-100 text-blue-700 flex items-center justify-center">
                            <span class="material-symbols-outlined">
                                groups
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="divide-y divide-gray-100">
                        @forelse($topStudents as $student)
                            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3 min-w-0">
                                    {{-- Avatar --}}
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center 
                                        justify-center font-semibold shrink-0">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>

                                    {{-- Info --}}
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-800 truncate">
                                            {{ $student->name }}
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            {{ $student->documents_count }} Dokumen
                                        </p>
                                    </div>
                                </div>

                                {{-- Score --}}
                                <div class="text-right">
                                    <p class="text-[11px] text-gray-500">
                                        Score
                                    </p>
                                    <h3 class="text-sm font-semibold text-gray-800">
                                        {{ $student->logs_count * 10 }}
                                    </h3>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-14 text-center">
                                <p class="text-sm text-gray-500">
                                    Belum ada mahasiswa aktif.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Latest Student Uploads --}}
                <div class="xl:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    {{-- Header --}}
                    <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Upload Terbaru Mahasiswa
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Dokumen terbaru yang diunggah mahasiswa.
                            </p>
                        </div>
                        <div
                            class="w-11 h-11 rounded-xl bg-amber-50 border border-amber-100 text-amber-700 flex items-center justify-center">
                            <span class="material-symbols-outlined">
                                upload
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="divide-y divide-gray-100">
                        @forelse($latestStudentUploads as $document)
                            <div class="px-5 sm:px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 hover:bg-gray-50 transition">

                                {{-- Left --}}
                                <div class="flex items-start gap-4 min-w-0">
                                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center 
                                        border border-amber-100 shrink-0">
                                        <span class="material-symbols-outlined !text-[20px]">
                                            description
                                        </span>
                                    </div>

                                    <div class="min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-800 truncate">
                                            {{ $document->title }}
                                        </h4>
                                        <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-gray-500">
                                            <span>
                                                {{ $document->user->name }}
                                            </span>
                                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                            <span>
                                                {{ $document->category->name ?? 'Kategori' }}
                                            </span>
                                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                            <span>
                                                {{ $document->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Status --}}
                                @php
                                    $statusConfig = match ($document->status) {
                                        'approved' => [
                                            'bg' => 'bg-green-50 border-green-200 text-green-700',
                                            'icon' => 'verified',
                                            'label' => 'Disetujui',
                                        ],

                                        'pending' => [
                                            'bg' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
                                            'icon' => 'schedule',
                                            'label' => 'Pending',
                                        ],

                                        'rejected' => [
                                            'bg' => 'bg-red-50 border-red-200 text-red-700',
                                            'icon' => 'cancel',
                                            'label' => 'Ditolak',
                                        ],

                                        default => [
                                            'bg' => 'bg-gray-50 border-gray-200 text-gray-700',
                                            'icon' => 'help',
                                            'label' => ucfirst($document->status),
                                        ],
                                    };
                                @endphp

                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-full border text-xs font-medium
                                    {{ $statusConfig['bg'] }}">
                                    <span class="material-symbols-outlined !text-[15px]">
                                        {{ $statusConfig['icon'] }}
                                    </span>
                                    {{ $statusConfig['label'] }}
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-14 text-center">
                                <p class="text-sm text-gray-500">
                                    Belum ada upload mahasiswa.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>


            {{-- Timeline + Inactive Students --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">

                {{-- Timeline --}}
                <div class="xl:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    {{-- Header --}}
                    <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-gray-100">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                            Timeline Aktivitas Mahasiswa
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Aktivitas terbaru mahasiswa pada repository.
                        </p>
                    </div>

                    {{-- Content --}}
                    <div class="divide-y divide-gray-100">
                        @forelse($studentRecentActivities as $activity)
                            <div class="px-6 py-4 flex items-start gap-4 hover:bg-gray-50 transition">

                                {{-- Icon --}}
                                <div class="w-10 h-10 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined !text-[18px]">
                                        history
                                    </span>
                                </div>

                                {{-- Info --}}
                                <div class="min-w-0">
                                    <h4 class="text-sm font-medium text-gray-800">
                                        {{ $activity->user->name }}
                                        melakukan
                                        <span class="font-semibold text-blue-700">
                                            {{ $activity->action }}
                                        </span>
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $activity->document->title ?? '-' }}
                                    </p>
                                    <p class="text-[11px] text-gray-400 mt-1">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-14 text-center">
                                <p class="text-sm text-gray-500">
                                    Belum ada aktivitas mahasiswa.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Inactive Students --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    {{-- Header --}}
                    <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-gray-100">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">
                            Mahasiswa Tidak Aktif
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Belum memiliki aktivitas repository.
                        </p>
                    </div>

                    {{-- Content --}}
                    <div class="divide-y divide-gray-100">
                        @forelse($inactiveStudents as $student)
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center font-semibold">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-800">
                                            {{ $student->name }}
                                        </h4>
                                        <p class="text-xs text-gray-500">
                                            Belum ada aktivitas
                                        </p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 rounded-full bg-red-50 border border-red-100 text-red-600 text-[10px] font-medium">
                                    Inactive
                                </span>
                            </div>
                        @empty
                            <div class="px-6 py-14 text-center">
                                <p class="text-sm text-gray-500">
                                    Semua mahasiswa aktif.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        // Analytics Chart
        const analyticsCtx = document.getElementById('analyticsChart');

        new Chart(analyticsCtx, {
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

                datasets: [
                    // Upload Dataset
                    {
                        label: 'Upload',
                        data: @json($uploadChartData),
                        borderColor: '#FBBF24',
                        backgroundColor: 'rgba(251, 191, 36, 0.10)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#FBBF24',
                    },

                    // Download Dataset
                    {
                        label: 'Download',
                        data: @json($downloadChartData),
                        borderColor: '#93C5FD',
                        backgroundColor: 'rgba(147, 197, 253, 0.10)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#93C5FD',
                    }

                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },

                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            color: '#374151',
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },

                    tooltip: {
                        backgroundColor: '#111827',
                        padding: 12,
                        cornerRadius: 12,
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#6B7280',
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)',
                            drawBorder: false,
                        }
                    },

                    x: {
                        ticks: {
                            color: '#6B7280',
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Status Doughnut Chart
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
                    borderWidth: 5,
                    hoverOffset: 6,
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#111827',
                        padding: 12,
                        cornerRadius: 12,
                    }
                }
            }
        });
    </script>
@endpush

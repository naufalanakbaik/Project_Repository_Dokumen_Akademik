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
        <div class="relative w-full max-w-[77rem] mx-auto px-6 py-16 lg:py-16">
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
                    <div class="flex flex-wrap items-center gap-8 mt-6">
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
    <section class="w-full max-w-[78rem] mx-auto px-6 -mt-10 relative z-10">
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
    <section class="w-full max-w-[78rem] mx-auto px-6 mt-8 mb-10">
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
                <div class="p-6 pt-4">
                    <div class="h-[340px]">
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
                    <div class="h-[250px] flex items-center justify-center">
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
    <section class="w-full max-w-[78rem] mx-auto px-6 mt-8 mb-10">

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

    {{-- Popular Documents --}}
    <section class="w-full max-w-[78rem] mx-auto px-6 mt-8 mb-10">
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-[15px] font-semibold text-gray-800">
                        Dokumen Terpopuler
                    </h3>
                    <p class="text-[12px] text-gray-500">
                        Dokumen yang paling sering diakses mahasiswa.
                    </p>
                </div>
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 bg-gray-50 text-xs font-medium text-gray-600">
                    <span class="material-symbols-outlined !text-[16px]">
                        monitoring
                    </span>
                    Popular
                </span>
            </div>

            {{-- Content --}}
            <div class="divide-y divide-gray-100">
                @forelse($popularDocuments as $document)
                    <div
                        class="px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 hover:bg-gray-50 transition">

                        {{-- Left --}}
                        <div class="flex items-start gap-3 min-w-0">
                            <div
                                class="w-10 h-10 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined !text-[20px]">
                                    description
                                </span>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 truncate">
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
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-blue-100 bg-blue-50 text-xs font-medium 
                            text-blue-700 shrink-0">
                            <span class="material-symbols-outlined !text-[16px]">
                                download
                            </span>
                            {{ $document->downloads_count }}
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-14">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-gray-400">
                                    inbox
                                </span>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-800">
                                Belum Ada Data
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 max-w-sm">
                                Dokumen populer akan tampil setelah repository mulai aktif digunakan.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Monitoring Mahasiswa --}}
<section class="w-full max-w-[78rem] mx-auto px-6 mt-8 mb-10">
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">

            <div>
                <h3 class="text-[15px] font-semibold text-gray-800">
                    Monitoring Mahasiswa
                </h3>

                <p class="text-[12px] text-gray-500">
                    Aktivitas dan perkembangan mahasiswa dalam repository akademik.
                </p>
            </div>

            <span
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 bg-gray-50 text-xs font-medium text-gray-600">

                <span class="material-symbols-outlined !text-[16px]">
                    school
                </span>

                Mahasiswa
            </span>

        </div>

        {{-- Content --}}
        <div class="divide-y divide-gray-100">

            @forelse($studentActivities as $student)

                <div
                    class="px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 hover:bg-gray-50 transition">

                    {{-- Left --}}
                    <div class="flex items-center gap-3 min-w-0">

                        {{-- Avatar --}}
                        <div
                            class="w-10 h-10 rounded-lg bg-gray-100 text-gray-700 flex items-center justify-center text-sm font-semibold shrink-0">

                            {{ strtoupper(substr($student->name, 0, 1)) }}

                        </div>

                        {{-- Info --}}
                        <div class="min-w-0">

                            <h4 class="text-sm font-medium text-gray-900 truncate">
                                {{ $student->name }}
                            </h4>

                            <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-gray-500">

                                <span>
                                    Mahasiswa Repository
                                </span>

                                <span class="w-1 h-1 rounded-full bg-gray-300"></span>

                                <span>
                                    {{ $student->documents_count }} Dokumen
                                </span>

                            </div>

                        </div>

                    </div>

                    {{-- Right --}}
                    <div class="flex items-center gap-2 shrink-0">

                        {{-- Dokumen --}}
                        <div
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 bg-gray-50 text-xs font-medium text-gray-700">

                            <span class="material-symbols-outlined !text-[16px]">
                                description
                            </span>

                            {{ $student->documents_count }}

                        </div>

                        {{-- Aktivitas --}}
                        <div
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-blue-100 bg-blue-50 text-xs font-medium text-blue-700">

                            <span class="material-symbols-outlined !text-[16px]">
                                monitoring
                            </span>

                            {{ $student->logs_count }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="px-6 py-14">

                    <div class="flex flex-col items-center text-center">

                        <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">

                            <span class="material-symbols-outlined text-gray-400">
                                group_off
                            </span>

                        </div>

                        <h3 class="text-sm font-semibold text-gray-800">
                            Belum Ada Data Mahasiswa
                        </h3>

                        <p class="text-sm text-gray-500 mt-1 max-w-sm">
                            Aktivitas mahasiswa akan tampil setelah repository mulai digunakan.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>
</section>


@endsection

@push('scripts')
    <script>
        /*
                                                |--------------------------------------------------------------------------
                                                | Analytics Chart
                                                |--------------------------------------------------------------------------
                                                */

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

                    /*
                    |--------------------------------------------------------------------------
                    | Upload Dataset
                    |--------------------------------------------------------------------------
                    */
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

                    /*
                    |--------------------------------------------------------------------------
                    | Download Dataset
                    |--------------------------------------------------------------------------
                    */
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

        /*
        |--------------------------------------------------------------------------
        | Status Doughnut Chart
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

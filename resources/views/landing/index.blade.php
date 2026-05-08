@extends('landing.layouts.public')

{{-- @section('title', 'Repository Dokumen Akademik') --}}
@section('meta_description', 'Platform repository akademik digital untuk mengakses jurnal, laporan tugas akhir, dan dokumen penelitian.')

@section('content')

    {{-- HERO --}}
    <section class="relative overflow-hidden hero-gradient">

        {{-- Blur Decoration --}}
        <div
            class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
        </div>

        <div
            class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-purple-500/10 rounded-full blur-3xl translate-x-1/3 translate-y-1/3">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-24 lg:py-32">

            <div class="max-w-3xl">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-blue-100 bg-blue-50 text-blue-700 text-sm font-medium mb-6">

                    <span class="material-icons-outlined text-[18px]">
                        auto_stories
                    </span>

                    Repository Akademik Digital
                </div>

                {{-- Heading --}}
                <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight text-gray-950">

                    Akses Dokumen Akademik
                    Secara
                    <span class="text-blue-600">
                        Modern
                    </span>
                    dan Terpusat
                </h1>

                {{-- Description --}}
                <p class="mt-6 text-lg leading-relaxed text-gray-600 max-w-2xl">

                    Platform repository digital untuk menyimpan, mencari,
                    dan mengelola dokumen akademik seperti laporan tugas akhir,
                    jurnal mahasiswa, modul praktikum, dan dokumen penelitian lainnya.
                </p>

                {{-- CTA --}}
                <div class="mt-10 flex flex-wrap items-center gap-4">

                    <a href="{{ route('repository') }}"
                        class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-lg shadow-blue-100 transition duration-300">

                        Jelajahi Repository
                    </a>

                    <a href="{{ route('login') }}"
                        class="px-6 py-3 rounded-2xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-medium transition duration-300">

                        Login Sistem
                    </a>

                </div>

            </div>

        </div>
    </section>

    {{-- STATISTICS --}}
    <section class="max-w-7xl mx-auto px-6 -mt-10 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- Documents --}}
            <div
                class="bg-white rounded-3xl border border-gray-200 shadow-sm p-7 hover:shadow-md transition duration-300">

                <div
                    class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5">

                    <span class="material-icons-outlined text-[28px]">
                        description
                    </span>

                </div>

                <h2 class="text-3xl font-bold text-gray-950">
                    {{ number_format($stats['documents']) }}
                </h2>

                <p class="mt-2 text-gray-500">
                    Total dokumen terpublikasi
                </p>

            </div>

            {{-- Categories --}}
            <div
                class="bg-white rounded-3xl border border-gray-200 shadow-sm p-7 hover:shadow-md transition duration-300">

                <div
                    class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-5">

                    <span class="material-icons-outlined text-[28px]">
                        category
                    </span>

                </div>

                <h2 class="text-3xl font-bold text-gray-950">
                    {{ number_format($stats['categories']) }}
                </h2>

                <p class="mt-2 text-gray-500">
                    Kategori dokumen tersedia
                </p>

            </div>

            {{-- Users --}}
            <div
                class="bg-white rounded-3xl border border-gray-200 shadow-sm p-7 hover:shadow-md transition duration-300">

                <div
                    class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-5">

                    <span class="material-icons-outlined text-[28px]">
                        groups
                    </span>

                </div>

                <h2 class="text-3xl font-bold text-gray-950">
                    {{ number_format($stats['users']) }}
                </h2>

                <p class="mt-2 text-gray-500">
                    Pengguna aktif sistem
                </p>

            </div>

        </div>

    </section>

    {{-- FEATURED DOCUMENTS --}}
    <section class="max-w-7xl mx-auto px-6 py-24">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">

            <div>

                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 text-gray-700 text-sm font-medium mb-4">

                    <span class="material-icons-outlined text-[18px]">
                        folder_open
                    </span>

                    Dokumen Terbaru
                </div>

                <h2 class="text-4xl font-bold text-gray-950 tracking-tight">
                    Koleksi Repository Publik
                </h2>

                <p class="mt-4 text-gray-600 max-w-2xl leading-relaxed">
                    Jelajahi berbagai dokumen akademik yang telah dipublikasikan
                    dan tersedia untuk diakses oleh seluruh pengguna.
                </p>

            </div>

            <a href="{{ route('repository') }}"
                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition">

                Lihat Semua

                <span class="material-icons-outlined text-[20px]">
                    arrow_forward
                </span>

            </a>

        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @forelse ($documents as $document)
                <a href="{{ route('repository.show', $document->id) }}"
                    class="group bg-white rounded-3xl border border-gray-200 hover:border-blue-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">

                    {{-- Top --}}
                    <div class="p-7">

                        {{-- Category --}}
                        <div class="flex items-center justify-between gap-3 mb-5">

                            <span
                                class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold border border-blue-100">

                                {{ $document->category->name }}
                            </span>

                            <span class="text-xs text-gray-400">
                                {{ $document->created_at->format('d M Y') }}
                            </span>

                        </div>

                        {{-- Title --}}
                        <h3
                            class="text-xl font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-blue-600 transition">

                            {{ $document->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="mt-4 text-sm leading-relaxed text-gray-500 line-clamp-3">

                            Dokumen akademik yang telah dipublikasikan
                            dalam repository sistem dan tersedia
                            untuk ditinjau lebih lanjut.
                        </p>

                    </div>

                    {{-- Footer --}}
                    <div
                        class="px-7 py-5 border-t border-gray-100 bg-gray-50/60 flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600">

                                <span class="material-icons-outlined text-[20px]">
                                    person
                                </span>

                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $document->user->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ ucfirst($document->user->role) }}
                                </p>
                            </div>

                        </div>

                        <span
                            class="material-icons-outlined text-gray-400 group-hover:text-blue-600 transition">
                            arrow_forward
                        </span>

                    </div>

                </a>
            @empty

                <div
                    class="col-span-full bg-white border border-dashed border-gray-300 rounded-3xl p-16 text-center">

                    <div
                        class="w-20 h-20 mx-auto rounded-3xl bg-gray-100 flex items-center justify-center text-gray-400">

                        <span class="material-icons-outlined text-[38px]">
                            folder_off
                        </span>

                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-gray-800">
                        Belum Ada Dokumen
                    </h3>

                    <p class="mt-2 text-gray-500">
                        Dokumen publik belum tersedia saat ini.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

    {{-- BENEFITS --}}
    <section class="bg-white border-y border-gray-200">

        <div class="max-w-7xl mx-auto px-6 py-24">

            {{-- Heading --}}
            <div class="max-w-3xl mb-16">

                <h2 class="text-4xl font-bold text-gray-950 tracking-tight">
                    Mengapa Menggunakan Repository Ini?
                </h2>

                <p class="mt-5 text-lg leading-relaxed text-gray-600">
                    Sistem repository modern yang dirancang untuk membantu
                    penyimpanan dan distribusi dokumen akademik secara lebih efisien.
                </p>

            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                {{-- Item --}}
                <div class="rounded-3xl border border-gray-200 p-8 hover:shadow-md transition">

                    <div
                        class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6">

                        <span class="material-icons-outlined text-[28px]">
                            search
                        </span>

                    </div>

                    <h3 class="text-xl font-semibold text-gray-900">
                        Pencarian Cepat
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Temukan dokumen akademik secara mudah melalui
                        sistem pencarian modern dan terstruktur.
                    </p>

                </div>

                {{-- Item --}}
                <div class="rounded-3xl border border-gray-200 p-8 hover:shadow-md transition">

                    <div
                        class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-6">

                        <span class="material-icons-outlined text-[28px]">
                            security
                        </span>

                    </div>

                    <h3 class="text-xl font-semibold text-gray-900">
                        Validasi Dokumen
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Seluruh dokumen diverifikasi admin sehingga
                        kualitas dan validitas data lebih terjaga.
                    </p>

                </div>

                {{-- Item --}}
                <div class="rounded-3xl border border-gray-200 p-8 hover:shadow-md transition">

                    <div
                        class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-6">

                        <span class="material-icons-outlined text-[28px]">
                            cloud_done
                        </span>

                    </div>

                    <h3 class="text-xl font-semibold text-gray-900">
                        Akses Terpusat
                    </h3>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Seluruh dokumen akademik tersimpan dalam
                        satu sistem digital yang modern dan terintegrasi.
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- CTA --}}
    <section class="max-w-7xl mx-auto px-6 py-24">

        <div
            class="relative overflow-hidden rounded-[40px] bg-gray-950 px-8 py-16 lg:px-16 lg:py-20 text-white">

            {{-- Blur --}}
            <div
                class="absolute top-0 right-0 w-[300px] h-[300px] bg-blue-500/20 rounded-full blur-3xl">
            </div>

            <div class="relative max-w-3xl">

                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/10 text-sm font-medium mb-6">

                    <span class="material-icons-outlined text-[18px]">
                        lock
                    </span>

                    Akses Repository Penuh
                </div>

                <h2 class="text-4xl lg:text-5xl font-bold leading-tight tracking-tight">

                    Login untuk Mengakses
                    Seluruh Fitur Repository
                </h2>

                <p class="mt-6 text-lg text-gray-300 leading-relaxed">
                    Masuk ke sistem untuk melihat seluruh koleksi dokumen,
                    melakukan download file, upload dokumen akademik,
                    dan mengakses dashboard repository.
                </p>

                <div class="mt-10 flex flex-wrap gap-4">

                    <a href="{{ route('login') }}"
                        class="px-6 py-3 rounded-2xl bg-white text-gray-900 font-semibold hover:bg-gray-100 transition">

                        Masuk ke Sistem
                    </a>

                    <a href="{{ route('repository') }}"
                        class="px-6 py-3 rounded-2xl border border-white/15 hover:bg-white/5 transition">

                        Lihat Repository
                    </a>

                </div>

            </div>

        </div>

    </section>

@endsection
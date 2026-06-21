@extends('landing.layouts.public')

@section('title', 'Beranda Dokumen Akademik')
@section('meta_description',
    'Platform repository akademik digital untuk mengakses jurnal, laporan tugas akhir, dan
    dokumen penelitian.')

@section('content')

    {{-- Header Section --}}
    <section class="relative overflow-hidden border-b border-yellow-100 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('img/fiks.webp') }}');">

        {{-- Soft Decoration --}}
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-100/70 via-white/50 to-white/10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-300/70 via-transparent to-transparent"></div>

        {{-- Content --}}
        <div class="relative w-full max-w-[77rem] mx-auto px-6 py-16 lg:py-16">
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-yellow-300 bg-white/90 backdrop-blur-md px-5 py-2 
                    text-sm font-semibold text-yellow-700 shadow-[0_8px_30px_rgba(0,0,0,0.08)] mb-7">
                    <span class="material-symbols-outlined text-yellow-600 !text-[18px]">auto_stories</span>
                    Repository Akademik Digital
                </div>

                {{-- Heading --}}
                <h1
                    class="text-3xl sm:text-4xl lg:text-6xl font-bold leading-[1.1] tracking-tight text-gray-950 
                    drop-shadow-[0_2px_8px_rgba(255,255,255,0.4)]">
                    Akses Dokumen Akademik
                    <span
                        class="block mt-1 bg-gradient-to-r from-yellow-600 via-amber-500 to-orange-600 bg-clip-text text-transparent">
                        Lebih Modern & Terstruktur
                    </span>
                </h1>

                {{-- Description --}}
                <p class="mt-6 text-[15px] leading-relaxed text-gray-800 font-medium max-w-2xl">
                    Platform repository digital untuk menyimpan, mencari,
                    dan mengelola dokumen akademik secara terpusat dengan
                    tampilan yang modern, sederhana, dan mudah digunakan.
                </p>


                {{-- Action Buttons --}}
                <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center gap-4">
                    {{-- Primary --}}
                    <a href="{{ route('repository') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-gray-950 hover:bg-gray-900 text-white 
                        text-[13px] font-medium shadow-md hover:shadow-lg transition-all duration-300 w-full sm:w-auto">
                        <span class="material-symbols-outlined !text-[18px]">
                            folder_open
                        </span>
                        Jelajahi Repository
                    </a>

                    {{-- Secondary --}}
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg ring-1 ring-yellow-400 bg-white/90 hover:bg-amber-50
                        text-gray-800 text-[13px] font-semibold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 w-full sm:w-auto">
                        <span class="material-symbols-outlined !text-[18px] text-yellow-600">                             
                            login
                        </span>
                        Login ke Sistem
                    </a>
                </div>
            </div>

            {{-- Bottom Info --}}
            <div class="mt-10 flex flex-wrap items-center gap-6 text-xs text-gray-800 font-medium">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full ring-1 ring-white bg-green-500 shadow-sm"></span>
                    Akses Cepat
                </div>

                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full ring-1 ring-white bg-yellow-500 shadow-sm"></span>
                    Repository Terpusat
                </div>

                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full ring-1 ring-white bg-blue-500 shadow-sm"></span>
                    Tampilan Modern
                </div>
            </div>
        </div>
    </section>

    {{-- Statistics Section --}}
    <section class="w-full max-w-[78rem] mx-auto px-4 sm:px-6 -mt-8 sm:-mt-10 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-7">
            {{-- Card total dokumen --}}
            <div class="group h-full min-h-[210px] bg-white backdrop-blur-sm border border-red-200 rounded-xl p-8 flex flex-col 
                justify-between transition-all duration-300 hover:border-red-300 hover:shadow-red-300">

                {{-- Top --}}
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-red-50 border border-red-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-600 !text-[22px]">
                            description
                        </span>
                    </div>
                    <span
                        class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-red-50 text-red-600 border border-red-300">
                        Dokumen
                    </span>
                </div>

                {{-- Content --}}
                <div class="mt-6">
                    <h2 class="text-4xl font-semibold tracking-tight text-gray-800">
                        {{ number_format($stats['documents']) }}
                    </h2>
                    <p class="mt-4 text-[13px] font-medium leading-relaxed text-gray-500">
                        Total dokumen akademik yang telah dipublikasikan dalam repository digital.
                    </p>
                </div>
            </div>

            {{-- Card jumlah kategori --}}
            <div class="group h-full min-h-[210px] bg-white backdrop-blur-sm border border-amber-200 rounded-xl p-8 flex flex-col 
                justify-between transition-all duration-300 hover:border-amber-300 hover:shadow-amber-300">

                {{-- Top --}}
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-600 !text-[22px]">
                            folder_copy
                        </span>
                    </div>
                    <span
                        class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-300">
                        Kategori
                    </span>
                </div>

                {{-- Content --}}
                <div class="mt-6">
                    <h2 class="text-4xl font-semibold tracking-tight text-gray-800">
                        {{ number_format($stats['categories']) }}
                    </h2>
                    <p class="mt-4 text-[13px] font-medium leading-relaxed text-gray-500">
                        Kategori dokumen yang tersedia untuk pengelolaan repository.
                    </p>
                </div>
            </div>

            {{-- Card jumlah user aktif --}}
            <div class="group h-full min-h-[210px] bg-white backdrop-blur-sm border border-blue-200 rounded-xl p-8 flex flex-col 
                justify-between transition-all duration-300 hover:border-blue-300 hover:shadow-blue-300">

                {{-- Top --}}
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 !text-[22px]">
                            group
                        </span>
                    </div>
                    <span
                        class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-300">
                        Pengguna
                    </span>
                </div>

                {{-- Content --}}
                <div class="mt-6">
                    <h2 class="text-4xl font-bold tracking-tight text-gray-800">
                        {{ number_format($stats['users']) }}
                    </h2>
                    <p class="mt-4 text-[13px] font-medium leading-relaxed text-gray-500">
                        Pengguna aktif yang menggunakan sistem repository digital.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Documents Section --}}
    <section class="w-full max-w-[77rem] mx-auto px-6 py-20">

        {{-- Header --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-6">

            {{-- Left --}}
            <div class="max-w-2xl">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 backdrop-blur-sm border border-yellow-300
                    text-yellow-700 text-[14px] font-semibold shadow-md mb-4">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Dokumen Terbaru
                </div>

                {{-- Heading --}}
                <h2 class="text-2xl sm:text-3xl lg:text-[35px] font-semibold leading-tight text-gray-900">
                    Koleksi Repository Akademik
                </h2>

                {{-- Description --}}
                <p class="mt-3 text-[14px] font-medium leading-relaxed text-gray-600 max-w-2xl">
                    Jelajahi berbagai dokumen akademik yang telah dipublikasikan
                    dan tersedia untuk diakses seluruh pengguna repository digital
                    secara mudah, cepat, dan terstruktur.
                </p>
            </div>

            {{-- Right --}}
            <div class="flex items-center">
                <a href="{{ route('repository') }}"
                    class="group inline-flex items-center gap-1.5 text-[12px] font-medium text-gray-600 transition-all duration-300">
                    <span>
                        Lihat Semua
                    </span>
                    <span
                        class="material-symbols-outlined !text-[13px] text-yellow-600 transition-transform duration-300 group-hover:translate-x-1">
                        east
                    </span>
                </a>
            </div>

        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($documents as $document)
                <a href="{{ route('repository.show', $document->id) }}"
                    class="group relative flex flex-col h-full overflow-hidden rounded-xl border border-amber-200 bg-white shadow-sm 
                    transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-100/40 hover:border-yellow-300">

                    {{-- Glow Effect --}}
                    <div
                        class="absolute inset-0 opacity-0 transition duration-500 bg-gradient-to-br from-yellow-50/60 via-transparent to-amber-50/40
                        group-hover:opacity-100">
                    </div>

                    {{-- Content --}}
                    <div class="relative p-6 flex flex-col h-full">

                        {{-- Top --}}
                        <div class="flex items-start justify-between gap-4 mb-5">

                            {{-- Category --}}
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50
                                border border-amber-200 text-amber-600 text-[11px] font-medium tracking-wide">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ $document->category->name }}
                            </span>

                            {{-- Date --}}
                            <div class="text-right shrink-0">
                                <p class="text-[9px] uppercase font-medium text-green-600">
                                    Published
                                </p>
                                <p class="text-[10px] font-normal text-gray-400">
                                    {{ $document->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        {{-- Title --}}
                        <h3
                            class="text-[18px] leading-snug font-semibold uppercase text-gray-800 line-clamp-2 transition duration-300 group-hover:text-yellow-700">
                            {{ $document->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="mt-4 text-[12px] leading-relaxed text-gray-500 line-clamp-3">
                            Dokumen akademik yang telah dipublikasikan
                            dalam repository sistem dan tersedia
                            untuk ditinjau lebih lanjut oleh pengguna.
                        </p>

                        {{-- Divider --}}
                        <div class="mt-6 border-t border-dashed border-gray-300"></div>

                        {{-- Footer --}}
                        <div class="mt-5 flex items-center justify-between gap-4">

                            {{-- User info & avatar profile --}}
                            <div class="flex items-center gap-3 min-w-0">
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full
                                    border border-indigo-300 bg-indigo-50 text-xs font-semibold tracking-wide text-indigo-600">
                                    {{ strtoupper(substr($document->user->name, 0, 2)) }}
                                </div>

                                <div class="min-w-0">
                                    <p class="text-[13px] font-semibold text-gray-700 truncate">
                                        {{ $document->user->name }}
                                    </p>
                                    <p class="text-[11.5px] text-gray-500 capitalize">
                                        {{ $document->user->role }}
                                    </p>
                                </div>
                            </div>

                            {{-- Detail --}}
                            <div
                                class="flex items-center gap-1.5 text-[13px] font-normal text-gray-400 transition-all duration-300
                                group-hover:text-yellow-700">
                                <span>
                                    Detail
                                </span>
                                <span class="material-symbols-outlined !text-[14px]">
                                    open_in_new
                                </span>
                            </div>

                        </div>

                    </div>

                </a>

            @empty

                {{-- Empty State --}}
                <div
                    class="col-span-full rounded-3xl border border-dashed border-yellow-200 bg-gradient-to-br from-white to-yellow-50/40
                    p-16 text-center shadow-sm">
                    <div
                        class="w-24 h-24 mx-auto rounded-3xl bg-gradient-to-br from-yellow-50 to-amber-50 border border-yellow-100
                        flex items-center justify-center text-yellow-600 shadow-inner">
                        <span class="material-symbols-outlined text-[40px]">
                            folder_off
                        </span>
                    </div>
                    <h3 class="mt-7 text-2xl font-bold text-gray-800">
                        Belum Ada Dokumen
                    </h3>
                    <p class="mt-3 text-sm leading-relaxed text-gray-500 max-w-md mx-auto">
                        Saat ini belum terdapat dokumen publik yang tersedia
                        di dalam repository sistem.
                    </p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Benefits Section --}}
    <section class="relative overflow-hidden shadow-amber-100 bg-gradient-to-br from-yellow-50 via-amber-50 to-white border-y border-yellow-100">

        {{-- Soft Decoration --}}
        <div class="absolute -top-32 -left-32 w-80 h-80 bg-amber-200/50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[280px] h-[280px] bg-amber-200/50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-[78rem] mx-auto px-6 py-16">
            {{-- Heading --}}
            <div class="max-w-2xl mb-10">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-amber-300
                    text-amber-700 text-sm font-semibold shadow-sm mb-5">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Keunggulan Repository
                </div>

                <h2 class="text-2xl md:text-3xl font-bold tracking-tight leading-tight text-gray-950">
                    Mengapa Menggunakan
                    <span class="text-yellow-700">
                        Repository Ini?
                    </span>
                </h2>

                <p class="mt-2 text-[14px] font-medium leading-relaxed text-gray-600 max-w-2xl">
                    Sistem repository modern untuk penyimpanan dan distribusi
                    dokumen akademik secara lebih cepat, aman, dan terstruktur.
                </p>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                {{-- Card --}}
                <div
                    class="group relative overflow-hidden rounded-xl border border-amber-200 bg-white/80 backdrop-blur-sm
                    p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-100/40">

                    {{-- Glow --}}
                    <div
                        class="absolute inset-0 opacity-0 transition duration-500 bg-gradient-to-br from-yellow-50/60 via-transparent to-transparent
                        group-hover:opacity-100">
                    </div>

                    {{-- Icon --}}
                    <div class="relative">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-100 to-amber-50 border border-yellow-200
                            text-yellow-700 flex items-center justify-center shadow-sm mb-5">
                            <span class="material-symbols-outlined !text-[26px]">
                                search
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">
                            Pencarian Cepat
                        </h3>
                        <p class="mt-3 text-[13px] font-medium leading-relaxed text-gray-600">
                            Temukan dokumen akademik secara mudah
                            melalui sistem pencarian modern.
                        </p>
                    </div>

                </div>

                {{-- Card --}}
                <div
                    class="group relative overflow-hidden rounded-xl border border-amber-200 bg-white/80 backdrop-blur-sm
                    p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-100/40">

                    {{-- Glow --}}
                    <div
                        class="absolute inset-0 opacity-0 transition duration-500 bg-gradient-to-br from-amber-50/60 via-transparent to-transparent
                        group-hover:opacity-100">
                    </div>

                    <div class="relative">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-100 to-yellow-50 border border-amber-200
                            text-amber-700 flex items-center justify-center shadow-sm mb-5">
                            <span class="material-symbols-outlined !text-[26px]">
                                verified_user
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800">
                            Validasi Dokumen
                        </h3>

                        <p class="mt-3 text-[13px] font-medium leading-relaxed text-gray-600">
                            Seluruh dokumen diverifikasi agar
                            kualitas data tetap terpercaya.
                        </p>
                    </div>
                </div>

                {{-- Card --}}
                <div
                    class="group relative overflow-hidden rounded-xl border border-amber-200 bg-white/80 backdrop-blur-sm
                    p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-100/40">

                    {{-- Glow --}}
                    <div
                        class="absolute inset-0 opacity-0 transition duration-500 bg-gradient-to-br from-yellow-50/60 via-transparent to-transparent
                        group-hover:opacity-100">
                    </div>

                    <div class="relative">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-100 to-amber-50 border border-yellow-200
                            text-yellow-700 flex items-center justify-center shadow-sm mb-5">
                            <span class="material-symbols-outlined !text-[26px]">
                                cloud_done
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-00">
                            Akses Terpusat
                        </h3>

                        <p class="mt-3 text-[13px] font-medium leading-relaxed text-gray-600">
                            Semua dokumen tersimpan dalam
                            satu sistem digital modern.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- CTA Section --}}
    <section class="max-w-[78rem] mx-auto px-6 py-20">

        <div class="relative overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-br from-yellow-50 via-amber-50 to-white
            px-8 py-14 lg:px-14 lg:py-16">

            {{-- Soft Blur --}}
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-yellow-200/40 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 bg-amber-100/50 rounded-full blur-3xl pointer-events-none"></div>

            {{-- Content --}}
            <div class="relative max-w-3xl">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-yellow-200
                    text-yellow-700 text-sm font-semibold shadow-sm mb-5">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Akses Repository Penuh
                </div>

                {{-- Heading --}}
                <h2 class="text-4xl lg:text-4xl font-bold tracking-tight leading-relaxed text-gray-950">
                    Login untuk Mengakses
                    <span class="text-yellow-700">
                        Seluruh Fitur Repository
                    </span>
                </h2>

                {{-- Description --}}
                <p class="mt-5 text-[14px] font-medium leading-relaxed text-gray-600 max-w-2xl">
                    Masuk ke sistem untuk melakukan download dokumen,
                    preview file lengkap, upload repository,
                    dan mengakses seluruh dashboard akademik.
                </p>

                {{-- Action buttons --}}
                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-gray-950 
                        text-white text-[13px] font-medium transition-all duration-300 hover:bg-black hover:-translate-y-0.5">
                        <span class="material-symbols-outlined !text-[18px]">
                            login
                        </span>
                        Login ke Sistem
                    </a>

                    <a href="{{ route('repository') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-amber-300 bg-white backdrop-blur-sm 
                        text-gray-700 text-[13px] font-medium transition-all duration-300 hover:bg-amber-50 hover:border-amber-300">
                        <span class="material-symbols-outlined !text-[18px]">
                            folder_open
                        </span>
                        Lihat Repository
                    </a>
                </div>

            </div>

        </div>

    </section>

@endsection

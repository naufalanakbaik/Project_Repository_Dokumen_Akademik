<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>Public - @yield('title')</title>

    {{-- SEO --}}
    <meta name="description" content="@yield('meta_description', 'Repository dokumen akademik digital untuk akses laporan, jurnal, penelitian, dan dokumen kampus secara modern.')">

    <meta name="keywords"
        content="repository akademik, jurnal mahasiswa, laporan tugas akhir, repository kampus, dokumen akademik">

    <meta name="author" content="Repository Akademik">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', 'Repository Dokumen Akademik')">

    <meta property="og:description" content="@yield('meta_description', 'Repository dokumen akademik digital modern.')">

    <meta property="og:type" content="website">

    {{-- Preconnect --> agar icon tidak 2x relaod --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"rel="stylesheet">

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap"rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preload" as="image" href="{{ asset('img/pp.webp') }}">

    {{-- Custom Styles Global --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            line-height: 1;
        }

        .hero-gradient {
            background:
                radial-gradient(circle at top left,
                    rgba(59, 130, 246, 0.12),
                    transparent 35%),
                radial-gradient(circle at bottom right,
                    rgba(168, 85, 247, 0.12),
                    transparent 35%);
        }
    </style>
</head>

<body class="bg-white text-gray-800 antialiased scroll-smooth">

    {{-- Top Head Information --}}
    <div class="text-xs bg-yellow-400 dark:bg-gray-200">
        <div class="max-w-7xl mx-auto px-8 py-2 flex justify-between items-center">

            <div class="flex items-center gap-6">
                <span class="flex items-center text-[11px] gap-2 text-gray-800 dark:text-gray-500">
                    Repository Akademik System
                    <span class="text-gray-800 dark:text-gray-500">v1.0</span>
                </span>

                <span class="hidden md:block text-[11px] text-gray-600 dark:text-gray-500">
                    Sistem pengelolaan dokumen akademik dan repositori digital
                </span>
            </div>

            {{-- Right --}}
            <div class="hidden md:flex items-center gap-2 text-[11px] text-gray-600 dark:text-gray-500">
                <span class="font-medium">
                    {{ now()->translatedFormat('l') }},
                </span>

                <span>
                    {{ now()->translatedFormat('d F Y') }}
                </span>
            </div>

        </div>
    </div>

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-white/50 dark:bg-gray-900 backdrop-blur-md  dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                {{-- Left Section --}}
                <div class="flex items-center gap-20">

                    {{-- Logo unsri --}}
                    <a href="{{ route('landing') }}" class="flex items-center gap-2.5 min-w-0 group">
                        <div class="shrink-0">
                            <img src="{{ asset('img/logo-img/logo-unsri.png') }}" class="w-9 h-9 object-contain">
                        </div>
                        <div class="leading-tight min-w-0">
                            <h1 class="text-[13px] sm:text-sm font-semibold text-gray-900 truncate">
                                Program Studi Manajemen Informatika
                            </h1>
                            <p class="text-[11px] text-gray-500 truncate">
                                Fakultas Ilmu Komputer · Universitas Sriwijaya
                            </p>
                        </div>
                    </a>

                    {{-- Menu --}}
                    <div class="hidden md:flex items-center gap-9 text-[14px] font-medium">
                        @php
                            function navClass($isActive)
                            {
                                return 'relative inline-block px-1 py-2 text-sm font-medium transition duration-200 ' .
                                    ($isActive
                                        ? 'text-amber-600'
                                        : 'text-gray-600 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-500') .
                                    " after:content-[''] after:absolute after:left-1/2 after:-translate-x-1/2
                                        after:-bottom-1 after:h-[2.5px] after:rounded-full
                                        after:bg-amber-600 after:transition-all after:duration-300 " .
                                    ($isActive ? 'after:w-6' : 'after:w-0 hover:after:w-6');
                            }
                        @endphp

                        {{-- Beranda --}}
                        <a href="{{ route('landing') }}" class="{{ navClass(request()->routeIs('landing')) }}">
                            Beranda
                        </a>

                        {{-- Repository --}}
                        <a href="{{ route('repository') }}" class="{{ navClass(request()->routeIs('repository*')) }}">
                            Repositori
                        </a>

                        {{-- Repository --}}
                        <a href="{{ route('profile') }}" class="{{ navClass(request()->routeIs('profile')) }}">
                            Profile Kami
                        </a>
                    </div>
                </div>

                {{-- Right section --}}
                <div class="relative inline-block text-left">

                    {{-- Login --}}
                    <div class="flex items-center gap-0.5">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-[13px] font-medium text-gray-500 hover:text-gray-600 transition">
                            Masuk
                        </a>
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-white text-gray-600 border border-amber-300 text-[12px] 
                            font-medium shadow-sm transition hover:bg-amber-50 hover:shadow-md">
                            <span class="material-symbols-outlined text-amber-600 !text-[16px]">
                                login
                            </span>
                            Login Sistem
                        </a>
                        {{-- <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-amber-400 text-white text-[12px] font-medium shadow-sm 
                            transition hover:bg-amber-500 hover:shadow-md">
                            Login Sistem
                        </a> --}}
                    </div>

                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="relative mt-10 border-t border-gray-200 bg-gradient-to-b from-white to-amber-50/30">
        {{-- Top --}}
        <div class="max-w-[77rem] mx-auto px-6 py-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- Brand --}}
                <div class="lg:col-span-5">

                    {{-- Logo --}}
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-amber-200 bg-amber-50 text-amber-700 shadow-sm">
                            <span class="material-symbols-outlined !text-[24px]">
                                library_books
                            </span>
                        </div>
                        <div>
                            <h2 class="text-[17px] font-semibold text-gray-900 leading-tight">
                                Repository Dokumen Akademik
                            </h2>
                            <p class="text-[13px] text-gray-500">
                                Sistem Repository Digital
                            </p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <p class="mt-5 text-[14px] leading-relaxed text-gray-600 max-w-xl">
                        Platform digital modern untuk pengelolaan, penyimpanan,
                        pencarian, dan distribusi dokumen akademik secara
                        terpusat di lingkungan Program Studi Manajemen Informatika
                        Fakultas Ilmu Komputer Universitas Sriwijaya.
                    </p>

                    {{-- Info --}}
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-[12px] text-gray-600 shadow-sm">
                            <span class="material-symbols-outlined !text-[16px] text-amber-600">
                                verified
                            </span>
                            Repository Terverifikasi
                        </div>

                        <div class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-[12px] text-gray-600 shadow-sm">
                            <span class="material-symbols-outlined !text-[16px] text-amber-600">
                                security
                            </span>
                            Akses Aman & Terstruktur
                        </div>
                    </div>
                </div>

                {{-- Navigation --}}
                <div class="lg:col-span-2">
                    <h3 class="text-[14px] font-semibold text-gray-900 mb-4">
                        Navigasi
                    </h3>
                    <div class="space-y-3">
                        <a href="#" class="block text-[13px] text-gray-500 transition hover:text-amber-700">
                            Beranda
                        </a>
                        <a href="#" class="block text-[13px] text-gray-500 transition hover:text-amber-700">
                            Repository
                        </a>
                        <a href="#" class="block text-[13px] text-gray-500 transition hover:text-amber-700">
                            Dokumen Favorit
                        </a>
                        <a href="#" class="block text-[13px] text-gray-500 transition hover:text-amber-700">
                            Tentang Sistem
                        </a>
                    </div>
                </div>

                {{-- Category --}}
                <div class="lg:col-span-2">
                    <h3 class="text-[14px] font-semibold text-gray-900 mb-4">
                        Kategori
                    </h3>
                    <div class="space-y-3">
                        <p class="text-[13px] text-gray-500">
                            Laporan Tugas Akhir
                        </p>
                        <p class="text-[13px] text-gray-500">
                            Laporan Kerja Praktik
                        </p>
                        <p class="text-[13px] text-gray-500">
                            Jurnal Mahasiswa
                        </p>
                        <p class="text-[13px] text-gray-500">
                            Modul Praktikum
                        </p>
                    </div>
                </div>

                {{-- Contact --}}
                <div class="lg:col-span-3">
                    <h3 class="text-[14px] font-semibold text-gray-900 mb-4">
                        Informasi
                    </h3>
                    <div class="space-y-4">

                        {{-- Fakultas --}}
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined !text-[18px] text-amber-600 mt-0.5">
                                school
                            </span>
                            <div>
                                <p class="text-[13px] font-medium text-gray-700">
                                    Fakultas Ilmu Komputer
                                </p>
                                <p class="text-[12px] leading-relaxed text-gray-500">
                                    Universitas Sriwijaya
                                </p>
                            </div>
                        </div>

                        {{-- Program Studi --}}
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined !text-[18px] text-amber-600 mt-0.5">
                                account_balance
                            </span>
                            <div>
                                <p class="text-[13px] font-medium text-gray-700">
                                    Manajemen Informatika
                                </p>
                                <p class="text-[12px] leading-relaxed text-gray-500">
                                    Program Studi Digital Repository
                                </p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined !text-[18px] text-amber-600 mt-0.5">
                                mail
                            </span>
                            <div>
                                <p class="text-[13px] font-medium text-gray-700">
                                    repository@unsri.ac.id
                                </p>
                                <p class="text-[12px] leading-relaxed text-gray-500">
                                    Kontak & Bantuan Sistem
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom --}}
        <div class="border-t border-gray-200 bg-white/70 backdrop-blur-sm">
            <div class="max-w-[77rem] mx-auto px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                {{-- Copyright --}}
                <p class="text-[12px] text-gray-500 leading-relaxed">
                    © 2025 - {{ date('Y') }} Repository Dokumen Akademik.
                    Seluruh hak cipta dilindungi.
                </p>

                {{-- Bottom Links --}}
                <div class="flex items-center gap-5">
                    <a href="#" class="text-[12px] text-gray-500 transition hover:text-amber-700">
                        Kebijakan Privasi
                    </a>
                    <a href="#" class="text-[12px] text-gray-500 transition hover:text-amber-700">
                        Panduan Pengguna
                    </a>
                    <a href="#" class="text-[12px] text-gray-500 transition hover:text-amber-700">
                        Bantuan
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'Repository Dokumen Akademik')</title>

    <meta name="description" content="@yield(
        'meta_description',
        'Repository dokumen akademik digital untuk akses laporan, jurnal, penelitian, 
                                dan dokumen kampus secara modern.'
    )">

    <meta name="keywords"
        content="repository akademik, jurnal mahasiswa, laporan tugas akhir, repository kampus, dokumen akademik">

    <meta name="author" content="Repository Akademik">

    <meta property="og:title" content="@yield('title', 'Repository Dokumen Akademik')">

    <meta property="og:description" content="@yield('meta_description', 'Repository dokumen akademik digital modern.')">

    <meta property="og:type" content="website">

    {{-- Img web browser --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    {{-- Custom Styles GGlobal --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background:
                radial-gradient(circle at top left, rgba(59, 130, 246, 0.12), transparent 35%),
                radial-gradient(circle at bottom right, rgba(168, 85, 247, 0.12), transparent 35%);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased scroll-smooth">

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

            <div class="flex items-center gap-5">
                {{-- <a href="{{ route('publisher.documentation') }}"
                    class="transition duration-200 font-normal {{ request()->routeIs('publisher.documentation')
                        ? 'text-red-500 dark:text-red-500'
                        : 'hover:text-blue-500 dark:hover:text-blue-400' }}">
                    Dokumentasi
                </a>

                <a href="{{ route('publisher.help') }}"
                    class="transition duration-200 font-normal {{ request()->routeIs('publisher.help')
                        ? 'text-red-500 dark:text-red-500'
                        : 'hover:text-blue-500 dark:hover:text-blue-400' }}">
                    Bantuan
                </a> --}}
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-white/50 dark:bg-gray-900 backdrop-blur-md  dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                {{-- Left Section --}}
                <div class="flex items-center gap-20">

                    {{-- Logo --}}
                    <a href="{{ route('landing') }}" class="flex items-center gap-2.5 min-w-0 group">
                        {{-- Logo --}}
                        <div class="shrink-0">
                            <img src="{{ asset('img/logo-img/logo-unsri.png') }}" class="w-9 h-9 object-contain">
                        </div>

                        {{-- Text --}}
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
                    <div class="hidden md:flex items-center gap-8 text-[14px] font-medium">
                        @php
                            function navClass($isActive)
                            {
                                return 'relative inline-block px-1 py-2 text-sm font-medium transition duration-200 ' .
                                    ($isActive
                                        ? 'text-amber-500'
                                        : 'text-gray-600 hover:text-amber-500 dark:text-gray-300 dark:hover:text-amber-500') .
                                    " after:content-[''] after:absolute after:left-1/2 after:-translate-x-1/2
                                        after:-bottom-1 after:h-[2.5px] after:rounded-full
                                        after:bg-amber-500 after:transition-all after:duration-300 " .
                                    ($isActive ? 'after:w-6' : 'after:w-0 hover:after:w-6');
                            }
                        @endphp

                        {{-- Beranda --}}
                        <a href="{{ route('landing') }}" class="{{ navClass(request()->routeIs('landing')) }}">
                            Beranda
                        </a>

                        {{-- Repository --}}
                        <a href="{{ route('repository') }}" class="{{ navClass(request()->routeIs('repository*')) }}">
                            Repository
                        </a>

                        {{-- Repository --}}
                        <a href="/" class="{{ navClass(request()->routeIs('/')) }}">
                            Tentang Kami
                        </a>
                    </div>
                </div>

                {{-- Right section --}}
                <div class="relative inline-block text-left">

                    {{-- Login --}}
                    <div class="flex items-center gap-1">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-[13px] font-medium text-gray-600 hover:text-amber-400 transition">
                            Masuk
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-amber-400 hover:bg-amber-500
                            text-white text-[13px] font-medium shadow-sm transition
                            ring-1 ring-amber-300/70 hover:ring-amber-400
                            hover:shadow-amber-200/60 hover:shadow-md">

                            Login Sistem
                        </a>
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
    <footer class="border-t border-gray-200 bg-white mt-24">
        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div>
                    <h2 class="font-semibold text-gray-900">
                        Repository Dokumen Akademik
                    </h2>

                    <p class="text-sm text-gray-500 mt-2 max-w-md leading-relaxed">
                        Platform digital untuk penyimpanan, pencarian, dan pengelolaan dokumen akademik secara
                        terpusat dan modern.
                    </p>
                </div>

                <div class="text-sm text-gray-500">
                    © 2025 - {{ date('Y') }} Repository Akademik.
                </div>

            </div>

        </div>
    </footer>

</body>

</html>

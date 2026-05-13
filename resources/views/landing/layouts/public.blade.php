<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>Public - @yield('title')</title>

    {{-- SEO --}}
    <meta name="description"
        content="@yield(
            'meta_description',
            'Repository dokumen akademik digital untuk akses laporan, jurnal, penelitian, dan dokumen kampus secara modern.'
        )">

    <meta name="keywords"
        content="repository akademik, jurnal mahasiswa, laporan tugas akhir, repository kampus, dokumen akademik">

    <meta name="author" content="Repository Akademik">

    {{-- Open Graph --}}
    <meta property="og:title"
        content="@yield('title', 'Repository Dokumen Akademik')">

    <meta property="og:description"
        content="@yield('meta_description', 'Repository dokumen akademik digital modern.')">

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
                    <div class="hidden md:flex items-center gap-8 text-[14px] font-medium">
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
                            class="px-4 py-2 rounded-lg bg-white text-amber-600 border border-amber-300 text-[12px] font-medium shadow-sm 
                            transition hover:bg-amber-50 hover:shadow-md">
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
    <footer class="border-t border-gray-200 bg-white">
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

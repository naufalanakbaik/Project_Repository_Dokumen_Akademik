<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>Mahasiswa - @yield('title')</title>

    {{-- Preconnect --> agar icon tidak 2x relaod --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"rel="stylesheet">

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap"rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- Tailwind CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Global Style --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            line-height: 1;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Top Head Information --}}
    <div class="text-xs bg-yellow-400">
        <div class="max-w-7xl mx-auto px-8 py-2 flex justify-between items-center">

            <div class="flex items-center gap-6">
                <span class="flex items-center text-[11px] gap-2 text-gray-800">
                    Repository Akademik System
                    <span class="text-gray-800">v1.0</span>
                </span>

                <span class="hidden md:block text-[11px] text-gray-600">
                    Sistem pengelolaan dokumen akademik dan repositori digital
                </span>
            </div>

            {{-- Right --}}
            <div class="hidden md:flex items-center gap-2 text-[11px] text-gray-600">
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
    <nav class="sticky top-0 z-50 bg-white/50 backdrop-blur-md ">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                {{-- Left Section --}}
                <div class="flex items-center gap-20">

                    {{-- Logo unsri --}}
                    <a href="{{ route('mahasiswa.katalog.global') }}" class="flex items-center gap-2.5 min-w-0 group">
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
                                    ($isActive ? 'text-amber-600' : 'text-gray-600 hover:text-amber-600') .
                                    " after:content-[''] after:absolute after:left-1/2 after:-translate-x-1/2
                                        after:-bottom-1 after:h-[2.5px] after:rounded-full
                                        after:bg-amber-600 after:transition-all after:duration-300 " .
                                    ($isActive ? 'after:w-6' : 'after:w-0 hover:after:w-6');
                            }
                        @endphp

                        {{-- Beranda --}}
                        <a href="{{ route('mahasiswa.home') }}"
                            class="{{ navClass(request()->routeIs('mahasiswa.home')) }}">
                            Beranda
                        </a>

                        {{-- Repositori --}}
                        <a href="{{ route('mahasiswa.katalog.global') }}"
                            class="{{ navClass(request()->routeIs('mahasiswa.katalog.*')) }}">
                            Repositori
                        </a>

                        {{-- Dashboard --}}
                        <a href="{{ route('mahasiswa.dashboard') }}"
                            class="{{ navClass(request()->routeIs('mahasiswa.dashboard')) }}">
                            Aktivitas Saya
                        </a>

                        {{-- Dokumen Saya --}}
                        <a href="{{ route('mahasiswa.documents.index') }}"
                            class="{{ navClass(request()->routeIs('mahasiswa.documents.*')) }}">
                            Dokumen Saya
                        </a>
                    </div>
                </div>

                {{-- Right section --}}
                <div class="relative inline-block text-left">

                    {{-- Notifikasi --}}
                    {{-- <div class="relative">
                        <a href="{{ route('publisher.notifications.index') }}">
                            <span class="material-symbols-outlined text-gray-700">
                                notifications
                            </span>
                            @if (auth()->user()->unreadNotifications->count())
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                    </div> --}}

                    {{-- Fitur profile dropdown --}}
                    <button id="userMenuButton"
                        class="flex items-center gap-1 text-sm transition text-gray-700 hover:text-blue-600 focus:outline-none">
                        <span class="font-normal ml-2">
                            {{ auth()->user()->name }}
                        </span>

                        {{-- Dropdown Icon --}}
                        <span id="dropdownIcon"
                            class="material-symbols-outlined !text-base text-gray-400 transition-transform duration-200">
                            arrow_drop_down
                        </span>
                    </button>

                    {{-- Menu dropdown --}}
                    <div id="userDropdown"
                        class="absolute right-0 mt-2 w-64 bg-white border border-gray-300
                        rounded-lg shadow-sm opacity-0 invisible transition">

                        {{-- User Header --}}
                        <div class="px-6 py-3 bg-white border-b border-gray-300 rounded-tl-lg rounded-tr-lg">
                            <div class="flex items-center gap-3">
                                {{-- Avatar --}}
                                <div class="flex-shrink-0">
                                    @if (auth()->user()->foto_profile)
                                        <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}"
                                            class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md ring-1 ring-gray-200">
                                    @else
                                        <div
                                            class="w-14 h-14 rounded-full bg-blue-100 border-2 border-blue-200 flex items-center justify-center shadow-sm">
                                            <span class="text-lg font-semibold text-blue-700 uppercase">
                                                {{ \Illuminate\Support\Str::substr(auth()->user()->name, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- User info --}}
                                <div class="flex flex-col leading-tight">
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="text-[11px] text-gray-600 truncate max-w-[160px]">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Menu --}}
                        <div class="py-2">
                            {{-- Profile --}}
                            <a href="{{ route('mahasiswa.profile.show') }}"
                                class="block px-5 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profil Saya
                            </a>
                            <a href="{{ route('mahasiswa.katalog.favorites') }}"
                                class="block px-5 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Dokumen Tersimpan
                            </a>

                            {{-- Divider --}}
                            <div class="border-t border-gray-200 my-1"></div>

                            {{-- Logout --}}
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="w-full text-left px-5 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        {{-- Message succes --}}
        @if (session('success'))
            <div class="max-w-[77rem] mx-auto mt-2.5 mb-1">
                <div
                    class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-emerald-700 shadow-sm">
                    {{-- Icon --}}
                    <span class="material-symbols-outlined !text-[19px] text-emerald-600 shrink-0">
                        check_circle
                    </span>
                    {{-- Message --}}
                    <p class="text-[13px] font-medium leading-relaxed">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        @endif

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
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl border border-amber-200 bg-amber-50 text-amber-700 shadow-sm">
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
                        <div
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-[12px] text-gray-600 shadow-sm">
                            <span class="material-symbols-outlined !text-[16px] text-amber-600">
                                verified
                            </span>
                            Repository Terverifikasi
                        </div>

                        <div
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-[12px] text-gray-600 shadow-sm">
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
            <div
                class="max-w-[77rem] mx-auto px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

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

    {{-- Js Dropdown arrow profile --}}
    <script>
        const button = document.getElementById('userMenuButton');
        const dropdown = document.getElementById('userDropdown');
        const icon = document.getElementById('dropdownIcon');

        button.addEventListener('click', function(e) {
            e.stopPropagation();

            dropdown.classList.toggle('opacity-0');
            dropdown.classList.toggle('scale-95');
            dropdown.classList.toggle('invisible');

            icon.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('opacity-0', 'scale-95', 'invisible');
                icon.classList.remove('rotate-180');
            }
        });
    </script>

    {{-- Chart Js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>

</html>

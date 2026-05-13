<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Title -->
    <title>Mahasiswa - @yield('title')</title>

    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icon web browser --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- Preconnect --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Material icon --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

    {{-- Global style --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
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
                    <div class="hidden md:flex items-center gap-8 text-[14px] font-medium">
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
                            Dashboard
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
                                @php
                                    $name = auth()->user()->name;
                                    $initials = collect(explode(' ', $name))
                                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                        ->take(1)
                                        ->join('');
                                @endphp

                                <div class="h-10 w-10 rounded-full overflow-hidden shadow-sm ring-1 ring-gray-200 ">
                                    <div
                                        class="w-full h-full flex items-center justify-center
                                        bg-gray-100 text-gray-600 font-serif font-semibold text-sm">
                                        {{ $initials }}
                                    </div>
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
        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                <span class="material-symbols-outlined !text-[20px] text-emerald-600">
                    check_circle
                </span>
                <p class="text-sm font-medium leading-relaxed">
                    {{ session('success') }}
                </p>
            </div>
        @endif

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

    {{-- Js Dropdown Toogle profile --}}
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

    @stack('scripts')
</body>

</html>

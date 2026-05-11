<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Js darkmode Agar tidak relad 2x -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Title -->
    <title>Dosen - @yield('title')</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon web browser -->
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    <!-- Material icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Global style -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="dark:bg-gray-900">

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
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Left Section --}}
                <div class="flex items-center gap-10">

                    {{-- Logo + Brand --}}
                    <a href="{{ route('dosen.dashboard') }}" class="flex items-center gap-2.5 group">
                        <img src="{{ asset('img/logo-img/logo-unsri.png') }}" class="h-9 w-9 object-contain">
                        <div class="flex flex-col leading-tight">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                Program Studi Manajemen Informatika
                            </span>
                            <span class="text-[11px] text-gray-500 dark:text-gray-200">
                                Fakultas Ilmu Komputer
                            </span>
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
                                        : 'text-gray-600 hover:text-amber-600 dark:text-gray-300 dark:hover:text-amber-300') .
                                        " after:content-[''] after:absolute after:left-1/2 after:-translate-x-1/2
                                        after:-bottom-1 after:h-[2.5px] after:rounded-full
                                        after:bg-amber-600 after:transition-all after:duration-300 " .
                                    ($isActive ? 'after:w-6' : 'after:w-0 hover:after:w-6');
                            }
                        @endphp

                        {{-- Repositori --}}
                        <a href="{{ route('dosen.katalog.global') }}"
                            class="{{ navClass(request()->routeIs('dosen.katalog.*')) }}">
                            Repositori
                        </a>

                        {{-- Dashboard --}}
                        <a href="{{ route('dosen.dashboard') }}"
                            class="{{ navClass(request()->routeIs('dosen.dashboard')) }}">
                            Dashboard
                        </a>

                        {{-- Dokumen Saya --}}
                        <a href="{{ route('dosen.documents.index') }}"
                            class="{{ navClass(request()->routeIs('dosen.documents.*')) }}">
                            Dokumen Saya
                        </a>
                    </div>
                </div>

                {{-- Right section --}}
                <div class="relative inline-block text-left">

                    {{-- User Menu Button --}}
                    <button id="userMenuButton"
                        class="flex items-center gap-1 text-sm transition text-gray-700 dark:text-gray-200
                        hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none">

                        {{-- Avatar --}}
                        {{-- <div class="h-8 w-8 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 text-white flex items-center justify-center font-semibold text-xs shadow-sm ring-2 ring-white dark:ring-gray-900">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>  --}}

                        <span class="font-normal ml-2">
                            {{ auth()->user()->name }}
                        </span>

                        {{-- Dropdown Icon --}}
                        <span id="dropdownIcon"
                            class="material-icons !text-base text-gray-400 dark:text-gray-500 transition-transform duration-200">
                            arrow_drop_down
                        </span>
                    </button>

                    {{-- Dropdwon --}}
                    <div id="userDropdown"
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700
                        rounded-lg shadow-sm opacity-0 invisible transition">

                        {{-- User Header --}}
                        <div
                            class="px-6 py-3 bg-white dark:bg-gray-900 border-b border-gray-300 dark:border-gray-700 rounded-tl-lg rounded-tr-lg">

                            <div class="flex items-center gap-3">
                                {{-- Avatar --}}
                                @php
                                    $name = auth()->user()->name;
                                    $initials = collect(explode(' ', $name))
                                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                        ->take(1)
                                        ->join('');
                                @endphp

                                <div class="h-10 w-10 rounded-full overflow-hidden shadow-sm ring-1 ring-yellow-200 dark:ring-gray-900">
                                    <div
                                        class="w-full h-full flex items-center justify-center
                                        bg-yellow-100 text-yellow-600 font-serif font-semibold text-sm">
                                        {{ $initials }}
                                    </div>
                                </div>

                                {{-- <div
                                    class="h-10 w-10 rounded-full overflo w-hidden shadow-sm ring-2 ring-white dark:ring-gray-900">

                                    @if (auth()->user()->photo)
                                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Avatar"
                                            class="w-full h-full rounded-full border-gray-200 dark:border-gray-100 object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center 
                                            border border-yellow-300 dark:bg-gray-800 dark:border-gray-700">
                                            <span class="material-icons text-yellow-400 !text-[20px]">
                                                person
                                            </span>
                                        </div>
                                    @endif
                                </div> --}}

                                {{-- User info --}}
                                <div class="flex flex-col leading-tight">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="text-[11px] text-gray-600 dark:text-gray-400 truncate max-w-[160px]">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Menu --}}
                        <div class="py-2">
                            {{-- Profile --}}
                            <a href="{{ route('dosen.profile.show') }}"
                                class="block px-5 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Profil Saya
                            </a>

                            {{-- Divider --}}
                            <div class="border-t border-gray-200 my-1"></div>

                            {{-- Button dark mode --}}
                            <button id="darkToggle"
                                class="flex items-center gap-3 w-full px-5 py-2 text-sm text-gray-700 dark:text-gray-200
                                hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <span id="darkIcon" class="material-icons text-gray-600 dark:text-gray-300">
                                    dark_mode
                                </span>
                                Toggle Dark Mode
                            </button>


                            {{-- Logout --}}
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button
                                    class="w-full text-left px-5 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
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
    <main class="max-w-7xl mx-auto px-8 py-5">
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

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

    {{-- Js Dark Mode --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("darkToggle");
            if (!toggle) return;
            toggle.addEventListener("click", function() {
                const html = document.documentElement;
                html.classList.toggle("dark");
                if (html.classList.contains("dark")) {
                    localStorage.setItem("theme", "dark");
                } else {
                    localStorage.setItem("theme", "light");
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>

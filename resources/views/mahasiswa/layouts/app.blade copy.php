<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Title --}}
    <title>@yield('title', 'Publisher')</title>
    {{-- Js darkmode Agar tidak relad 2x --}}
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    @vite('resources/css/app.css')
    {{-- web icon --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">
    {{-- material icon --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />

</head>

<body class="bg-gray-100 dark:bg-gray-900">

    {{-- Top Head Information --}}
    <div class="bg-gray-800 dark:bg-gray-200 text-gray-300 dark:text-gray-700 text-xs">
        <div class="max-w-7xl mx-auto px-8 py-2 flex justify-between items-center">

            <div class="flex items-center gap-6">
                <span class="flex items-center gap-2">
                    Repository System
                    <span class="text-gray-500 dark:text-gray-500">v1.0</span>
                </span>
                <span class="hidden md:block text-gray-500 dark:text-gray-500">
                    Sistem pengelolaan jurnal ilmiah dan karya akademik
                </span>
            </div>

            <div class="flex items-center gap-5">
                <a href="{{ route('publisher.documentation') }}"
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
                </a>


            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Left Section --}}
                <div class="flex items-center gap-10">

                    {{-- Logo + Brand --}}
                    <a href="{{ route('publisher.dashboard') }}"
                        class="flex items-center gap-2 tracking-wide text-gray-800 dark:text-gray-200">
                        <img src="{{ asset('img/logo-katalog_pustaka.png') }}" class="h-8 w-8 object-contain">
                        <span class="text-base font-medium text-blue-800 dark:text-blue-400">
                            Publisher Panel
                        </span>
                    </a>

                    {{-- Menu --}}
                    <div class="hidden md:flex items-center gap-8 text-sm font-normal tracking-wide">

                        {{-- <a href="{{ route('publisher.dashboard') }}"
                            class="transition duration-200 font-normal {{ request()->routeIs('publisher.dashboard')
                                ? 'text-blue-600 dark:text-blue-400'
                                : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                            Dashboard
                        </a> --}}

                        @php
                            $isDashboardActive = request()->routeIs('publisher.dashboard');
                        @endphp
                        <a href="{{ route('publisher.dashboard') }}"
                            class="relative transition
                            {{ $isDashboardActive
                                ? 'text-blue-600 dark:text-blue-400'
                                : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400' }}

                            after:content-[''] after:absolute after:left-1/2 after:-translate-x-1/2
                            after:-bottom-2 after:h-[3px] 
                            after:bg-blue-600 after:rounded-full
                            after:transition-all after:duration-300

                            {{ $isDashboardActive
                                ? 'after:w-8 after:bg-blue-600 dark:after:bg-blue-400'
                                : 'after:w-0 after:bg-blue-600 dark:after:bg-blue-400 hover:after:w-8' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('publisher.journals.global') }}"
                            class="transition duration-200 font-normal
                            {{ request()->routeIs('publisher.journals.global') || request()->routeIs('publisher.journals.show')
                                ? 'text-blue-600 dark:text-blue-400'
                                : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                            Katalog
                        </a>

                        <a href="{{ route('publisher.journals.index') }}"
                            class="transition duration-200 font-normal 
                            {{ request()->routeIs('publisher.journals.index') || request()->routeIs('publisher.journals.edit')
                                ? 'text-blue-600 dark:text-blue-400'
                                : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400' }}">
                            Jurnal
                        </a>
                    </div>
                </div>

                {{-- Right section --}}
                <div class="relative inline-block text-left">

                    {{-- <div class="relative">
                        <a href="{{ route('publisher.notifications.index') }}">

                            <span class="material-icons text-gray-700 dark:text-gray-200">
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

                    <button id="userMenuButton"
                        class="flex items-center gap-1 text-sm transition text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 focus:outline-none">


                        {{-- Avatar --}}
                        {{-- <div class="h-8 w-8 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 text-white flex items-center justify-center font-semibold text-xs shadow-sm ring-2 ring-white dark:ring-gray-900">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>  --}}

                        <span class="font-normal ml-2">
                            {{ auth()->user()->name }}
                        </span>

                        {{-- Dropdown Icon --}}
                        <span id="dropdownIcon"
                            class="material-icons text-base mt-0.5 text-gray-400 dark:text-gray-500 transition-transform duration-200">
                            arrow_drop_down
                        </span>
                    </button>

                    {{-- Dropdwon --}}
                    <div id="userDropdown"
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                        rounded-xl shadow-lg opacity-0 invisible transition">

                        {{-- User Header --}}
                        <div
                            class="px-6 py-3 bg-gray-100 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 rounded-tl-xl rounded-tr-xl">

                            <div class="flex items-center gap-3">
                                <!-- Avatar -->
                                <div
                                    class="h-10 w-10 rounded-full overflo
                                w-hidden shadow-sm ring-2 ring-white dark:ring-gray-900">
                                    @if (auth()->user()->photo)
                                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Avatar"
                                            class="w-full h-full rounded-full border-gray-200 dark:border-gray-100 object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800
                                                flex items-center justify-center border border-gray-200 dark:border-gray-700">
                                            <span class="material-icons text-gray-400 !text-[20px]">
                                                person
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- User Info -->
                                <div class="flex flex-col leading-tight">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate max-w-[160px]">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- Menu --}}
                        <div class="py-2">

                            {{-- Button dark mode --}}
                            <button id="darkToggle"
                                class="flex items-center gap-3 w-full px-5 py-2 text-sm text-gray-700 dark:text-gray-200
                            hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <span id="darkIcon" class="material-icons text-gray-600 dark:text-gray-300">
                                    dark_mode
                                </span>
                                Toggle Dark Mode
                            </button>

                            {{-- Profile --}}
                            <a href="{{ route('publisher.profile.show') }}"
                                class="block px-5 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Profil Saya
                            </a>

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
</body>

</html>

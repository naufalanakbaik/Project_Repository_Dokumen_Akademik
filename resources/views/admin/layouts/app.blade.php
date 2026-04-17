<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Title -->
    <title>Admin - @yield('title')</title>

    <!-- Icon web browser -->
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    <!-- Google Fonts: Inter & Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    {{-- /* Global Font Application */ --}}
    <style>

    </style>

    {{-- Material icon --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />

    {{-- alpine.js dropdown sidebar --}}
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- Style CSS Sidebar --}}
    <style>
        body,
        * {
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        /* dropdown sidebar */
        [x-cloak] {
            display: none !important;
        }

        #sidebar {
            transition: width 0.25s ease;
        }

        #sidebar.minimized {
            overflow: visible;
        }

        /* sembunyikan text menu */
        #sidebar.minimized .menu-text {
            opacity: 0;
            visibility: hidden;
            width: 0;
        }

        /* sembunyikan submenu */
        #sidebar.minimized .submenu {
            display: none !important;
        }

        /* pusatkan icon saat minimize */
        #sidebar.minimized a,
        #sidebar.minimized .menu-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        /* icon tetap stabil */
        #sidebar img,
        #sidebar .material-icons {
            flex-shrink: 0;
        }

        #sidebar a {
            transition:
                background-color .15s ease,
                color .15s ease,
                transform .12s ease;
        }

        /* hover effect lebih smooth */
        #sidebar a:hover {
            transform: translateX(2px);
        }

        /* saat minimized jangan geser */
        #sidebar.minimized a:hover {
            transform: none;
        }

        #sidebar.minimized .sidebar-heading .full-text {
            display: none;
        }

        #sidebar.minimized .sidebar-heading .short-text {
            display: inline;
        }

        .sidebar-heading span {
            transition: all 0.2s ease;
        }

        .submenu {
            transition:
                opacity .15s ease,
                transform .15s ease;
        }

        .submenu.popover {
            position: absolute !important;
            left: 100% !important;
            top: 0 !important;
            margin-left: 10px !important;
            width: 220px;
            background: white;
            border-radius: 10px;
            padding: 8px;
            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.06),
                0 2px 6px rgba(0, 0, 0, 0.05);
            z-index: 9999;
            animation: sidebarPopover .15s ease;
        }

        @keyframes sidebarPopover {
            from {
                opacity: 0;
                transform: translateX(-5px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50">

    <!-- Container bar -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed top-0 left-0 h-screen w-64 bg-white 
            flex flex-col border-r border-gray-200 transition-all duration-300 overflow-hidden">

            {{-- Side head admin -> Tombol minimize --}}
            <div class="p-4 flex justify-center items-center bg-white border-b border-gray-200">
                <span id="sidebar-title" class="text-sm text-gray-800 font-sans font-medium uppercase tracking-wide">
                    Halaman Admin
                </span>
                <button id="toggleSidebar" class="flex items-center justify-center w-10 h-10">
                    <span id="toggleIcon"
                        class="material-icons pt-0.5 text-gray-900 !text-[17px] hover:text-blue-700 transition">
                        keyboard_arrow_left
                    </span>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto">
                <ul class="space-y-2 p-5 font-[400] font-sans text-sm">
                    <h4 class="sidebar-heading text-xs font-semibold text-gray-800 uppercase mb-2">
                        <span class="full-text">Fitur Admin</span>
                        <span class="short-text hidden">Fitur</span>
                    </h4>

                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/dashboard.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('admin.dashboard') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center py-[0.470rem] px-3 rounded-lg transition">
                            <img src="{{ asset('img/icon-sidebar/peminjaman.png') }}" class="w-5 h-5 object-contain">
                            <span class="ml-2.5 menu-text">Validasi Dokumen</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center py-[0.470rem] px-3 rounded-lg transition">
                            <img src="{{ asset('img/icon-sidebar/buku.png') }}" class="w-5 h-5 object-contain">
                            <span class="ml-2.5 menu-text">Monitoring Dokumen</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.dashboard.monitoring-pengguna') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('admin.dashboard.monitoring-pengguna') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/penerbit.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('admin.dashboard.monitoring-pengguna') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Monitoring Pengguna</span>
                        </a>
                    </li>

                    <h4 class="sidebar-heading text-xs font-semibold text-gray-800 uppercase mb-2">
                        <span class="full-text">Kelola Admin</span>
                        <span class="short-text hidden">Kelola</span>
                    </h4>

                    <li>
                        <a href="{{ route('admin.documents.index') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('admin.documents.*') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/journals.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('admin.documents.*') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Kelola Dokumen</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('admin.categories.*') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/kategori.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('admin.categories.*') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Kelola Kategori</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('admin.users.*') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/anggota.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('admin.users.*') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Kelola Pengguna</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer Sidebar -->
            <div class="bg-gray-50 border-t border-blue-200 p-4">
                <p class="sidebar-heading text-xs text-gray-700 justify-center text-center">
                    <span class="full-text font-medium text-gray-700">© {{ date('Y') }} Repositori Dokumen
                        Akademik.</span>
                    <span class="short-text hidden font-medium text-gray-800">© {{ date('Y') }}</span>
                </p>
            </div>
        </aside>

        <!-- Header & Dropdown menu -->
        <div id="mainContent" class="flex-1 flex flex-col ml-64 transition-all duration-300">

            <!-- Header logo kanan -->
            <header class=" bg-white border-gray-500 shadow flex items-center justify-between p-4">

                <!-- Header logo kiri -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo-img/logo-unsri.png') }}" alt="Logo Unsri"
                        class="h-10 w-auto object-contain">

                    <div class="flex flex-col text-gray-800 leading-tight">
                        <h3 class="text-sm sm:text-base font-semibold">
                            Fakultas Ilmu Komputer
                        </h3>
                        <h4 class="text-[11px] sm:text-xs text-gray-500">
                            Program Studi Manajemen Informatika
                        </h4>
                    </div>
                </div>

                {{-- Head Left --}}
                <div class="flex items-center space-x-4 mr-2">

                    {{-- Dropdown Menu --}}
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center focus:outline-none">
                            <img src="{{ asset('img/icon/profile-blue-icon.png') }}" alt="Profil"
                                class="w-8 h-8 rounded-full border border-gray-300">
                            <span class="ml-3 text-gray-800 font-normal text-sm">{{ Auth::user()->name }}</span>
                            <span id="profileIcon"
                                class="material-icons mt-0.5 ml-2 transform transition-transform duration-200 text-gray-700  menu-text !text-[19px]">arrow_drop_down</span>
                        </button>

                        {{-- Isi dropdown menu --}}
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg 
                            shadow-sm hidden overflow-hidden z-50">

                            <!-- Header -->
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-[11px] text-gray-500 mb-0.5">Signed in as</p>


                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-xs text-gray-500 truncate">
                                    {{ Auth::user()->email }}
                                </p>

                                <p class="text-[11px] text-gray-500 mt-2">
                                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                                </p>
                            </div>

                            <!-- Body -->
                            <div class="py-1 text-sm text-gray-700">

                                {{-- Edit Profile --}}
                                <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 transition">
                                    Edit profile
                                </a>

                                <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 transition">
                                    Dokumen masuk
                                </a>

                                <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 transition">
                                    Pesan masuk
                                </a>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 my-1"></div>

                                {{-- Fullscreen --}}
                                <button id="fullscreenBtn"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 transition">
                                    <span id="fullscreenText">Fullscreen</span>
                                </button>

                                <!-- Divider -->
                                <div class="border-t border-gray-200 my-1"></div>

                                <!-- LOGOUT -->
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                        Logout / Keluar
                                    </button>
                                </form>

                            </div>
                        </div>

                        {{-- Isi dropdown menu --}}
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-56 bg-white 
                                border border-gray-200 rounded-lg shadow-sm hidden overflow-hidden z-50">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-gray-800">
                                        Menu
                                    </span>
                                    {{-- Tanggal hari ini --}}
                                    <span class="text-xs text-gray-500 mt-0.5">
                                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Menu --}}
                            <div class="py-1">
                                {{-- Dokumen Masuk --}}
                                {{-- @if (auth()->check() && auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.journals.index') }}"
                                        class="flex items-center gap-3 px-5 py-2 text-sm text-gray-700 dark:text-gray-300 
                                            hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <img src="{{ asset('img/icon-dropdown/journals.png') }}"
                                            class="w-5 h-5 object-contain dark:invert dark:brightness-200">
                                        <span>Jurnal Masuk</span>
                                    </a>
                                @endif --}}

                                {{-- Edit Profil --}}
                                @if (Auth::check())
                                    <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                        class="flex items-center gap-3 px-5 py-2 text-sm text-gray-700 hover:bg-gray-100
                                            transition">
                                        <img src="{{ asset('img/icon-dropdown/akun.png') }}"
                                            class="w-5 h-5 object-contain">
                                        <span>Edit Profil Saya</span>
                                    </a>
                                @endif

                                {{-- Divider --}}
                                <div class="border-t border-gray-200 my-1"></div>

                                {{-- Fullscreen --}}
                                <button id="fullscreenBtn"
                                    class="w-full flex items-center gap-3 px-5 py-1.5 text-sm text-gray-700 
                                        hover:bg-gray-100 transition text-left">
                                    <span id="fullscreenIcon" class="material-icons !text-[20px] text-gray-800">
                                        crop_free
                                    </span>
                                    <span id="fullscreenText">Fullscreen</span>
                                </button>

                                {{-- Dark Mode --}}
                                {{-- <button id="darkModeBtn"
                                    class="w-full flex items-center gap-3  py-1.5 px-5 text-sm text-gray-700 dark:text-gray-300 
                                        hover:bg-gray-100 dark:hover:bg-gray-800 transition text-left">
                                    <span id="darkModeIcon"
                                        class="material-icons !text-[20px] text-gray-800 dark:text-gray-300">
                                        dark_mode
                                    </span>
                                    <span id="darkModeText">Dark Mode</span>
                                </button> --}}

                                {{-- Divider --}}
                                <div class="border-t border-gray-200 my-1"></div>

                                {{-- Logout --}}
                                @if (Auth::check())
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center px-4 py-2.5 text-xs text-gray-700 hover:bg-red-50  transition justify-center">
                                            <span class="material-icons mr-1 !text-[18px] text-red-600">logout</span>
                                            <span
                                                class="font-medium tracking-wide text-red-600 uppercase">Logout</span>
                                        </button>
                                    </form>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </header>

            <!-- Main Content -->
            <main class="flex-1 p-4">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class=" py-2.5 px-4 h-full">
                    @yield('content')
                </div>
            </main>

        </div>

    </div>

    {{-- Js dropdown dan fullscreen  --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            /* =========================
                DROPDOWN PROFILE
            ========================== */
            const profileBtn = document.getElementById("profileBtn");
            const profileDropdown = document.getElementById("profileDropdown");
            const profileIcon = document.getElementById("profileIcon");

            if (profileBtn && profileDropdown) {

                const openDropdown = () => {
                    profileDropdown.classList.remove("hidden");
                    profileIcon?.classList.add("rotate-180");
                };

                const closeDropdown = () => {
                    profileDropdown.classList.add("hidden");
                    profileIcon?.classList.remove("rotate-180");
                };

                const toggleDropdown = () => {
                    const isOpen = !profileDropdown.classList.contains("hidden");
                    isOpen ? closeDropdown() : openDropdown();
                };

                // klik tombol
                profileBtn.addEventListener("click", function(e) {
                    e.stopPropagation();
                    toggleDropdown();
                });

                // klik di luar
                document.addEventListener("click", function(e) {
                    if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
                        closeDropdown();
                    }
                });

                // tekan ESC
                document.addEventListener("keydown", function(e) {
                    if (e.key === "Escape") {
                        closeDropdown();
                    }
                });
            }

            /* =========================
                FULLSCREEN
            ========================== */
            const fullscreenBtn = document.getElementById("fullscreenBtn");
            const fullscreenIcon = document.getElementById("fullscreenIcon");
            const fullscreenText = document.getElementById("fullscreenText");

            if (fullscreenBtn) {
                fullscreenBtn.addEventListener("click", function() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen?.();
                    } else {
                        document.exitFullscreen?.();
                    }
                });
            }

            document.addEventListener("fullscreenchange", function() {
                if (!fullscreenIcon || !fullscreenText) return;

                if (document.fullscreenElement) {
                    fullscreenIcon.textContent = "fullscreen_exit";
                    fullscreenText.textContent = "Exit Fullscreen";
                } else {
                    fullscreenIcon.textContent = "crop_free";
                    fullscreenText.textContent = "Fullscreen";
                }
            });

        });
    </script>

    <!-- Script toogle minimize side bar -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const toggleBtn = document.getElementById("toggleSidebar");
            const sidebar = document.getElementById("sidebar");
            const sidebarTitle = document.getElementById("sidebar-title");
            const menuTexts = document.querySelectorAll(".menu-text");
            const mainContent = document.getElementById("mainContent");
            const toggleIcon = document.getElementById("toggleIcon");

            if (!toggleBtn || !sidebar) return;

            function setSidebar(minimized) {

                if (minimized) {

                    sidebar.classList.remove("w-64");
                    sidebar.classList.add("w-20", "minimized");

                    mainContent?.classList.remove("ml-64");
                    mainContent?.classList.add("ml-20");

                    sidebarTitle?.classList.add("hidden");

                    menuTexts.forEach(text => {
                        text.classList.add("hidden");
                    });

                    if (toggleIcon) {
                        toggleIcon.innerText = "keyboard_arrow_right";
                    }

                    localStorage.setItem("sidebarMinimized", "1");

                } else {

                    sidebar.classList.remove("w-20", "minimized");
                    sidebar.classList.add("w-64");

                    mainContent?.classList.remove("ml-20");
                    mainContent?.classList.add("ml-64");

                    sidebarTitle?.classList.remove("hidden");

                    menuTexts.forEach(text => {
                        text.classList.remove("hidden");
                    });

                    if (toggleIcon) {
                        toggleIcon.innerText = "keyboard_arrow_left";
                    }

                    localStorage.setItem("sidebarMinimized", "0");
                }
            }

            const savedState = localStorage.getItem("sidebarMinimized") === "1";
            setSidebar(savedState);

            toggleBtn.addEventListener("click", () => {

                const isMinimized = sidebar.classList.contains("minimized");
                setSidebar(!isMinimized);
            });
        });
    </script>

    @stack('scripts')

</body>

</html>

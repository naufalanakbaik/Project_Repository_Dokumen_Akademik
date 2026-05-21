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


    <!--Material icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- alpine.js dropdown sidebar -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Style CSS Sidebar -->
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

            <!-- Side head admin -> Tombol minimize -->
            <div class="relative bg-white">
                <div id="sidebarHeader" class="py-4 px-4 flex items-center justify-between transition-all duration-300">

                    <!-- Title -->
                    <div id="sidebarTitleWrapper" class="flex flex-col leading-tight transition-all duration-300">
                        <span id="sidebar-title" class="text-sm font-semibold text-gray-800 tracking-wide">
                            Kaprodi
                        </span>
                        <span class="text-[11px] text-gray-400">
                            Dashboard Control
                        </span>
                    </div>

                    <!-- Toggle -->
                    <button id="toggleSidebar"
                        class="group w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 bg-white
                        shadow-sm hover:bg-gray-50 transition-all duration-300">
                        <span id="toggleIcon"
                            class="material-symbols-outlined text-gray-700 !text-[20px]
                            transition-transform duration-300 group-hover:scale-110">
                            menu_open
                        </span>
                    </button>
                </div>
            </div>

            <!-- Menu sidebar -->
            <nav class="flex-1 overflow-y-auto">
                <ul class="space-y-2 py-3 px-5 font-[400] font-sans text-sm">
                    <h4 class="sidebar-heading text-xs font-semibold text-gray-800 uppercase mb-2">
                        <span class="full-text">Dashboard Kaprodi</span>
                        <span class="short-text hidden">Fitur</span>
                    </h4>

                    <li>
                        <a href="{{ route('kaprodi.dashboard') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('kaprodi.dashboard') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/dashboard.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('kaprodi.dashboard') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Dashboard</span>
                        </a>
                    </li>

                    <h4 class="sidebar-heading text-xs font-semibold text-gray-800 uppercase mb-2">
                        <span class="full-text">Daftar Kaprodi</span>
                        <span class="short-text hidden">Daftar</span>
                    </h4>

                    <li>
                        <a href="{{ route('kaprodi.documents.index') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('kaprodi.documents.*') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/journals.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('kaprodi.documents.*') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Daftar Dokumen</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('kaprodi.monitoring.mahasiswa') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('kaprodi.monitoring.mahasiswa') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/anggota.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('kaprodi.monitoring.mahasiswa') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Daftar Pengguna</span>
                        </a>
                    </li>

                    <h4 class="sidebar-heading text-xs font-semibold text-gray-800 uppercase mb-2">
                        <span class="full-text">Aktivitas Kaprodi</span>
                        <span class="short-text hidden">Daftar</span>
                    </h4>

                    <li>
                        <a href="{{ route('kaprodi.activity') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('kaprodi.activity') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/akun.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('kaprodi.activity') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Aktivitas Pengguna</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('kaprodi.report.export') }}"
                            class="flex items-center py-[0.470rem] px-3 rounded-lg transition
                            {{ request()->routeIs('kaprodi.report.export') ? 'bg-blue-700 text-white shadow-sm' : 'text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/peminjaman.png') }}"
                                class="w-5 h-5 object-contain
                            {{ request()->routeIs('kaprodi.report.export') ? 'brightness-0 invert' : '' }}">
                            <span class="ml-2.5 menu-text">Export Excel</span>
                        </a>
                    </li> --}}
                </ul>
            </nav>

            <!-- Footer Sidebar -->
            <div class="bg-white border-t border-gray-200 p-4">
                <p class="sidebar-heading text-xs text-gray-700 justify-center text-center">
                    <span class="full-text font-medium text-gray-700">© {{ date('Y') }} Repositori Dokumen
                        Akademik.</span>
                    <span class="short-text hidden font-medium text-gray-800">© {{ date('Y') }}</span>
                </p>
            </div>
        </aside>

        <!-- Header & Dropdown menu -->
        <div id="mainContent" class="flex-1 flex flex-col ml-64 transition-all duration-300">
            <header class=" bg-white border-gray-500 shadow flex items-center justify-between p-4">

                <!-- Header logo kiri -->
                <div class="flex items-center gap-2 group">
                    <img src="{{ asset('img/logo-img/logo-unsri.png') }}" class="h-10 w-10 object-contain">
                    <div class="flex flex-col leading-tight">
                        <span class="text-sm sm:text-base font-semibold text-gray-800 dark:text-gray-100">
                            Program Studi Manajemen Informatika
                        </span>
                        <span class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400">
                            Fakultas Ilmu Komputer
                        </span>
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
                                class="material-icons mt-0.5 ml-2 transform transition-transform duration-200 text-gray-700 !text-[19px]">arrow_drop_down</span>
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
                                <a href="{{ route('kaprodi.profile.show', Auth::id()) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 transition">
                                    Edit profile
                                </a>

                                {{-- <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 transition">
                                    Dokumen masuk
                                </a>

                                <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 transition">
                                    Pesan masuk
                                </a> --}}

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

                        <div
                            class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-sm hidden overflow-hidden z-50">
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

    <!-- Js dropdown dan fullscreen  -->
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

            const sidebar = document.getElementById("sidebar");
            const toggleBtn = document.getElementById("toggleSidebar");
            const toggleIcon = document.getElementById("toggleIcon");
            const sidebarTitle = document.getElementById("sidebar-title");
            const mainContent = document.getElementById("mainContent");

            if (!sidebar || !toggleBtn) return;

            const menuTexts = sidebar.querySelectorAll(".menu-text");

            function applySidebarState(isMinimized) {

                // Sidebar width
                sidebar.classList.toggle("w-20", isMinimized);
                sidebar.classList.toggle("w-64", !isMinimized);
                sidebar.classList.toggle("minimized", isMinimized);

                // Main content
                mainContent?.classList.toggle("ml-20", isMinimized);
                mainContent?.classList.toggle("ml-64", !isMinimized);

                // Title hide
                sidebarTitleWrapper?.classList.toggle("hidden", isMinimized);

                // 👉 INI KUNCI NYA (ALIGNMENT)
                sidebarHeader?.classList.toggle("justify-center", isMinimized);
                sidebarHeader?.classList.toggle("justify-between", !isMinimized);

                // Menu text
                menuTexts.forEach(el => {
                    el.classList.toggle("hidden", isMinimized);
                });

                // Icon rotate
                if (toggleIcon) {
                    toggleIcon.style.transform = isMinimized ?
                        "rotate(180deg)" :
                        "rotate(0deg)";
                }

                localStorage.setItem("sidebarMinimized", isMinimized ? "1" : "0");
            }

            // Init state dari localStorage
            const isSavedMinimized = localStorage.getItem("sidebarMinimized") === "1";
            applySidebarState(isSavedMinimized);

            // Toggle click
            toggleBtn.addEventListener("click", () => {
                const isMinimized = sidebar.classList.contains("minimized");
                applySidebarState(!isMinimized);
            });

        });
    </script>

    @stack('scripts')
</body>

</html>

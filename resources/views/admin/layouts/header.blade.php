<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    {{-- Chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Web browser icon --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- Material icon --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />

    {{-- alpine.js dropdown sidebar --}}
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- Style CSS Sidebar --}}
    <style>
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
</head>

<body class="bg-gray-200 dark:bg-gray-800">
    
    {{-- Container bar --}}
    <div class="flex h-screen">

        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed top-0 left-0 h-screen w-64 bg-white dark:bg-gray-900 dark:border-gray-500
            flex flex-col border-r border-gray-200 transition-all duration-300 overflow-hidden">

            {{-- Header admin -> Tombol minimize --}}
            <div
                class="p-4 flex justify-center items-center bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-500">
                <span id="sidebar-title" class="text-base text-gray-900 dark:text-white font-medium mr-3">Halaman
                    Admin</span>
                <button id="toggleSidebar"
                    class="flex items-center justify-center w-10 h-10 rounded-2xl hover:text-blue-400 transition-colors">
                    <span id="toggleIcon"
                        class="material-icons text-gray-900 dark:text-white !text-[20px] hover:text-blue-700 dark:hover:text-blue-300">
                        keyboard_arrow_left
                    </span>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto">
                <ul class="space-y-1 p-5">

                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ request()->routeIs('admin.dashboard')
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/dashboard.png') }}"
                                class="w-5 h-5
                            {{ request()->routeIs('admin.dashboard') ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Dashboard</span>
                        </a>
                    </li>

                    <!-- Jurnal -->
                    <li>
                        <a href="{{ route('admin.journals.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ request()->routeIs('admin.journals.*')
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/journals.png') }}"
                                class="w-5 h-5
                            {{ request()->routeIs('admin.journals.*') ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Journals</span>
                        </a>
                    </li>

                    {{-- Kategori --}}
                    @php
                        $isKategoriActive = request()->routeIs('admin.kategori.*');
                    @endphp
                    <li>
                        <a href="{{ route('admin.kategori.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isKategoriActive
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/kategori.png') }}"
                                class="w-5 h-5 {{ $isKategoriActive ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Kategori</span>
                        </a>
                    </li>

                    {{-- Penerbit --}}
                    @php $isPenerbitActive = request()->routeIs('admin.penerbit.*'); @endphp
                    <li>
                        <a href="{{ route('admin.penerbit.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isPenerbitActive
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/penerbit.png') }}"
                                class="w-5 h-5 {{ $isPenerbitActive ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Penerbit</span>
                        </a>
                    </li>

                    {{-- Buku --}}
                    @php $isBukuActive = request()->routeIs('admin.buku.*'); @endphp
                    <li>
                        <a href="{{ route('admin.buku.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isBukuActive
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/buku.png') }}"
                                class="w-5 h-5 {{ $isBukuActive ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Buku</span>
                        </a>
                    </li>

                    {{-- Peminjaman --}}
                    @php $isPeminjamanActive = request()->routeIs('admin.peminjaman.*'); @endphp
                    <li>
                        <a href="{{ route('admin.peminjaman.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isPeminjamanActive
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/peminjaman.png') }}"
                                class="w-5 h-5 {{ $isPeminjamanActive ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Peminjaman</span>
                        </a>
                    </li>

                    {{-- Akun --}}
                    @php $isAkunActive = request()->routeIs('admin.users.*'); @endphp
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isAkunActive
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/akun.png') }}"
                                class="w-5 h-5 {{ $isAkunActive ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Akun</span>
                        </a>
                    </li>

                    {{-- Anggota --}}
                    @php $isAnggotaActive = request()->routeIs('admin.anggota.*'); @endphp
                    <li>
                        <a href="{{ route('admin.anggota.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isAnggotaActive
                                ? 'bg-blue-700 text-white dark:bg-gray-800 dark:border dark:border-gray-300'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">

                            <img src="{{ asset('img/icon-sidebar/anggota.png') }}"
                                class="w-5 h-5 {{ $isAnggotaActive ? 'brightness-0 invert' : 'dark:invert dark:brightness-200' }}">
                            <span class="ml-2 menu-text">Anggota</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer Sidebar -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center gap-2.5 ">
                    <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="material-icons text-gray-600 text-[20px]">
                            person
                        </span>
                    </div>

                    <div class="menu-text">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-300">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Administrator
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Header katalog dan logout --}}
        <div id="mainContent" class="flex-1 flex flex-col ml-64 transition-all duration-300">
            <header
                class=" bg-white dark:bg-gray-900 dark:border-b border-gray-500 shadow flex items-center justify-between p-4">

                {{-- Head Right Logo --}}
                <img src="{{ asset('img/katalog-pustaka2.png') }}" alt="Logo Katalog Pustaka"
                    class="h-10 w-auto ml-3 dark:brightness-0 dark:invert">

                {{-- Head Left --}}
                <div class="flex items-center space-x-4 mr-2">

                    {{-- Notifikasi --}}
                    <div class="relative">
                        {{-- ICON --}}
                        <button id="notifBtn"
                            class="relative flex items-center justify-center w-10 h-10 rounded-full hover:bg-blue-50 dark:hover:bg-gray-800 transition focus:outline-none">
                            {{-- <span class="material-icons text-gray-700 !text-[22px]">notifications</span> --}}
                            <img src="{{ asset('img/icon/notif-icon.png') }}" alt="Notifikasi"
                                class="w-[22px] h-[22px] object-contain dark:invert dark:brightness-200">

                            @if ($unreadMessages > 0)
                                <span
                                    class="absolute -top-0 -right-0 min-w-[18px] h-[18px] bg-red-600 text-white
                                text-[10px] font-semibold flex items-center justify-center rounded-full">
                                    {{ $unreadMessages }}
                                </span>
                            @endif
                        </button>

                        {{-- Dropdown List Pesan Masuk --}}
                        <div id="notifDropdown"
                            class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-900 
                            border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 overflow-hidden">
                            {{-- Header --}}
                            <div class="flex items-center px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <img src="{{ asset('img/icon-dropdown/contact.png') }}"
                                    class="w-6 h-6 mr-2 object-contain dark:invert dark:brightness-200">
                                <span class="text-sm font-semibold text-gray-800 dark:text-white">
                                    Pesan Masuk
                                </span>
                            </div>

                            {{-- List Pesan --}}
                            <div class="max-h-72 overflow-y-auto">
                                @forelse ($latestMessages as $msg)
                                    <a href="{{ route('admin.contact.show', $msg->id) }}"
                                        class="block px-4 py-3 
                                        hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <div class="flex justify-between items-start">
                                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ $msg->nama }}
                                            </p>
                                            @if (!$msg->is_read)
                                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-1"></span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 truncate mt-1">
                                            {{ $msg->email }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-1">
                                            {{ Str::limit($msg->pesan, 50) }}
                                        </p>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-1">
                                            {{ $msg->created_at->format('d M Y H:i') }} -
                                            {{ $msg->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                @empty
                                    <p class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada pesan masuk
                                    </p>
                                @endforelse
                            </div>

                            {{-- Footer --}}
                            <div class="border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('admin.contact.index') }}"
                                    class="block text-center text-sm text-blue-600 py-3 
                                    hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    Lihat Semua Pesan
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Dropdown Menu --}}
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center focus:outline-none">
                            <img src="{{ asset('img/icon/profile-blue-icon.png') }}" alt="Profil"
                                class="w-9 h-9 rounded-full border border-gray-200">
                            <span
                                class="ml-3 text-gray-800 dark:text-gray-200 font-normal text-sm">{{ Auth::user()->name }}</span>
                            <span id="profileIcon"
                                class="material-icons mt-0.5 ml-2 transform transition-transform duration-200 text-gray-600 dark:text-gray-200 menu-text !text-[19px]">arrow_drop_down</span>
                        </button>

                        {{-- Dropdown profil --}}
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-900 
                                border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hidden overflow-hidden z-50">
                            {{-- HEADER --}}
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-gray-800 dark:text-white">
                                        Menu
                                    </span>
                                    {{-- Tanggal Hari Ini --}}
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                                    </span>
                                </div>
                            </div>

                            {{-- MENU --}}
                            <div class="py-1">
                                {{-- Pesan Masuk --}}
                                @if (auth()->check() && auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.contact.index') }}"
                                        class="flex items-center gap-3 px-5 py-2 text-sm text-gray-700 dark:text-gray-300 
                                            hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <img src="{{ asset('img/icon-dropdown/pesan.png') }}"
                                            class="w-5 h-5 object-contain dark:invert dark:brightness-200">
                                        <span>Kontak Pesan Masuk</span>
                                    </a>
                                @endif

                                {{-- Jurnal Masuk --}}
                                @if (auth()->check() && auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.journals.index') }}"
                                        class="flex items-center gap-3 px-5 py-2 text-sm text-gray-700 dark:text-gray-300 
                                            hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <img src="{{ asset('img/icon-dropdown/journals.png') }}"
                                            class="w-5 h-5 object-contain dark:invert dark:brightness-200">
                                        <span>Jurnal Masuk</span>
                                    </a>
                                @endif

                                {{-- Edit Profil --}}
                                @if (Auth::check())
                                    <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                        class="flex items-center gap-3 px-5 py-2 text-sm text-gray-700 dark:text-gray-300 
                                            hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <img src="{{ asset('img/icon-dropdown/akun.png') }}"
                                            class="w-5 h-5 object-contain dark:invert dark:brightness-200">
                                        <span>Edit Profil Saya</span>
                                    </a>
                                @endif

                                {{-- Divider --}}
                                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                                {{-- Fullscreen --}}
                                <button id="fullscreenBtn"
                                    class="w-full flex items-center gap-3 px-5 py-1.5 text-sm text-gray-700 dark:text-gray-300 
                                        hover:bg-gray-100 dark:hover:bg-gray-800 transition text-left">
                                    <span id="fullscreenIcon"
                                        class="material-icons !text-[20px] text-gray-800 dark:text-gray-200">
                                        crop_free
                                    </span>
                                    <span id="fullscreenText">Fullscreen</span>
                                </button>

                                {{-- Dark Mode --}}
                                <button id="darkModeBtn"
                                    class="w-full flex items-center gap-3  py-1.5 px-5 text-sm text-gray-700 dark:text-gray-300 
                                        hover:bg-gray-100 dark:hover:bg-gray-800 transition text-left">
                                    <span id="darkModeIcon"
                                        class="material-icons !text-[20px] text-gray-800 dark:text-gray-300">
                                        dark_mode
                                    </span>
                                    <span id="darkModeText">Dark Mode</span>
                                </button>

                                {{-- Divider --}}
                                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                                {{-- Logout --}}
                                @if (Auth::check())
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center px-4 py-2.5 text-xs text-gray-700 hover:bg-red-50 dark:hover:bg-red-900/20 transition justify-center">
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


            {{-- main-content --}}
            <main class="flex-1 p-4">
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-500 rounded-lg shadow-sm p-6 h-full">
                </div>
            </main>
            

            {{-- copyright --}}
            {{-- <footer class="text-center mt-2 p-5 text-[90%]">
                &copy; Naufal Zuhdi 2025. <b class="font-bold">Perpustakaan Daerah.</b> All Rights Reserved.
            </footer> --}}

        </div>
    </div>

    {{-- notifikasi --}}
    @include('sweetalert::alert')

    <!-- Script dropdown profile dan notifikasi dan fullscreen -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            /* =========================
                DROPDOWN PROFILE
            ========================== */
            const profileBtn = document.getElementById("profileBtn");
            const profileDropdown = document.getElementById("profileDropdown");
            const profileIcon = document.getElementById("profileIcon");

            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener("click", function(e) {
                    e.stopPropagation();

                    const isHidden = profileDropdown.classList.toggle("hidden");

                    // efek rotate icon
                    if (profileIcon) {
                        profileIcon.classList.toggle("rotate-180", !isHidden);
                    }
                });
            }

            /* =========================
                DROPDOWN NOTIFIKASI
            ========================== */
            const notifBtn = document.getElementById("notifBtn");
            const notifDropdown = document.getElementById("notifDropdown");

            if (notifBtn && notifDropdown) {
                notifBtn.addEventListener("click", function(e) {
                    e.stopPropagation();
                    notifDropdown.classList.toggle("hidden");
                });
            }

            /* =========================
                CLICK OUTSIDE (TUTUP SEMUA DROPDOWN)
            ========================== */
            document.addEventListener("click", function(e) {

                if (profileBtn && profileDropdown) {
                    if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                        profileDropdown.classList.add("hidden");
                    }
                }

                if (notifBtn && notifDropdown) {
                    if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                        notifDropdown.classList.add("hidden");
                    }
                }
            });

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

    {{-- JS Dark Mode --}}
    <script>
        const html = document.documentElement;
        const darkBtn = document.getElementById('darkModeBtn');
        const darkIcon = document.getElementById('darkModeIcon');
        const darkText = document.getElementById('darkModeText');

        // INIT dari localStorage
        if (localStorage.getItem('theme') === 'dark') {
            html.classList.add('dark');
            darkIcon.textContent = 'light_mode';
            darkText.textContent = 'Light Mode';
        }

        darkBtn.addEventListener('click', () => {
            html.classList.toggle('dark');

            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                darkIcon.textContent = 'light_mode';
                darkText.textContent = 'Light Mode';
            } else {
                localStorage.setItem('theme', 'light');
                darkIcon.textContent = 'dark_mode';
                darkText.textContent = 'Dark Mode';
            }
        });
    </script>

</body>

</html>

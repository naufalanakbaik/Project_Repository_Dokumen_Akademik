<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Title -->
    <title>Admin - {{ config('app.name', 'Academic Repository') }}</title>

    <!-- Icon web browser -->
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-900">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col">
            <div class="p-6">
                <h1 class="text-xl font-bold text-indigo-600">RepoDokumen <span class="text-xs font-normal text-slate-400">Admin</span></h1>
            </div>
            
            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }} rounded-lg transition-colors">
                    Dashboard
                </a>

                <a href="{{ route('admin.documents.index') }}" class="flex items-center px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.documents.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }} rounded-lg transition-colors">
                    Manajemen Dokumen
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }} 
                rounded-lg transition-colors">
                Manajemen User
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }} 
                rounded-lg transition-colors">
                Manajemen Kategori
                </a>
            </nav>

            <div class="p-4 border-t border-slate-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between">
                <div class="md:hidden">
                    <button class="p-2 text-slate-600">Menu</button>
                </div>
                <div class="hidden md:block">
                    <h2 class="text-lg font-semibold text-slate-800">@yield('title', 'Admin Dashboard')</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')

</body>

</html>

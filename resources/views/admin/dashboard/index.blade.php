@extends('admin.layouts.app')
@section('title', 'Dashboard Dokumen')

@section('content')

    {{-- Header --}}
    <div class="mb-5">
        <h1 class="text-xl font-semibold text-gray-950">
            Dashboard Admin
        </h1>
        <p class="text-xs text-blue-600 mt-0.5">
            Hai <span class="font-semibold text-blue-700">{{ Auth::user()->name }}</span>, berikut ringkasan aktivitas sistem dan statistik dokumen terbaru.
        </p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

        {{-- Total Dokumen (highlight) --}}
        <div
            class="bg-white border border-gray-200 rounded-xl p-5 flex items-center justify-between shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-xs text-gray-500">Total Dokumen</p>
                <h2 class="text-2xl font-bold text-gray-900 mt-1">
                    {{ $stats['total_documents'] }}
                </h2>
            </div>
            <div class="p-3 bg-blue-100 rounded-lg">
                <span class="material-icons text-blue-600">description</span>
            </div>
        </div>

        {{-- Pengguna --}}
        <div
            class="bg-white border border-gray-200 rounded-xl p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs text-gray-500">Pengguna</p>
                <h2 class="text-xl font-semibold text-gray-900 mt-1">
                    {{ $stats['total_users'] }}
                </h2>
            </div>
            <span class="material-icons text-indigo-500">groups</span>
        </div>

        {{-- Upload --}}
        <div
            class="bg-white border border-gray-200 rounded-xl p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs text-gray-500">Unggahan</p>
                <h2 class="text-xl font-semibold text-gray-900 mt-1">
                    {{ $stats['total_uploads'] }}
                </h2>
            </div>
            <span class="material-icons text-emerald-500">upload_file</span>
        </div>

        {{-- Download --}}
        <div
            class="bg-white border border-gray-200 rounded-xl p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-xs text-gray-500">Unduhan</p>
                <h2 class="text-xl font-semibold text-gray-900 mt-1">
                    {{ $stats['total_downloads'] }}
                </h2>
            </div>
            <span class="material-icons text-amber-500">download</span>
        </div>

    </div>

    {{-- Content --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- DISTRIBUSI --}}
        <div class="xl:col-span-1 bg-white p-6 rounded-xl border border-gray-200">

            <div class="flex items-center gap-2 mb-5">
                <span class="material-icons text-gray-700 text-[18px]">bar_chart</span>
                <h3 class="text-sm font-semibold text-gray-800">
                    Distribusi Dokumen
                </h3>
            </div>

            <div class="space-y-4">
                @foreach ($categoryDistribution as $cat)
                    @php
                        $percent =
                            $stats['total_documents'] > 0
                                ? round(($cat->documents_count / $stats['total_documents']) * 100)
                                : 0;
                    @endphp

                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-600">{{ $cat->name }}</span>
                            <span class="font-medium text-gray-800">
                                {{ $cat->documents_count }} • {{ $percent }}%
                            </span>
                        </div>

                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                style="width: {{ $percent }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        
    </div>

@endsection

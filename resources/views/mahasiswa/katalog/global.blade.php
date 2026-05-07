@extends('mahasiswa.layouts.app')
@section('title', 'Katalog Dokumen')

@section('content')

    {{-- Header --}}
    <div class="mb-7">
        <h1 class="text-xl font-semibold text-gray-900 tracking-tight">
            Semua Daftar Dokumen
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Jelajahi seluruh dokumen yang tersedia di repository.
        </p>
    </div>

    {{-- Grid Dokumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($documents as $doc)
            <div
                class="bg-white border border-gray-200 rounded-xl shadow-sm hover:border-gray-300 transition-all duration-200 flex flex-col h-full group">

                {{-- Header --}}
                <div class="p-5 border-b border-gray-100 min-h-[76px]">

                    <div class="flex items-start gap-3.5">

                        {{-- Icon documents --}}
                        <div
                            class="w-10 h-10 grid place-items-center rounded-lg bg-red-50 text-red-600 border border-red-200 leading-none">
                            <span class="material-symbols-outlined block !text-[20px]">
                                description
                            </span>
                        </div>

                        <div class="flex-1">

                            {{-- Title --}}
                            <a href="{{ route('mahasiswa.katalog.showGlobal', $doc->id) }}"
                                class="text-[15px] font-semibold text-gray-800 hover:text-blue-600 transition line-clamp-2 min-h-[44px] 
                                uppercase leading-snug">
                                {{ $doc->title }}
                            </a>

                            {{-- Category and Status --}}
                            <div class="flex items-center gap-2 mt-1 flex-wrap">

                                {{-- Category --}}
                                <span class="text-xs text-gray-500">
                                    {{ $doc->category->name ?? 'Dokumen' }}
                                </span>

                                {{-- Divider --}}
                                <span class="text-gray-300 text-xs">•</span>

                                {{-- Tahun Terbit --}}
                                <span class="text-xs text-gray-500">
                                    Tahun Terbit
                                    {{ $doc->tahun_terbit }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- Body --}}
                <div class="px-5 py-4 flex items-center justify-between flex-1">

                    {{-- User Info --}}
                    <div class="flex items-center gap-3 min-w-0">
                        @php
                            $initials = collect(explode(' ', $doc->user->name))
                                ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                ->take(2)
                                ->join('');
                        @endphp

                        {{-- Avatar --}}
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-100 text-blue-600 flex items-center justify-center
                            border border-indigo-300 font-semibold text-xs tracking-wider shrink-0">
                            {{ $initials }}
                        </div>

                        {{-- User info --}}
                        <div class="flex flex-col leading-tight min-w-0">
                            <span class="text-[13px] font-medium text-gray-700 truncate">
                                {{ $doc->user->name }}
                            </span>

                            <span class="text-[11px] text-gray-500 flex items-center gap-1 mt-0.5">
                                {{ $doc->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div
                        class="flex items-center gap-1.5 px-2.5 py-1 rounded-2xl border border-emerald-200
                        bg-emerald-50 text-emerald-700 text-[11px] font-medium shrink-0">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Published
                    </div>

                </div>

                {{-- Action --}}
                <div class="px-6 py-2 border-t border-gray-100 flex items-center justify-between">

                    {{-- Left: Detail --}}
                    <a href="{{ route('mahasiswa.katalog.showGlobal', $doc->id) }}"
                        class="text-gray-600 hover:text-blue-600 text-[13px] font-medium transition-colors duration-200">
                        Lihat Detail
                    </a>

                    {{-- Right: Icon --}}
                    <a href="{{ asset('storage/' . $doc->file) }}" target="_blank"
                        class="group w-9 h-9 flex items-center justify-center rounded-lg text-gray-500 
                        hover:text-blue-600 hover:bg-blue-50 transition-all duration-200">
                        <span
                            class="material-symbols-outlined !text-[18px] transition-transform duration-200 group-hover:scale-110">
                            open_in_new
                        </span>
                    </a>

                </div>

            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-gray-500">
                <div class="flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-4xl text-gray-300">folder_open</span>
                    <p class="text-sm">Belum ada dokumen tersedia</p>
                </div>
            </div>
        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
    </div>

@endsection

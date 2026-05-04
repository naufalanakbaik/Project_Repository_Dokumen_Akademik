@extends('dosen.layouts.app')
@section('title', 'Global Document Catalog')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="space-y-3">
            <div>
                <h1 class="text-lg font-semibold text-gray-800">
                    Katalog Dokumen Global
                </h1>
                <p class="text-[13px] text-blue-600">
                    Jelajahi dan temukan dokumen akademik dari mahasiswa dan dosen.
                </p>
            </div>

            {{-- Filter & Search --}}
            <form method="GET" action="{{ route('dosen.katalog.global') }}" class="flex flex-wrap items-center gap-3 mb-5">

                {{-- Search --}}
                <div class="relative flex-1 min-w-[220px]">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                        search
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul dokumen..."
                        class="w-full pl-10 pr-3 h-10 text-sm border border-gray-200 rounded-lg
                        focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                {{-- Category --}}
                <div class="relative">
                    <select name="category_id"
                        class="h-10 text-sm border border-gray-200 rounded-lg px-3 pr-8 text-gray-600
                        focus:ring-2 focus:ring-blue-100 focus:border-blue-500 appearance-none">

                        <option value="">Semua Kategori</option>

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Arrow --}}
                    <span
                        class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px] pointer-events-none">
                        expand_more
                    </span>
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="h-10 px-3 flex items-center gap-1 text-sm font-medium
                    bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition">
                    <span class="material-symbols-outlined !text-[22px]">
                        search
                    </span>
                </button>
            </form>
        </div>

        {{-- Grid content --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($documents as $doc)
                {{-- Avatar profile --}}
                @php
                    $initials = collect(explode(' ', $doc->user->name))
                        ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                        ->take(2)
                        ->join('');
                @endphp

                <a href="{{ route('dosen.katalog.showGlobal', $doc->id) }}"
                    class="group bg-white border border-gray-200 rounded-xl p-5">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">

                            {{-- Avatar --}}
                            <div
                                class="w-10 h-10 rounded-full bg-gray-100 border border-gray-300 flex items-center justify-center text-xs
                            font-semibold text-gray-700">
                                {{ $initials }}
                            </div>

                            {{-- User --}}
                            <div class="text-xs leading-tight">
                                <p class="font-medium text-gray-800">
                                    {{ $doc->user->name }}
                                </p>
                                <p class="text-[10px] text-gray-400">
                                    {{ $doc->created_at->format('d M Y') }}
                                </p>
                            </div>

                        </div>

                        {{-- Status (FIXED) --}}
                        <span
                            class="text-[11px] px-2.5 py-0.5 rounded-2xl border font-medium bg-green-50 text-green-700 border-green-200">
                            Published
                        </span>

                    </div>

                    {{-- Title --}}
                    <div class="mt-4 flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px] mt-0.5">
                            description
                        </span>

                        <h3 class="text-[15px] font-semibold uppercase text-gray-800 leading-snug line-clamp-2">
                            {{ $doc->title }}
                        </h3>
                    </div>

                    {{-- Category --}}
                    <div class="mt-3 flex items-center gap-2 text-xs text-gray-500">
                        <span class="material-symbols-outlined !text-[14px] text-gray-400">
                            folder
                        </span>
                        <span class="truncate">
                            {{ $doc->category->name }}
                        </span>
                    </div>

                    {{-- Footer action button --}}
                    <div
                        class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between
                    text-gray-400 group-hover:text-gray-900 transition">
                        <span class="text-xs font-medium">
                            Lihat detail
                        </span>

                        <span class="material-symbols-outlined !text-[18px] transition-transform group-hover:translate-x-1">
                            arrow_outward
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-16 text-gray-500">
                    <span class="material-symbols-outlined text-gray-300 !text-[48px]">
                        folder_open
                    </span>
                    <p class="mt-3 text-sm font-medium">
                        Belum ada dokumen tersedia
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div>
            {{ $documents->links() }}
        </div>

    </div>
@endsection

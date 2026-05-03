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
                class="bg-white border border-gray-200 rounded-xl hover:border-gray-300 transition-all duration-200 flex flex-col h-full group">

                {{-- HEADER --}}
                <div class="p-5 border-b border-gray-100 min-h-[76px]">

                    <div class="flex items-start gap-3.5">

                        {{-- ICON --}}
                        <div
                            class="w-10 h-10 grid place-items-center rounded-lg bg-red-50 text-red-600 border border-red-200 leading-none">
                            <span class="material-icons block !text-[20px]">
                                description
                            </span>
                        </div>

                        <div class="flex-1">

                            {{-- TITLE --}}
                            <a href="{{ route('mahasiswa.katalog.showGlobal', $doc->id) }}"
                                class="text-[15px] font-semibold text-gray-800 hover:text-blue-600 transition line-clamp-2 min-h-[44px] 
                                uppercase leading-snug">
                                {{ $doc->title }}
                            </a>
                            {{-- <h3
                                class="text-[15px] font-semibold text-gray-800 group-hover:text-blue-600 transition line-clamp-2 min-h-[44px] 
                                uppercase leading-snug">
                                {{ $doc->title }}
                            </h3> --}}

                            {{-- CATEGORY + STATUS --}}
                            <div class="flex items-center gap-2 mt-1 flex-wrap">

                                {{-- Category --}}
                                <span class="text-xs text-gray-500">
                                    {{ $doc->category->name ?? 'Dokumen' }}
                                </span>

                                {{-- Divider --}}
                                <span class="text-gray-300 text-xs">•</span>

                                {{-- Status --}}
                                <span
                                    class="flex items-center gap-1 text-[10px] font-medium px-2 py-0.5 rounded-lg border
                                    bg-green-50 text-green-700 border-green-200">

                                    <span class="material-icons !text-[11px]">
                                        verified
                                    </span>

                                    Approved
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="px-5 py-4 flex flex-col flex-1">

                    {{-- Author --}}
                    <p class="text-sm text-gray-700 font-medium">
                        {{ $doc->user->name }}
                    </p>

                    {{-- Metadata --}}
                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                        <span class="flex items-center gap-1">
                            <span class="material-icons !text-[14px]">schedule</span>
                            {{ $doc->created_at->format('d M Y') }}
                        </span>
                    </div>

                </div>

                {{-- ACTION --}}
                <div class="px-5 py-3 border-t border-gray-100 flex items-center gap-2 text-sm">

                    <a href="{{ route('mahasiswa.katalog.showGlobal', $doc->id) }}"
                        class="text-gray-600 hover:text-blue-600 font-medium transition">
                        Detail
                    </a>

                    <span class="text-gray-300">•</span>

                    <a href="{{ asset('storage/' . $doc->file) }}" target="_blank"
                        class="text-gray-600 hover:text-blue-600 font-medium transition">
                        Lihat
                    </a>

                </div>

            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-gray-500">
                <div class="flex flex-col items-center gap-2">
                    <span class="material-icons text-4xl text-gray-300">folder_open</span>
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

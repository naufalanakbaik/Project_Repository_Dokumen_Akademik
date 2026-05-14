@extends('dosen.layouts.app')
@section('title', 'Dokumen Favorit')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-6">

        {{-- Header --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-5">
            <div class="max-w-2xl">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-red-200 bg-white/80 backdrop-blur-sm 
                    text-red-600 text-sm font-medium shadow-md mb-3">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Koleksi Favorit
                </div>

                {{-- Heading --}}
                <h2 class="text-3xl md:text-[36px] font-semibold tracking-tight leading-tight text-gray-900">
                    Dokumen Favorit Saya
                </h2>

                {{-- Description --}}
                <p class="mt-1 text-[14px] leading-relaxed text-gray-600 max-w-2xl">
                    Menampilkan {{ $documents->total() }} dokumen
                    yang telah Anda simpan ke dalam daftar favorit
                    untuk akses yang lebih cepat dan mudah.
                </p>
            </div>
        </div>

        {{-- Main cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @forelse ($documents as $document)
                <a href="{{ route('dosen.katalog.showGlobal', $document->id) }}"
                    class="group relative flex flex-col h-full overflow-hidden rounded-xl border border-red-200 bg-white shadow-sm 
                    transition-all duration-300 hover:-translate-y-1 hover:border-red-300 hover:shadow-lg hover:shadow-red-100/40">

                    {{-- Glow Effect --}}
                    <div class="absolute inset-0 opacity-0 transition duration-500 bg-gradient-to-br from-red-100/40 via-transparent to-rose-50/40
                        group-hover:opacity-100">
                    </div>

                    {{-- Unfavorite button (hapus dari favorite) --}}
                    <div class="absolute top-4 right-4 z-20">
                        <form action="{{ route('dosen.documents.unfavorite', $document->id) }}"
                            method="POST"
                            onclick="event.stopPropagation();">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-red-200 bg-white/90 backdrop-blur-sm
                                text-red-600 shadow-sm transition-all duration-300 hover:bg-red-50 hover:scale-105">
                                <span class="material-symbols-outlined text-[20px]">
                                    bookmark_added
                                </span>
                            </button>
                        </form>
                    </div>

                    {{-- Content --}}
                    <div class="relative p-6 flex flex-col h-full">
                        {{-- Category --}}
                        <div class="mb-5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-200
                                text-amber-700 text-[11px] font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ $document->category->name }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3
                            class="text-[18px] leading-snug font-semibold uppercase text-gray-800 line-clamp-2 transition duration-300 group-hover:text-red-600">
                            {{ $document->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="mt-4 text-[12px] leading-relaxed text-gray-500 line-clamp-3">
                            Dokumen akademik favorit yang telah Anda simpan
                            dan tersedia untuk diakses kembali kapan saja
                            secara cepat melalui repository digital.
                        </p>

                        {{-- Meta --}}
                        <div class="mt-4 flex flex-wrap items-center gap-3 text-[12px] text-gray-500">
                            {{-- Year --}}
                            <div class="inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px]">
                                    calendar_check
                                </span>
                                <span>
                                    Tahun terbit {{ $document->tahun_terbit ?? '-' }}
                                </span>
                            </div>

                            {{-- Dot --}}
                            <span class="text-gray-400">•</span>

                            {{-- Role --}}
                            <div class="inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px]">
                                    person
                                </span>
                                <span>
                                    Penerbit {{ ucfirst($document->user->role) }}
                                </span>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="mt-5 border-t border-dashed border-gray-300"></div>

                        {{-- Footer --}}
                        <div class="mt-3 flex items-center justify-between gap-4">
                            {{-- User --}}
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full
                                    border border-indigo-300 bg-indigo-50 text-xs font-semibold tracking-wide text-indigo-600">
                                    {{ strtoupper(substr($document->user->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">
                                    <p class="text-[13px] font-semibold text-gray-700 truncate">
                                        {{ $document->user->name }}
                                    </p>
                                    <p class="text-[11.5px] text-gray-500 capitalize">
                                        {{ $document->user->role }}
                                    </p>
                                </div>
                            </div>

                            {{-- Detail --}}
                            <div class="flex items-center gap-1.5 text-[13px] font-normal text-gray-400 transition-all duration-300
                                group-hover:text-red-600">
                                <span>
                                    Detail
                                </span>
                                <span class="material-symbols-outlined !text-[14px]">
                                    open_in_new
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full rounded-xl border border-dashed border-red-200 bg-gradient-to-br from-white to-red-50/40
                    p-16 text-center shadow-sm">
                    {{-- Icon --}}
                    <div class="w-24 h-24 mx-auto rounded-2xl bg-gradient-to-br from-red-50 to-rose-50
                        border border-red-100 flex items-center justify-center text-red-500 shadow-inner">
                        <span class="material-symbols-outlined text-[40px]">
                            bookmark_remove
                        </span>
                    </div>

                    {{-- Text --}}
                    <h3 class="mt-7 text-2xl font-semibold text-gray-800">
                        Belum Ada Dokumen Favorit
                    </h3>

                    <p class="mt-3 text-[13px] leading-relaxed text-gray-500 max-w-md mx-auto">
                        Anda belum menyimpan dokumen apa pun ke dalam
                        daftar favorit repository digital saat ini.
                    </p>

                    {{-- Action --}}
                    <a href="{{ route('dosen.katalog.global') }}"
                        class="mt-7 inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-[13px] font-medium text-red-600
                        transition hover:bg-red-100">
                        <span class="material-symbols-outlined !text-[18px]">
                            library_books
                        </span>
                        Jelajahi Dokumen
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($documents->hasPages())
            <div class="mt-10">
                {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
            </div>
        @endif

    </div>
@endsection
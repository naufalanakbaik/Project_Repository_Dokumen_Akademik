@extends('landing.layouts.public')

@section('title', 'Repository Dokumen Akademik')
@section('meta_description', 'Jelajahi koleksi dokumen akademik publik dalam repository digital modern.')

@section('content')

    {{-- Header --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-yellow-50 via-amber-50 to-white border-b border-yellow-100">

        {{-- Soft Decoration --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-yellow-200/30 rounded-full blur-3xl pointer-events-none"></div>

        <div class="absolute bottom-0 right-0 w-[350px] h-[350px] bg-amber-100/50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full max-w-[77rem] mx-auto px-6 py-16 lg:py-16">
            <div class="max-w-3xl">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-300 bg-white/80 backdrop-blur-sm 
                    text-yellow-700 text-sm font-medium shadow-sm mb-6">
                    <span class="material-symbols-outlined !text-[18px] text-yellow-600">
                        auto_stories
                    </span>
                    Repository Akademik Digital
                </div>

                {{-- Title --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight tracking-tight text-gray-900">
                    Jelajahi Dokumen
                    <span class="text-yellow-600">
                        Akademik Publik
                    </span>
                </h1>

                {{-- Description --}}
                <p class="mt-5 text-sm leading-relaxed text-gray-600 max-w-2xl">
                    Temukan berbagai dokumen akademik seperti laporan,
                    jurnal mahasiswa, dan dokumen penelitian
                    yang telah dipublikasikan dalam sistem repository.
                </p>
            </div>
        </div>
    </section>

    {{-- Search Section --}}
    <section class="max-w-[75rem] mx-auto px-6 -mt-8 relative z-10">
        <div class="rounded-2xl border border-gray-200 bg-white/95 backdrop-blur-sm shadow-sm p-5">
            <form method="GET" action="{{ route('repository') }}">
                <div class="flex flex-col lg:flex-row gap-4">

                    {{-- Search Input --}}
                    <div class="flex-1 relative">

                        {{-- Icon --}}
                        <span
                            class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">
                            search
                        </span>

                        {{-- Input --}}
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul dokumen atau kategori..."
                            class="w-full h-14 pl-12 pr-4 rounded-xl border border-gray-200 bg-white text-gray-700 placeholder:text-gray-400
                            text-sm shadow-sm transition-all duration-200 focus:outline-none focus:border-yellow-400 focus:ring-4
                            focus:ring-yellow-100">
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="h-14 px-6 rounded-xl border border-gray-200 bg-white text-gray-700 text-sm font-medium inline-flex items-center 
                        justify-center gap-2 shadow-sm transition-all duration-200 hover:bg-gray-50 hover:border-gray-300">
                        <span class="material-symbols-outlined text-[19px]">
                            search
                        </span>
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- Repository documents --}}
    <section class="w-full max-w-[78rem] mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-7">
            {{-- Left --}}
            <div class="max-w-2xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 border border-amber-200
                    text-amber-700 text-[13px] font-medium shadow-sm mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Repository Digital
                </div>

                {{-- Heading --}}
                <h2 class="text-3xl md:text-[36px] font-semibold tracking-tight leading-tight text-gray-900">
                    Koleksi Dokumen Akademik
                </h2>

                {{-- Description --}}
                <p class="mt-2 text-[14px] leading-relaxed text-gray-600 max-w-2xl">
                    Menampilkan {{ $documents->total() }} dokumen publik
                    yang tersedia di dalam sistem repository digital
                    secara modern, cepat, dan terstruktur.
                </p>
            </div>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @forelse ($documents as $document)
                <a href="{{ route('repository.show', $document->id) }}" 
                    class="group relative flex flex-col h-full overflow-hidden rounded-xl border border-amber-200 bg-white shadow-sm
                    transition-all duration-300 hover:-translate-y-1 hover:border-yellow-300 hover:shadow-lg hover:shadow-yellow-100/40">

                    {{-- Glow Effect --}}
                    <div class="absolute inset-0 opacity-0 transition duration-500 bg-gradient-to-br from-yellow-50/60 via-transparent to-amber-50/40
                        group-hover:opacity-100">
                    </div>

                    {{-- Content --}}
                    <div class="relative p-6 flex flex-col h-full">

                        {{-- Top --}}
                        <div class="flex items-start justify-between gap-4 mb-5">

                            {{-- Category --}}
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-200
                                text-amber-700 text-[11px] font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ $document->category->name }}
                            </span>

                            {{-- Date --}}
                            <div class="text-right shrink-0">
                                <p class="text-[9px] uppercase tracking-wide font-medium text-green-600">
                                    Published
                                </p>
                                <p class="text-[11px] font-normal text-gray-400">
                                    {{ $document->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        {{-- Title --}}
                        <h3 class="text-[18px] leading-snug font-semibold text-gray-900 line-clamp-2 transition duration-300 uppercase
                            group-hover:text-yellow-700">
                            {{ $document->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="mt-4 text-[12px] leading-relaxed text-gray-500 line-clamp-3">
                            Dokumen akademik yang telah dipublikasikan
                            dalam repository sistem dan tersedia
                            untuk ditinjau lebih lanjut oleh pengguna.
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

                        {{-- Footer avatar profile dan button detail --}}
                        <div class="mt-3 flex items-center justify-between gap-4">
                            {{-- User info --}}
                            <div class="flex items-center gap-3 min-w-0">
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full
                                    border border-indigo-300 bg-indigo-50 text-xs font-semibold tracking-wide text-indigo-600">
                                    {{ strtoupper(substr($document->user->name, 0, 2)) }}
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
                                group-hover:text-yellow-700">
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
                <div class="col-span-full rounded-2xl border border-dashed border-yellow-200 bg-gradient-to-br from-white to-yellow-50/40
                    p-16 text-center shadow-sm">
                    {{-- Icon --}}
                    <div class="w-24 h-24 mx-auto rounded-2xl bg-gradient-to-br from-yellow-50 to-amber-50
                        border border-yellow-100 flex items-center justify-center text-yellow-600 shadow-inner">
                        <span class="material-icons-outlined text-[40px]">
                            folder_off
                        </span>
                    </div>
                    {{-- Text --}}
                    <h3 class="mt-7 text-2xl font-bold text-gray-800">
                        Dokumen Tidak Ditemukan
                    </h3>
                    <p class="mt-3 text-sm leading-relaxed text-gray-500 max-w-md mx-auto">
                        Tidak ada dokumen yang sesuai dengan pencarian
                        atau filter yang digunakan saat ini.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($documents->hasPages())
            <div class="mt-14 flex justify-center">
                {{ $documents->links() }}
            </div>
        @endif

    </section>

    {{-- CTA Section --}}
    <section class="max-w-[78rem] mx-auto px-6 pb-16">

        <div class="relative overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-br from-yellow-50 via-amber-50 to-white
            px-8 py-14 lg:px-14 lg:py-16">

            {{-- Soft Blur --}}
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-yellow-200/40 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="absolute bottom-0 left-0 w-60 h-60 bg-amber-100/50 rounded-full blur-3xl pointer-events-none">
            </div>

            {{-- Content --}}
            <div class="relative max-w-3xl">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-yellow-200
                    text-yellow-700 text-sm font-medium shadow-sm mb-5">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Akses Repository Penuh
                </div>

                {{-- Heading --}}
                <h2 class="text-4xl lg:text-4xl font-bold tracking-tight leading-relaxed text-gray-950">
                    Login untuk Mengakses
                    <span class="text-yellow-700">
                        Seluruh Fitur Repository
                    </span>
                </h2>

                {{-- Description --}}
                <p class="mt-5 text-[15px] leading-relaxed text-gray-600 max-w-2xl">
                    Masuk ke sistem untuk melakukan download dokumen,
                    preview file lengkap, upload repository,
                    dan mengakses seluruh dashboard akademik.
                </p>

                {{-- Action buttons--}}
                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gray-950 
                        text-white text-[13px] font-medium transition-all duration-300 hover:bg-black hover:-translate-y-0.5">
                        <span class="material-symbols-outlined !text-[18px]">
                            login
                        </span>
                        Login ke Sistem
                    </a>

                    <a href="{{ route('landing') }}" 
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-amber-300 bg-white backdrop-blur-sm 
                        text-gray-700 text-[13px] font-medium transition-all duration-300 hover:bg-amber-50 hover:border-amber-300">
                        <span class="material-symbols-outlined !text-[18px]">
                            folder_open
                        </span>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

        </div>

    </section>

@endsection

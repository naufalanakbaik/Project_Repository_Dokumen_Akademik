@extends('landing.layouts.public')

@section('title', 'Repository Dokumen Akademik')
@section('meta_description', 'Jelajahi koleksi dokumen akademik publik dalam repository digital modern.')

@section('content')

    {{-- HEADER --}}
    <section class="relative overflow-hidden hero-gradient border-b border-gray-200">

        {{-- Blur --}}
        <div
            class="absolute top-0 left-0 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-20">

            <div class="max-w-3xl">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-sm font-medium mb-6">

                    <span class="material-icons-outlined text-[18px]">
                        auto_stories
                    </span>

                    Repository Publik
                </div>

                {{-- Title --}}
                <h1 class="text-5xl font-extrabold tracking-tight text-gray-950 leading-tight">

                    Jelajahi Dokumen
                    Akademik Publik
                </h1>

                {{-- Description --}}
                <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-2xl">

                    Temukan berbagai dokumen akademik seperti laporan,
                    jurnal mahasiswa, dan dokumen penelitian
                    yang telah dipublikasikan dalam sistem repository.
                </p>

            </div>

        </div>

    </section>

    {{-- SEARCH --}}
    <section class="max-w-7xl mx-auto px-6 -mt-8 relative z-10">

        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-5">

            <form method="GET" action="{{ route('repository') }}">

                <div class="flex flex-col lg:flex-row gap-4">

                    {{-- Search Input --}}
                    <div class="flex-1 relative">

                        <span
                            class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[22px]">

                            search
                        </span>

                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari judul dokumen atau kategori..."
                            class="w-full h-14 pl-12 pr-4 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition">

                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="h-14 px-8 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-medium transition shadow-sm">

                        Cari Dokumen
                    </button>

                </div>

            </form>

        </div>

    </section>

    {{-- DOCUMENTS --}}
    <section class="max-w-7xl mx-auto px-6 py-16">

        {{-- Top --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-10">

            <div>

                <h2 class="text-2xl font-bold text-gray-950">
                    Koleksi Dokumen
                </h2>

                <p class="mt-2 text-gray-500">
                    Menampilkan {{ $documents->total() }} dokumen publik tersedia
                </p>

            </div>

        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @forelse ($documents as $document)

                <a href="{{ route('repository.show', $document->id) }}"
                    class="group bg-white rounded-3xl border border-gray-200 hover:border-blue-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">

                    {{-- Content --}}
                    <div class="p-7">

                        {{-- Category + Date --}}
                        <div class="flex items-center justify-between gap-3 mb-5">

                            <span
                                class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-100 text-xs font-semibold">

                                {{ $document->category->name }}
                            </span>

                            <span class="text-xs text-gray-400">
                                {{ $document->created_at->format('d M Y') }}
                            </span>

                        </div>

                        {{-- Title --}}
                        <h3
                            class="text-xl font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-blue-600 transition">

                            {{ $document->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="mt-4 text-sm text-gray-500 leading-relaxed line-clamp-3">

                            Dokumen akademik yang tersedia
                            dalam repository publik sistem.
                        </p>

                        {{-- Meta --}}
                        <div class="mt-6 flex flex-wrap items-center gap-3">

                            {{-- Year --}}
                            <div
                                class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-gray-100 text-gray-700 text-xs font-medium">

                                <span class="material-icons-outlined text-[16px]">
                                    calendar_month
                                </span>

                                {{ $document->tahun_terbit ?? '-' }}
                            </div>

                            {{-- Role --}}
                            <div
                                class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-gray-100 text-gray-700 text-xs font-medium">

                                <span class="material-icons-outlined text-[16px]">
                                    badge
                                </span>

                                {{ ucfirst($document->user->role) }}
                            </div>

                        </div>

                    </div>

                    {{-- Footer --}}
                    <div
                        class="px-7 py-5 border-t border-gray-100 bg-gray-50/70 flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600">

                                <span class="material-icons-outlined text-[20px]">
                                    person
                                </span>

                            </div>

                            <div>

                                <p class="text-sm font-medium text-gray-800">
                                    {{ $document->user->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    Uploaded Document
                                </p>

                            </div>

                        </div>

                        <span
                            class="material-icons-outlined text-gray-400 group-hover:text-blue-600 transition">

                            arrow_forward
                        </span>

                    </div>

                </a>

            @empty

                {{-- Empty --}}
                <div
                    class="col-span-full bg-white border border-dashed border-gray-300 rounded-3xl p-16 text-center">

                    <div
                        class="w-20 h-20 mx-auto rounded-3xl bg-gray-100 flex items-center justify-center text-gray-400">

                        <span class="material-icons-outlined text-[40px]">
                            folder_off
                        </span>

                    </div>

                    <h3 class="mt-6 text-2xl font-bold text-gray-800">
                        Dokumen Tidak Ditemukan
                    </h3>

                    <p class="mt-3 text-gray-500">
                        Tidak ada dokumen yang sesuai dengan pencarian Anda.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- Pagination --}}
        @if ($documents->hasPages())

            <div class="mt-14">

                {{ $documents->links() }}

            </div>

        @endif

    </section>

    {{-- CTA --}}
    <section class="max-w-7xl mx-auto px-6 pb-24">

        <div
            class="rounded-[36px] border border-blue-100 bg-gradient-to-br from-blue-50 to-indigo-50 p-10 lg:p-14 overflow-hidden relative">

            {{-- Blur --}}
            <div
                class="absolute top-0 right-0 w-[250px] h-[250px] bg-blue-300/20 rounded-full blur-3xl">
            </div>

            <div class="relative max-w-3xl">

                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-blue-100 text-blue-700 text-sm font-medium mb-6">

                    <span class="material-icons-outlined text-[18px]">
                        lock
                    </span>

                    Akses Repository Penuh
                </div>

                <h2 class="text-4xl font-bold text-gray-950 leading-tight">

                    Login untuk Mengakses
                    Seluruh Fitur Sistem
                </h2>

                <p class="mt-5 text-lg text-gray-600 leading-relaxed">

                    Masuk ke sistem untuk melakukan download dokumen,
                    preview file lengkap, upload repository,
                    dan mengakses seluruh dashboard akademik.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">

                    <a href="{{ route('login') }}"
                        class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-sm transition">

                        Login Sistem
                    </a>

                    <a href="{{ route('landing') }}"
                        class="px-6 py-3 rounded-2xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-medium transition">

                        Kembali ke Beranda
                    </a>

                </div>

            </div>

        </div>

    </section>

@endsection
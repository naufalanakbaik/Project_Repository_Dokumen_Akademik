@extends('dosen.layouts.app')
@section('title', 'Global Document Catalog')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-6">

        {{-- Header --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-5">
            <div class="max-w-2xl">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-300 bg-white/80 backdrop-blur-sm 
                    text-yellow-700 text-sm font-medium shadow-md mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Repository Digital
                </div>

                {{-- Heading --}}
                <h2 class="text-3xl md:text-[36px] font-semibold tracking-tight leading-tight text-gray-900">
                    Koleksi Semua Dokumen Akademik
                </h2>

                {{-- Description --}}
                <p class="mt-1 text-[14px] leading-relaxed text-gray-600 max-w-2xl">
                    Menampilkan {{ $documents->total() }} dokumen publik
                    yang tersedia di dalam sistem repository digital
                    secara modern, cepat, dan terstruktur.
                </p>
            </div>
        </div>

        {{-- Seacrh / Pencarian --}}
        <form method="GET" action="{{ route('dosen.katalog.global') }}"
            class="bg-white border border-gray-200 rounded-xl p-5 mb-5">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                {{-- Search --}}
                <div class="lg:col-span-5">
                    <label class="text-[13px] font-medium text-gray-500 ml-2 mb-1 block">
                        Search
                    </label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 !text-[19px] text-gray-400">
                            search
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul atau nama user..."
                            class="w-full h-10 rounded-lg border border-gray-300 pl-12 pr-4 text-[13px] text-gray-700
                                placeholder:text-gray-400 focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100
                                outline-none transition">
                    </div>
                </div>

                {{-- Category --}}
                <div class="lg:col-span-3">
                    <label class="text-[13px] font-medium text-gray-500 ml-2 mb-1 block">
                        Kategori
                    </label>
                    <div class="relative">
                        <select name="category"
                            class="appearance-none w-full h-10 rounded-lg border border-gray-300 px-5 pr-11 text-[13px] text-gray-600
                                focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 outline-none transition cursor-pointer">
                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Arrow --}}
                        <span
                            class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 !text-[18px] text-gray-500 pointer-events-none">
                            keyboard_arrow_down
                        </span>
                    </div>
                </div>

                {{-- Tahun --}}
                <div class="lg:col-span-2">
                    <label class="text-[13px] font-medium text-gray-500 ml-2 mb-1 block">
                        Tahun Terbit
                    </label>
                    <div class="relative">
                        <select name="tahun"
                            class="appearance-none w-full h-10 rounded-lg border border-gray-300 px-4 pr-11 text-[13px] text-gray-600 bg-white
                            focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 outline-none transition cursor-pointer">
                            {{-- Default --}}
                            <option value="" {{ request('tahun') == '' ? 'selected' : '' }}>
                                Semua Tahun
                            </option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                        {{-- Arrow --}}
                        <span
                            class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 !text-[18px] text-gray-500 pointer-events-none">
                            keyboard_arrow_down
                        </span>
                    </div>
                </div>

                {{-- Action --}}
                <div class="lg:col-span-2 flex items-end gap-2.5">
                    {{-- Filter --}}
                    <button type="submit"
                        class="h-10 w-10 shrink-0 inline-flex items-center justify-center border border-amber-300
                            rounded-lg bg-amber-100 text-amber-700 hover:bg-yellow-200 transition shadow-sm">
                        <span class="material-symbols-outlined !text-[20px]">
                            filter_alt
                        </span>
                    </button>

                    {{-- Reset --}}
                    <a href="{{ route('dosen.katalog.global') }}"
                        class="h-10 flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg border border-gray-300 bg-white
                            px-4 text-gray-600 hover:bg-gray-50 transition shadow-sm">
                        <span class="material-symbols-outlined !text-[17px]">
                            refresh
                        </span>
                        <span class="text-[13px] font-medium whitespace-nowrap">
                            Reset
                        </span>
                    </a>
                </div>
            </div>
        </form>

        {{-- Main cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($documents as $document)
                <a href="{{ route('dosen.katalog.showGlobal', $document->id) }}"
                    class="group relative flex flex-col h-full overflow-hidden rounded-xl border border-amber-200 bg-white shadow-sm 
                    transition-all duration-300 hover:-translate-y-1 hover:border-yellow-300 hover:shadow-lg hover:shadow-yellow-100/40">

                    {{-- Glow Effect --}}
                    <div
                        class="absolute inset-0 opacity-0 transition duration-500 bg-gradient-to-br from-yellow-100/40 via-transparent to-amber-50/40
                        group-hover:opacity-100">
                    </div>

                    {{-- Favorite Button + Count --}}
                    <div class="absolute top-4 right-4 z-20 flex items-center gap-2">
                        @php
                            $isFavorite = $document->is_favorited;
                        @endphp
                        @if ($isFavorite)
                            {{-- Hapus dari favorite --}}
                            <form action="{{ route('dosen.documents.unfavorite', $document->id) }}" method="POST"
                                onclick="event.stopPropagation();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center justify-center w-10 h-10 rounded-full border border-red-200 bg-white/90 backdrop-blur-sm
                                    text-red-600 shadow-sm transition-all duration-300 hover:bg-red-50 hover:scale-105">
                                    <span class="material-symbols-outlined !text-[20px]">
                                        bookmark_added
                                    </span>
                                </button>
                            </form>
                        @else
                            {{-- Tambahkan ke favorite --}}
                            <form action="{{ route('dosen.documents.favorite', $document->id) }}" method="POST"
                                onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center justify-center w-10 h-10 rounded-full border border-yellow-200 bg-white/90 backdrop-blur-sm
                                    text-gray-400 shadow-sm transition-all duration-300 hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105">
                                    <span class="material-symbols-outlined !text-[20px]">
                                        bookmark
                                    </span>
                                </button>
                            </form>
                        @endif

                        {{-- Favorite Count --}}
                        <span class="text-[12px] font-semibold
                            {{ $document->favorited_by_count > 0 ? 'text-red-600' : 'text-gray-400' }}">
                            {{ $document->favorited_by_count }}
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="relative p-6 flex flex-col h-full">
                        {{-- Category --}}
                        <div class="mb-5">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-200
                                text-amber-700 text-[11px] font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ $document->category->name }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3
                            class="text-[18px] leading-snug font-semibold uppercase text-gray-800 line-clamp-2 transition duration-300 group-hover:text-yellow-700">
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
                            <div
                                class="flex items-center gap-1.5 text-[13px] font-normal text-gray-400 transition-all duration-300
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
                <div
                    class="col-span-full rounded-xl border border-dashed border-yellow-200 bg-gradient-to-br from-white to-yellow-50/40
                    p-16 text-center shadow-sm">
                    {{-- Icon --}}
                    <div
                        class="w-24 h-24 mx-auto rounded-2xl bg-gradient-to-br from-yellow-50 to-amber-50
                        border border-yellow-100 flex items-center justify-center text-yellow-600 shadow-inner">
                        <span class="material-symbols-outlined text-[40px]">
                            folder_off
                        </span>
                    </div>
                    {{-- Text --}}
                    <h3 class="mt-7 text-2xl font-semibold text-gray-800">
                        Dokumen Tidak Ditemukan
                    </h3>
                    <p class="mt-3 text-[13px] leading-relaxed text-gray-500 max-w-md mx-auto">
                        Tidak ada dokumen yang sesuai dengan pencarian
                        atau filter yang digunakan saat ini.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($documents->hasPages())
            <div class="mt-10">
                {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
            </div>
        @endif




        {{-- Main content header dan filter --}}
        {{-- <div class="relative mb-20">
            <section class="relative h-[360px] md:h-[460px] rounded-xl overflow-hidden border border-gray-200 shadow-sm">

                <div class="absolute inset-0 overflow-hidden rounded-xl">
                    <div id="slider" class="relative w-full h-full z-0">
                        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-700 opacity-100"
                            style="background-image: url('{{ asset('img/img-slider/bg-1.jpeg') }}')">
                        </div>
                        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-700 opacity-0"
                            style="background-image: url('{{ asset('img/img-slider/bg-2.jpeg') }}')">
                        </div>
                        <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-700 opacity-0"
                            style="background-image: url('{{ asset('img/img-slider/bg-3.jpeg') }}')">
                        </div>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-transparent z-10"></div>
                </div>

                <div class="absolute inset-0 flex items-center z-20">
                    <div class="max-w-6xl mx-auto w-full px-6 md:px-16">
                        <div id="slide-content" class="max-w-xl text-white">
                            <h1 class="text-3xl md:text-5xl font-semibold leading-tight drop-shadow-md">
                                Katalog Dokumen Global
                            </h1>
                            <p class="mt-3 text-sm md:text-base text-white/90 drop-shadow-sm">
                                Jelajahi berbagai dokumen akademik secara terpusat dan terorganisir.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-0 flex items-center justify-between px-4 md:px-6 z-30">
                    <button id="prev"
                        class="w-8 h-8 flex items-center justify-center bg-black/30 hover:bg-black/50
                        text-white rounded-full backdrop-blur-sm transition">
                        <span class="material-symbols-outlined pr-0.5 !text-[20px] leading-none">
                            keyboard_arrow_left
                        </span>
                    </button>

                    <button id="next"
                        class="w-8 h-8 flex items-center justify-center bg-black/30 hover:bg-black/50
                        text-white rounded-full backdrop-blur-sm transition">
                        <span class="material-symbols-outlined pl-0.5 !text-[20px] leading-none">
                            keyboard_arrow_right
                        </span>
                    </button>
                </div>

                <div class="pb-7 absolute bottom-6 inset-x-0 flex justify-center z-30">
                    <div class="flex items-center gap-3 bg-black/40 backdrop-blur-md px-3 py-2 rounded-full shadow-sm">
                        <button class="dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300"></button>
                        <button class="dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300"></button>
                        <button class="dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300"></button>
                    </div>
                </div>
            </section>
        </div> --}}

        {{-- Scirpt heading h1 --}}
        <script>
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            const title = document.querySelector('#slide-content h1');
            const desc = document.querySelector('#slide-content p');

            const data = [{
                    title: "Katalog Dokumen Global",
                    desc: "Jelajahi berbagai dokumen akademik secara terpusat dan terorganisir."
                },
                {
                    title: "Akses Cepat & Efisien",
                    desc: "Cari dokumen berdasarkan judul, kategori, atau penulis dengan mudah."
                },
                {
                    title: "Terintegrasi untuk Akademisi",
                    desc: "Platform terstruktur untuk mahasiswa dan dosen berbagi dokumen."
                }
            ];

            let current = 0;
            let interval;

            function updateUI(index) {
                slides.forEach((slide, i) => {
                    slide.style.opacity = i === index ? '1' : '0';
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === index);
                    dot.classList.toggle('scale-110', i === index);
                    dot.classList.toggle('bg-white/40', i !== index);
                });

                title.textContent = data[index].title;
                desc.textContent = data[index].desc;
            }

            function next() {
                current = (current + 1) % slides.length;
                updateUI(current);
            }

            function prev() {
                current = (current - 1 + slides.length) % slides.length;
                updateUI(current);
            }

            function start() {
                interval = setInterval(next, 5000);
            }

            function reset() {
                clearInterval(interval);
                start();
            }

            document.getElementById('next').onclick = () => {
                next();
                reset();
            };
            document.getElementById('prev').onclick = () => {
                prev();
                reset();
            };

            dots.forEach((dot, i) => {
                dot.onclick = () => {
                    current = i;
                    updateUI(current);
                    reset();
                };
            });

            updateUI(current);
            start();
        </script>
    </div>
@endsection

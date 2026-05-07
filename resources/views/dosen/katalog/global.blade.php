@extends('dosen.layouts.app')
@section('title', 'Global Document Catalog')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Main content header dan filter --}}
        <div class="relative mb-20">
            {{-- Header --}}
            <section class="relative h-[360px] md:h-[460px] rounded-xl overflow-hidden border border-gray-200 shadow-sm">

                <div class="absolute inset-0 overflow-hidden rounded-xl">
                    {{-- Img slider --}}
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

                    {{-- Overlay (lebih soft) --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-transparent z-10"></div>
                </div>

                {{-- Content info (dipanggil dijs) --}}
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

                {{-- Arrow navigation --}}
                <div class="absolute inset-0 flex items-center justify-between px-4 md:px-6 z-30">
                    {{-- Prev --}}
                    <button id="prev"
                        class="w-8 h-8 flex items-center justify-center bg-black/30 hover:bg-black/50
                        text-white rounded-full backdrop-blur-sm transition">
                        <span class="material-symbols-outlined pr-0.5 !text-[20px] leading-none">
                            keyboard_arrow_left
                        </span>
                    </button>

                    {{-- Next --}}
                    <button id="next"
                        class="w-8 h-8 flex items-center justify-center bg-black/30 hover:bg-black/50
                        text-white rounded-full backdrop-blur-sm transition">
                        <span class="material-symbols-outlined pl-0.5 !text-[20px] leading-none">
                            keyboard_arrow_right
                        </span>
                    </button>
                </div>

                {{-- Dot indicator (lebih rapi & balanced) --}}
                <div class="pb-7 absolute bottom-6 inset-x-0 flex justify-center z-30">
                    <div class="flex items-center gap-3 bg-black/40 backdrop-blur-md px-3 py-2 rounded-full shadow-sm">
                        <button class="dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300"></button>
                        <button class="dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300"></button>
                        <button class="dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300"></button>
                    </div>
                </div>
            </section>

            {{-- Filter --}}
            <div class="absolute left-1/2 -translate-x-1/2 bottom-0 translate-y-1/2 w-full max-w-6xl px-4 z-40">

                <form method="GET" action="{{ route('dosen.katalog.global') }}"
                    class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 md:p-5">

                    <div class="flex flex-col md:flex-row gap-3">

                        {{-- Search --}}
                        <div class="relative flex-1">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">
                                search
                            </span>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari judul dokumen..."
                                class="w-full pl-10 pr-3 h-11 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-200
                                focus:border-blue-500 outline-none">
                        </div>

                        {{-- Category --}}
                        <div class="relative md:w-60">
                            <select name="category_id"
                                class="w-full h-11 text-sm border border-gray-200 rounded-xl px-5 pr-8 text-gray-600 bg-white
                                appearance-none outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>

                            <span
                                class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px] pointer-events-none">
                                expand_more
                            </span>
                        </div>

                        {{-- Button --}}
                        <button type="submit"
                            class="h-11 px-6 flex items-center justify-center gap-1.5 bg-blue-50 border border-blue-300 text-blue-700
                            rounded-xl font-medium hover:bg-blue-100 active:scale-[0.98] transition">
                            <span class="material-symbols-outlined !text-[18px]">
                                search
                            </span>
                            <span class="text-[14px]">Cari</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>

        {{-- Grid content --}}
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($documents as $doc)
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm hover:border-gray-300 transition-all duration-200 flex flex-col
                h-full group overflow-hidden">

                    {{-- Header --}}
                    <div class="p-5 border-b border-gray-100 min-h-[90px]">
                        <div class="flex items-start gap-3.5">

                            {{-- Icon --}}
                            <div
                                class="w-10 h-10 grid place-items-center rounded-lg bg-red-50 text-red-600 border border-red-200 shrink-0">
                                <span class="material-symbols-outlined !text-[20px]">
                                    description
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">

                                {{-- Title --}}
                                <a href="{{ route('dosen.katalog.showGlobal', $doc->id) }}"
                                    class="text-[15px] font-semibold text-gray-800 hover:text-blue-600 transition leading-snug
                                    line-clamp-2 uppercase">
                                    {{ $doc->title }}
                                </a>

                                {{-- Category and status --}}
                                <div class="flex items-center gap-2 mt-2 flex-wrap">

                                    {{-- Category --}}
                                    <span class="text-xs text-gray-500 truncate">
                                        {{ $doc->category->name }}
                                    </span>

                                    {{-- Divider --}}
                                    <span class="text-gray-300 text-xs">•</span>

                                    {{-- Tahun Terbit --}}
                                    <span class="text-xs text-gray-500 truncate">
                                        Tahun Terbit {{ $doc->tahun_terbit }}
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
                            <div class="w-10 h-10 rounded-full bg-indigo-100 text-blue-600 flex items-center justify-center
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
                        <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-2xl border border-emerald-200
                        bg-emerald-50 text-emerald-700 text-[11px] font-medium shrink-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Published
                        </div>

                    </div>

                    {{-- Action --}}
                    <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between">

                        {{-- Left --}}
                        <a href="{{ route('dosen.katalog.showGlobal', $doc->id) }}"
                            class="text-[13px] font-medium text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            Lihat Detail
                        </a>

                        {{-- Right --}}
                        <a href="{{ route('dosen.katalog.showGlobal', $doc->id) }}"
                            class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-500 hover:text-blue-600 hover:bg-blue-50
                            transition-all duration-200 group/icon">
                            <span
                                class="material-symbols-outlined !text-[18px] transition-transform duration-200 group-hover/icon:scale-110
                                group-hover/icon:translate-x-0.5">
                                arrow_outward
                            </span>
                        </a>
                    </div>

                </div>

            @empty

                {{-- Empty state --}}
                <div class="col-span-full text-center py-16 text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <span class="material-symbols-outlined text-gray-300 !text-[48px]">
                            folder_open
                        </span>
                        <p class="text-sm font-medium">
                            Belum ada dokumen tersedia
                        </p>
                    </div>
                </div>
            @endforelse
        </section>

        {{-- Pagination --}}
        <div>
            {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
        </div>

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

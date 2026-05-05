@extends('dosen.layouts.app')
@section('title', 'Dokumen Saya')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">
                    Daftar Dokumen Saya
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Upload dan kelola dokumen kamu dengan mudah.
                </p>
            </div>

            <a href="{{ route('dosen.documents.create') }}"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 text-[13px] text-blue-700 font-medium bg-blue-50 border border-blue-400 
                rounded-lg hover:bg-blue-100 transition">
                <span class="material-symbols-outlined !text-[17px]">
                    upload
                </span>
                Upload Dokumen
            </a>
        </div>

        {{-- Filter & Search --}}
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-3 flex items-center justify-between gap-4">

            {{-- Left: Filter Controls --}}
            <div class="flex items-center gap-2 w-full">

                {{-- Search --}}
                <div class="relative w-64">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                        search
                    </span>
                    <input id="search" type="text" placeholder="Cari judul dokumen..."
                        class="h-9 w-full pl-9 pr-3 text-[13px] border border-gray-300 rounded-md bg-white
                        focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400">
                </div>

                {{-- Category --}}
                <div class="relative">
                    <select id="category"
                        class="appearance-none h-9 pl-3 pr-8 text-[13px] border border-gray-300 rounded-md text-gray-600
                        bg-white focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400">

                        <option value="">Semua kategori</option>

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <span class="absolute right-2 top-5 -translate-y-1/2 text-gray-400 pointer-events-none">
                        <span class="material-symbols-outlined !text-[16px]">expand_more</span>
                    </span>
                </div>

                {{-- Reset --}}
                <button type="button" id="resetFilter"
                    class="h-9 px-3 flex items-center gap-1 text-[12px] text-gray-700 border border-gray-300 rounded-md 
                    bg-gray-50 hover:bg-gray-100 transition">

                    <span class="material-symbols-outlined !text-[14px]">cached</span>
                    Reset
                </button>

            </div>

            {{-- Right: Total --}}
            <div class="text-[12px] text-gray-500 whitespace-nowrap">
                <span id="totalCount" class="font-medium text-gray-700">
                    {{ $documents->total() }}
                </span> dokumen
            </div>

        </div>

        {{-- Table daftar dokumen --}}
        <div id="documentList" class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            @include('dosen.documents.partials.list')
        </div>

    </div>

    {{-- Script AJAX --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // 🔹 Ambil element dari UI
            const search = document.getElementById("search"); // input search
            const category = document.getElementById("category"); // dropdown kategori
            const list = document.getElementById("documentList"); // container list data
            const resetBtn = document.getElementById("resetFilter"); // tombol reset

            // 🔹 Membuat query string dari input user (search & category)
            function buildQuery() {
                let params = new URLSearchParams();

                if (search.value) params.append('search', search.value);
                if (category.value) params.append('category', category.value);

                return params.toString(); // contoh: search=abc&category=2
            }

            // 🔹 Ambil data dari server (tanpa reload)
            function fetchData(url = null) {

                let query = buildQuery(); // ambil filter aktif
                let finalUrl;

                // Jika dari pagination → pakai URL bawaan + filter
                if (url) {
                    finalUrl = url.includes('?') ? `${url}&${query}` : `${url}?${query}`;
                }
                // Jika dari search/filter → buat URL baru
                else {
                    finalUrl = query ? `?${query}` : window.location.pathname;
                }

                // 🔹 Kirim request ke server (AJAX)
                fetch(finalUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' // biar Laravel tahu ini AJAX
                        }
                    })
                    .then(res => res.text()) // ambil HTML hasil render
                    .then(html => {

                        // 🔹 Ganti isi list tanpa reload halaman
                        list.innerHTML = html;

                        // 🔹 Update URL di browser (biar bisa di-copy/share)
                        window.history.pushState(null, '', finalUrl);

                        // 🔹 Pasang ulang event pagination (karena DOM berubah)
                        bindPagination();
                    });
            }

            // 🔍 Search (pakai delay supaya tidak spam request)
            let timeout;
            search.addEventListener("input", function() {
                clearTimeout(timeout);
                timeout = setTimeout(fetchData, 400); // delay 400ms
            });

            // 🔽 Filter kategori (langsung fetch saat berubah)
            category.addEventListener("change", () => fetchData());

            // 🔁 Reset filter
            resetBtn.addEventListener("click", function() {
                search.value = ''; // kosongkan search
                category.value = ''; // reset kategori

                fetchData(); // reload data tanpa filter

                // Bersihkan URL (hilangkan query)
                window.history.pushState(null, '', window.location.pathname);
            });

            // 🔁 Pagination AJAX
            function bindPagination() {

                // Ambil hanya link yang mengandung "page="
                list.querySelectorAll("a[href*='page=']").forEach(link => {

                    link.onclick = function(e) {
                        e.preventDefault(); // cegah reload

                        // Ambil data halaman berikutnya via AJAX
                        fetchData(this.getAttribute("href"));
                    };
                });
            }

            // 🔹 Jalankan pertama kali (biar pagination aktif saat load awal)
            bindPagination();

        });
    </script>
@endsection

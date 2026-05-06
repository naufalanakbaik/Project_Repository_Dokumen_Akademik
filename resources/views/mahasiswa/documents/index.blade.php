@extends('mahasiswa.layouts.app')
@section('title', 'Daftar Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex justify-between items-center mb-5">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">
                My Documents
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Upload dan kelola dokumen kamu
            </p>
        </div>

        <a href="{{ route('mahasiswa.documents.create') }}"
            class="inline-flex items-center gap-1.5 px-3.5 py-2 text-[13px] text-blue-700 font-medium bg-blue-50 border border-blue-400 
            rounded-lg hover:bg-blue-100 transition">
            <span class="material-symbols-outlined !text-[17px]">
                upload
            </span>
            Upload Dokumen
        </a>
    </div>

    {{-- Filter dan search --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">

        {{-- Left: title + total --}}
        <div class="flex items-center gap-3">
            <h2 class="text-sm font-medium text-gray-700">
                Semua Dokumen Saya
            </h2>

            <span class="text-xs font-medium text-gray-600 bg-gray-100 px-2 py-0.5 border rounded-md">
                {{ $documents->total() }} items
            </span>
        </div>

        {{-- Right: search + filters --}}
        <div class="flex flex-wrap items-center gap-2">

            {{-- Search --}}
            <div class="relative w-full sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                    search
                </span>

                <input type="text" id="searchInput" placeholder="Cari judul dokumen..."
                    class="w-full h-9 pl-9 pr-3 text-[13px] border border-gray-300 rounded-md
                bg-white text-gray-800 placeholder:text-gray-400
                focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-400">
            </div>

            {{-- Status --}}
            <div class="relative">
                <select id="filterStatus"
                    class="h-9 pl-3 pr-8 text-sm border border-gray-300 rounded-md
                bg-white text-gray-700 appearance-none
                focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-400">
                    <option value="">Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>

                <span
                    class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 !text-[16px] pointer-events-none">
                    expand_more
                </span>
            </div>

            {{-- Category --}}
            <div class="relative">
                <select id="filterCategory"
                    class="h-9 pl-3 pr-8 text-sm border border-gray-300 rounded-md
                    bg-white text-gray-700 appearance-none
                    focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-400">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <span
                    class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 !text-[16px] pointer-events-none">
                    expand_more
                </span>
            </div>

        </div>

    </div>

    {{-- Table dokumen saya --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-sm overflow-hidden">

        <div id="documentsTable">
            @include('mahasiswa.documents.partials.table', ['documents' => $documents])
        </div>

    </div>

    {{-- Js ajak data table --}}
    <script>
        // Ambil element input dan filter dari DOM
        const searchEl = document.getElementById('searchInput');
        const statusEl = document.getElementById('filterStatus');
        const categoryEl = document.getElementById('filterCategory');

        // Variabel untuk delay search (debounce)
        let debounceTimer;

        // Fungsi utama untuk ambil data dari server (ajax)
        function fetchDocuments(url = null) {

            // Ambil semua nilai filter
            const params = new URLSearchParams({
                search: searchEl.value,
                status: statusEl.value,
                category: categoryEl.value
            });

            // Jika ada url (pagination), pakai itu. Jika tidak, pakai default route
            const endpoint = url ?? `{{ route('mahasiswa.documents.index') }}?${params}`;

            // Request ke server tanpa reload halaman
            fetch(endpoint, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Tandai request sebagai ajax
                    }
                })
                .then(res => res.text()) // Ambil response dalam bentuk html
                .then(html => {
                    // Replace isi table dengan hasil baru
                    document.getElementById('documentsTable').innerHTML = html;
                });
        }

        // Trigger saat filter status berubah
        statusEl.addEventListener('change', () => fetchDocuments());

        // Trigger saat filter kategori berubah
        categoryEl.addEventListener('change', () => fetchDocuments());

        // Trigger saat mengetik di search (pakai debounce agar tidak spam request)
        searchEl.addEventListener('input', function() {
            clearTimeout(debounceTimer); // Hapus delay sebelumnya
            debounceTimer = setTimeout(() => fetchDocuments(), 400); // Delay 400ms
        });

        // Handle pagination agar tidak reload halaman
        document.addEventListener('click', function(e) {
            const link = e.target.closest('.pagination a');
            if (link) {
                e.preventDefault(); // Cegah reload
                fetchDocuments(link.href); // Ambil data dari link pagination
            }
        });
    </script>

@endsection

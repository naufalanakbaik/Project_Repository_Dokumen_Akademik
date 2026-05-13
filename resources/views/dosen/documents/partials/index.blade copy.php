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
            <form method="GET" class="flex items-center gap-2 w-full">

                {{-- Search --}}
                <div class="relative w-64">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                        search
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..."
                        class="h-9 w-full pl-9 pr-3 text-[13px] border border-gray-300 rounded-md bg-white
                        focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400">
                </div>

                {{-- Category --}}
                <div class="relative">
                    <select name="category"
                        class="appearance-none h-9 pl-3 pr-8 text-[13px] border border-gray-300 rounded-md text-gray-600
                        bg-white focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400">

                        <option value="">Semua kategori</option>

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <span class="absolute right-2 top-5 -translate-y-1/2 text-gray-400 pointer-events-none">
                        <span class="material-symbols-outlined !text-[16px]">expand_more</span>
                    </span>
                </div>

                {{-- Auto submit trigger (hidden button for enter key) --}}
                <button type="submit" class="hidden"></button>

                {{-- Reset --}}
                @if (request('search') || request('category'))
                    <a href="{{ route('dosen.documents.index') }}"
                        class="h-9 px-3 flex items-center gap-1 text-[12px] text-gray-600
                        border border-gray-300 rounded-md bg-gray-50 hover:bg-gray-100 transition">

                        <span class="material-symbols-outlined !text-[16px]">close</span>
                        Reset
                    </a>
                @endif

            </form>

            {{-- Right: Total --}}
            <div class="text-[12px] text-gray-500 whitespace-nowrap">
                <span class="font-medium text-gray-700">{{ $documents->total() }}</span> dokumen
            </div>

        </div>

        <div id="documentList">
            @include('dosen.documents.partials.list')
        </div>

        {{-- Table daftar dokumen --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            @forelse ($documents as $index => $doc)
                <div class="flex items-center gap-4 px-5 py-3 border-b last:border-none hover:bg-gray-50 transition group">

                    {{-- Number --}}
                    <div class="w-6 text-xs text-gray-400 font-medium text-center flex-shrink-0">
                        {{ $index + 1 }}
                    </div>

                    {{-- Icon --}}
                    <div
                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-500 flex-shrink-0">
                        <span class="material-symbols-outlined !text-[18px]">
                            picture_as_pdf
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">

                        {{-- Title --}}
                        <p class="text-sm font-medium text-gray-900 truncate group-hover:text-gray-800">
                            {{ $doc->title }}
                        </p>

                        {{-- Meta --}}
                        <div class="flex items-center flex-wrap gap-3 mt-1 text-xs text-gray-500">

                            {{-- Category --}}
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined !text-[14px]">
                                    folder
                                </span>
                                {{ $doc->category->name }}
                            </div>

                            {{-- Status --}}
                            <span
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xl border text-[10px] font-medium
                                {{ $doc->status === 'approved'
                                    ? 'bg-green-50 text-green-700 border-green-200'
                                    : ($doc->status === 'pending'
                                        ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                                        : 'bg-red-50 text-red-700 border-red-200') }}">

                                <span class="material-symbols-outlined !text-[12px]">
                                    {{ $doc->status === 'approved' ? 'check_circle' : ($doc->status === 'pending' ? 'schedule' : 'cancel') }}
                                </span>

                                {{ ucfirst($doc->status) }}
                            </span>

                        </div>

                    </div>

                    {{-- Actions buttons --}}
                    <div class="flex items-center gap-2">

                        <a href="{{ route('dosen.documents.show', $doc->id) }}" class="p-2 hover:text-gray-700 transition"
                            title="Detail">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                file_open
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.edit', $doc->id) }}" class="p-2 hover:text-gray-700 transition"
                            title="Edit">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                edit_document
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.preview', $doc->id) }}" target="_blank"
                            class="p-2 hover:text-gray-700 transition" title="Preview">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                picture_as_pdf
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.download', $doc->id) }}"
                            class="p-2 hover:text-gray-700 transition" title="Download">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                download
                            </span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-sm text-gray-500">
                    Kamu belum memiliki dokumen.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div>
            {{ $documents->links() }}
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            if (!form) return;

            const searchInput = form.querySelector("input[name='search']");
            const categorySelect = form.querySelector("select[name='category']");

            // 🔹 Auto submit saat kategori berubah
            if (categorySelect) {
                categorySelect.addEventListener("change", () => form.submit());

                // 🔹 Support tekan Enter di select
                categorySelect.addEventListener("keydown", function(e) {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        form.submit();
                    }
                });
            }

            // 🔹 Auto submit saat mengetik (debounce)
            if (searchInput) {
                let timeout;
                searchInput.addEventListener("input", function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        form.submit();
                    }, 500);
                });
            }
        });
    </script>
@endsection

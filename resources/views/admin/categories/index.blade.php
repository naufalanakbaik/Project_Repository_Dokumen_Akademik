@extends('admin.layouts.app')
@section('title', 'Kategori Admin')

@section('content')

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-lg border border-gray-200/80 bg-white px-6 py-5 mb-6 shadow-sm">
        {{-- Soft Accent --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-violet-100 rounded-full blur-3xl opacity-40"></div>

        {{-- Head section --}}
        <div class="relative flex items-start justify-between gap-5">
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 mb-3 rounded-full border border-violet-200 bg-violet-50">
                    <span class="w-2 h-2 rounded-full bg-violet-500 animate-pulse"></span>
                    <span class="text-[11px] font-semibold tracking-wide text-violet-700 uppercase">
                        Manajemen Kategori
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 leading-tight">
                    Daftar & Kelola Kategori
                </h1>

                {{-- Description --}}
                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                    Kelola kategori dokumen repository akademik secara lebih terstruktur.
                    Tambahkan, edit, dan organisasikan kategori untuk mempermudah
                    pengelompokan serta pencarian dokumen di dalam sistem.
                </p>
            </div>

            {{-- Right Icon --}}
            <div
                class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-violet-200 bg-violet-50 shrink-0">
                <span class="material-symbols-outlined text-violet-600 !text-[24px]">
                    folder_open
                </span>
            </div>
        </div>

        {{-- Footer Section --}}
        <div
            class="mt-5 pt-4 border-t border-dashed border-gray-200 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            {{-- Left Info --}}
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Kategori aktif digunakan untuk pengelompokan dokumen
            </div>

            {{-- Right Date --}}
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <span class="material-symbols-outlined !text-[15px]">
                    calendar_month
                </span>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Header --}}
    <div class="flex flex-col gap-4 mb-5 lg:flex-row lg:items-end lg:justify-between">
        {{-- Left Section --}}
        <div class="flex flex-col gap-4">
            {{-- Title --}}
            <div>
                <h1 class="text-xl font-semibold text-gray-950">
                    Daftar Kategori
                </h1>
                <p class="text-xs text-blue-600 mt-0.5">
                    Kelola dan pantau seluruh pengguna dalam sistem secara efisien.
                </p>
            </div>

            {{-- Search --}}
            <form method="GET" class="flex items-center gap-2">
                {{-- Search Input --}}
                <div class="relative w-full sm:w-[320px]">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                        search
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search category..."
                        class="w-full h-10 pl-10 pr-4 text-sm text-gray-700
                        bg-white border border-gray-300 rounded-md placeholder:text-gray-400
                        focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-400 transition">
                </div>

                {{-- Search Button --}}
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-4 h-10 text-[13px] font-medium text-gray-700
                    bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[17px]">
                        search
                    </span>
                    Search
                </button>

                {{-- Reset --}}
                <a href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 h-10 text-[13px] font-medium text-gray-700
                    bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[17px]">
                        refresh
                    </span>
                    Reset
                </a>
            </form>
        </div>

        {{-- Right button add --}}
        <div class="flex items-center">
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center gap-1.5 px-4 h-9 text-[13px] text-blue-700 font-medium tracking-wide bg-blue-50 border 
                border-blue-400 rounded-lg hover:bg-blue-100 transition">
                <span class="material-symbols-outlined !text-[17px]">
                    add
                </span>
                Tambah Kategori
            </a>
        </div>
    </div>

    {{-- Message succes --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Table data kategori --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <div class="w-full overflow-x-auto">
            <table class="min-w-full text-sm table-auto">
                <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9] tracking-wide">
                    <tr>
                        <th class="px-2 py-3 font-medium text-center">No</th>
                        <th class="px-4 py-3 font-medium text-left">Nama</th>
                        <th class="px-4 py-3 font-medium text-left">Total Dokumen</th>
                        <th class="px-4 py-3 font-medium text-left">Tanggal dibuat</th>
                        <th class="px-4 py-3 font-medium text-left">Aksi</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y text-[13px] divide-gray-200">
                    @forelse ($categories as $key => $category)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- No --}}
                            <td class="px-4 py-3 text-center text-gray-500">
                                {{ $categories->firstItem() + $key }}
                            </td>

                            {{-- Nama --}}
                            <td class="px-4 py-3">
                                <p class="font-normal text-gray-900 truncate max-w-[420px]">
                                    {{ $category->name }}
                                </p>
                            </td>

                            {{-- Total Dokumen --}}
                            <td class="px-4 py-3 text-gray-600">
                                <span class="font-medium text-gray-700">
                                    {{ $category->documents_count }}
                                </span> Dokumen
                            </td>

                            {{-- Waktu --}}
                            <td class="px-4 py-3 text-gray-500">
                                {{ $category->created_at->format('d M Y - H:i') }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3 ">
                                <div class="flex items-center gap-8 text-gray-600">
                                    {{-- Detai --}}
                                    <a href="{{ route('admin.categories.show', $category->id) }}"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[19px]">folder_open</span>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" target="_blank"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[19px]">bookmark_manager</span>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-red-600 text-gray-600 transition">
                                            <span class="material-symbols-outlined !text-[19px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="5" class="px-6 py-16">
                                <div class="flex flex-col items-center justify-center text-center">
                                    {{-- Icon --}}
                                    <div
                                        class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 border border-gray-200 mb-4">
                                        <span class="material-symbols-outlined text-gray-600 !text-[30px]">
                                            folder_open
                                        </span>
                                    </div>

                                    {{-- Title --}}
                                    <h3 class="text-[15px] font-medium text-gray-800">
                                        Kategori Tidak Ditemukan
                                    </h3>

                                    {{-- Description --}}
                                    <p class="mt-1 text-[13px] text-gray-500 max-w-sm leading-relaxed">
                                        Belum ada kategori yang tersedia atau hasil pencarian
                                        tidak ditemukan.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

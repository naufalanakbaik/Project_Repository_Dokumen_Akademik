@extends('admin.layouts.app')
@section('title', 'Manajemen Dokumen')

@section('content')

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-lg border border-gray-200/80 bg-white px-6 py-5 mb-6 shadow-sm">
        {{-- Soft Accent --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-100 rounded-full blur-3xl opacity-40"></div>

        {{-- Head section --}}
        <div class="relative flex items-start justify-between gap-5">
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 mb-3 rounded-full border border-blue-200 bg-blue-50">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-[11px] font-semibold tracking-wide text-blue-700 uppercase">
                        Repository Dokumen
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 leading-tight">
                    Daftar & Kelola Dokumen Saya
                </h1>

                {{-- Description --}}
                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                    Kelola seluruh dokumen akademik Anda secara terstruktur dalam
                    sistem repositori program studi. Upload, pantau status validasi,
                    edit informasi dokumen, dan akses riwayat dokumen dengan lebih
                    mudah dan efisien.
                </p>
            </div>

            {{-- Right Icon --}}
            <div class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-blue-200 bg-blue-50 shrink-0">
                <span class="material-symbols-outlined text-blue-600 !text-[24px]">
                    description
                </span>
            </div>
        </div>

        {{-- Footer Section --}}
        <div class="mt-5 pt-4 border-t border-dashed border-gray-200 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            {{-- Left Info --}}
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Kelola dan pantau seluruh dokumen akademik Anda
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

    {{-- Top Actions --}}
    <div class="space-y-4 mb-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="ml-2">
                <h1 class="text-xl font-semibold text-gray-900">Daftar Dokumen</h1>
                <p class="text-[13px] text-gray-500">Kelola seluruh daftar dokumen di sistem repository</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.validation-documents.validation') }}"
                    class="inline-flex items-center gap-1.5 px-4 h-10 text-[13px] text-gray-700 font-medium tracking-wide bg-white border 
                    border-gray-400  rounded-lg hover:bg-gray-100 transition">
                    <span class="material-icons !text-[18px]">rule</span>
                    Validasi Dokumen
                </a>
                <a href="{{ route('admin.documents.create') }}"
                    class="inline-flex items-center gap-1.5 px-5 h-10 text-[13px] text-blue-700 font-medium tracking-wide bg-blue-50 border 
                    border-blue-400 rounded-lg hover:bg-blue-100 transition">
                    <span class="material-symbols-outlined !text-[17px]">upload_file</span>
                    Unggah Dokumen
                </a>
            </div>
        </div>

        {{-- Filters --}}
        <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
            <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center w-full">

                {{-- Search --}}
                <div class="relative w-full sm:max-w-xs">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[17px]">
                        search
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search documents..."
                        class="w-full h-9 pl-9 pr-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-md
                        placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200
                        focus:border-gray-400 transition">
                </div>

                {{-- Filter category --}}
                <div class="relative">
                    <select name="category_id"
                        class="appearance-none h-9 pl-3 pr-9 text-sm text-gray-700 bg-white border border-gray-300 rounded-md
                        focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-400 transition">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Arrow --}}
                    <span
                        class="pointer-events-none material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                        expand_more
                    </span>
                </div>

                {{-- Filer status --}}
                <div class="relative">
                    <select name="status"
                        class="appearance-none h-9 pl-3 pr-9 text-sm text-gray-700 bg-white border border-gray-300 rounded-md
                        focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-400 transition">
                        <option value="">All Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>
                    </select>

                    {{-- Arrow --}}
                    <span
                        class="pointer-events-none material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                        expand_more
                    </span>
                </div>

                {{-- Button cari / filter --}}
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-4 h-9 text-[13px] font-medium text-gray-700
                    bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[17px]">
                        filter_alt
                    </span>
                    Filter
                </button>

                {{-- Button reset --}}
                <a href="{{ route('admin.documents.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 h-9 text-[13px] font-medium text-gray-700
                    bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[17px]">
                        refresh
                    </span>
                    Reset
                </a>
            </form>
        </div>
    </div>

    {{-- Message succes --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Table data dokumen --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <div class="w-full overflow-x-auto">
            <table class="min-w-full text-sm table-auto">
                <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9] tracking-wide">
                    <tr>
                        <th class="px-4 py-3 text-center font-medium ">No</th>
                        <th class="px-4 py-3 text-left font-medium">Judul</th>
                        <th class="px-4 py-3 text-left font-medium whitespace-nowrap">Kategori</th>
                        <th class="px-4 py-3 text-left font-medium whitespace-nowrap">Pengguna</th>
                        <th class="px-4 py-3 text-left font-medium whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 text-left font-medium whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y text-[13px] divide-gray-200">
                    @forelse ($documents as $key => $doc)
                        <tr class="hover:bg-gray-50 transition">
                            <!-- Nomor -->
                            <td class="px-4 py-3 text-center text-gray-500">
                                {{-- {{ $loop->iteration }} --}}
                                {{ $key + 1 }}
                            </td>

                            <!-- Title -->
                            <td class="px-4 py-3 font-medium text-gray-900 max-w-[320px] truncate">
                                {{ $doc->title }}
                            </td>

                            <!-- Category -->
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                {{ $doc->category->name }}
                            </td>

                            <!-- User -->
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                {{ $doc->user->name }}
                            </td>

                            <!-- Status -->
                            <td class="px-4 py-3 text-center whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 text-[10px] font-medium uppercase rounded-xl border
                                    {{ $doc->status === 'approved'
                                        ? 'bg-green-50 text-green-700 border-green-300'
                                        : 'bg-red-50 text-red-700 border-red-300' }}">
                                    {{ ucfirst($doc->status) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-6 text-gray-600">
                                    <!-- Preview -->
                                    <a href="{{ route('admin.documents.preview', $doc->id) }}" target="_blank"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[18px]">picture_as_pdf</span>
                                    </a>

                                    <!-- Detail -->
                                    <a href="{{ route('admin.documents.show', $doc->id) }}"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[18px]">file_open</span>
                                    </a>

                                    <!-- Download -->
                                    <a href="{{ route('admin.documents.download', $doc->id) }}"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[18px]">file_save</span>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="hover:text-red-600 text-gray-600 transition">
                                            <span class="material-symbols-outlined !text-[18px]">delete</span>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400 text-sm">
                                Dokumen tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t bg-gray-50">
            {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
        </div>

    </div>

@endsection

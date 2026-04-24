@extends('admin.layouts.app')
@section('title', 'Manajemen Dokumen')


@section('content')

    {{-- Header --}}
    <div class="space-y-4 mb-4">
        {{-- Button validation & unggah --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">Daftar Dokumen</h1>
                <p class="text-sm text-gray-500">Kelola seluruh daftar dokumen di sistem repository</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.documents.validation') }}"
                    class="inline-flex items-center gap-1.5 px-4 h-9 text-[13px] text-gray-700 font-medium tracking-wide bg-white border border-gray-400 
                    rounded-lg hover:bg-gray-100 transition">
                    <span class="material-icons !text-[18px]">rule</span>
                    Validation
                </a>
                <a href="{{ route('admin.documents.create') }}"
                    class="inline-flex items-center gap-1.5 px-5 h-9 text-[13px] text-blue-700 font-medium tracking-wide bg-blue-50 border border-blue-400 
                    rounded-lg hover:bg-blue-100 transition">
                    <span class="material-symbols-outlined !text-[17px]">add_notes</span>
                    Unggah
                </a>
            </div>
        </div>

        {{-- Search --}}
        <div class="flex items-center justify-between">
            <form method="GET" class="relative w-full max-w-xs">
                <span class="material-icons absolute left-3 top-2.5 text-gray-400 !text-[18px]">
                    search
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search documents..."
                    class="w-full pl-9 pr-3 h-9 text-sm border border-gray-300 rounded-md
                focus:ring-2 focus:ring-gray-200 focus:border-gray-400 outline-none">
            </form>
        </div>
    </div>

    {{-- Table data dokumen --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <div class="w-full overflow-x-auto">
            <table class="min-w-full text-sm table-auto">
                <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9] tracking-wide">
                    <tr>
                        <th class="px-4 py-2 text-center font-medium ">No</th>
                        <th class="px-4 py-2 text-left font-medium">Judul</th>
                        <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Kategori</th>
                        <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Pengguna</th>
                        <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Status</th>
                        <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Aksi</th>
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
                                <div class="flex justify-end items-center gap-6 text-gray-600">
                                    <!-- Detail -->
                                    <a href="{{ route('admin.documents.show', $doc->id) }}"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[18px]">file_open</span> </a>
                                    <!-- Preview file -->
                                    <a href="{{ route('admin.documents.preview', $doc->id) }}" target="_blank"
                                        class=" hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[18px]">picture_as_pdf</span>
                                    </a>
                                    {{-- Download --}}
                                    <a href="{{ route('admin.documents.download', $doc->id) }}"
                                        class=" hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[18px]">file_save</span>
                                    </a>
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

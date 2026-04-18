{{-- @extends(auth()->user()->role . 'mahasiwa.layouts.app') --}}
@extends('mahasiswa.layouts.app')
@section('title', 'Daftar Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Daftar Dokumen
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Kelola dan pantau seluruh dokumen yang sudah di unggah dalam sistem.
            </p>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">

            {{-- Search : role -> All --}}
            <form action="{{ route(auth()->user()->role . '.documents.index') }}" method="GET" class="flex w-full md:w-80">
                <div class="relative flex-1">
                    <input type="text" name="search" placeholder="Cari nama dokumen..." value="{{ request('search') }}"
                        class="w-full pl-10 pr-3 py-2 text-sm border border-[#b6c1c9] rounded-l-lg 
                        focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">
                        search
                    </span>
                </div>

                {{-- Search button --}}
                <button type="submit"
                    class="px-3 py-2 bg-blue-700 text-white text-sm rounded-r-lg 
                    hover:bg-blue-800 transition flex items-center gap-1">
                    <span class="material-icons pt-0.5 !text-[19px]">search</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Unggah document : role -> Mahasiswa / Admin --}}
    @if (in_array(auth()->user()->role, ['mahasiswa', 'dosen']))
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">
                    Manajemen Dokumen
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola dan unggah dokumen sesuai kebutuhan sistem.
                </p>
            </div>

            {{-- Unggah button --}}
            <div class="flex justify-start md:justify-end">
                <a href="{{ route(auth()->user()->role . '.documents.create') }}"
                    class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    <span class="material-icons text-[18px]">upload</span>
                    Upload Dokumen
                </a>
            </div>
        </div>
    @endif

    {{-- Tabel dokumen : role -> All --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-sm overflow-hidden">

        <table class="w-full table-fixed">
            <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-700 border-b border-[#b6c1c9]">
                <tr>
                    <th class="w-12 px-3 py-3 font-medium text-center">No</th>
                    <th class="w-[30%] px-4 py-3 font-medium text-left">Dokumen</th>
                    <th class="w-[20%] px-4 py-3 font-medium text-left">Kategori</th>
                    <th class="w-[20%] px-4 py-3 font-medium text-left">Pengunggah</th>
                    <th class="w-[15%] px-4 py-3 font-medium text-left">Status</th>
                    <th class="w-[15%] px-4 py-3 font-medium text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 text-[13px]">
                @forelse($documents as $doc)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- No --}}
                        <td class="px-3 py-3 text-center text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Dokumen --}}
                        <td class="px-4 py-3">
                            <div class="flex items-start gap-3">

                                <span class="material-icons text-red-500 !text-[22px] mt-[2px]">
                                    description
                                </span>

                                <div class="min-w-0">
                                    <p class="font-medium text-gray-800 truncate">
                                        {{ $doc->title }}
                                    </p>
                                    <p class="text-[11px] text-gray-400 mt-0.5">
                                        {{ $doc->created_at->format('d M Y') }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        {{-- Kategori --}}
                        <td class="px-4 py-3">
                            <p class="truncate text-gray-700">
                                {{ $doc->category->name ?? '-' }}
                            </p>
                        </td>

                        {{-- Pengunggah --}}
                        <td class="px-4 py-3">
                            <p class="truncate text-gray-700">
                                {{ $doc->user->name ?? '-' }}
                            </p>
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">
                            <span
                                class="inline-block px-2.5 py-1 text-[10px] font-medium rounded-xl uppercase tracking-wide
                            {{ $doc->status == 'approved' ? 'bg-green-50 border border-green-300 text-green-700' : '' }}
                            {{ $doc->status == 'pending' ? 'bg-yellow-50 border border-yellow-300 text-yellow-700' : '' }}
                            {{ $doc->status == 'rejected' ? 'bg-red-50 border border-red-300 text-red-700' : '' }}">
                                {{ ucfirst($doc->status) }}
                            </span>
                        </td>

                        {{-- Action --}}
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1.5">

                                {{-- Lihat --}}
                                <a href="{{ route(auth()->user()->role . '.documents.preview', $doc->id) }}"
                                    target="_blank"
                                    class="px-2.5 py-1 text-xs text-gray-700 border border-gray-300 rounded 
                                hover:bg-gray-100 transition">
                                    Lihat
                                </a>

                                {{-- Download --}}
                                <a href="{{ route(auth()->user()->role . '.documents.download', $doc->id) }}"
                                    class="px-2.5 py-1 text-xs text-indigo-700 border border-indigo-200 rounded 
                                hover:bg-indigo-50 transition">
                                    Unduh
                                </a>

                                {{-- Action button : role -> Admin --}}
                                @if (auth()->user()->role === 'admin' && $doc->status === 'pending')
                                    <form action="{{ route('admin.documents.updateStatus', $doc->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit"
                                            class="px-2.5 py-1 text-xs text-green-700 border border-green-200 rounded 
                                        hover:bg-green-50 transition">
                                            Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.documents.updateStatus', $doc->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit"
                                            class="px-2.5 py-1 text-xs text-red-700 border border-red-200 rounded 
                                        hover:bg-red-50 transition">
                                            Tolak
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                            Tidak ada dokumen ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
            {{ $documents->links() }}
        </div>
    </div>


@endsection

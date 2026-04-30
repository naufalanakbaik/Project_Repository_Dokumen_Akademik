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
            class="inline-flex items-center gap-1.5 px-4 py-2 text-[13px] text-blue-700 font-medium tracking-wide bg-blue-50 border border-blue-400 
            rounded-lg hover:bg-blue-100 transition">
            <span class="material-symbols-outlined !text-[17px]">add_notes</span>
            Unggah Dokumen
        </a>
    </div>


    {{-- Table dokumen saya --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9]">
                <tr>
                    <th class="px-5 py-3 font-medium text-center w-[4%]">No</th>
                    <th class="px-5 py-3 font-medium text-left w-[35%]">Dokumen</th>
                    <th class="px-5 py-3 font-medium text-left w-[18%]">Kategori</th>
                    <th class="px-5 py-3 font-medium text-left w-[15%]">Tanggal</th>
                    <th class="px-5 py-3 font-medium text-left w-[12%]">Status</th>
                    <th class="px-5 py-3 font-medium text-left w-[23%]">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y text-[13px] divide-gray-200">
                @forelse ($documents as $doc)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Nomor --}}
                        <td class="px-5 py-3 text-center text-gray-600">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Title --}}
                        <td class="px-5 py-3">
                            <div class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-gray-700 !text-[20px] mt-1">
                                    description
                                </span>
                                <div class="min-w-0 max-w-[260px]">
                                    <p class="text-[13px] font-medium text-gray-800 line-clamp-2 leading-snug"
                                        title="{{ $doc->title }}">
                                        {{ Str::words($doc->title, 10, '...') }}
                                    </p>
                                    <p class="text-[11px] text-gray-400 mt-1 truncate">
                                        {{ basename($doc->file) }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        {{-- Category --}}
                        <td class="px-5 py-3 text-gray-700 text-[13px]">
                            <p class="font-normal text-gray-800 truncate max-w-[420px]">
                                {{ $doc->category->name }}
                            </p>
                        </td>

                        {{-- Date --}}
                        <td class="px-5 py-3 text-[13px]">
                            <p class="text-gray-800 font-medium">
                                {{ \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') }}
                            </p>
                            <p class="text-[11px] text-gray-400 mt-0.5">
                                {{ \Carbon\Carbon::parse($doc->created_at)->translatedFormat('l') }}
                            </p>
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-3 text-left">
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs rounded-2xl border font-medium
                                {{ $doc->status === 'approved'
                                ? 'bg-green-50 text-green-700 border-green-300'
                                : ($doc->status === 'pending'
                                ? 'bg-yellow-50 text-yellow-700 border-yellow-300'
                                : 'bg-red-50 text-red-700 border-red-300') }}">

                                <span class="material-symbols-outlined !text-[14px]">
                                    {{ $doc->status === 'approved' ? 'check_circle' : ($doc->status === 'pending' ? 'schedule' : 'cancel') }}
                                </span>
                                {{ ucfirst($doc->status) }}
                            </span>
                        </td>

                        {{-- Buttons --}}
                        <td class="px-5 py-3">
                            <div class="flex text-left gap-1">
                                <a href="{{ route('mahasiswa.documents.show', $doc->id) }}"
                                    class="p-2 transition group" title="Detail">
                                    <span class="material-symbols-outlined text-gray-500 group-hover:text-gray-800 !text-[18px]">
                                        file_open
                                    </span>
                                </a>
                                <a href="{{ route('mahasiswa.documents.preview', $doc->id) }}" target="_blank"
                                    class="p-2 transition group" title="Preview">
                                    <span class="material-symbols-outlined text-gray-500 group-hover:text-gray-800 !text-[18px]">
                                        picture_as_pdf
                                    </span>
                                </a>
                                <a href="{{ route('mahasiswa.documents.download', $doc->id) }}"
                                    class="p-2 transition group" title="Download">
                                    <span class="material-symbols-outlined text-gray-500 group-hover:text-gray-800 !text-[18px]">
                                        download
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-14 text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-gray-300 !text-[42px]">
                                    folder_open
                                </span>
                                <p class="text-sm font-medium">Belum ada dokumen</p>
                                <a href="{{ route('mahasiswa.documents.create') }}"
                                    class="mt-2 text-blue-600 text-sm hover:underline">
                                    Upload sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

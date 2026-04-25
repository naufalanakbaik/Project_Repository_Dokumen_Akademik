@extends('admin.layouts.app')
@section('title', 'Validasi Dokumen')

@section('content')
    {{-- Header --}}
    <div class="space-y-4 mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Daftar validasi dokumen </h1>
            <p class="text-sm text-gray-500">Daftar seluruh dokumen yanng belum di validasi</p>
        </div>
    </div>

    {{-- Table validasi dokumen --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">

        <table class="w-full">
            <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9]">
                <tr>
                    <th class="px-4 py-3 font-medium text-center">No.</th>
                    <th class="px-6 py-3 font-medium text-left">Judul</th>
                    <th class="px-6 py-3 font-medium text-left">Pengguna</th>
                    <th class="px-6 py-3 font-medium text-left">Tanggal diunggah</th>
                    <th class="px-6 py-3 font-medium text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y text-[13px] divide-gray-200">

                @forelse ($documents as $doc)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- No --}}
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Judul --}}
                        <td class="px-6 py-3">
                            <p class="text-gray-900 truncate max-w-[420px]">
                                {{ $doc->title }}
                            </p>
                        </td>

                        {{-- Pengguna --}}
                        <td class="px-6 py-3 text-gray-600">
                            {{ $doc->user->name }}
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-6 py-3 text-gray-500">
                            {{ $doc->created_at->format('d M Y - H:i') }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-3 text-center">
                            <div class="flex items-center justify-center gap-3">

                                {{-- Status badge --}}
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-xs 
                                bg-yellow-100 text-yellow-700 border border-yellow-200 rounded-full">

                                    <span class="material-symbols-outlined !text-[14px]">schedule</span>
                                    Pending
                                </span>

                                {{-- Detail --}}
                                <a href="{{ route('admin.validation-documents.show', $doc->id) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs 
                                bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">

                                    <span class="material-symbols-outlined !text-[16px]">visibility</span>
                                    Detail
                                </a>

                            </div>
                        </td>

                    </tr>

                @empty

                    {{-- EMPTY STATE --}}
                    <tr>
                        <td colspan="5" class="py-14 text-center">

                            <div class="flex flex-col items-center justify-center space-y-3 text-gray-500">

                                <!-- ICON -->
                                <span class="material-symbols-outlined text-[42px] text-gray-300">
                                    folder_off
                                </span>

                                <!-- TITLE -->
                                <p class="text-sm font-medium text-gray-700">
                                    Tidak ada dokumen untuk divalidasi
                                </p>

                                <!-- SUBTITLE -->
                                <p class="text-xs text-gray-400">
                                    Semua dokumen sudah diproses atau belum ada yang diajukan.
                                </p>

                            </div>

                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

        {{-- PAGINATION (hanya tampil kalau ada data) --}}
        @if ($documents->count() > 0)
            <div class="p-4 border-t bg-gray-50">
                {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
            </div>
        @endif

    </div>
@endsection

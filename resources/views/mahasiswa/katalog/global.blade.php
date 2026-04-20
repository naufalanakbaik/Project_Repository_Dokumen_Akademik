@extends('mahasiswa.layouts.app')
@section('title', 'Katalog Dokumen')

@section('content')

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-[21px] font-semibold text-gray-900">
            Semua Daftar Dokumen
        </h1>
        <p class="text-xs text-gray-500">
            Jelajahi seluruh dokumen yang tersedia di repository.
        </p>
    </div>

    {{-- Grid Dokumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($documents as $doc)
            <div class="bg-white border border-blue-300 rounded-xl hover:bg-blue-50 transition flex flex-col group">
                {{-- Header --}}
                <div class="flex items-start justify-between p-5 border-b border-gray-100">

                    {{-- Icon + Title --}}
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-50 text-gray-700 
                        border border-gray-300">
                            <span class="material-icons !text-[20px]">description</span>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-800 group-hover:text-blue-600 
                                transition line-clamp-2 uppercase">
                                {{ $doc->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $doc->category->name ?? 'Dokumen' }}
                            </p>
                        </div>
                    </div>

                    {{-- Status (Versi Awal - Improved) --}}
                    <span
                        class="flex items-center gap-1 text-[11px] font-normal px-2.5 py-1.5 rounded-2xl border
                        {{ $doc->status === 'approved'
                        ? 'bg-green-50 text-green-700 border-green-200'
                        : ($doc->status === 'pending'
                            ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                            : 'bg-red-50 text-red-700 border-red-200') }}">

                        <span class="material-icons !text-[13px]">
                            {{ $doc->status === 'approved' ? 'verified' : ($doc->status === 'pending' ? 'schedule' : 'close') }}
                        </span>
                        {{ ucfirst($doc->status) }}
                    </span>

                </div>

                {{-- Content--}}
                <div class="px-5 py-4 flex flex-col flex-1">
                    {{-- Author --}}
                    <p class="text-sm text-gray-600">
                        {{ $doc->user->name }}
                    </p>

                    {{-- Metadata --}}
                    <div class="mt-3 flex items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1.5">
                            <span class="material-icons !text-[16px]">schedule</span>
                            {{ $doc->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>

                {{-- Action button --}}
                <div class="px-5 py-3 border-t border-gray-100 flex items-center gap-3">
                    <a href="{{ route('mahasiswa.katalog.showGlobal', $doc->id) }}"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                        Detail
                    </a>

                    <span class="text-gray-300 text-sm">•</span>
                    <a href="{{ asset('storage/' . $doc->file) }}" target="_blank"
                        class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                        Lihat
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-gray-500">
                <div class="flex flex-col items-center gap-2">
                    <span class="material-icons text-4xl text-gray-300">folder_open</span>
                    <p class="text-sm">Belum ada dokumen tersedia</p>
                </div>
            </div>
        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
    </div>

@endsection

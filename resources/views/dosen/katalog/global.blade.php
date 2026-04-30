@extends('dosen.layouts.app')
@section('title', 'Global Document Catalog')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="space-y-3">
            <div>
                <h1 class="text-lg font-semibold text-gray-800">
                    Katalog Dokumen Global
                </h1>
                <p class="text-[13px] text-blue-600">
                    Jelajahi dan temukan dokumen akademik dari mahasiswa dan dosen.
                </p>
            </div>

            {{-- Search --}}
            <div class="relative max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                    search
                </span>
                <input type="text" placeholder="Cari judul dokumen..."
                    class="w-full pl-10 pr-4 h-10 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($documents as $doc)
                <a href="{{ route('dosen.katalog.showGlobal', $doc->id) }}"
                    class="group bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md hover:border-gray-300 transition">

                    {{-- Icon --}}
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-50 text-red-500">
                            <span class="material-symbols-outlined !text-[20px]">
                                picture_as_pdf
                            </span>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-400 transition">
                            open_in_new
                        </span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-sm font-semibold text-gray-900 leading-snug line-clamp-2">
                        {{ $doc->title }}
                    </h3>

                    {{-- Nama user dan kategori --}}
                    <div class="mt-3 space-y-1 text-xs text-gray-500">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined !text-[14px]">person</span>
                            {{ $doc->user->name }}
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined !text-[14px]">folder</span>
                            {{ $doc->category->name }}
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="mt-4 flex items-center justify-between">
                        <span
                            class="text-[11px] px-2 py-0.5 rounded-full border
                        {{ $doc->status === 'approved'
                            ? 'bg-green-50 text-green-700 border-green-200'
                            : ($doc->status === 'pending'
                                ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                                : 'bg-red-50 text-red-700 border-red-200') }}">
                            {{ ucfirst($doc->status) }}
                        </span>
                        <span class="text-xs text-gray-400 group-hover:text-blue-500 transition">
                            Lihat Detail
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-sm text-gray-500 py-10">
                    Belum ada dokumen tersedia.
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div>
            {{ $documents->links() }}
        </div>

    </div>
@endsection

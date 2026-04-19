@extends('mahasiswa.layouts.app')
@section('title', 'Katalog Dokumen')

@section('content')

        {{-- ===================== --}}
        {{-- HEADER --}}
        {{-- ===================== --}}
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">
                Global Documents
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Jelajahi seluruh dokumen yang tersedia di repository.
            </p>
        </div>

        {{-- ===================== --}}
        {{-- GRID DOCUMENT --}}
        {{-- ===================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($documents as $doc)
                <div
                    class="bg-white shadow-sm hover:shadow-md transition rounded-xl border border-gray-200 overflow-hidden flex flex-col group">

                    {{-- HEADER ICON --}}
                    <div
                        class="relative h-36 bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                        <span class="material-icons text-white text-5xl opacity-90">
                            description
                        </span>

                        {{-- Badge Category --}}
                        <span
                            class="absolute top-3 left-3 bg-white/90 text-indigo-600 text-xs font-semibold px-2 py-1 rounded-md">
                            {{ $doc->category->name ?? 'Dokumen' }}
                        </span>
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-5 flex flex-col flex-1">

                        {{-- Title --}}
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-700 transition line-clamp-2">
                            {{ $doc->title }}
                        </h3>

                        {{-- Author --}}
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="font-medium">Oleh:</span> {{ $doc->user->name }}
                        </p>

                        {{-- Optional spacing filler --}}
                        <div class="mt-auto pt-4 text-xs text-gray-500 flex items-center gap-4">

                            {{-- Date --}}
                            <span class="flex items-center gap-1.5">
                                <span class="material-icons !text-[15px]">schedule</span>
                                {{ $doc->created_at->format('d M Y') }}
                            </span>

                            {{-- Status --}}
                            <span class="flex items-center gap-1">
                                <span class="material-icons !text-[16px]">verified</span>
                                {{ ucfirst($doc->status) }}
                            </span>

                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="border-t border-gray-100 p-4 flex gap-2">

                        <a href="{{ route('mahasiswa.katalog.showGlobal', $doc->id) }}"
                            class="flex-1 text-center rounded-lg border border-indigo-600 text-indigo-600 px-3 py-2 text-sm font-semibold hover:bg-indigo-50 transition">
                            Detail
                        </a>

                        <a href="{{ asset('storage/' . $doc->file) }}" target="_blank"
                            class="flex-1 text-center rounded-lg bg-indigo-600 text-white px-3 py-2 text-sm font-semibold hover:bg-indigo-700 transition">
                            Lihat
                        </a>

                    </div>

                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <span class="material-icons text-4xl text-gray-300">folder_open</span>
                        <p>Belum ada dokumen tersedia</p>
                    </div>
                </div>
            @endforelse

        </div>

        {{-- ===================== --}}
        {{-- PAGINATION --}}
        {{-- ===================== --}}
        <div class="mt-8">
            {{ $documents->links() }}
        </div>

@endsection

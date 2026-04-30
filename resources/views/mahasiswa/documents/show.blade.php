@extends('mahasiswa.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex items-start justify-between pb-2">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Detail Dokumen
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap dan preview dokumen
            </p>
        </div>

        <a href="{{ route('mahasiswa.documents.index') }}"
            class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-0.5">
            Back
            <span class="material-icons !text-[18px]">low_priority</span>
        </a>
    </div>

    {{-- Main grid --}}
    <div class="grid grid-cols-12 gap-6">

        {{-- Left: Preview file --}}
        <div class="col-span-12 lg:col-span-8">

            <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden flex flex-col">

                {{-- Header Preview --}}
                <div class="flex items-center justify-between px-4 py-3 border-b bg-gray-50">
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                        <span class="material-symbols-outlined !text-[18px]">description</span>
                        Preview Dokumen
                    </div>
                    <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                        class="flex items-center gap-1 text-xs px-3 py-1.5 border border-gray-300
                        bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                        <span class="material-symbols-outlined !text-[16px]">download</span>
                        Download
                    </a>
                </div>

                {{-- PDF Viewer --}}
                <iframe src="{{ asset('storage/' . $document->file) }}" class="w-full h-[650px] bg-gray-100">
                </iframe>

                {{-- Footer --}}
                <div class="flex items-center justify-between px-4 py-4 border-t bg-gray-50 text-xs text-gray-500">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined !text-[16px]">insert_drive_file</span>
                        {{ basename($document->file) }}
                    </div>
                    <div>
                        {{ \Carbon\Carbon::parse($document->created_at)->translatedFormat('d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Document Info --}}
        <div class="col-span-12 lg:col-span-4 space-y-5">

            {{-- Document Info --}}
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">

                {{-- Header --}}
                <div class="flex items-center justify-between px-5 py-4 border-b bg-gray-50 rounded-t-xl">
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                        <span class="material-symbols-outlined !text-[18px]">list_alt</span>
                        Informasi Dokumen
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-4 space-y-5">

                    {{-- Title Highlight --}}
                    <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                        <p class="text-xs text-gray-500 mb-1">Judul Dokumen</p>
                        <h3 class="text-sm font-semibold text-gray-700 leading-snug">
                            {{ $document->title }}
                        </h3>
                    </div>

                    {{-- Grid Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Category --}}
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <span class="material-symbols-outlined text-gray-400 !text-[20px]">
                                folder
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Kategori</p>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ $document->category->name }}
                                </p>
                            </div>
                        </div>

                        {{-- Date --}}
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <span class="material-symbols-outlined text-gray-400 !text-[20px]">
                                calendar_today
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Upload</p>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($document->created_at)->translatedFormat('d M Y') }}
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Status (Highlight Section) --}}
                    <div class="border-t pt-4">
                        <p class="text-xs text-gray-500 mb-2">Status Dokumen</p>

                        <span
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm rounded-full border font-medium
                            {{ $document->status === 'approved'
                                ? 'bg-green-50 text-green-700 border-green-200'
                                : ($document->status === 'pending'
                                    ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                                    : 'bg-red-50 text-red-700 border-red-200') }}">

                            <span class="material-symbols-outlined !text-[16px]">
                                {{ $document->status === 'approved'
                                    ? 'check_circle'
                                    : ($document->status === 'pending'
                                        ? 'schedule'
                                        : 'cancel') }}
                            </span>

                            {{ ucfirst($document->status) }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- Actions button --}}
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm sticky top-6">
                <div class="px-5 py-3 border-b bg-gray-50 text-sm rounded-t-lg">
                    <div class="flex items-center gap-1 text-sm text-gray-700">
                        <span class="material-symbols-outlined !text-[18px]">right_click</span>
                        Aksi Cepat
                    </div>
                </div>

                <div class="p-4 space-y-3">

                    {{-- Preview --}}
                    <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-gray-800
                        border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <span class="material-symbols-outlined !text-[18px]">
                            open_in_new
                        </span>
                        Buka di Tab Baru
                    </a>

                    {{-- Download --}}
                    <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm
                        bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
                        <span class="material-symbols-outlined !text-[18px]">
                            download
                        </span>
                        Download File
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

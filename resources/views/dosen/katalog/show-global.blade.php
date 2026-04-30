@extends('dosen.layouts.app')
@section('title', 'Detail Global Document Catalog')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-900 leading-snug">
                    {{ $document->title }}
                </h1>
                <div class="flex items-center gap-3 text-[12px] text-gray-500 mt-1">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[14px]">person</span>
                        {{ $document->user->name }}
                    </div>
                    <span>•</span>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[14px]">folder</span>
                        {{ $document->category->name }}
                    </div>
                </div>
            </div>

            <a href="{{ route('dosen.katalog.global') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-0.5">
                Back
                <span class="material-icons !text-[18px]">low_priority</span>
            </a>
        </div>

        {{-- Main Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Preview PDF --}}
            <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

                {{-- Viewer Header --}}
                <div class="px-4 py-4 border-b bg-gray-50 flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">
                        Preview Dokumen
                    </span>

                    <a href="{{ route('dosen.documents.preview', $document->id) }}" target="_blank"
                        class="text-xs text-blue-600 hover:underline">
                        Buka di tab baru
                    </a>
                </div>

                {{-- Frame PDF --}}
                <div class="w-full h-[650px]">
                    <iframe src="{{ route('dosen.documents.preview', $document->id) }}" class="w-full h-full"
                        frameborder="0">
                    </iframe>
                </div>

                {{-- Footer --}}
                <div class="px-4 py-4 border-t bg-gray-50 flex items-center justify-between text-xs text-gray-500">

                    <div class="flex items-center gap-3">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined !text-[14px]">description</span>
                            PDF Document
                        </span>

                        <span>•</span>

                        <span>
                            {{ \Carbon\Carbon::parse($document->created_at)->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="hidden sm:inline">
                            Gunakan scroll untuk membaca
                        </span>

                        <a href="{{ route('dosen.documents.download', $document->id) }}"
                            class="text-blue-600 hover:underline">
                            Download
                        </a>
                    </div>

                </div>
            </div>

            {{-- Left information --}}
            <div class="space-y-5">

                {{-- Info Card --}}
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">

                    <div class="px-4 py-3 border-b bg-gray-50 text-sm rounded-t-lg font-medium text-gray-700">
                        Informasi Dokumen
                    </div>

                    <div class="p-4 space-y-4 text-sm">

                        <div>
                            <p class="text-xs text-gray-500">Uploader</p>
                            <p class="text-gray-900 font-medium mt-1">
                                {{ $document->user->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Kategori</p>
                            <p class="text-gray-800 mt-1">
                                {{ $document->category->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Tanggal Upload</p>
                            <p class="text-gray-800 mt-1">
                                {{ \Carbon\Carbon::parse($document->created_at)->translatedFormat('d M Y') }}
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 space-y-3">

                    <a href="{{ route('dosen.documents.download', $document->id) }}"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">

                        <span class="material-symbols-outlined !text-[18px]">
                            download
                        </span>
                        Download Dokumen
                    </a>

                    <a href="{{ route('dosen.documents.preview', $document->id) }}" target="_blank"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm border border-gray-200 rounded-lg hover:bg-gray-50 transition">

                        <span class="material-symbols-outlined !text-[18px]">
                            open_in_new
                        </span>
                        Buka Tab Baru
                    </a>

                </div>

            </div>

        </div>

    </div>
@endsection

@extends('mahasiswa.layouts.app')
@section('title', 'Detail Katalog Dokumen')

@section('content')

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-5">
        <div>
            <h1 class="text-xl font-semibold text-gray-900 leading-tight">
                Detail {{ $document->title }}
            </h1>
            <div class="flex items-center gap-3 text-[12px] text-gray-500 mt-1.5 flex-wrap">
                <span>•</span>
                <span class="flex items-center gap-1">
                    <span class="material-icons !text-[15px]">person</span>
                    {{ $document->user->name }}
                </span>
                <span>•</span>
                <span class="flex items-center gap-1">
                    <span class="material-icons !text-[15px]">folder</span>
                    {{ $document->category->name }}
                </span>
                <span>•</span>
                <span class="flex items-center gap-1">
                    <span class="material-icons !text-[15px]">schedule</span>
                    {{ $document->created_at->format('d M Y') }}
                </span>
            </div>
        </div>

        <a href="{{ route('mahasiswa.katalog.global') }}"
            class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-0.5">
            Back
            <span class="material-icons !text-[18px]">low_priority</span>
        </a>
    </div>


    {{-- MAIN CARD --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        {{-- FILE PREVIEW HEADER --}}
        <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-4">
                {{-- FILE ICON PDF --}}
                <div
                    class="w-12 h-12 flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600">
                    <span class="material-icons text-[26px]">picture_as_pdf</span>
                </div>
                <div>
                    {{-- TITLE --}}
                    <p class="text-sm font-semibold text-gray-800 line-clamp-1">
                        {{ $document->title }}
                    </p>
                    {{-- SUBTITLE --}}
                    <p class="text-xs text-gray-500 mt-0.5">
                        PDF Document • Preview File
                    </p>
                </div>
            </div>

            {{-- OPTIONAL: QUICK ACTION --}}
            <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                class="hidden sm:flex items-center gap-1 text-xs font-medium text-gray-500 hover:text-blue-600 transition">
                <span class="material-symbols-outlined !text-[14px]">file_save</span>
                Download
            </a>
        </div>

        {{-- CONTENT --}}
        <div class="p-6 space-y-6">
            {{-- INFO GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Uploader</p>
                    <p class="text-sm font-medium text-gray-900">
                        {{ $document->user->name }}
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Category</p>
                    <p class="text-sm font-medium text-gray-900">
                        {{ $document->category->name }}
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Tanggal Upload</p>
                    <p class="text-sm font-medium text-gray-900">
                        {{ $document->created_at->format('d F Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Status</p>
                    <span
                        class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-medium rounded-xl uppercase
                        {{ $document->status === 'approved'
                            ? 'bg-green-50 text-green-700 border border-green-200'
                            : ($document->status === 'pending'
                            ? 'bg-yellow-50 text-yellow-700 border border-yellow-200'
                            : 'bg-red-50 text-red-700 border border-red-200') }}">
                        {{ ucfirst($document->status) }}
                    </span>
                </div>
            </div>

            {{-- DIVIDER --}}
            <div class="border-t border-gray-100"></div>

            {{-- ACTIONS --}}
            <div class="flex flex-wrap gap-3">
                {{-- PREVIEW --}}
                <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                    class="flex items-center gap-1.5 px-4 py-2 text-sm text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[17px]">file_open</span>
                    Preview
                </a>
                {{-- DOWNLOAD PRIMARY --}}
                <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                    class="flex items-center gap-1.5 px-4 py-2 text-sm text-red-700 bg-red-50 border border-red-300 rounded-lg hover:bg-red-100 transition shadow-sm">
                    <span class="material-symbols-outlined !text-[17px]">file_save</span>
                    Download PDF
                </a>
            </div>
        </div>
    </div>

@endsection

@extends('mahasiswa.layouts.app')
@section('title', 'Detail Katalog Dokumen')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-6 space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-3 sm:mb-5">
            <div>
                <h1 class="text-xl font-semibold text-gray-900 leading-tight">
                    Detail {{ $document->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[12px] text-gray-500 mt-2 sm:mt-1.5">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">person</span>
                        {{ $document->user->name }}
                    </span>

                    <span class="hidden sm:inline text-gray-300">•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">folder</span>
                        {{ $document->category->name }}
                    </span>

                    <span class="hidden sm:inline text-gray-300">•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">calendar_check</span>
                        Tahun Terbit
                        {{ $document->tahun_terbit }}
                    </span>
                </div>
            </div>

            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('mahasiswa.katalog.global') }}"
                class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700 transition sm:border-none sm:bg-transparent sm:px-0 sm:py-0">
                <span class="material-symbols-outlined !text-[18px]">low_priority</span>
                Back
            </a>
        </div>


        {{-- Main card --}}
        <div class="bg-white border border-amber-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Header bar --}}
            <div class="flex flex-row items-center justify-between p-4 sm:p-5 border-b border-amber-100 bg-amber-50 gap-4">

                <div class="flex items-center gap-3 sm:gap-4 flex-1 min-w-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600 shrink-0">
                        <span class="material-symbols-outlined !text-[22px] sm:text-[26px]">picture_as_pdf</span>
                    </div>

                    <div class="min-w-0">
                        <p class="text-[13px] sm:text-sm font-semibold text-gray-800 line-clamp-1">
                            {{ $document->title }}
                        </p>
                        <p class="text-[11px] sm:text-xs text-gray-500 mt-0.5">
                            PDF Document • Siap dibuka
                        </p>
                    </div>
                </div>

                {{-- Status published --}}
                <div
                    class="flex items-center gap-1.5 px-2 py-1 sm:px-2.5 sm:py-1 rounded-2xl border border-emerald-200
                    bg-emerald-50 text-emerald-700 text-[10px] sm:text-[11px] font-medium shrink-0">
                    <span class="hidden sm:inline w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Published
                </div>

            </div>


            {{-- Content --}}
            <div class="p-6 space-y-6">

                {{-- File preview no frame --}}
                <div
                    class="border border-gray-200 rounded-lg p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4">

                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg
                        bg-red-50 border border-red-200 text-red-600 shrink-0">
                            <span class="material-symbols-outlined !text-[22px]">picture_as_pdf</span>
                        </div>

                        <div class="min-w-0">
                            <p class="text-[13px] sm:text-sm font-medium text-gray-900 line-clamp-1">
                                {{ $document->title }}
                            </p>
                            <p class="text-[11px] sm:text-xs text-gray-500 mt-0.5">
                                PDF • {{ $document->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                            class="flex-1 sm:flex-none justify-center px-4 py-2 sm:px-3 sm:py-1.5 text-[12px] sm:text-[11px] border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center gap-1.5">
                            <span class="material-symbols-outlined !text-[16px] sm:text-[14px]">open_in_new</span>
                            Preview
                        </a>

                        <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                            class="flex-1 sm:flex-none justify-center px-4 py-2 sm:px-3 sm:py-1.5 text-[12px] sm:text-[11px] border border-red-300 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition flex items-center gap-1.5 shadow-sm shadow-red-100">
                            <span class="material-symbols-outlined !text-[16px] sm:text-[14px]">download</span>
                            Download
                        </a>
                    </div>
                </div>

                {{-- Information Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <div>
                        <p class="text-[11.5px] font-medium text-gray-500 mb-1">Uploader</p>
                        <p class="text-sm font-medium text-gray-600">
                            {{ $document->user->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11.5px] font-medium text-gray-500 mb-1">Kategori</p>
                        <p class="text-sm font-medium text-gray-600">
                            {{ $document->category->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11.5px] font-medium text-gray-500 mb-1">Tanggal Upload</p>
                        <p class="text-sm font-medium text-gray-600">
                            {{ $document->created_at->format('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11.5px] font-medium text-gray-500 mb-1">Tipe File</p>
                        <p class="text-sm font-medium text-gray-600">
                            PDF Document
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

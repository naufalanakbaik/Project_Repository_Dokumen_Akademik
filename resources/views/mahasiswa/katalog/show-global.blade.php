@extends('mahasiswa.layouts.app')
@section('title', 'Detail Katalog Dokumen')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between mb-5">
            <div>
                <h1 class="text-xl font-semibold text-gray-900 leading-tight">
                    Detail {{ $document->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-3 text-[12px] text-gray-500 mt-1.5">
                    <span>•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">person</span>
                        {{ $document->user->name }}
                    </span>

                    <span>•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">folder</span>
                        {{ $document->category->name }}
                    </span>

                    <span>•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">calendar_check</span>
                        Tahun Terbit
                        {{ $document->tahun_terbit }}
                    </span>
                </div>
            </div>

            <a href="{{ route('mahasiswa.katalog.global') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-1">
                Back
                <span class="material-symbols-outlined !text-[18px]">low_priority</span>
            </a>
        </div>


        {{-- Main card --}}
        <div class="bg-white border border-amber-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Header bar --}}
            <div class="flex items-center justify-between p-5 border-b border-amber-100 bg-amber-50">

                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-600">
                        <span class="material-symbols-outlined !text-[26px]">picture_as_pdf</span>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800 line-clamp-1">
                            {{ $document->title }}
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5">
                            PDF Document • Siap dibuka
                        </p>
                    </div>
                </div>

                {{-- Status published --}}
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-2xl border border-emerald-200
                    bg-emerald-50 text-emerald-700 text-[11px] font-medium shrink-0">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Published
                </div>

            </div>


            {{-- Content --}}
            <div class="p-6 space-y-6">

                {{-- File preview no frame --}}
                <div class="border border-gray-200 rounded-lg p-5 flex items-center justify-between">

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-lg
                        bg-red-50 border border-red-200 text-red-600">
                            <span class="material-symbols-outlined !text-[22px]">picture_as_pdf</span>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $document->title }}
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5">
                                PDF • {{ $document->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="flex items-center gap-2">
                        <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                            class="px-3 py-1.5 text-[11px] border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition flex items-center gap-1">
                            <span class="material-symbols-outlined !text-[14px]">open_in_new</span>
                            Preview
                        </a>

                        <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                            class="px-3 py-1.5 text-[11px] border border-red-300 bg-red-50 text-red-700 rounded-md hover:bg-red-100 transition flex items-center gap-1">
                            <span class="material-symbols-outlined !text-[14px]">download</span>
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

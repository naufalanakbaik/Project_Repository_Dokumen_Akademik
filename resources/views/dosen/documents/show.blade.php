@extends('dosen.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800 leading-tight">
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
                        <span class="material-symbols-outlined !text-[15px]">calendar_check</span>
                        Tahun Terbit
                        {{ $document->tahun_terbit }}
                    </span>

                    <span>•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">folder</span>
                        {{ $document->category->name }}
                    </span>

                    {{-- <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">calendar_check</span>
                        {{ $document->created_at->format('d M Y') }}
                    </span> --}}
                </div>
            </div>

            <a href="{{ route('dosen.documents.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-1">
                Back
                <span class="material-icons !text-[18px]">low_priority</span>
            </a>
        </div>

        {{-- Main grid content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left: preview frame pdf --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Header title --}}
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 flex items-center justify-between">

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-lg
                            bg-red-50 border border-red-200 text-red-600">
                            <span class="material-icons !text-[22px]">picture_as_pdf</span>
                        </div>

                        <div class="leading-tight">
                            <p class="text-sm font-semibold text-gray-900 line-clamp-1">
                                {{ $document->title }}
                            </p>

                            <div class="flex items-center gap-2 text-[12px] text-gray-500 mt-0.5">
                                <span>PDF</span>
                                <span>•</span>
                                <span>Preview tersedia</span>
                            </div>
                        </div>
                    </div>

                    <span
                        class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-medium rounded-xl
                        {{ $document->status === 'approved'
                        ? 'bg-emerald-50 text-emerald-700 border-emerald-300'
                        : ($document->status === 'pending'
                        ? 'bg-amber-50 text-amber-600 border-amber-300'
                        : 'bg-red-50 text-red-700 border-red-300') }}">

                        <span class="material-symbols-outlined !text-[12px]">
                            {{ $document->status === 'approved' ? 'check_circle' : ($document->status === 'pending' ? 'schedule' : 'cancel') }}
                        </span>

                        {{ ucfirst($document->status) }}
                    </span>
                </div>

                {{-- PDF preview frame --}}
                <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden">

                    {{-- Header Preview --}}
                    <div class="px-5 py-4 border-b bg-gray-50 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">
                            Preview Dokumen
                        </span>

                        <a href="{{ route('dosen.documents.preview', $document->id) }}" target="_blank"
                            class="text-xs text-blue-600 hover:underline">
                            Buka di tab baru
                        </a>
                    </div>

                    {{-- PDF Viewer --}}
                    <div class="w-full h-[650px] bg-gray-100">
                        <iframe src="{{ route('dosen.documents.preview', $document->id) }}" class="w-full h-full"></iframe>
                    </div>

                    {{-- Footer --}}
                    <div class="px-5 py-3 border-t bg-gray-50 text-xs text-gray-500 flex justify-between">
                        <span>Gunakan scroll untuk membaca dokumen</span>
                        <span>Format: PDF</span>
                    </div>
                </div>
            </div>

            {{-- Right: information documents & action buttons --}}
            <div class="space-y-5">

                {{-- Data documents --}}
                <div class="bg-white border border-gray-300 rounded-lg">

                    <div class="px-5 py-4 border-b bg-gray-50 text-sm rounded-t-lg font-medium text-gray-700">
                        Informasi Dokumen
                    </div>

                    <div class="divide-y text-sm">

                        <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                            <span class="text-xs text-gray-500 font-medium">Uploader</span>
                            <span class="font-medium text-gray-600">
                                {{ $document->user->name }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                            <span class="text-xs text-gray-500 font-medium">Tahun Terbit</span>
                            <span class="font-medium text-gray-600">
                                {{ $document->tahun_terbit }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                            <span class="text-xs text-gray-500 font-medium">Kategori</span>
                            <span class="font-medium text-gray-600">
                                {{ $document->category->name }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                            <span class="text-xs text-gray-500 font-medium">Tanggal Upload</span>
                            <span class="font-medium text-gray-600">
                                {{ $document->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                            <span class="text-xs text-gray-500 font-medium">Tipe File</span>
                            <span class="font-medium text-gray-600">
                                PDF
                            </span>
                        </div>

                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="bg-white border border-gray-300 rounded-lg p-3 space-y-2">

                    <a href="{{ route('dosen.documents.download', $document->id) }}"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                        border border-red-300 bg-red-50 text-red-700 rounded-md hover:bg-red-100 transition">
                        <span class="material-icons !text-[16px]">download</span>
                        Download
                    </a>

                    <a href="{{ route('dosen.documents.preview', $document->id) }}" target="_blank"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                        border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                        <span class="material-icons !text-[16px]">open_in_new</span>
                        Buka di Tab Baru
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection

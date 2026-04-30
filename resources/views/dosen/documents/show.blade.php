@extends('dosen.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')
    <div class="w-full space-y-6">

        <!-- Header -->
        <div class="flex items-start justify-between">

            <div>
                <h1 class="text-2xl font-semibold text-gray-900 leading-snug">
                    {{ $document->title }}
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $document->category->name }}
                </p>
            </div>

            <!-- Status -->
            <span
                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs rounded-full border font-medium
            {{ $document->status === 'approved'
                ? 'bg-green-50 text-green-700 border-green-200'
                : ($document->status === 'pending'
                    ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                    : 'bg-red-50 text-red-700 border-red-200') }}">

                <span class="material-symbols-outlined !text-[14px]">
                    {{ $document->status === 'approved'
                        ? 'check_circle'
                        : ($document->status === 'pending'
                            ? 'schedule'
                            : 'cancel') }}
                </span>

                {{ ucfirst($document->status) }}
            </span>

        </div>

        <!-- Main content -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- PDF Viewer -->
            <div class="xl:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col">

                <!-- Header Viewer -->
                <div class="px-4 py-3 border-b bg-gray-50 text-sm font-medium text-gray-700 flex justify-between">
                    <span>Preview Dokumen</span>

                    <a href="{{ route('dosen.documents.preview', $document->id) }}" target="_blank"
                        class="text-blue-600 hover:underline text-xs">
                        Buka Tab Baru
                    </a>
                </div>

                <!-- Iframe -->
                <div class="w-full h-[75vh]">
                    <iframe src="{{ route('dosen.documents.preview', $document->id) }}" class="w-full h-full"
                        frameborder="0">
                    </iframe>
                </div>

                <!-- Footer Viewer -->
                <div class="px-4 py-2 border-t bg-gray-50 text-xs text-gray-500 flex justify-between">
                    <span>
                        {{ \Carbon\Carbon::parse($document->created_at)->translatedFormat('d M Y') }}
                    </span>

                    <span>
                        Gunakan scroll untuk membaca
                    </span>
                </div>

            </div>

            <!-- Side bar information -->
            <div class="space-y-5">

                <!-- Info -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

                    <div class="px-4 py-3 border-b bg-gray-50 text-sm rounded-t-xl font-medium text-gray-700">
                        Informasi Dokumen
                    </div>

                    <div class="p-4 space-y-4 text-sm">

                        <div>
                            <p class="text-xs text-gray-500">Judul</p>
                            <p class="text-gray-900 font-medium mt-1">
                                {{ $document->title }}
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
                        Download
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

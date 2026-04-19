@extends('mahasiswa.layouts.app')
@section('title', 'Detail Katalog Dokumen')

@section('content')
    <!-- ===================== -->
    <!-- HEADER -->
    <!-- ===================== -->
    <div class="flex items-start justify-between">

        <div>
            <h1 class="text-2xl font-semibold text-gray-900 leading-tight">
                {{ $document->title }}
            </h1>

            <div class="flex items-center gap-3 text-sm text-gray-500 mt-2">
                <span class="flex items-center gap-1">
                    <span class="material-icons !text-[16px]">person</span>
                    {{ $document->user->name }}
                </span>

                <span>•</span>

                <span class="flex items-center gap-1">
                    <span class="material-icons !text-[16px]">folder</span>
                    {{ $document->category->name }}
                </span>

                <span>•</span>

                <span class="flex items-center gap-1">
                    <span class="material-icons !text-[16px]">schedule</span>
                    {{ $document->created_at->format('d M Y') }}
                </span>
            </div>
        </div>

        <a href="{{ route('mahasiswa.katalog.global') }}"
            class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <span class="material-icons text-[18px]">arrow_back</span>
            Back
        </a>

    </div>


    <!-- ===================== -->
    <!-- MAIN CARD -->
    <!-- ===================== -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <!-- Preview Header -->
        <div class="h-48 bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center relative">

            <span class="material-icons text-white text-6xl opacity-90">
                description
            </span>

            <span class="absolute top-4 left-4 bg-white/90 text-indigo-600 text-xs font-semibold px-3 py-1 rounded-md">
                {{ ucfirst($document->status) }}
            </span>

        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">

            <!-- Info Grid -->
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
                        class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-md
                        {{ $document->status === 'approved'
                            ? 'bg-green-50 text-green-700 border border-green-100'
                            : ($document->status === 'pending'
                                ? 'bg-yellow-50 text-yellow-700 border border-yellow-100'
                                : 'bg-red-50 text-red-700 border border-red-100') }}">
                        {{ ucfirst($document->status) }}
                    </span>
                </div>

            </div>

            <!-- Divider -->
            <div class="border-t border-gray-100"></div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-3">

                <!-- Preview -->
                <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                    class="flex items-center gap-2 px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition">

                    <span class="material-icons text-[18px]">preview</span>
                    Preview
                </a>

                <!-- Download (PRIMARY) -->
                <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-sm">

                    <span class="material-icons text-[18px]">download</span>
                    Download
                </a>

            </div>

        </div>

    </div>
@endsection

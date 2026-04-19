@extends('dosen.layouts.app')

@section('content')
    <div class="p-6 max-w-xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-lg font-semibold text-gray-800">
                    {{ $document->title }}
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $document->user->name }} • {{ $document->category->name }}
                </p>
            </div>

            <a href="{{ route('dosen.katalog.global') }}" class="text-sm text-gray-500 hover:text-gray-700">
                ← Back
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white border rounded-xl divide-y">

            <!-- Info -->
            <div class="p-4 space-y-2">

                <div>
                    <p class="text-xs text-gray-500">Uploader</p>
                    <p class="text-gray-800">{{ $document->user->name }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500">Category</p>
                    <p class="text-gray-700">{{ $document->category->name }}</p>
                </div>

            </div>

            <!-- Actions -->
            <div class="p-4 flex gap-4">

                <!-- Preview -->
                <a href="{{ route('dosen.documents.preview', $document->id) }}" target="_blank"
                    class="flex items-center gap-2 px-3 py-2 text-sm border rounded-lg hover:bg-gray-50">

                    <span class="material-icons text-[18px]">preview</span>
                    Preview
                </a>

                <!-- Download -->
                <a href="{{ route('dosen.documents.download', $document->id) }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                    <span class="material-icons text-[18px]">download</span>
                    Download
                </a>

            </div>

        </div>

    </div>
@endsection

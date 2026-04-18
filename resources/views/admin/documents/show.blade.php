@extends('admin.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')
    <div class="p-6 max-w-2xl space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-lg font-semibold text-gray-800">Document Detail</h1>
                <p class="text-sm text-gray-500">Information about this document</p>
            </div>

            <a href="{{ route('admin.documents.edit', $document->id) }}"
                class="px-3 py-2 text-sm border rounded-lg hover:bg-gray-50">
                Edit
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white border rounded-xl divide-y">

            <div class="p-4">
                <p class="text-xs text-gray-500">Title</p>
                <p class="text-sm font-medium text-gray-800">{{ $document->title }}</p>
            </div>

            <div class="p-4">
                <p class="text-xs text-gray-500">User</p>
                <p class="text-sm text-gray-700">{{ $document->user->name }}</p>
            </div>

            <div class="p-4">
                <p class="text-xs text-gray-500">Category</p>
                <p class="text-sm text-gray-700">{{ $document->category->name }}</p>
            </div>

            <div class="p-4">
                <p class="text-xs text-gray-500">Status</p>

                <span
                    class="inline-flex mt-1 px-2.5 py-1 text-xs rounded-full border
                {{ $document->status === 'approved'
                    ? 'bg-green-50 text-green-700 border-green-200'
                    : ($document->status === 'pending'
                        ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                        : 'bg-red-50 text-red-700 border-red-200') }}">
                    {{ ucfirst($document->status) }}
                </span>
            </div>

            <!-- Actions -->
            <div class="p-4 flex gap-4 text-sm text-gray-600">
                <a href="{{ route('admin.documents.preview', $document->id) }}" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-1 hover:text-blue-600">
                    <span class="material-icons text-[18px]">visibility</span>
                    Preview
                </a>

                <a href="{{ route('admin.documents.download', $document->id) }}"
                    class="flex items-center gap-1 hover:text-gray-800">
                    <span class="material-icons text-[18px]">download</span>
                    Download
                </a>
            </div>

        </div>
    </div>
@endsection

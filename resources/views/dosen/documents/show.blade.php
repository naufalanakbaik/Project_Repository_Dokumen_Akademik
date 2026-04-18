@extends('dosen.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')
    <div class="p-6 max-w-xl mx-auto">
        <div class="bg-white border rounded-xl divide-y">
            <div class="p-4">
                <p class="text-xs text-gray-500">Title</p>
                <p class="text-gray-800 font-medium">{{ $document->title }}</p>
            </div>

            <div class="p-4">
                <p class="text-xs text-gray-500">Category</p>
                <p class="text-gray-700">{{ $document->category->name }}</p>
            </div>

            <div class="p-4">
                <p class="text-xs text-gray-500">Status</p>
                <span
                    class="inline-flex px-2 py-1 text-xs rounded-full border
                {{ $document->status === 'approved'
                    ? 'bg-green-50 text-green-700 border-green-200'
                    : ($document->status === 'pending'
                        ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                        : 'bg-red-50 text-red-700 border-red-200') }}">
                    {{ ucfirst($document->status) }}
                </span>
            </div>

            <div class="p-4 flex gap-4">
                <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                    class="text-blue-600 hover:underline">
                    Preview
                </a>

                <a href="{{ route('mahasiswa.documents.download', $document->id) }}" class="text-gray-700 hover:underline">
                    Download
                </a>
            </div>
        </div>
    </div>
@endsection

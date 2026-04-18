@extends('admin.layouts.app')
@section('title', 'Tambah Dokumen')

@section('content')
<div class="p-6 max-w-2xl space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-lg font-semibold text-gray-800">Upload Document</h1>
        <p class="text-sm text-gray-500">Add a new document to the system</p>
    </div>

    <!-- Card -->
    <div class="bg-white border border-gray-200 rounded-xl p-5">

        <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label class="text-xs text-gray-500">Title</label>
                <input type="text" name="title"
                    value="{{ old('title') }}"
                    class="mt-1 w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400">
            </div>

            <!-- Category -->
            <div>
                <label class="text-xs text-gray-500">Category</label>
                <select name="category_id"
                    class="mt-1 w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-100">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- User -->
            <div>
                <label class="text-xs text-gray-500">User</label>
                <select name="user_id"
                    class="mt-1 w-full px-3 py-2 text-sm border rounded-lg">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- File Upload -->
            <div>
                <label class="text-xs text-gray-500">File</label>

                <div class="mt-1 border border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition cursor-pointer">
                    <input type="file" name="file" class="hidden" id="fileInput">
                    
                    <label for="fileInput" class="cursor-pointer flex flex-col items-center gap-2 text-gray-500 text-sm">
                        <span class="material-icons text-gray-400">upload_file</span>
                        <span>Click to upload file</span>
                        <span class="text-xs text-gray-400">PDF, DOC, DOCX (max 10MB)</span>
                    </label>
                </div>
            </div>

            <!-- Action -->
            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('admin.documents.index') }}"
                   class="px-4 py-2 text-sm border rounded-lg hover:bg-gray-50">
                    Cancel
                </a>

                <button class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Save Document
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
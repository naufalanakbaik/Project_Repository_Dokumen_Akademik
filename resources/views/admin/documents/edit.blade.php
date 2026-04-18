@extends('admin.layouts.app')
@section('title', 'Ubah Dokumen')

@section('content')
<div class="p-6 max-w-2xl space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-lg font-semibold text-gray-800">Edit Document</h1>
        <p class="text-sm text-gray-500">Update document information</p>
    </div>

    <div class="bg-white border rounded-xl p-5">

        <form method="POST"
            action="{{ route('admin.documents.update', $document->id) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="text-xs text-gray-500">Title</label>
                <input type="text" name="title"
                    value="{{ old('title', $document->title) }}"
                    class="mt-1 w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-100">
            </div>

            <!-- Category -->
            <div>
                <label class="text-xs text-gray-500">Category</label>
                <select name="category_id"
                    class="mt-1 w-full px-3 py-2 text-sm border rounded-lg">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ $document->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- User -->
            <div>
                <label class="text-xs text-gray-500">User</label>
                <select name="user_id"
                    class="mt-1 w-full px-3 py-2 text-sm border rounded-lg">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ $document->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Replace File -->
            <div>
                <label class="text-xs text-gray-500">Replace File (optional)</label>
                <input type="file" name="file" class="mt-1 text-sm">
            </div>

            <!-- Action -->
            <div class="flex justify-between items-center pt-3">

                <!-- Delete -->
                <form method="POST"
                      action="{{ route('admin.documents.destroy', $document->id) }}"
                      onsubmit="return confirm('Hapus dokumen ini?')">
                    @csrf
                    @method('DELETE')

                    <button class="text-sm text-red-600 hover:underline">
                        Delete
                    </button>
                </form>

                <div class="flex gap-2">
                    <a href="{{ route('admin.documents.index') }}"
                       class="px-4 py-2 text-sm border rounded-lg hover:bg-gray-50">
                        Cancel
                    </a>

                    <button class="px-4 py-2 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Update
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>
@endsection
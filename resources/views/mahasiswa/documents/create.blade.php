@extends('mahasiswa.layouts.app')
@section('title', 'Tambah Dokumen')

@section('content')

    <div class="p-6 max-w-xl mx-auto space-y-6">

        <h1 class="text-lg font-semibold">Upload Document</h1>

        <div class="bg-white border rounded-xl p-5">

            <form method="POST" action="{{ route('mahasiswa.documents.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <input name="title" placeholder="Title" class="w-full px-3 py-2 border rounded-lg text-sm">

                <select name="category_id" class="w-full px-3 py-2 border rounded-lg text-sm">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <input type="file" name="file" class="text-sm">

                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Upload
                </button>
            </form>

        </div>
    </div>

@endsection

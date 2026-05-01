@extends('mahasiswa.layouts.app')
@section('title', 'Edit Dokumen')

@section('content')

    <div class="w-full space-y-3">

        {{-- Header --}}
        <div class="flex items-start justify-between pb-2">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Edit Dokumen
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui dokumen dan lakukan perbaikan jika diperlukan
                </p>
            </div>

            <a href="{{ route('mahasiswa.documents.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-0.5">
                Back
                <span class="material-icons !text-[18px]">low_priority</span>
            </a>
        </div>

        {{-- Status Info --}}
        <div
            class="px-4 py-3 rounded-lg border text-sm
            {{ $document->status === 'rejected'
            ? 'bg-red-50 border-red-300 text-red-700'
            : 'bg-yellow-50 border-yellow-300 text-yellow-700' }}">

            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined !text-[18px]">
                    {{ $document->status === 'rejected' ? 'cancel' : 'schedule' }}
                </span>

                <div>
                    <p class="font-medium">
                        Status: {{ ucfirst($document->status) }}
                    </p>

                    @if ($document->status === 'rejected')
                        <p class="text-xs mt-1">
                            {{ $document->reject_note }}
                        </p>
                    @else
                        <p class="text-xs mt-1">
                            Dokumen akan divalidasi ulang setelah diperbarui
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">

            {{-- Form --}}
            <div class="col-span-12 lg:col-span-8">
                <div class="bg-white border border-gray-300 rounded-lg shadow-sm px-8">
                    <form method="POST" action="{{ route('mahasiswa.documents.update', $document->id) }}"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-700">
                                Judul Dokumen
                            </label>
                            <input type="text" name="title" value="{{ old('title', $document->title) }}"
                                class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg
                            focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                            @error('title')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-700">
                                Kategori
                            </label>

                            <select name="category_id"
                                class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg
                            focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $cat->id == old('category_id', $document->category_id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- File --}}
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-700">
                                File Dokumen
                            </label>

                            {{-- File lama --}}
                            <div class="text-xs text-gray-500">
                                File saat ini:
                                <span class="font-medium text-gray-700">
                                    {{ basename($document->file) }}
                                </span>
                            </div>

                            {{-- Upload baru --}}
                            <label
                                class="group flex flex-col items-center justify-center w-full px-4 py-8 border-2 border-dashed
                            border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50/40 transition text-center">

                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:text-blue-500 mb-2 !text-[28px]">
                                    upload_file
                                </span>

                                <span class="text-sm text-gray-600">
                                    Ganti file (opsional)
                                </span>

                                <span class="text-xs text-gray-400 mt-1">
                                    PDF, DOC, DOCX • Maks 10MB
                                </span>

                                <span id="file-name" class="text-xs text-blue-600 mt-3 hidden font-medium"></span>

                                <input type="file" name="file" id="file-input" class="hidden">
                            </label>
                        </div>

                        {{-- Button --}}
                        <div class="flex justify-end pt-5 border-t pb-4">
                            <button type="submit"
                                class="flex items-center gap-2 px-5 py-2.5 text-sm font-medium bg-blue-50 text-blue-600 rounded-lg
                            border border-blue-300 hover:bg-blue-100 transition">
                                <span class="material-symbols-outlined !text-[17px]">
                                    save
                                </span>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            {{-- Info --}}
            <div class="col-span-12 lg:col-span-4">
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-5 text-xs text-gray-600 space-y-3">
                    <p>• Perubahan akan mengembalikan status ke <b>pending</b></p>
                    <p>• Pastikan dokumen sudah diperbaiki sesuai catatan</p>
                    <p>• File baru tidak wajib diupload</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Script input file --}}
    <script>
        const fileInput = document.getElementById('file-input');
        const fileName = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileName.classList.remove('hidden');
            }
        });
    </script>

@endsection

@extends('mahasiswa.layouts.app')
@section('title', 'Edit Dokumen')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">
                    Perbarui Data Dokumen 
                </h1>
                <p class="text-sm text-gray-500">
                    Perbarui informasi dokumen Anda dengan detail yang benar
                </p>
            </div>

            <a href="{{ route('mahasiswa.documents.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-0.5">
                Back
                <span class="material-symbols-outlined !text-[18px]">low_priority</span>
            </a>
        </div>

        {{-- Status badge --}}
        <div
            class=" border rounded-lg shadow-sm p-4 flex items-start gap-4 text-sm
                {{ $document->status === 'rejected'
                    ? 'bg-red-50 border-red-200 text-red-600'
                    : 'bg-yellow-50 border-yellow-200 text-yellow-600' }}">

            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined !text-[20px]">
                    {{ $document->status === 'rejected' ? 'cancel' : 'schedule' }}
                </span>
                <div>
                    <p class="font-medium">
                        Status: {{ ucfirst($document->status) }}
                    </p>
                    @if ($document->status === 'rejected')
                        <p class="text-xs font-medium mt-1">
                            Note: {{ $document->reject_note }}
                        </p>
                    @else
                        <p class="text-xs font-medium mt-1">
                            Dokumen akan divalidasi ulang setelah diperbarui
                        </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Info card --}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-4 flex items-start gap-4">

            <span class="material-symbols-outlined text-blue-600 !text-[20px]">info</span>

            <div class="text-sm text-gray-600 font-medium leading-relaxed">
                Pastikan data yang Anda ubah sudah benar. Mengganti file akan otomatis memperbarui dokumen yang tersimpan.
                <div class="mt-1 text-xs font-medium text-gray-400">
                    Terakhir diperbarui:
                    {{ $document->updated_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>

        {{-- Form edit data dokumen --}}
        <form method="POST" action="{{ route('mahasiswa.documents.update', $document->id) }}" enctype="multipart/form-data"
            class="bg-white border border-gray-300 rounded-lg shadow-sm">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">

                {{-- Title --}}
                <div class="space-y-1">
                    <label class="text-[13px] font-medium text-gray-600">
                        Judul Dokumen
                    </label>

                    <input type="text" name="title" value="{{ old('title', $document->title) }}"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md text-gray-700
                        focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                    <p class="text-[11px] text-gray-500">
                        *Gunakan judul yang jelas dan deskriptif
                    </p>

                    @error('title')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun Terbit --}}
                <div class="space-y-1">
                    <label class="text-[13px] font-medium text-gray-600">
                        Tahun Terbit
                    </label>

                    <input type="text" name="tahun_terbit" value="{{ old('tahun_terbit', $document->tahun_terbit) }}"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md text-gray-700
                        focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                    <p class="text-[11px] text-gray-500">
                        *Gunakan tahun yang jelas dan valid
                    </p>

                    @error('tahun_terbit')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="space-y-1">
                    <label class="text-[13px] font-medium text-gray-600">
                        Kategori
                    </label>

                    <div class="relative">

                        <select name="category_id"
                            class="appearance-none w-full px-3 py-2 text-sm border border-gray-300 rounded-md text-gray-700
                            focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        {{-- Custom Arrow --}}
                        <span
                            class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[19px] text-gray-400 pointer-events-none">
                            arrow_drop_down
                        </span>

                    </div>

                    <p class="text-[11px] text-gray-500">
                        *Pilih kategori yang sesuai dengan dokumen
                    </p>

                    @error('category_id')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input file / upload file--}}
                <div class="space-y-1">
                    {{-- Label --}}
                    <label class="text-[13px] font-medium text-gray-600">
                        File Dokumen
                    </label>

                    <x-upload-dropzone 
                    name="file" 
                    label="Upload Dokumen Baru" 
                    hint="Seret file atau klik untuk memilih"
                    note="*Kosongkan jika tidak ingin mengganti file" 
                    accept=".pdf,.doc,.docx" 
                    :currentFile="$document->file" />
                </div>
                
                {{-- Checkbox confirm --}}
                <div class="flex items-start gap-3">
                    <div class="flex items-center h-5">
                        <input id="confirm" type="checkbox"
                            class="w-4 h-4 rounded border-gray-300 text-blue-600
                            focus:ring-1 focus:ring-blue-500 focus:ring-offset-0 cursor-pointer">
                    </div>
                    <label for="confirm" class="text-[13px] text-gray-600 leading-relaxed cursor-pointer">
                        Saya memastikan bahwa dokumen ini sudah benar dan siap digunakan
                    </label>
                </div>

                {{-- Action buttons --}}
                <div class="flex items-center justify-between px-2 py-2 pt-5 border-t border-gray-300">
                    <a href="{{ route('mahasiswa.documents.index') }}" class="text-sm text-gray-600 hover:text-gray-800">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-1 px-3.5 py-2 text-[13px] text-blue-700 font-medium bg-blue-100 border 
                        border-blue-400 rounded-lg hover:bg-blue-200 transition">
                        <span class="material-symbols-outlined !text-[17px]">
                            forward
                        </span>
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>

    </div>

@endsection

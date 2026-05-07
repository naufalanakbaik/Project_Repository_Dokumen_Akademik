@extends('admin.layouts.app')
@section('title', 'Ubah Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
        <div>
            <h1 class="text-xl font-semibold text-gray-900 leading-tight">
                Edit Dokumen
            </h1>
            <p class="text-xs text-gray-600 mt-0.5">
                Perbarui informasi dokumen dengan benar dan konsisten
            </p>
        </div>

        <a href="{{ route('admin.documents.index') }}"
            class="inline-flex items-center text-gray-800 text-sm font-normal px-2 py-1 hover:text-blue-700 transition">
            <span
                class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-600  
                    bg-blue-600 hover:bg-white hover:text-blue-600 !text-[18px] transition">
                east
            </span>
        </a>
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-12 gap-6">

        {{-- Right Content Form Edit --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white border border-gray-300 rounded-lg px-7 py-2 shadow-sm">

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm p-3 rounded-lg">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.documents.update', $document->id) }}"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-gray-700">
                            Judul Dokumen
                        </label>
                        <input type="text" name="title" value="{{ old('title', $document->title) }}"
                            placeholder="Contoh: Laporan Kerja Praktik Sistem Informasi"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-white
                            focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition
                            @error('title') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">

                        <!-- Helper -->
                        <p class="text-[11px] text-gray-400">
                            Gunakan judul yang jelas dan sesuai dengan isi dokumen
                        </p>

                        <!-- Error -->
                        @error('title')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun Terbit -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-gray-700">
                            Tahun Terbit
                        </label>
                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $document->tahun_terbit) }}"
                            placeholder="Contoh: 2023"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-white
                            focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition
                            @error('tahun_terbit') border-red-300 focus:border-red-400 focus:ring-red-100 @enderror">

                        <!-- Helper -->
                        <p class="text-[11px] text-gray-400">
                            Gunakan tahun terbit yang sesuai dengan dokumen
                        </p>

                        <!-- Error -->
                        @error('tahun_terbit')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-gray-600">
                            Kategori
                        </label>
                        <div class="relative">
                            <select name="category_id"
                                class="w-full px-3 py-2 pr-10 text-sm border border-gray-300 rounded-lg bg-white
                                appearance-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', $document->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span
                                class="pointer-events-none absolute inset-y-0 top-0.5 right-3 flex items-center text-gray-400">
                                <span class="material-symbols-outlined !text-[18px] leading-none">
                                    expand_more
                                </span>
                            </span>
                        </div>
                        <p class="text-[11px] text-gray-400">
                            Pilih kategori yang sesuai dengan isi dokumen
                        </p>
                        @error('category_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File -->
                    <div class="space-y-2">
                        <label class="text-xs font-medium text-gray-700">
                            Ganti File <span class="text-gray-400">(Opsional)</span>
                        </label>

                        <!-- Current File -->
                        <div
                            class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700 truncate">
                                <span class="material-symbols-outlined !text-[18px] text-gray-400">
                                    description
                                </span>
                                <span class="truncate">
                                    {{ basename($document->file) }}
                                </span>
                            </div>
                            <a href="{{ Storage::url($document->file) }}" target="_blank"
                                class="flex items-center gap-1 text-blue-600 hover:text-blue-700 text-xs">
                                Lihat
                                <span class="material-symbols-outlined !text-[16px]">
                                    open_in_new
                                </span>
                            </a>
                        </div>

                        <!-- Upload -->
                        <label
                            class="flex flex-col items-center justify-center w-full px-4 py-5 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition text-center">
                            <span class="material-symbols-outlined text-gray-400 mb-1">
                                upload_file
                            </span>
                            <span class="text-xs text-gray-600">
                                Klik untuk upload file baru
                            </span>
                            <span class="text-[11px] text-gray-400 mt-1">
                                PDF, DOC, DOCX • Maks 10MB
                            </span>

                            <!-- Preview nama file -->
                            <span id="file-name" class="text-xs text-blue-600 mt-2 hidden"></span>
                            <input type="file" name="file" id="file-input" class="hidden">
                        </label>
                        @error('file')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Js script input file -->
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

                    {{-- Button --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-400 pb-3">
                        <a href="{{ route('admin.documents.index') }}"
                            class="px-5 py-2.5 text-[13px] font-medium text-gray-700 bg-gray-50 border border-gray-400 rounded-lg hover:bg-gray-100 transition shadow-sm">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-5 py-2.5 text-[13px] font-medium text-blue-800 border border-blue-400 bg-blue-100 rounded-lg hover:bg-blue-200 transition shadow-sm">
                            <span class="material-icons !text-[16px]">send</span>
                            Perbarui Dokumen
                        </button>
                    </div>

                </form>

            </div>

        </div>

        {{-- Left information --}}
        <div class="col-span-12 lg:col-span-4 space-y-4">

            {{-- Informasi Dokumen --}}
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-5">
                <h2 class="text-sm font-semibold text-gray-800 mb-4">
                    Informasi Dokumen
                </h2>
                <div class="space-y-4 text-sm">
                    <!-- Status -->
                    <div class="flex items-center justify-between">
                        <p class="text-xs text-gray-500">Status</p>
                        <span
                            class="px-3 py-0.5 text-[10px] rounded-full border font-medium uppercase
                            {{ $document->status === 'approved'
                                ? 'bg-green-50 text-green-700 border-green-300'
                                : ($document->status === 'pending'
                                    ? 'bg-yellow-50 text-yellow-700 border-yellow-300'
                                    : 'bg-red-50 text-red-700 border-red-300') }}">
                            {{ $document->status }}
                        </span>
                    </div>
                    <!-- Tanggal -->
                    <div class="flex items-center justify-between">
                        <p class="text-xs text-gray-500">Tanggal Upload</p>
                        <p class="text-sm text-gray-800">
                            {{ $document->created_at->translatedFormat('l, d M Y') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Panduan --}}
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-5">
                <h2 class="text-sm font-semibold text-gray-800">
                    Panduan
                </h2>
                <p class="text-xs text-gray-600 leading-relaxed mt-0.5">
                    Perbarui informasi dokumen dengan benar agar data tetap konsisten dan mudah dikelola.
                </p>
                <!-- List -->
                <div class="space-y-2 text-xs text-gray-700 mt-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px] leading-none">
                            check_circle
                        </span>
                        <p>Sesuaikan judul dengan isi dokumen</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px] leading-none">
                            check_circle
                        </span>
                        <p>Pilih kategori yang tepat</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px] leading-none">
                            check_circle
                        </span>
                        <p>Upload ulang file jika ada revisi</p>
                    </div>
                </div>

                <!-- Warning -->
                <div
                    class="flex items-start gap-2 text-xs text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-md px-3 py-2 mt-4">
                    <span class="material-symbols-outlined text-yellow-500 !text-[18px] leading-none mt-0.5">
                        warning
                    </span>
                    <p>
                        File lama akan diganti secara permanen.
                    </p>
                </div>
            </div>
        </div>

    </div>

@endsection

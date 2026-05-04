@extends('dosen.layouts.app')
@section('title', 'Unggah Dokumen Baru')

@section('content')
    <div class="max-w-full mx-auto space-y-3">

        {{-- Header --}}
        <div class="flex items-start justify-between pb-2">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">
                    Upload Dokumen
                </h1>
                <p class="text-sm text-gray-500 mt-0.5">
                    Unggah dokumen akademik dengan informasi yang jelas dan terstruktur
                </p>
            </div>

            <a href="{{ route('dosen.documents.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-0.5">
                Back
                <span class="material-icons !text-[18px]">low_priority</span>
            </a>
        </div>

        {{-- Tanggal dan Waktu --}}
        @php
            \Carbon\Carbon::setLocale('id');
            $today = \Carbon\Carbon::now();
        @endphp

        <div
            class="flex items-center justify-between bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400 !text-[18px]">
                    calendar_today
                </span>

                <span>
                    {{ $today->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>

        {{-- Main content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg">

                <div class="px-6 py-3 border-b border-gray-200">
                    <h3 class="text-sm font-medium text-gray-800">
                        Tambah Dokumen
                    </h3>
                </div>

                {{-- Form tambah dokumen --}}
                <form action="{{ route('dosen.documents.store') }}" method="POST" enctype="multipart/form-data"
                    class="py-1 px-6 space-y-5">
                    @csrf

                    {{-- Title --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-600">
                            Judul
                        </label>

                        <input type="text" name="title" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md
                            focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                        <p class="text-xs text-gray-500">
                            Gunakan judul yang jelas dan deskriptif agar mudah dicari.
                        </p>

                        @error('title')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-600">
                            Kategori
                        </label>

                        <div class="relative">
                            <select name="category_id" required
                                class="appearance-none w-full px-3 pr-8 py-2 text-sm border border-gray-300 rounded-md text-gray-600
                                focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 bg-white">

                                <option value="" disabled selected>Pilih kategori</option>

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            <span
                                class="material-icons absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px] pointer-events-none">
                                arrow_drop_down
                            </span>
                        </div>

                        <p class="text-xs text-gray-500">
                            Pilih kategori yang paling sesuai dengan isi dokumen.
                        </p>

                        @error('category_id')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input File --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-600">
                            File
                        </label>

                        <div id="upload-box"
                            class="relative flex flex-col items-center justify-center text-center px-6 py-6
                            border border-gray-300 rounded-md bg-gray-50
                            hover:bg-gray-100 transition cursor-pointer">

                            {{-- Icon --}}
                            <span id="upload-icon" class="material-icons text-gray-400 !text-[28px] mb-1">
                                upload_file
                            </span>

                            {{-- Text --}}
                            <p id="upload-text" class="text-sm text-gray-600">
                                Klik atau drag file ke sini
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                PDF, DOC, DOCX (maks 10MB)
                            </p>

                            {{-- Input --}}
                            <input id="file-upload" name="file" type="file"
                                class="absolute inset-0 opacity-0 cursor-pointer" required>

                            {{-- Preview --}}
                            <div id="file-preview"
                                class="hidden mt-3 px-3 py-1.5 bg-gray-100 text-gray-700 rounded text-xs font-medium">
                            </div>
                        </div>

                        <p class="text-xs text-gray-500">
                            Pastikan file sudah final dan tidak mengandung kesalahan.
                        </p>

                        @error('file')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-4 border-t border-gray-300 pb-3">
                        <a href="{{ route('dosen.documents.index') }}" class="text-sm text-gray-600 hover:text-gray-800">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-1 px-4 py-2 text-[13px] text-blue-700 font-medium bg-blue-100 
                            border border-blue-400 rounded-lg hover:bg-blue-200 transition">
                            <span class="material-symbols-outlined !text-[17px]">
                                forward
                            </span>
                            Simpan Dokumen
                        </button>
                    </div>

                </form>

            </div>

            {{-- Side bar infromation scheme --}}
            <div class="space-y-4 text-sm">

                {{-- Panduan --}}
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h3 class="font-medium text-gray-800">
                            Panduan
                        </h3>
                    </div>
                    <div class="px-4 py-3 text-gray-600 space-y-2 leading-relaxed">
                        <p>Gunakan judul yang jelas dan spesifik</p>
                        <p>Pastikan dokumen merupakan versi final</p>
                        <p>Pilih kategori yang sesuai</p>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h3 class="font-medium text-gray-800">
                            Catatan
                        </h3>
                    </div>
                    <div class="px-4 py-3 text-gray-600 leading-relaxed">
                        Dokumen yang diunggah akan melalui proses validasi admin sebelum tersedia secara publik.
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Js input file -->
    <script>
        const fileInput = document.getElementById('file-upload');

        if (fileInput) {
            const preview = document.getElementById('file-preview');
            const icon = document.getElementById('upload-icon');
            const text = document.getElementById('upload-text');

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];

                    preview.textContent = file.name;
                    preview.classList.remove('hidden');

                    icon.textContent = 'check_circle';
                    icon.classList.remove('text-gray-400');
                    icon.classList.add('text-green-500');

                    text.textContent = "File siap diupload";
                }
            });
        }
    </script>

@endsection

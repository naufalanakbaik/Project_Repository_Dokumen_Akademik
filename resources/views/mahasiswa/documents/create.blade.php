@extends('mahasiswa.layouts.app')
@section('title', 'Tambah Dokumen')

@section('content')

    <div class="w-full space-y-3">

        {{-- Header --}}
        <div class="flex items-start justify-between pb-2">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Upload Dokumen
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Unggah dokumen akademik dengan informasi yang jelas dan terstruktur
                </p>
            </div>

            <a href="{{ route('mahasiswa.documents.index') }}"
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

        <div class="grid grid-cols-12 gap-6">

            {{-- Form tambah dokumen --}}
            <div class="col-span-12 lg:col-span-8">

                <div class="bg-white border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition px-8">

                    <form method="POST" action="{{ route('mahasiswa.documents.store') }}" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        {{-- Title --}}
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-700">
                                Judul Dokumen
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                placeholder="Contoh: Laporan Kerja Praktik Sistem Informasi"
                                class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg
                                    focus:ring-2 focus:ring-blue-100 focus:border-blue-500 focus:outline-none transition
                                    @error('title') border-red-300 @enderror">

                            @error('title')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-700">
                                Kategori
                            </label>

                            <div class="relative">
                                <select name="category_id"
                                    class="w-full appearance-none px-3 py-2.5 pr-10 text-sm border border-gray-300 rounded-lg
                                    focus:ring-2 focus:ring-blue-100 focus:border-blue-500 focus:outline-none transition">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Custom Arrow -->
                                <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 !text-[18px]">
                                        expand_more
                                    </span>
                                </span>
                            </div>
                        </div>

                        {{-- Input file --}}
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-700">
                                File Dokumen
                            </label>
                            <label
                                class="group flex flex-col items-center justify-center w-full px-4 py-8 border-2 border-dashed
                            border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50/40 transition text-center">
                                <span
                                    class="material-symbols-outlined text-gray-400 group-hover:text-blue-500 transition mb-2 !text-[28px]">
                                    upload_file
                                </span>
                                <span class="text-sm text-gray-600 group-hover:text-blue-600 transition">
                                    Klik untuk upload file
                                </span>
                                <span class="text-xs text-gray-400 mt-1">
                                    PDF, DOC, DOCX • Maks 10MB
                                </span>
                                <span id="file-name" class="text-xs text-blue-600 mt-3 hidden font-medium">
                                </span>
                                <input type="file" name="file" id="file-input" class="hidden">
                            </label>
                            @error('file')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Button --}}
                        <div class="flex justify-end pt-5 border-t pb-4">
                            <button type="submit"
                                class="flex items-center gap-2 px-5 py-2.5 text-sm font-medium bg-blue-50 text-blue-600 rounded-lg shadow-sm
                                border border-blue-300 hover:bg-blue-100 hover:shadow-md active:scale-[0.98] transition">
                                <span class="material-symbols-outlined !text-[17px]">
                                    upload
                                </span>
                                Upload Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Information --}}
            <div class="col-span-12 lg:col-span-4">
                <div
                    class="bg-gradient-to-br from-white to-gray-50 border border-gray-300 rounded-lg shadow-sm p-5 space-y-5">
                    <h2 class="text-sm font-semibold text-gray-800">
                        Panduan Upload
                    </h2>
                    <div class="space-y-3 text-xs text-gray-600">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-green-500 !text-[16px]">
                                check_circle
                            </span>
                            <p>Gunakan judul yang jelas dan relevan</p>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-green-500 !text-[16px]">
                                check_circle
                            </span>
                            <p>Pilih kategori sesuai jenis dokumen</p>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-green-500 !text-[16px]">
                                check_circle
                            </span>
                            <p>Pastikan file sudah final & siap diverifikasi</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 text-xs text-yellow-700 pt-4 border-t">
                        <span class="material-symbols-outlined text-yellow-500 !text-[16px]">
                            warning
                        </span>
                        <p>Dokumen akan diperiksa admin sebelum tersedia</p>
                    </div>
                </div>
            </div>

        </div>

    </div>


    {{-- Script Preview File --}}
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

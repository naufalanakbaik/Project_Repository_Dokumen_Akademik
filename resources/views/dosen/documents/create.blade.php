@extends('dosen.layouts.app')
@section('title', 'Unggah Dokumen Baru')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

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

            <a href="{{ route('dosen.documents.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-0.5">
                Back
                <span class="material-icons !text-[18px]">low_priority</span>
            </a>
        </div>

        <!-- Main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Form tambah dokumen -->
            <div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-sm">

                <form action="{{ route('dosen.documents.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6 space-y-7">
                    @csrf

                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wide">
                            Informasi Dokumen
                        </h3>

                        <!-- Title -->
                        <div>
                            <input type="text" name="title" required placeholder="Judul dokumen..."
                                class="w-full px-4 h-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">

                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="relative">
                            <select name="category_id" required
                                class="w-full px-4 pr-10 h-12 border border-gray-200 rounded-xl appearance-none 
                            focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-white">

                                <option value="" disabled selected>Pilih kategori</option>

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                expand_more
                            </span>
                        </div>
                    </div>

                    <!-- Input file-->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wide">
                            Upload File
                        </h3>

                        <div id="upload-box"
                            class="relative flex flex-col items-center justify-center text-center px-6 py-10 
                        border-2 border-dashed border-gray-200 rounded-2xl bg-gradient-to-b from-gray-50 to-white
                        hover:border-blue-400 transition cursor-pointer">

                            <!-- Icon -->
                            <span id="upload-icon"
                                class="material-symbols-outlined text-gray-400 !text-[42px] mb-3 transition">
                                cloud_upload
                            </span>

                            <!-- Text -->
                            <p id="upload-text" class="text-sm text-gray-600">
                                Klik atau drag file ke sini
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                PDF, DOC, DOCX (maks 10MB)
                            </p>

                            <!-- Input -->
                            <input id="file-upload" name="file" type="file"
                                class="absolute inset-0 opacity-0 cursor-pointer" required>

                            <!-- File Preview -->
                            <div id="file-preview"
                                class="hidden mt-4 px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium">
                            </div>
                        </div>

                        @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between pt-5 border-t">

                        <a href="{{ route('dosen.documents.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                            Batal
                        </a>

                        <button type="submit"
                            class="flex items-center gap-2 px-6 h-12 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-md">

                            <span class="material-symbols-outlined !text-[18px]">
                                upload
                            </span>
                            Upload Sekarang
                        </button>

                    </div>

                </form>
            </div>

            <!-- Side bar infromation scheme -->
            <div class="space-y-5">

                <!-- Guidelines -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5">
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">
                        Panduan
                    </h3>

                    <ul class="space-y-2 text-xs text-gray-500">
                        <li>• Gunakan judul spesifik dan jelas</li>
                        <li>• Pastikan dokumen final (bukan draft)</li>
                        <li>• Gunakan kategori yang sesuai</li>
                    </ul>
                </div>

                <!-- Warning -->
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-amber-700 mb-2">
                        Perhatian
                    </h3>

                    <p class="text-xs text-amber-600">
                        Dokumen yang diunggah akan melalui proses validasi admin sebelum tersedia secara publik.
                    </p>
                </div>

            </div>

        </div>


    </div>

    <!-- Js input file -->
    <script>
        const fileInput = document.getElementById('file-upload');
        const preview = document.getElementById('file-preview');
        const icon = document.getElementById('upload-icon');
        const text = document.getElementById('upload-text');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];

                preview.textContent = file.name;
                preview.classList.remove('hidden');

                // visual feedback
                icon.textContent = 'check_circle';
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-green-500');

                text.textContent = "File siap diupload";
            }
        });
    </script>
@endsection

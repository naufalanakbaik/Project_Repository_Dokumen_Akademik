@extends('admin.layouts.app')
@section('title', 'Tambah Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Unggah dokumen baru
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Tambahkan dokumen baru ke dalam repository sistem.
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

    {{-- Container --}}
    <div class="space-y-6">
        {{-- Information --}}
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-blue-50 border border-blue-300 rounded-lg py-2.5 px-4">
                <div class="flex items-center gap-2 mb-1 text-blue-700">
                    <span class="material-icons !text-[16px]">info</span>
                    <h3 class="text-sm font-medium">Informasi tambahan</h3>
                </div>
                <ul class="text-xs text-blue-600 space-y-2 leading-relaxed">
                    <li>
                        • Pastikan menggunakan email yang aktif dan valid, karena email tersebut akan digunakan untuk proses
                        login serta menerima informasi penting dari sistem.
                    </li>
                </ul>
            </div>

            <div class="bg-gray-100 border border-gray-300 rounded-lg py-2.5 px-4">
                <div class="flex items-center gap-2 mb-1 text-gray-700">
                    <span class="material-icons !text-[16px]">sticky_note_2</span>
                    <h3 class="text-sm font-medium">Catatan sistem</h3>
                </div>
                <ul class="text-xs text-gray-600 space-y-2 leading-relaxed">
                    <li>
                        • Pengguna akan langsung aktif setelah dibuat dan dapat segera mengakses sistem serta meggunggah
                        dokumen sesuai dengan role yang dibuat.
                    </li>
                </ul>
            </div>
        </div>

        {{-- Form tambah pengguna --}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm py-2 px-4">

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="p-4 border-b border-red-200 bg-red-50 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-6">
                    {{-- Informasi dokumen --}}
                    <div class="space-y-4">
                        <h2 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <span class="material-icons !text-[18px] text-gray-500">description</span>
                            Informasi Dokumen
                        </h2>

                        <!-- Title -->
                        <div>
                            <label class="text-xs text-gray-500">Judul Dokumen</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="mt-1 w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg 
                                focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition"
                                placeholder="Contoh: Laporan Kerja Praktik">
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="text-xs text-gray-500">Kategori</label>
                            <select name="category_id"
                                class="mt-1 w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg 
                                focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- ===== OWNER (ADMIN ONLY) ===== -->
                    <div class="space-y-2">
                        <label class="text-xs text-gray-500">Diunggah oleh</label>

                        <div class="flex items-center gap-3 px-3 py-2.5 border border-gray-200 rounded-lg bg-gray-50">
                            <div
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 border border-blue-100">
                                <span class="material-icons !text-[18px]">person</span>
                            </div>

                            <div class="flex flex-col text-sm">
                                <span class="font-medium text-gray-800">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    Admin
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- ===== FILE UPLOAD ===== -->
                    <div class="space-y-4">
                        <h2 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <span class="material-icons !text-[18px] text-rose-500">upload_file</span>
                            Upload File
                        </h2>

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center 
                            hover:border-blue-400 hover:bg-blue-50/40 transition cursor-pointer group">

                            <input type="file" name="file" id="fileInput" class="hidden" accept=".pdf,.doc,.docx">

                            <label for="fileInput" class="cursor-pointer flex flex-col items-center gap-3">

                                <!-- ICON -->
                                <div
                                    class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-50 
                                    text-blue-600 border border-blue-100 group-hover:scale-105 transition">
                                    <span class="material-icons">upload</span>
                                </div>

                                <!-- TEXT -->
                                <div id="uploadText" class="text-sm text-gray-600">
                                    Klik untuk upload file
                                </div>

                                <!-- FILE INFO -->
                                <div id="fileInfo"
                                    class="hidden w-full px-3 py-2 rounded-lg border border-blue-200 
                                    bg-blue-50 text-left">

                                    <div class="flex items-center gap-2">
                                        <span class="material-icons text-blue-600 !text-[18px]">description</span>

                                        <div class="flex flex-col text-xs">
                                            <span id="fileName" class="font-medium text-gray-800"></span>
                                            <span id="fileSize" class="text-gray-500"></span>
                                        </div>
                                    </div>
                                </div>

                                <span class="text-xs text-gray-400">
                                    PDF, DOC, DOCX • Maks 10MB
                                </span>

                            </label>
                        </div>
                    </div>

                </div>

                <!-- ===== FOOTER ===== -->
                <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-gray-50">

                    <a href="{{ route('admin.documents.index') }}"
                        class="text-sm text-gray-600 hover:text-gray-900 transition">
                        Batal
                    </a>

                    <button
                        class="flex items-center gap-2 px-4 py-2 text-sm bg-blue-600 text-white rounded-lg 
                        hover:bg-blue-700 transition shadow-sm">
                        <span class="material-icons !text-[18px]">save</span>
                        Simpan Dokumen
                    </button>

                </div>

            </form>
        </div>

    </div>



    <!-- SCRIPT -->
    <script>
        const fileInput = document.getElementById('fileInput');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const uploadText = document.getElementById('uploadText');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];

                fileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';

                fileInfo.classList.remove('hidden');
                uploadText.textContent = 'File berhasil dipilih (klik untuk ganti)';
            }
        });
    </script>
@endsection

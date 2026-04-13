@extends('admin.layouts.app')
@section('title', 'Edit Kategori')

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Perbarui Data Kategori
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Perbarui kategori baru untuk mengunggah dokumen di sistem repository.
            </p>
        </div>
        <a href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center text-gray-800 text-sm font-normal px-2 py-1 hover:text-blue-700 transition">
            <span
                class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-600  
                    bg-blue-600 hover:bg-white hover:text-blue-600 !text-[18px] transition">
                east
            </span>
        </a>
    </div>


    {{-- Container utama --}}
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
                        • Pastikan data yang diperbarui sudah benar dan menggunakan email yang masih aktif, karena akan
                        digunakan untuk proses login serta menerima informasi dari sistem.
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
                        • Perubahan role akan mempengaruhi hak akses pengguna di sistem.
                    </li>
                    <li>
                        • Perubahan email atau password dapat mempengaruhi proses login pengguna.
                    </li>
                </ul>
            </div>
        </div>

        {{-- Form tambah pengguna --}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm py-2 px-7">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <div class="flex items-center gap-1.5 mb-3.5">
                        <span class="material-icons pb-0.5 text-gray-900 !text-[18px]">folder</span>
                        <h2 class="text-[15px] font-medium text-gray-900">
                            Perbarui Kategori
                        </h2>
                    </div>

                    <div class="space-y-4">
                        {{-- Nama --}}
                        <div>
                            <label class="text-[13px] text-gray-700 mb-1 block">Kategori</label>
                            <input type="text" name="name" value="{{ $category->name }}"
                                class="w-full px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 border-gray-400 focus:outline-none">
                        </div>
                    </div>
                </div>

                {{-- Button --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-300 pb-3">
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-5 py-2.5 text-[13px] font-medium text-gray-700 bg-gray-50 border border-gray-400 rounded-lg hover:bg-gray-100 transition shadow-sm">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 text-[13px] font-medium text-blue-800 border border-blue-400 bg-blue-100 rounded-lg hover:bg-blue-200 transition shadow-sm">
                        <span class="material-icons !text-[16px]">send</span>
                        Perbarui Kategori
                    </button>
                </div>

            </form>
        </div>

    </div>

@endsection

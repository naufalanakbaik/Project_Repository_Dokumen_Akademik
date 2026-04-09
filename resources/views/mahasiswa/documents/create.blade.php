@extends('mahasiswa.layouts.app')

@section('title', 'Unggah Dokumen Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-xl font-bold text-slate-800">Form Pengunggahan Dokumen</h3>
            <p class="text-sm text-slate-500">Silakan isi detail dokumen akademik yang akan diunggah.</p>
        </div>
        
        <form action="{{ route('mahasiswa.documents.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul Dokumen</label>
                <input type="text" name="title" required placeholder="Contoh: Jurnal Teknologi Informasi - Vol 1" 
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                <select name="category_id" required 
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih File (PDF/DOC/DOCX)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-lg hover:border-indigo-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-slate-600">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                <span>Upload a file</span>
                                <input id="file-upload" name="file" type="file" class="sr-only" required>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-slate-500">PDF, DOC, DOCX up to 10MB</p>
                    </div>
                </div>
                @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-50">
                <a href="{{ route('mahasiswa.documents.index') }}" class="px-4 py-2 text-slate-600 font-medium hover:text-slate-800 transition-colors">Batal</a>
                <button type="submit" class="px-8 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-bold shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5">
                    Unggah Dokumen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

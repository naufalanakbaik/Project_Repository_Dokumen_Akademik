@extends('admin.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
        <div>
            <h1 class="text-xl font-semibold text-gray-800 leading-tight">
                {{ $document->title }}
            </h1>
            <p class="text-xs text-gray-600 mt-0.5">
                Detail informasi dokumen dan preview file
            </p>
        </div>

        <a href="{{ route('admin.documents.index') }}"
            class="inline-flex items-center text-gray-800 text-sm font-normal px-2 py-1 hover:text-blue-700 transition-all duration-300">
            <span
                class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-600  
                    bg-blue-600 hover:bg-white hover:text-blue-600 !text-[18px] transition-all duration-300">
                east
            </span>
        </a>
    </div>

    {{-- Information content bar --}}
    <div class="bg-blue-50 border border-blue-300 rounded-lg p-4 flex items-start gap-3 mb-6">
        <span class="material-symbols-outlined text-blue-700 !text-[20px] mt-0.5">info</span>
        <div class="text-blue-700 leading-relaxed">
            <p class="text-[15px] font-semibold">Informasi Dokumen</p>

            <p class="text-sm text-blue-700">
                Dokumen ini diunggah oleh
                <span class="font-medium">{{ $document->user->name }}</span>
                dalam kategori
                <span class="font-medium">{{ $document->category->name }}</span>.
            </p>

            <p class="text-sm text-blue-700">
                Status saat ini adalah
                <span class="font-semibold capitalize">
                    {{ $document->status }}
                </span>.
                @if ($document->status === 'pending')
                    Silakan lakukan pengecekan melalui preview sebelum menyetujui atau menolak dokumen.
                @elseif($document->status === 'approved')
                    Dokumen ini sudah disetujui dan tersedia untuk diakses oleh pengguna.
                @else
                    Dokumen ini telah ditolak. Pastikan alasan penolakan sudah sesuai.
                @endif
            </p>

            <p class="mt-2 text-blue-700 text-[14px]">
                Gunakan panel aksi di sebelah kanan untuk mengedit, mengunduh, atau menghapus dokumen.
            </p>
        </div>
    </div>

    @php
        $fileUrl = Storage::url($document->file);
        $extension = strtolower(pathinfo($document->file, PATHINFO_EXTENSION));
    @endphp

    {{-- Main Content --}}
    <div class="grid grid-cols-12 gap-6">

        {{-- Left content (Preview) --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden flex flex-col">

                {{-- Header --}}
                <div class="px-5 py-4 border-b bg-gray-50 flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-800">
                        Preview Dokumen
                    </span>

                    <a href="{{ route('admin.documents.preview', $document->id) }}" target="_blank"
                        class="text-xs text-blue-600 hover:underline">
                        Buka di tab baru
                    </a>
                </div>

                {{-- Preview file --}}
                <div class="bg-gray-100">
                    @if ($extension === 'pdf')
                        <iframe src="{{ $fileUrl }}" class="w-full h-[680px]" loading="lazy">
                        </iframe>
                    @else
                        <div class="flex flex-col items-center justify-center h-[680px] text-gray-600">
                            <span class="material-symbols-outlined text-4xl mb-2">insert_drive_file</span>
                            <p class="text-sm">Preview tidak tersedia</p>
                            <a href="{{ $fileUrl }}" target="_blank"
                                class="mt-2 text-sm text-blue-600 hover:underline">
                                Buka file
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between px-5 py-3 border-t bg-gray-50 text-xs text-gray-500">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined !text-[16px]">insert_drive_file</span>
                        {{ basename($document->file) }}
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="uppercase">{{ $extension }}</span>
                        <span>{{ $document->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right content information & actions buttons --}}
        <div class="col-span-12 lg:col-span-4 space-y-5">

            {{-- Data documents --}}
            <div class="bg-white border border-gray-300 rounded-lg">
                <div class="px-5 py-4 border-b bg-gray-50 text-sm rounded-t-lg font-medium text-gray-800">
                    Informasi Dokumen
                </div>

                <div class="divide-y text-sm">
                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Pengunggah</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->user->name }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Tahun Terbit</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->tahun_terbit }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Kategori</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->category->name }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Tanggal Upload</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Jumlah Download</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->downloads_count ?? 0 }} kali diunduh
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">
                            @if ($document->status === 'pending')
                                <span class="text-xs text-yellow-700">Butuh review</span>
                            @elseif($document->status === 'approved')
                                <span class="text-xs text-green-700">Sudah publik</span>
                            @else
                                <span class="text-xs text-red-700">Ditolak</span>
                            @endif
                        </span>
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full border text-[11px] font-medium
                            {{ $document->status === 'approved'
                                ? 'bg-emerald-50 text-emerald-700 border-emerald-300'
                                : 'bg-red-50 text-red-600 border-red-300' }}">

                            <span class="material-symbols-outlined !text-[12px]">
                                {{ $document->status === 'approved' ? 'check_circle' : 'cancel' }}
                            </span>
                            {{ ucfirst($document->status) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Action card --}}
            <div class="sticky top-6">
                <div class="overflow-hidden bg-white border border-gray-300 rounded-lg shadow-sm">
                    {{-- Header --}}
                    <div class="flex px-5 py-4 border-b bg-gray-50 text-gray-800">
                        <h3 class="text-sm font-medium">
                            Aksi Cepat
                        </h3>
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <div class="space-y-3">
                            <a href="{{ route('admin.documents.download', $document->id) }}"
                                class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                                border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                                <span class="material-symbols-outlined !text-[16px]">download</span>
                                Download
                            </a>

                            <a href="{{ route('admin.documents.preview', $document->id) }}" target="_blank"
                                class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                                border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                                <span class="material-symbols-outlined !text-[16px]">open_in_new</span>
                                Buka di Tab Baru
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('admin.documents.edit', $document->id) }}" target="_blank"
                                class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                                border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                                <span class="material-symbols-outlined !text-[16px]">edit</span>
                                Edit Dokumen
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                                    bg-red-50 border border-red-300 text-red-700 rounded-md hover:bg-red-100 transition">
                                    <span class="material-symbols-outlined !text-[16px]"> delete</span>
                                    Hapus Dokumen
                                </button>
                            </form>
                        </div>

                        {{-- Information Note --}}
                        <div class="mt-5 flex items-start gap-3">
                            <span class="material-symbols-outlined !text-[17px] text-gray-700 mt-0.5 shrink-0">
                                info
                            </span>
                            <div>
                                <p class="text-[11.5px] font-medium text-gray-700">
                                    Informasi
                                </p>
                                <p class="text-[11px] leading-relaxed text-gray-500 mt-0.5">
                                    Pastikan dokumen telah diperiksa baik dan benar agar tidak terjadi masalah.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

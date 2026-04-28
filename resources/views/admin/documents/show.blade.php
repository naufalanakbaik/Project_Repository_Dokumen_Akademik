@extends('admin.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
        <div>
            <h1 class="text-xl font-semibold text-gray-900 leading-tight">
                {{ $document->title }}
            </h1>
            <p class="text-xs text-gray-600 mt-0.5">
                Detail informasi dokumen dan preview file
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
            <div class="bg-white border rounded-lg shadow-sm overflow-hidden flex flex-col">
                {{-- Header --}}
                <div class="flex items-center justify-between px-5 py-3 border-b bg-gray-50">
                    <div class="flex items-center gap-1 text-sm text-gray-600">
                        <span class="material-symbols-outlined !text-[18px]">description</span>
                        Preview Dokumen
                    </div>

                    <a href="{{ route('admin.documents.download', $document->id) }}"
                        class="flex items-center gap-1 text-[14px] px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg border border-gray-300
                        hover:bg-gray-200 transition">
                        <span class="material-symbols-outlined !text-[18px]">download</span>
                        Download
                    </a>
                </div>

                {{-- Preview file --}}
                <div class="bg-gray-100">
                    @if ($extension === 'pdf')
                        <iframe src="{{ $fileUrl }}" class="w-full h-[75vh]" loading="lazy">
                        </iframe>
                    @else
                        <div class="flex flex-col items-center justify-center h-[75vh] text-gray-600">
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
                <div class="flex items-center justify-between px-4 py-4 border-t bg-gray-50 text-xs text-gray-500">
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

            {{-- Detail Informasi Dokumen --}}
            <div class="bg-white border rounded-lg shadow-sm p-5">
                <h2 class="text-[15px] font-medium text-gray-700 border-b border-gray-300 pb-1 mb-4">
                    Detail Informasi Dokumen
                </h2>

                <!-- Pengunggah -->
                <div class="mb-3">
                    <p class="text-xs text-gray-500">Pengunggah</p>
                    <p class="text-sm font-medium text-gray-600 mt-0.5">
                        {{ $document->user->name }}
                    </p>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <p class="text-xs text-gray-500">Kategori</p>
                    <p class="text-sm font-medium text-gray-600 mt-0.5">
                        {{ $document->category->name }}
                    </p>
                </div>

                <!-- Tanggal Upload -->
                <div class="mb-3">
                    <p class="text-xs text-gray-500">Tanggal Upload</p>
                    <p class="text-sm text-gray-700 ">
                        {{ $document->created_at->format('d M Y') }}
                    </p>
                </div>

                <!-- Download Count -->
                <div class="mb-3">
                    <p class="text-xs text-gray-500">Jumlah Download</p>
                    <p class="text-sm text-gray-700">
                        {{ $document->downloads_count ?? 0 }} kali diunduh
                    </p>
                </div>

                <!-- Status -->
                <div>
                    <p class="text-xs text-gray-500">Status</p>
                    <div class="flex items-center gap-2 mt-2">
                        <span
                            class="inline-flex px-3 py-1 text-[10px] rounded-full border font-medium uppercase
                            {{ $document->status === 'approved'
                            ? 'bg-green-50 text-green-600 border-green-300'
                            : ($document->status === 'pending'
                            ? 'bg-yellow-50 text-yellow-600 border-yellow-300'
                            : 'bg-red-50 text-red-600 border-red-300') }}">
                            {{ ucfirst($document->status) }}
                        </span>

                        <!-- Status Hint -->
                        @if ($document->status === 'pending')
                            <span class="text-xs text-yellow-700">Butuh review</span>
                        @elseif($document->status === 'approved')
                            <span class="text-xs text-green-700">Sudah publik</span>
                        @else
                            <span class="text-xs text-red-700">Ditolak</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Action card --}}
            <div class="bg-white border rounded-lg shadow-sm p-5 space-y-3">

                <h2 class="text-[15px] font-medium text-gray-700 border-b border-gray-300 pb-1 mb-4">
                    Aksi Cepat
                </h2>

                <!-- Download -->
                <a href="{{ route('admin.documents.download', $document->id) }}"
                    class="flex items-center justify-between px-2 py-2 rounded-lg hover:bg-gray-50 hover:border hover:border-gray-200 transition group">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined !text-[18px] text-gray-500 group-hover:text-gray-700">
                            download
                        </span>
                        <span class="text-sm text-gray-700 group-hover:text-gray-900">
                            Download
                        </span>
                    </div>
                </a>

                <!-- Edit -->
                <a href="{{ route('admin.documents.edit', $document->id) }}"
                    class="flex items-center justify-between px-2 py-2 rounded-lg hover:bg-gray-50 hover:border hover:border-gray-200 transition group">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined !text-[18px] text-gray-500 group-hover:text-gray-700">
                            edit
                        </span>
                        <span class="text-sm text-gray-700 group-hover:text-gray-900">
                            Edit Dokumen
                        </span>
                    </div>
                </a>

                <!-- Delete -->
                <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="w-full flex items-center justify-between px-2 py-2 rounded-lg hover:bg-red-50 hover:border hover:border-red-200 transition group">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined !text-[18px] text-red-500">
                                delete
                            </span>
                            <span class="text-sm text-red-600">
                                Hapus Dokumen
                            </span>
                        </div>
                    </button>
                </form>

            </div>

        </div>

    </div>

@endsection

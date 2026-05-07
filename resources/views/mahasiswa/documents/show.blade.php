@extends('mahasiswa.layouts.app')
@section('title', 'Detail Dokumen')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800 leading-tight">
                    Detail {{ $document->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-3 text-[12px] text-gray-500 mt-1.5">
                    <span>•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">person</span>
                        {{ $document->user->name }}
                    </span>

                    <span>•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">folder</span>
                        {{ $document->category->name }}
                    </span>

                    <span>•</span>

                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[15px]">calendar_check</span>
                        Tahun Terbit
                        {{ $document->tahun_terbit }}
                    </span>
                </div>
            </div>

            <a href="{{ route('mahasiswa.documents.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-1">
                Back
                <span class="material-icons !text-[18px]">low_priority</span>
            </a>
        </div>

        {{-- Main grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left: preview frame pdf file --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Header title --}}
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 flex items-center justify-between">

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-lg
                            bg-red-50 border border-red-200 text-red-600">
                            <span class="material-icons !text-[22px]">picture_as_pdf</span>
                        </div>

                        <div class="leading-tight">
                            <p class="text-sm font-semibold text-gray-900 line-clamp-1">
                                {{ $document->title }}
                            </p>

                            <div class="flex items-center gap-2 text-[12px] text-gray-500 mt-0.5">
                                <span>PDF</span>
                                <span>•</span>
                                <span>Preview tersedia</span>
                            </div>
                        </div>
                    </div>

                    <span
                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xl border text-[11px] font-medium
                        {{ $document->status === 'approved'
                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                        : ($document->status === 'pending'
                        ? 'bg-amber-50 text-amber-600 border-amber-200'
                        : 'bg-red-50 text-red-700 border-red-200') }}">

                        <span class="material-symbols-outlined !text-[14px]">
                            {{ $document->status === 'approved' ? 'check_circle' : ($document->status === 'pending' ? 'schedule' : 'cancel') }}
                        </span>

                        {{ ucfirst($document->status) }}
                    </span>
                </div>

                {{-- PDF preview frame  --}}
                <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden">

                    {{-- Header Preview --}}
                    <div class="px-5 py-4 border-b bg-gray-50 flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">
                            Preview Dokumen
                        </span>

                        <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                            class="text-xs text-blue-600 hover:underline">
                            Buka di tab baru
                        </a>
                    </div>

                    {{-- PDF Viewer --}}
                    {{-- <iframe src="{{ asset('storage/' . $document->file) }}" class="w-full h-[650px] bg-gray-100"></iframe> --}}
                    <div class="w-full h-[650px] bg-gray-100">
                        <iframe src="{{ route('mahasiswa.documents.preview', $document->id) }}"
                            class="w-full h-full"></iframe>
                    </div>

                    {{-- Footer --}}
                    <div class="flex items-center justify-between px-4 py-4 border-t bg-gray-50 text-xs text-gray-500">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined !text-[16px]">insert_drive_file</span>
                            {{ basename($document->file) }}
                        </div>
                        <div>
                            {{ \Carbon\Carbon::parse($document->created_at)->translatedFormat('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Information documents & action buttons --}}
            <div class="space-y-5">

                {{-- Data documents --}}
                <div class="bg-white border border-gray-300 rounded-lg shadow-sm">

                    <div class="px-5 py-4 border-b bg-gray-50 text-sm rounded-t-lg font-medium text-gray-700">
                        Informasi Dokumen
                    </div>

                    <div class="divide-y text-sm">

                        <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                            <span class="text-xs text-gray-500 font-medium">Uploader</span>
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
                            <span class="text-xs text-gray-500 font-medium">Tipe File</span>
                            <span class="font-medium text-gray-600">
                                PDF
                            </span>
                        </div>

                        {{-- Status section --}}
                        <div class="px-4 py-4">

                            <p class="text-xs font-medium text-gray-500 mb-2">Status Dokumen</p>

                            <div class="flex items-center justify-between">

                                {{-- Status badge --}}
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-0.5 rounded-xl border text-[11px] font-medium
                                    {{ $document->status === 'approved'
                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                        : ($document->status === 'pending'
                                            ? 'bg-amber-50 text-amber-600 border-amber-200'
                                            : 'bg-red-50 text-red-700 border-red-200') }}">

                                    <span class="material-symbols-outlined !text-[14px]">
                                        {{ $document->status === 'approved' ? 'check_circle' : ($document->status === 'pending' ? 'schedule' : 'cancel') }}
                                    </span>

                                    {{ ucfirst($document->status) }}
                                </span>

                                {{-- Status meta --}}
                                @if ($document->status === 'approved')
                                    <span class="text-[11px] text-gray-500">
                                        Verified
                                    </span>
                                @elseif($document->status === 'pending')
                                    <span class="text-[11px] text-gray-500">
                                        Menunggu verifikasi
                                    </span>
                                @elseif($document->status === 'rejected')
                                    <span class="text-[11px] text-gray-500">
                                        {{ optional($document->rejected_at)->format('d M Y') }}
                                    </span>
                                @endif

                            </div>

                        </div>


                        {{-- Rejection section --}}
                        @if ($document->status === 'rejected')
                            <div class="mx-4 mb-4 rounded-lg border border-red-200 bg-red-50 p-4">

                                <div class="flex items-start gap-3">

                                    {{-- Icon --}}
                                    <span class="material-symbols-outlined text-red-600 mt-0.5">
                                        error
                                    </span>

                                    <div class="flex-1">

                                        {{-- Header --}}
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-sm font-semibold text-red-700">
                                                Dokumen ditolak
                                            </h3>

                                            <span class="text-[11px] text-red-400">
                                                {{ optional($document->rejected_at)->format('d M Y, H:i') ?? '-' }}
                                            </span>
                                        </div>

                                        {{-- Reason --}}
                                        <p class="mt-1.5 text-sm text-red-700 leading-relaxed whitespace-pre-line">
                                            {{ $document->reject_note ?? 'Tidak ada keterangan.' }}
                                        </p>

                                        {{-- Meta action --}}
                                        <div class="mt-3 flex items-center justify-between text-xs">

                                            <span class="text-gray-600">
                                                Oleh
                                                <span class="font-medium text-gray-800">
                                                    {{ $document->rejectedBy->name ?? 'Admin' }}
                                                </span>
                                            </span>

                                            <a href="{{ route('mahasiswa.documents.edit', $document->id) }}"
                                                class="text-red-600 hover:text-red-700 font-medium transition">
                                                Perbaiki dokumen
                                            </a>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endif

                    </div>
                </div>

                {{-- Actions buttons --}}
                <div class="bg-white border border-gray-300 rounded-lg shadow-sm sticky top-6">

                    <div class="px-5 py-4 border-b bg-gray-50 text-sm rounded-t-lg">
                        <div class="flex items-center gap-1 text-sm font-medium text-gray-700">
                            <span class="material-symbols-outlined !text-[17px]">right_click</span>
                            Aksi Cepat
                        </div>
                    </div>

                    <div class="p-4 space-y-3">
                        {{-- Edit --}}
                        @if ($document->status !== 'approved')
                            <a href="{{ route('mahasiswa.documents.edit', $document->id) }}" target="_blank"
                                class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                                border border-amber-300 bg-white text-amber-600 rounded-md hover:bg-amber-50 transition">
                                <span class="material-symbols-outlined !text-[16px]">edit_document</span>
                                Edit Dokumen
                            </a>
                        @endif

                        {{-- Download --}}
                        <a href="{{ route('mahasiswa.documents.download', $document->id) }}"
                            class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                            border border-red-300 bg-red-50 text-red-700 rounded-md hover:bg-red-100 transition">
                            <span class="material-symbols-outlined !text-[16px]">file_save</span>
                            Download
                        </a>

                        {{-- Preview in new tab --}}
                        <a href="{{ route('mahasiswa.documents.preview', $document->id) }}" target="_blank"
                            class="w-full flex items-center justify-center gap-2 px-3 py-2 text-[13px] font-medium
                            border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                            <span class="material-symbols-outlined !text-[16px]">open_in_new</span>
                            Buka di Tab Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

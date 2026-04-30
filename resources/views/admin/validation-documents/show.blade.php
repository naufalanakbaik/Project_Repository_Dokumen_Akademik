@extends('admin.layouts.app')
@section('title', 'Detail Validasi Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div class="space-y-1">
            <h1 class="text-2xl font-semibold text-gray-900 leading-tight">
                {{ $document->title }}
            </h1>
            <p class="text-sm text-gray-500">
                Diajukan oleh
                <span class="font-medium text-gray-800">{{ $document->user->name }}</span>
            </p>
        </div>

        {{-- Status --}}
        <div class="flex items-center gap-2">
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium
                bg-yellow-50 text-yellow-700 border border-yellow-300 rounded-full">
                <span class="material-symbols-outlined !text-[14px] leading-none">
                    schedule
                </span>
                Pending Review
            </span>
        </div>
    </div>


    {{-- Main content --}}
    <div class="grid grid-cols-12 gap-6">

        {{-- Preview file --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden flex flex-col">

                {{-- Top bar --}}
                <div class="flex items-center justify-between px-4 py-3 border-b bg-gray-50">
                    <div class="flex items-center gap-1 text-sm text-gray-600">
                        <span class="material-symbols-outlined !text-[18px]">description</span>
                        Preview Dokumen
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.documents.download', $document->id) }}"
                            class="flex items-center gap-1 text-[12px] px-3 py-1 bg-gray-100 text-gray-600 rounded-md border border-gray-300
                            hover:bg-gray-200 transition">
                            <span class="material-symbols-outlined !text-[14px]">download</span>
                            Download
                        </a>
                    </div>
                </div>

                {{-- PDF View --}}
                <iframe src="{{ asset('storage/' . $document->file) }}" class="w-full h-[680px] bg-gray-100">
                </iframe>

                {{--File info --}}
                <div class="flex items-center justify-between px-4 py-4 border-t bg-gray-50 text-xs text-gray-500">
                    <div class="flex items-center gap-2 truncate">
                        <span class="material-symbols-outlined !text-[16px] text-gray-400">
                            insert_drive_file
                        </span>
                        <span class="truncate">{{ basename($document->file) }}</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="uppercase tracking-wide">
                            {{ pathinfo($document->file, PATHINFO_EXTENSION) }}
                        </span>
                        <span>
                            {{ $document->created_at->translatedFormat('l, d M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>


        {{-- Right panel --}}
        <div class="col-span-12 lg:col-span-4 space-y-5">

            {{-- Meta information --}}
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                <div class="px-4 py-3 border-b rounded-t-lg bg-gray-50 text-sm font-medium text-gray-700">
                    Informasi Dokumen
                </div>

                <div class="p-4 space-y-4 text-xs">
                    <div class="flex items-start justify-between">
                        <span class="text-gray-500 text-xs">Uploader</span>
                        <span class="text-gray-600 font-medium">{{ $document->user->name }}</span>
                    </div>
                    <div class="flex items-start justify-between">
                        <span class="text-gray-500 text-xs">Kategori</span>
                        <span class="text-gray-600 font-medium">{{ $document->category->name }}</span>
                    </div>
                    <div class="flex items-start justify-between">
                        <span class="text-gray-500 text-xs">Tanggal</span>
                        <span class="text-gray-600 font-medium">
                            {{ $document->created_at->translatedFormat('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>


            {{-- Validation panel --}}
            <div class="sticky top-6">

                <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                    <div class="px-4 py-3 border-b rounded-t-lg bg-gray-50 text-sm font-medium text-gray-700">
                        Validasi Dokumen
                    </div>
                    <div class="p-4 space-y-4">

                        <form action="{{ route('admin.documents.updateStatus', $document->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-2 gap-2">

                                {{-- Approve --}}
                                <button type="submit" name="status" value="approved"
                                    onclick="return confirm('Approve dokumen ini?')"
                                    class="flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-medium
                                    bg-green-50 text-green-700 border border-green-300 rounded-lg
                                    hover:bg-green-100 active:scale-[0.98] transition">

                                    <span class="material-symbols-outlined !text-[16px]">task</span>
                                    Approve
                                </button>

                                {{-- Reject --}}
                                <button type="submit" name="status" value="rejected"
                                    onclick="return confirm('Reject dokumen ini?')"
                                    class="flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-medium
                                    bg-red-50 text-red-700 border border-red-300 rounded-lg
                                    hover:bg-red-100 active:scale-[0.98] transition">

                                    <span class="material-symbols-outlined !text-[16px]">scan_delete</span>
                                    Reject
                                </button>

                            </div>

                        </form>

                        {{-- Note for admin --}}
                        <div class="flex items-start gap-2 text-[11px] text-gray-500 border-t pt-3">
                            <span class="material-symbols-outlined !text-[16px] text-gray-400 mt-0.5">
                                info
                            </span>
                            <p>
                                Lakukan validasi hanya setelah memastikan isi dokumen sudah sesuai.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

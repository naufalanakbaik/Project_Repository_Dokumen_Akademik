@extends('dosen.layouts.app')
@section('title', 'Dokumen Saya')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between">

            <div>
                <h1 class="text-xl font-semibold text-gray-900">
                    My Documents
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Upload dan kelola dokumen kamu dengan mudah.
                </p>
            </div>

            <a href="{{ route('dosen.documents.create') }}"
                class="flex items-center gap-2 px-4 h-[40px] text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm">

                <span class="material-symbols-outlined !text-[18px]">
                    upload
                </span>
                Upload
            </a>
        </div>

        {{-- List --}}
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

            @forelse ($documents as $doc)
                <div class="flex items-center gap-4 px-5 py-4 border-b last:border-none hover:bg-gray-50 transition">

                    {{-- Icon --}}
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-50 text-red-500 flex-shrink-0">
                        <span class="material-symbols-outlined !text-[20px]">
                            picture_as_pdf
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">

                        {{-- Title --}}
                        <p class="text-sm font-semibold text-gray-900 truncate">
                            {{ $doc->title }}
                        </p>

                        {{-- Meta --}}
                        <div class="flex items-center flex-wrap gap-3 mt-1 text-xs text-gray-500">

                            {{-- Category --}}
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined !text-[16px]">
                                    folder
                                </span>
                                {{ $doc->category->name }}
                            </div>

                            {{-- Status --}}
                            <span
                                class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-2xl border text-[10px] font-medium
                            {{ $doc->status === 'approved'
                                ? 'bg-green-50 text-green-700 border-green-200'
                                : ($doc->status === 'pending'
                                    ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                                    : 'bg-red-50 text-red-700 border-red-200') }}">

                                <span class="material-symbols-outlined !text-[12px]">
                                    {{ $doc->status === 'approved' ? 'check_circle' : ($doc->status === 'pending' ? 'schedule' : 'cancel') }}
                                </span>

                                {{ ucfirst($doc->status) }}
                            </span>

                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2.5">

                        <a href="{{ route('dosen.documents.show', $doc->id) }}"
                            class="p-2 rounded-lg transition" title="Detail">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                file_open
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.preview', $doc->id) }}" target="_blank"
                            class="p-2 rounded-lg transition" title="Preview">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                picture_as_pdf
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.download', $doc->id) }}"
                            class="p-2 rounded-lg transition" title="Download">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                download
                            </span>
                        </a>

                    </div>

                </div>

            @empty
                <div class="p-10 text-center text-sm text-gray-500">
                    Kamu belum memiliki dokumen.
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div>
            {{ $documents->links() }}
        </div>

    </div>
@endsection

@extends('dosen.layouts.app')
@section('title', 'Dokumen Saya')

@section('content')
    <div class="max-w-full mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">
                    Daftar Dokumen Saya
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Upload dan kelola dokumen kamu dengan mudah.
                </p>
            </div>

            <a href="{{ route('dosen.documents.create') }}"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 text-[13px] text-blue-700 font-medium bg-blue-50 border border-blue-400 
                rounded-lg hover:bg-blue-100 transition">
                <span class="material-symbols-outlined !text-[17px]">
                    upload
                </span>
                Upload Dokumen
            </a>
        </div>

        <div class="flex items-center justify-between mb-4">

    {{-- LEFT: FILTER --}}
    <form method="GET" class="flex items-center gap-2">

        {{-- Search --}}
        <div class="relative">
            <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                search
            </span>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari dokumen..."
                class="h-9 w-64 pl-9 pr-3 text-[13px] border border-gray-300 rounded-md
                focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
        </div>

        {{-- Category --}}
        <div class="relative">
            <select name="category"
                class="appearance-none h-9 pl-3 pr-8 text-[13px] border border-gray-300 rounded-md
                bg-white focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">

                <option value="">Semua kategori</option>

                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            {{-- Arrow --}}
            <span class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                <span class="material-symbols-outlined !text-[16px]">expand_more</span>
            </span>
        </div>

        {{-- Button --}}
        <button
            class="h-9 px-3 text-[13px] font-medium border border-gray-300 rounded-md bg-gray-50
            hover:bg-gray-100 active:bg-gray-200 transition">
            Cari
        </button>

    </form>

    {{-- RIGHT: OPTIONAL ACTION --}}
    <div class="text-[12px] text-gray-400">
        {{ $documents->total() }} dokumen
    </div>

</div>

        {{-- Table daftar dokumen --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            @forelse ($documents as $index => $doc)
                <div class="flex items-center gap-4 px-5 py-3 border-b last:border-none hover:bg-gray-50 transition group">

                    {{-- Number --}}
                    <div class="w-6 text-xs text-gray-400 font-medium text-center flex-shrink-0">
                        {{ $index + 1 }}
                    </div>

                    {{-- Icon --}}
                    <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-500 flex-shrink-0">
                        <span class="material-symbols-outlined !text-[18px]">
                            picture_as_pdf
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">

                        {{-- Title --}}
                        <p class="text-sm font-medium text-gray-900 truncate group-hover:text-gray-800">
                            {{ $doc->title }}
                        </p>

                        {{-- Meta --}}
                        <div class="flex items-center flex-wrap gap-3 mt-1 text-xs text-gray-500">

                            {{-- Category --}}
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined !text-[14px]">
                                    folder
                                </span>
                                {{ $doc->category->name }}
                            </div>

                            {{-- Status --}}
                            <span
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xl border text-[10px] font-medium
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

                    {{-- Actions buttons --}}
                    <div class="flex items-center gap-2">

                        <a href="{{ route('dosen.documents.show', $doc->id) }}"
                            class="p-2 hover:text-gray-700 transition" title="Detail">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                file_open
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.edit', $doc->id) }}"
                            class="p-2 hover:text-gray-700 transition" title="Edit">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                edit_document
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.preview', $doc->id) }}" target="_blank"
                            class="p-2 hover:text-gray-700 transition" title="Preview">
                            <span class="material-symbols-outlined !text-[18px] text-gray-600">
                                picture_as_pdf
                            </span>
                        </a>

                        <a href="{{ route('dosen.documents.download', $doc->id) }}"
                            class="p-2 hover:text-gray-700 transition" title="Download">
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

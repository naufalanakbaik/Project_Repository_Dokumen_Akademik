@extends('admin.layouts.app')
@section('title', 'Detail Kategori')

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Detail Data Kategori
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Detail data kategori
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

    <div class="space-y-6">

        {{-- Card --}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">

            {{-- Nama (Highlight utama) --}}
            <div class="mb-6">
                <p class="text-xs text-gray-600 mb-1">Nama Kategori</p>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ $category->name }}
                </h2>
            </div>

            {{-- Metadata --}}
            <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-gray-600 text-xs mb-1">ID</p>
                    <p class="font-[13px] text-gray-800">
                        #{{ $category->id }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-600 text-xs mb-0.5">Dibuat pada</p>
                    <p class="font-[13px] text-gray-800">
                        {{ $category->created_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-600 text-xs mb-0.5">Terakhir Diupdate</p>
                    <p class="font-[13px] text-gray-800">
                        {{ $category->updated_at->format('d M Y, H:i') }}
                    </p>
                </div>

            </div>

        </div>

    </div>

@endsection

@extends('admin.layouts.app')
@section('title', 'Kategori Admin')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Daftar Kategori
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Kelola dan pantau seluruh pengguna dalam sistem secara efisien.
            </p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
            class="inline-flex items-center text-blue-800 text-sm font-medium px-2 py-1 hover:text-blue-900 
            transition">
            <span
                class="material-icons !text-[17px] mr-2 px-2 py-2 text-white rounded-lg border border-blue-700 
                bg-blue-700 hover:bg-white hover:text-blue-800 transition">
                add
            </span>
            Tambah Kategori
        </a>
    </div>

    {{-- Message succes --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Table data pengguna --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9]">
                <tr>
                    <th class="px-4 py-3 font-medium text-center">No</th>
                    <th class="px-6 py-3 font-medium text-left">Nama</th>
                    <th class="px-6 py-3 font-medium text-left">Tanggal dibuat</th>
                    <th class="px-6 py-3 font-medium text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-[13px] divide-gray-200">
                @foreach ($categories as $key => $category)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- No --}}
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{-- {{ $loop->iteration }} --}}
                            {{ $key + 1 }}
                        </td>

                        {{-- nama --}}
                        <td class="px-6 py-3">
                            <p class="font-normal text-gray-900 truncate max-w-[420px]">
                                {{ $category->name }}
                            </p>
                        </td>

                        {{-- Waktu --}}
                        <td class="px-6 py-3 text-gray-500">
                            {{ $category->created_at->format('d M Y - H:i') }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-3">
                            <div class="flex text-[12.5px] gap-6 h-full">
                                {{-- Detail --}}
                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                    class="text-[#292929] hover:-translate-y-0.5 hover:text-gray-800 font-medium transition">
                                    Lihat
                                </a>
                                {{-- Edit --}}
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="text-[#292929] hover:-translate-y-0.5 hover:text-gray-800 font-medium transition">
                                    Edit
                                </a>
                                {{-- Hapus --}}
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="m-0"
                                    onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-[#292929] hover:-translate-y-0.5 hover:text-gray-800 font-medium transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@extends('admin.layouts.app')

@section('title', 'Daftar Akun')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Daftar Pengguna
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Kelola dan pantau seluruh pengguna dalam sistem secara efisien.
            </p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center text-blue-800 text-sm font-medium px-2 py-1 hover:text-blue-900 
            transition">
            <span class="material-icons !text-[17px] mr-2 px-2 py-2 text-white rounded-lg border border-blue-700 
                bg-blue-700 hover:bg-white hover:text-blue-800 transition">
                person_add
            </span>
            Tambah Pengguna
        </a>
    </div>

    {{-- Filter + Seacrh --}}
    {{-- <div class="bg-white border border-gray-200 rounded-lg p-4 mb-4 shadow-sm">
        <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">

            <div class="relative w-full md:w-1/3">
                <input type="text" placeholder="Cari nama atau email..."
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <span class="material-icons absolute left-3 top-2.5 text-gray-400 text-[18px]">
                    search
                </span>
            </div>

            <select
                class="w-full md:w-48 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
            </select>
        </div>
    </div> --}}

    {{-- Table data pengguna --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9]">
                <tr>
                    <th class="px-4 py-3 font-medium text-center">No</th>
                    <th class="px-6 py-3 font-medium text-left">Nama</th>
                    <th class="px-6 py-3 font-medium text-left">Email</th>
                    <th class="px-6 py-3 font-medium text-left">Role</th>
                    <th class="px-6 py-3 font-medium text-left">Tanggal dibuat</th>
                    <th class="px-6 py-3 font-medium text-left">Aksi</th>
                </tr>
            </thead> 
            <tbody class="divide-y text-[13px] divide-gray-200">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- No --}}
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- nama --}}
                        <td class="px-6 py-3">
                            <p class="font-normal text-gray-900 truncate max-w-[420px]">
                                {{ $user->name }}
                            </p>
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-3">
                            <p class="font-normal text-gray-800 truncate max-w-[420px]">
                                {{ $user->email }}
                            </p>
                        </td>

                        {{-- Role --}}
                        @php
                            $roleStyles = [
                                'admin' => 'bg-red-50 text-red-700 border border-red-300',
                                'dosen' => 'bg-green-50 text-green-700 border border-green-300',
                                'mahasiswa' => 'bg-blue-50 text-blue-700 border border-blue-300',
                                // 'kaprodi' => 'bg-yellow-100 text-yellow-700',
                            ];
                            $style =
                                $roleStyles[$user->role] ?? 'bg-yellow-50 text-yellow-700 border border-yellow-300';
                        @endphp
                        <td class="px-6 py-3">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        {{-- Waktu --}}
                        <td class="px-6 py-3 text-gray-500">
                            {{ $user->created_at->format('d M Y - H:i') }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-3">
                            <div class="flex text-[12.5px] gap-4 h-full">
                                {{-- Detail --}}
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="text-[#3f3f3f] hover:-translate-y-0.5 hover:text-gray-800 font-medium transition">
                                    Lihat
                                </a>
                                {{-- Edit --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="text-[#3f3f3f] hover:-translate-y-0.5 hover:text-gray-800 font-medium transition">
                                    Edit
                                </a>
                                {{-- Hapus --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="m-0"
                                    onsubmit="return confirm('Yakin ingin hapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#3f3f3f] hover:-translate-y-0.5 hover:text-gray-800 font-medium transition">
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

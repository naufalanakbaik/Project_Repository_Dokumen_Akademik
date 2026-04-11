@extends('admin.layouts.app')

@section('title', 'Daftar Akun - Admin')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">
                Daftar Pengguna
            </h1>
            <p class="text-sm text-gray-500">
                Kelola dan pantau pengguna (Mahasiswa, Dosen, Kaprodi) yang ada.
            </p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center text-blue-700 text-sm font-medium px-2 py-1 hover:text-blue-800 
            transition">
            <span
                class="material-icons !text-[20px] mr-2 px-2 py-2 text-white rounded-xl border border-blue-700 
                bg-blue-700 hover:bg-white hover:text-blue-800 transition">
                upload
            </span>
            Tambah Pengguna
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-800 border-b border-gray-300">
                <tr>
                    <th class="px-4 py-4 font-medium text-left">No</th>
                    <th class="px-6 py-4 font-medium text-left">Nama</th>
                    <th class="px-6 py-4 font-medium text-center">Email</th>
                    <th class="px-6 py-4 font-medium text-center">Role</th>
                    <th class="px-6 py-4 font-medium text-center">Tanggal dibuat</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- No --}}
                        <td class="px-4 py-4 text-center text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        {{-- nama --}}
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 truncate max-w-[420px]">
                                {{ $user->name }}
                            </p>
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4">
                            <p class="font-normal text-gray-800 truncate max-w-[420px]">
                                {{ $user->email }}
                            </p>
                        </td>

                        {{-- Role --}}
                        @php
                            $roleStyles = [
                                'admin' => 'bg-green-50 text-green-800 border border-green-200',
                                'mahasiswa' => 'bg-red-50 text-red-700 border border-red-200',
                                'dosen' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                // 'kaprodi' => 'bg-yellow-100 text-yellow-700',
                            ];
                            $style = $roleStyles[$user->role] ?? 'bg-yellow-50 text-yellow-700 border border-yellow-200';
                        @endphp
                        <td class="px-2 py-3">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $style }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        {{-- Waktu --}}
                        <td class="px-6 py-4 text-center text-gray-500">
                            {{ $user->created_at->format('d M Y - H:i') }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-6 h-full">
                                {{-- Detail --}}
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium transition">
                                    Lihat
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="text-green-600 hover:text-green-800 font-medium transition">
                                    Edit
                                </a>
                                {{-- Hapus --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="m-0"
                                    onsubmit="return confirm('Yakin ingin hapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">
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

@extends('admin.layouts.app')
@section('title', 'Tambah User')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Tambah Pengguna Baru
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Tambah pengguna baru dan isi dengan benar data pengguna.
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center text-gray-800 dark:text-gray-200 text-sm font-normal px-2 py-1 hover:text-blue-700 dark:hover:text-blue-400 transition">
            <span
                class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-700 dark:border-blue-500 
            bg-blue-700 dark:bg-blue-600 hover:bg-white hover:text-blue-600 dark:hover:bg-gray-800
            dark:hover:text-blue-400 !text-[20px] transition">east</span>
        </a>
    </div>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Nama">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <select name="role">
            <option value="admin">Admin</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="kaprodi">Kaprodi</option>
        </select>

        <button type="submit">Simpan</button>
    </form>

@endsection

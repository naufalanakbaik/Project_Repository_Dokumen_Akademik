@extends('admin.layouts.app')
@section('title', 'Daftar Data Pengguna')

@section('content')

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-lg border border-gray-200/80 bg-white px-6 py-5 mb-6 shadow-sm">
        {{-- Soft Accent --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-sky-100 rounded-full blur-3xl opacity-40"></div>

        {{-- Head section --}}
        <div class="relative flex items-start justify-between gap-5">
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 mb-3 rounded-full border border-sky-200 bg-sky-50">
                    <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                    <span class="text-[11px] font-semibold tracking-wide text-sky-700 uppercase">
                        Manajemen Data Pengguna
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 leading-tight">
                    Daftar & Kelola Data Pengguna
                </h1>

                {{-- Description --}}
                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                    Kelola seluruh data pengguna repository akademik secara lebih
                    terstruktur. Atur akses user berdasarkan role, pantau data akun,
                    dan kelola pengguna sistem dengan lebih mudah serta efisien.
                </p>
            </div>

            {{-- Right Icon --}}
            <div
                class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-sky-200 bg-sky-50 shrink-0">
                <span class="material-symbols-outlined text-sky-600 !text-[24px]">
                    groups
                </span>
            </div>
        </div>

        {{-- Footer section --}}
        <div
            class="mt-5 pt-4 border-t border-dashed border-gray-200 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            {{-- Left Info --}}
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Data pengguna aktif siap untuk dikelola admin
            </div>

            {{-- Right Date --}}
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <span class="material-symbols-outlined !text-[15px]">
                    calendar_month
                </span>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Top Actions --}}
    <div class="space-y-4 mb-5">
        {{-- Head button tambah user  --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-950">
                    Daftar Pengguna
                </h1>
                <p class="text-xs text-blue-600 mt-0.5">
                    Kelola dan pantau seluruh pengguna dalam sistem secara efisien.
                </p>
            </div>

            {{-- Add User --}}
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-1.5 px-4 h-9 text-[13px] text-blue-700 font-medium tracking-wide bg-blue-50 border 
                border-blue-400 rounded-lg hover:bg-blue-100 transition">
                <span class="material-symbols-outlined !text-[17px]">
                    person_add
                </span>
                Tambah Pengguna
            </a>
        </div>

        {{-- Search & filter --}}
        <form method="GET" class="flex flex-col gap-3 lg:flex-row lg:items-center">
            {{-- Search --}}
            <div class="relative w-full lg:w-[280px]">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[17px]">
                    search
                </span>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name..."
                    class="w-full h-9 pl-9 pr-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-md
                    placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200
                    focus:border-gray-400 transition">
            </div>

            {{-- Role Filter --}}
            <div class="relative">
                <select name="role"
                    class="appearance-none h-9 pl-3 pr-9 text-sm text-gray-700 bg-white border border-gray-300 rounded-md
                    focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-400 transition">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="dosen" {{ request('role') == 'dosen' ? 'selected' : '' }}>
                        Dosen
                    </option>
                    <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>
                        Mahasiswa
                    </option>
                    <option value="kaprodi" {{ request('role') == 'kaprodi' ? 'selected' : '' }}>
                        Kaprodi
                    </option>
                </select>

                {{-- Arrow --}}
                <span
                    class="pointer-events-none material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">
                    expand_more
                </span>
            </div>

            {{-- Search button --}}
            <button type="submit"
                class="inline-flex items-center justify-center gap-2 px-4 h-9 text-[13px] font-medium text-gray-700
                bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                <span class="material-symbols-outlined !text-[17px]">
                    search
                </span>
                Search
            </button>

            {{-- Reset button --}}
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 h-9 text-[13px] font-medium text-gray-700
                bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                <span class="material-symbols-outlined !text-[17px]">
                    refresh
                </span>
                Reset
            </a>
        </form>
    </div>

    {{-- Table data pengguna --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <div class="w-full overflow-x-auto">
            <table class="min-w-full text-sm table-auto">
                <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9] tracking-wide">
                    <tr>
                        <th class="px-6 py-3 font-medium text-center">No</th>
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
                            <td class="px-6 py-3 text-center text-gray-500">
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
                            <td class="px-6 py-3 ">
                                <div class="flex items-center gap-8 text-gray-600">
                                    {{-- Detai --}}
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[19px]">person_search</span>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" target="_blank"
                                        class="hover:text-gray-800 transition">
                                        <span class="material-symbols-outlined !text-[19px]">person_edit</span>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        lass="m-0" onsubmit="return confirm('Yakin ingin hapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-red-600 text-gray-600 transition">
                                            <span class="material-symbols-outlined !text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection

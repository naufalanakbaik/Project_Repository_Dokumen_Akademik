@extends('admin.layouts.app')

@section('title', 'Detail Kategori')

@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Detail Data Pengguna
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Detail data akun <span class="font-semibold">{{ $user->name }}</span>
            </p>
        </div>
        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center text-gray-800 text-sm font-normal px-2 py-1 hover:text-blue-700 transition">
            <span
                class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-600  
                    bg-blue-600 hover:bg-white hover:text-blue-600 !text-[18px] transition">
                east
            </span>
        </a>
    </div>


    <div class="space-y-6">

        {{-- Profile User --}}
        <div class="bg-white border border-gray-300 rounded-xl shadow-sm overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                    {{-- Left --}}
                    <div class="flex items-center gap-4">
                        {{-- Avatar --}}
                        <div class="flex-shrink-0">
                            @if ($user->foto_profile)
                                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                                    class="w-20 h-20 rounded-full object-cover border border-gray-200 shadow-sm">
                            @else
                                <div
                                    class="w-20 h-20 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center shadow-sm">
                                    <span class="text-2xl font-semibold text-gray-700 uppercase">
                                        {{ \Illuminate\Support\Str::substr($user->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Identity --}}
                        <div>
                            <h1 class="text-xl font-semibold text-gray-900">
                                {{ $user->name }}
                            </h1>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $user->email }}
                            </p>

                            {{-- Role --}}
                            @php
                                $roleStyles = [
                                    'admin' => 'bg-red-50 text-red-700 border border-red-200',
                                    'dosen' => 'bg-green-50 text-green-700 border border-green-200',
                                    'mahasiswa' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                    'kaprodi' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                                ];
                                $style = $roleStyles[$user->role] ?? 'bg-gray-50 text-gray-700 border border-gray-200';
                            @endphp

                            <div class="mt-3">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium capitalize {{ $style }}">
                                    {{ $user->role }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Right --}}
                    <div class="text-sm text-gray-500">
                        <p>
                            Bergabung :
                            <span class="font-medium text-gray-600">
                                {{ $user->created_at->format('d M Y') }}
                            </span>
                        </p>
                        <p class="mt-1">
                            Jam :
                            <span class="font-medium text-gray-600">
                                {{ $user->created_at->format('H:i') }} WIB
                            </span>
                        </p>
                    </div>

                </div>

            </div>

            {{-- Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- Nama --}}
                    <div>
                        <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                            Nama Lengkap
                        </p>
                        <p class="text-sm font-medium text-gray-700">
                            {{ $user->name }}
                        </p>
                    </div>

                    {{-- Email --}}
                    <div>
                        <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                            Email
                        </p>
                        <p class="text-sm font-medium text-gray-700 break-all">
                            {{ $user->email }}
                        </p>
                    </div>

                    {{-- Role --}}
                    <div>
                        <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                            Role
                        </p>
                        <p class="text-sm font-medium text-gray-700 capitalize">
                            {{ $user->role }}
                        </p>
                    </div>

                    {{-- Mahasiswa --}}
                    @if ($user->role === 'mahasiswa')
                        {{-- NIM --}}
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                                NIM
                            </p>
                            <p class="text-sm font-medium text-gray-700">
                                {{ $user->nim ?? '-' }}
                            </p>
                        </div>

                        {{-- Jurusan --}}
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                                Jurusan
                            </p>
                            <p class="text-sm font-medium text-gray-700">
                                {{ $user->jurusan ?? '-' }}
                            </p>
                        </div>

                        {{-- Angkatan --}}
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                                Tahun Angkatan
                            </p>

                            <p class="text-sm font-medium text-gray-700">
                                {{ $user->tahun_angkatan ?? '-' }}
                            </p>
                        </div>
                    @else
                        {{-- NIP --}}
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                                NIP
                            </p>
                            <p class="text-sm font-medium text-gray-700">
                                {{ $user->nip ?? '-' }}
                            </p>
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mb-1">
                                Jabatan
                            </p>
                            <p class="text-sm font-medium text-gray-700">
                                {{ $user->jabatan ?? '-' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Dokumen --}}
            <div class="bg-white border border-gray-300 rounded-xl p-5 flex items-center justify-between shadow-sm">
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Dokumen
                    </p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $user->documents_count }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">
                        Dokumen yang telah diunggah
                    </p>
                </div>

                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">
                    <span class="material-icons text-blue-700 !text-[30px]">
                        description
                    </span>
                </div>
            </div>

            {{-- Aktivitas --}}
            <div class="bg-white border border-gray-300 rounded-xl p-5 flex items-center justify-between shadow-sm">
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Aktivitas
                    </p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $user->logs_count }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1">
                        Aktivitas pengguna tercatat
                    </p>
                </div>

                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">
                    <span class="material-icons text-green-700 !text-[30px]">
                        timeline
                    </span>
                </div>
            </div>
        </div>
    </div>

@endsection

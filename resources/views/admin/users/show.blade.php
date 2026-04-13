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

        {{-- User informasi--}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-md p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">
                Informasi Pengguna
            </h2>

            <div class="grid md:grid-cols-3 gap-4 text-sm">

                <div>
                    <p class="text-gray-500 text-xs mb-1">Nama :</p>
                    <p class="font-medium text-gray-800">{{ $user->name }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs mb-1">Email :</p>
                    <p class="font-medium text-gray-800">{{ $user->email }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs mb-1">Role :</p>
                    <span class="inline-block px-3 py-1 text-xs rounded-xl bg-blue-100 text-blue-700 border border-blue-300">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

            </div>
        </div>

        {{-- Statistic user --}}
        <div class="grid md:grid-cols-2 gap-4">

            {{-- Dokumen --}}
            <div class="bg-white border border-gray-300 rounded-lg p-5 flex items-center gap-4 shadow-md">
                <span class="material-icons text-blue-700 text-[28px]">description</span>

                <div>
                    <p class="text-xs text-gray-500">Jumlah Dokumen</p>
                    <p class="!text-2xl font-semibold text-gray-900">
                        {{ $user->documents->count() }}
                    </p>
                </div>
            </div>

            {{-- Aktivitas --}}
            <div class="bg-white border border-gray-300 rounded-lg p-5 flex items-center gap-4 shadow-md">
                <span class="material-icons text-green-700 text-[28px]">timeline</span>

                <div>
                    <p class="text-xs text-gray-500">Jumlah Aktivitas</p>
                    <p class="!text-2xl font-semibold text-gray-900">
                        {{ $user->logs->count() }}
                    </p>
                </div>
            </div>

        </div>

    </div>


@endsection

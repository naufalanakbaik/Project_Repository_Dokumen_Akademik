@extends('mahasiswa.layouts.app')
@section('title', 'Profil Saya')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">
                    Profil Saya
                </h1>
                <p class="text-sm text-gray-500">
                    Informasi akun dan aktivitas dokumen
                </p>
            </div>
            <a href="{{ route('mahasiswa.profile.edit') }}"
                class="text-[12px] font-medium text-gray-500 hover:text-gray-600 border border-gray-300 px-3.5 py-1.5 rounded-lg bg-white hover:bg-gray-50 transition">
                Edit Profile
            </a>
        </div>

        {{-- Profile user --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6 flex items-center gap-5">

            {{-- Avatar --}}
            <div
                class="w-16 h-16 rounded-full bg-gray-100 border border-gray-300 flex items-center justify-center text-lg font-semibold text-gray-700">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            {{-- Info --}}
            <div class="flex-1">
                <p class="text-[14px] font-semibold text-gray-800">
                    {{ $user->name }}
                </p>
                <p class="text-[12px] text-gray-500">
                    {{ $user->email }}
                </p>

                {{-- subtle meta --}}
                <div class="flex items-center gap-3 mt-1.5 text-xs text-gray-400">
                    <span>Mahasiswa</span>
                    <span>•</span>
                    <span>Bergabung pada {{ $user->created_at->format('d M Y - H:i') }}</span>
                </div>
            </div>

        </div>

        {{-- Card stats --}}
        <div class="grid grid-cols-3 gap-4">

            <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-sm transition">
                <p class="text-lg font-semibold text-gray-900">
                    {{ $totalDocuments }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Total Dokumen
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-sm transition">
                <p class="text-lg font-semibold text-green-700">
                    {{ $approved }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Disetujui
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-sm transition">
                <p class="text-lg font-semibold text-yellow-700">
                    {{ $pending + $rejected }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Pending / Ditolak
                </p>
            </div>

        </div>

        {{-- Statistik Document terkini --}}
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

            {{-- Header --}}
            <div class="px-5 py-3 border-b text-sm font-medium text-gray-700 flex items-center justify-between">
                <span>Dokumen Terbaru</span>
                <span class="text-xs text-gray-400">
                    {{ $documents->count() }} item
                </span>
            </div>

            {{-- List --}}
            <div class="divide-y">
                @forelse ($documents as $doc)
                    <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-gray-500 !text-[18px] mt-0.5">
                                description
                            </span>
                            <div>
                                <p class="text-[13px] font-medium text-gray-800 leading-snug">
                                    {{ $doc->title }}
                                </p>
                                <p class="text-[11px] text-gray-400 mt-0.5">
                                    {{ $doc->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        {{-- Status --}}
                        <span
                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl border text-[11px] font-medium
                                {{ $doc->status === 'approved'
                                ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                : ($doc->status === 'pending'
                                ? 'bg-amber-50 text-amber-600 border-amber-200'
                                : 'bg-red-50 text-red-700 border-red-200') }}">

                            <span class="material-symbols-outlined !text-[12px]">
                                {{ $doc->status === 'approved' ? 'check_circle' : ($doc->status === 'pending' ? 'schedule' : 'cancel') }}
                            </span>

                            {{ ucfirst($doc->status) }}
                        </span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-sm text-gray-500">
                        Belum ada dokumen
                    </div>
                @endforelse
            </div>

        </div>

    </div>

@endsection

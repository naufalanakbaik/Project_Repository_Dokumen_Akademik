@extends('dosen.layouts.app')
@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">
                    Profil Saya
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Informasi akun dan aktivitas dokumen
                </p>
            </div>
            <a href="{{ route('dosen.profile.edit') }}"
                class="inline-flex items-center gap-1.5 text-[12px] font-medium text-gray-500 hover:text-gray-700 border border-gray-300 
                px-3.5 py-1.5 rounded-lg bg-white hover:bg-gray-50 transition">
                <span class="material-symbols-outlined !text-[16px]">
                    manage_accounts
                </span>
                Edit Profile
            </a>
        </div>

        {{-- Profile User --}}
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="px-7 py-6 border-b border-gray-100 bg-gradient-to-r from-yellow-100 to-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                    {{-- Left --}}
                    <div class="flex items-center gap-4">
                        {{-- Avatar --}}
                        <div class="flex-shrink-0">
                            @if ($user->foto_profile)
                                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full bg-blue-100 border-4 border-white flex items-center justify-center shadow-sm">
                                    <span class="text-2xl font-semibold text-blue-700 uppercase">
                                        {{ \Illuminate\Support\Str::substr($user->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Identity --}}
                        <div>
                            <h1 class="text-xl font-semibold text-gray-800">
                                {{ $user->name }}
                            </h1>
                            <div class="flex flex-wrap items-center gap-3 mt-2 text-sm text-gray-600">
                                {{-- Role --}}
                                <span class="font-medium text-gray-600 capitalize">
                                    {{ $user->role }}
                                </span>

                                {{-- Separator --}}
                                @if ($user->jabatan)
                                    <span class="text-gray-600">•</span>

                                    {{-- Jabatan --}}
                                    <span>
                                        {{ $user->jabatan }}
                                    </span>
                                @endif
                            </div>

                            <p class="text-[12px] text-gray-500 mt-2">
                                Bergabung pada
                                {{ $user->created_at->format('d M Y - H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    {{-- NIP --}}
                    <div>
                        <p class="text-[12px] font-medium text-gray-500 tracking-wide mb-1.5">
                            NIP
                        </p>
                        <p class="text-sm font-medium text-gray-700">
                            {{ $user->nip ?? '-' }}
                        </p>
                    </div>

                    {{-- Email --}}
                    <div>
                        <p class="text-[12px] font-medium text-gray-500 tracking-wide mb-1.5">
                            Email
                        </p>
                        <p class="text-sm font-medium text-gray-700 break-all">
                            {{ $user->email }}
                        </p>
                    </div>

                    {{-- Jabatan --}}
                    <div>
                        <p class="text-[12px] font-medium text-gray-500 tracking-wide mb-1.5">
                            Jabatan
                        </p>
                        <p class="text-sm font-medium text-gray-700">
                            {{ $user->jabatan ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Card stats --}}
        <div class="grid grid-cols-3 gap-4">

            <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-sm transition">
                <p class="text-lg font-semibold text-gray-700">
                    {{ $totalDocuments }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Total Dokumen
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-sm transition">
                <p class="text-lg font-semibold text-green-600">
                    {{ $approved }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Disetujui
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-sm transition">
                <p class="text-lg font-semibold text-yellow-600">
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
                            class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-medium rounded-full border
                            {{ $doc->status === 'approved'
                                ? 'bg-emerald-50 text-emerald-700 border-emerald-300'
                                : ($doc->status === 'pending'
                                    ? 'bg-amber-50 text-amber-600 border-amber-300'
                                    : 'bg-red-50 text-red-700 border-red-300') }}">

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

@extends('kaprodi.layouts.app')
@section('title', 'Profil Saya')

@push('styles')
<style>
    :root {
        --border: #e5e7eb;
        --surface: #ffffff;
        --surface-subtle: #f9fafb;
        --text-primary: #111827;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
        --radius-card: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        --transition: all .18s cubic-bezier(.4,0,.2,1);
    }
    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-card);
        box-shadow: var(--shadow-card);
    }
    .info-row {
        display: flex;
        flex-direction: column;
        gap: 3px;
        padding: 14px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--text-muted);
    }
    .info-value {
        font-size: 13.5px;
        font-weight: 500;
        color: #374151;
    }
</style>
@endpush

@section('content')
<div class="space-y-5 pb-6">

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-1.5">
                <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                <span>Kaprodi</span>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <span class="text-gray-600 font-medium">Profil Saya</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Profil Saya</h1>
            <p class="text-sm text-gray-400 mt-0.5">Informasi akun dan data identitas Anda</p>
        </div>
        <a href="{{ route('kaprodi.profile.edit') }}"
            class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-700 border border-gray-200 px-4 py-2 rounded-lg bg-white hover:bg-gray-50 transition shadow-sm">
            <span class="material-symbols-outlined !text-[16px]">edit</span>
            Edit Profil
        </a>
    </div>

    {{-- ═══ PROFILE CARD ═══ --}}
    <div class="card overflow-hidden">

        {{-- Profile Banner --}}
        <div class="h-24 bg-gradient-to-r from-gray-100 via-gray-50 to-white border-b border-gray-100 relative">
            <div class="absolute inset-0 opacity-30"
                style="background-image: radial-gradient(circle at 20% 50%, #e0e7ff 0%, transparent 60%), radial-gradient(circle at 80% 20%, #fef3c7 0%, transparent 50%);">
            </div>
        </div>

        {{-- Avatar + Identity --}}
        <div class="px-6 pb-5 -mt-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div class="flex items-end gap-4">
                {{-- Avatar --}}
                @if($user->foto_profile)
                    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                        class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-md ring-1 ring-gray-200">
                @else
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 border-4 border-white shadow-md flex items-center justify-center ring-1 ring-gray-200">
                        <span class="text-2xl font-bold text-white uppercase">
                            {{ \Illuminate\Support\Str::substr($user->name, 0, 1) }}
                        </span>
                    </div>
                @endif

                {{-- Name + Role --}}
                <div class="mb-1">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100 capitalize">
                            <span class="material-symbols-outlined !text-[11px]">verified</span>
                            {{ $user->role }}
                        </span>
                        @if($user->jabatan)
                            <span class="text-xs text-gray-400">{{ $user->jabatan }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-[11px] text-gray-400 mb-1 sm:text-right">
                Bergabung sejak<br>
                <span class="font-medium text-gray-500">{{ $user->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    {{-- ═══ DETAIL INFO ═══ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- Informasi Akun --}}
        <div class="card">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                <span class="material-symbols-outlined !text-[15px] text-gray-400">person</span>
                <span class="text-sm font-medium text-gray-700">Informasi Akun</span>
            </div>
            <div class="px-5">
                <div class="info-row">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value break-all">{{ $user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Role</span>
                    <span class="info-value capitalize">{{ $user->role }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Bergabung</span>
                    <span class="info-value">{{ $user->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- Informasi Tambahan --}}
        <div class="card">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                <span class="material-symbols-outlined !text-[15px] text-gray-400">badge</span>
                <span class="text-sm font-medium text-gray-700">Informasi Jabatan</span>
            </div>
            <div class="px-5">
                <div class="info-row">
                    <span class="info-label">NIP</span>
                    <span class="info-value font-mono">{{ $user->nip ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jabatan</span>
                    <span class="info-value">{{ $user->jabatan ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status Foto Profil</span>
                    @if($user->foto_profile)
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600">
                            <span class="material-symbols-outlined !text-[13px]">check_circle</span>
                            Sudah ada foto
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-400">
                            <span class="material-symbols-outlined !text-[13px]">radio_button_unchecked</span>
                            Belum ada foto
                        </span>
                    @endif
                </div>
                <div class="info-row">
                    <span class="info-label">Terakhir Diperbarui</span>
                    <span class="info-value">{{ $user->updated_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ CTA edit ═══ --}}
    <div class="card px-5 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-400 !text-[15px]">info</span>
            </div>
            <p class="text-sm text-gray-600">Ingin memperbarui informasi atau mengganti password?</p>
        </div>
        <a href="{{ route('kaprodi.profile.edit') }}"
            class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 px-3.5 py-2 rounded-lg hover:bg-gray-50 transition whitespace-nowrap">
            <span class="material-symbols-outlined !text-[15px]">edit</span>
            Edit Profil
        </a>
    </div>

</div>
@endsection

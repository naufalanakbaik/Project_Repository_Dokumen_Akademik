@extends('kaprodi.layouts.app')
@section('title', 'Detail Aktivitas Pengguna')

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
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-card); box-shadow: var(--shadow-card);
    }
    .badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 4px 10px; border-radius: 6px;
        font-size: 12px; font-weight: 500; border: 1px solid;
    }
    .badge-blue   { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
    .badge-green  { background:#f0fdf4; color:#15803d; border-color:#bbf7d0; }
    .badge-gray   { background:#f9fafb; color:#4b5563; border-color:#e5e7eb; }
    .meta-label {
        font-size: 11px; font-weight: 600; text-transform: uppercase;
        letter-spacing: .06em; color: var(--text-muted); margin-bottom: 4px;
    }
    .meta-value { font-size: 14px; color: var(--text-primary); font-weight: 500; }
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 6px; padding: 8px 16px; border-radius: 8px;
        border: 1px solid var(--border); color: var(--text-secondary);
        background: var(--surface); transition: var(--transition);
        text-decoration: none; font-size: 13px; font-weight: 500;
    }
    .action-btn:hover {
        background: #f9fafb; border-color: #d1d5db; color: var(--text-primary);
    }
</style>
@endpush

@section('content')
<div class="space-y-5 pb-6">

    {{-- ═══ BREADCRUMB & BACK ═══ --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-1.5 text-xs text-gray-400">
            <span class="material-symbols-outlined !text-[13px]">grid_view</span>
            <span>Kaprodi</span>
            <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
            <a href="{{ route('kaprodi.activity.index') }}" class="hover:text-gray-600 transition">Log Aktivitas</a>
            <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
            <span class="text-gray-600 font-medium">Detail Aktivitas</span>
        </div>
        <a href="{{ route('kaprodi.activity.index') }}"
            class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-700 transition border border-gray-200 rounded-lg px-3 py-1.5 bg-white">
            <span class="material-symbols-outlined !text-[14px]">arrow_back</span>
            Kembali
        </a>
    </div>

    {{-- ═══ DETAIL CARD ═══ --}}
    <div class="card px-6 py-5">
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl border flex items-center justify-center flex-shrink-0
                    {{ $log->action == 'download' ? 'bg-emerald-50 border-emerald-100 text-emerald-500' : 'bg-blue-50 border-blue-100 text-blue-500' }}">
                    <span class="material-symbols-outlined !text-[22px]">
                        {{ $log->action == 'download' ? 'download' : 'visibility' }}
                    </span>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-gray-900 capitalize break-words">
                        {{ $log->action }} Dokumen
                    </h1>
                    <p class="text-sm text-gray-500 mt-0.5">
                        {{ $log->created_at->translatedFormat('d F Y, H:i') }}
                        <span class="text-xs text-gray-400 ml-1">· {{ $log->created_at->diffForHumans() }}</span>
                    </p>
                </div>
            </div>
            <div>
                @if($log->action == 'download')
                    <span class="badge badge-green">
                        <span class="material-symbols-outlined !text-[13px]">download</span>
                        Download
                    </span>
                @else
                    <span class="badge badge-blue">
                        <span class="material-symbols-outlined !text-[13px]">visibility</span>
                        Preview
                    </span>
                @endif
            </div>
        </div>

        <div class="border-t border-gray-100 py-6 grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
            {{-- Bagian Pengguna --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined !text-[16px] text-gray-400">person</span>
                    Informasi Pengguna
                </h2>
                <div class="space-y-4">
                    <div>
                        <p class="meta-label">Nama Pengguna</p>
                        <div class="flex items-center gap-2.5 mt-1">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                <span class="text-white text-[10px] font-bold">
                                    {{ strtoupper(substr($log->user?->name ?? '?', 0, 1)) }}
                                </span>
                            </div>
                            <span class="meta-value">{{ $log->user?->name ?? 'Pengguna Dihapus' }}</span>
                        </div>
                    </div>
                    @if($log->user)
                    <div>
                        <p class="meta-label">Role</p>
                        <p class="meta-value capitalize">{{ $log->user->role }}</p>
                    </div>
                    <div>
                        <p class="meta-label">Identitas</p>
                        <p class="meta-value text-sm">{{ $log->user->nim ?? $log->user->nip ?? $log->user->email ?? '—' }}</p>
                    </div>
                    <div class="pt-2">
                        @if($log->user->role == 'mahasiswa')
                            <a href="{{ route('kaprodi.users.mahasiswa.show', $log->user->id) }}" class="action-btn">
                                <span class="material-symbols-outlined !text-[16px]">person</span>
                                Lihat Profil Mahasiswa
                            </a>
                        @elseif($log->user->role == 'dosen')
                            <a href="{{ route('kaprodi.users.dosen.show', $log->user->id) }}" class="action-btn">
                                <span class="material-symbols-outlined !text-[16px]">person</span>
                                Lihat Profil Dosen
                            </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            {{-- Bagian Dokumen --}}
            <div class="border-t sm:border-t-0 sm:border-l border-gray-100 pt-6 sm:pt-0 sm:pl-8">
                <h2 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined !text-[16px] text-gray-400">description</span>
                    Informasi Dokumen
                </h2>
                <div class="space-y-4">
                    <div>
                        <p class="meta-label">Judul Dokumen</p>
                        <div class="flex items-center gap-2.5 mt-1">
                            <div class="w-7 h-7 rounded-md bg-amber-50 border border-amber-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-amber-500 !text-[13px]">article</span>
                            </div>
                            <span class="meta-value break-words">{{ $log->document?->title ?? 'Dokumen Dihapus' }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="meta-label">ID Log</p>
                        <p class="meta-value font-mono text-xs text-gray-500">LOG-{{ str_pad($log->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    @if($log->document)
                    <div class="pt-2">
                        <a href="{{ route('kaprodi.documents.show', $log->document->id) }}" class="action-btn">
                            <span class="material-symbols-outlined !text-[16px]">description</span>
                            Lihat Detail Dokumen
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

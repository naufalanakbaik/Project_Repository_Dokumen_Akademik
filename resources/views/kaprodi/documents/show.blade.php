@extends('kaprodi.layouts.app')
@section('title', 'Detail Dokumen')

@push('styles')
<style>
    :root {
        --border: #e5e7eb;
        --border-hover: #d1d5db;
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
    .badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 2.5px 9px; border-radius: 6px;
        font-size: 11.5px; font-weight: 500; border: 1px solid;
    }
    .badge-blue   { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
    .badge-green  { background:#f0fdf4; color:#15803d; border-color:#bbf7d0; }
    .badge-red    { background:#fff1f2; color:#be123c; border-color:#fecdd3; }
    .badge-amber  { background:#fffbeb; color:#b45309; border-color:#fde68a; }
    .badge-gray   { background:#f9fafb; color:#4b5563; border-color:#e5e7eb; }
    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-card);
        padding: 20px;
        box-shadow: var(--shadow-card);
    }
    .meta-label {
        font-size: 11px; font-weight: 600; text-transform: uppercase;
        letter-spacing: .06em; color: var(--text-muted); margin-bottom: 4px;
    }
    .meta-value {
        font-size: 14px; color: var(--text-primary); font-weight: 500;
    }
    .data-table thead th {
        font-size: 11px; font-weight: 600; text-transform: uppercase;
        letter-spacing: .06em; color: var(--text-muted);
        padding: 10px 16px; background: var(--surface-subtle);
        border-bottom: 1px solid var(--border);
    }
    .data-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background .12s ease;
    }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table tbody td { padding: 10px 16px; font-size: 13px; color: #374151; }
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
            <a href="{{ route('kaprodi.documents.index') }}" class="hover:text-gray-600 transition">Daftar Dokumen</a>
            <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
            <span class="text-gray-600 font-medium line-clamp-1 max-w-[200px]">{{ $document->title }}</span>
        </div>
        <a href="{{ route('kaprodi.documents.index') }}"
            class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-700 transition border border-gray-200 rounded-lg px-3 py-1.5 bg-white">
            <span class="material-symbols-outlined !text-[14px]">arrow_back</span>
            Kembali
        </a>
    </div>

    {{-- ═══ HEADER INFO ═══ --}}
    <div class="card px-6 py-5">
        <div class="flex flex-col sm:flex-row sm:items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-amber-500 !text-[22px]">article</span>
            </div>
            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-semibold text-gray-900 tracking-tight break-words">{{ $document->title }}</h1>
                <div class="flex items-center gap-3 mt-2 flex-wrap">
                    @if($document->status == 'approved')
                        <span class="badge badge-green">
                            <span class="material-symbols-outlined !text-[11px]">check_circle</span>
                            Approved
                        </span>
                    @elseif($document->status == 'rejected')
                        <span class="badge badge-red">
                            <span class="material-symbols-outlined !text-[11px]">cancel</span>
                            Rejected
                        </span>
                    @else
                        <span class="badge badge-amber">
                            <span class="material-symbols-outlined !text-[11px]">schedule</span>
                            Pending
                        </span>
                    @endif
                    <span class="text-xs text-gray-400">Diunggah {{ $document->created_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('kaprodi.documents.preview', $document->id) }}" target="_blank"
                    class="inline-flex items-center gap-1.5 h-[36px] px-4 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[16px]">visibility</span>
                    Preview
                </a>
                <a href="{{ route('kaprodi.documents.download', $document->id) }}"
                    class="inline-flex items-center gap-1.5 h-[36px] px-4 rounded-lg bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                    <span class="material-symbols-outlined !text-[16px]">download</span>
                    Download
                </a>
            </div>
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-500 !text-[18px]">download</span>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $downloadCount }}</p>
                    <p class="text-xs text-gray-400">Total Download</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-500 !text-[18px]">visibility</span>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $previewCount }}</p>
                    <p class="text-xs text-gray-400">Total Preview</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-violet-50 border border-violet-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-violet-500 !text-[18px]">calendar_month</span>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $document->tahun_terbit ?? '—' }}</p>
                    <p class="text-xs text-gray-400">Tahun Terbit</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ METADATA ═══ --}}
    <div class="card px-6 py-5">
        <h2 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined !text-[16px] text-gray-400">info</span>
            Informasi Dokumen
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <p class="meta-label">Kategori</p>
                <p class="meta-value">
                    @if($document->category)
                        <span class="badge badge-blue">{{ $document->category->name }}</span>
                    @else
                        <span class="text-gray-400">—</span>
                    @endif
                </p>
            </div>
            <div>
                <p class="meta-label">Pengunggah</p>
                <div class="flex items-center gap-2 mt-1">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-[9px] font-bold leading-none">
                            {{ strtoupper(substr($document->user?->name ?? '?', 0, 1)) }}
                        </span>
                    </div>
                    <span class="meta-value">{{ $document->user?->name ?? '—' }}</span>
                </div>
            </div>
            <div>
                <p class="meta-label">Role Pengunggah</p>
                <p class="meta-value capitalize">{{ $document->user?->role ?? '—' }}</p>
            </div>
            <div>
                <p class="meta-label">Tanggal Unggah</p>
                <p class="meta-value">{{ $document->created_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <div>
                <p class="meta-label">Status Dokumen</p>
                <p class="meta-value capitalize">{{ $document->status }}</p>
            </div>
            <div>
                <p class="meta-label">File</p>
                <p class="meta-value text-xs text-gray-500 break-all">{{ $document->file }}</p>
            </div>
        </div>

        @if($document->status == 'rejected' && $document->reject_note)
        <div class="mt-5 p-4 bg-red-50 border border-red-100 rounded-lg">
            <p class="text-xs font-semibold text-red-700 mb-1 flex items-center gap-1.5">
                <span class="material-symbols-outlined !text-[14px]">error</span>
                Alasan Penolakan
            </p>
            <p class="text-sm text-red-600">{{ $document->reject_note }}</p>
        </div>
        @endif
    </div>

    {{-- ═══ ACTIVITY LOG ═══ --}}
    <div class="card overflow-hidden">
        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
            <span class="material-symbols-outlined !text-[16px] text-gray-400">history</span>
            <span class="text-sm font-medium text-gray-700">Riwayat Aktivitas</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full data-table">
                <thead>
                    <tr>
                        <th class="text-left w-8">#</th>
                        <th class="text-left">Pengguna</th>
                        <th class="text-center">Tipe</th>
                        <th class="text-left">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($document->logs as $i => $log)
                        <tr>
                            <td class="text-xs text-gray-300 font-mono">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-[9px] font-bold">
                                            {{ strtoupper(substr($log->user?->name ?? '?', 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-[13px] font-medium text-gray-900">{{ $log->user?->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($log->action == 'download')
                                    <span class="badge badge-green">
                                        <span class="material-symbols-outlined !text-[11px]">download</span>
                                        Download
                                    </span>
                                @else
                                    <span class="badge badge-blue">
                                        <span class="material-symbols-outlined !text-[11px]">visibility</span>
                                        Preview
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="text-[13px] text-gray-500">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                <span class="text-[11px] text-gray-400 ml-1">· {{ $log->created_at->diffForHumans() }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-gray-300 !text-[20px]">event_busy</span>
                                    </div>
                                    <p class="text-sm text-gray-400">Belum ada aktivitas pada dokumen ini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

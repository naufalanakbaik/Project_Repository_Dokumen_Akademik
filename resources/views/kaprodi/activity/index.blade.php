@extends('kaprodi.layouts.app')
@section('title', 'Aktivitas Pengguna')

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
        transition: var(--transition);
    }
    .input-field {
        height: 38px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 13px;
        padding: 0 12px;
        color: var(--text-primary);
        background: var(--surface);
        transition: var(--transition);
        width: 100%;
    }
    .input-field:focus {
        outline: none;
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }
    .data-table thead th {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: var(--text-muted);
        padding: 10px 16px;
        background: var(--surface-subtle);
        border-bottom: 1px solid var(--border);
    }
    .data-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background .12s ease;
    }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table tbody td { padding: 11px 16px; font-size: 13.5px; color: #374151; }
    .badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 2.5px 9px; border-radius: 6px;
        font-size: 11.5px; font-weight: 500; border: 1px solid;
    }
    .badge-blue    { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
    .badge-green   { background:#f0fdf4; color:#15803d; border-color:#bbf7d0; }
    .badge-gray    { background:#f9fafb; color:#4b5563; border-color:#e5e7eb; }
    .stat-pill {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px; font-weight: 500; color: var(--text-secondary);
        background: var(--surface-subtle); border: 1px solid var(--border);
        border-radius: 99px; padding: 4px 12px;
    }

    /* Action type color dots */
    .action-dot-download { background: #10b981; }
    .action-dot-preview  { background: #3b82f6; }
</style>
@endpush

@section('content')
<div class="space-y-5 pb-6">

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-1">
        <div>
            <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-1.5">
                <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                <span>Kaprodi</span>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <span class="text-gray-600 font-medium">Aktivitas Pengguna</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Log Aktivitas Pengguna</h1>
            <p class="text-sm text-gray-400 mt-0.5">Riwayat lengkap aktivitas pengguna dalam sistem repositori</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <span class="stat-pill">
                <span class="material-symbols-outlined !text-[14px] text-emerald-400">timeline</span>
                {{ $logs->total() }} log
            </span>
            <span class="text-xs text-gray-400 bg-white border border-gray-200 rounded-lg px-3 py-2 flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined !text-[14px] text-gray-400">event</span>
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    {{-- ═══ FILTER BAR ═══ --}}
    <div class="card px-5 py-4">
        <form method="GET" action="{{ route('kaprodi.activity') }}"
              class="flex flex-col md:flex-row items-stretch md:items-center gap-3">

            {{-- Search --}}
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[16px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama pengguna atau judul dokumen..."
                    class="input-field pl-9">
            </div>

            {{-- Action Filter --}}
            <div class="relative w-full md:w-48">
                <select name="action" class="input-field appearance-none pl-3 pr-9 text-gray-600">
                    <option value="">Semua Aktivitas</option>
                    <option value="preview"  {{ request('action') == 'preview'  ? 'selected' : '' }}>Preview</option>
                    <option value="download" {{ request('action') == 'download' ? 'selected' : '' }}>Download</option>
                </select>
                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[16px]">expand_more</span>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="submit"
                    class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-lg bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                    <span class="material-symbols-outlined !text-[15px]">filter_alt</span>
                    Filter
                </button>
                <a href="{{ route('kaprodi.activity') }}"
                    class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[15px]">refresh</span>
                    Reset
                </a>
            </div>
        </form>

        @if(request('search') || request('action'))
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                <span class="material-symbols-outlined !text-[13px]">filter_alt</span>
                Filter aktif:
                @if(request('search'))
                    <span class="badge badge-blue">Pencarian: "{{ request('search') }}"</span>
                @endif
                @if(request('action'))
                    <span class="badge badge-blue">Tipe: {{ ucfirst(request('action')) }}</span>
                @endif
            </div>
        @endif
    </div>

    {{-- ═══ ACTIVITY TABLE ═══ --}}
    <div class="card overflow-hidden">

        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined !text-[16px] text-gray-400">history</span>
                <span class="text-sm font-medium text-gray-700">Riwayat Aktivitas</span>
            </div>
            <div class="flex items-center gap-3 text-xs text-gray-400">
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full action-dot-download inline-block"></span>Download</span>
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full action-dot-preview inline-block"></span>Preview</span>
                <span>Halaman {{ $logs->currentPage() }} / {{ $logs->lastPage() }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full data-table">
                <thead>
                    <tr>
                        <th class="text-left w-8">#</th>
                        <th class="text-left">Pengguna</th>
                        <th class="text-left">Dokumen</th>
                        <th class="text-center">Tipe Aktivitas</th>
                        <th class="text-left">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $i => $log)
                        <tr>
                            <td class="text-xs text-gray-300 font-mono">{{ str_pad($logs->firstItem() + $i, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-[10px] font-bold leading-none">
                                            {{ strtoupper(substr($log->user?->name ?? '?', 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="font-medium text-gray-900 text-[13.5px]">{{ $log->user?->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-md bg-amber-50 border border-amber-100 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-amber-400 !text-[12px]">article</span>
                                    </div>
                                    <span class="text-[13px] text-gray-600 line-clamp-1 max-w-[240px]" title="{{ $log->document?->title }}">
                                        {{ $log->document?->title ?? '—' }}
                                    </span>
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
                                <div>
                                    <p class="text-[13px] text-gray-600">{{ $log->created_at->format('d M Y') }}</p>
                                    <p class="text-[11px] text-gray-400 mt-0.5">{{ $log->created_at->format('H:i') }} · {{ $log->created_at->diffForHumans() }}</p>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-gray-300 !text-[22px]">event_busy</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-400">Tidak ada log aktivitas</p>
                                        @if(request('search') || request('action'))
                                            <p class="text-xs text-gray-300 mt-0.5">Coba ubah atau hapus filter pencarian</p>
                                            <a href="{{ route('kaprodi.activity') }}"
                                                class="inline-flex items-center gap-1.5 text-xs text-blue-600 hover:text-blue-700 mt-3 transition">
                                                <span class="material-symbols-outlined !text-[13px]">refresh</span>
                                                Reset filter
                                            </a>
                                        @else
                                            <p class="text-xs text-gray-300 mt-0.5">Log aktivitas akan muncul setelah ada pengguna yang mengakses dokumen</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/40">
            {{ $logs->links('vendor.pagination.tailwind-darkmode') }}
        </div>
        @endif
    </div>

</div>
@endsection

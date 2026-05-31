@extends('kaprodi.layouts.app')
@section('title', 'Daftar Dokumen')

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
    .badge-blue   { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
    .badge-green  { background:#f0fdf4; color:#15803d; border-color:#bbf7d0; }
    .badge-red    { background:#fff1f2; color:#be123c; border-color:#fecdd3; }
    .badge-amber  { background:#fffbeb; color:#b45309; border-color:#fde68a; }
    .badge-gray   { background:#f9fafb; color:#4b5563; border-color:#e5e7eb; }
    .stat-pill {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px; font-weight: 500; color: var(--text-secondary);
        background: var(--surface-subtle); border: 1px solid var(--border);
        border-radius: 99px; padding: 4px 12px;
    }
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: 7px;
        border: 1px solid var(--border);
        color: var(--text-muted);
        background: var(--surface);
        transition: var(--transition);
        text-decoration: none;
    }
    .action-btn:hover { border-color: var(--border-hover); }
    .action-btn.preview:hover  { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
    .action-btn.download:hover { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
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
                <span class="text-gray-600 font-medium">Daftar Dokumen</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Daftar Dokumen Akademik</h1>
            <p class="text-sm text-gray-400 mt-0.5">Pantau seluruh dokumen mahasiswa dan dosen dalam sistem repositori</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <span class="stat-pill">
                <span class="material-symbols-outlined !text-[14px] text-amber-400">folder_open</span>
                {{ $documents->total() }} dokumen
            </span>
            <span class="text-xs text-gray-400 bg-white border border-gray-200 rounded-lg px-3 py-2 flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined !text-[14px] text-gray-400">event</span>
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    {{-- ═══ FILTER BAR ═══ --}}
    <div class="card px-5 py-4">
        <form method="GET" action="{{ route('kaprodi.documents.index') }}"
            class="flex flex-col md:flex-row items-stretch md:items-center gap-3">

            {{-- Search --}}
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[16px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul dokumen..."
                    class="input-field pl-9">
            </div>

            {{-- Kategori --}}
            <div class="relative w-full md:w-48">
                <select name="category_id" class="input-field appearance-none pl-3 pr-9 text-gray-600">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[16px]">expand_more</span>
            </div>

            {{-- Status --}}
            <div class="relative w-full md:w-44">
                <select name="status" class="input-field appearance-none pl-3 pr-9 text-gray-600">
                    <option value="">Semua Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[16px]">expand_more</span>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="submit"
                    class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-lg bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                    <span class="material-symbols-outlined !text-[15px]">filter_alt</span>
                    Filter
                </button>
                <a href="{{ route('kaprodi.documents.index') }}"
                    class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[15px]">refresh</span>
                    Reset
                </a>
            </div>
        </form>

        @if(request('search') || request('category_id') || request('status'))
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-2 flex-wrap text-xs text-gray-500">
                <span class="material-symbols-outlined !text-[13px]">filter_alt</span>
                Filter aktif:
                @if(request('search'))
                    <span class="badge badge-blue">Judul: "{{ request('search') }}"</span>
                @endif
                @if(request('category_id'))
                    @php $cat = $categories->firstWhere('id', request('category_id')); @endphp
                    <span class="badge badge-blue">Kategori: {{ $cat?->name }}</span>
                @endif
                @if(request('status'))
                    <span class="badge badge-blue">Status: {{ ucfirst(request('status')) }}</span>
                @endif
            </div>
        @endif
    </div>

    {{-- ═══ TABLE ═══ --}}
    <div class="card overflow-hidden">

        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined !text-[16px] text-gray-400">description</span>
                <span class="text-sm font-medium text-gray-700">Daftar Dokumen</span>
            </div>
            <span class="text-xs text-gray-400">Halaman {{ $documents->currentPage() }} / {{ $documents->lastPage() }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full data-table">
                <thead>
                    <tr>
                        <th class="text-left w-8">#</th>
                        <th class="text-left">Judul Dokumen</th>
                        <th class="text-left">Kategori</th>
                        <th class="text-left">Pengunggah</th>
                        <th class="text-center">Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $i => $doc)
                        <tr>
                            <td class="text-xs text-gray-300 font-mono">{{ str_pad($documents->firstItem() + $i, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-md bg-amber-50 border border-amber-100 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-amber-400 !text-[14px]">article</span>
                                    </div>
                                    <!-- <span class="font-medium text-gray-900 line-clamp-1 max-w-[240px]" title="{{ $doc->title }}">
                                        {{ $doc->title }}
                                    </span> -->
                                    <a href="{{ route('kaprodi.documents.show', $doc->id) }}" class="font-medium text-gray-900 line-clamp-1 max-w-[240px]">
                                        {{ $doc->title }}
                                    </a>    
                                </div>
                            </td>
                            <td>
                                @if($doc->category)
                                    <span class="badge badge-blue">{{ $doc->category->name }}</span>
                                @else
                                    <span class="badge badge-gray">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5">
                                    <div class="w-5 h-5 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-[9px] font-bold leading-none">
                                            {{ strtoupper(substr($doc->user?->name ?? '?', 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-[13px] text-gray-600">{{ $doc->user?->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($doc->status == 'approved')
                                    <span class="badge badge-green">
                                        <span class="material-symbols-outlined !text-[11px]">check_circle</span>
                                        Approved
                                    </span>
                                @elseif($doc->status == 'rejected')
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
                            </td>
                            <td>
                                <div class="flex justify-end items-center gap-1.5">
                                    <a href="{{ route('kaprodi.documents.preview', $doc->id) }}"
                                        target="_blank"
                                        class="action-btn preview"
                                        title="Preview dokumen">
                                        <span class="material-symbols-outlined !text-[16px]">visibility</span>
                                    </a>
                                    <a href="{{ route('kaprodi.documents.download', $doc->id) }}"
                                        class="action-btn download"
                                        title="Download dokumen">
                                        <span class="material-symbols-outlined !text-[16px]">download</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-gray-300 !text-[22px]">folder_off</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-400">Dokumen tidak ditemukan</p>
                                        @if(request('search') || request('category_id') || request('status'))
                                            <p class="text-xs text-gray-300 mt-0.5">Coba ubah atau hapus filter pencarian</p>
                                            <a href="{{ route('kaprodi.documents.index') }}"
                                                class="inline-flex items-center gap-1.5 text-xs text-blue-600 hover:text-blue-700 mt-3 transition">
                                                <span class="material-symbols-outlined !text-[13px]">refresh</span>
                                                Reset filter
                                            </a>
                                        @else
                                            <p class="text-xs text-gray-300 mt-0.5">Belum ada dokumen yang diunggah ke sistem</p>
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
        @if($documents->hasPages())
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/40">
            {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
        </div>
        @endif
    </div>

</div>
@endsection

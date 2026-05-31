@extends('kaprodi.layouts.app')
@section('title', 'Daftar Dosen')

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
        height: 38px; border: 1px solid var(--border); border-radius: 8px;
        font-size: 13px; padding: 0 12px; color: var(--text-primary);
        background: var(--surface); transition: var(--transition); width: 100%;
    }
    .input-field:focus {
        outline: none; border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
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
    .data-table tbody td { padding: 11px 16px; font-size: 13.5px; color: #374151; }
    .badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 2.5px 9px; border-radius: 6px;
        font-size: 11.5px; font-weight: 500; border: 1px solid;
    }
    .badge-blue   { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
    .badge-gray   { background:#f9fafb; color:#4b5563; border-color:#e5e7eb; }
    .stat-pill {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px; font-weight: 500; color: var(--text-secondary);
        background: var(--surface-subtle); border: 1px solid var(--border);
        border-radius: 99px; padding: 4px 12px;
    }
    .detail-btn {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 5px 12px; border-radius: 7px;
        font-size: 12px; font-weight: 500;
        border: 1px solid var(--border); color: var(--text-secondary);
        background: var(--surface); transition: var(--transition);
        text-decoration: none;
    }
    .detail-btn:hover {
        background: #f9fafb; border-color: var(--border-hover);
        color: var(--text-primary);
    }
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
                <span class="text-gray-600 font-medium">Daftar Dosen</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900 tracking-tight">Daftar Dosen</h1>
            <p class="text-sm text-gray-400 mt-0.5">Pantau data dan aktivitas unggah dokumen seluruh dosen</p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <span class="stat-pill">
                <span class="material-symbols-outlined !text-[14px] text-emerald-400">person</span>
                {{ $dosen->total() }} dosen
            </span>
            <span class="text-xs text-gray-400 bg-white border border-gray-200 rounded-lg px-3 py-2 flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined !text-[14px] text-gray-400">event</span>
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    {{-- ═══ FILTER BAR ═══ --}}
    <div class="card px-5 py-4">
        <form method="GET" action="{{ route('kaprodi.users.dosen') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3">

            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[16px]">search</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau NIP dosen..."
                    class="input-field pl-9">
            </div>

            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="submit"
                    class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-lg bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                    <span class="material-symbols-outlined !text-[15px]">search</span>
                    Cari
                </button>
                <a href="{{ route('kaprodi.users.dosen') }}"
                    class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined !text-[15px]">refresh</span>
                    Reset
                </a>
            </div>
        </form>
        @if(request('search'))
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                <span class="material-symbols-outlined !text-[13px]">filter_alt</span>
                Filter aktif:
                <span class="badge badge-blue">Pencarian: "{{ request('search') }}"</span>
            </div>
        @endif
    </div>

    {{-- ═══ TABLE ═══ --}}
    <div class="card overflow-hidden">

        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined !text-[16px] text-gray-400">table_rows</span>
                <span class="text-sm font-medium text-gray-700">Data Dosen</span>
            </div>
            <span class="text-xs text-gray-400">Halaman {{ $dosen->currentPage() }} / {{ $dosen->lastPage() }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full data-table">
                <thead>
                    <tr>
                        <th class="text-left w-8">#</th>
                        <th class="text-left">Nama Dosen</th>
                        <th class="text-left">NIP</th>
                        <th class="text-left">Email</th>
                        <th class="text-center">Total Dokumen</th>
                        <th class="text-left">Upload Terakhir</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dosen as $i => $item)
                        <tr>
                            <td class="text-xs text-gray-300 font-mono">{{ str_pad($dosen->firstItem() + $i, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-xs font-bold leading-none">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <!-- <span class="font-medium text-gray-900 block">{{ $item->name }}</span> -->
                                        <a href="{{ route('kaprodi.users.dosen.show', $item->id) }}" class="font-medium text-gray-900">
                                        {{ $item->name }}
                                    </a>
                                        @if($item->jabatan)
                                            <span class="text-[11px] text-gray-400">{{ $item->jabatan }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-[13px] text-gray-600 font-mono">{{ $item->nip ?? '—' }}</span>
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5 text-gray-500 text-[13px]">
                                    <span class="material-symbols-outlined !text-[13px] text-gray-300">mail</span>
                                    {{ $item->email }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item->documents_count > 0)
                                    <span class="badge badge-blue">
                                        <span class="material-symbols-outlined !text-[11px]">description</span>
                                        {{ $item->documents_count }}
                                    </span>
                                @else
                                    <span class="badge badge-gray">0</span>
                                @endif
                            </td>
                            <td>
                                @if($item->documents->first())
                                    <div class="flex items-center gap-1.5 text-[13px] text-gray-500">
                                        <span class="material-symbols-outlined !text-[13px] text-gray-300">schedule</span>
                                        {{ $item->documents->first()->created_at->format('d M Y') }}
                                    </div>
                                @else
                                    <span class="text-gray-300 text-xs">Belum upload</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('kaprodi.users.dosen.show', $item->id) }}" class="detail-btn">
                                    <span class="material-symbols-outlined !text-[14px]">visibility</span>
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-gray-300 !text-[22px]">group_off</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-400">Tidak ada dosen ditemukan</p>
                                        <p class="text-xs text-gray-300 mt-0.5">Coba ubah atau hapus filter pencarian</p>
                                    </div>
                                    <a href="{{ route('kaprodi.users.dosen') }}"
                                        class="inline-flex items-center gap-1.5 text-xs text-blue-600 hover:text-blue-700 transition">
                                        <span class="material-symbols-outlined !text-[13px]">refresh</span>
                                        Reset filter
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($dosen->hasPages())
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/40">
            {{ $dosen->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

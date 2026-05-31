@extends('kaprodi.layouts.app')
@section('title', 'Detail Dosen')

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
        padding: 2.5px 9px; border-radius: 6px;
        font-size: 11.5px; font-weight: 500; border: 1px solid;
    }
    .badge-blue   { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
    .badge-green  { background:#f0fdf4; color:#15803d; border-color:#bbf7d0; }
    .badge-red    { background:#fff1f2; color:#be123c; border-color:#fecdd3; }
    .badge-amber  { background:#fffbeb; color:#b45309; border-color:#fde68a; }
    .badge-gray   { background:#f9fafb; color:#4b5563; border-color:#e5e7eb; }
    .stat-card {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-card); padding: 20px; box-shadow: var(--shadow-card);
    }
    .meta-label {
        font-size: 11px; font-weight: 600; text-transform: uppercase;
        letter-spacing: .06em; color: var(--text-muted); margin-bottom: 4px;
    }
    .meta-value { font-size: 14px; color: var(--text-primary); font-weight: 500; }
    .data-table thead th {
        font-size: 11px; font-weight: 600; text-transform: uppercase;
        letter-spacing: .06em; color: var(--text-muted);
        padding: 10px 16px; background: var(--surface-subtle);
        border-bottom: 1px solid var(--border);
    }
    .data-table tbody tr {
        border-bottom: 1px solid #f3f4f6; transition: background .12s ease;
    }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table tbody td { padding: 11px 16px; font-size: 13.5px; color: #374151; }
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: 7px;
        border: 1px solid var(--border); color: var(--text-muted);
        background: var(--surface); transition: var(--transition);
        text-decoration: none;
    }
    .action-btn:hover { border-color: #d1d5db; }
    .action-btn.view:hover { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
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
            <a href="{{ route('kaprodi.users.dosen') }}" class="hover:text-gray-600 transition">Daftar Dosen</a>
            <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
            <span class="text-gray-600 font-medium">{{ $user->name }}</span>
        </div>
        <a href="{{ route('kaprodi.users.dosen') }}"
            class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-700 transition border border-gray-200 rounded-lg px-3 py-1.5 bg-white">
            <span class="material-symbols-outlined !text-[14px]">arrow_back</span>
            Kembali
        </a>
    </div>

    {{-- ═══ PROFILE HEADER ═══ --}}
    <div class="card px-6 py-5">
        <div class="flex items-start gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xl font-bold leading-none">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
            </div>
            <div class="flex-1">
                <h1 class="text-xl font-semibold text-gray-900 tracking-tight">{{ $user->name }}</h1>
                <div class="flex items-center gap-3 mt-1 text-sm text-gray-400 flex-wrap">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[14px]">mail</span>
                        {{ $user->email }}
                    </span>
                    @if($user->nip)
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined !text-[14px]">badge</span>
                        {{ $user->nip }}
                    </span>
                    @endif
                    @if($user->jabatan)
                    <span class="badge badge-gray">{{ $user->jabatan }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ STAT CARDS ═══ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-500 !text-[18px]">description</span>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $user->documents_count }}</p>
                    <p class="text-xs text-gray-400">Total Dokumen</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-500 !text-[18px]">check_circle</span>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $statusCounts['approved'] ?? 0 }}</p>
                    <p class="text-xs text-gray-400">Approved</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-violet-50 border border-violet-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-violet-500 !text-[18px]">download</span>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalDownloads }}</p>
                    <p class="text-xs text-gray-400">Total Download</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 border border-amber-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-amber-500 !text-[18px]">visibility</span>
                </div>
                <div>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalPreviews }}</p>
                    <p class="text-xs text-gray-400">Total Preview</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ PROFILE DETAILS ═══ --}}
    <div class="card px-6 py-5">
        <h2 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined !text-[16px] text-gray-400">person</span>
            Profil Dosen
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <p class="meta-label">Nama Lengkap</p>
                <p class="meta-value">{{ $user->name }}</p>
            </div>
            <div>
                <p class="meta-label">Email</p>
                <p class="meta-value">{{ $user->email }}</p>
            </div>
            <div>
                <p class="meta-label">NIP</p>
                <p class="meta-value">{{ $user->nip ?? '—' }}</p>
            </div>
            <div>
                <p class="meta-label">Jabatan Akademik</p>
                <p class="meta-value">{{ $user->jabatan ?? '—' }}</p>
            </div>
            <div>
                <p class="meta-label">Bergabung Pada</p>
                <p class="meta-value">{{ $user->created_at->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    </div>

    {{-- ═══ DOCUMENTS TABLE ═══ --}}
    <div class="card overflow-hidden">

        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined !text-[16px] text-gray-400">description</span>
                <span class="text-sm font-medium text-gray-700">Riwayat Unggahan Dokumen</span>
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
                        <th class="text-center">Status</th>
                        <th class="text-left">Tanggal</th>
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
                                    <span class="font-medium text-gray-900 line-clamp-1 max-w-[220px]" title="{{ $doc->title }}">
                                        {{ $doc->title }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                @if($doc->category)
                                    <span class="badge badge-blue">{{ $doc->category->name }}</span>
                                @else
                                    <span class="badge badge-gray">—</span>
                                @endif
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
                                <span class="text-[13px] text-gray-500">{{ $doc->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('kaprodi.documents.show', $doc->id) }}"
                                    class="action-btn view" title="Lihat detail">
                                    <span class="material-symbols-outlined !text-[16px]">visibility</span>
                                </a>
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
                                        <p class="text-sm font-medium text-gray-400">Belum ada dokumen yang diunggah</p>
                                        <p class="text-xs text-gray-300 mt-0.5">Dokumen akan muncul setelah dosen mengunggah</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($documents->hasPages())
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/40">
            {{ $documents->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

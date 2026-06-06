@extends('kaprodi.layouts.app')
@section('title', 'Daftar Kategori')

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
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --transition: all .18s cubic-bezier(.4, 0, .2, 1);
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
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
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

        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .data-table tbody tr:hover {
            background: #f9fafb;
        }

        .data-table tbody td {
            padding: 11px 16px;
            font-size: 13.5px;
            color: #374151;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2.5px 9px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 500;
            border: 1px solid;
        }

        .badge-blue {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .badge-gray {
            background: #f9fafb;
            color: #4b5563;
            border-color: #e5e7eb;
        }

        .stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-secondary);
            background: var(--surface-subtle);
            border: 1px solid var(--border);
            border-radius: 99px;
            padding: 4px 12px;
        }

        .detail-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid var(--border);
            color: var(--text-secondary);
            background: var(--surface);
            transition: var(--transition);
            text-decoration: none;
        }

        .detail-btn:hover {
            background: #f9fafb;
            border-color: var(--border-hover);
            color: var(--text-primary);
        }
    </style>
@endpush

@section('content')
    <div class="space-y-5 pb-6">

        {{-- ═══ Page Header ═══ --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-1">
            <div>
                <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-1.5">
                    <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                    <span>Kaprodi</span>
                    <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                    <span class="text-gray-700 font-medium">Daftar Kategori</span>
                </div>
                <h1 class="text-[22px] font-semibold text-gray-900 tracking-tight">Daftar Kategori Dokumen</h1>
                <p class="text-[13px] text-blue-500">Kelola dan pantau seluruh kategori dokumen akademik</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="stat-pill">
                    <span class="material-symbols-outlined !text-[14px] text-violet-400">folder</span>
                    {{ $categories->total() }} kategori
                </span>
                <span class="stat-pill">
                    <span class="material-symbols-outlined !text-[14px] text-amber-400">folder_open</span>
                    {{ $totalDocuments }} dokumen
                </span>
            </div>
        </div>

        {{-- ═══ Filter bar ═══ --}}
        <div class="card px-5 py-4">
            <form method="GET" action="{{ route('kaprodi.categories.index') }}"
                class="flex flex-col md:flex-row items-stretch md:items-center gap-3">

                <div class="relative flex-1">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[16px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..."
                        class="input-field pl-9">
                </div>

                <div class="flex items-center gap-2 flex-shrink-0">
                    <button type="submit"
                        class="inline-flex items-center gap-1 h-[38px] px-4 rounded-lg bg-blue-50 text-blue-700 text-[13px] font-medium 
                        border border-blue-300 hover:bg-blue-100 transition shadow-sm">
                        <span class="material-symbols-outlined !text-[15px]">filter_alt</span>
                        Filter
                    </button>
                    <a href="{{ route('kaprodi.categories.index') }}"
                        class="inline-flex items-center gap-1 h-[38px] px-4 rounded-lg border border-gray-300 bg-gray-50 text-[13px] font-medium text-gray-600 
                        hover:bg-gray-100 transition">
                        <span class="material-symbols-outlined !text-[15px]">refresh</span>
                        Reset
                    </a>
                </div>
            </form>

            @if (request('search'))
                <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                    <span class="material-symbols-outlined !text-[13px]">filter_alt</span>
                    Filter aktif:
                    <span class="badge badge-blue">Nama: "{{ request('search') }}"</span>
                </div>
            @endif
        </div>

        {{-- ═══ Table kategori ═══ --}}
        <div class="card overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100 bg-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-md border border-violet-200 bg-violet-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-violet-600 !text-[19px]">
                                folder
                            </span>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-gray-900">
                                Data Kategori
                            </h2>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Total
                                <span class="font-medium text-gray-700">
                                    {{ number_format($categories->total()) }}
                                </span>
                                kategori tersedia
                            </p>
                        </div>
                    </div>

                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md border border-gray-200 bg-gray-50">
                        <span class="material-symbols-outlined text-gray-500 !text-[14px]">
                            layers
                        </span>
                        <span class="text-xs font-medium text-gray-700">
                            Halaman {{ $categories->currentPage() }}
                        </span>
                        <span class="text-gray-300">/</span>
                        <span class="text-xs text-gray-500">
                            {{ $categories->lastPage() }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full data-table">
                    <thead>
                        <tr class="bg-gray-50/70 border-t border-b border-gray-100 text-[11px] uppercase tracking-wider text-gray-600">
                            <th class="px-5 py-3 text-left font-medium w-[5%]">
                                No
                            </th>
                            <th class="px-6 py-3 text-left font-medium w-[45%]">
                                Kategori
                            </th>
                            <th class="px-6 py-3 text-center font-medium w-[20%]">
                                Dokumen
                            </th>
                            <th class="px-6 py-3 text-left font-medium w-[15%]">
                                Dibuat
                            </th>
                            <th class="px-6 py-3 text-left font-medium w-[15%]">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $i => $category)
                            <tr>
                                <td class="text-xs text-gray-300 font-mono">
                                    {{ str_pad($categories->firstItem() + $i, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="flex items-center gap-2.5">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-violet-50 border border-violet-100 flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="material-symbols-outlined text-violet-400 !text-[15px]">folder</span>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if ($category->documents_count > 0)
                                        <span class="badge badge-blue">
                                            <span class="material-symbols-outlined !text-[11px]">description</span>
                                            {{ $category->documents_count }} dokumen
                                        </span>
                                    @else
                                        <span class="badge badge-gray">0 dokumen</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-1.5 text-[13px] text-gray-500">
                                        <span class="material-symbols-outlined !text-[13px] text-gray-300">schedule</span>
                                        {{ $category->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="text-left">
                                    <a href="{{ route('kaprodi.categories.show', $category->id) }}" class="detail-btn">
                                        <span class="material-symbols-outlined !text-[14px]">visibility</span>
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                            <span
                                                class="material-symbols-outlined text-gray-300 !text-[22px]">folder_off</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-400">Kategori tidak ditemukan</p>
                                            @if (request('search'))
                                                <p class="text-xs text-gray-300 mt-0.5">Coba ubah atau hapus filter
                                                    pencarian</p>
                                                <a href="{{ route('kaprodi.categories.index') }}"
                                                    class="inline-flex items-center gap-1.5 text-xs text-blue-600 hover:text-blue-700 mt-3 transition">
                                                    <span class="material-symbols-outlined !text-[13px]">refresh</span>
                                                    Reset filter
                                                </a>
                                            @else
                                                <p class="text-xs text-gray-300 mt-0.5">Belum ada kategori dalam sistem</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($categories->hasPages())
                <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/40">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection

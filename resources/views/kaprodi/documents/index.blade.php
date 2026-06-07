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
            --radius-card: 9px;
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

        /* .data-table thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-muted);
            padding: 10px 16px;
            background: var(--surface-subtle);
            border-bottom: 1px solid var(--border);
        } */

        /* .data-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background .12s ease;
        } */

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

        .badge-green {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }

        .badge-red {
            background: #fff1f2;
            color: #be123c;
            border-color: #fecdd3;
        }

        .badge-amber {
            background: #fffbeb;
            color: #b45309;
            border-color: #fde68a;
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

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 7px;
            border: 1px solid var(--border);
            color: var(--text-muted);
            background: var(--surface);
            transition: var(--transition);
            text-decoration: none;
        }

        .action-btn:hover {
            border-color: var(--border-hover);
        }

        .action-btn.preview:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .action-btn.download:hover {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-5 pb-6">

        {{-- ═══ Page Header ═══ --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-1">
            <div>
                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-1.5">
                    <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                    <span>Kaprodi</span>
                    <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                    <span class="text-gray-700 font-medium">Daftar Dokumen</span>
                </div>
                <h1 class="text-[22px] font-semibold text-gray-900 tracking-tight">Daftar Dokumen Akademik</h1>
                <p class="text-[13px] text-blue-500">Pantau seluruh dokumen mahasiswa dan dosen dalam sistem repositori
                </p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="stat-pill">
                    <span class="material-symbols-outlined !text-[14px] text-amber-400">folder_open</span>
                    {{ $documents->total() }} dokumen
                </span>
                <span
                    class="flex items-center gap-1.5 text-xs text-gray-500 bg-white border border-gray-200 rounded-md px-3.5 py-2 shadow-sm">
                    <span class="material-symbols-outlined !text-[14px] text-gray-400">calendar_check</span>
                    {{ now()->translatedFormat(' d F Y') }}
                </span>
            </div>
        </div>

        {{-- ═══ Filter bar ═══ --}}
        <div class="card px-5 py-4">
            <form method="GET" action="{{ route('kaprodi.documents.index') }}"
                class="flex flex-col md:flex-row items-stretch md:items-center gap-3">

                {{-- Search --}}
                <div class="relative flex-1">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[16px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul dokumen..."
                        class="input-field pl-9">
                </div>

                {{-- Kategori --}}
                <div class="relative w-full md:w-44">
                    <select name="category_id" class="input-field appearance-none pl-4 pr-9 text-gray-600">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <span
                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[16px]">
                        expand_more
                    </span>
                </div>

                {{-- Status --}}
                <div class="relative w-full md:w-44">
                    <select name="status" class="input-field appearance-none pl-4 pr-9 text-gray-600">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <span
                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[16px]">expand_more</span>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button type="submit"
                        class="inline-flex items-center gap-1 h-[38px] px-4 rounded-lg bg-blue-50 text-blue-700 text-[13px] font-medium 
                        border border-blue-300 hover:bg-blue-100 transition shadow-sm">
                        <span class="material-symbols-outlined !text-[15px]">filter_alt</span>
                        Filter
                    </button>
                    <a href="{{ route('kaprodi.documents.index') }}"
                        class="inline-flex items-center gap-1 h-[38px] px-4 rounded-lg border border-gray-300 bg-gray-50 text-[13px] font-medium text-gray-600 
                        hover:bg-gray-100 transition">
                        <span class="material-symbols-outlined !text-[15px]">refresh</span>
                        Reset
                    </a>
                </div>
            </form>

            @if (request('search') || request('category_id') || request('status'))
                <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-2 flex-wrap text-xs text-gray-500">
                    <span class="material-symbols-outlined !text-[13px]">filter_alt</span>
                    Filter aktif:
                    @if (request('search'))
                        <span class="badge badge-blue">Judul: "{{ request('search') }}"</span>
                    @endif
                    @if (request('category_id'))
                        @php $cat = $categories->firstWhere('id', request('category_id')); @endphp
                        <span class="badge badge-blue">Kategori: {{ $cat?->name }}</span>
                    @endif
                    @if (request('status'))
                        <span class="badge badge-blue">Status: {{ ucfirst(request('status')) }}</span>
                    @endif
                </div>
            @endif
        </div>

        {{-- ═══ Tabel dokumen ═══ --}}
        <div class="card overflow-hidden">
            {{-- Header tabel --}}
            <div class="px-6 py-4 border-b border-gray-100 bg-white">
                <div class="flex items-center justify-between">
                    {{-- Left --}}
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-md border border-blue-200 bg-blue-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600 !text-[19px]">
                                description
                            </span>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-gray-900">
                                Daftar Dokumen
                            </h2>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Total <span
                                    class="font-medium text-gray-700">{{ number_format($documents->total()) }}</span>
                                dokumen tersimpan
                            </p>
                        </div>
                    </div>

                    {{-- Right --}}
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md border border-gray-200 bg-gray-50">
                        <span class="material-symbols-outlined text-gray-500 !text-[14px]">
                            layers
                        </span>
                        <span class="text-xs font-medium text-gray-700">
                            Halaman {{ $documents->currentPage() }}
                        </span>
                        <span class="text-gray-300">
                            /
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $documents->lastPage() }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="w-full data-table">
                    <thead>
                        <tr
                            class="bg-gray-50/70 border-t border-b border-gray-100 text-[11px] uppercase tracking-wider text-gray-600">
                            <th class="px-5 py-3 text-left font-medium w-[5%]">
                                No
                            </th>
                            <th class="px-6 py-3 text-left font-medium w-[45%]">
                                Dokumen
                            </th>
                            <th class="px-6 py-3 text-left font-medium w-[20%]">
                                Pengunggah
                            </th>
                            <th class="px-6 py-3 text-left font-medium w-[15%]">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left font-medium w-[10%]">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($documents as $i => $doc)
                            <tr class="transition-colors">

                                {{-- No --}}
                                <td class="px-5 py-5 align-top">
                                    <span class="text-xs font-mono text-gray-400">
                                        {{ str_pad($documents->firstItem() + $i, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Dokumen --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-11 h-11 rounded-lg border border-red-200 bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-red-500 !text-[18px]">
                                                article
                                            </span>
                                        </div>
                                        <div class="min-w-0 max-w-[400px]">
                                            <a href="{{ route('kaprodi.documents.show', $doc->id) }}"
                                                class="block text-sm font-semibold text-gray-900 hover:text-black truncate"
                                                title="{{ $doc->title }}">
                                                {{ Str::limit($doc->title, 60) }}
                                            </a>
                                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                                @if ($doc->category)
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-50 text-slate-700
                                                        border border-gray-200 text-[11px] font-medium">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                                        {{ $doc->category->name }}
                                                    </span>
                                                @endif

                                                <span class="text-xs text-gray-500">
                                                    {{ $doc->created_at->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Pengunggah --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700 
                                            border border-amber-300 flex items-center justify-center flex-shrink-0">
                                            <span class="text-xs font-semibold">
                                                {{ strtoupper(substr($doc->user?->name ?? '?', 0, 1)) }}
                                            </span>
                                        </div>

                                        <div class="min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $doc->user?->name ?? 'Unknown User' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Pengunggah
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-5 text-center">
                                    @if ($doc->status == 'approved')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border 
                                            border-emerald-200 text-emerald-700 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                            Approved
                                        </span>
                                    @elseif($doc->status == 'rejected')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-rose-50 border border-rose-200 
                                            text-rose-700 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                            Rejected
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-200 
                                            text-amber-700 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-5">
                                    <div class="flex justify-end">
                                        <div
                                            class="flex items-center rounded-md border border-gray-200 bg-white overflow-hidden">
                                            <a href="{{ route('kaprodi.documents.preview', $doc->id) }}" target="_blank"
                                                class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 transition">
                                                <span class="material-symbols-outlined text-gray-600 !text-[18px]">
                                                    picture_as_pdf
                                                </span>
                                            </a>
                                            <div class="w-px h-5 bg-gray-300"></div>
                                            <a href="{{ route('kaprodi.documents.download', $doc->id) }}"
                                                class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 transition">
                                                <span class="material-symbols-outlined text-gray-600 !text-[18px]">
                                                    download
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-14 h-14 rounded-2xl bg-gray-50 border border-gray-200 flex items-center justify-center mb-4">
                                            <span class="material-symbols-outlined text-gray-300 !text-[24px]">
                                                folder_off
                                            </span>
                                        </div>

                                        <h3 class="text-sm font-medium text-gray-700">
                                            Dokumen tidak ditemukan
                                        </h3>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Belum ada dokumen yang tersedia.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($documents->hasPages())
                <div class="px-6 py-6 border-t border-gray-100 bg-gray-50/40">
                    {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
                </div>
            @endif
        </div>

    </div>
@endsection

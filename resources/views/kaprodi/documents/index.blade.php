@extends('kaprodi.layouts.app')
@section('title', 'Monitoring Dokumen')

@push('styles')
    <style>
        .filter-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 18px;
            transition: box-shadow .2s ease;
        }

        .filter-card:hover {
            box-shadow: 0 4px 16px -3px rgba(0, 0, 0, .05);
        }

        .doc-tbl thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #6b7280;
        }

        .doc-tbl tbody tr {
            transition: background .15s ease;
        }

        .doc-tbl tbody tr:hover {
            background: #f9fafb;
        }

        .input-field {
            height: 40px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-field:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
            outline: none;
        }

        .btn-filter {
            height: 40px;
            padding: 0 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s ease;
        }
    </style>
@endpush

@section('content')

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-xl border border-gray-200/80 bg-white px-6 py-5 mb-6 shadow-sm">

        {{-- Decorative circle --}}
        <div class="absolute -top-12 -right-12 w-44 h-44 bg-gradient-to-br from-amber-200 to-orange-100 rounded-full blur-3xl opacity-30"></div>

        <div class="relative flex items-start justify-between gap-5">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 mb-3 rounded-full border border-amber-300 bg-amber-50">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span class="text-[11px] font-semibold tracking-wide uppercase text-amber-700">Repository
                        Monitoring</span>
                </div>
                <h1 class="text-[30px] font-semibold text-gray-900 tracking-tight">Monitoring Dokumen Akademik</h1>
                <p class="text-[13px] text-blue-500 leading-relaxed">
                    Pantau seluruh dokumen akademik mahasiswa dan dosen dalam sistem repository Program Studi.
                </p>
            </div>
            <div class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-amber-200 bg-amber-50">
                <span class="material-symbols-outlined text-amber-600 !text-[23px]">monitoring</span>
            </div>
        </div>

        <div class="mt-5 pt-4 border-t border-dashed border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Total Dokumen:
                <span class="font-semibold text-gray-700">{{ $documents->total() }}</span>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <span class="material-symbols-outlined !text-[15px]">calendar_check</span>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="space-y-3 mb-6">
        <div class="pl-3">
            <h2 class="text-[24px] font-semibold text-gray-900">Daftar Dokumen</h2>
            <p class="text-[13px] text-gray-400 leading-tight">Monitoring seluruh dokumen repository</p>
        </div>

        <div class="filter-card rounded-xl">
            <form method="GET" action="{{ route('kaprodi.documents.index') }}" class="flex flex-col gap-3 lg:flex-row lg:items-center">

                {{-- Search --}}
                <div class="relative w-full lg:max-w-sm">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul dokumen..."
                        class="input-field w-full pl-10 pr-3">
                </div>

                {{-- Kategori --}}
                <div class="relative">
                    <select name="category_id" class="input-field appearance-none text-gray-600 pl-3 pr-9">
                        <option value="">Semua kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <span
                        class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[18px]">expand_more</span>
                </div>

                {{-- Status --}}
                <div class="relative">
                    <select name="status" class="input-field appearance-none text-gray-600 pl-3 pr-9">
                        <option value="">Semua status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <span
                        class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[18px]">expand_more</span>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-filter bg-blue-600 text-white hover:bg-blue-700 shadow-sm">
                        <span class="material-symbols-outlined !text-[17px]">filter_alt</span>
                        Filter
                    </button>

                    <a href="{{ route('kaprodi.documents.index') }}"
                        class="btn-filter border border-gray-300 text-gray-600 hover:bg-gray-50">
                        <span class="material-symbols-outlined !text-[17px]">refresh</span>
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white border border-gray-200/80 rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm doc-tbl">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-5 py-3 text-center w-14">No</th>
                        <th class="px-5 py-3 text-left">Judul</th>
                        <th class="px-5 py-3 text-left">Kategori</th>
                        <th class="px-5 py-3 text-left">Pengguna</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($documents as $key=>$doc)
                        <tr>
                            <td class="px-5 py-3.5 text-center text-gray-400 text-xs">
                                {{ $documents->firstItem() + $key }}
                            </td>

                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 flex-shrink-0">
                                        <span class="material-symbols-outlined text-amber-500 !text-[16px]">article</span>
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $doc->title }}</span>
                                </div>
                            </td>

                            <td class="px-5 py-3.5">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-gray-100 text-gray-600">
                                    {{ $doc->category?->name }}
                                </span>
                            </td>

                            <td class="px-5 py-3.5 text-gray-600">{{ $doc->user?->name }}</td>

                            <td class="px-5 py-3.5 text-center">
                                @if ($doc->status == 'approved')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="material-symbols-outlined !text-[13px]">check_circle</span>
                                        Approved
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-red-50 text-red-700 border border-red-200">
                                        <span class="material-symbols-outlined !text-[13px]">cancel</span>
                                        Rejected
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-3.5">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('kaprodi.documents.preview', $doc->id) }}" target="_blank"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg hover:bg-blue-50 text-gray-400 hover:text-blue-600 transition"
                                        title="Preview">
                                        <span class="material-symbols-outlined !text-[18px]">visibility</span>
                                    </a>
                                    <a href="{{ route('kaprodi.documents.download', $doc->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition"
                                        title="Download">
                                        <span class="material-symbols-outlined !text-[18px]">download</span>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-gray-300 !text-[28px]">folder_off</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-400">Dokumen tidak ditemukan</p>
                                        <p class="text-xs text-gray-300 mt-0.5">Coba ubah filter pencarian Anda</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
            {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
        </div>
    </div>

@endsection

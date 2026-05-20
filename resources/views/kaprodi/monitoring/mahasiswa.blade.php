@extends('kaprodi.layouts.app')
@section('title', 'Monitoring Mahasiswa')

@push('styles')
    <style>
        .mhs-tbl thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #6b7280;
        }

        .mhs-tbl tbody tr {
            transition: background .15s ease;
        }

        .mhs-tbl tbody tr:hover {
            background: #f9fafb;
        }

        .search-field {
            height: 42px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-field:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
            outline: none;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="relative overflow-hidden rounded-xl border border-gray-200/80 bg-white px-6 py-5 mb-6 shadow-sm">
            <div
                class="absolute -top-12 -right-12 w-44 h-44 bg-gradient-to-br from-cyan-200 to-blue-100 rounded-full blur-3xl opacity-30">
            </div>
            <div class="relative flex items-start justify-between gap-5">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 mb-3 rounded-full border border-cyan-200 bg-cyan-50">
                        <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                        <span class="text-[11px] font-semibold tracking-wide uppercase text-cyan-700">Student
                            Monitoring</span>
                    </div>
                    <h1 class="text-[30px] font-semibold text-gray-900 tracking-tight">Monitoring Mahasiswa</h1>
                    <p class="text-[13px] text-blue-500 leading-relaxed">Monitoring aktivitas unggah dokumen mahasiswa</p>
                </div>
                <div
                    class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-cyan-200 bg-cyan-50">
                    <span class="material-symbols-outlined text-cyan-600 !text-[23px]">school</span>
                </div>
            </div>
            <div class="mt-5 pt-4 border-t border-dashed border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Total Mahasiswa:
                    <span class="font-semibold text-gray-700">{{ $mahasiswa->total() }}</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <span class="material-symbols-outlined !text-[15px]">calendar_month</span>
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>


        {{-- Filter --}}
        <div class="bg-white border border-gray-200/80 rounded-2xl p-5 shadow-sm">
            <form method="GET" action="{{ route('kaprodi.monitoring.mahasiswa') }}"
                class="flex flex-col md:flex-row gap-3">

                <div class="relative flex-1">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau email mahasiswa..." class="search-field w-full pl-10 pr-3">
                </div>

                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">date_range</span>
                    <input type="number" name="angkatan" value="{{ request('angkatan') }}" placeholder="Angkatan"
                        class="search-field w-36 pl-10 pr-3">
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 shadow-sm transition">
                        <span class="material-symbols-outlined !text-[17px]">search</span>
                        Cari
                    </button>
                    <a href="{{ route('kaprodi.monitoring.mahasiswa') }}"
                        class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl border border-gray-300 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        <span class="material-symbols-outlined !text-[17px]">refresh</span>
                        Reset
                    </a>
                </div>
            </form>
        </div>


        {{-- Table --}}
        <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full mhs-tbl">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-100">
                            <th class="px-6 py-3 text-left">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-center">Total Dokumen</th>
                            <th class="px-6 py-3 text-center">Upload Terakhir</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($mahasiswa as $item)
                            <tr>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex-shrink-0">
                                            <span
                                                class="text-white text-xs font-bold">{{ strtoupper(substr($item->name, 0, 1)) }}</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $item->name }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-2 text-sm text-gray-500">
                                        <span class="material-symbols-outlined !text-[15px] text-gray-300">mail</span>
                                        {{ $item->email }}
                                    </div>
                                </td>

                                <td class="px-6 py-3.5 text-center">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold
                                {{ $item->documents_count > 0 ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-gray-100 text-gray-400' }}">
                                        <span class="material-symbols-outlined !text-[13px]">description</span>
                                        {{ $item->documents_count }}
                                    </span>
                                </td>

                                <td class="px-6 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5 text-sm text-gray-400">
                                        <span class="material-symbols-outlined !text-[14px]">schedule</span>
                                        {{ $item->latestDocument?->created_at?->format('d M Y') ?? '-' }}
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-16">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center">
                                            <span
                                                class="material-symbols-outlined text-gray-300 !text-[28px]">group_off</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-400">Belum ada data mahasiswa</p>
                                            <p class="text-xs text-gray-300 mt-0.5">Data mahasiswa akan muncul di sini</p>
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
                {{ $mahasiswa->links() }}
            </div>
        </div>
    </div>

@endsection

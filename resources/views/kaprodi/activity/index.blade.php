@extends('kaprodi.layouts.app')
@section('title', 'Aktivitas Pengguna')

@push('styles')
    <style>
        .activity-tbl thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #6b7280;
        }

        .activity-tbl tbody tr {
            transition: background .15s ease;
        }

        .activity-tbl tbody tr:hover {
            background: #f9fafb;
        }

        .search-input {
            height: 42px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-input:focus {
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
                class="absolute -top-12 -right-12 w-44 h-44 bg-gradient-to-br from-indigo-200 to-blue-100 rounded-full blur-3xl opacity-30">
            </div>

            <div class="relative flex items-start justify-between gap-5">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 mb-3 rounded-full border border-indigo-200 bg-indigo-50">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                        <span class="text-[11px] font-semibold tracking-wide uppercase text-indigo-700">Activity Log</span>
                    </div>
                    <h1 class="text-[30px] font-semibold text-gray-900 tracking-tight">Monitoring Aktivitas</h1>
                    <p class="text-[13px] text-blue-500 leading-relaxed">Riwayat aktivitas pengguna dalam sistem repository</p>
                </div>
                <div
                    class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-indigo-200 bg-indigo-50">
                    <span class="material-symbols-outlined text-indigo-600 !text-[23px]">timeline</span>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-dashed border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Total Log:
                    <span class="font-semibold text-gray-700">{{ $logs->total() }}</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <span class="material-symbols-outlined !text-[15px]">calendar_month</span>
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>


        {{-- Filter --}}
        <div class="bg-white border border-gray-200/80 rounded-2xl p-5 shadow-sm">
            <form method="GET" action="{{ route('kaprodi.activity') }}" class="flex flex-col md:flex-row gap-3">

                <div class="relative flex-1">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[18px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari pengguna atau dokumen..." class="search-input w-full pl-10 pr-3">
                </div>

                <div class="relative">
                    <select name="action" class="search-input appearance-none pl-3 pr-9 min-w-[160px]">
                        <option value="">Semua Aktivitas</option>
                        <option value="preview" {{ request('action') == 'preview' ? 'selected' : '' }}>Preview</option>
                        <option value="download" {{ request('action') == 'download' ? 'selected' : '' }}>Download</option>
                    </select>
                    <span
                        class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none !text-[18px]">expand_more</span>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 shadow-sm transition">
                        <span class="material-symbols-outlined !text-[17px]">filter_alt</span>
                        Filter
                    </button>
                    <a href="{{ route('kaprodi.activity') }}"
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
                <table class="w-full activity-tbl">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-100">
                            <th class="px-6 py-3 text-left">Pengguna</th>
                            <th class="px-6 py-3 text-left">Dokumen</th>
                            <th class="px-6 py-3 text-center">Aktivitas</th>
                            <th class="px-6 py-3 text-center">Waktu</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($logs as $log)
                            <tr>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 flex-shrink-0">
                                            <span class="material-symbols-outlined text-blue-500 !text-[16px]">person</span>
                                        </div>
                                        <span
                                            class="text-sm font-medium text-gray-800">{{ $log->user?->name ?? '-' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="material-symbols-outlined text-gray-300 !text-[16px]">description</span>
                                        <span class="text-sm text-gray-600">{{ $log->document?->title ?? '-' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-3.5 text-center">
                                    @if ($log->action == 'download')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="material-symbols-outlined !text-[13px]">download</span>
                                            Download
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="material-symbols-outlined !text-[13px]">visibility</span>
                                            Preview
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5 text-sm text-gray-400">
                                        <span class="material-symbols-outlined !text-[14px]">schedule</span>
                                        {{ $log->created_at->format('d M Y H:i') }}
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-16">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center">
                                            <span
                                                class="material-symbols-outlined text-gray-300 !text-[28px]">event_busy</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-400">Belum ada aktivitas</p>
                                            <p class="text-xs text-gray-300 mt-0.5">Data aktivitas akan muncul di sini</p>
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
                {{ $logs->links() }}
            </div>
        </div>
    </div>

@endsection

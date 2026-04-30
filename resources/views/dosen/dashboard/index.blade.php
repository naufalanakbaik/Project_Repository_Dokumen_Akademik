@extends('dosen.layouts.app')
@section('title', 'Monitoring Dashboard')

@section('content')

    {{-- Header --}}
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-6">
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-blue-700 !text-[24px]">
                monitoring
            </span>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Monitoring Aktivitas Mahasiswa
                </h3>
                <p class="text-sm text-gray-500 mt-0.5 leading-relaxed">
                    Pantau aktivitas unggah dan unduh dokumen untuk memahami tingkat keaktifan mahasiswa secara real-time.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Summary Stats --}}
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">

            <div class="flex items-center justify-between mb-5">
                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                    Ringkasan Aktivitas
                </h4>
                <span class="material-symbols-outlined text-gray-600 !text-[20px]">
                    insights
                </span>
            </div>

            {{-- Insight upload dan download --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:shadow-sm transition">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-500">Total Unggah</span>
                        <span class="material-symbols-outlined text-indigo-500 !text-[18px]">
                            upload
                        </span>
                    </div>
                    <p class="text-2xl font-semibold text-gray-800">
                        {{ $stats['total_uploads'] }}
                    </p>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 hover:shadow-sm transition">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-500">Total Unduh</span>
                        <span class="material-symbols-outlined text-emerald-500 !text-[18px]">
                            download
                        </span>
                    </div>
                    <p class="text-2xl font-semibold text-gray-800">
                        {{ $stats['total_downloads'] }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Recent Activities User --}}
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b bg-white">
                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                    Aktivitas Terbaru
                </h4>
                <span class="material-symbols-outlined text-gray-600 !text-[20px]">
                    history
                </span>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">Mahasiswa</th>
                            <th class="px-6 py-3 text-left font-medium">Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($recentActivities->where('user.role', 'mahasiswa') as $log)
                            <tr class="hover:bg-gray-50 transition">

                                {{-- User --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-sm font-semibold">
                                            {{ strtoupper(substr($log->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="text-gray-800 font-medium">
                                            {{ $log->user->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Activity --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-gray-400 !text-[18px] mt-0.5">
                                            {{ $log->action === 'upload' ? 'upload' : 'download' }}
                                        </span>
                                        <div>
                                            <p class="text-gray-900 font-medium leading-tight">
                                                {{ ucfirst($log->action) }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $log->document->title ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($recentActivities->where('user.role', 'mahasiswa')->isEmpty())
                            <tr>
                                <td colspan="2" class="px-6 py-6 text-center text-sm text-gray-500">
                                    Belum ada aktivitas mahasiswa.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@extends('mahasiswa.layouts.app')
@section('title', 'Dashboard')

@section('content')

    {{-- Card stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <!-- Card -->
        <div class="group bg-white p-5 rounded-lg border border-gray-300 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-600">Total Dokumen</span>
                <span class="material-icons !text-[25px] text-gray-600 group-hover:text-gray-700 transition">description</span>
            </div>
            <h2 class="text-3xl font-semibold text-gray-900">
                {{ $stats['my_documents'] ?? 0 }}
            </h2>
        </div>

        <!-- Card -->
        <div class="group bg-white p-5 rounded-lg border border-gray-300 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-600">Disetujui</span>
                <span class="material-icons !text-[25px] text-green-600 group-hover:text-green-700 transition">verified</span>
            </div>
            <h2 class="text-3xl font-semibold text-green-700">
                {{ $stats['approved'] ?? 0 }}
            </h2>
        </div>

        <!-- Card -->
        <div class="group bg-white p-5 rounded-lg border border-gray-300 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-600">Menunggu</span>
                <span class="material-icons !text-[25px] text-yellow-600 group-hover:text-yellow-700 transition">schedule</span>
            </div>
            <h2 class="text-3xl font-semibold text-yellow-600">
                {{ ($stats['my_documents'] ?? 0) - ($stats['approved'] ?? 0) }}
            </h2>
        </div>
    </div>

    {{-- Activitas --}}
    <div class="bg-white rounded-lg border border-gray-300 shadow-sm overflow-hidden">

        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-900">Aktivitas Terbaru</h3>
                <p class="text-xs text-gray-500">Riwayat upload & download dokumen</p>
            </div>

            <a href="{{ route('mahasiswa.documents.index') }}"
                class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1">
                Lihat semua
                <span class="material-icons !text-[20px]">read_more</span>
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-6 py-3 font-medium text-left">Dokumen</th>
                        <th class="px-6 py-3 font-medium text-left">Aksi</th>
                        <th class="px-6 py-3 font-medium text-left">Waktu</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($recentActivities->where('user_id', auth()->id()) as $log)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- Dokumen -->
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3">
                                    <span class="material-icons text-gray-500 mt-1">description</span>
                                    <div>
                                        <p class="font-medium text-gray-900 leading-tight">
                                            {{ $log->document->title ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $log->document->category->name ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4">
                                @if ($log->action == 'upload')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-md bg-blue-50 text-blue-700 border border-blue-100">
                                        <span class="material-icons text-[14px]">upload</span>
                                        Upload
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-md bg-gray-50 text-gray-700 border border-gray-200">
                                        <span class="material-icons text-[14px]">download</span>
                                        Download
                                    </span>
                                @endif
                            </td>

                            <!-- Waktu -->
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $log->created_at->diffForHumans() }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-icons text-3xl text-gray-300">inbox</span>
                                    <p class="text-sm">Belum ada aktivitas</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection
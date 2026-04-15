@extends('admin.layouts.app')
@section('title', 'Monitoring Pengguna')

@section('content')

    {{-- Header --}}
    <div class="mb-5">
        <h1 class="text-xl font-semibold text-gray-950">
            Monitoring Pengguna
        </h1>
        <p class="text-xs text-blue-600 mt-0.5">
            Pantau aktivitas dan data pengguna secara real-time.
        </p>
    </div>

    {{-- Statistic Card --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-5">

        {{-- Total Users --}}
        <div
            class="bg-white p-5 rounded-xl shadow-sm border border-slate-300 flex items-center justify-between 
            hover:shadow-md transition">
            <div>
                <p class="text-[12.5px] text-gray-500">All Users</p>
                <h2 class="text-2xl font-semibold text-gray-700 mt-2">
                    {{ $userStats['total_users'] }}
                </h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-slate-50 border border-slate-300 text-slate-700 hover:bg-slate-200 transition">
                <span class="material-symbols-outlined !text-xl">groups</span>
            </div>
        </div>


        {{-- Admin --}}
        <div
            class="bg-white p-5 rounded-xl shadow-sm border border-red-300 flex items-center justify-between 
            hover:shadow-md transition">
            <div>
                <p class="text-[12.5px] text-gray-500">Admin</p>
                <h2 class="text-2xl font-semibold text-gray-700 mt-2">
                    {{ $userStats['admin'] }}
                </h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-red-50 border border-red-300 text-red-700 hover:bg-red-200 transition">
                <span class="material-symbols-outlined !text-xl">shield_person</span>
            </div>
        </div>

        {{-- Dosen --}}
        <div
            class="bg-white p-5 rounded-xl shadow-sm border border-green-300 flex items-center justify-between 
            hover:shadow-md transition">
            <div>
                <p class="text-[12.5px] text-gray-500">Dosen</p>
                <h2 class="text-2xl font-semibold text-gray-700 mt-1">
                    {{ $userStats['dosen'] }}
                </h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-green-50 border border-green-300 text-green-700 hover:bg-green-200 transition">
                <span class="material-symbols-outlined !text-xl">article_person</span>
            </div>
        </div>

        {{-- Mahasiswa --}}
        <div
            class="bg-white p-5 rounded-xl shadow-sm border border-blue-300 flex items-center justify-between 
            hover:shadow-md transition">
            <div>
                <p class="text-[12.5px] text-gray-500">Mahasiswa</p>
                <h2 class="text-2xl font-semibold text-gray-700 mt-2">
                    {{ $userStats['mahasiswa'] }}
                </h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-blue-50 border border-blue-300 text-blue-700 hover:bg-blue-200 transition">
                <span class="material-symbols-outlined !text-xl">diversity_2</span>
            </div>
        </div>

        {{-- Kaprodi --}}
        <div
            class="bg-white p-5 rounded-xl shadow-sm border border-yellow-300 flex items-center justify-between 
            hover:shadow-md transition">
            <div>
                <p class="text-[12.5px] text-gray-500">Kaprodi</p>
                <h2 class="text-2xl font-semibold text-gray-700 mt-2">
                    {{ $userStats['kaprodi'] }}
                </h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-yellow-50 border border-yellow-300 text-yellow-700 hover:bg-yellow-200 transition">
                <span class="material-symbols-outlined !text-xl">school</span>
            </div>
        </div>

    </div>


    {{-- Table log aktivitas --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-300 px-8 py-7">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 gap-3">
            <div>
                <h2 class="text-lg font-medium text-gray-800">Log Aktivitas Pengguna</h2>
                <p class="text-xs text-blue-600">Riwayat aktivitas terbaru pengguna dalam sistem</p>
            </div>
            <!-- (Optional future filter) -->
            {{-- <div class="flex gap-2">
                <select class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                    <option>Semua Aktivitas</option>
                    <option>Upload</option>
                    <option>Download</option>
                </select>
            </div> --}}
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="text-sm">
                    <tr class="text-gray-700 border-b border-gray-300">
                        <th class="font-medium py-3 px-2">User</th>
                        <th class="font-medium py-3 px-2">Aksi</th>
                        <th class="font-medium py-3 px-2">Dokumen</th>
                        <th class="font-medium py-3 px-2">Waktu</th>
                    </tr>
                </thead>

                <!-- Body table -->
                <tbody class="text-gray-700">
                    @forelse($userActivities as $log)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- Name user -->
                            <td class="py-3 px-2">
                                <div class="flex flex-col">
                                    <span class="text-[14px] font-medium">
                                        {{ $log->user->name ?? 'User tidak ditemukan' }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        {{ $log->user->email ?? '-' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Action -->
                            <td class="py-3 px-2">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-normal
                                @if ($log->action === 'upload') bg-green-100 text-green-700 border border-green-300
                                @elseif($log->action === 'download') bg-blue-100 text-blue-700 border border-blue-300
                                @else bg-gray-100 text-gray-700 border border-gray-300 @endif">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>

                            <!-- Dokumen -->
                            <td class="py-3 px-2">
                                <div class="flex flex-col">
                                    <span class="text-[12.5px] font-medium text-gray-800">
                                        {{ $log->document->title ?? 'Dokumen dihapus' }}
                                    </span>

                                    {{-- @if (isset($log->document))
                                        <span class="text-xs text-gray-400">
                                            ID: {{ $log->document->id }}
                                        </span>
                                    @endif --}}
                                </div>
                            </td>

                            <!-- Time -->
                            <td class="py-3 px-2">
                                <div class="flex flex-col">
                                    <span class="text-[14px] text-gray-700">{{ $log->created_at->format('d M Y') }}</span>
                                    <span class="text-xs text-gray-500">
                                        {{ $log->created_at->format('H:i') }}
                                        ({{ $log->created_at->diffForHumans() }})
                                    </span>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-400">
                                Belum ada aktivitas yang tercatat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

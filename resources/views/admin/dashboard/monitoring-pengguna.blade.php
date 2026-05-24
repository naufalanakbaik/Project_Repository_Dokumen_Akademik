@extends('admin.layouts.app')
@section('title', 'Monitoring Pengguna')

@section('content')

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-lg border border-gray-200/80 bg-white px-6 py-5 mb-5 shadow-sm">
        {{-- Soft Accent --}}
        <div class="absolute -top-10 -right-10 w-44 h-44 bg-indigo-100 rounded-full blur-3xl opacity-40">
        </div>

        <div class="relative flex items-start justify-between gap-5">
            {{-- Left Content --}}
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 mb-3 rounded-full border border-indigo-200 bg-indigo-50">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    <span class="text-[11px] font-semibold tracking-wide text-indigo-700 uppercase">
                        Monitoring Aktivitas
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 leading-tight">
                    Aktivitas Pengguna Sistem
                </h1>

                {{-- Description --}}
                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                    Pantau seluruh aktivitas pengguna dalam sistem repositori dokumen
                    akademik, mulai dari proses upload hingga download dokumen
                    yang dilakukan oleh mahasiswa, dosen, maupun admin.
                </p>
            </div>

            {{-- Right Decoration --}}
            <div
                class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-indigo-200 bg-indigo-50 shrink-0">
                <span class="material-symbols-outlined mt-1 text-indigo-600 !text-[24px]">
                    zone_person_alert
                </span>
            </div>
        </div>

        {{-- Bottom Info --}}
        <div
            class="mt-5 pt-4 border-t border-dashed border-gray-200 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            {{-- Status --}}
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Aktivitas pengguna tercatat secara realtime
            </div>

            {{-- Date --}}
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <span class="material-symbols-outlined !text-[15px]">
                    schedule
                </span>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{-- Header --}}
    <div class="ml-2.5 mb-3">
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
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-slate-50 border border-slate-300 text-slate-700 hover:bg-slate-200 transition">
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
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-red-50 border border-red-300 text-red-700 hover:bg-red-200 transition">
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
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-green-50 border border-green-300 text-green-700 hover:bg-green-200 transition">
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
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-blue-50 border border-blue-300 text-blue-700 hover:bg-blue-200 transition">
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
            <div
                class="w-12 h-12 flex items-center justify-center rounded-3xl shadow-sm bg-yellow-50 border border-yellow-300 text-yellow-700 hover:bg-yellow-200 transition">
                <span class="material-symbols-outlined !text-xl">school</span>
            </div>
        </div>
    </div>

    {{-- Table log aktivitas --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-[17px] font-semibold text-gray-900">
                        Log Aktivitas Pengguna
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Riwayat aktivitas terbaru pengguna dalam sistem
                    </p>
                </div>

                {{-- Optional filter --}}
                {{-- <div>
                    <select
                        class="text-sm rounded-md border border-gray-300 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Semua Aktivitas</option>
                    </select>
                </div> --}}
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                {{-- Table Head --}}
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase tracking-wider text-gray-500">
                        <th class="px-6 py-3 font-medium">
                            User
                        </th>
                        <th class="px-6 py-3 font-medium">
                            Aktivitas
                        </th>
                        <th class="px-6 py-3 font-medium">
                            Dokumen
                        </th>
                        <th class="px-6 py-3 font-medium">
                            Waktu
                        </th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-200">
                    @forelse($userActivities as $log)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            {{-- User --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    {{-- Avatar Initial --}}
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-sm font-medium text-gray-700">
                                        {{ strtoupper(substr($log->user->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $log->user->name ?? 'User tidak ditemukan' }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $log->user->email ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            {{-- Activity --}}
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium border

                                @if ($log->action === 'upload') bg-green-50 text-green-700 border-green-200
                                @elseif($log->action === 'download')
                                    bg-blue-50 text-blue-700 border-blue-200
                                @else
                                    bg-gray-50 text-gray-700 border-gray-200 @endif">
                                    @if ($log->action === 'upload')
                                        ↑ Upload
                                    @elseif($log->action === 'download')
                                        ↓ Download
                                    @else
                                        {{ ucfirst($log->action) }}
                                    @endif
                                </span>
                            </td>

                            {{-- Document --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-800">
                                        {{ $log->document->title ?? 'Dokumen dihapus' }}
                                    </span>
                                    @if (isset($log->document))
                                        <span class="text-xs text-gray-500">
                                            ID #{{ $log->document->id }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            {{-- Time --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-900">
                                        {{ $log->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $log->created_at->format('H:i') }}
                                        •
                                        {{ $log->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-14">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                        <span class="material-symbols-outlined text-gray-400">
                                            history
                                        </span>
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-700">
                                        Belum ada aktivitas
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Aktivitas pengguna akan muncul di sini
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

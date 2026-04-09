@extends('dosen.layouts.app')

@section('title', 'Monitoring Dashboard - Dosen')

@section('content')
<!-- Monitoring Aktivitas bagi Dosen -->
<div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 mb-8">
    <h3 class="text-xl font-bold text-slate-800 mb-2">Pantau Aktivitas Mahasiswa</h3>
    <p class="text-slate-500">Dosen dapat memantau aktivitas unggah dan unduh dokumen untuk mengetahui tingkat keaktifan mahasiswa.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Statistik Aktivitas -->
    <div class="bg-indigo-50 p-6 rounded-2xl">
        <h4 class="text-indigo-700 font-bold mb-4">Ringkasan Aktivitas Mahasiswa</h4>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <span class="text-slate-500 text-xs block mb-1">Total Unggah</span>
                <span class="text-2xl font-bold text-slate-900">{{ $stats['total_uploads'] }}</span>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <span class="text-slate-500 text-xs block mb-1">Total Unduh</span>
                <span class="text-2xl font-bold text-slate-900">{{ $stats['total_downloads'] }}</span>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 font-bold text-slate-800">Log Aktivitas Terbaru</div>
        <div class="p-0">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500 font-medium">
                    <tr>
                        <th class="px-6 py-3">Mahasiswa</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentActivities->where('user.role', 'mahasiswa') as $log)
                    <tr>
                        <td class="px-6 py-4">{{ $log->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-slate-900">{{ ucfirst($log->action) }}</span>
                            <span class="text-slate-500 text-xs block">{{ $log->document->title ?? '' }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('mahasiswa.layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card: Total Dokumen Saya -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <h3 class="text-slate-500 text-sm font-medium mb-1">Total Dokumen Saya</h3>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['my_documents'] ?? 0 }}</p>
    </div>

    <!-- Card: Dokumen Disetujui -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <h3 class="text-slate-500 text-sm font-medium mb-1">Disetujui</h3>
        <p class="text-3xl font-bold text-emerald-600">{{ $stats['approved'] ?? 0 }}</p>
    </div>

    <!-- Card: Menunggu Validasi -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <h3 class="text-slate-500 text-sm font-medium mb-1">Menunggu Validasi</h3>
        <p class="text-3xl font-bold text-indigo-600">{{ ($stats['my_documents'] ?? 0) - ($stats['approved'] ?? 0) }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-bold text-slate-800">Aktivitas Terbaru</h3>
        <a href="{{ route('mahasiswa.documents.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat Semua</a>
    </div>
    <div class="p-0">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Dokumen</th>
                    <th class="px-6 py-4">Aksi</th>
                    <th class="px-6 py-4">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentActivities->where('user_id', auth()->id()) as $log)
                <tr>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900">{{ $log->document->title ?? 'N/A' }}</div>
                        <div class="text-xs text-slate-500">{{ $log->document->category->name ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $log->action == 'upload' ? 'bg-blue-50 text-blue-700' : 'bg-slate-50 text-slate-700' }}">
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $log->created_at->diffForHumans() }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-slate-500">Belum ada aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

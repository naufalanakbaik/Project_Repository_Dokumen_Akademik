@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Statistik Utama -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="p-3 bg-indigo-50 rounded-xl mr-4"><svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
        <div>
            <h3 class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Total Dokumen</h3>
            <p class="text-2xl font-bold text-slate-900">{{ $stats['total_documents'] }}</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="p-3 bg-blue-50 rounded-xl mr-4"><svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
        <div>
            <h3 class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Pengguna</h3>
            <p class="text-2xl font-bold text-slate-900">{{ $stats['total_users'] }}</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="p-3 bg-emerald-50 rounded-xl mr-4"><svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg></div>
        <div>
            <h3 class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Unggahan</h3>
            <p class="text-2xl font-bold text-slate-900">{{ $stats['total_uploads'] }}</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="p-3 bg-amber-50 rounded-xl mr-4"><svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg></div>
        <div>
            <h3 class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Unduhan</h3>
            <p class="text-2xl font-bold text-slate-900">{{ $stats['total_downloads'] }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Distribusi Kategori -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <h3 class="font-bold text-slate-800 mb-6">Distribusi Dokumen</h3>
        <div class="space-y-4">
            @foreach($categoryDistribution as $cat)
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-slate-600">{{ $cat->name }}</span>
                    <span class="font-bold text-slate-900">{{ $cat->documents_count }}</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $stats['total_documents'] > 0 ? ($cat->documents_count / $stats['total_documents']) * 100 : 0 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Log Aktivitas -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Log Aktivitas Sistem</h3>
        </div>
        <div class="p-0">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Aksi</th>
                        <th class="px-6 py-4">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentActivities as $log)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-slate-900">{{ $log->user->name ?? 'System' }}</div>
                            <div class="text-xs text-slate-500 uppercase">{{ $log->user->role ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-600">
                                <strong>{{ ucfirst($log->action) }}</strong> {{ $log->document->title ?? 'Dokumen' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ $log->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('kaprodi.layouts.app')

@section('title', 'Dashboard Monitoring')

@section('content')
    <!-- Monitoring View (Kaprodi focus) -->
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 mb-8">
        <h3 class="text-xl font-bold text-slate-800 mb-2">Evaluasi Kinerja Akademik</h3>
        <p class="text-slate-500">Data statistik berikut menyajikan visualisasi distribusi dokumen dan tingkat keaktifan
            pengguna secara keseluruhan.</p>
    </div>

    <!-- Re-use the stats grid from Admin but style it for monitoring -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Duplicate stats card logic... simplified here -->
        <div class="bg-indigo-600 p-6 rounded-2xl text-white shadow-lg shadow-indigo-100">
            <h4 class="text-indigo-100 text-sm font-medium mb-1">Total Dokumen</h4>
            <p class="text-3xl font-bold">{{ $stats['total_documents'] }}</p>
        </div>
        <!-- ... more stats ... -->
    </div>

    <!-- Category Distribution Charts... same logic as Admin but could be bigger -->
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
        <h3 class="font-bold text-slate-800 mb-6 text-lg">Distribusi Dokumen per Kategori</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-6">
                @foreach ($categoryDistribution as $cat)
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-slate-700 font-medium">{{ $cat->name }}</span>
                            <span class="font-bold text-indigo-600">{{ $cat->documents_count }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-indigo-500 h-3 rounded-full"
                                style="width: {{ $stats['total_documents'] > 0 ? ($cat->documents_count / $stats['total_documents']) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col justify-center items-center p-8 bg-slate-50 rounded-2xl">
                <h4 class="text-slate-400 font-medium mb-4">Ringkasan Aktivitas</h4>
                <div class="text-center">
                    <p class="text-4xl font-black text-slate-900">{{ $stats['total_uploads'] + $stats['total_downloads'] }}
                    </p>
                    <p class="text-slate-500 text-sm">Total interaksi sistem</p>
                </div>
            </div>
        </div>
    </div>
@endsection

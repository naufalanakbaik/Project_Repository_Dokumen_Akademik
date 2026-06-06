@extends('kaprodi.layouts.app')
@section('title', 'Detail Dokumen')

@push('styles')
    <style>
        :root {
            --border: #e5e7eb;
            --border-hover: #d1d5db;
            --surface: #ffffff;
            --surface-subtle: #f9fafb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            --radius-card: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --transition: all .18s cubic-bezier(.4, 0, .2, 1);
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2.5px 9px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 500;
            border: 1px solid;
        }

        .badge-blue {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }

        .badge-green {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }

        .badge-red {
            background: #fff1f2;
            color: #be123c;
            border-color: #fecdd3;
        }

        .badge-amber {
            background: #fffbeb;
            color: #b45309;
            border-color: #fde68a;
        }

        .badge-gray {
            background: #f9fafb;
            color: #4b5563;
            border-color: #e5e7eb;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            padding: 20px;
            box-shadow: var(--shadow-card);
        }

        .meta-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .meta-value {
            font-size: 14px;
            color: var(--text-primary);
            font-weight: 500;
        }

        .data-table thead th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-muted);
            padding: 10px 16px;
            background: var(--surface-subtle);
            border-bottom: 1px solid var(--border);
        }

        .data-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background .12s ease;
        }

        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .data-table tbody tr:hover {
            background: #f9fafb;
        }

        .data-table tbody td {
            padding: 10px 16px;
            font-size: 13px;
            color: #374151;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-5 pb-6">

        {{-- ═══ Name and back button ═══ --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-1.5 text-xs text-gray-400">
                <span class="material-symbols-outlined !text-[13px]">grid_view</span>
                <span>Kaprodi</span>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <a href="{{ route('kaprodi.documents.index') }}" class="hover:text-gray-600 transition">Daftar Dokumen</a>
                <span class="material-symbols-outlined !text-[13px]">chevron_right</span>
                <span class="text-gray-600 font-medium line-clamp-1 max-w-[200px]">{{ $document->title }}</span>
            </div>
            <a href="{{ route('kaprodi.documents.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-1">
                Back
                <span class="material-symbols-outlined !text-[18px]">low_priority</span>
            </a>
        </div>

        {{-- ═══ Header Information ═══ --}}
        <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-6">
            <div class="flex flex-col sm:flex-row sm:items-start gap-4">

                {{-- Icon --}}
                <div
                    class="w-12 h-12 rounded-xl border border-blue-200 bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-blue-500 !text-[22px]">
                        description
                    </span>
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <h1 class="text-xl font-semibold text-gray-700 tracking-tight break-words">
                        {{ $document->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-3 mt-3">
                        @if ($document->status == 'approved')
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Approved
                            </span>
                        @elseif($document->status == 'rejected')
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-red-50 border border-red-200 text-red-700 text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Rejected
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                Pending
                            </span>
                        @endif
                        <span class="text-xs text-gray-500">
                            Diunggah {{ $document->created_at->translatedFormat('d F Y, H:i') }}
                        </span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('kaprodi.documents.preview', $document->id) }}" target="_blank" title="Preview"
                        class="flex items-center justify-center w-9 h-9 rounded-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 transition">
                        <span class="material-symbols-outlined !text-[16px]">
                            picture_as_pdf
                        </span>
                    </a>

                    <a href="{{ route('kaprodi.documents.download', $document->id) }}" title="Download"
                        class="flex items-center justify-center w-9 h-9 rounded-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 transition">
                        <span class="material-symbols-outlined !text-[16px]">
                            download
                        </span>
                    </a>
                </div>
            </div>

        </div>

        {{-- ═══ Stats Cards ═══ --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            {{-- Download --}}
            <div
                class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 hover:border-gray-300 transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[13px] font-medium text-gray-500">
                            Total Download
                        </p>

                        <p class="mt-2 text-3xl font-semibold tracking-tight text-gray-700">
                            {{ number_format($downloadCount) }}
                        </p>
                    </div>

                    <div class="w-9 h-9 rounded-full border border-gray-200 bg-gray-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-gray-600 !text-[16px]">
                            download
                        </span>
                    </div>
                </div>
            </div>

            {{-- Preview --}}
            <div
                class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 hover:border-gray-300 transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[13px] font-medium text-gray-500">
                            Total Preview
                        </p>

                        <p class="mt-2 text-3xl font-semibold tracking-tight text-gray-700">
                            {{ number_format($previewCount) }}
                        </p>
                    </div>

                    <div class="w-9 h-9 rounded-full border border-gray-200 bg-gray-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-gray-600 !text-[16px]">
                            visibility
                        </span>
                    </div>
                </div>
            </div>

            {{-- Tahun Terbit --}}
            <div
                class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 hover:border-gray-300 transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[13px] font-medium text-gray-500">
                            Tahun Terbit
                        </p>

                        <p class="mt-2 text-3xl font-semibold tracking-tight text-gray-700">
                            {{ $document->tahun_terbit ?? '—' }}
                        </p>
                    </div>

                    <div class="w-9 h-9 rounded-full border border-gray-200 bg-gray-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-gray-600 !text-[16px]">
                            calendar_month
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ Document Information ═══ --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-semibold text-gray-900">
                            Informasi Dokumen
                        </h2>
                        <p class="text-[13px] text-gray-500">
                            Detail metadata dan informasi dokumen yang tersimpan.
                        </p>
                    </div>

                    <div class="w-10 h-10 rounded-full border border-gray-200 bg-gray-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-gray-500 !text-[18px]">
                            description
                        </span>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="px-6 py-2">
                <div class="divide-y divide-gray-100">

                    {{-- Kategori --}}
                    <div class="py-4 flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-48 flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-600">Kategori</p>
                        </div>
                        <div class="mt-1 sm:mt-0">
                            @if ($document->category)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-md border border-gray-200 bg-gray-50 text-[13px] font-medium text-gray-700">
                                    {{ $document->category->name }}
                                </span>
                            @else
                                <span class="text-[13px] text-gray-400">—</span>
                            @endif
                        </div>
                    </div>

                    {{-- Pengunggah --}}
                    <div class="py-4 flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-48 flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-600">Pengunggah</p>
                        </div>
                        <div class="flex items-center gap-3 mt-1 sm:mt-0">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 text-amber-700 
                                            border border-amber-300 flex items-center justify-center flex-shrink-0">
                                <span class="text-xs font-semibold">
                                    {{ strtoupper(substr($document->user?->name ?? '?', 0, 1)) }}
                                </span>
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $document->user?->name ?? 'Unknown User' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Pengunggah
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="py-4 flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-48 flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-600">Role Pengunggah</p>
                        </div>

                        <p class="text-sm font-medium text-gray-700 capitalize">
                            {{ $document->user?->role ?? '—' }}
                        </p>
                    </div>

                    {{-- Tanggal Upload --}}
                    <div class="py-4 flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-48 flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-600">Tanggal Unggah</p>
                        </div>
                        <p class="text-sm font-medium text-gray-700">
                            {{ $document->created_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                    {{-- Status --}}
                    <div class="py-4 flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-48 flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-600">Status Dokumen</p>
                        </div>
                        <div>
                            @php
                                $statusConfig = match ($document->status) {
                                    'approved' => [
                                        'class' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                                        'dot' => 'bg-emerald-500',
                                        'label' => 'Approved',
                                    ],
                                    'pending' => [
                                        'class' => 'bg-amber-50 border-amber-200 text-amber-700',
                                        'dot' => 'bg-amber-500',
                                        'label' => 'Pending',
                                    ],
                                    'rejected' => [
                                        'class' => 'bg-red-50 border-red-200 text-red-700',
                                        'dot' => 'bg-red-500',
                                        'label' => 'Rejected',
                                    ],
                                    default => [
                                        'class' => 'bg-gray-50 border-gray-200 text-gray-700',
                                        'dot' => 'bg-gray-500',
                                        'label' => ucfirst($document->status),
                                    ],
                                };
                            @endphp

                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border text-xs font-medium {{ $statusConfig['class'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                                {{ $statusConfig['label'] }}
                            </span>
                        </div>
                    </div>

                    {{-- File --}}
                    <div class="py-4 flex flex-col sm:flex-row">
                        <div class="w-full sm:w-48 flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-600">Nama File</p>
                        </div>
                        <p class="text-[13px] text-gray-500 tracking-wide break-all">
                            {{ $document->file }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Reject Note --}}
            @if ($document->status === 'rejected' && $document->reject_note)
                <div class="border-t border-red-100 bg-red-50/60 px-6 py-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-red-500 !text-[18px]">
                            error
                        </span>

                        <div>
                            <p class="text-sm font-medium text-red-700">
                                Alasan Penolakan
                            </p>
                            <p class="mt-1 text-sm text-red-600 leading-relaxed">
                                {{ $document->reject_note }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- ═══ Activity logs ═══ --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-semibold text-gray-900">
                            Riwayat Aktivitas
                        </h2>
                        <p class="text-[13px] text-gray-500">
                            Aktivitas pengguna terhadap dokumen ini.
                        </p>
                    </div>

                    <div class="w-10 h-10 rounded-full border border-gray-200 bg-gray-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-gray-500 !text-[18px]">
                            history
                        </span>
                    </div>
                </div>
            </div>

            {{-- Activity Feed --}}
            <div class="px-6">

                @forelse($document->logs as $log)
                    @php
                        $isDownload = $log->action === 'download';
                    @endphp

                    <div class="relative flex gap-4 py-5">
                        {{-- Timeline --}}
                        <div class="flex flex-col items-center">
                            <div class="w-9 h-9 rounded-full border border-gray-200 bg-white flex items-center justify-center">
                                <span
                                    class="material-symbols-outlined !text-[16px]
                                    {{ $isDownload ? 'text-emerald-600' : 'text-blue-600' }}">
                                    {{ $isDownload ? 'download' : 'visibility' }}
                                </span>

                            </div>
                            @unless ($loop->last)
                                <div class="w-px flex-1 bg-gray-300 mt-2"></div>
                            @endunless
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm text-gray-900">
                                        <span class="font-medium">
                                            {{ $log->user?->name ?? 'Pengguna' }}
                                        </span>
                                        <span class="text-gray-500">
                                            melakukan
                                        </span>
                                        <span class="font-medium">
                                            {{ $isDownload ? 'download' : 'preview' }}
                                        </span>
                                        <span class="text-gray-500">
                                            dokumen
                                        </span>
                                    </p>

                                    <div class="mt-2">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border text-xs font-medium
                                            {{ $isDownload
                                            ? 'bg-emerald-50 border-emerald-200 text-emerald-700'
                                            : 'bg-blue-50 border-blue-200 text-blue-700' }}">

                                            <span class="w-1.5 h-1.5 rounded-full {{ $isDownload ? 'bg-emerald-500' : 'bg-blue-500' }}">
                                            </span>
                                            {{ $isDownload ? 'Download' : 'Preview' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-[13px] font-medium text-gray-700">
                                        {{ $log->created_at->format('d M Y') }}
                                    </p>

                                    <p class="text-[12px] font-medium text-gray-500 mt-1">
                                        {{ $log->created_at->format('H:i') }}
                                    </p>

                                    <p class="text-[12px] font-medium text-gray-400 mt-1">
                                        {{ $log->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-16 flex flex-col items-center justify-center">
                        <div class="w-14 h-14 rounded-2xl border border-gray-200 bg-gray-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-gray-300 !text-[24px]">
                                history
                            </span>
                        </div>
                        <h3 class="mt-4 text-sm font-medium text-gray-900">
                            Belum ada aktivitas
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Aktivitas download atau preview akan muncul di sini.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection

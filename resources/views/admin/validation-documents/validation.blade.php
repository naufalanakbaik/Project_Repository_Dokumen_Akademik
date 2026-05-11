@extends('admin.layouts.app')
@section('title', 'Validasi Dokumen')

@section('content')

    {{-- Header --}}
    <div class="relative overflow-hidden rounded-lg border border-gray-200/80 bg-white px-6 py-5 mb-6 shadow-sm">

        {{-- Soft Accent --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-100 rounded-full blur-3xl opacity-40">
        </div>

        <div class="relative flex items-start justify-between gap-5">
            {{-- Left Content --}}
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 mb-3 rounded-full border border-amber-200 bg-amber-50">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span class="text-[11px] font-semibold tracking-wide text-amber-700 uppercase">
                        Validasi Dokumen
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 leading-tight">
                    Validasi Pengajuan Dokumen
                </h1>

                {{-- Description --}}
                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                    Kelola proses validasi dokumen mahasiswa dengan lebih terstruktur.
                    Tinjau setiap pengajuan dokumen yang masuk sebelum dipublikasikan
                    ke sistem repositori akademik.
                </p>
            </div>

            {{-- Right Icon --}}
            <div class="hidden sm:flex items-center justify-center w-12 h-12 rounded-xl border border-amber-200 bg-amber-50 shrink-0">
                <span class="material-symbols-outlined text-amber-600 !text-[24px]">
                    fact_check
                </span>
            </div>

        </div>

        {{-- Bottom Section --}}
        <div class="mt-5 pt-4 border-t border-dashed border-gray-200 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            {{-- Left Info --}}
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Dokumen pending siap untuk ditinjau admin
            </div>

            {{-- Right Date --}}
            <div class="flex items-center gap-2 text-xs text-gray-400">
                <span class="material-symbols-outlined !text-[15px]">
                    calendar_month
                </span>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    {{--  Search / pencarian --}}
    <div class="flex flex-col gap-4 mb-3 lg:flex-row lg:items-center lg:justify-between">

        {{-- Title --}}
        <div class="ml-2.5">
            <h1 class="text-xl font-semibold text-gray-900">
                Pencarian Dokumen
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Temukan berdasarkan judul, nama pengguna, atau kategori dokumen dengan cepat.
            </p>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('admin.validation-documents.validation') }}" class="w-full lg:w-[340px]">
            <div class="relative">
                {{-- Icon --}}
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                    <span class="material-symbols-outlined !text-[20px]">
                        search
                    </span>
                </span>

                {{-- Input --}}
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul, pengguna, kategori..."
                    class="w-full h-11 pl-11 pr-11 text-[13px] border border-gray-300 rounded-lg bg-white text-gray-800 placeholder:text-gray-400
                    focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition">

                {{-- Icon Reset Search --}}
                @if (request('search'))
                    <a href="{{ route('admin.validation-documents.validation') }}"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-red-500 transition">
                        <span class="material-symbols-outlined !text-[18px]">
                            close
                        </span>
                    </a>
                @endif
            </div>
        </form>

    </div> 

    {{-- Message succes --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Table validasi dokumen --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-fixed">
                <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9]">
                    <tr>
                        <th class="w-[70px] px-4 py-3 font-medium text-center">
                            No.
                        </th>

                        <th class="w-[35%] px-6 py-3 font-medium text-left">
                            Judul
                        </th>

                        <th class="w-[18%] px-6 py-3 font-medium text-left">
                            Pengguna
                        </th>

                        <th class="w-[18%] px-6 py-3 font-medium text-left">
                            Tanggal
                        </th>

                        <th class="w-[14%] px-6 py-3 font-medium text-left">
                            Status
                        </th>

                        <th class="w-[180px] px-6 py-3 font-medium text-left">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-[13px]">
                    @forelse ($documents as $doc)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- No --}}
                            <td class="px-4 py-4 text-center text-gray-500 align-top">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Judul --}}
                            <td class="px-6 py-4 align-top">
                                <div class="min-w-0">
                                    <p class="text-gray-900 font-medium uppercase leading-relaxed break-words line-clamp-2">
                                        {{ $doc->title }}
                                    </p>

                                    {{-- Optional subtitle --}}
                                    <p class="text-[11px] text-gray-500 mt-1">
                                        Judul diajukan {{ ucfirst($doc->user->role) }}
                                    </p>
                                </div>
                            </td>

                            {{-- Pengguna --}}
                            <td class="px-6 py-4 text-gray-700 align-top">
                                <span>
                                    {{ $doc->user->name }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-6 py-4 text-gray-500 align-top whitespace-nowrap">
                                {{ $doc->created_at->format('d M Y') }}

                                <div class="text-[11px] text-gray-500 mt-0.5">
                                    {{ $doc->created_at->format('H:i') }} WIB
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 align-top">
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-medium
                                    bg-amber-50 text-amber-600 border border-amber-300 rounded-full whitespace-nowrap">
                                    <span class="material-symbols-outlined !text-[13px] leading-none">
                                        schedule
                                    </span>
                                    Pending
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 align-top">
                                <a href="{{ route('admin.validation-documents.show', $doc->id) }}"
                                    class="inline-flex items-center justify-center gap-1.5 w-full px-3 py-2 text-[11px] font-medium text-gray-700 
                                    hover:text-gray-900 bg-gray-50 hover:bg-gray-100 border border-gray-300 rounded-md transition">
                                    <span class="material-symbols-outlined !text-[15px] leading-none">
                                        file_open
                                    </span>
                                    Detail dokumen
                                </a>
                            </td>

                        </tr>

                    @empty

                        {{-- Empty State --}}
                        <tr>
                            <td colspan="6" class="py-14 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3 text-gray-500">
                                    <span class="material-symbols-outlined !text-[42px] text-gray-300">
                                        folder_off
                                    </span>
                                    <p class="text-sm font-medium text-gray-700">
                                        Tidak ada dokumen untuk divalidasi
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Semua dokumen sudah diproses atau belum ada yang diajukan.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($documents->count() > 0)
            <div class="p-4 border-t bg-gray-50">
                {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
            </div>
        @endif

    </div>
@endsection

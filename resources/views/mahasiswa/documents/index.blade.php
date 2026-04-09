{{-- @extends(auth()->user()->role . 'mahasiwa.layouts.app') --}}
@extends('mahasiswa.layouts.app')
@section('title', 'Daftar Dokumen')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <!-- Form Pencarian -->
        <form action="{{ route(auth()->user()->role . '.documents.index') }}" method="GET" class="w-full md:w-96 flex">
            <input type="text" name="search" placeholder="Cari judul dokumen..." value="{{ request('search') }}"
                class="w-full px-4 py-2 bg-white border border-slate-200 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 transition-colors">Cari</button>
        </form>

        <!-- Tombol Upload (Hanya Mahasiswa/Dosen) -->
        @if (in_array(auth()->user()->role, ['mahasiswa', 'dosen']))
            <a href="{{ route(auth()->user()->role . '.documents.create') }}"
                class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                Unggah Dokumen
            </a>
        @endif
    </div>

    <!-- Tabel Dokumen -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-bold">Dokumen</th>
                    <th class="px-6 py-4 font-bold">Kategori</th>
                    <th class="px-6 py-4 font-bold">Pengunggah</th>
                    <th class="px-6 py-4 font-bold">Status</th>
                    <th class="px-6 py-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($documents as $doc)
                    <tr>
                        <td class="px-6 py-4 flex items-center">
                            <div class="p-2 bg-slate-100 rounded-lg mr-3">
                                <!-- Icon Placeholder -->
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium text-slate-900">{{ $doc->title }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $doc->category->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $doc->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full 
                        {{ $doc->status == 'approved' ? 'bg-emerald-50 text-emerald-700' : '' }}
                        {{ $doc->status == 'pending' ? 'bg-amber-50 text-amber-700' : '' }}
                        {{ $doc->status == 'rejected' ? 'bg-red-50 text-red-700' : '' }}">
                                {{ ucfirst($doc->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route(auth()->user()->role . '.documents.download', $doc->id) }}"
                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                    title="Download">
                                    <!-- Icon Download -->
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>

                                @if (auth()->user()->role === 'admin' && $doc->status === 'pending')
                                    <form action="{{ route('admin.documents.updateStatus', $doc->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit"
                                            class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                                            title="Approve">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.documents.updateStatus', $doc->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Reject">Reject</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">Tidak ada dokumen ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 bg-slate-50">
            {{ $documents->links() }}
        </div>
    </div>

@endsection

@extends('admin.layouts.app')
@section('title', 'Validasi Dokumen')

@section('content')
    {{-- Header --}}
    <div class="space-y-4 mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Daftar validasi dokumen </h1>
            <p class="text-sm text-gray-500">Daftar seluruh dokumen yanng belum di validasi</p>
        </div>
    </div>

    {{-- Table validasi dokumen --}}
    <div class="bg-white border border-[#b6c1c9] rounded-md shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9]">
                <tr>
                    <th class="px-4 py-3 font-medium text-center">No.</th>
                    <th class="px-6 py-3 font-medium text-left">Judul</th>
                    <th class="px-6 py-3 font-medium text-left">Pengguna</th>
                    <th class="px-6 py-3 font-medium text-left">Tanggal diunggah</th>
                    <th class="px-6 py-3 font-medium text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y text-[13px] divide-gray-200">
                @foreach ($documents as $doc)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- No --}}
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $loop->iteration }}
                            {{-- {{ $key + 1 }} --}}
                        </td>

                        {{-- Judul --}}
                        <td class="px-6 py-3 font-medium">
                            <p class="font-normal text-gray-900 truncate max-w-[420px]">
                                {{ $doc->title }}
                            </p>
                        </td>

                        {{-- Nama penggungah --}}
                        <td class="px-6 py-3 text-gray-600">
                            {{ $doc->user->name }}
                        </td>

                        {{-- Waktu --}}
                        <td class="px-6 py-3 text-gray-500">
                            {{ $doc->created_at->format('d M Y - H:i') }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <!-- Approve -->
                                <form method="POST" action="{{ route('admin.documents.updateStatus', $doc->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">

                                    <button onclick="return confirm('Approve dokumen ini?')"
                                        class="px-4 py-1.5 text-xs font-medium uppercase rounded-lg border
                                        bg-green-50 text-green-700 border-green-300
                                        hover:bg-green-100 transition">
                                        Approve
                                    </button>
                                </form>
                                <!-- Reject -->
                                <form method="POST" action="{{ route('admin.documents.updateStatus', $doc->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button onclick="return confirm('Reject dokumen ini?')"
                                        class="px-4 py-1.5 text-xs font-medium uppercase rounded-lg border
                                        bg-red-50 text-red-700 border-red-300
                                        hover:bg-red-100 transition">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4 border-t bg-gray-50">
            {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
        </div>

    </div>
@endsection

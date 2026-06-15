<table class="w-full min-w-[850px]">
    <thead class="bg-[#f3f4f6] text-[12.5px] text-gray-800 border-b border-[#b6c1c9]">
        <tr>
            <th class="px-5 py-3 font-medium text-center w-[4%]">No</th>
            <th class="px-5 py-3 font-medium text-left w-[38%]">Dokumen</th>
            <th class="px-5 py-3 font-medium text-left w-[18%]">Kategori</th>
            <th class="px-5 py-3 font-medium text-left w-[15%]">Tanggal</th>
            <th class="px-5 py-3 font-medium text-left w-[12%]">Status</th>
            <th class="px-5 py-3 font-medium text-left w-[15%]">Alasan</th>
            <th class="px-5 py-3 font-medium text-left w-[23%]">Aksi</th>
        </tr>
    </thead>

    <tbody class="divide-y text-[13px] divide-gray-200">
        @forelse ($documents as $doc)
            <tr class="hover:bg-gray-50 transition">

                {{-- Nomor --}}
                <td class="px-5 py-3 text-center text-gray-600">
                    {{ $loop->iteration }}
                </td>

                {{-- Title --}}
                <td class="px-5 py-3">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-gray-700 !text-[20px] mt-1">
                            description
                        </span>
                        <div class="min-w-0 max-w-[260px]">
                            <p class="text-[13px] font-medium text-gray-800 line-clamp-2 leading-snug"
                                title="{{ $doc->title }}">
                                {{ Str::words($doc->title, 10, '...') }}
                            </p>
                            <p class="text-[11px] text-gray-400 mt-1 truncate">
                                {{ basename($doc->file) }}
                            </p>
                        </div>
                    </div>
                </td>

                {{-- Category --}}
                <td class="px-5 py-3 text-gray-700 text-[13px]">
                    <p class="font-normal text-gray-800 truncate max-w-[420px]">
                        {{ $doc->category->name }}
                    </p>
                </td>

                {{-- Date --}}
                <td class="px-5 py-3 text-[13px]">
                    <p class="text-gray-800 font-medium">
                        {{ \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') }}
                    </p>
                    <p class="text-[11px] text-gray-400 mt-0.5">
                        {{ \Carbon\Carbon::parse($doc->created_at)->translatedFormat('l') }}
                    </p>
                </td>

                {{-- Status --}}
                <td class="px-5 py-3 text-left">
                    <span
                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xl border text-[11px] font-medium
                        {{ $doc->status === 'approved'
                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                        : ($doc->status === 'pending'
                            ? 'bg-amber-50 text-amber-600 border-amber-200'
                            : 'bg-red-50 text-red-700 border-red-200') }}">

                        <span class="material-symbols-outlined !text-[12px]">
                            {{ $doc->status === 'approved' ? 'check_circle' : ($doc->status === 'pending' ? 'schedule' : 'cancel') }}
                        </span>

                        {{ ucfirst($doc->status) }}
                    </span>
                </td>

                {{-- Note Rejected --}}
                <td class="px-5 py-3">
                    @if ($doc->status === 'rejected')
                        <button onclick="openRejectModal('{{ $doc->reject_note }}')"
                            class="text-red-600 text-[11px] font-medium hover:text-red-400 transition">
                            Lihat Alasan
                        </button>
                    @elseif ($doc->status === 'approved')
                        <span class="text-green-700 text-[11px] font-medium">
                            Disetujui
                        </span>
                    @else
                        <span class="text-gray-500 text-[11px]">
                            Menunggu
                        </span>
                    @endif
                </td>

                {{-- Buttons --}}
                <td class="px-5 py-3">
                    <div class="flex text-left gap-1">
                        <a href="{{ route('mahasiswa.documents.show', $doc->id) }}" class="p-2 transition group"
                            title="Detail">
                            <span
                                class="material-symbols-outlined text-gray-500 group-hover:text-gray-800 !text-[18px]">
                                file_open
                            </span>
                        </a>
                        <a href="{{ route('mahasiswa.documents.preview', $doc->id) }}" target="_blank"
                            class="p-2 transition group" title="Preview">
                            <span
                                class="material-symbols-outlined text-gray-500 group-hover:text-gray-800 !text-[18px]">
                                picture_as_pdf
                            </span>
                        </a>
                        <a href="{{ route('mahasiswa.documents.download', $doc->id) }}" class="p-2 transition group"
                            title="Download">
                            <span
                                class="material-symbols-outlined text-gray-500 group-hover:text-gray-800 !text-[19px]">
                                download
                            </span>
                        </a>
                        @if ($doc->status !== 'approved')
                            <a href="{{ route('mahasiswa.documents.edit', $doc->id) }}" class="p-2 transition group"
                                title="Edit">
                                <span
                                    class="material-symbols-outlined text-gray-500 group-hover:text-gray-800 !text-[18px]">
                                    edit_document
                                </span>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @empty

            <tr>
                <td colspan="6" class="text-center py-14 text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <span class="material-symbols-outlined text-gray-300 !text-[42px]">
                            folder_open
                        </span>
                        <p class="text-sm font-medium">Belum ada dokumen</p>
                        <a href="{{ route('mahasiswa.documents.create') }}"
                            class="mt-2 text-blue-600 text-sm hover:underline">
                            Upload sekarang
                        </a>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>

</table>

{{-- Pagination --}}
<div class="px-5 py-4 border-t border-gray-200 bg-gray-50">

    {{-- Pagination --}}
    <div>
        {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
    </div>

</div>

{{-- Modal Alasan Penolakan --}}
<div id="rejectModal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-[3px]" onclick="closeRejectModal()"></div>
    <div class="relative w-full max-w-lg bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-red-50 border border-red-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-red-500 !text-[18px]">
                        error
                    </span>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-900 leading-tight">
                        Alasan Penolakan
                    </h2>
                    <p class="text-[11px] text-gray-500">
                        Dokumen ini tidak disetujui oleh admin
                    </p>
                </div>
            </div>
            <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-700 transition">
                <span class="material-symbols-outlined !text-[20px]">
                    close
                </span>
            </button>
        </div>

        {{-- Body --}}
        <div class="px-5 py-4">
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                <p id="rejectText" class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                    -
                </p>
            </div>
            <p class="text-[11px] text-gray-400 mt-3">
                Pastikan memperbaiki dokumen sesuai catatan sebelum mengajukan ulang.
            </p>
        </div>
        <div class="px-5 py-3 border-t border-gray-100 bg-gray-50 flex justify-end">
            <button onclick="closeRejectModal()"
                class="px-4 py-1.5 text-[12px] font-medium text-gray-600 bg-white border border-gray-200 rounded-md hover:bg-gray-50 transition">
                Mengerti
            </button>
        </div>
    </div>
</div>

{{-- Style efek modal note rejected --}}
<style>
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.96) translateY(6px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes backdropFadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Modal animation */
    #rejectModal>div.relative {
        animation: modalFadeIn 0.18s ease-out;
    }

    /* Backdrop animation */
    #rejectModal .absolute {
        animation: backdropFadeIn 0.15s ease-out;
    }
</style>

{{-- Js modal note rejected --}}
<script>
    window.openRejectModal = function(text) {
        document.getElementById('rejectText').innerText = text ?? '-';
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    window.closeRejectModal = function() {
        document.getElementById('rejectModal').classList.add('hidden');
    }
</script>

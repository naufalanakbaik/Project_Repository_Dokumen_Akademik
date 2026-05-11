@extends('admin.layouts.app')
@section('title', 'Detail Validasi Dokumen')

@section('content')

    {{-- Header --}}
    <div class="flex items-start justify-between mb-5">
        <div>
            <h1 class="text-xl font-semibold text-gray-800 leading-tight">
                {{ $document->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-3 text-[12px] text-gray-500 mt-1.5">
                <span>•</span>

                <span class="flex items-center gap-1">
                    Diajukan oleh <span class="font-medium text-gray-600"> {{ $document->user->name }}</span>
                </span>

                <span>•</span>

                <span class="flex items-center gap-1">
                    Tanggal
                    {{ $document->created_at->format('d M Y') }}
                </span>
            </div>
        </div>

        <a href="{{ route('admin.validation-documents.validation') }}"
            class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-1">
            Back
            <span class="material-icons !text-[18px]">low_priority</span>
        </a>
    </div>

    {{-- Main grid content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: preview frame pdf --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Header title --}}
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex text-red-600">
                        <span class="material-symbols-outlined !text-[22px]">picture_as_pdf</span>
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-gray-900 line-clamp-1">
                            {{ $document->title }}
                        </p>

                        <div class="flex items-center gap-2 text-[12px] text-gray-500 mt-0.5">
                            <span>PDF</span>
                            <span>•</span>
                            <span>Preview tersedia</span>
                        </div>
                    </div>
                </div>

                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 text-[12px] font-medium rounded-full border
                        {{ $document->status === 'approved'
                            ? 'bg-emerald-50 text-emerald-700 border-emerald-300'
                            : ($document->status === 'pending'
                                ? 'bg-amber-50 text-amber-600 border-amber-300'
                                : 'bg-red-50 text-red-700 border-red-300') }}">
                    <span class="material-symbols-outlined !text-[13px]">
                        {{ $document->status === 'approved' ? 'check_circle' : ($document->status === 'pending' ? 'schedule' : 'cancel') }}
                    </span>
                    {{ ucfirst($document->status) }}
                </span>
            </div>

            {{-- PDF preview frame --}}
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden">

                {{-- Header Preview --}}
                <div class="px-5 py-4 border-b bg-gray-50 flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-800">
                        Preview Dokumen
                    </span>

                    <a href="{{ route('admin.documents.preview', $document->id) }}" target="_blank"
                        class="text-xs text-blue-600 hover:underline">
                        Buka di tab baru
                    </a>
                </div>

                {{-- PDF Viewer --}}
                <iframe src="{{ asset('storage/' . $document->file) }}" class="w-full h-[680px] bg-gray-100">
                </iframe>

                {{-- Footer --}}
                <div class="px-5 py-3 border-t bg-gray-50 text-xs text-gray-500 flex justify-between">
                    <span>Gunakan scroll untuk membaca dokumen</span>
                    <span>Format: PDF</span>
                </div>
            </div>
        </div>

        {{-- Right: information documents & action buttons --}}
        <div class="space-y-5">

            {{-- Data documents --}}
            <div class="bg-white border border-gray-300 rounded-lg">

                <div class="px-5 py-4 border-b bg-gray-50 text-sm rounded-t-lg font-medium text-gray-800">
                    Informasi Dokumen
                </div>

                <div class="divide-y text-sm">

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Uploader</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->user->name }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Tahun Terbit</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->tahun_terbit }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Kategori</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->category->name }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Tanggal Upload</span>
                        <span class="font-medium text-gray-600">
                            {{ $document->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition">
                        <span class="text-xs text-gray-500 font-medium">Tipe File</span>
                        <span class="font-medium text-gray-600">
                            PDF
                        </span>
                    </div>

                </div>
            </div>

            {{-- Validation panel --}}
            <div class="sticky top-6">
                <div class="overflow-hidden bg-white border border-gray-300 rounded-lg shadow-sm">
                    {{-- Header --}}
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 bg-gray-50">
                        <div>
                            <h3 class="text-sm font-medium text-gray-800">
                                Validasi Dokumen
                            </h3>
                            <p class="text-[10.5px] text-gray-500">
                                Kelola status pengajuan dokumen
                            </p>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        {{-- Form --}}
                        <form action="{{ route('admin.documents.updateStatus', $document->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            {{-- Action Buttons --}}
                            <div class="space-y-3">

                                {{-- Approve --}}
                                <button type="submit" name="status" value="approved"
                                    onclick="return confirm('Setujui dokumen ini?')"
                                    class="w-full h-11 inline-flex items-center justify-center gap-2 rounded-lg border border-emerald-300 bg-white 
                                    hover:bg-emerald-50 text-[13px] font-medium text-emerald-700 shadow-sm transition duration-200">
                                    <span class="material-symbols-outlined !text-[18px]">
                                        task
                                    </span>
                                    Approve Dokumen
                                </button>

                                {{-- Reject --}}
                                <button type="button" onclick="openRejectModal()"
                                    class="w-full h-11 inline-flex items-center justify-center gap-2 rounded-lg border border-red-300 bg-white 
                                    hover:bg-red-50 text-[13px] font-medium text-red-700 shadow-sm transition duration-200">
                                    <span class="material-symbols-outlined !text-[18px]">
                                        scan_delete
                                    </span>
                                    Reject Dokumen
                                </button>
                            </div>
                        </form>

                        {{-- Information Note --}}
                        <div class="mt-5 flex items-start gap-3">
                            <span class="material-symbols-outlined !text-[17px] text-gray-700 mt-0.5 shrink-0">
                                info
                            </span>
                            <div>
                                <p class="text-[11.5px] font-medium text-gray-700">
                                    Informasi Validasi
                                </p>

                                <p class="text-[11px] leading-relaxed text-gray-500 mt-0.5">
                                    Pastikan dokumen telah diperiksa dengan benar sebelum
                                    melakukan proses approve atau reject.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Reject Modal --}}
            <div id="rejectModal" style="margin:0"
                class="fixed top-0 left-0 z-[9999] hidden h-screen w-screen items-center justify-center bg-black/50 backdrop-blur-[2px] p-4">

                <div class="w-full max-w-2xl overflow-hidden rounded-lg border border-gray-300 bg-white shadow-lg">

                    {{-- Header --}}
                    <div class="flex items-start justify-between gap-4 px-6 py-5 border-b border-gray-200">
                        <div class="flex items-start gap-3">
                            {{-- Icon --}}
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg border border-red-200 bg-red-50 shrink-0">
                                <span class="material-symbols-outlined !text-[18px] text-red-600">
                                    cancel
                                </span>
                            </div>

                            {{-- Title --}}
                            <div>
                                <h3 class="text-[15px] font-semibold text-gray-900 tracking-tight">
                                    Reject Dokumen
                                </h3>
                                <p class="text-[12px] text-gray-500 leading-relaxed">
                                    Dokumen akan ditolak dan alasan penolakan akan dikirim
                                    kepada pengguna.
                                </p>
                            </div>
                        </div>

                        {{-- Close --}}
                        <button type="button" onclick="closeRejectModal()"
                            class="flex items-center justify-center w-8 h-8 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 
                                transition">
                            <span class="material-symbols-outlined !text-[18px]">
                                close
                            </span>
                        </button>

                    </div>

                    {{-- Form --}}
                    <form action="{{ route('admin.documents.updateStatus', $document->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        {{-- Body --}}
                        <div class="px-6 py-5 space-y-4">
                            {{-- Label --}}
                            <div>
                                <label class="block text-[12px] font-medium text-gray-700 mb-2">
                                    Alasan Penolakan
                                </label>

                                {{-- Input alasan posis kode harus tetap seperti ini --}}
                                <textarea
                                    name="reject_note"
                                    rows="6"
                                    required
                                    placeholder="Masukkan alasan penolakan dokumen..."
                                    class="w-full rounded-lg border border-gray-300
                                    bg-white px-4 py-3 text-[13px] leading-relaxed
                                    text-gray-700 placeholder:text-gray-400
                                    resize-none shadow-sm
                                    focus:outline-none focus:ring-4
                                    focus:ring-red-100 focus:border-red-400
                                    transition"></textarea>
                            </div>

                            {{-- Note --}}
                            <div class="flex items-start gap-2">
                                <span class="material-symbols-outlined !text-[16px] text-gray-400 mt-0.5">
                                    info
                                </span>
                                <p class="text-[11px] leading-relaxed text-gray-500">
                                    Pastikan alasan penolakan jelas dan informatif agar pengguna
                                    dapat melakukan perbaikan dokumen dengan benar.
                                </p>
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
                            {{-- Cancel --}}
                            <button type="button" onclick="closeRejectModal()"
                                class="h-10 px-4 rounded-md border border-gray-300 bg-white hover:bg-gray-100 text-[13px] 
                                font-medium text-gray-700 transition">
                                Batal
                            </button>

                            {{-- Submit --}}
                            <button type="submit" name="status" value="rejected"
                                class="inline-flex items-center gap-2 h-10 px-4 rounded-md border border-red-600 bg-red-600 hover:bg-red-700
                                text-white text-[13px] font-medium shadow-sm transition">
                                <span class="material-symbols-outlined !text-[16px]">
                                    block
                                </span>
                                Reject Dokumen
                            </button>

                        </div>

                    </form>

                </div>

            </div>

            {{-- Modal Script --}}
            <script>
                function openRejectModal() {
                    const modal = document.getElementById('rejectModal');

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeRejectModal() {
                    const modal = document.getElementById('rejectModal');

                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }

                // Close modal when click outside
                window.addEventListener('click', function(e) {
                    const modal = document.getElementById('rejectModal');

                    if (e.target === modal) {
                        closeRejectModal();
                    }
                });

                // Close modal with ESC
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeRejectModal();
                    }
                });
            </script>

        </div>

    </div>


@endsection

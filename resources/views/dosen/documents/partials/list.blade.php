{{-- Cara Kerja AJAX (Step-by-step)
1. User melakukan aksi -> Contoh: ketik search, pilih kategori, klik pagination

2. JavaScript menangkap aksi -> Pakai addEventListener (input/change/click)

3. JavaScript kirim request ke server -> Menggunakan fetch() -> Tanpa reload halaman

4. Controller menerima request -> Laravel mendeteksi: request()->ajax()

5. Server mengirim response -> Bukan full halaman -> Hanya partial HTML (list dokumen)

6. JavaScript menerima response -> Dalam bentuk HTML string

7. UI diupdate -> Pakai: script -> element.innerHTML = html;

Alur sipembuat dokumen: UI → JS → fetch → Controller → partial view → JS update DOM

Intinya AJAX =
👉 Update sebagian halaman tanpa reload
👉 Backend tetap Laravel Blade
👉 JS hanya sebagai penghubung

❌ Tanpa AJAX Seperti:
* beli makanan → dapur kirim satu rumah baru

✅ Dengan AJAX Seperti:
* pesan nasi goreng → dapur kirim hanya nasi goreng --}}

@forelse ($documents as $index => $doc)
    <div class="flex items-center gap-4 px-5 py-3 border-b last:border-none hover:bg-gray-50 transition group">

        {{-- Number --}}
        <div class="w-6 text-xs text-gray-400 font-medium text-center flex-shrink-0">
            {{ $index + 1 }}
        </div>

        {{-- Icon --}}
        <div
            class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 border border-red-200 text-red-500 flex-shrink-0">
            <span class="material-symbols-outlined !text-[18px]">
                picture_as_pdf
            </span>
        </div>

        {{-- Content --}}
        <div class="flex-1 min-w-0">

            {{-- Title --}}
            <p class="text-sm font-medium text-gray-900 truncate group-hover:text-gray-800">
                {{ $doc->title }}
            </p>

            {{-- Meta --}}
            <div class="flex items-center flex-wrap gap-3 mt-1 text-xs text-gray-500">

                {{-- Category --}}
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined !text-[14px]">
                        folder
                    </span>
                    {{ $doc->category->name }}
                </div>

                {{-- Tahun Terbit --}}
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined !text-[14px]">
                        calendar_today
                    </span>
                    Tahun Terbit {{ $doc->tahun_terbit }}
                </div>

                {{-- Status --}}
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xl border text-[10px] font-medium
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

            </div>

        </div>

        {{-- Actions buttons --}}
        <div class="flex items-center gap-2">

            <a href="{{ route('dosen.documents.show', $doc->id) }}" class="p-2 hover:text-gray-700 transition"
                title="Detail">
                <span class="material-symbols-outlined !text-[18px] text-gray-600">
                    file_open
                </span>
            </a>

            <a href="{{ route('dosen.documents.edit', $doc->id) }}" class="p-2 hover:text-gray-700 transition"
                title="Edit">
                <span class="material-symbols-outlined !text-[18px] text-gray-600">
                    edit_document
                </span>
            </a>

            <a href="{{ route('dosen.documents.preview', $doc->id) }}" target="_blank"
                class="p-2 hover:text-gray-700 transition" title="Preview">
                <span class="material-symbols-outlined !text-[18px] text-gray-600">
                    picture_as_pdf
                </span>
            </a>

            <a href="{{ route('dosen.documents.download', $doc->id) }}" class="p-2 hover:text-gray-700 transition"
                title="Download">
                <span class="material-symbols-outlined !text-[18px] text-gray-600">
                    download
                </span>
            </a>
        </div>
    </div>
@empty
    <div class="p-10 text-center text-sm text-gray-500">
        Kamu belum memiliki dokumen.
    </div>
@endforelse

{{-- Pagination --}}
<div class="px-5 py-3 bg-white">
    {{ $documents->links('vendor.pagination.tailwind-darkmode') }}
</div>

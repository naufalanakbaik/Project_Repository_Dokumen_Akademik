<div class="space-y-2">

    {{-- Info --}}
    @if ($currentFile)
        <p class="text-[11px] text-gray-500">
            File saat ini: {{ basename($currentFile) }}. Upload file baru untuk mengganti dokumen.
        </p>
    @endif

    {{-- File Lama --}}
    @if ($currentFile && $showCurrent)
        <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-md px-3 py-2">

            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span class="material-symbols-outlined !text-[18px] text-gray-500">
                    description
                </span>
                <span class="truncate">
                    {{ basename($currentFile) }}
                </span>
            </div>

            <a href="{{ asset('storage/' . $currentFile) }}" target="_blank" class="text-xs text-blue-600 hover:underline">
                Lihat
            </a>
        </div>
    @endif

    {{-- Upload/ input file --}}
    <div class="relative">

        <input id="{{ $id }}" type="file" name="{{ $name }}"
            @if ($accept) accept="{{ $accept }}" @endif class="hidden">

        <label for="{{ $id }}"
            class="group flex flex-col items-center justify-center border border-dashed border-gray-300 rounded-lg bg-gray-50 
            hover:bg-gray-100 px-6 py-6 text-center cursor-pointer transition duration-200">

            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white border border-gray-200
                group-hover:scale-105 transition">
                <span class="material-symbols-outlined text-gray-400 text-[22px] group-hover:text-blue-500">
                    upload_file
                </span>
            </div>

            <p class="mt-3 text-sm font-medium text-gray-700">
                {{ $label }}
            </p>

            <p class="text-xs text-gray-500 mt-1">
                {{ $hint }}
            </p>

            <p class="text-[11px] text-gray-400 mt-2">
                PDF, DOCX, atau ZIP (maks. 10MB)
            </p>

            {{-- File name preview --}}
            <p id="{{ $id }}_filename" class="text-xs text-blue-600 mt-2 hidden"></p>

        </label>

    </div>

    {{-- Note --}}
    @if ($note)
        <p class="text-[11px] text-gray-500">
            {{ $note }}
        </p>
    @endif

    {{-- Error --}}
    @error($name)
        <p class="text-xs text-red-500">{{ $message }}</p>
    @enderror

</div>

{{-- Script --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById("{{ $id }}");
        const fileName = document.getElementById("{{ $id }}_filename");

        if (input) {
            input.addEventListener("change", function() {
                if (input.files.length > 0) {
                    fileName.textContent = input.files[0].name;
                    fileName.classList.remove("hidden");
                }
            });
        }
    });
</script>

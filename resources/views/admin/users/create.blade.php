@extends('admin.layouts.app')
@section('title', 'Tambah User')

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Tambah Pengguna Baru
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Tambah pengguna baru untuk mengakses sistem repository.
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center text-gray-800 text-sm font-normal px-2 py-1 hover:text-blue-700 transition">
            <span
                class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-600  
                    bg-blue-600 hover:bg-white hover:text-blue-600 !text-[18px] transition">
                east
            </span>
        </a>
    </div>

    {{-- Container utama --}}
    <div class="space-y-6">
        {{-- Information --}}
        <div class="grid md:grid-cols-2 gap-4">

            <div class="bg-blue-50 border border-blue-300 rounded-lg py-2.5 px-4">
                <div class="flex items-center gap-2 mb-1 text-blue-700">
                    <span class="material-icons !text-[16px]">info</span>
                    <h3 class="text-sm font-medium">Informasi tambahan</h3>
                </div>

                <ul class="text-xs text-blue-600 space-y-2 leading-relaxed">
                    <li>
                        • Pastikan menggunakan email yang aktif dan valid, karena email tersebut akan digunakan untuk proses
                        login serta menerima informasi penting dari sistem.
                    </li>
                </ul>
            </div>

            <div class="bg-gray-100 border border-gray-300 rounded-lg py-2.5 px-4">
                <div class="flex items-center gap-2 mb-1 text-gray-700">
                    <span class="material-icons !text-[16px]">sticky_note_2</span>
                    <h3 class="text-sm font-medium">Catatan sistem</h3>
                </div>

                <ul class="text-xs text-gray-600 space-y-2 leading-relaxed">
                    <li>
                        • Pengguna akan langsung aktif setelah dibuat dan dapat segera mengakses sistem serta meggunggah
                        dokumen sesuai dengan role yang dibuat.
                    </li>
                </ul>
            </div>

        </div>

        {{-- Error message --}}
        @if ($errors->any())
            <div class="mb-5 p-4 rounded-lg bg-red-50 border border-red-200">
                <div class="flex items-center gap-2 mb-2 text-red-700">
                    <span class="material-icons !text-[18px]">error</span>
                    <p class="text-sm font-medium">Terjadi kesalahan</p>
                </div>
                <ul class="text-xs text-red-600 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form tambah pengguna --}}
        <div class="bg-white border border-gray-300 rounded-xl shadow-sm py-6 px-7">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-7">
                @csrf

                {{-- Informasi Pengguna --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-icons text-gray-900 !text-[19px]">
                            person
                        </span>
                        <h2 class="text-[15px] font-semibold text-gray-900">
                            Informasi Pengguna
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Nama --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none
                                @error('name') border-red-500 @else border-gray-300 @enderror">

                            @error('name')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="Masukkan email"
                                class="w-full px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none
                                @error('email') border-red-500 @else border-gray-300 @enderror">

                            @error('email')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Hak Akses --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-icons text-gray-900 !text-[18px]">
                            admin_panel_settings
                        </span>

                        <h2 class="text-[15px] font-semibold text-gray-900">
                            Hak Akses Pengguna
                        </h2>
                    </div>

                    <div class="relative">
                        <select id="role" name="role" onchange="toggleRoleFields()"
                            class="w-full appearance-none px-4 pr-10 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                            <option value="">
                                Pilih Role
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                                Mahasiswa
                            </option>
                            <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>
                                Dosen
                            </option>
                            <option value="kaprodi" {{ old('role') == 'kaprodi' ? 'selected' : '' }}>
                                Kaprodi
                            </option>
                        </select>

                        {{-- Arrow --}}
                        <span
                            class="material-icons absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none !text-[20px]">
                            expand_more
                        </span>
                    </div>

                    @error('role')
                        <p class="text-xs text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Field Mahasiswa --}}
                <div id="mahasiswaFields" class="hidden border border-blue-100 bg-blue-50/40 rounded-xl p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-icons text-blue-700 !text-[18px]">
                            school
                        </span>
                        <h2 class="text-[14px] font-semibold text-blue-800">
                            Informasi Mahasiswa
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        {{-- NIM --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                NIM
                            </label>
                            <input type="text" name="nim" value="{{ old('nim') }}"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('nim')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Jurusan --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                Jurusan
                            </label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('jurusan')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Angkatan --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                Tahun Angkatan
                            </label>
                            <input type="number" name="tahun_angkatan" value="{{ old('tahun_angkatan') }}"
                                placeholder="2024"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('tahun_angkatan')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Field Staff --}}
                <div id="staffFields" class="hidden border border-gray-200 bg-gray-50 rounded-xl p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-icons text-gray-700 !text-[18px]">
                            badge
                        </span>
                        <h2 class="text-[14px] font-semibold text-gray-800">
                            Informasi Staff
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- NIP --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                NIP
                            </label>
                            <input type="text" name="nip" value="{{ old('nip') }}"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('nip')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                Jabatan
                            </label>
                            <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                                placeholder="Contoh: Administrator Sistem"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @error('jabatan')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Foto Profile --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-icons text-gray-900 !text-[18px]">
                            image
                        </span>
                        <h2 class="text-[15px] font-semibold text-gray-900">
                            Foto Profile
                        </h2>
                    </div>

                    <div class="space-y-2">
                        <input type="file" name="foto_profile" accept="image/*"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-medium file:bg-blue-100 file:text-blue-800 hover:file:bg-blue-200">
                        <p class="text-xs text-gray-500">
                            Format: JPG, JPEG, PNG. Maksimal 3MB.
                        </p>
                        @error('foto_profile')
                            <p class="text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-icons text-gray-900 !text-[18px]">
                            lock
                        </span>
                        <h2 class="text-[15px] font-semibold text-gray-900">
                            Keamanan Akun
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Password --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                Password
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none
                                    @error('password') border-red-500 @else border-gray-300 @enderror">
                                <span onclick="togglePassword('password', this)"
                                    class="material-icons absolute right-3 top-2.5 text-gray-500 !text-[20px] cursor-pointer">
                                    visibility
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                Minimal 8 karakter
                            </p>
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Konfirmasi --}}
                        <div>
                            <label class="text-[13px] font-medium text-gray-700 mb-1.5 block">
                                Konfirmasi Password
                            </label>

                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <span onclick="togglePassword('password_confirmation', this)"
                                    class="material-icons absolute right-3 top-2.5 text-gray-500 !text-[20px] cursor-pointer">
                                    visibility
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Button --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-400 pb-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-5 py-2.5 text-[13px] font-medium text-gray-700 bg-gray-50 border border-gray-400 rounded-lg hover:bg-gray-100 transition shadow-sm">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 text-[13px] font-medium text-blue-800 border border-blue-400 bg-blue-100 rounded-lg hover:bg-blue-200 transition shadow-sm">
                        <span class="material-icons !text-[15px]">send</span>
                        Simpan Pengguna
                    </button>
                </div>

            </form>

        </div>

        {{-- Toggle Field Role --}}
        <script>
            function toggleRoleFields() {

                const role = document.getElementById('role').value;
                const mahasiswaFields =
                    document.getElementById('mahasiswaFields');
                const staffFields =
                    document.getElementById('staffFields');

                mahasiswaFields.classList.add('hidden');
                staffFields.classList.add('hidden');

                if (role === 'mahasiswa') {
                    mahasiswaFields.classList.remove('hidden');
                }

                if (
                    role === 'admin' ||
                    role === 'dosen' ||
                    role === 'kaprodi'
                ) {
                    staffFields.classList.remove('hidden');
                }
            }

            document.addEventListener('DOMContentLoaded', toggleRoleFields);
        </script>

        {{-- Js eye toggle password --}}
        <script>
            function togglePassword(id, el) {
                const input = document.getElementById(id);

                // Safety check (hindari error kalau id tidak ditemukan)
                if (!input) return;
                const isHidden = input.type === "password";
                // Toggle type
                input.type = isHidden ? "text" : "password";
                // Update icon
                el.textContent = isHidden ? "visibility_off" : "visibility";
            }
        </script>
    </div>

@endsection

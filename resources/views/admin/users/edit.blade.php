@extends('admin.layouts.app')
@section('title', 'Edit User')

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-950">
                Perbarui Data Pengguna
            </h1>
            <p class="text-xs text-blue-600 mt-0.5">
                Perbarui data pengguna untuk mengakses sistem repository
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
                        • Pastikan data yang diperbarui sudah benar dan menggunakan email yang masih aktif, karena akan
                        digunakan untuk proses login serta menerima informasi dari sistem.
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
                        • Perubahan role akan mempengaruhi hak akses pengguna di sistem.
                    </li>
                    <li>
                        • Perubahan email atau password dapat mempengaruhi proses login pengguna.
                    </li>
                </ul>
            </div>
        </div>

        {{-- Form tambah pengguna --}}
        <div class="bg-white border border-gray-300 rounded-lg shadow-sm py-2 px-7">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <div class="flex items-center gap-1.5 mb-3.5">
                        <span class="material-icons pb-0.5 text-gray-900 !text-[18px]">person</span>
                        <h2 class="text-[15px] font-medium text-gray-900">
                            Informasi Pengguna
                        </h2>
                    </div>

                    <div class="space-y-4">
                        {{-- Nama --}}
                        <div>
                            <label class="text-[13px] text-gray-700 mb-1 block">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="w-full px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-[13px] text-gray-700 mb-1 block">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}"
                                class="w-full px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-1.5 mb-3">
                        <span class="material-icons text-gray-900 !text-[17px]">add_moderator</span>
                        <h2 class="text-[15px] font-medium text-gray-900">
                            Hak Akses
                        </h2>
                    </div>

                    <div class="relative">
                        <select name="role"
                            class="w-full appearance-none px-4 pr-10 py-3 text-sm border border-gray-400 rounded-lg 
                            focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="kaprodi" {{ $user->role == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                        </select>

                        {{-- Custom Arrow --}}
                        <span
                            class="material-icons absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none text-[20px]">
                            expand_more
                        </span>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-1.5 mb-3">
                        <span class="material-icons pb-0.5 text-gray-900 !text-[18px]">password</span>
                        <h2 class="text-[15px] font-medium text-gray-900">
                            Keamanan Akun
                        </h2>
                    </div>
                    <div class="space-y-4">

                        {{-- Password --}}
                        <div>
                            <label class="text-[13px] text-gray-700 mb-1 block">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

                                <span onclick="togglePassword('password', this)"
                                    class="material-icons absolute right-3.5 top-2.5 text-gray-500 !text-[20px] cursor-pointer">
                                    visibility
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 pl-2 mt-1">Minimal 8 karakter</p>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label class="text-[13px] text-gray-700 mb-1 block">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-400 rounded-lg 
                                focus:ring-2 focus:ring-blue-500 focus:outline-none">

                                <span onclick="togglePassword('password_confirmation', this)"
                                    class="material-icons absolute right-3.5 top-2.5 text-gray-500 !text-[20px] cursor-pointer">
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
                        <span class="material-icons !text-[16px]">send</span>
                        Perbarui Pengguna
                    </button>
                </div>

            </form>
        </div>

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

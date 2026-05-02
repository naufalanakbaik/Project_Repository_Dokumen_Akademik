@extends('mahasiswa.layouts.app')
@section('title', 'Edit Profil')

@section('content')

    <div class="max-w-full mx-auto grid grid-cols-12 gap-6">

        {{-- Left: Profile Summary --}}
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white border border-gray-200 rounded-lg p-5">

                <div class="flex flex-col items-center text-center">

                    {{-- Avatar --}}
                    <div
                        class="w-16 h-16 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center text-lg font-semibold text-gray-600">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <p class="mt-3 text-[13px] font-semibold text-gray-900">
                        {{ $user->name }}
                    </p>

                    <p class="text-[11px] text-gray-500">
                        {{ $user->email }}
                    </p>

                    <span class="mt-2.5 text-[11px] text-gray-500">Status sekarang
                        <span class=" text-[10px] px-2 py-1 bg-gray-100 border border-gray-300 text-gray-700 rounded-md">
                            Mahasiswa
                        </span>
                    </span>
                </div>

                {{-- Info --}}
                <div class="mt-5 pt-5 border-t text-xs text-gray-600 space-y-2">
                    <p>• Perubahan profil bersifat permanen</p>
                    <p>• Gunakan email aktif</p>
                    <p>• Password minimal 6 karakter</p>
                </div>

            </div>
        </div>

        {{-- Right: Form --}}
        <div class="col-span-12 lg:col-span-8 space-y-5">

            <form method="POST" action="{{ route('mahasiswa.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Profile Info --}}
                <div class="bg-white border border-gray-200 rounded-lg">

                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-gray-900">
                            Informasi Profil
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Perbarui informasi dasar akun Anda
                        </p>
                    </div>

                    <div class="p-5 space-y-4">

                        {{-- Name --}}
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full mt-1 px-3 py-2 text-sm border border-gray-300 text-gray-600 rounded-md
                            focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full mt-1 px-3 py-2 text-sm border border-gray-300 text-gray-600 rounded-md
                            focus:ring-2 focus:ring-blue-100 focus:border-blue-500">

                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Password --}}
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-gray-900">
                            Keamanan
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Ubah password akun Anda (opsional)
                        </p>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Password Baru
                            </label>
                            <div class="relative mt-1">
                                <input type="password" name="password" id="password"
                                    class="w-full px-3 py-2 pr-10 text-sm border border-gray-300 text-gray-600 rounded-md">
                                <button type="button" onclick="togglePassword('password', this)"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-700">
                                    <span class="material-symbols-outlined text-[16px]">
                                        visibility
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Konfirmasi Password
                            </label>
                            <div class="relative mt-1">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-3 py-2 pr-10 text-sm border border-gray-300 text-gray-600 rounded-md">
                                <button type="button" onclick="togglePassword('password_confirmation', this)"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-700">
                                    <span class="material-symbols-outlined text-[16px]">
                                        visibility
                                    </span>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Action --}}
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('mahasiswa.profile.show') }}" class="text-[13px] text-gray-500 hover:text-gray-700">
                        Batal
                    </a>
                    <button
                        class="px-5 py-2 text-[13px] font-medium bg-blue-100 text-blue-800 border border-blue-400 rounded-md hover:bg-blue-200 transition">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>

    {{-- Js script eye toogle password --}}
    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);
            const icon = el.querySelector('span');

            if (input.type === "password") {
                input.type = "text";
                icon.textContent = "visibility_off";
            } else {
                input.type = "password";
                icon.textContent = "visibility";
            }
        }
    </script>

@endsection

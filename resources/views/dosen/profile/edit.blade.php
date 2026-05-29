@extends('dosen.layouts.app')
@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-12 gap-6">

        {{-- Left Profile Summary --}}
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-7 bg-gradient-to-r from-yellow-100 to-white border-b border-gray-100">
                    <div class="flex flex-col items-center text-center">
                        {{-- Avatar --}}
                        <div class="relative">
                            @if ($user->foto_profile)
                                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full bg-blue-100 border-4 border-white flex items-center justify-center shadow-sm">
                                    <span class="text-3xl font-semibold text-blue-700 uppercase">
                                        {{ \Illuminate\Support\Str::substr($user->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Identity --}}
                        <h2 class="mt-4 text-lg font-semibold text-gray-700">
                            {{ $user->name }}
                        </h2>

                        <p class="text-[13px] text-gray-600 mt-1">
                            {{ $user->email }}
                        </p>

                        {{-- Badge --}}
                        <div class="mt-1">
                            <span
                                class="inline-flex items-center text-[12px] font-medium capitalize text-gray-600">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="p-6 space-y-5">
                    {{-- Nip --}}
                    <div>
                        <p class="text-[12px] font-medium tracking-wide text-gray-400 mb-1">
                            NIP
                        </p>
                        <p class="text-sm font-medium text-gray-600">
                            {{ $user->nip ?? '-' }}
                        </p>
                    </div>

                    {{-- Jabatan --}}
                    <div>
                        <p class="text-[12px] font-medium tracking-wide text-gray-400 mb-1">
                            Jabatan
                        </p>
                        <p class="text-sm font-medium text-gray-600 leading-tight">
                            {{ $user->jabatan ?? '-' }}
                        </p>
                    </div>

                    {{-- Info --}}
                    <div class="pt-5 border-t border-dashed border-gray-300 space-y-2 text-xs text-gray-500">
                        <p>
                            • Perubahan profil bersifat permanen
                        </p>
                        <p>
                            • Gunakan email aktif dan valid
                        </p>
                        <p>
                            • Password minimal 8 karakter
                        </p>
                        <p>
                            • Maksimal ukuran foto 3MB
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Form --}}
        <div class="col-span-12 lg:col-span-8">
            <form method="POST" action="{{ route('dosen.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Informasi Profile --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                    {{-- Header --}}
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-[15px] font-semibold text-gray-800">
                            Informasi Profile
                        </h2>

                        <p class="text-[12px] text-gray-500">
                            Perbarui informasi dasar akun Anda
                        </p>
                    </div>

                    {{-- Body --}}
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- Nip --}}
                            <div>
                                <label class="text-xs font-medium text-gray-700">
                                    NIP
                                </label>

                                <input type="text" name="nip" value="{{ old('nip', $user->nip) }}"
                                    class="w-full mt-1 px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-500 
                                    focus:outline-none
                                    @error('nip') border-red-500 @else border-gray-300 @enderror">

                                @error('nip')
                                    <p class="text-xs text-red-500 mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Jabatan --}}
                            <div>
                                <label class="text-xs font-medium text-gray-700">
                                    Jabatan
                                </label>

                                <input type="text" name="jabatan"
                                    value="{{ old('jabatan', $user->jabatan) }}"
                                    class="w-full mt-1 px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-500 
                                    focus:outline-none
                                    @error('jabatan') border-red-500 @else border-gray-300 @enderror">

                                @error('jabatan')
                                    <p class="text-xs text-red-500 mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full mt-1 px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-500 
                                focus:outline-none
                                @error('name') border-red-500 @else border-gray-300 @enderror">

                            @error('name')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full mt-1 px-4 py-2.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-500 
                                focus:outline-none
                                @error('email') border-red-500 @else border-gray-300 @enderror">

                            @error('email')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Foto profile --}}
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Foto Profile
                            </label>

                            <input type="file" name="foto_profile" accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                                file:mr-4 file:py-2.5 file:px-4
                                file:border-0 file:text-sm
                                file:font-medium
                                file:bg-blue-100
                                file:text-blue-800 hover:file:bg-blue-200">
                            <p class="text-xs text-gray-500 mt-1">
                                JPG, JPEG, PNG. Maksimal 3MB.
                            </p>
                            @error('foto_profile')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Keamanan --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-[15px] font-semibold text-gray-800">
                            Keamanan Akun
                        </h2>
                        <p class="text-[12px] text-gray-500">
                            Kosongkan password jika tidak ingin mengganti
                        </p>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Password --}}
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Password Baru
                            </label>

                            <div class="relative mt-1">
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2.5 pr-11 text-sm border border-gray-300 rounded-lg
                                    focus:ring-2 focus:ring-blue-100 focus:border-blue-500 focus:outline-none">
                                <button type="button" onclick="togglePassword('password', this)"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-700">
                                    <span class="material-symbols-outlined !text-[18px]">
                                        visibility
                                    </span>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Confirmation --}}
                        <div>
                            <label class="text-xs font-medium text-gray-700">
                                Konfirmasi Password
                            </label>

                            <div class="relative mt-1">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-2.5 pr-11 text-sm border border-gray-300 rounded-lg
                                    focus:ring-2 focus:ring-blue-100 focus:border-blue-500 focus:outline-none">
                                <button type="button" onclick="togglePassword('password_confirmation', this)"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-700">
                                    <span class="material-symbols-outlined !text-[18px]">
                                        visibility
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Action --}}
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('mahasiswa.profile.show') }}" class="text-[13px] text-gray-500 hover:text-gray-700">
                        Batal
                    </a>
                    <button
                        class="inline-flex items-center gap-1 px-4 py-2 text-[13px] text-blue-700 font-medium bg-blue-100 border border-blue-400 
                        rounded-lg hover:bg-blue-200 transition">
                        <span class="material-symbols-outlined !text-[17px]">
                            forward
                        </span>
                        Perbarui Profile
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

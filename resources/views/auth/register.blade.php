<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>Register - Repository Dokumen</title>

    {{-- Img web browser --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Material icon --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    {{-- Vite --}}
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-white px-4 py-6 sm:p-6">

    {{-- Top Navigation --}}
    <div class="max-w-7xl mx-auto flex items-center justify-between mb-8">

        {{-- Left --}}
        <div class="flex items-center gap-2.5 min-w-0">
            <div class="shrink-0">
                <img src="{{ asset('img/logo-img/logo-unsri.png') }}" class="w-10 h-10 object-contain">
            </div>

            <div class="leading-tight min-w-0">
                <h1 class="text-[13px] sm:text-sm font-semibold text-gray-900 truncate">
                    Program Studi Manajemen Informatika
                </h1>

                <p class="text-[11px] text-gray-500 truncate">
                    Fakultas Ilmu Komputer · Universitas Sriwijaya
                </p>
            </div>
        </div>

        {{-- Right --}}
        <a href="{{ route('landing') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-amber-200
            bg-white hover:bg-amber-50 text-[13px] font-medium text-amber-700 transition">

            <span class="material-symbols-outlined text-[18px]">
                keyboard_return
            </span>

            <span class="hidden sm:inline">
                Kembali
            </span>
        </a>

    </div>

    {{-- Main --}}
    <div class="w-full max-w-[78rem] mx-auto space-y-5">

        {{-- Top Information --}}
        <div
            class="rounded-2xl border border-amber-200 bg-gradient-to-br from-amber-50 to-yellow-50 shadow-[0_10px_40px_rgba(251,191,36,0.08)] overflow-hidden">

            <div class="px-6 py-7 sm:px-8 sm:py-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    {{-- Left --}}
                    <div class="max-w-2xl">
                        <h1 class="text-2xl sm:text-[28px] font-semibold text-gray-800 leading-snug">
                            Registrasi Akun Mahasiswa
                        </h1>

                        <p class="mt-2 text-sm leading-relaxed text-gray-600">
                            Buat akun untuk mengakses repository dokumen akademik,
                            upload file, menyimpan favorit, dan menjelajahi berbagai referensi akademik.
                        </p>
                    </div>

                    {{-- Right --}}
                    <div class="flex flex-wrap gap-3">

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-amber-200
                    bg-white/80 text-[13px] text-gray-700">

                            <span class="material-symbols-outlined text-[18px] text-amber-600">
                                description
                            </span>

                            Upload Dokumen
                        </div>

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-amber-200
                    bg-white/80 text-[13px] text-gray-700">

                            <span class="material-symbols-outlined text-[18px] text-amber-600">
                                bookmark
                            </span>

                            Simpan Favorit
                        </div>

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-amber-200
                    bg-white/80 text-[13px] text-gray-700">

                            <span class="material-symbols-outlined text-[18px] text-amber-600">
                                travel_explore
                            </span>

                            Akses Repository
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Register Form --}}
        <div
             class="w-full bg-white border border-amber-200 rounded-2xl mx-auto
            shadow-[0_10px_40px_rgba(251,191,36,0.10)] overflow-hidden">

            <div class="p-6 sm:p-8">

                {{-- Header --}}
                <div class="text-center border-b border-amber-100 pb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        Buat Akun Mahasiswa
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Lengkapi data berikut untuk membuat akun baru
                    </p>
                </div>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="mt-5 bg-red-50 border border-red-200 rounded-xl px-4 py-3 text-red-600 text-xs">

                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>
                                    • {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('register.store') }}" class="mt-6 space-y-5">

                    @csrf

                    {{-- Nama --}}
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-600 pl-1">
                            Nama Lengkap
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl text-sm
                            focus:outline-none focus:ring-4 focus:ring-amber-100
                            focus:border-amber-400 transition">
                    </div>

                    {{-- NIM --}}
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-600 pl-1">
                            NIM
                        </label>

                        <input type="text" name="nim" value="{{ old('nim') }}" required
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl text-sm
                            focus:outline-none focus:ring-4 focus:ring-amber-100
                            focus:border-amber-400 transition">
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-600 pl-1">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl text-sm
                            focus:outline-none focus:ring-4 focus:ring-amber-100
                            focus:border-amber-400 transition">
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1 relative">
                        <label class="text-sm font-medium text-gray-600 pl-1">
                            Password
                        </label>

                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl text-sm
                            focus:outline-none focus:ring-4 focus:ring-amber-100
                            focus:border-amber-400 transition">

                        <span onclick="togglePassword('password', 'toggleIcon1')"
                            class="absolute right-4 top-[39px] cursor-pointer">

                            <img src="{{ asset('img/icon/eye-icon.png') }}" id="toggleIcon1"
                                class="w-5 h-5 opacity-60 hover:opacity-100 transition">

                        </span>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="space-y-1 relative">
                        <label class="text-sm font-medium text-gray-600 pl-1">
                            Konfirmasi Password
                        </label>

                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3 border border-amber-200 rounded-xl text-sm
                            focus:outline-none focus:ring-4 focus:ring-amber-100
                            focus:border-amber-400 transition">

                        <span onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                            class="absolute right-4 top-[39px] cursor-pointer">

                            <img src="{{ asset('img/icon/eye-icon.png') }}" id="toggleIcon2"
                                class="w-5 h-5 opacity-60 hover:opacity-100 transition">

                        </span>
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full py-3.5 rounded-xl text-white font-semibold text-[12px]
                        bg-amber-500 hover:bg-amber-600 tracking-wide transition">

                        DAFTAR AKUN

                    </button>

                    {{-- Login --}}
                    <p class="text-center text-xs text-gray-500">
                        Sudah punya akun?

                        <a href="{{ route('login') }}" class="text-amber-600 font-medium hover:underline">

                            Login Sekarang

                        </a>
                    </p>

                </form>

            </div>

        </div>

    </div>

</body>

{{-- Toggle Password --}}
<script>
    function togglePassword(inputId, eyeId) {

        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeId);

        if (!input || !eyeIcon) return;

        if (input.type === "password") {

            input.type = "text";

            eyeIcon.src = "{{ asset('img/icon/close-eye.png') }}";

        } else {

            input.type = "password";

            eyeIcon.src = "{{ asset('img/icon/eye-icon.png') }}";
        }
    }
</script>

</html>

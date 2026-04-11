<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    {{-- Title --}}
    <title>Login - Repository Dokumen</title>

    {{-- Img web browser --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- Material icon --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-6 sm:p-6">

    <!-- Logo unsri -->
    <div class="absolute top-3 left-4 flex items-center gap-3">
        <img src="{{ asset('img/logo-img/logo-unsri.png') }}" class="h-[45px] sm:h-[45px]" />
        <div class="flex flex-col leading-none text-gray-800">
            <h3 class="text-sm sm:text-lg font-medium">
                Fakultas Ilmu Komputer
            </h3>
            <h4 class="text-[10px] sm:text-xs font-normal mt-[2px] sm:mt-[-3px]">
                Program studi Manajemen Informatika
            </h4>
        </div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-4xl sm:min-h-[470px] bg-white border border-gray-300 rounded-lg shadow-md flex flex-col md:flex-row overflow-hidden">
        {{-- Left Content --}}
        <div class="hidden md:flex w-[50%] bg-gray-100 border-r border-gray-300 p-6 lg:p-8">
            <div class="flex flex-col justify-between w-full">
                <!-- Top -->
                <div class="space-y-6 py-3 px-3">
                    <!-- Heading -->
                    <div class="space-y-3">
                        <h1 class="text-xl font-medium text-gray-900 leading-snug">
                            Sistem Repositori Dokumen Akademik
                        </h1>
                        <p class="text-gray-700 text-xs leading-relaxed">
                            Platform terpusat untuk mengelola dokumen akademik secara efisien dan cepat.
                        </p>
                    </div>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-start gap-3">
                            <span class="material-icons text-blue-700 !text-[19px]">description</span>
                            <p>Manajemen dokumen terintegrasi dalam satu sistem</p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-icons text-blue-700 !text-[19px]">plagiarism</span>
                            <p>Pencarian cepat dengan sistem filtering1 yang efisien</p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-icons text-blue-700 !text-[19px]">security</span>
                            <p>Keamanan data dengan kontrol akses berbasis role</p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-icons text-blue-700 !text-[19px]">cloud_upload</span>
                            <p>Upload dan distribusi file dengan proses yang cepat</p>
                        </div>

                    </div>
                </div>

                <!-- Bottom -->
                <p class="text-xs text-gray-700 border-t border-gray-400 pt-4 justify-center text-center">
                    <span class="font-medium text-gray-800">© {{ date('Y') }}</span> Repositori Dokumen Akademik.
                    All rights reserved.
                </p>
            </div>
        </div>

        <!-- Right Content -->
        <div class="w-full md:w-[55%] flex items-center justify-center p-5 sm:p-7 md:p-9">
            <div class="w-full max-w-md space-y-6">

                <!-- Header -->
                <div class="space-y-1 text-center border-b border-gray-300 pb-3">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">
                        Selamat Datang
                    </h2>
                    <p class="text-[11px] sm:text-xs text-gray-600">
                        Silakan login untuk melanjutkan ke akun Anda
                    </p>
                </div>

                <!-- Error Message -->
                @error('email')
                    <div
                        class="bg-red-50 text-red-600 font-medium text-xs py-2 px-3 rounded-lg border border-red-300 justify-center text-center uppercase">
                        {{ $errors->first() }}
                    </div>
                @enderror

                <!-- Form -->
                <form method="POST" action="/login" class="space-y-4 sm:space-y-5">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-1">
                        <label class="text-xs sm:text-sm font-normal text-gray-800 pl-2.5">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm
                            focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <!-- Password -->
                    <div class="space-y-1 relative">
                        <label class="text-sm font-normal text-gray-800 pl-2.5">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm
                            focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition">

                        <!-- Toggle icon eye -->
                        <span onclick="togglePassword('password', 'toggleIcon')"
                            class="absolute right-3.5 top-[37px] cursor-pointer">
                            <img src="{{ asset('img/icon/eye-icon.png') }}" id="toggleIcon"
                                class="w-5 h-5 opacity-60 hover:opacity-100 transition">
                        </span>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full py-3.5 rounded-xl text-white font-medium text-xs bg-blue-700 hover:bg-blue-800  tracking-wide transition">
                        MASUK KE AKUN
                    </button>

                    <!-- Register -->
                    <p class="text-center text-xs text-gray-500">
                        Belum punya akun?
                        <a href="/" class="text-blue-600 font-medium hover:underline">
                            Daftar Sekarang
                        </a>
                    </p>

                </form>

            </div>

        </div>

    </div>

</body>

<!-- Js toggle password visibility -->
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

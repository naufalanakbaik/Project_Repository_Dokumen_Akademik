<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Pustaka Katalog</title>

    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-200 flex justify-center items-center p-5">

    <!-- Logo pojok kiri -->
    <div class="absolute top-5 left-5">
        <img src="{{ asset('img/katalog-pustaka2.png') }}" class="h-[50px] sm:h-[35px]" />
    </div>

    <!-- Container -->
    <div class="w-full max-w-[420px] bg-white rounded-[18px] shadow-[0_12px_28px_rgba(0,0,0,0.08)] px-8 py-10 flex flex-col gap-6 sm:px-5 sm:py-7">

        <h1 class="text-center text-[2rem] sm:text-[24px] font-semibold text-[#053498] border-b-2 border-[#b0c8d4] pb-2">
            Halaman Login
        </h1>

        <form action="{{ route('loginProses') }}" method="post">
            @csrf

            <!-- Email -->
            <div class="relative mt-6">
                <input type="text" name="email" required
                    class="peer w-full px-3 py-3 border-[1.8px] border-[#b0c8d4] rounded-[10px] bg-transparent outline-none focus:border-[#1b59df] focus:ring-4 focus:ring-[rgba(19,52,74,0.08)]">

                <label
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white px-1 text-[15px] text-[#5d666e] transition-all
                    peer-focus:-top-2 peer-focus:left-3 peer-focus:text-[12px] peer-focus:text-[#1b59df]
                    peer-valid:-top-2 peer-valid:left-3 peer-valid:text-[12px] peer-valid:text-[#1b59df]">
                    Email
                </label>

                @error('email')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative mt-6">
                <input type="password" name="password" id="password" required
                    class="peer w-full px-3 py-3 border-[1.8px] border-[#b0c8d4] rounded-[10px] bg-transparent outline-none focus:border-[#1b59df] focus:ring-4 focus:ring-[rgba(19,52,74,0.08)]">

                <label
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white px-1 text-[15px] text-[#5d666e] transition-all
                    peer-focus:-top-2 peer-focus:left-3 peer-focus:text-[12px] peer-focus:text-[#1b59df]
                    peer-valid:-top-2 peer-valid:left-3 peer-valid:text-[12px] peer-valid:text-[#1b59df]">
                    Password
                </label>

                <!-- Toggle -->
                <span onclick="togglePassword('password', 'toggleIcon')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer flex items-center h-full">
                    <img src="{{ asset('img/icon/eye-icon.png') }}" id="toggleIcon"
                        class="w-[21px] h-[21px] opacity-60 hover:opacity-100 transition">
                </span>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full mt-8 py-3 rounded-xl text-white font-semibold text-[16px]
                bg-gradient-to-r from-[#2866ed] to-[#1e40af]
                hover:from-[#1b5ae3] hover:to-[#103dd3]
                transition transform hover:scale-[1.01]">
                MASUK
            </button>

            <!-- Register -->
            <div class="mt-3 text-center text-[14px] text-[#4d728b]">
                Belum punya akun? &raquo;
                <a href="{{ route('register') }}" class="text-[#174ec5] font-medium hover:underline">
                    Registrasi
                </a>
            </div>

        </form>
    </div>

    <!-- @include('sweetalert::alert') -->

</body>

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
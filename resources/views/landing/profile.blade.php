@extends('landing.layouts.public')
@section('title', 'Profile Kami')

@section('content')

    {{-- Hero Section --}}
    <section
        class="relative overflow-hidden bg-gradient-to-br from-yellow-50 via-amber-50 to-white border-b border-yellow-100">

        {{-- Soft Decoration --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-yellow-200/50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[350px] h-[350px] bg-amber-200/50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full max-w-[77rem] mx-auto px-6 py-16 lg:py-16">
            <div class="max-w-3xl">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-300 bg-white/80 backdrop-blur-sm 
                    text-yellow-700 text-sm font-medium shadow-sm mb-6">
                    <span class="material-symbols-outlined !text-[18px] text-yellow-600">
                        help
                    </span>
                    Tentang Repository
                </div>

                {{-- Heading --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight tracking-tight text-gray-900">
                    Repository Dokumen Akademik
                    <span class="text-yellow-600">
                        Prodi Manajemen Informatika 
                    </span>
                </h1>

                {{-- Description --}}
                <p class="mt-6 text-sm leading-relaxed text-gray-600 max-w-2xl">
                    Sistem repository digital Program Studi Manajemen Informatika
                    Fakultas Ilmu Komputer Universitas Sriwijaya yang digunakan
                    untuk menyimpan, mengelola, dan mendistribusikan dokumen
                    akademik secara modern, terstruktur, dan terpusat.
                </p>

                {{-- Info --}}
                <div class="flex flex-wrap gap-4 mt-8">
                    <div class="flex items-center gap-3 px-5 py-3 rounded-xl border border-gray-200 bg-white shadow-sm">
                        <span class="material-symbols-outlined text-yellow-600">
                            school
                        </span>
                        <div>
                            <p class="text-xs text-gray-500">
                                Fakultas
                            </p>
                            <h4 class="text-sm font-semibold text-gray-800">
                                Ilmu Komputer
                            </h4>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 px-5 py-3 rounded-xl border border-gray-200 bg-white shadow-sm">
                        <span class="material-symbols-outlined text-amber-600">
                            account_balance
                        </span>

                        <div>
                            <p class="text-xs text-gray-500">
                                Universitas
                            </p>
                            <h4 class="text-sm font-semibold text-gray-800">
                                Universitas Sriwijaya
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

    {{-- About Section --}}
    <section class="relative bg-white">

        {{-- Soft Shadow --}}
        <div class="absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-black/[0.03] to-transparent blur-2xl"></div>

        <div class="max-w-[78rem] mx-auto px-6 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

                {{-- Left --}}
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-amber-200
                        bg-amber-50 text-amber-700 text-sm font-medium mb-5">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Profil Sistem
                    </div>

                    <h2 class="text-3xl font-bold tracking-tight text-gray-950 leading-tight">
                        Sistem Penyimpanan
                        Dokumen Akademik Modern
                    </h2>

                    <p class="mt-5 text-[15px] leading-relaxed text-gray-600">
                        Repository ini dirancang untuk membantu mahasiswa,
                        dosen, dan program studi dalam mengelola dokumen
                        akademik secara lebih efektif dan efisien.
                        Seluruh dokumen tersimpan dalam satu sistem digital
                        yang dapat diakses dengan cepat, aman, dan terstruktur.
                    </p>

                    <p class="mt-4 text-[15px] leading-relaxed text-gray-600">
                        Sistem mendukung pengelolaan laporan tugas akhir,
                        laporan kerja praktik, jurnal mahasiswa,
                        modul praktikum, serta berbagai dokumen akademik lainnya.
                    </p>

                </div>

                {{-- Right --}}
                <div class="relative overflow-hidden rounded-3xl border border-yellow-100 bg-gradient-to-br from-yellow-50 via-white to-amber-50 p-8 shadow-sm">

                    {{-- Glow --}}
                    <div class="absolute top-0 right-0 w-52 h-52 bg-yellow-300/30 rounded-full blur-3xl"> </div>

                    <div class="relative space-y-5">
                        {{-- Item --}}
                        <div class="flex gap-4 p-5 rounded-2xl border border-gray-200 bg-white shadow-sm">
                            <div class="w-14 h-14 rounded-xl bg-yellow-100 border border-yellow-200 flex items-center justify-center
                                text-yellow-700 shrink-0">
                                <span class="material-symbols-outlined !text-[28px]">
                                    security
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    Keamanan Data
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    Dokumen tersimpan secara aman dengan sistem
                                    validasi dan pengelolaan akses pengguna.
                                </p>
                            </div>

                        </div>

                        {{-- Item --}}
                        <div class="flex gap-4 p-5 rounded-2xl border border-gray-200 bg-white shadow-sm">
                            <div class="w-14 h-14 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center text-amber-700 shrink-0">
                                <span class="material-symbols-outlined !text-[28px]">
                                    manage_search
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    Pencarian Cepat
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    Mempermudah pengguna menemukan dokumen
                                    akademik secara lebih efisien.
                                </p>
                            </div>
                        </div>

                        {{-- Item --}}
                        <div class="flex gap-4 p-5 rounded-2xl
                            border border-gray-200 bg-white shadow-sm">

                            <div class="w-14 h-14 rounded-xl bg-yellow-100 border border-yellow-200 flex items-center justify-center
                                text-yellow-700 shrink-0">
                                <span class="material-symbols-outlined !text-[28px]">
                                    cloud_done
                                </span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    Akses Terpusat
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    Semua dokumen akademik berada dalam satu
                                    platform digital modern.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- Vision Mission --}}
    <section class="relative overflow-hidden border-y border-yellow-10 bg-gradient-to-br from-yellow-50 via-amber-50 to-white">

        {{-- Soft Decoration --}}
        <div class="absolute left-0 top-0 w-80 h-80 bg-yellow-200/30 rounded-full blur-3xl"></div>

        <div class="max-w-[78rem] mx-auto px-6 py-20">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-200 bg-white/80 shadow-sm text-sm font-medium
                    text-yellow-700 mb-5">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Visi & Misi
                </div>

                <h2 class="text-3xl font-bold tracking-tight text-gray-950">
                    Mendukung Transformasi
                    Digital Akademik
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-12">
                {{-- Vision --}}
                <div class="rounded-3xl border border-yellow-200 bg-white/80 backdrop-blur-sm p-8 shadow-sm">
                    <div class="w-14 h-14 rounded-xl bg-yellow-100 border border-yellow-200 flex items-center justify-center text-yellow-700 mb-5">
                        <span class="material-symbols-outlined !text-[28px]">
                            visibility
                        </span>
                    </div>

                    <h3 class="text-2xl font-semibold text-gray-900">
                        Visi
                    </h3>

                    <p class="mt-4 text-[15px] leading-relaxed text-gray-600">
                        Menjadi sistem repository akademik modern yang mampu
                        mendukung pengelolaan dan distribusi dokumen secara
                        efektif, aman, dan terintegrasi.
                    </p>

                </div>

                {{-- Mission --}}
                <div class="rounded-3xl border border-amber-200 bg-white/80 backdrop-blur-sm p-8 shadow-sm">
                    <div class="w-14 h-14 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center text-amber-700 mb-5">
                        <span class="material-symbols-outlined !text-[28px]">
                            flag
                        </span>
                    </div>

                    <h3 class="text-2xl font-semibold text-gray-900">
                        Misi
                    </h3>

                    <ul class="mt-4 space-y-4 text-[15px] leading-relaxed text-gray-600">
                        <li class="flex gap-3">
                            <span class="text-yellow-600 mt-1">•</span>
                            Meningkatkan efisiensi pengelolaan dokumen akademik.
                        </li>
                        <li class="flex gap-3">
                            <span class="text-yellow-600 mt-1">•</span>
                            Menyediakan akses informasi akademik yang cepat.
                        </li>
                        <li class="flex gap-3">
                            <span class="text-yellow-600 mt-1">•</span>
                            Mendukung digitalisasi administrasi akademik modern.
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </section>

@endsection

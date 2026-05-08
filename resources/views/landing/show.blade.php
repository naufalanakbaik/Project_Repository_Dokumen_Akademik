@extends('landing.layouts.public')

{{-- @section('title', $document->title) --}}
@section('meta_description', $document->description)

@section('content')

    {{-- HEADER --}}
    <section class="relative overflow-hidden hero-gradient border-b border-gray-200">

        {{-- Blur --}}
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-20">

            <div class="max-w-4xl">

                {{-- Category --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-sm font-semibold mb-6">

                    <span class="material-icons-outlined text-[18px]">
                        category
                    </span>

                    {{ $document->category->name }}
                </div>

                {{-- Title --}}
                <h1 class="text-5xl font-extrabold leading-tight tracking-tight text-gray-950">

                    {{ $document->title }}
                </h1>

                {{-- Meta --}}
                <div class="mt-8 flex flex-wrap items-center gap-4">

                    {{-- User --}}
                    <div
                        class="inline-flex items-center gap-3 px-4 py-3 rounded-2xl bg-white border border-gray-200 shadow-sm">

                        <div
                            class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600">

                            <span class="material-icons-outlined text-[20px]">
                                person
                            </span>

                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $document->user->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ ucfirst($document->user->role) }}
                            </p>
                        </div>

                    </div>

                    {{-- Year --}}
                    <div
                        class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-white border border-gray-200 shadow-sm text-sm font-medium text-gray-700">

                        <span class="material-icons-outlined text-[20px]">
                            calendar_month
                        </span>

                        Tahun {{ $document->tahun_terbit ?? '-' }}
                    </div>

                    {{-- Upload --}}
                    <div
                        class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-white border border-gray-200 shadow-sm text-sm font-medium text-gray-700">

                        <span class="material-icons-outlined text-[20px]">
                            schedule
                        </span>

                        {{ $document->created_at->format('d M Y') }}
                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- CONTENT --}}
    <section class="max-w-7xl mx-auto px-6 py-16">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Description --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">

                    <div class="flex items-center gap-3 mb-6">

                        <div
                            class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">

                            <span class="material-icons-outlined text-[24px]">
                                description
                            </span>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-gray-900">
                                Informasi Dokumen
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Detail repository akademik publik
                            </p>

                        </div>

                    </div>

                    <div class="space-y-6">

                        <div>

                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">
                                Judul Dokumen
                            </h3>

                            <p class="mt-3 text-lg leading-relaxed text-gray-800">
                                {{ $document->title }}
                            </p>

                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">
                                Deskripsi
                            </h3>

                            <p class="mt-3 text-gray-600 leading-relaxed">
                                Dokumen akademik yang telah dipublikasikan dalam sistem repository.
                                Untuk melihat file lengkap dan melakukan download dokumen,
                                silakan login ke sistem repository akademik.
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Locked Preview --}}
                <div
                    class="relative overflow-hidden bg-white border border-gray-200 rounded-3xl shadow-sm">

                    {{-- Blur Overlay --}}
                    <div
                        class="absolute inset-0 backdrop-blur-sm bg-white/60 z-10 flex flex-col items-center justify-center text-center p-10">

                        <div
                            class="w-20 h-20 rounded-3xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6">

                            <span class="material-icons-outlined text-[42px]">
                                lock
                            </span>

                        </div>

                        <h3 class="text-2xl font-bold text-gray-900">
                            Preview Dokumen Dikunci
                        </h3>

                        <p class="mt-4 text-gray-600 max-w-lg leading-relaxed">
                            Login diperlukan untuk melihat preview PDF lengkap
                            dan mengunduh file dokumen repository.
                        </p>

                        <a href="{{ route('login') }}"
                            class="mt-8 px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-sm transition">

                            Login untuk Akses Penuh
                        </a>

                    </div>

                    {{-- Fake Preview --}}
                    <div class="p-10 opacity-40">

                        <div class="space-y-4">

                            <div class="h-6 bg-gray-200 rounded-xl w-3/4"></div>
                            <div class="h-6 bg-gray-200 rounded-xl"></div>
                            <div class="h-6 bg-gray-200 rounded-xl w-5/6"></div>

                            <div class="pt-6 space-y-3">

                                <div class="h-4 bg-gray-200 rounded-lg"></div>
                                <div class="h-4 bg-gray-200 rounded-lg"></div>
                                <div class="h-4 bg-gray-200 rounded-lg w-11/12"></div>
                                <div class="h-4 bg-gray-200 rounded-lg"></div>
                                <div class="h-4 bg-gray-200 rounded-lg w-10/12"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-6">

                {{-- Access Card --}}
                <div class="bg-gray-950 text-white rounded-3xl p-8 overflow-hidden relative">

                    {{-- Blur --}}
                    <div
                        class="absolute top-0 right-0 w-[200px] h-[200px] bg-blue-500/20 rounded-full blur-3xl">
                    </div>

                    <div class="relative">

                        <div
                            class="w-14 h-14 rounded-2xl bg-white/10 border border-white/10 flex items-center justify-center mb-6">

                            <span class="material-icons-outlined text-[28px]">
                                verified_user
                            </span>

                        </div>

                        <h2 class="text-2xl font-bold leading-snug">
                            Akses Repository Lengkap
                        </h2>

                        <p class="mt-4 text-gray-300 leading-relaxed">
                            Login untuk mengakses seluruh file repository,
                            preview PDF lengkap, dan fitur download dokumen.
                        </p>

                        <a href="{{ route('login') }}"
                            class="mt-8 inline-flex items-center justify-center w-full h-12 rounded-2xl bg-white text-gray-900 font-semibold hover:bg-gray-100 transition">

                            Login Sistem
                        </a>

                    </div>

                </div>

                {{-- Information --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">

                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        Informasi Tambahan
                    </h3>

                    <div class="space-y-5">

                        <div class="flex items-start gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">

                                <span class="material-icons-outlined text-[22px]">
                                    security
                                </span>

                            </div>

                            <div>

                                <h4 class="font-semibold text-gray-900">
                                    Dokumen Terverifikasi
                                </h4>

                                <p class="mt-1 text-sm text-gray-500 leading-relaxed">
                                    Dokumen telah melalui proses validasi admin repository.
                                </p>

                            </div>

                        </div>

                        <div class="flex items-start gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center shrink-0">

                                <span class="material-icons-outlined text-[22px]">
                                    cloud_done
                                </span>

                            </div>

                            <div>

                                <h4 class="font-semibold text-gray-900">
                                    Repository Terpusat
                                </h4>

                                <p class="mt-1 text-sm text-gray-500 leading-relaxed">
                                    Dokumen disimpan secara digital dan terintegrasi.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
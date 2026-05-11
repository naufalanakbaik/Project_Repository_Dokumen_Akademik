@extends('landing.layouts.public')

@section('title', $document->title)
@section('meta_description', $document->description)

@section('content')

    {{-- Hero Section --}}
    <section
        class="relative overflow-hidden bg-gradient-to-br from-yellow-50 via-amber-50 to-white border-b border-yellow-100">

        {{-- Soft Decoration --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-yellow-200/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="absolute bottom-0 right-0 w-[350px] h-[350px] bg-amber-100/50 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative w-full max-w-[77rem] mx-auto px-6 py-16 lg:py-16">
            <div class="flex items-start justify-between gap-6">

                {{-- Left Content --}}
                <div class="max-w-3xl">
                    {{-- Category --}}
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-300 bg-white/80 backdrop-blur-sm
                        text-yellow-700 text-sm font-medium shadow-sm mb-6">
                        <span class="material-symbols-outlined !text-[18px] text-yellow-600">
                            folder_open
                        </span>
                        {{ $document->category->name }}
                    </div>

                    {{-- Title --}}
                    <h1 class="text-4xl md:text-4xl font-bold tracking-tight leading-tight text-gray-950">
                        {{ $document->title }}
                    </h1>

                    {{-- Description --}}
                    <p class="mt-6 text-base leading-relaxed text-gray-600 max-w-4xl">
                        Dokumen akademik yang telah dipublikasikan
                        dalam sistem repository digital dan tersedia
                        untuk ditinjau oleh seluruh pengguna.
                    </p>

                    {{-- Meta --}}
                    <div class="mt-8 flex flex-wrap items-center gap-5">
                        {{-- User --}}
                        <div class="flex items-center gap-2">
                            {{-- Avatar --}}
                            <div class="w-10 h-10 rounded-full bg-gray-50 border border-gray-300 flex items-center justify-center text-gray-700
                                text-sm font-semibold">
                                {{ strtoupper(substr($document->user->name, 0, 1)) }}
                            </div>

                            {{-- Info --}}
                            <div class="leading-tight">
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $document->user->name }}
                                </p>
                                <p class="text-[12px] text-gray-600 capitalize">
                                    {{ $document->user->role }}
                                </p>
                            </div>

                        </div>

                        {{-- Divider --}}
                        <div class="hidden sm:block w-1 h-1 rounded-full bg-gray-500"></div>

                        {{-- Year --}}
                        <div class="inline-flex items-center gap-2 text-sm text-gray-700">
                            <span class="material-symbols-outlined !text-[17px] text-yellow-600">
                                calendar_check
                            </span>
                            Tahun terbit
                            {{ $document->tahun_terbit ?? '-' }}
                        </div>
                    </div>

                </div>

                {{-- Right Action --}}
                <div class="hidden md:block">
                    <a href="{{ route('repository') }}" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full border border-gray-300 bg-white/90 
                        backdrop-blur-sm text-gray-700 text-[13.5px] font-medium shadow-sm hover:bg-gray-50 hover:border-gray-400 transition">
                        Back
                        <span class="material-symbols-outlined !text-[15px]">
                            low_priority
                        </span>
                    </a>
                </div>

            </div>

        </div>

    </section>

    {{-- Content --}}
    <section class="max-w-[78rem] mx-auto px-6 py-12">

        {{-- Top Grid --}}
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-7 mb-7">

            {{-- Information --}}
            <div class="xl:col-span-3 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="flex items-center gap-4 px-7 py-4 border-b border-gray-100 bg-gray-50/70">
                    <div
                        class="flex items-center justify-center w-11 h-11 rounded-lg border border-amber-200 bg-amber-50 text-amber-700 shrink-0">
                        <span class="material-symbols-outlined !text-[23px]">
                            description
                        </span>
                    </div>
                    <div>
                        <h2 class="text-[18px] font-semibold tracking-tight text-gray-900">
                            Informasi Dokumen
                        </h2>
                        <p class="text-[13px] text-gray-500">
                            Detail repository akademik publik
                        </p>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-7 space-y-6">
                    {{-- Title --}}
                    <div>
                        <h3 class="text-[13px] font-medium text-gray-500 mb-2.5">
                            Judul Dokumen
                        </h3>
                        <p class="text-[17px] leading-relaxed font-semibold text-gray-800">
                            {{ $document->title }}
                        </p>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-dashed border-gray-200"></div>

                    {{-- Description --}}
                    <div>
                        <h3 class="text-[13px] font-medium text-gray-500 mb-2.5">
                            Deskripsi
                        </h3>
                        <p class="text-[14px] text-gray-600">
                            Dokumen akademik yang telah dipublikasikan dalam sistem
                            repository digital program studi. Untuk melihat preview
                            PDF lengkap dan mengunduh dokumen, silakan login terlebih
                            dahulu ke sistem repository akademik.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Additional Info --}}
            <div class="xl:col-span-1 rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="p-6 space-y-5">

                    {{-- Item --}}
                    <div class="flex items-start gap-3">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-xl border border-yellow-200 bg-yellow-50 text-yellow-700 
                        shrink-0">
                            <span class="material-symbols-outlined !text-[18px]">
                                verified
                            </span>
                        </div>

                        <div>
                            <p class="text-[13px] font-semibold text-gray-900">
                                Dokumen Terverifikasi
                            </p>
                            <p class="text-[12px] text-gray-500 mt-1">
                                Sudah divalidasi admin repository.
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-dashed border-gray-200"></div>

                    {{-- Item --}}
                    <div class="flex items-start gap-3">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-xl border border-red-200 bg-red-50 text-red-700 shrink-0">
                            <span class="material-symbols-outlined !text-[18px]">
                                picture_as_pdf
                            </span>
                        </div>

                        <div>
                            <p class="text-[13px] font-semibold text-gray-900">
                                Format PDF
                            </p>
                            <p class="text-[12px] text-gray-500 mt-1">
                                Dokumen tersedia dalam format PDF.
                            </p>
                        </div>

                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-dashed border-gray-200"></div>

                    {{-- Item --}}
                    <div class="flex items-start gap-3">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 
                            shrink-0">
                            <span class="material-symbols-outlined !text-[18px]">
                                cloud_done
                            </span>
                        </div>

                        <div>
                            <p class="text-[13px] font-semibold text-gray-900">
                                Repository Digital
                            </p>
                            <p class="text-[12px] text-gray-500 mt-1">
                                Tersimpan aman di sistem repository.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Locked Preview --}}
        <div class="relative overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

            {{-- Overlay --}}
            <div
                class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-white/75 backdrop-blur-[2px] text-center px-6">
                {{-- Icon --}}
                <div
                    class="flex items-center justify-center w-20 h-20 rounded-2xl border border-yellow-200 bg-yellow-50 text-yellow-700 mb-6">
                    <span class="material-symbols-outlined !text-[38px]">
                        lock
                    </span>
                </div>

                {{-- Title --}}
                <h3 class="text-2xl font-semibold tracking-tight text-gray-900">
                    Preview Dokumen Dikunci
                </h3>

                {{-- Desc --}}
                <p class="max-w-2xl mt-4 text-[14px] leading-5 text-gray-600">
                    Login diperlukan untuk melihat preview PDF lengkap dan
                    mengunduh dokumen repository akademik yang tersedia
                    di sistem.
                </p>

                {{-- Button --}}
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 mt-7 px-4 py-3 rounded-xl bg-gray-950 hover:bg-black
                    text-white text-[13px] font-medium transition">
                    <span class="material-symbols-outlined !text-[18px]">
                        login
                    </span>
                    Login untuk Akses
                </a>
            </div>

            {{-- Fake PDF Preview --}}
            <div class="p-10 md:p-10 opacity-40">
                <div class="space-y-4 mb-10">
                    <div class="h-7 rounded-xl bg-gray-400 w-3/4"></div>
                    <div class="h-6 rounded-xl bg-gray-400"></div>
                    <div class="h-6 rounded-xl bg-gray-400 w-5/6"></div>
                </div>

                <div class="space-y-4">
                    <div class="h-4 rounded-lg bg-gray-400"></div>
                    <div class="h-4 rounded-lg bg-gray-400"></div>
                    <div class="h-4 rounded-lg bg-gray-400 w-11/12"></div>
                    <div class="h-4 rounded-lg bg-gray-400"></div>
                    <div class="h-4 rounded-lg bg-gray-400 w-10/12"></div>
                </div>
            </div>

        </div>

    </section>

@endsection

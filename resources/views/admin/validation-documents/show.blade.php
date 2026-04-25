@extends('admin.layouts.app')
@section('title', 'Detail Validasi Dokumen')

@section('content')
    <div class="max-w-full mx-auto p-6 space-y-6">

        <!-- ===================== -->
        <!-- HEADER -->
        <!-- ===================== -->
        <div class="flex items-start justify-between border-b pb-4">

            <div class="space-y-1">
                <h1 class="text-xl font-semibold text-blue-900">
                    {{ $document->title }}
                </h1>

                <p class="text-sm text-gray-500">
                    Diajukan oleh
                    <span class="font-medium text-gray-700">{{ $document->user->name }}</span>
                </p>
            </div>

            <span
                class="inline-flex items-center gap-1 px-3 py-1 text-xs 
            rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">
                <span class="material-symbols-outlined !text-[14px]">schedule</span>
                Pending Review
            </span>

        </div>


        <!-- ===================== -->
        <!-- CONTENT -->
        <!-- ===================== -->
        <div class="grid grid-cols-12 gap-6">

            <!-- ===================== -->
            <!-- PREVIEW -->
            <!-- ===================== -->
            <div class="col-span-12 lg:col-span-8">

                <div class="bg-white border rounded-xl shadow-sm overflow-hidden flex flex-col">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between px-4 py-3 border-b bg-gray-50">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="material-symbols-outlined !text-[18px]">description</span>
                            Preview Dokumen
                        </div>

                        <a href="{{ route('admin.documents.download', $document->id) }}"
                            class="flex items-center gap-2 text-sm px-3 py-1.5 
                        bg-gray-900 text-white rounded-lg hover:bg-gray-800 active:scale-95 transition">

                            <span class="material-symbols-outlined !text-[18px]">download</span>
                            Download
                        </a>
                    </div>

                    <!-- PDF -->
                    <iframe src="{{ asset('storage/' . $document->file) }}" class="w-full h-[620px] bg-gray-100">
                    </iframe>

                    <!-- FOOTER -->
                    <div class="flex items-center justify-between px-4 py-2 border-t bg-gray-50 text-xs text-gray-500">

                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined !text-[16px]">insert_drive_file</span>
                            {{ basename($document->file) }}
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="uppercase">
                                {{ pathinfo($document->file, PATHINFO_EXTENSION) }}
                            </span>

                            <span>
                                {{ $document->created_at->format('d M Y') }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>


            <!-- ===================== -->
            <!-- SIDEBAR -->
            <!-- ===================== -->
            <div class="col-span-12 lg:col-span-4 space-y-5">

                <!-- INFO -->
                <div class="bg-white border rounded-xl shadow-sm">

                    <div class="px-4 py-3 border-b bg-gray-50 text-sm font-medium text-gray-700">
                        Informasi Dokumen
                    </div>

                    <div class="p-4 space-y-4 text-sm">

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-gray-400 !text-[18px]">person</span>
                            <div>
                                <p class="text-gray-500">Uploader</p>
                                <p class="font-medium text-gray-800">{{ $document->user->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-gray-400 !text-[18px]">category</span>
                            <div>
                                <p class="text-gray-500">Kategori</p>
                                <p class="font-medium text-gray-800">{{ $document->category->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-gray-400 !text-[18px]">schedule</span>
                            <div>
                                <p class="text-gray-500">Tanggal Upload</p>
                                <p class="font-medium text-gray-800">
                                    {{ $document->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- ACTION (STICKY) -->
                <div class="sticky top-6">

                    <div class="bg-white border rounded-xl shadow-sm">

                        <div class="px-4 py-3 border-b bg-gray-50 text-sm font-medium text-gray-700">
                            Validasi Dokumen
                        </div>

                        <div class="p-4 space-y-3">

                            <form action="{{ route('admin.documents.updateStatus', $document->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <!-- APPROVE -->
                                <button type="submit" name="status" value="approved"
                                    onclick="return confirm('Approve dokumen ini?')"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm 
                                bg-green-600 text-white rounded-lg 
                                hover:bg-green-700 active:scale-95 transition">

                                    <span class="material-symbols-outlined !text-[18px]">check_circle</span>
                                    Approve Dokumen
                                </button>

                                <!-- REJECT -->
                                <button type="submit" name="status" value="rejected"
                                    onclick="return confirm('Reject dokumen ini?')"
                                    class="w-full mt-2 flex items-center justify-center gap-2 px-4 py-2 text-sm 
                                bg-red-600 text-white rounded-lg 
                                hover:bg-red-700 active:scale-95 transition">

                                    <span class="material-symbols-outlined !text-[18px]">cancel</span>
                                    Reject Dokumen
                                </button>

                            </form>

                            <!-- NOTE -->
                            <p class="text-xs text-gray-400 pt-2 border-t">
                                Pastikan dokumen telah diperiksa dengan benar sebelum melakukan validasi.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection

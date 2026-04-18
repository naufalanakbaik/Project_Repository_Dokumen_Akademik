@extends('admin.layouts.app')
@section('title', 'Manajemen Dokumen')

@section('content')

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Documents</h1>
            <p class="text-sm text-gray-500">Approved & rejected documents</p>
        </div>

        <div class="flex items-center gap-3">

            <!-- Validation -->
            <a href="{{ route('admin.documents.validation') }}"
                class="flex items-center gap-2 px-3 h-[38px] text-sm border rounded-lg 
                hover:bg-gray-50 transition whitespace-nowrap">

                <span class="material-icons !text-[18px] leading-none align-middle">rule</span>
                <span>Validation</span>
            </a>

            <!-- Upload -->
            <a href="{{ route('admin.documents.create') }}"
                class="flex items-center gap-2 px-3 h-[38px] text-sm bg-blue-600 text-white 
                rounded-lg hover:bg-blue-700 transition whitespace-nowrap">

                <span class="material-icons !text-[18px] leading-none align-middle">upload</span>
                <span>Upload</span>
            </a>

        </div>
    </div>

    <!-- Search -->
    <form method="GET" class="relative max-w-sm">
        <span class="material-icons absolute left-3 top-2.5 text-gray-400 text-[18px]">
            search
        </span>

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search documents..."
            class="w-full pl-9 pr-3 h-[38px] text-sm border rounded-lg 
            focus:ring-2 focus:ring-blue-100 focus:border-blue-400">
    </form>

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        <table class="w-full text-sm table-fixed">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-5 py-3 text-left font-medium w-[30%]">Title</th>
                    <th class="px-5 py-3 text-left font-medium w-[20%]">Kategori</th>
                    <th class="px-5 py-3 text-left font-medium w-[20%]">User</th>
                    <th class="px-5 py-3 text-center font-medium w-[15%]">Status</th>
                    <th class="px-5 py-3 text-right font-medium w-[15%]">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($documents as $doc)
                    <tr class="border-t hover:bg-gray-50 transition">

                        <!-- Title -->
                        <td class="px-5 py-3 font-medium text-gray-800 truncate">
                            {{ $doc->title }}
                        </td>

                        <!-- Category -->
                        <td class="px-5 py-3 text-gray-600 truncate">
                            {{ $doc->category->name }}
                        </td>

                        <!-- User -->
                        <td class="px-5 py-3 text-gray-600 truncate">
                            {{ $doc->user->name }}
                        </td>

                        <!-- Status -->
                        <td class="px-5 py-3 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-1 text-xs rounded-full border
                            {{ $doc->status === 'approved'
                                ? 'bg-green-50 text-green-700 border-green-200'
                                : 'bg-red-50 text-red-700 border-red-200' }}">
                                {{ ucfirst($doc->status) }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-5 py-3 text-right">
                            <div class="flex justify-end items-center gap-3 text-gray-500">

                                <!-- Detail -->
                                <a href="{{ route('admin.documents.show', $doc->id) }}"
                                    class="hover:text-blue-600 transition">
                                    <span class="material-icons !text-[18px] leading-none align-middle">
                                        visibility
                                    </span>
                                </a>

                                <!-- Preview -->
                                <a href="{{ route('admin.documents.preview', $doc->id) }}" target="_blank"
                                    rel="noopener noreferrer" class="hover:text-indigo-600 transition">
                                    <span class="material-icons !text-[18px] leading-none align-middle">
                                        preview
                                    </span>
                                </a>

                                <!-- Download -->
                                <a href="{{ route('admin.documents.download', $doc->id) }}"
                                    class="hover:text-gray-800 transition">
                                    <span class="material-icons !text-[18px] leading-none align-middle">
                                        download
                                    </span>
                                </a>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-400 text-sm">
                            Tidak ada dokumen ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="p-4 border-t bg-gray-50">
            {{ $documents->links() }}
        </div>

    </div>
@endsection

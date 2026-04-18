@extends('dosen.layouts.app')
@section('title', 'Repositori Dokumen Akademik')

@section('content')
<div class="p-6 space-y-6 max-w-[1100px] mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-lg font-semibold">My Documents</h1>
                <p class="text-sm text-gray-500">Upload dan kelola dokumen kamu</p>
            </div>

            <a href="{{ route('dosen.documents.create') }}"
                class="flex items-center gap-2 px-3 h-[38px] text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <span class="material-icons text-[18px]">upload</span>
                Upload
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white border rounded-xl overflow-hidden">

            <table class="w-full text-sm table-fixed">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left w-[40%]">Title</th>
                        <th class="px-4 py-3 text-left w-[25%]">Category</th>
                        <th class="px-4 py-3 text-center w-[20%]">Status</th>
                        <th class="px-4 py-3 text-right w-[15%]">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($documents as $doc)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="px-4 py-3 truncate">{{ $doc->title }}</td>
                            <td class="px-4 py-3">{{ $doc->category->name }}</td>

                            <td class="px-4 py-3 text-center">
                                <span
                                    class="px-2 py-1 text-xs rounded-full border
                                    {{ $doc->status === 'approved'
                                    ? 'bg-green-50 text-green-700 border-green-200'
                                    : ($doc->status === 'pending'
                                    ? 'bg-yellow-50 text-yellow-700 border-yellow-200'
                                    : 'bg-red-50 text-red-700 border-red-200') }}">
                                    {{ ucfirst($doc->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-right flex justify-end gap-2">
                                <a href="{{ route('dosen.documents.show', $doc->id) }}">
                                    <span class="material-icons text-[18px]">visibility</span>
                                </a>

                                <a href="{{ route('dosen.documents.preview', $doc->id) }}" target="_blank">
                                    <span class="material-icons text-[18px]">preview</span>
                                </a>

                                <a href="{{ route('dosen.documents.download', $doc->id) }}">
                                    <span class="material-icons text-[18px]">download</span>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

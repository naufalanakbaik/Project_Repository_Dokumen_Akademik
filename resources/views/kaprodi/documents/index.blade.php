@extends('kaprodi.layouts.app')
@section('title', 'Dashboard Monitoring')

@section('content')
<div class="p-6 max-w-[1200px] mx-auto">

    <h1 class="text-lg font-semibold mb-4">Monitoring Dokumen</h1>

    <div class="bg-white border rounded-xl overflow-hidden">

        <table class="w-full text-sm table-fixed">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left w-[30%]">Title</th>
                    <th class="px-4 py-3 text-left w-[20%]">User</th>
                    <th class="px-4 py-3 text-center w-[15%]">Status</th>
                    <th class="px-4 py-3 text-right w-[15%]">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($documents as $doc)
                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-3">{{ $doc->title }}</td>
                    <td class="px-4 py-3">{{ $doc->user->name }}</td>

                    <td class="px-4 py-3 text-center">
                        {{ ucfirst($doc->status) }}
                    </td>

                    <td class="px-4 py-3 text-right flex justify-end gap-2">
                        <a href="{{ route('kaprodi.documents.preview', $doc->id) }}" target="_blank">Preview</a>
                        <a href="{{ route('kaprodi.documents.download', $doc->id) }}">Download</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@endsection

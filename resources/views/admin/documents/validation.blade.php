@extends('admin.layouts.app')
@section('title', 'Validasi Dokumen')

@section('content')
    <div class="p-6 space-y-6">

        <!-- Header -->
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Validation Queue</h1>
            <p class="text-sm text-gray-500">Documents waiting for approval</p>
        </div>

        <div class="bg-white border rounded-xl overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left">Title</th>
                        <th class="px-5 py-3 text-left">User</th>
                        <th class="px-5 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($documents as $doc)
                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-5 py-3 font-medium">{{ $doc->title }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $doc->user->name }}</td>

                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center gap-2">

                                    <!-- Approve -->
                                    <form method="POST" action="{{ route('admin.documents.updateStatus', $doc->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">

                                        <button onclick="return confirm('Approve dokumen ini?')"
                                            class="px-3 py-1.5 text-xs font-medium rounded-md border
                                    bg-green-50 text-green-700 border-green-200
                                    hover:bg-green-100 transition">
                                            Approve
                                        </button>
                                    </form>

                                    <!-- Reject -->
                                    <form method="POST" action="{{ route('admin.documents.updateStatus', $doc->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">

                                        <button onclick="return confirm('Reject dokumen ini?')"
                                            class="px-3 py-1.5 text-xs font-medium rounded-md border
                                    bg-red-50 text-red-700 border-red-200
                                    hover:bg-red-100 transition">
                                            Reject
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4 border-t bg-gray-50">
                {{ $documents->links() }}
            </div>

        </div>
    </div>
@endsection

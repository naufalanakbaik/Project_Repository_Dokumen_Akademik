@extends('mahasiswa.layouts.app')

@section('content')

<div class="p-6 max-w-[1100px] mx-auto">

    <h1 class="text-lg font-semibold mb-4">Global Documents</h1>

    @foreach($documents as $doc)
        <div class="border-b py-3">
            <a href="{{ route('mahasiswa.documents.showGlobal', $doc->id) }}">
                <p class="font-medium">{{ $doc->title }}</p>
            </a>
            <p class="text-sm text-gray-500">
                {{ $doc->user->name }} • {{ $doc->category->name }}
            </p>
            
        </div>
    @endforeach

    <div class="mt-4">
        {{ $documents->links() }}
    </div>

</div>

@endsection
@extends('admin.layouts.app')

@section('title', 'Kategori Admin')

@section('content')

    <h1 class="text-xl font-bold">Data Kategori</h1>

    <a href="{{ route('admin.categories.create') }}">
        + Tambah Kategori
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>

        @foreach ($categories as $key => $category)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.show', $category->id) }}">Lihat</a>

                    <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>

                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

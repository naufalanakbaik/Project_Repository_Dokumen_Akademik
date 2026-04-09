@extends('admin.layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <h1 class="text-xl font-bold">Tambah Kategori</h1>

    <a href="{{ route('admin.categories.index') }}">
        Kembali
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <label for="name">Nama Kategori:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <button type="submit">Simpan</button>
    </form>
@endsection
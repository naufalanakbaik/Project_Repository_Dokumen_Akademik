@extends('admin.layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <h1>Detail Kategori</h1>

    <div>
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Nama:</strong> {{ $category->name }}</p>
        <p><strong>Dibuat:</strong> {{ $category->created_at }}</p>
        <p><strong>Diupdate:</strong> {{ $category->updated_at }}</p>
    </div>

    <a href="{{ route('admin.categories.index') }}">
        Kembali
    </a>
@endsection

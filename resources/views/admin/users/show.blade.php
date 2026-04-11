@extends('admin.layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <h1>Detail User</h1>

    <div>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
    </div>

    <hr>

    <div>
        <h3>Jumlah Dokumen</h3>
        <p>{{ $user->documents->count() }}</p>
    </div>

    <div>
        <h3>Jumlah Aktivitas</h3>
        <p>{{ $user->logs->count() }}</p>
    </div>

    <a href="{{ route('admin.users.index') }}">Kembali</a>
@endsection

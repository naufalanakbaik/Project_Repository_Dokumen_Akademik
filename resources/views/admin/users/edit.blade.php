@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<h1>Edit User</h1>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $user->name }}">
    <input type="email" name="email" value="{{ $user->email }}">
    <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">

    <select name="role">
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
        <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>Dosen</option>
        <option value="kaprodi" {{ $user->role == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
    </select>

    <button type="submit">Update</button>
</form>
@endsection
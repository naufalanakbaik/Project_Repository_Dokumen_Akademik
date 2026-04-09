@extends('admin.layouts.app')

@section('title', 'Manajemen Dokumen - Admin')

@section('content')
<!-- Tabel Dokumen khusus Admin dengan fitur Validasi -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 italic text-slate-500 text-sm">
        Admin dapat melakukan validasi (Approve/Reject) terhadap dokumen yang diunggah oleh mahasiswa dan dosen.
    </div>
    <!-- ... Content same as shared index but focus on validation ... -->
    @include('mahasiswa.documents.index', ['documents' => $documents, 'categories' => $categories])
</div>
@endsection

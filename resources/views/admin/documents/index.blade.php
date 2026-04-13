@extends('admin.layouts.app')

@section('title', 'Manajemen Dokumen - Admin')

@section('content')
<!-- Tabel Dokumen khusus Admin dengan fitur Validasi -->
<div class="bg-white rounded-lg shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 text-center justify-center border-b border-gray-300 italic text-slate-600 text-sm">
        Admin dapat melakukan validasi (Approve/Reject) terhadap dokumen yang diunggah oleh mahasiswa dan dosen.
    </div>
    
    <!-- ... Content same as shared index but focus on validation ... -->
    @include('mahasiswa.documents.index', ['documents' => $documents, 'categories' => $categories])
</div>
@endsection

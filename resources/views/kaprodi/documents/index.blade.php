@extends('kaprodi.layouts.app')

@section('title', 'Monitoring Dokumen')

@section('content')
<!-- Include shared index view -->
@include('mahasiswa.documents.index', ['documents' => $documents, 'categories' => $categories])
@endsection

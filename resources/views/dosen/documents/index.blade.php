@extends('dosen.layouts.app')

@section('title', 'Repositori Dokumen Akademik')

@section('content')
<!-- Include shared index view -->
@include('mahasiswa.documents.index', ['documents' => $documents, 'categories' => $categories])
@endsection

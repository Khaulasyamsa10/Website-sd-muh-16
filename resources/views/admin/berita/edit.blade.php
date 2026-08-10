@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('page-title', 'Edit Berita')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Edit Berita</h1>

        <p>
            Perbarui berita “{{ $berita->judul }}”.
        </p>

    </div>

</div>

@include('admin.berita._form')

@endsection
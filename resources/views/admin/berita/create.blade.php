@extends('admin.layouts.app')

@section('title', 'Tambah Berita')

@section('page-title', 'Tambah Berita')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Tambah Berita</h1>

        <p>
            Tambahkan informasi atau kegiatan terbaru sekolah.
        </p>

    </div>

</div>

@include('admin.berita._form')

@endsection
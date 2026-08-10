@extends('admin.layouts.app')

@section('title', 'Tambah Galeri')

@section('page-title', 'Tambah Galeri')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Tambah Galeri</h1>

        <p>
            Tambahkan dokumentasi foto atau video sekolah.
        </p>

    </div>

</div>

@include('admin.galeri._form')

@endsection
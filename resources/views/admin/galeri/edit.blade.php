@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

@section('page-title', 'Edit Galeri')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Edit Galeri</h1>

        <p>
            Perbarui dokumentasi
            <strong>{{ $galeri->judul }}</strong>.
        </p>

    </div>

</div>

@include('admin.galeri._form')

@endsection
@extends('admin.layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

@section('page-title', 'Tambah Ekstrakurikuler')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Tambah Ekstrakurikuler</h1>

        <p>
            Tambahkan kegiatan ekstrakurikuler baru.
        </p>

    </div>

</div>


@include(
    'admin.ekstrakurikuler._form'
)

@endsection
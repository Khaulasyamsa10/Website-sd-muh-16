@extends('admin.layouts.app')

@section('title', 'Edit PPDB')

@section('page-title', 'Edit PPDB')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Edit Data PPDB</h1>

        <p>
            Perbarui informasi PPDB tahun ajaran
            <strong>{{ $ppdb->tahun_ajaran }}</strong>.
        </p>

    </div>

    <a href="{{ route('admin.ppdb.index') }}"
       class="ppdb-admin-cancel-button">

        <i class="fa-solid fa-arrow-left"></i>

        Kembali

    </a>

</div>


@include('admin.ppdb._form', [
    'ppdb' => $ppdb
])

@endsection
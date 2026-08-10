@extends('admin.layouts.app')

@section('title', 'Tambah PPDB')

@section('page-title', 'Tambah PPDB')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Tambah Data PPDB</h1>

        <p>
            Tambahkan informasi PPDB untuk tahun ajaran baru.
        </p>
    </div>

</div>

@include('admin.ppdb._form')

@endsection
@extends('admin.layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('page-title', 'Edit Ekstrakurikuler')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Edit Ekstrakurikuler</h1>

        <p>
            Perbarui data
            <strong>
                {{ $ekstrakurikuler->nama }}
            </strong>.
        </p>

    </div>

</div>


@include(
    'admin.ekstrakurikuler._form'
)

@endsection
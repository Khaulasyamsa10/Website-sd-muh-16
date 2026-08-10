@extends('admin.layouts.app')

@section('title', 'Tambah Prestasi')

@section('page-title', 'Prestasi Sekolah')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Tambah Prestasi</h1>

        <p>
            Masukkan informasi prestasi siswa atau sekolah.
        </p>
    </div>

    <a href="{{ route('admin.prestasi.index') }}"
       class="admin-secondary-button">

        <i class="fa-solid fa-arrow-left"></i>
        Kembali

    </a>

</div>


@if($errors->any())

    <div class="admin-error-message">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>
            <strong>Data belum berhasil disimpan.</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    </div>

@endif


<div class="admin-form-card">

    <form action="{{ route('admin.prestasi.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @include('admin.prestasi._form')

        <div class="prestasi-form-actions">

            <a href="{{ route('admin.prestasi.index') }}"
               class="prestasi-cancel-button">

                Batal

            </a>

            <button type="submit"
                    class="prestasi-save-button">

                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Prestasi

            </button>

        </div>

    </form>

</div>

@endsection
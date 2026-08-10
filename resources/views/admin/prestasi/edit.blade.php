@extends('admin.layouts.app')

@section('title', 'Edit Prestasi')

@section('page-title', 'Prestasi Sekolah')

@section('content')

<div class="admin-page-header">

    <div>

        <h1>Edit Prestasi</h1>

        <p>
            Perbarui informasi prestasi siswa atau sekolah.
        </p>

    </div>

    <a href="{{ route('admin.prestasi.index') }}"
       class="admin-secondary-button">

        <i class="fa-solid fa-arrow-left"></i>

        Kembali

    </a>

</div>


<div class="admin-form-card">

    <form
        action="{{ route(
            'admin.prestasi.update',
            $prestasi
        ) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('admin.prestasi._form')


        <div class="prestasi-form-actions">

            <a href="{{ route('admin.prestasi.index') }}"
               class="prestasi-cancel-button">

                Batal

            </a>

            <button
                type="submit"
                class="prestasi-save-button">

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>

@endsection
@extends('admin.layouts.app')

@section('title', 'Tambah Agenda')

@section('page-title', 'Tambah Agenda')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Tambah Agenda</h1>
        <p>Tambahkan agenda kegiatan sekolah.</p>
    </div>

    <a href="{{ route('admin.agenda.index') }}"
       class="admin-back-button">

        <i class="fa-solid fa-arrow-left"></i>
        Kembali

    </a>

</div>

@if($errors->any())

    <div class="admin-error-message">

        <strong>Data belum benar:</strong>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif

<div class="admin-form-card">

    <form action="{{ route('admin.agenda.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="admin-form-group">

            <label for="judul">Judul Agenda</label>

            <input type="text"
                   id="judul"
                   name="judul"
                   value="{{ old('judul') }}"
                   required>

        </div>

        <div class="admin-form-grid">

            <div class="admin-form-group">

                <label for="tanggal">Tanggal</label>

                <input type="date"
                    id="tanggal"
                    name="tanggal"
                    value="{{ old('tanggal') }}">

                <small>
                    Boleh dikosongkan untuk agenda berupa peringatan atau pengumuman.
                </small>

            </div>

            <div class="admin-form-group">

                <label for="jam_mulai">Jam Mulai</label>

                <input type="time"
                    id="jam_mulai"
                    name="jam_mulai"
                    value="{{ old('jam_mulai') }}">

            </div>

            <div class="admin-form-group">

                <label for="jam_selesai">Jam Selesai</label>

                <input type="time"
                       id="jam_selesai"
                       name="jam_selesai"
                       value="{{ old('jam_selesai') }}">

            </div>

        </div>

        <div class="admin-form-group">

            <label for="lokasi">Lokasi</label>

            <input type="text"
                id="lokasi"
                name="lokasi"
                value="{{ old('lokasi') }}"
                placeholder="Contoh: Aula sekolah">

            <small>
                Kosongkan apabila agenda tidak memiliki lokasi khusus.
            </small>

        </div>

        <div class="admin-form-group">

            <label for="deskripsi">Deskripsi</label>

            <textarea id="deskripsi"
                      name="deskripsi"
                      rows="5">{{ old('deskripsi') }}</textarea>

        </div>

        <div class="admin-form-group">

            <label for="gambar">Gambar Agenda</label>

            <input type="file"
                   id="gambar"
                   name="gambar"
                   accept=".jpg,.jpeg,.png,.webp">

            <small>
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
            </small>

        </div>

        <div class="admin-checkbox-group">

            <input type="hidden" name="aktif" value="0">

            <input type="checkbox"
                   id="aktif"
                   name="aktif"
                   value="1"
                   @checked(old('aktif', true))>

            <label for="aktif">
                Tampilkan agenda di website
            </label>

        </div>

        <button type="submit"
                class="admin-submit-button">

            <i class="fa-solid fa-floppy-disk"></i>
            Simpan Agenda

        </button>

    </form>

</div>

@endsection
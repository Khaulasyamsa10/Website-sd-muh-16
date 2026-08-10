@extends('admin.layouts.app')

@section('title', 'Edit Agenda')

@section('page-title', 'Edit Agenda')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Edit Agenda</h1>
        <p>Perbarui informasi agenda sekolah.</p>
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

    <form action="{{ route('admin.agenda.update', $agenda) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="admin-form-group">

            <label for="judul">Judul Agenda</label>

            <input type="text"
                   id="judul"
                   name="judul"
                   value="{{ old('judul', $agenda->judul) }}"
                   required>

        </div>

        <div class="admin-form-grid">

            <div class="admin-form-group">

                <label for="tanggal">Tanggal</label>

                <input type="date"
                    id="tanggal"
                    name="tanggal"
                    value="{{ old(
                        'tanggal',
                        $agenda->tanggal
                            ? $agenda->tanggal->format('Y-m-d')
                            : ''
                    ) }}">

            </div>

            <div class="admin-form-group">

                <label for="jam_mulai">Jam Mulai</label>

                <input type="time"
                    id="jam_mulai"
                    name="jam_mulai"
                    value="{{ old(
                        'jam_mulai',
                        $agenda->jam_mulai
                            ? substr($agenda->jam_mulai, 0, 5)
                            : ''
                    ) }}">

            </div>

            <div class="admin-form-group">

                <label for="jam_selesai">Jam Selesai</label>

                <input type="time"
                    id="jam_selesai"
                    name="jam_selesai"
                    value="{{ old(
                        'jam_selesai',
                        $agenda->jam_selesai
                            ? substr($agenda->jam_selesai, 0, 5)
                            : ''
                    ) }}">

            </div>

        </div>

        <div class="admin-form-group">

            <label for="lokasi">Lokasi</label>

            <input type="text"
                id="lokasi"
                name="lokasi"
                value="{{ old('lokasi', $agenda->lokasi) }}"
                placeholder="Contoh: Aula sekolah">

        </div>

        <div class="admin-form-group">

            <label for="deskripsi">Deskripsi</label>

            <textarea id="deskripsi"
                      name="deskripsi"
                      rows="5">{{ old(
                          'deskripsi',
                          $agenda->deskripsi
                      ) }}</textarea>

        </div>

        <div class="admin-form-group">

            <label for="gambar">Ganti Gambar</label>

            <input type="file"
                   id="gambar"
                   name="gambar"
                   accept=".jpg,.jpeg,.png,.webp">

            <small>
                Kosongkan apabila tidak ingin mengganti gambar.
            </small>

            @if($agenda->gambar)

                <div class="agenda-current-image">

                    <p>Gambar saat ini:</p>

                    <img src="{{ asset('storage/' . $agenda->gambar) }}"
                         alt="{{ $agenda->judul }}">

                </div>

            @endif

        </div>

        <div class="admin-checkbox-group">

            <input type="hidden" name="aktif" value="0">

            <input type="checkbox"
                   id="aktif"
                   name="aktif"
                   value="1"
                   @checked(old('aktif', $agenda->aktif))>

            <label for="aktif">
                Tampilkan agenda di website
            </label>

        </div>

        <button type="submit"
                class="admin-submit-button">

            <i class="fa-solid fa-floppy-disk"></i>
            Simpan Perubahan

        </button>

    </form>

</div>

@endsection
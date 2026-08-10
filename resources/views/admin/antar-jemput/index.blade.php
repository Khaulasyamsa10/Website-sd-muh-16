@extends('admin.layouts.app')

@section('title', 'Kelola Antar Jemput')

@section('page-title', 'Antar Jemput')

@section('content')

<div class="admin-page-header">

    <div>
        <h1>Kelola Antar Jemput</h1>

        <p>
            Kelola pamflet dan batas pendaftaran
            layanan antar jemput sekolah.
        </p>
    </div>

</div>


@if(session('success'))

    <div class="admin-success-message">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


@if($errors->any())

    <div class="antar-admin-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>

            <strong>
                Data belum berhasil disimpan.
            </strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    </div>

@endif


<div class="antar-admin-card">

    <form
        action="{{ route('admin.antar-jemput.update') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="antar-admin-grid">


            {{-- ==========================================
                 PAMFLET
            ========================================== --}}

            <div class="antar-admin-panel">

                <div class="antar-admin-panel-header">

                    <div class="antar-admin-panel-icon">

                        <i class="fa-solid fa-image"></i>

                    </div>

                    <div>

                        <h2>
                            Pamflet Antar Jemput
                        </h2>

                        <p>
                            Atur gambar pamflet yang tampil
                            pada halaman website.
                        </p>

                    </div>

                </div>


                <div class="antar-admin-preview-area">

                    @if($antarJemput?->pamflet_gambar)

                        <a
                            href="{{ asset(
                                'storage/' .
                                $antarJemput->pamflet_gambar
                            ) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="antar-admin-preview-link">

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $antarJemput->pamflet_gambar
                                ) }}"
                                alt="Pamflet Antar Jemput">

                        </a>

                        <span class="antar-admin-preview-caption">

                            <i class="fa-solid fa-magnifying-glass-plus"></i>

                            Klik gambar untuk melihat ukuran penuh

                        </span>

                    @else

                        <div class="antar-admin-no-image">

                            <i class="fa-regular fa-image"></i>

                            <strong>
                                Belum Ada Pamflet
                            </strong>

                            <span>
                                Upload gambar pamflet melalui
                                form di bawah.
                            </span>

                        </div>

                    @endif

                </div>


                <div class="antar-admin-form-group">

                    <label for="pamflet_gambar">
                        Upload Pamflet Baru
                    </label>

                    <input
                        type="file"
                        id="pamflet_gambar"
                        name="pamflet_gambar"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small>
                        Format JPG, JPEG, PNG, atau WEBP.
                        Maksimal 5 MB. Kosongkan jika tidak
                        ingin mengganti gambar.
                    </small>

                </div>

            </div>



            {{-- ==========================================
                 BATAS PENDAFTARAN
            ========================================== --}}

            <div class="antar-admin-panel">

                <div class="antar-admin-panel-header">

                    <div class="antar-admin-panel-icon date">

                        <i class="fa-solid fa-calendar-days"></i>

                    </div>

                    <div>

                        <h2>
                            Batas Pendaftaran
                        </h2>

                        <p>
                            Tentukan tanggal terakhir
                            pendaftaran layanan antar jemput.
                        </p>

                    </div>

                </div>


                <div class="antar-admin-date-display">

                    <span>
                        Batas pendaftaran saat ini
                    </span>


                    @if($antarJemput?->batas_pendaftaran)

                        <strong>

                            {{ $antarJemput
                                ->batas_pendaftaran
                                ->locale('id')
                                ->translatedFormat('d F Y')
                            }}

                        </strong>

                    @else

                        <strong class="empty">
                            Belum Ditentukan
                        </strong>

                    @endif

                </div>


                <div class="antar-admin-form-group">

                    <label for="batas_pendaftaran">
                        Pilih Tanggal
                    </label>

                    <input
                        type="date"
                        id="batas_pendaftaran"
                        name="batas_pendaftaran"
                        value="{{ old(
                            'batas_pendaftaran',
                            $antarJemput?->batas_pendaftaran
                                ? $antarJemput
                                    ->batas_pendaftaran
                                    ->format('Y-m-d')
                                : ''
                        ) }}">

                    <small>
                        Tanggal ini akan otomatis tampil
                        pada bagian Batas Pendaftaran
                        di halaman website.
                    </small>

                </div>


                <div class="antar-admin-info">

                    <i class="fa-solid fa-circle-info"></i>

                    <p>
                        Setelah disimpan, tanggal pada halaman
                        Antar Jemput akan berubah secara otomatis.
                    </p>

                </div>

            </div>

        </div>


        {{-- ==========================================
             ACTION
        ========================================== --}}

        <div class="antar-admin-actions">

            <a
                href="{{ route('layanan.antarjemput') }}"
                target="_blank"
                class="antar-admin-preview-button">

                <i class="fa-solid fa-arrow-up-right-from-square"></i>

                Lihat Halaman Website

            </a>


            <button
                type="submit"
                class="antar-admin-save-button">

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>

@endsection
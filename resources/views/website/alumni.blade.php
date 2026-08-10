@extends('layouts.website')

@section('content')

<!-- ==================================================
     HERO ALUMNI
================================================== -->

<section class="alumni-hero">

    <div class="alumni-hero-content">

        <span class="alumni-hero-label">

            <i class="fa-solid fa-graduation-cap"></i>

            Keluarga Besar Sekolah

        </span>

        <h1>Data Alumni</h1>

        <p>
            Selamat datang Alumni SD Muhammadiyah 16 Karangasem.
            Mari tetap terhubung dan menjadi bagian dari keluarga
            besar sekolah dengan mengisi formulir data alumni.
        </p>

        <a href="#form-alumni"
           class="alumni-hero-button">

            <i class="fa-solid fa-pen-to-square"></i>

            Isi Data Alumni

        </a>

    </div>

</section>



<!-- ==================================================
     FORM ALUMNI
================================================== -->

<section class="alumni-form-section"
         id="form-alumni">

    <div class="alumni-container">

        <div class="alumni-form-wrapper">


            <!-- INFORMASI KIRI -->

            <div class="alumni-form-information">

                <span class="alumni-section-label">
                    Formulir Alumni
                </span>

                <h2>
                    Tetap Menjadi Bagian dari Keluarga Besar Kami
                </h2>

                <p>
                    Isi data berikut dengan benar. Data yang dikirim
                    akan masuk langsung ke halaman administrasi sekolah.
                </p>


                <div class="alumni-form-info-list">

                    <div>

                        <i class="fa-solid fa-circle-check"></i>

                        <span>
                        Tetap Menjadi Bagian dari Keluarga Besar Kami
                        </span>

                    </div>


                    <div>

                        <i class="fa-solid fa-circle-check"></i>

                        <span>
                        Mari Terus Terhubung Bersama Sekolah
                        </span>

                    </div>


                    <div>

                        <i class="fa-solid fa-circle-check"></i>

                        <span>
                        Jejak Alumni, Cerita yang Terus Berlanjut
                        </span>

                    </div>

                </div>

            </div>


            <!-- FORM -->

            <div class="alumni-form-card">


                @if(session('success'))

                    <div class="alumni-success-message">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <strong>
                                Data Berhasil Dikirim
                            </strong>

                            <span>
                                {{ session('success') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($errors->any())

                    <div class="alumni-error-message">

                        <i class="fa-solid fa-circle-exclamation"></i>

                        <div>

                            <strong>
                                Periksa kembali formulir.
                            </strong>

                            <ul>

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endif


                <form action="{{ route('alumni.store') }}"
                      method="POST">

                    @csrf


                    <div class="alumni-form-grid">


                        <!-- Nama -->

                        <div class="alumni-form-group full">

                            <label for="nama_lengkap">

                                Nama Lengkap

                                <span>*</span>

                            </label>

                            <input
                                type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}"
                                placeholder="Masukkan nama lengkap"
                                required>

                        </div>


                        <!-- Tahun Lulus -->

                        <div class="alumni-form-group">

                            <label for="tahun_lulus">

                                Tahun Lulus

                                <span>*</span>

                            </label>

                            <input
                                type="number"
                                id="tahun_lulus"
                                name="tahun_lulus"
                                value="{{ old('tahun_lulus') }}"
                                min="1950"
                                max="{{ now()->year }}"
                                placeholder="Contoh: 2015"
                                required>

                        </div>


                        <!-- Jenis Kelamin -->

                        <div class="alumni-form-group">

                            <label for="jenis_kelamin">

                                Jenis Kelamin

                                <span>*</span>

                            </label>

                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                required>

                                <option value="">
                                    -- Pilih --
                                </option>

                                <option
                                    value="Laki-laki"
                                    @selected(
                                        old('jenis_kelamin')
                                        === 'Laki-laki'
                                    )>

                                    Laki-laki

                                </option>

                                <option
                                    value="Perempuan"
                                    @selected(
                                        old('jenis_kelamin')
                                        === 'Perempuan'
                                    )>

                                    Perempuan

                                </option>

                            </select>

                        </div>


                        <!-- WhatsApp -->

                        <div class="alumni-form-group">

                            <label for="no_hp">
                                No. HP / WhatsApp
                            </label>

                            <input
                                type="text"
                                id="no_hp"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                placeholder="Contoh: 081234567890">

                        </div>


                        <!-- Email -->

                        <div class="alumni-form-group">

                            <label for="email">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com">

                        </div>


                        <!-- Pendidikan -->

                        <div class="alumni-form-group">

                            <label for="pendidikan_saat_ini">
                                Pendidikan Saat Ini
                            </label>

                            <input
                                type="text"
                                id="pendidikan_saat_ini"
                                name="pendidikan_saat_ini"
                                value="{{ old(
                                    'pendidikan_saat_ini'
                                ) }}"
                                placeholder="Contoh: SMA / Universitas">

                        </div>


                        <!-- Pekerjaan -->

                        <div class="alumni-form-group">

                            <label for="pekerjaan">
                                Pekerjaan
                            </label>

                            <input
                                type="text"
                                id="pekerjaan"
                                name="pekerjaan"
                                value="{{ old('pekerjaan') }}"
                                placeholder="Kosongkan jika masih pelajar">

                        </div>


                        <!-- Alamat -->

                        <div class="alumni-form-group full">

                            <label for="alamat">
                                Alamat
                            </label>

                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="4"
                                placeholder="Masukkan alamat saat ini">{{ old('alamat') }}</textarea>

                        </div>


                        <!-- Pesan Kesan -->

                        <div class="alumni-form-group full">

                            <label for="pesan_kesan">
                                Pesan dan Kesan
                            </label>

                            <textarea
                                id="pesan_kesan"
                                name="pesan_kesan"
                                rows="5"
                                placeholder="Tuliskan pesan atau kesan untuk sekolah...">{{ old('pesan_kesan') }}</textarea>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="alumni-submit-button">

                        <i class="fa-solid fa-paper-plane"></i>

                        Kirim Data Alumni

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection
@extends('layouts.website')

@section('content')

<!-- ================= HERO ================= -->

<section class="alumni-hero">

    <div class="alumni-hero-content">

        <div class="hero-left">

            <span class="breadcrumb">
                Home / Alumni
            </span>

            <h1>Data Alumni</h1>

            <p>
                Selamat datang Alumni SD Muhammadiyah 16 Karangasem.
                Silakan mengisi formulir berikut agar data alumni
                dapat tersimpan pada database sekolah dan menjadi
                bagian dari keluarga besar SD Muhammadiyah 16 Karangasem.
            </p>

        </div>

    </div>

    <!-- Gelombang -->
    <div class="wave">
        <svg viewBox="0 0 1440 200" preserveAspectRatio="none">
            <path fill="#ffffff"
                d="M0,96L80,106.7C160,117,320,139,480,144C640,149,800,139,960,122.7C1120,107,1280,85,1360,74.7L1440,64L1440,200L0,200Z">
            </path>
        </svg>
    </div>

</section>



<!-- ================= FORM ================= -->

<section class="alumni-form-section">

<div class="form-card">

<form>

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text">
    </div>

    <div class="form-group">
        <label>Tahun Lulus</label>
        <input type="number">
    </div>

    <div class="form-group">
        <label>Jenis Kelamin</label>

        <select>
            <option>Laki-laki</option>
            <option>Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label>No HP / WhatsApp</label>
        <input type="text">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email">
    </div>

    <div class="form-group">
        <label>Pendidikan Saat Ini</label>
        <input type="text">
    </div>

    <div class="form-group">
        <label>Pekerjaan</label>
        <input type="text">
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <textarea rows="3"></textarea>
    </div>

    <div class="form-group">
        <label>Pesan dan Kesan</label>
        <textarea rows="4"></textarea>
    </div>

    <button class="btn-submit">
        Kirim Data Alumni
    </button>

</form>

</div>

</section>

@endsection
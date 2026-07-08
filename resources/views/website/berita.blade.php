@extends('layouts.website')

@section('content')
<div class="berita-card">

    <img src="https://img.youtube.com/vi/TTyARBgFHK8/maxresdefault.jpg"
         alt="Berita">

    <div class="berita-content">

        <span class="tanggal">
            <i class="fa-solid fa-calendar"></i>
            7 Juli 2026
        </span>

        <h3>Kegiatan SD Muhammadiyah 16 Karangasem</h3>

        <p>
            Dokumentasi kegiatan sekolah yang diunggah melalui
            kanal YouTube resmi.
        </p>

        <a href="{{ route('berita.detail') }}" class="btn-detail">
            Baca Selengkapnya
        </a>

    </div>

</div>
@endsection
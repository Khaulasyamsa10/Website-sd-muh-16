@extends('layouts.website')

@section('content')

...


<section class="hero">

    <!-- Background Gedung -->
    <img src="{{ asset('images/FotoHalamanSekolah.jpeg') }}" class="hero-bg">

    <!-- Overlay -->
    <div class="hero-overlay">

        <div class="hero-content">

            <!-- KIRI -->
            <div class="hero-text">

                <h1>
                    Selamat Datang
                </h1>

                <h2>
                    SD Muhammadiyah 16 Karangasem
                </h2>

                <p>
                    "Bersih, Religius, Inovatif, Gigih, Humanis, Talenta"
                </p>

            
            </div>

            <!-- KANAN -->
            <div class="hero-image">

                <img src="{{ asset('fotoberanda2.png') }}" alt="Siswa">

            </div>

        </div>

    </div>
</section>
<!-- ================= VISI MISI ================= -->

<section class="visi-misi">

    <div class="visi-container">

        <!-- FOTO SISWA -->

        <div class="visi-image">

            <img src="{{ asset('images/siswa-visi.png') }}" alt="Siswa SD Muhammadiyah">

            <div class="image-caption">
                <h3>Membangun Generasi Islami</h3>
                <p>Bersih •  Religius • Inovatif • Gigih • Humanis • Talenta</p>
            </div>

        </div>

        <!-- KONTEN -->

        <div class="visi-content">

            <!-- VISI -->

            
            <div class="visi-box drop-animation">

                <h2>
                    <i class="fa-solid fa-eye"></i>
                    Visi Sekolah
                </h2>

                <p>
                    Terwujudnya Pendidikan Dasar berbasis Al-Islam dan
                    Kemuhammadiyahan, mencetak lulusan yang berkemajuan,
                    cinta lingkungan, pembelajar sepanjang hayat,
                    berdaya saing global, dan inklusif.
                </p>

            </div>

            <!-- MISI -->

            
            <div class="misi-box drop-animation">

                <h2>
                    <i class="fa-solid fa-bullseye"></i>
                    Misi Sekolah
                </h2>

                <ol>

                    <li>Menyelenggarakan pendidikan yang terintegrasi dengan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek pembelajaran dan kehidupan sekolah.</li>

                    <li>Mengembangkan karakter siswa yang unggul, berkemajuan, dan berakhlak mulia melalui pembiasaan ibadah, kegiatan keagamaan, serta keteladanan dalam keseharian.</li>

                    <li>Mendorong budaya belajar yang aktif, kreatif, inovatif, dan kolaboratif guna menumbuhkan semangat belajar sepanjang hayat melalui pembelajaran mendalam.</li>

                    <li>Menanamkan kepedulian cinta lingkungan hidup melalui pendidikan dengan praktik nyata yang berkelanjutan dan ramah lingkungan.</li>

                    <li>Mempersiapkan lulusan yang mampu bersaing di tingkat global dengan penguasaan literasi digital dan keterampilan abad ke-21.</li>

                    <li>Mewujudkan lingkungan belajar yang inklusif dan ramah anak dengan menjunjung tinggi kesetaraan, keberagaman, serta menghargai potensi unik setiap siswa.</li>

                    <li>Membangun kemitraan strategis dengan orang tua, masyarakat, dan lembaga lain untuk mendukung peningkatan mutu pendidikan secara berkelanjutan.</li>

                </ol>

            </div>

        </div>

    </div>

</section>

<!-- ================= SAMBUTAN KEPALA SEKOLAH ================= -->

<section class="kepsek">

    <div class="kepsek-container">

        <h2 class="kepsek-title">Sambutan Kepala Sekolah</h2>

        <!-- FOTO -->

        <div class="kepsek-foto">

            <img src="{{ asset('images/kepala-sekolah.jpg') }}" alt="Kepala Sekolah">

            <h3>Nama Kepala Sekolah, S.Pd.</h3>

            <span>Kepala SD Muhammadiyah 16 Karangasem</span>

        </div>

        <!-- ISI -->

        <div class="kepsek-content">

            <i class="fa-solid fa-quote-left quote-icon"></i>

            <h3>Assalamu'alaikum Wr. Wb.</h3>

            <p>
                Puji syukur ke hadirat Allah SWT atas segala rahmat dan
                karunia-Nya sehingga Website SD Muhammadiyah 16 Karangasem
                dapat hadir sebagai media informasi, komunikasi, dan publikasi
                berbagai kegiatan sekolah.
            </p>

            <p>
                Website ini diharapkan menjadi jembatan bagi peserta didik,
                orang tua, alumni, maupun masyarakat untuk mengenal lebih dekat
                SD Muhammadiyah 16 Karangasem sebagai sekolah yang unggul dalam
                prestasi, berkarakter Islami, peduli lingkungan, serta mampu
                bersaing di era global.
            </p>

            <p>
                Semoga website ini dapat memberikan manfaat bagi seluruh warga
                sekolah dan masyarakat luas.
            </p>

        </div>

    </div>

</section>
@endsection
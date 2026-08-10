<article
    class="prestasi-card"
    id="prestasi-{{ $item->id }}">

    <!-- ================= GAMBAR ================= -->

    <div class="prestasi-card-image">

        @if($item->gambar)

            <img
                src="{{ asset('storage/' . $item->gambar) }}"
                alt="{{ $item->judul }}"
                loading="lazy">

        @else

            <div class="prestasi-image-empty">

                <i class="{{ $kategoriIcon }}"></i>

                <span>Gambar belum tersedia</span>

            </div>

        @endif


        <span class="prestasi-card-category {{ $kategoriClass }}">

            <i class="{{ $kategoriIcon }}"></i>

            {{ $kategoriNama }}

        </span>

    </div>


    <!-- ================= ISI KARTU ================= -->

    <div class="prestasi-card-content">

        <h3>
            {{ $item->judul }}
        </h3>


        @if($item->nama_peserta)

            <div class="prestasi-card-info">

                <i class="fa-solid fa-user"></i>

                <span>
                    {{ $item->nama_peserta }}
                </span>

            </div>

        @endif


        @if($item->kelas)

            <div class="prestasi-card-info">

                <i class="fa-solid fa-school"></i>

                <span>
                    Kelas {{ $item->kelas }}
                </span>

            </div>

        @endif


        @if($item->peringkat)

            <div class="prestasi-card-info">

                <i class="fa-solid fa-medal"></i>

                <span>
                    {{ $item->peringkat }}
                </span>

            </div>

        @endif


        @if($item->tingkat)

            <div class="prestasi-card-info">

                <i class="fa-solid fa-layer-group"></i>

                <span>
                    Tingkat {{ $item->tingkat }}
                </span>

            </div>

        @endif


        @if($item->tanggal)

            <div class="prestasi-card-info">

                <i class="fa-solid fa-calendar-days"></i>

                <span>

                    {{ $item->tanggal
                        ->locale('id')
                        ->translatedFormat('d F Y') }}

                </span>

            </div>

        @endif


        <!-- Deskripsi singkat -->

        <p class="prestasi-card-description">

            {{ \Illuminate\Support\Str::limit(
                $item->deskripsi
                    ?: 'Belum ada deskripsi prestasi.',
                120
            ) }}

        </p>


        <!-- Tombol -->

        <div class="prestasi-card-actions">

            <button
                type="button"
                class="prestasi-read-more-button"
                onclick="openPrestasiModal(
                    'prestasi-modal-{{ $item->id }}'
                )">

                <i class="fa-regular fa-eye"></i>

                Baca Selengkapnya

            </button>


            <button
                type="button"
                class="prestasi-share-button"
                data-title="{{ $item->judul }}"
                data-url="{{ request()->url() }}#prestasi-{{ $item->id }}"
                onclick="bagikanPrestasi(
                    this.dataset.title,
                    this.dataset.url
                )">

                <i class="fa-solid fa-share-nodes"></i>

                Bagikan

            </button>

        </div>

    </div>

</article>


<!-- ==================================================
     MODAL DETAIL PRESTASI
================================================== -->

<div
    class="prestasi-modal"
    id="prestasi-modal-{{ $item->id }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="prestasi-title-{{ $item->id }}">

    <!-- Latar belakang gelap -->

    <div
        class="prestasi-modal-overlay"
        onclick="closePrestasiModal(
            'prestasi-modal-{{ $item->id }}'
        )">
    </div>


    <!-- Kotak modal -->

    <div class="prestasi-modal-dialog">

        <button
            type="button"
            class="prestasi-modal-close"
            onclick="closePrestasiModal(
                'prestasi-modal-{{ $item->id }}'
            )"
            aria-label="Tutup">

            <i class="fa-solid fa-xmark"></i>

        </button>


        <div class="prestasi-modal-grid">

            <!-- Foto -->

            <div class="prestasi-modal-image">

                @if($item->gambar)

                    <img
                        src="{{ asset('storage/' . $item->gambar) }}"
                        alt="{{ $item->judul }}">

                @else

                    <div class="prestasi-modal-no-image">

                        <i class="{{ $kategoriIcon }}"></i>

                        <span>
                            Gambar belum tersedia
                        </span>

                    </div>

                @endif

            </div>


            <!-- Informasi -->

            <div class="prestasi-modal-info">

                <span class="prestasi-modal-category">

                    <i class="{{ $kategoriIcon }}"></i>

                    Prestasi {{ $kategoriNama }}

                </span>


                <h2 id="prestasi-title-{{ $item->id }}">

                    {{ $item->judul }}

                </h2>


                <!-- Detail informasi -->

                @if(
                    $item->nama_peserta ||
                    $item->kelas ||
                    $item->peringkat ||
                    $item->tingkat ||
                    $item->tanggal
                )

                    <div class="prestasi-modal-meta">

                        @if($item->nama_peserta)

                            <div class="prestasi-modal-meta-item">

                                <i class="fa-solid fa-user"></i>

                                <div>

                                    <strong>Nama Peserta</strong>

                                    <span>
                                        {{ $item->nama_peserta }}
                                    </span>

                                </div>

                            </div>

                        @endif


                        @if($item->kelas)

                            <div class="prestasi-modal-meta-item">

                                <i class="fa-solid fa-school"></i>

                                <div>

                                    <strong>Kelas</strong>

                                    <span>
                                        {{ $item->kelas }}
                                    </span>

                                </div>

                            </div>

                        @endif


                        @if($item->peringkat)

                            <div class="prestasi-modal-meta-item">

                                <i class="fa-solid fa-medal"></i>

                                <div>

                                    <strong>Peringkat</strong>

                                    <span>
                                        {{ $item->peringkat }}
                                    </span>

                                </div>

                            </div>

                        @endif


                        @if($item->tingkat)

                            <div class="prestasi-modal-meta-item">

                                <i class="fa-solid fa-layer-group"></i>

                                <div>

                                    <strong>Tingkat Perlombaan</strong>

                                    <span>
                                        {{ $item->tingkat }}
                                    </span>

                                </div>

                            </div>

                        @endif


                        @if($item->tanggal)

                            <div class="prestasi-modal-meta-item">

                                <i class="fa-solid fa-calendar-days"></i>

                                <div>

                                    <strong>Tanggal</strong>

                                    <span>

                                        {{ $item->tanggal
                                            ->locale('id')
                                            ->translatedFormat(
                                                'd F Y'
                                            ) }}

                                    </span>

                                </div>

                            </div>

                        @endif

                    </div>

                @endif


                <!-- Deskripsi lengkap -->

                <div class="prestasi-modal-description">

                    <h4>
                        Keterangan Prestasi
                    </h4>

                    <p>
                        {{ $item->deskripsi
                            ?: 'Belum ada keterangan lengkap mengenai prestasi ini.' }}
                    </p>

                </div>


                <!-- Tombol modal -->

                <div class="prestasi-modal-actions">

                    <button
                        type="button"
                        class="prestasi-modal-share-button"
                        data-title="{{ $item->judul }}"
                        data-url="{{ request()->url() }}#prestasi-{{ $item->id }}"
                        onclick="bagikanPrestasi(
                            this.dataset.title,
                            this.dataset.url
                        )">

                        <i class="fa-solid fa-share-nodes"></i>

                        Bagikan Prestasi

                    </button>


                    <button
                        type="button"
                        class="prestasi-modal-cancel-button"
                        onclick="closePrestasiModal(
                            'prestasi-modal-{{ $item->id }}'
                        )">

                        Tutup

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>
@extends('layouts.website')

@section('content')

<!-- ==================================================
     HERO GALERI FOTO
================================================== -->

<section class="gallery-hero">

    <div class="gallery-hero-content">

        <span class="gallery-hero-label">

            <i class="fa-solid fa-camera"></i>

            Dokumentasi Sekolah

        </span>

        <h1>Galeri Foto</h1>

        <p>
            Dokumentasi berbagai kegiatan, pembelajaran,
            prestasi, dan momen berkesan
            SD Muhammadiyah 16 Karangasem.
        </p>

    </div>

</section>


<!-- ==================================================
     GALERI FOTO
================================================== -->

<section class="gallery-section">

    <div class="gallery-container">

        <div class="gallery-section-heading">

            <span>
                Dokumentasi Foto
            </span>

            <h2>Momen Kegiatan Sekolah</h2>

        </div>


        <div class="gallery-photo-grid">

            @forelse($foto as $item)

                @if($item->gambar)

                    <article
                        class="gallery-photo-card"
                        onclick="openGalleryPhoto(
                            {{ Js::from(
                                asset(
                                    'storage/' .
                                    $item->gambar
                                )
                            ) }},
                            {{ Js::from($item->judul) }},
                            {{ Js::from($item->deskripsi) }}
                        )">

                        <img
                            src="{{ asset(
                                'storage/' .
                                $item->gambar
                            ) }}"
                            alt="{{ $item->judul }}"
                            loading="lazy">


                        <div class="gallery-photo-overlay">

                            <div>

                                <h3>
                                    {{ $item->judul }}
                                </h3>

                                @if($item->deskripsi)

                                    <p>
                                        {{ \Illuminate\Support\Str::limit(
                                            $item->deskripsi,
                                            90
                                        ) }}
                                    </p>

                                @endif

                            </div>


                            <span>

                                <i class="fa-solid fa-expand"></i>

                            </span>

                        </div>

                    </article>

                @endif

            @empty

                <div class="gallery-empty">

                    <i class="fa-regular fa-images"></i>

                    <h3>
                        Belum Ada Foto
                    </h3>

                </div>

            @endforelse

        </div>

    </div>

</section>


<!-- ==================================================
     MODAL FOTO
================================================== -->

<div class="gallery-modal"
     id="galleryPhotoModal">

    <div class="gallery-modal-overlay"
         onclick="closeGalleryPhoto()">
    </div>


    <div class="gallery-photo-modal-box">

        <button
            type="button"
            class="gallery-modal-close"
            onclick="closeGalleryPhoto()"
            aria-label="Tutup">

            <i class="fa-solid fa-xmark"></i>

        </button>


        <img
            id="galleryPhotoModalImage"
            src=""
            alt="">


        <div class="gallery-modal-caption">

            <h3 id="galleryPhotoModalTitle">
            </h3>

            <p id="galleryPhotoModalDescription">
            </p>

        </div>

    </div>

</div>


<script>
    function openGalleryPhoto(
        image,
        title,
        description
    ) {
        const modal = document.getElementById(
            'galleryPhotoModal'
        );

        const modalImage = document.getElementById(
            'galleryPhotoModalImage'
        );

        const modalTitle = document.getElementById(
            'galleryPhotoModalTitle'
        );

        const modalDescription = document.getElementById(
            'galleryPhotoModalDescription'
        );


        modalImage.src = image;
        modalImage.alt = title || 'Galeri Foto';

        modalTitle.textContent =
            title || 'Galeri Foto';

        modalDescription.textContent =
            description || '';


        modal.classList.add('show');

        document.body.classList.add(
            'gallery-modal-open'
        );
    }


    function closeGalleryPhoto()
    {
        const modal = document.getElementById(
            'galleryPhotoModal'
        );

        modal.classList.remove('show');

        document.getElementById(
            'galleryPhotoModalImage'
        ).src = '';

        document.body.classList.remove(
            'gallery-modal-open'
        );
    }


    document.addEventListener(
        'keydown',
        function(event)
        {
            if (event.key === 'Escape') {
                closeGalleryPhoto();
            }
        }
    );
</script>

@endsection
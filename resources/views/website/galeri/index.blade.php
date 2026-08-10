@extends('layouts.website')

@section('content')

<!-- ==================================================
     HERO
================================================== -->

<section class="gallery-hero">

    <div class="gallery-hero-content">

        <span class="gallery-hero-label">

            <i class="fa-solid fa-images"></i>

            Dokumentasi Sekolah

        </span>

        <h1>Galeri Sekolah</h1>

        <p>
            Dokumentasi kegiatan, prestasi, pembelajaran,
            dan berbagai momen berkesan
            SD Muhammadiyah 16 Karangasem.
        </p>

    </div>

</section>


<!-- ==================================================
     FOTO
================================================== -->

<section class="gallery-section">

    <div class="gallery-container">

        <div class="gallery-section-heading">

            <span>
                Dokumentasi Foto
            </span>

            <h2>Galeri Foto</h2>

            <p>
                Berbagai dokumentasi kegiatan dan aktivitas sekolah.
            </p>

        </div>


        <div class="gallery-photo-grid">

            @forelse($foto as $item)

                <article
                    class="gallery-photo-card"
                    onclick="openGalleryPhoto(
                        {{ Js::from(asset('storage/' . $item->gambar)) }},
                        {{ Js::from($item->judul) }},
                        {{ Js::from($item->deskripsi) }}
                    )">

                    <img
                        src="{{ asset(
                            'storage/' . $item->gambar
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

            @empty

                <div class="gallery-empty">

                    <i class="fa-regular fa-images"></i>

                    <h3>Belum Ada Foto</h3>

                    <p>
                        Dokumentasi foto belum ditambahkan.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>


<!-- ==================================================
     VIDEO
================================================== -->

<section class="gallery-video-section">

    <div class="gallery-container">

        <div class="gallery-section-heading">

            <span>
                Dokumentasi Video
            </span>

            <h2>Galeri Video</h2>

            <p>
                Saksikan berbagai kegiatan dan momen sekolah
                melalui dokumentasi video.
            </p>

        </div>


        <div class="gallery-video-grid">

            @forelse($video as $item)

                <article class="gallery-video-card">

                    <button
                        type="button"
                        class="gallery-video-thumbnail"
                        onclick="openGalleryVideo(
                            {{ Js::from($item->video_url) }},
                            {{ Js::from($item->judul) }}
                        )">

                        @if($item->gambar)

                            <img
                                src="{{ asset(
                                    'storage/' . $item->gambar
                                ) }}"
                                alt="{{ $item->judul }}">

                        @else

                            <div class="gallery-video-placeholder">

                                <i class="fa-solid fa-video"></i>

                            </div>

                        @endif


                        <span class="gallery-play-button">

                            <i class="fa-solid fa-play"></i>

                        </span>

                    </button>


                    <div class="gallery-video-content">

                        <h3>
                            {{ $item->judul }}
                        </h3>

                        @if($item->deskripsi)

                            <p>
                                {{ \Illuminate\Support\Str::limit(
                                    $item->deskripsi,
                                    120
                                ) }}
                            </p>

                        @endif


                        <button
                            type="button"
                            onclick="openGalleryVideo(
                                {{ Js::from($item->video_url) }},
                                {{ Js::from($item->judul) }}
                            )">

                            Tonton Video

                            <i class="fa-solid fa-play"></i>

                        </button>

                    </div>

                </article>

            @empty

                <div class="gallery-empty">

                    <i class="fa-solid fa-video"></i>

                    <h3>Belum Ada Video</h3>

                    <p>
                        Dokumentasi video belum ditambahkan.
                    </p>

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
            onclick="closeGalleryPhoto()">

            <i class="fa-solid fa-xmark"></i>

        </button>


        <img
            id="galleryPhotoModalImage"
            src=""
            alt="">


        <div class="gallery-modal-caption">

            <h3 id="galleryPhotoModalTitle"></h3>

            <p id="galleryPhotoModalDescription"></p>

        </div>

    </div>

</div>


<!-- ==================================================
     MODAL VIDEO
================================================== -->

<div class="gallery-modal"
     id="galleryVideoModal">

    <div class="gallery-modal-overlay"
         onclick="closeGalleryVideo()">
    </div>

    <div class="gallery-video-modal-box">

        <button
            type="button"
            class="gallery-modal-close"
            onclick="closeGalleryVideo()">

            <i class="fa-solid fa-xmark"></i>

        </button>

        <div class="gallery-video-frame">

            <iframe
                id="galleryVideoIframe"
                src=""
                title="Video Galeri"
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>

        </div>

        <h3 id="galleryVideoTitle"></h3>

    </div>

</div>


<script>

    function openGalleryPhoto(
        image,
        title,
        description
    ) {
        document.getElementById(
            'galleryPhotoModalImage'
        ).src = image;

        document.getElementById(
            'galleryPhotoModalTitle'
        ).textContent = title || '';

        document.getElementById(
            'galleryPhotoModalDescription'
        ).textContent = description || '';

        document.getElementById(
            'galleryPhotoModal'
        ).classList.add('show');

        document.body.classList.add(
            'gallery-modal-open'
        );
    }


    function closeGalleryPhoto() {

        document.getElementById(
            'galleryPhotoModal'
        ).classList.remove('show');

        document.body.classList.remove(
            'gallery-modal-open'
        );
    }


    function convertYoutubeUrl(url) {

        if (!url) {
            return '';
        }

        let videoId = '';

        try {

            const parsedUrl = new URL(url);

            if (
                parsedUrl.hostname.includes(
                    'youtu.be'
                )
            ) {

                videoId = parsedUrl.pathname
                    .replace('/', '');

            } else if (
                parsedUrl.hostname.includes(
                    'youtube.com'
                )
            ) {

                videoId = parsedUrl.searchParams.get(
                    'v'
                );

                if (
                    !videoId &&
                    parsedUrl.pathname.includes(
                        '/embed/'
                    )
                ) {

                    videoId = parsedUrl.pathname
                        .split('/embed/')[1];

                }

                if (
                    !videoId &&
                    parsedUrl.pathname.includes(
                        '/shorts/'
                    )
                ) {

                    videoId = parsedUrl.pathname
                        .split('/shorts/')[1];

                }

            }

        } catch (error) {

            return '';

        }

        if (!videoId) {
            return '';
        }

        videoId = videoId.split('?')[0];

        return 'https://www.youtube.com/embed/' +
            videoId +
            '?autoplay=1';
    }


    function openGalleryVideo(
        url,
        title
    ) {

        const embedUrl = convertYoutubeUrl(
            url
        );

        if (!embedUrl) {
            alert(
                'Link video tidak valid.'
            );

            return;
        }

        document.getElementById(
            'galleryVideoIframe'
        ).src = embedUrl;

        document.getElementById(
            'galleryVideoTitle'
        ).textContent = title || '';

        document.getElementById(
            'galleryVideoModal'
        ).classList.add('show');

        document.body.classList.add(
            'gallery-modal-open'
        );
    }


    function closeGalleryVideo() {

        document.getElementById(
            'galleryVideoIframe'
        ).src = '';

        document.getElementById(
            'galleryVideoModal'
        ).classList.remove('show');

        document.body.classList.remove(
            'gallery-modal-open'
        );
    }


    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                closeGalleryPhoto();
                closeGalleryVideo();

            }

        }
    );

</script>

@endsection
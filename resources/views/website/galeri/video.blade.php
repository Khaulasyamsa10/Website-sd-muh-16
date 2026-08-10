@extends('layouts.website')

@section('content')

<!-- ==================================================
     HERO GALERI VIDEO
================================================== -->

<section class="gallery-hero">

    <div class="gallery-hero-content">

        <span class="gallery-hero-label">

            <i class="fa-solid fa-video"></i>

            Dokumentasi Sekolah

        </span>

        <h1>Galeri Video</h1>

        <p>
            Saksikan dokumentasi berbagai kegiatan,
            program, dan momen berkesan
            SD Muhammadiyah 16 Karangasem.
        </p>

    </div>

</section>


<!-- ==================================================
     GALERI VIDEO
================================================== -->

<section class="gallery-video-section">

    <div class="gallery-container">

        <div class="gallery-section-heading">

            <span>
                Dokumentasi Video
            </span>

            <h2>Video Kegiatan Sekolah</h2>


        </div>


        <div class="gallery-video-grid">

            @forelse($video as $item)

                <article class="gallery-video-card">

                    <!-- Thumbnail -->

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
                                    'storage/' .
                                    $item->gambar
                                ) }}"
                                alt="{{ $item->judul }}"
                                loading="lazy">

                        @else

                            <div class="gallery-video-placeholder">

                                <i class="fa-brands fa-youtube"></i>

                            </div>

                        @endif


                        <span class="gallery-play-button">

                            <i class="fa-solid fa-play"></i>

                        </span>

                    </button>


                    <!-- Content -->

                    <div class="gallery-video-content">

                        <span class="gallery-video-label">

                            <i class="fa-solid fa-video"></i>

                            Video

                        </span>


                        <h3>
                            {{ $item->judul }}
                        </h3>


                        @if($item->deskripsi)

                            <p>
                                {{ \Illuminate\Support\Str::limit(
                                    $item->deskripsi,
                                    130
                                ) }}
                            </p>

                        @endif


                        <button
                            type="button"
                            onclick="openGalleryVideo(
                                {{ Js::from($item->video_url) }},
                                {{ Js::from($item->judul) }}
                            )">

                            <i class="fa-solid fa-circle-play"></i>

                            Tonton Video

                        </button>

                    </div>

                </article>


            @empty

                <div class="gallery-empty">

                    <i class="fa-solid fa-video"></i>

                    <h3>
                        Belum Ada Video
                    </h3>

                </div>

            @endforelse

        </div>

    </div>

</section>


<!-- ==================================================
     MODAL VIDEO
================================================== -->

<div class="gallery-modal"
     id="galleryVideoModal">

    <div
        class="gallery-modal-overlay"
        onclick="closeGalleryVideo()">
    </div>


    <div class="gallery-video-modal-box">

        <button
            type="button"
            class="gallery-modal-close"
            onclick="closeGalleryVideo()"
            aria-label="Tutup">

            <i class="fa-solid fa-xmark"></i>

        </button>


        <div class="gallery-video-frame">

            <iframe
                id="galleryVideoIframe"
                src=""
                title="Galeri Video"
                allow="
                    accelerometer;
                    autoplay;
                    clipboard-write;
                    encrypted-media;
                    gyroscope;
                    picture-in-picture
                "
                allowfullscreen>
            </iframe>

        </div>


        <h3 id="galleryVideoTitle">
        </h3>

    </div>

</div>


<script>
    function convertYoutubeUrl(url)
    {
        if (!url) {
            return '';
        }

        let videoId = '';

        try {

            const parsedUrl = new URL(url);

            /*
             * youtu.be/xxxx
             */

            if (
                parsedUrl.hostname.includes(
                    'youtu.be'
                )
            ) {

                videoId = parsedUrl.pathname
                    .replace('/', '');

            }


            /*
             * youtube.com
             */

            if (
                parsedUrl.hostname.includes(
                    'youtube.com'
                )
            ) {

                /*
                 * watch?v=xxxx
                 */

                videoId =
                    parsedUrl.searchParams.get('v');


                /*
                 * /shorts/xxxx
                 */

                if (
                    !videoId &&
                    parsedUrl.pathname.includes(
                        '/shorts/'
                    )
                ) {

                    videoId = parsedUrl.pathname
                        .split('/shorts/')[1];

                }


                /*
                 * /embed/xxxx
                 */

                if (
                    !videoId &&
                    parsedUrl.pathname.includes(
                        '/embed/'
                    )
                ) {

                    videoId = parsedUrl.pathname
                        .split('/embed/')[1];

                }

            }

        } catch (error) {

            return '';

        }


        if (!videoId) {
            return '';
        }


        videoId = videoId
            .split('?')[0]
            .split('&')[0];


        return (
            'https://www.youtube.com/embed/' +
            videoId +
            '?autoplay=1'
        );
    }


    function openGalleryVideo(
        url,
        title
    ) {

        const embedUrl =
            convertYoutubeUrl(url);


        if (!embedUrl) {

            alert(
                'Link video belum tersedia atau tidak valid.'
            );

            return;
        }


        document.getElementById(
            'galleryVideoIframe'
        ).src = embedUrl;


        document.getElementById(
            'galleryVideoTitle'
        ).textContent =
            title || 'Galeri Video';


        document.getElementById(
            'galleryVideoModal'
        ).classList.add('show');


        document.body.classList.add(
            'gallery-modal-open'
        );
    }


    function closeGalleryVideo()
    {
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
        function(event)
        {
            if (event.key === 'Escape') {
                closeGalleryVideo();
            }
        }
    );
</script>

@endsection
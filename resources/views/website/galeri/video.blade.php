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

            <h2>
                Video Kegiatan Sekolah
            </h2>

        </div>


        <div class="gallery-video-grid">

            @forelse($video as $item)

                <article class="gallery-video-card">

                    <!-- ================= THUMBNAIL ================= -->

                    <button
                        type="button"
                        class="gallery-video-thumbnail"

                        onclick="openGalleryVideo(
                            {{ Js::from(
                                $item->video_file
                                    ? asset('storage/' . $item->video_file)
                                    : null
                            ) }},

                            {{ Js::from($item->video_url) }},

                            {{ Js::from($item->judul) }}
                        )"
                    >

                        @if($item->gambar)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $item->gambar
                                ) }}"
                                alt="{{ $item->judul }}"
                                loading="lazy"
                            >

                        @else

                            <div class="gallery-video-placeholder">

                                @if($item->video_file)

                                    <i class="fa-solid fa-video"></i>

                                @else

                                    <i class="fa-brands fa-youtube"></i>

                                @endif

                            </div>

                        @endif


                        <span class="gallery-play-button">

                            <i class="fa-solid fa-play"></i>

                        </span>

                    </button>


                    <!-- ================= CONTENT ================= -->

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
                                {{
                                    \Illuminate\Support\Str::limit(
                                        $item->deskripsi,
                                        130
                                    )
                                }}
                            </p>

                        @endif


                        <button
                            type="button"

                            onclick="openGalleryVideo(
                                {{ Js::from(
                                    $item->video_file
                                        ? asset('storage/' . $item->video_file)
                                        : null
                                ) }},

                                {{ Js::from($item->video_url) }},

                                {{ Js::from($item->judul) }}
                            )"
                        >

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

<div
    class="gallery-modal"
    id="galleryVideoModal"
>

    <div
        class="gallery-modal-overlay"
        onclick="closeGalleryVideo()">
    </div>


    <div class="gallery-video-modal-box">

        <button
            type="button"
            class="gallery-modal-close"
            onclick="closeGalleryVideo()"
            aria-label="Tutup"
        >

            <i class="fa-solid fa-xmark"></i>

        </button>


        <!-- ================= VIDEO UPLOAD ================= -->

        <div
            class="gallery-video-frame"
            id="galleryLocalVideoContainer"
            style="display:none;"
        >

            <video
                id="galleryLocalVideo"
                controls
                preload="metadata"
            >

                <source
                    id="galleryLocalVideoSource"
                    src=""
                >

                Browser Anda tidak mendukung video.

            </video>

        </div>


        <!-- ================= YOUTUBE ================= -->

        <div
            class="gallery-video-frame"
            id="galleryYoutubeContainer"
            style="display:none;"
        >

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
                allowfullscreen
            >
            </iframe>

        </div>


        <h3 id="galleryVideoTitle">
        </h3>

    </div>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | CONVERT LINK YOUTUBE
    |--------------------------------------------------------------------------
    */

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



    /*
    |--------------------------------------------------------------------------
    | OPEN VIDEO
    |--------------------------------------------------------------------------
    */

    function openGalleryVideo(
        videoFile,
        videoUrl,
        title
    ) {

        const modal =
            document.getElementById(
                'galleryVideoModal'
            );


        const localContainer =
            document.getElementById(
                'galleryLocalVideoContainer'
            );


        const youtubeContainer =
            document.getElementById(
                'galleryYoutubeContainer'
            );


        const localVideo =
            document.getElementById(
                'galleryLocalVideo'
            );


        const localSource =
            document.getElementById(
                'galleryLocalVideoSource'
            );


        const iframe =
            document.getElementById(
                'galleryVideoIframe'
            );


        /*
        |--------------------------------------------------------------------------
        | VIDEO HASIL UPLOAD
        |--------------------------------------------------------------------------
        */

        if (videoFile) {

            youtubeContainer.style.display =
                'none';

            iframe.src = '';


            localContainer.style.display =
                'block';

            localSource.src =
                videoFile;

            localVideo.load();


            /*
             * Bisa diaktifkan jika ingin
             * video otomatis diputar.
             */

            // localVideo.play();

        }


        /*
        |--------------------------------------------------------------------------
        | VIDEO YOUTUBE
        |--------------------------------------------------------------------------
        */

        else if (videoUrl) {

            const embedUrl =
                convertYoutubeUrl(videoUrl);


            if (!embedUrl) {

                alert(
                    'Link video tidak valid.'
                );

                return;
            }


            localContainer.style.display =
                'none';

            localVideo.pause();

            localSource.src = '';


            youtubeContainer.style.display =
                'block';

            iframe.src =
                embedUrl;

        }


        /*
        |--------------------------------------------------------------------------
        | TIDAK ADA VIDEO
        |--------------------------------------------------------------------------
        */

        else {

            alert(
                'Video belum tersedia.'
            );

            return;
        }


        document.getElementById(
            'galleryVideoTitle'
        ).textContent =
            title || 'Galeri Video';


        modal.classList.add(
            'show'
        );


        document.body.classList.add(
            'gallery-modal-open'
        );
    }



    /*
    |--------------------------------------------------------------------------
    | CLOSE VIDEO
    |--------------------------------------------------------------------------
    */

    function closeGalleryVideo()
    {
        const localVideo =
            document.getElementById(
                'galleryLocalVideo'
            );


        const localSource =
            document.getElementById(
                'galleryLocalVideoSource'
            );


        const iframe =
            document.getElementById(
                'galleryVideoIframe'
            );


        /*
         * Stop video upload
         */

        localVideo.pause();

        localVideo.currentTime = 0;

        localSource.src = '';

        localVideo.load();


        /*
         * Stop Youtube
         */

        iframe.src = '';


        document.getElementById(
            'galleryVideoModal'
        ).classList.remove(
            'show'
        );


        document.body.classList.remove(
            'gallery-modal-open'
        );
    }



    /*
    |--------------------------------------------------------------------------
    | ESC UNTUK MENUTUP MODAL
    |--------------------------------------------------------------------------
    */

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
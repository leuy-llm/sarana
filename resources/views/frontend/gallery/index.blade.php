{{-- @extends('layout.master')
@section('style')
    <style>
        /* .gallery_wrapper {
        padding: 60px 0;
    }*/

        /* .gallery_wrapper .section-title {
        margin-bottom: 40px;
    }  */
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9b2c2c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .gallery-img {
            height: 300px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.05);
            /* Slight zoom on hover */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .img-hover {
            overflow: hidden;
            /* Ensures no part of the image exceeds its container */
            border-radius: 8px;
        }
    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0 ">
        <div class="overlay">
            @if ($banner)
                <img src="{{ asset('storage/' . $banner->banner_image) }}"
                    style="width: 100%; height: 90vh; object-fit: cover;" alt="Banner Image">
            @else
                <img src="{{ asset('hotel') }}/image/services/service3.png"
                    style="width: 100%; height: 90vh; object-fit: cover;" alt="">
            @endif
            <div class="img-overlay">
                <h2>{{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="gallery" class="gallery_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h6>Explore Our Collection</h6>
                    <h3 style="margin-top: -10px">More Galleries</h3>
                </div>
            </div>
            <div class="row" k-grid uk-lightbox="animation: scale">
                @foreach ($galleries as $gallery)
                    <div class="col-md-4 mb-4">
                        <div class="img-hover">
                            <a class="uk-inline" href="{{ asset('storage/' . $gallery->image) }}"
                                data-caption="{{ $gallery->title }}" data-group="gallery">
                                <img src="{{ asset('storage/' . $gallery->image) }}"
                                    class="rounded img-shadow img-fluid gallery-img" alt="{{ $gallery->title }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('auth.register')
@endsection

@section('script')
    <script>
        UIkit.lightbox(element).show(index);
    </script>
@endsection --}}




<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
    /* body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        } */

    .gallery-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .swiper2 {
        width: 100%;
        height: 500px;
    }

    .swiper-slide2 {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .swiper-slide2 img {
        width: 90%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .swiper-slide2.swiper-slide-active img {
        transform: scale(1.1);
        /* Zoom in on the center image */
    }

    .swiper-pagination-bullet {
        background-color: #007bff;
    }

    /* .swiper-button-next,
    .swiper-button-prev {
        color: #007bff;
    } */
    .swiper-button-next,
    .swiper-button-prev {
        width: 50px;
        height: 50px;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black */
        color: #fff;
        /* White arrow color */
        border-radius: 50%;
        /* Circular buttons */
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        /* Add shadow for a 3D effect */
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: #007bff;
        /* Change to blue on hover */
        transform: scale(1.1);
        /* Slightly enlarge the button on hover */
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px;
        /* Larger arrows */
        font-weight: bold;
    }

    /* Position adjustments */
    .swiper-button-next {
        right: 10px;
        /* Adjust distance from the right */
    }

    .swiper-button-prev {
        left: 10px;
        /* Adjust distance from the left */
    }

    h2 {
        font-family: "Sail", system-ui;
        font-size: 40px;
        margin-bottom: 110px;
    }
</style>
<div class="container-fluid mt-5 mb-5">
    <h2 class="text-left">Our Hotel Gallery</h2>
    <div class="swiper swiper2">
        <div class="swiper-wrapper swiper-wrapper2">
            @foreach ($galleries as $gallery)
                <!-- Slide 1 -->
                <div class="swiper-slide swiper-slide2">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}">
                </div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <!-- <div class="swiper-pagination"></div> -->
        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- Swiper.js JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper2', {
        loop: true,
        effect: 'coverflow',
        grabCursor: true,

        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        slidesPerView: 30, // Display 3 images
        centeredSlides: true, // Center the middle image
        spaceBetween: 30,
        satisfiesSlides: true,
        // speed: 800,    

        breakpoints: {
            768: {
                slidesPerView: 2, // Show 2 images for tablets
                spaceBetween: 20,
            },
            480: {
                slidesPerView: 1, // Show 1 image for smaller screens
            },
        }, // Add spacing between images
        // pagination: {
        //     el: '.swiper-pagination',
        //     clickable: true,
        // },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

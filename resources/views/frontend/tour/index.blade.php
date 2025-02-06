@extends('layout.master')
@section('style')
    <style>
        /* Hover effect */
        .hover-effect {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-effect:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            filter: brightness(1.2);
            /* Brighten the image */
            cursor: pointer;
        }

        .meeting-space-section {
            background-color: #fff;
            font-family: 'Georgia', serif;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9b2c2c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .section-subtitle {
            font-size: 1.75rem;
            font-weight: 600;
            font-style: italic;
            color: #9b2c2c;
        }

        .description {
            font-size: 1rem;
            color: #333;
            line-height: 1.8;
        }

        img {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;

        }

        img:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            /* border-radius: 10px; */

        }

        .carousel-inner img {
            max-height: 500px;
            object-fit: cover;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            color: wheat;
        }

        .swiper.swiper-tour {
            width: 100%;
            height: auto;
            /* Adjust the height to fit content dynamically */
            position: relative;
            padding-bottom: 50px;
            /* Add space at the bottom for the pagination */
            cursor: pointer;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .swiper-slide img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);

        }

        /* Pagination styling */
        .swiper-pagination {
            position: absolute;
            bottom: 10px;
            /* Ensure pagination stays inside the Swiper container */
            left: 50%;
            transform: translateX(-50%);
        }

        .swiper-pagination-bullets {
            bottom: 0;
        }

        /* Navigation arrows */
        .swiper-button-next,
        .swiper-button-prev {
            color: #fff;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: -40px;

        }

        .swiper-slide.highlighted {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }


        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #000;
        }

        /* Responsive design */
        @media (max-width: 768px) {

            .swiper-button-next,
            .swiper-button-prev {
                display: none;
            }

            /* Hide navigation arrows */
            .swiper-pagination {
                display: none;
            }

            .main-image {
                max-width: 100%;
                height: auto;
                margin-bottom: 20px;
            }


        }
    </style>
@endsection
@section('content')
    {{-- <section id="home" class="banner_wrapper p-0 ">
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
    </section> --}}
    <div class="hero-section banner_wrapper"  data-aos="fade-down" data-aos-duration="1000">
        <div class="container">
            <h1 class="display-4 mb-4" data-aos="zoom-in" data-aos-duration="2000"
                style="color: white;font-weight: 700;font-family: 'Sail', system-ui;font-size: 75px;">
                {{ $data }}
            </h1>
            {{-- <p class="lead" style="color: #fff;font-family: 'Sail', system-ui;font-size: 25px;">
                Find your perfect room with stunning views and ultimate comfort
            </p> --}}
        </div>
    </div>
    @if ($banner)
        <style>
            .hero-section {
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                    url('{{ asset('storage/' . $banner->banner_image) }}');
                background-size: cover;
                background-position: center;
                height: 400px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-align: center;
                margin-bottom: -100px;
            }
        </style>
    @else
        <p>No banner found for this page.</p>
    @endif
    <section id="tour" class="tours_wrapper" style="margin-top: 100px; ">
        <div class="container-fluid">
            <div class="text-center" data-aos="fade-down" data-aos-duration="1000">
                <h3 class="fw-bold" style="font-family: 'Sail', system-ui;font-size: 50px;color:#caa169">Our Tours</h3>
                <p class=""
                    style="font-family: 'Sail', system-ui; letter-spacing: 1px; line-height:1.5; font-size: 25px; font-weight: 100;  margin-top: 10px;">
                    Explore our tours plans and schedules.
                </p>
            </div>
            <div class="tour my-5">
                <div class="container">
                    <div class="row g-0">
                       
                        <div class="col-lg-6" data-aos="fade-down" data-aos-duration="1500" >
                            @if ($tours->isNotEmpty())
                                @foreach ($tours as $tour)
                                    @if ($tour->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $tour->images->first()->image) }}"
                                            alt="{{ $tour->name }}" class="rounded me-3 main-image"
                                            style="width: 100%; max-width: 700px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    @else
                                        <img src="{{ asset('default-image.jpg') }}" alt="Default Image" class="rounded me-3"
                                            style="width: 100%; max-width: 700px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    @endif
                                @endforeach
                            @else
                                <p>No tours available.</p>
                            @endif
                        </div>
                        <div class="col-lg-6" data-aos="fade-down" data-aos-duration="2000">
                            @if ($tours->isNotEmpty())
                                @foreach ($tours as $tour)
                                    <p
                                        style="line-height: 1.9; text-align: justify;font-family: 'Source Sans Pro', sans-serif;font-size: 17px">
                                        {{ $tour->description }}</p>
                                @endforeach
                            @else
                                <p>No descriptions available.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-3" >
                        @if ($tours->isNotEmpty())
                            @foreach ($tours as $tour)
                                @if ($tour->images->isNotEmpty())
                                    <div class="swiper swiper-tour">
                                        <div class="swiper-wrapper">
                                            @foreach ($tour->images as $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset('storage/' . $image->image) }}"
                                                        alt="Image {{ $loop->index + 1 }}" class="img-fluid">
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Pagination -->
                                        <div class="swiper-pagination"></div>
                                        <!-- Navigation Buttons -->
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('default-image.jpg') }}" alt="Default Image"
                                            class="img-fluid rounded shadow">
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p class="text-center">No images available for the tours.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper(".swiper", {
                loop: true,
                slidesPerView: 3,
                spaceBetween: 20,
                centeredSlides: true,
                centeredSlides: true,
                autoplay: {
                    delay: 5000
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },

                breakpoints: {
                    1200: {
                        slidesPerView: 3, // Show 4 images for desktop
                        spaceBetween: 40,
                    },
                    768: {
                        slidesPerView: 2, // Show 2 images for tablets
                        spaceBetween: 20,
                    },
                    480: {
                        slidesPerView: 1, // Show 1 image for smaller screens
                    },
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
            });

            // Example: Adjust Swiper behavior based on image attributes
            swiper.on('slideChangeTransitionEnd', function() {
                let activeSlide = document.querySelector('.swiper-slide-active');
                let imageType = activeSlide.getAttribute('data-type'); // e.g., "highlighted" or "standard"

                if (imageType === "highlighted") {
                    swiper.autoplay.stop(); // Pause autoplay for special images
                } else {
                    swiper.autoplay.start();
                }
            });
        });
    </script>
@endsection

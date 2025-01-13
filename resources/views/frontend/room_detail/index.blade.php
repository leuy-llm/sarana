
@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');

        .room-detail {
            background-color: #111827;
            color: #fff;
            padding: 25px;
        }

        body {
            font-family: "Jost", serif;
        }

        .swiper {
            height: 100%;
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 600px;
            background-size: cover;
            background-position: center;
        }

        .custom-btn {
            background-color: transparent;
            color: white;
            border: 2px solid white;
            padding: 10px 20px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            /* border-radius: 5px; */
            cursor: pointer;
            text-decoration: none;
        }

        .custom-btn:hover {
            background-color: rgba(206, 146, 61, 0.726);
            /* color: #111827; */
            transform: scale(1.05);
            text-decoration: none;
        }

        .price-label {
            color: #ffffff;
            /* White text */
            font-size: 14px;
            /* font-weight: 300; */
            display: block;
            margin-bottom: 5px;
        }

        .price-amount {
            color: #ffffff;
            /* White text */
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 25px;
        }

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
            font-family: "Jost", serif;
            /* Add shadow for a 3D effect */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: rgba(206, 146, 61, 0.726);
            ;
            /* Change to blue on hover */
            transform: scale(1.1);
            /* Slightly enlarge the button on hover */
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 15px;
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

        .room-detail {
            font-family: "Jost", serif;
            color: white;

        }

        @media (max-width: 768px) {

            .banner_wrapper {
                margin-bottom: 350px;
            }
            .room-detail {
                padding: 20px;
            }
            .room-detail h2 {
                font-size: 24px;
            }
            .room-detail h3 {
                font-size: 20px;
            }
            .room-detail p {
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .banner_wrapper {
                margin-bottom: 300px;
            }
            .room-detail {
                padding: 20px;
            }
            .room-detail h2 {
                font-size: 20px;
            }
            .room-detail h3 {
                font-size: 16px;
            }
            .room-detail p {
                font-size: 14px;
            }
            .swiper-slide{
                height: 500px;
                margin-top: 10px;
            }
            .swiper-button-next,.swiper-button-prev{
                display: none;
            }
        }
        @media (max-width: 992px){
            .banner_wrapper {
                margin-bottom: 300px;
            }
            .room-detail {
                padding: 20px;
            }
            .room-detail h2 {
                font-size: 18px;
            }
            .room-detail h3 {
                font-size: 16px;
            }
            .room-detail p {
                font-size: 14px;
            }
           
        }

        .room-detail p,
        h2 {
            font-family: "Jost", serif;
            color: white;
        }

        .detail {
            margin-bottom: 200px;
            margin-top: 150px;

        }
    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0">
        <div class="overlay" data-aos="zoom-in" data-aos-duration="2000">
            <img src="https://images.pexels.com/photos/453201/pexels-photo-453201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                style="width: 100%; height: 90vh; object-fit: cover;" alt="">

            <div class="img-overlay">
                <h2> {{ $data }}</h2>
            </div>
        </div>
    </section>
    <div class="container detail">
        <div class="row">
            <div class="col-md-4 room-detail">
                <h2>{{ $rooms->roomType->type_name }}</h2>
                <!-- <p><strong>From:</strong> $199</p> -->
                <p class="price-label"><strong>From</strong></p>
                @if($rooms->special_price)
                ${{ number_format($rooms->special_price), 0 }}
                @else
                <p class="price-amount">${{ number_format($rooms->price), 0 }}</p>
                @endif
                <p><strong>Bed:</strong> {{ $rooms->bed_type }}</p>
                <p><strong>Capacity:</strong> {{ $rooms->max_person }}</p>
                <p><strong>Room Size:</strong> {{ $rooms->room_size }}m²</p>
                <p><strong>View:</strong> {{ $rooms->view_type }}</p>

                <p class="mb-3"><strong>Facilities:</strong>
                    @if ($rooms->facilities->isNotEmpty())
                        @foreach ($rooms->facilities as $facility)
                            <li>{{ $facility->name }}</li>
                            </li>
                        @endforeach
                    @endif
                </p>
                {{-- <button class="custom-btn mt-3">aBook Now</button> --}}
                <a href="{{ route('books.create', ['room_id' => $rooms->id, 'check_in' => $checkInDate, 'check_out' => $checkOutDate, 'adults' => $adults, 'children' => $children]) }}"
                    class="custom-btn mt-3">Book Now</a>
            </div>
            <div class="col-md-8">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($rooms->images as $image)
                            <div class="swiper-slide"
                                style="background-image: url('{{ asset('storage/' . $image->image) }}')">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <p class="mt-5 px-3 flex-wrap"><strong>Description:</strong> {{ $rooms->description }}</p>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true, // Allows continuous loop mode
            slidesPerView: 2, // Number of slides visible at a time
            spaceBetween: 10, // Space between slides in pixels
            satisfiesSlides: true, // Whether
            centeredSlides: true, // Center the middle image
            grabCursor: true,
            autoplay: {
                delay: 3000, // Delay between slides in milliseconds (e.g., 3000ms = 3 seconds)
                disableOnInteraction: false, // Keep autoplay running after user interaction
            },
            speed: 800, // Duration of transition (in milliseconds, e.g., 800ms = 0.8 seconds)
            navigation: {
                nextEl: '.swiper-button-next', // Next button selector
                prevEl: '.swiper-button-prev', // Previous button selector
            },
            breakpoints: {
                1200: {
                    slidesPerView: 2, // Show 4 images for large screens
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 1, // Show 2 images for tablets
                    spaceBetween: 20,
                },
                600: {
                    slidesPerView: 1, // Show 1 image for mobile devices
                },
                320: {
                    slidesPerView: 1, // Show 1 image for very small screens
                },
                200: {
                    slidesPerView: 1, // Show 1 image for smaller screens
                },
                480: {
                    slidesPerView: 1, // Show 1 image for smaller screens
                },
            }, // Add spacing between images
        });
    </script>
@endsection

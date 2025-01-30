@extends('layout.master')
@section('style')
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"> --}}
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
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 500px;
            /* Adjust height to fit design */
            border-radius: 10px;
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

            .room-details p {
                width: 100%;
                /* Full width on smaller screens */
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

            .swiper-slide {
                height: 500px;
                margin-top: 10px;
            }

            .swiper-button-next,
            .swiper-button-prev {
                display: none;
            }
        }

        @media (max-width: 992px) {
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

        /* .containera {
                    display: flex;
                    max-width: 1200px;
                    margin: auto;
                    padding: 20px;
                    align-items: center;
                } */
        .details {
            flex: 1;
            padding: 20px;
        }

        .details h1 {
            font-size: 50px;
            font-family: "Sail", system-ui;
            font-weight: bold;
        }

        .amenities h1 {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 20px;
            font-family: "Sail", system-ui;
        }

        .details p {
            font-size: 20px;
            /* color: #666; */
            font-family: "Jost", serif;
        }


        .price {
            font-size: 40px;
            font-weight: bold;
            margin: 10px 0;
            font-family: "Sail", system-ui;
        }

        .amenities {
            margin-top: 20px;
        }

        .amenities ul {
            list-style: none;
            padding: 0;
        }

        .amenities ul li {
            margin-bottom: 8px;
            font-size: 20px;
            font-family: "Jost", serif;
        }

        .swiper-slide img {
            width: 100%;
            border-radius: 10px;
        }

        .room-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Space between items */
            font-size: 16px;
        }

        .room-details p {
            display: flex;
            align-items: center;
            gap: 8px;
            /* Space between icon and text */
            margin: 0;
            width: 50%;
            /* Two items per row */

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
    <section class="rooms_wrapper">
        <div class="container-fluid" style="margin-bottom: 150px;" data-aos="fade-down" data-aos-duration="1000">
            {{-- <div class="row">
                <div class="col-md-4 room-detail">
                    <h2>{{ $rooms->roomType->type_name }}</h2>
                    <p class="price-label"><strong>From</strong></p>
                    @if ($rooms->special_price)
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
            </div> --}}
            {{-- <h3 class="fw-bold text-center" style="font-family: 'Sail', system-ui;font-size: 50px;color: #caa169">Enjoy Your Stay</h3>
            <p class="text-center" style="font-family: 'Sail', system-ui; letter-spacing: 1px; line-height:1.5; font-size: 25px; font-weight: 100;  margin-top: 10px;">
                A hotel is an establishment that provides paid lodging on a short-term basis. Facilities provided may range from a modest-quality mattress.
             </p> --}}
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="details">
                        <h1>{{ $rooms->roomType->type_name }}</h1>
                        <div class="price">
                            @if ($rooms->special_price)
                                ${{ number_format($rooms->special_price), 0 }}/Night
                            @else
                                ${{ number_format($rooms->price), 0 }}/Night
                            @endif
                        </div>
                        <div class="room-details">
                            <p><i class="fa-solid fa-bed"></i> Bed: {{ $rooms->bed_type }}</p>
                            <p><i class="fa-solid fa-ruler-combined"></i> Room Size: {{ $rooms->room_size }}m²</p>
                            <p><i class="fa-solid fa-mountain-sun"></i> View:
                                @if ($rooms->view_type)
                                    {{ $rooms->view_type }}
                                @else
                                    No view
                                @endif

                            </p>
                            <p><i class="fa-solid fa-user-group"></i> Capacity: {{ $rooms->max_person }}</p>
                        </div>
                        <p>{{ $rooms->description }}.</p>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="amenities">
                        <h1>Amenities</h1>
                        @if ($rooms->facilities->isNotEmpty())
                            @foreach ($rooms->facilities as $facility)
                                <ul>
                                    <li>
                                        &#10004; {{ $facility->name }}
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                    </div>
                    <p style=" font-family: 'Jost', serif;font-size: 20px;"> Rating :
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="bi {{ $i <= $rooms->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                        @endfor
                    </p>

                </div>
            </div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($rooms->images as $image)
                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/' . $image->image) }}')">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: document.querySelectorAll('.swiper-slide').length > 3, // Disable loop if only 3 images
            slidesPerView: Math.min(2, document.querySelectorAll('.swiper-slide').length),
            spaceBetween: 20,
            centeredSlides: document.querySelectorAll('.swiper-slide').length >
            3, // Only center if more than 3 slides
            grabCursor: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 800,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            centerInsufficientSlides: true,
            breakpoints: {
                1200: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                480: {
                    slidesPerView: 1
                },
            },
        });
    </script>
@endsection

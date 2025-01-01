{{-- @extends('layout.master')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        body {
          
            background-color: #eff3f8;
           
        }

        h5,
        h6 {
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .properties-near h6 {
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .room-card img {
            border-radius: 0.5rem;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .room-details {
            padding: 1rem;
        }

        .room-price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #28a745;
        }

        .book-now {
            background-color: #08d1da;
            border-radius: 0;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

      
        .book-now-text {
            display: inline-block;
            transition: transform 0.3s ease, color 0.3s ease;
        }

     
        .book-now:hover {
            background-color: #23def7;
            
        }

       
        .book-now:hover .book-now-text {
            transform: scale(1.2);
            
            color: #ffffff;
            
        }


        .search-box {
            background-color: #f8f9fa;
            border: 1px solid #413d3d;
            border-radius: 3px 3px;
            
            max-width: 350px;
            margin: auto;

        }

        .search-header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            border-radius: 3px 3px 0 0;
            text-align: center;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
        }

        .clear-btn {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            color: #17a2b8;
        }

        .footer-label {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #6c757d;
            margin-top: 10px;
        }

        label {
            font-size: 15px;
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }



        .results-header {
            
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hotel-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .hotel-card img {
            width: 100%;
            height: auto;
        }

        .price-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #17a2b8;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 18px;
        }

        .special-offer {
            background-color: #e83e8c;
        }

        .hotel-details {
            padding: 15px;
        }

        .hotel-details h5 {
            margin-bottom: 10px;
        }

        .rating {
            color: #ffc107;
            font-size: 14px;
        }

        .location {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .select-btn {
          
            border-radius: 5px;
            padding: 5px 25px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 20px;

        }


        .card1 {
            border-radius: 0.5rem;
            background: white;
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.15);
            position: relative;
            color: #434343;
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        p.text-muted {
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }


        .card1 .card__container {
            padding: 2rem;
            width: 100%;
            height: 100%;
            background: white;
          
            position: relative;
        }

        .card1 .card__header {
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .card1 .card__body {
            font-family: 'Roboto', sans-serif;
        }


        .card1::before {
            position: absolute;
            top: 5.1rem;
            right: -14.9px;
            content: '';
            background: #283593;
            height: 28px;
            width: 28px;
            padding: 0.8rem;
            transform: rotate(45deg);
            z-index: -1;
        }


        .card1::after {
            position: absolute;
            content: attr(data-label);
           
            top: 47px;

            right: -21px;
            padding: 0.8rem;
            width: 10rem;
            background: #3949ab;
            color: white;
            text-align: center;
            font-family: 'Roboto', sans-serif;
            box-shadow: 4px 4px 15px rgba(26, 35, 126, 0.2);
        }

        p span {

            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .around {
            position: relative;
            width: 600px;
            height: auto;
            box-shadow: 0px 0px 20px #000;
            margin: 150px auto;
            border-radius: 10px;
            background: #fff;
        }

        .around p {
            padding: 50px;
            padding-top: 10px;
            text-align: justify;

        }

        .around h1 {
            position: relative;

        }

        .thumbnails-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 15px;
        }

        .thumbnails-wrapper .custom-prev,
        .thumbnails-wrapper .custom-next {
           
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #08d1da;
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 13px;
            border: none;
            background: transparent;

        }

        .thumbnails-wrapper .custom-prev,
        .thumbnails-wrapper .custom-next:focus {
            border: none !important;
        }



        .thumbnails-wrapper .custom-prev:hover,
        .thumbnails-wrapper .custom-next:hover {
            background-color: #f8f9fa;
            border-color: #aaa;
            color: #08d1da;
        }

        .thumbnails-wrapper .custom-prev {
            margin-right: 10px;
        }

        .thumbnails-wrapper .custom-next {
            margin-left: 10px;
        }

        .thumbnails {
            width: 100%;
            flex-grow: 1;
            overflow: hidden;
        }

        .main-image-carousel .owl-item img {
            width: 100%;
            height: 450px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .owl-carousel .thumbnail {
            width: 90px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease, border 0.3s ease;
            border: 2px solid transparent;
        }

        .owl-carousel .thumbnail.active,
        .owl-carousel .thumbnail:hover {
            transform: scale(1.1);
            border: 2px solid #00aced;
        }

        .hover-border-red:hover {
            border: 1px solid #00aced !important;
            ;
        }

        p,
        strong {
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
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
    <section id="rooms" class="rooms_wrapper">
        <div class="container p-5">
            <div class="row">
                <div class="col-sm-12 section-title text-left mb-5">
                    <h3>{{ $rooms->roomType->type_name }}</h3>
                    <div class="h-line bg-dark"></div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-8 col-md-12">

                    <div class="main-image-carousel owl-carousel">
                        @foreach ($rooms->images as $image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="Room Image">
                        @endforeach
                    </div>


                    <div class="thumbnails-wrapper">
                        <button class="custom-prev">&lt;</button>
                        <div class="thumbnails owl-carousel">
                            @foreach ($rooms->images as $image)
                                <img class="thumbnail {{ $loop->first ? 'active' : '' }}"
                                    src="{{ asset('storage/' . $image->image) }}" alt="Room Thumbnail">
                            @endforeach
                        </div>
                        <button class="custom-next">&gt;</button>
                    </div>

                </div>

                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <!-- Main Hotel Promotion -->
                    <div class="hotel-promotion  text-center shadow">
                        <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                            alt="Hilton Hotels & Resorts Logo" class="mb-3 mt-2" style="max-width: 150px;">
                        <hr class="">
                        <h5 class="text-muted small">From <span class=""
                                style="color: #08d1da;font-size: 25px;font-weight: 600;">${{ number_format($rooms->price), 0 }}</span>
                            / NIGHT</h5>
                        {{-- <a href=""
                            class="btn book-now w-100 p-3 rounded-none font-weight-bold text-white shadow-none">
                            <span class="book-now-text">Book Now</span>
                        </a> --}}
{{-- <a href="{{ route('books.create', ['room_id' => $rooms->id]) }}"
                            class="btn book-now w-100 p-3 rounded-none font-weight-bold text-white shadow-none">
                            <span class="book-now-text">Book Now</span>
                        </a> 
                        <a href="{{ route('books.create', ['room_id' => $rooms->id, 'check_in' => $checkInDate, 'check_out' => $checkOutDate, 'adults' => $adults, 'children' => $children]) }}"
                            class="btn book-now w-100 p-3 rounded-none font-weight-bold text-white shadow-none"><span
                                class="book-now-text">Book Now</span></a>.

                    </div>
                    <!-- Properties Near -->
                    <div class="properties-near mt-4 p-3">
                        <h6 class="mb-3">ROOM DETAIL</h6>
                        <p style="font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                            <strong>ROOMTYPE :</strong> {{ $rooms->roomType->type_name }}
                        </p>
                        <p style="font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                            <strong>DESCRIPTION : </strong>{{ $rooms->description }}
                        </p>
                        <p style="font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                            <strong>GUEST : </strong>{{ $rooms->max_person }} persons
                        </p>
                        <strong>FACILITIES</strong>
                        @if ($rooms->facilities->isNotEmpty())
                            @foreach ($rooms->facilities as $facility)
                                <li>
                                    <span class="badge bg-light text-dark text-wrap">{{ $facility->name }}</span>
                                </li>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
   
    <script>
        $(document).ready(function() {
            const $mainCarousel = $('.main-image-carousel');
            const $thumbnailCarousel = $('.thumbnails');

            // Initialize Main Image Carousel
            $mainCarousel.owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: false, // Disable default nav
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 1200,
            });

            // Initialize Thumbnail Carousel
            $thumbnailCarousel.owlCarousel({
                loop: false, // Navigation will stop at edges
                margin: 10,
                nav: false, // Disable default nav
                dots: false,
                responsive: {
                    0: {
                        items: 3
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 5
                    },
                },
            });

            // Custom Navigation Buttons for Thumbnail Carousel
            $('.custom-prev').on('click', function() {
                console.log('Prev button clicked');
                $thumbnailCarousel.trigger('prev.owl.carousel'); // Navigate thumbnails
            });

            $('.custom-next').on('click', function() {
                console.log('Next button clicked');
                $thumbnailCarousel.trigger('next.owl.carousel'); // Navigate thumbnails
            });

            // Thumbnail Click Sync with Main Carousel
            $thumbnailCarousel.on('click', '.thumbnail', function() {
                const index = $(this).closest('.owl-item').index();
                console.log('Thumbnail clicked, index:', index);

                // Sync main carousel
                $mainCarousel.trigger('to.owl.carousel', [index, 300]);

                // Update active thumbnail
                $('.thumbnail').removeClass('active');
                $(this).addClass('active');
            });

            // Sync Main Carousel with Thumbnails
            $mainCarousel.on('changed.owl.carousel', function(event) {
                const currentIndex = event.item.index - event.relatedTarget._clones.length / 2;

                // Adjust index for loop behavior
                const visibleIndex = currentIndex >= 0 ? currentIndex : $mainCarousel.find('.owl-item')
                    .length + currentIndex;
                console.log('Main carousel changed, visible index:', visibleIndex);

                // Sync thumbnails
                $thumbnailCarousel.trigger('to.owl.carousel', [visibleIndex, 300]);

                // Update active thumbnail
                $('.thumbnail').removeClass('active');
                $thumbnailCarousel.find('.owl-item').eq(visibleIndex).find('.thumbnail').addClass('active');
            });

            // Sync Thumbnail Navigation with Main Carousel
            $('.custom-next').on('click', function() {
                const mainIndex = $mainCarousel.find('.active').index() + 1; // Get current index
                console.log('Main Carousel Next:', mainIndex);
                $mainCarousel.trigger('next.owl.carousel'); // Move the main carousel
            });

            $('.custom-prev').on('click', function() {
                const mainIndex = $mainCarousel.find('.active').index() - 1; // Get current index
                console.log('Main Carousel Prev:', mainIndex);
                $mainCarousel.trigger('prev.owl.carousel'); // Move the main carousel
            });
        });
    </script>
@endsection --}}


@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

        .room-detail p,
        h2 {
            font-family: "Jost", serif;
            color: white;
        }
    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0">
        <div class="overlay" data-aos="zoom-in" data-aos-duration="2000">
            <img src="https://images.pexels.com/photos/453201/pexels-photo-453201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                style="width: 100%; height: 90vh; object-fit: cover;" alt="" >

            <div class="img-overlay">
                <h2> {{ $data }}</h2>
            </div>
        </div>
    </section>
    <div class="container mt-5" style="margin-bottom: 150px;">
        <div class="row">
            <div class="col-md-4 room-detail">
                <h2>{{ $rooms->roomType->type_name }}</h2>
                <!-- <p><strong>From:</strong> $199</p> -->
                <p class="price-label"><strong>From</strong></p>
                <p class="price-amount">${{ number_format($rooms->price), 0 }}</p>

                <p><strong>Bed:</strong> {{$rooms->bed_type}}</p>
                <p><strong>Capacity:</strong> {{$rooms->max_person}}</p>
                <p><strong>Room Size:</strong> {{$rooms->room_size}}m²</p>
                <p><strong>View:</strong> {{$rooms->view_type}}</p>
                <p><strong>Description:</strong> {{$rooms->description}}</p>
                <p><strong>Facilities:</strong>
                    @if ($rooms->facilities->isNotEmpty())
                    @foreach ($rooms->facilities as $facility)
                       <li>{{ $facility->name }}</li>
                        </li>
                    @endforeach
                @endif
                </p>
                {{-- <button class="custom-btn mt-3">aBook Now</button> --}}
                <a href="{{ route('books.create', ['room_id' => $rooms->id, 'check_in' => $checkInDate, 'check_out' => $checkOutDate, 'adults' => $adults, 'children' => $children]) }}" class="custom-btn mt-3">Book Now</a>
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
                // Adjust slidesPerView for different screen sizes
                640: {
                    slidesPerView: 1, // 1 slide for smaller screens
                },
                1024: {
                    slidesPerView: 2, // 2 slides for medium screens
                },
            },
        });
    </script>
@endsection

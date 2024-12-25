@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        body {
            /* font-family: Arial, sans-serif; */
            /* background-color: #f8f9fa; */
            background-color: #eff3f8;
            /* font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif; */
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

        /* Default styling for the button */
        .book-now {
            background-color: #08d1da;
            border-radius: 0;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        /* Text-specific styling */
        .book-now-text {
            display: inline-block;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        /* Hover effect for button */
        .book-now:hover {
            background-color: #23def7;
            /* Darker shade of the button color */
        }

        /* Hover effect for text only */
        .book-now:hover .book-now-text {
            transform: scale(1.2);
            /* Slight zoom-in effect */
            color: #ffffff;
            /* Ensure the text color is visible */
        }


        .search-box {
            background-color: #f8f9fa;
            border: 1px solid #413d3d;
            border-radius: 3px 3px;
            /* padding: 20px; */
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
            /* margin-bottom: 10px; */
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
            /* width: 100%; */
            border-radius: 5px;
            padding: 5px 25px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 20px;

        }


        /* .card1 {
                                                               
                                                                border-radius: 1rem;
                                                                background: white;
                                                                box-shadow: 4px 4px 15px rgba(#000, 0.15);
                                                                position: relative;
                                                                color: #434343;
                                                            } */
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
            /* border-radius: 1rem; */
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
            /* top: 3.7rem; */
            /* top: 146px; */
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
            /* background-color: #ffffff; */
            /* border: 1px solid #ddd; */
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

        /* ul li strong{
                font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
            li{
                font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
            } */
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
                {{-- @if ($rooms && $rooms->images->isNotEmpty())
                    <div class="col-md-7">
                        <div class="slide-container1 swiper">
                            <div class="swiper-wrapper swiper-wrapper1">
                                @foreach ($rooms->images as $image)
                                    <div class="swiper-slide swiper-slide1">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="" />
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="row justify-content-center ">
                            <div class="col-md-8 py-3">
                                <h3 class="display-4 heading">{{ $rooms->roomType->type_name }}</h3>
                                <div class="room-exerpt">
                                    <div class="room-price mb-4">${{ number_format($rooms->price),0 }}<span class="per">/night</span></div>
                                    
                                        <p>{{ $rooms->description }}</p>
                                       
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <h3 class="mb-4">Amenities</h3>
                                            @if ($rooms->facilities->isNotEmpty())
                                            <ul class="list-unstyled ul-check">
                                                @foreach ($rooms->facilities as $facility)
                                                <li><i class="fa-solid fa-check" style="color:#"></i> {{ $facility->name }}</li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <p>@lang('label.noFacilities')</p>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mb-5">
                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline
                            of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own
                            road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.
                        </p>
                        <div class="d-md-flex mt-4 mb-4">
                            <ul class="list-none" style="list-style: none;">
                                <li><span>Max:</span> 3 Persons</li>
                                <li><span>Size:</span> 45 m2</li>
                            </ul>
                            <ul class="list-none ml-md-5" style="list-style: none;">
                                <li><span>View:</span> Sea View</li>
                                <li><span>Bed:</span> 1</li>
                            </ul>
                        </div>
                        <p>
                            When she reached the first hills of the Italic Mountains, she had a last view back on the
                            skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her
                            own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her
                            way.
                        </p>
                    </div>
                @else --}}
                {{-- <div class="col-lg-6">
                    @if ($rooms && $rooms->images->isNotEmpty())
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($rooms->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="d-block w-100 rounded animate__animated animate__fadeIn"
                                            src="{{ asset('storage/' . $image->image) }}" alt="{{ $key + 1 }}"
                                            style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);height: 450px;">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @else
                        <div class="text-center">
                            <img src="{{ asset('default-image.jpg') }}" alt="Default Image"
                                class="img-fluid rounded shadow">
                        </div>
                    @endif
                </div> --}}

                {{-- <div class="col-md-6">
                    <h3 class="display-4 heading">{{ $rooms->roomType->type_name }}</h3>
                    <div class="room-exerpt">
                        <div class="room-price mb-3"  >${{ number_format($rooms->price), 0 }}<span
                                class="per" style="font-family: 'Playfair Display', serif;">/night</span>
                        </div>
                        <p style="line-height: 2.5;text-align: justify;">{{ $rooms->description }}</p>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h3 class="mb-4">Amenities</h3>
                                @if ($rooms->facilities->isNotEmpty())
                                    <ul class="list-unstyled ul-check" style="line-height: 2.5;text-align: justify;">
                                        @foreach ($rooms->facilities as $facility)
                                            <li><i class="fa-solid fa-check" style="color:#"></i> {{ $facility->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>@lang('label.noFacilities')</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex" style="display: flex;align-items: center;line-height: 2.3;">
                        <ul class="list-none" style="list-style: none;">
                            <li><strong>Bed:</strong> King Size<br></li>
                            <li><strong>Size:</strong> 45m<sup>2</sup></li>
                        </ul>
                        <ul class="list-none ml-md-5" style="list-style: none;margin-top: -1px;">
                            <li><strong>View:</strong> Ocean View</li>
                            <li><strong>Bed:</strong> 5</li>
                        </ul>
                       
                    </div>
                    
                </div> --}}
                {{-- <div class="col-md-3 filter-all">
                    <div class="filter-section mb-4">
                        <h5>Check Availability</h5>
                        <div class="mb-3">
                            <label for="checkIn" class="form-label">Check-in</label>
                            <input type="date" class="form-control shadow-none me-1" id="checkIn">
                        </div>
                        <div class="mb-3">
                            <label for="checkOut" class="form-label ">Check-out</label>
                            <input type="date" class="form-control shadow-none me-1" id="checkOut">
                        </div>
                    </div>
                    <div class="filter-section mb-4">
                        <h5>Facilities</h5>
                        <div class="form-check">
                            <input class="form-check-input shadow-none me-1" type="checkbox" id="wifi">
                            <label class="form-check-label" for="wifi">Wifi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none me-1" type="checkbox" id="ac">
                            <label class="form-check-label" for="ac">Air conditioner</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none me-1" type="checkbox" id="tv">
                            <label class="form-check-label" for="tv">Television</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none me-1" type="checkbox" id="spa">
                            <label class="form-check-label" for="spa">Spa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none me-1" type="checkbox" id="roomHeater">
                            <label class="form-check-label" for="roomHeater">Room Heater</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none me-1" type="checkbox" id="geyser">
                            <label class="form-check-label" for="geyser">Geyser</label>
                        </div>
                    </div>
                    <div class="filter-section">
                        <h5>Guests</h5>
                        <div class="d-flex justify-content-center align-items-center gap-4">
                            <div>
                                <label for="adults" class="form-label">Adults</label>
                                <input type="number" class="form-control shadow-none" id="adults" min="1">
                            </div>
                            <div class="ml-3">
                                <label for="children" class="form-label">Children</label>
                                <input type="number" class="form-control shadow-none" id="children" min="0">
                            </div>
                        </div>
                    </div>                    
                </div> --}}
                {{-- <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow ">
                        <div class="container-fluid flex-lg-column flex-items-stretch">
                            <h4 class="mt-2"> FILTERS
                            </h4>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filterDropdown" aria-controls="filterDropdown" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="navbar-toggler-icon shadow-none"></i>
                            </button>

                            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                                <div class="mb-4 border bg-light p-3 rounded">
                                    <h5>Check Booking Availability</h5>
                                    <div class="mb-2">
                                        <label for="checkIn" class="form-label">Check-in</label>
                                        <input type="date" class="form-control shadow-none me-1" id="checkIn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="checkOut" class="form-label ">Check-out</label>
                                        <input type="date" class="form-control shadow-none me-1" id="checkOut">
                                    </div>
                                </div>
                                <div class="filter-section mb-4 border bg-light p-3 rounded">
                                    <h5>Facilities</h5>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Default checkbox
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                            checked>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Checked checkbox
                                        </label>
                                    </div>
                                </div>
                                <div class="filter-section mb-4 border bg-light p-3 rounded">
                                    <h5>Guests</h5>
                                    <div class="d-flex justify-content-center align-items-center gap-4">
                                        <div>
                                            <label for="adults" class="form-label">Adults</label>
                                            <input type="number" class="form-control shadow-none" id="adults"
                                                min="1">
                                        </div>
                                        <div class="ml-3">
                                            <label for="children" class="form-label">Children</label>
                                            <input type="number" class="form-control shadow-none" id="children"
                                                min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div> --}}
                {{-- <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                        <div class="container-fluid flex-lg-column flex-items-stretch">
                            <h4 class="mt-2 text-white bg-primary ">Modify Search</h4>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="navbar-toggler-icon shadow-none"></i>
                            </button>
                
                            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                                <!-- Destination Section -->
                                <div class="mb-4 border bg-light p-3 rounded">
                                    <label for="destination" class="form-label">Your Destination</label>
                                    <input type="text" class="form-control shadow-none" id="destination" placeholder="Enter city, region">
                                </div>
                
                                <!-- Date Section -->
                                <div class="mb-4 border bg-light p-3 rounded">
                                    <h5>Check Booking Availability</h5>
                                    <div class="mb-2">
                                        <label for="checkIn" class="form-label">Check-in</label>
                                        <input type="date" class="form-control shadow-none" id="checkIn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="checkOut" class="form-label">Check-out</label>
                                        <input type="date" class="form-control shadow-none" id="checkOut">
                                    </div>
                                </div>
                
                                <!-- Guests Section -->
                                <div class="mb-4 border bg-light p-3 rounded">
                                    <h5>Guests</h5>
                                    <div class="d-flex gap-3">
                                        <div>
                                            <label for="adults" class="form-label">Adults</label>
                                            <input type="number" class="form-control shadow-none" id="adults" min="1" value="1">
                                        </div>
                                        <div>
                                            <label for="children" class="form-label">Kids</label>
                                            <input type="number" class="form-control shadow-none" id="children" min="0" value="0">
                                        </div>
                                    </div>
                                </div>
                
                                <!-- Facilities Section -->
                                <div class="mb-4 border bg-light p-3 rounded">
                                    <h5>Facilities</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wifi">
                                        <label class="form-check-label" for="wifi">Wi-Fi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pool">
                                        <label class="form-check-label" for="pool">Swimming Pool</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="parking">
                                        <label class="form-check-label" for="parking">Parking</label>
                                    </div>
                                </div>
                
                                <!-- Search Button -->
                                <div class="d-grid">
                                    <button class="btn btn-primary shadow-none">Search</button>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                 --}}
                <div class="col-lg-8 col-md-12">
                    {{-- <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 align-items-center p-3">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="{{ asset('storage/' . $rooms->images->first()->image) }}"
                                    class="img-fluid rounded" alt="">
                            </div>
                            <div class="col-md-5 px-3">
                                <h5 class="mb-3">{{ $rooms->roomType->type_name }}</h5>
                                <div class="features mb-3">
                                    <h6 class="mb-1">Facilities</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">2 Room</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">Feature</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">2 Room</span>
                                    <h6 class="mb-1">Guests</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">5 Adults</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">4 Children</span>
                                </div>
                            </div>



                            <div class="col-md-2 text-center">
                                <h5 class="mb-4">${{ number_format($rooms->price), 0 }} per night</h5>
                                <a href="#" class="btn w-100 btn-sm text-white shadow-none mb-2"
                                    style="background-color: #661f1f">Book Now</a>
                                <a href="#" class="btn w-100 btn-sm btn-outline-dark shadow-none">More details</a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="results-header">
                        <h4><span class="text-primary">125</span> results found</h4>
                        <div>
                          <span class="me-3">Sort by</span>
                          <span>Show 9 items</span>
                        </div>
                    </div>
                      <div class="row g-4">
                        <!-- Hotel Card 1 -->
                        <div class="col-md-4">
                          <div class="hotel-card shadow">
                            <img src="https://images.pexels.com/photos/667838/pexels-photo-667838.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="King Size Bedroom">
                            <div class="price-tag">$100</div>
                            <div class="hotel-details">
                              <h5>King Size Bedroom</h5>
                              <div class="rating">★★★★★</div>
                              <div class="location">San Francisco, United States</div>
                              <button class="btn btn-outline-info select-btn">Select</button>
                            </div>
                          </div>
                        </div>
                        <!-- Hotel Card 2 -->
                        <div class="col-md-4">
                          <div class="hotel-card shadow">
                            <img src="https://images.pexels.com/photos/667838/pexels-photo-667838.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Awesome Suites">
                            <div class="price-tag">$250</div>
                            <div class="hotel-details">
                              <h5>Awesome Suites</h5>
                              <div class="rating">★★★★☆</div>
                              <div class="location">Paris, France</div>
                              <button class="btn btn-outline-info select-btn">Select</button>
                            </div>
                          </div>
                        </div>
                        <!-- Hotel Card 3 -->
                        <div class="col-md-4">
                          <div class="hotel-card shadow">
                            <img src="https://images.pexels.com/photos/667838/pexels-photo-667838.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Ruzzini Palace Hotel">
                            <div class="price-tag special-offer">$280</div>
                            <div class="hotel-details">
                              <h5>Ruzzini Palace Hotel</h5>
                              <div class="rating">★★★★☆</div>
                              <div class="location">San Francisco, United States</div>
                              <button class="btn btn-outline-info select-btn">Select</button>
                            </div>
                          </div>
                        </div>
                      </div> --}}
                    {{-- <div class="card mb-4 border-0 shadow">
                        <div class="row card1 g-0 align-items-center p-3" data-label="$100">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="{{ asset('storage/' . $rooms->images->first()->image) }}"
                                    class="img-fluid rounded" alt="">
                            </div>
                            <div class="col-md-5 px-3">
                                <h5 class="mb-3">{{ $rooms->roomType->type_name }}</h5>
                                <div class="features mb-3">
                                    <h6 class="mb-1">Facilities</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">2 Room</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">Feature</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">2 Room</span>
                                    <h6 class="mb-1">Guests</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">5 Adults</span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">4 Children</span>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <h5 class="mb-4">${{ number_format($rooms->price), 0 }} per night</h5>
                                <a href="#" class="btn w-100 btn-sm text-white shadow-none mb-2"
                                    style="background-color: #661f1f">Book Now</a>
                                <a href="#" class="btn w-100 btn-sm btn-outline-dark shadow-none">More details</a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="main-image-carousel owl-carousel">
                        @foreach ($rooms->images as $image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="Room Image">
                        @endforeach
                    </div>

                    <!-- Thumbnails Carousel with Custom Navigation -->
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
                    {{-- <div class="my-5">
                        <ul class="nav nav-tabs" id="hotelTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                            </li>
                           
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="amenities-tab" data-bs-toggle="tab" data-bs-target="#amenities" type="button" role="tab" aria-controls="amenities" aria-selected="false">Amenities</button>
                            </li>
                          
                        </ul>
                
                        <div class="tab-content" data-aos="fade-up" data-aos-duration="1500" id="hotelTabsContent">
                            <!-- Description Tab -->
                            <div class="tab-pane show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div class="row">
                                    <div class="col-md-6" >
                                        <ul class="list-unstyled mt-3"  >
                                            <li style=" font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Room Type:</strong> {{ $rooms->roomType->type_name }}</li>
                                            <li style=" font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Description : </strong> {{$rooms->description}}</li>
                                            
                                            <li style=" font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>View:</strong> Sea View</li>
                                            <li style=" font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Size:</strong> 45 m<sup>2</sup></li>
                                            <li style=" font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Bed:</strong> 1</li>
                                           
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="manager-info">
                                            <img src="https://via.placeholder.com/80" alt="Hotel Manager">
                                            <div>
                                                <h6 class="mb-1">Hotel Manager</h6>
                                                <p class="text-primary mb-0">Jessica Brown</p>
                                            </div>
                                        </div>
                                        <div class="info-box mt-3">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aspernatur, dolores eveniet laboriosam maxime molestias nulla quidem similique.
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                                <p data-aos="fade-down" data-aos-duration="1500">Amenities details will be displayed here.</p>
                            </div>
                
                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <p>Customer reviews will be displayed here.</p>
                            </div>
                
                            <!-- Write a Review Tab -->
                            <div class="tab-pane fade" id="write-review" role="tabpanel" aria-labelledby="write-review-tab">
                                <p>Form to write a review will be displayed here.</p>
                            </div>
                        </div>
                    </div> --}}
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
                        </a> --}}
                        <a href="{{ route('books.create', ['room_id' => $rooms->id, 'check_in' => $checkInDate, 'check_out' => $checkOutDate,'adults' => $adults, 'children' => $children]) }}"
                            class="btn book-now w-100 p-3 rounded-none font-weight-bold text-white shadow-none"><span
                                class="book-now-text">Book Now</span></a>

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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

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
@endsection

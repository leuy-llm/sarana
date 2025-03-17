@extends('layout.master')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            background-color: #eff3f8;

        }

        h5 {
            /* font-family: 'Jost', sans-serif ; */
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: bold;

            font-size: 20px;
        }

        span {
            /* font-family: 'Jost', serif */
            font-family: 'Source Sans Pro', sans-serif;
        }

        h5 {
            text-transform: uppercase;
        }

        p.text-muted {
            /* font-family: 'Jost', serif */
            font-family: 'Source Sans Pro', sans-serif;
        }

        h5.text-primary {
            font-size: 25px;
            /* font-family: 'jost' */
            font-family: 'Source Sans Pro', sans-serif;
        }

        .card:hover {
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.5);
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .search-box {
                width: 100%;
            }

            .search-box.form-group {
                width: 100%;
            }

            h5.text-primary {
                font-size: 20px;
            }

            h5 {
                text-transform: uppercase;
            }

            p.text-muted {
                /* font-family: 'Jost', serif */
                font-family: 'Source Sans Pro', sans-serif;
            }

            h5.text-primary {
                font-size: 20px;
            }

        }

        #price-range-slider {
            /* height: 10px; */

            background: #b8905d;
            border-radius: 5px;
        }

        .room-info h6 {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .original-price {
            position: relative;
            color: #6c757d;
            /* Muted color for original price */
            font-size: 1rem;
            text-decoration: none;
        }

        .original-price::before {
            content: "";
            position: absolute;
            width: 100%;
            /* Fully drawn line by default */
            height: 1px;
            background-color: #dc3545;
            /* Red color for the line */
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: 1;
        }

        .card-body .btn {
            display: inline-block;
            margin-top: 10px;
            /* Adds spacing between buttons and content */
        }

        .card-body .btn:hover {
            background-color: #007bff;
            /* Button hover effect */
            color: #fff;
            /* Text color on hover */
        }

        .d-flex.flex-column .btn {
            margin-bottom: 10px;
            /* Adds spacing between "More details" and "Book now" buttons */
        }

        .room-card {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* margin-bottom: 10px; */
        }

        .room-card:hover {
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.5);
            cursor: pointer;
        }

        .room-card img {
            width: 35%;
            /* Adjust image width */
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s ease;
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); */
        }

        .btn-more:hover {
            background: red;
        }

        .room-card img:hover {
            transform: scale(1.05);
            filter: brightness(70%);
        }

        .room-info {
            padding: 20px;
            width: 45%;
            /* Middle section width */
        }

        .room-info h4 {
            font-weight: bold;
            margin-bottom: 10px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 30px;
        }

        .room-info p {
            margin-bottom: 15px;
            color: #666;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .amenities {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .amenities i {
            font-size: 18px;
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 5px;
            color: #555;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .room-price {
            text-align: center;
            padding: 20px;
            width: 20%;
            /* Pricing section width */
            background-color: #f8f9fa;
            height: auto;
            box-shadow: rgba(0, 0, 0, 0.1)
        }

        .room-price h5 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .room-price span {
            font-size: 0.9rem;
            color: #666;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .btn-more-details {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.9rem;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .btn-more-details i {
            margin-left: 5px;

        }
        /* Custom CSS for Price Tag on Image */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-radius: 10px 10px 0 0;
        }

        .position-absolute {
            z-index: 1;
            /* Ensure the price tag is above the image */
            top: 10px;
            right: 10px;
            padding: 5px;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            /* border-radius: 5px; */
            font-size: 14px;
        }

        .bg-primary {
            background-color: #b8905d !important;
            /* Match your theme color */
        }

        .badge {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.5em 0.75em;
        }

        .btn-outline-primary {
            border-color: #b8905d;
            color: #b8905d;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #b8905d;
            color: #fff;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .text-decoration-line-through {
            text-decoration: line-through;
        }

        @media (max-width: 768px) {
            .room-card {
                flex-direction: column;
                text-align: center;

                margin-bottom: 10px;
                text-align: left;
            }

            .room-card img {
                width: 100%;
                height: 350px;
            }

            .room-info,
            .room-price {
                width: 100%;

            }

            .room-price {
                text-align: left;
                padding: 15px;

            }

            .room-price h5 {
                margin-top: 10px;
                font-size: 1rem;
            }

            .room-price p {
                font-size: 0.8rem;
            }

            .room-price span {
                font-size: 0.7rem;
            }

            .amenities {
                flex-direction: column;
            }

            .amenities i {
                margin-bottom: 5px;
            }

            .btn-more-details {
                margin-top: 0;
            }

            .room-price h5 {
                font-size: 1.2rem;
            }

            .room-price span {
                font-size: 0.8rem;
                margin-bottom: 5px;
                text-align: center;
                color: yellow;
            }

            .room-price h5 {
                font-size: 1.1rem;
            }

            .btn-more-details i {
                margin-left: 0;
            }

            .badge {
                font-size: 0.8rem;
                margin-top: 50px;
            }
        }

        @media (max-width: 576px) {
            .room-card img {
                height: 300px;
            }

            .room-info,
            .room-price {
                width: 100%;
            }

            .room-price {
                text-align: left;
                padding: 10px;

            }

            .room-price h5 {
                margin-top: 10px;
                font-size: 1rem;
            }

            .room-price p {
                font-size: 0.8rem;
            }

            .room-price span {
                font-size: 0.7rem;
            }

            .amenities {
                flex-direction: column;
            }

            .amenities i {
                margin-bottom: 5px;
            }

            .btn-more-details {
                margin-top: 0;
            }

        }

        @media (max-width: 400px) {
            .room-card img {
                height: 250px;
            }

            .room-info,
            .room-price {
                width: 100%;
            }

            .room-price {
                text-align: left;
                padding: 8px;

            }
        }

        .hero-section {
           
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
@endsection
@section('content')
    {{-- <section id="home" class="banner_wrapper p-0">
        <div class="overlay" data-aos="zoom-in" data-aos-duration="2000">
            <img src="https://images.pexels.com/photos/453201/pexels-photo-453201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                style="width: 100%; height: 90vh; object-fit: cover;" alt="">
            <div class="img-overlay">
                <h2> {{ $data }}</h2>
            </div>
        </div>
    </section> --}}
    <div class="hero-section banner_wrapper"  data-aos="fade-down" data-aos-duration="1000">
        <div class="container">
            <h1 class="display-4 mb-4" data-aos="zoom-in" data-aos-duration="2000"
                style="color: white;font-weight: 700;font-family: 'Sail', system-ui;font-size: 75px;">
                {{ $data }}
            </h1>
            <p class="lead" style="color: #fff;font-family: 'Sail', system-ui;font-size: 25px;">
                Find your perfect room with stunning views and ultimate comfort
            </p>
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
    <section id="rooms" class="rooms_wrapper" style="margin-top: 40px;">
        <div class="container-fluid p-5">
            <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="1000" >
                <h3 class="fw-bold" style="font-family: 'Sail', system-ui;font-size: 50px;">Our Rooms</h3>
                <p class="" style="font-family: 'Sail', system-ui; letter-spacing: 1px; line-height:1.5; font-size: 25px; font-weight: 100;  margin-top: 10px;">
                    Welcome to Sinaka Hotel, where comfort meets luxury. Explore our range of beautifully designed rooms, each offering a unique blend of modern 
                    amenities and traditional charm. Whether you're here for a relaxing retreat or a business trip, we have the perfect space to suit your needs. Scroll down to find the ideal room for your stay.
                 </p>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12 col-md-12">
                    <div id="rooms-container" class="container py-4">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            @foreach ($rooms as $room)
                                <div class="col mb-4" data-aos="fade-down" data-aos-duration="2000">
                                    <div class="card h-100 border-0 shadow-sm position-relative">
                                        <!-- Room Image with Price Tag -->
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                                alt="{{ $room->roomType->type_name }}" class="card-img-top"
                                                style="height: 200px; object-fit: cover;">
                                            <!-- Price Tag -->
                                            <div
                                                class="position-absolute top-0 end-0 bg-primary text-white p-2 m-2 rounded">
                                                @if ($room->special_price)
                                                    <span
                                                        class="fs-5">${{ number_format($room->special_price, 0) }}</span>
                                                    <span
                                                        class="text-decoration-line-through text-muted ms-1">${{ number_format($room->price, 0) }}</span>
                                                @else
                                                    <span class="fs-5">${{ number_format($room->price, 0) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Room Details -->
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                                            <p class="card-text text-muted">{{ Str::limit($room->description, 50) }}</p>
                                            <!-- Rating -->
                                            <div class="mb-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="bi {{ $i <= $room->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <!-- Room Features -->
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <span class="badge text-dark"><strong>Bed:</strong>
                                                    {{ $room->bed_type }}</span>
                                                <span class="badge  text-dark"><strong>View:</strong>
                                                    {{ $room->view_type }}</span>
                                                <span class="badge  text-dark"><strong>Size:</strong>
                                                    {{ $room->room_size }} m²</span>
                                                <span class="badge  text-dark"><strong>Capacity:</strong>
                                                    {{ $room->max_person }} persons</span>
                                            </div>
                                            <!-- CTA Button -->
                                            <a href="{{ route('roomDetail', ['id' => $room->id, 'type_name' => $room->roomType->type_name]) }}"
                                                class="btn btn-outline-primary w-100">
                                                More Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $rooms->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
@section('script')
    <script></script>
@endsection

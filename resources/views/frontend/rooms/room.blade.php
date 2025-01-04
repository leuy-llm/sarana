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

        .btn-book-now {
            background-color: #28a745;
            color: white;
            font-family: 'Source Sans Pro', sans-serif;
        }

        h5 {
            /* font-family: 'Jost', sans-serif ; */
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: bold;

            font-size: 20px;
        }

        h6 {
            /* font-family: 'Jost', serif */
            font-family: 'Source Sans Pro', sans-serif;
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

        .form-select {
            cursor: pointer;
            transition: border 0.3s ease, box-shadow 0.3s ease;
            -moz-appearance: none;
            cursor: pointer;
            font-family: 'Jost', serif
        }

        .results-header .text-primary {
            color: #00bcd4;
            /* Use the primary color */
            font-weight: bold;
        }

        .results-header .text-primary:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .results-header select {
            color: #00bcd4;
            border: none !important;
            background-color: #eff3f8;
            outline: none;
        }


        @media (max-width: 991px) {
            .search-box {
                width: 100%;
            }

            .search-box.form-group {
                width: 100%;
            }

            #price-range-slider {
                /* height: 10px; */

                background: #b8905d;
                border-radius: 5px;
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
        .btn-more:hover{
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
        <div class="container-fluid p-5">
            <h1 class="text-center" style=" font-family: 'Sail', system-ui;font-size: 50px;" >Our Room </h1>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div id="rooms-container" class="container py-4">
                        @foreach ($rooms as $room)
                            <div class="mb-4 border-0">
                                <div class="row g-0">
                                    <div class="col-12 col-md-12">
                                        <div class="room-card">
                                            <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                                alt="{{ $room->roomType->type_name }}">
                                            <div class="room-info">
                                                <h4>{{ $room->roomType->type_name }}</h4>
                                                <p class="text-muted">{{ Str::limit($room->description, 50) }}</p>
                                                <p style="margin-top: -5px;">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                                                    @endfor
                                                </p>
                                                @if ($room->special_price)
                                                    <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price
                                                    </h6>
                                                    <div class="text-success">
                                                        <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                                        <span class="original-price ms-2">
                                                            $ {{ number_format($room->price, 0) }}
                                                        </span>
                                                    </div>
                                                    
                                                @endif
                                                <div class="mt-3"
                                                        style="display:flex;align-items:center; gap: 4px;flex-wrap: wrap">
                                                        <span
                                                            style="font-family: 'Source Sans Pro', sans-serif;font-size:16px;"><strong>Bed</strong>:
                                                            {{ $room->bed_type }}</span>,
                                                        <span
                                                            style="font-family: 'Source Sans Pro', sans-serif;font-size:16px;"><strong>View</strong>:
                                                            {{ $room->view_type }}</span>,
                                                        <span
                                                            style="font-family: 'Source Sans Pro', sans-serif;font-size:16px;"><strong>Size</strong>
                                                            : {{ $room->room_size }} m²</span>,
                                                        <span
                                                            style="font-family: 'Source Sans Pro', sans-serif;font-size:16px;"><strong>Capacity</strong>:
                                                            {{ $room->max_person }} persons</span>

                                                    </div>
                                            </div>
                                            <div class="room-price">
                                                <div>
                                                    @if ($room->special_price)
                                                        <span
                                                            class="badge bg-danger text-white p-2 rounded-0 mt-3 mt-md-0  text-wrap text-uppercase"
                                                            style="margin-top: -5px;">SPECIAL
                                                            OFFER</span>
                                                        <p class="mb-1 text-muted text-uppercase">From</p>
                                                        <h5 class="text-primary">
                                                            ${{ number_format($room->special_price, 0) }}
                                                        </h5>
                                                        <p class="text-muted text-uppercase">per night</p>
                                                    @else
                                                        <p class="mb-1 text-muted text-uppercase">From</p>
                                                        <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                                                        <p class="text-muted text-uppercase">per night</p>
                                                    @endif
                                                </div>
                                                <a href="{{ route('roomDetail', ['id' => $room->id, 'type_name' => $room->roomType->type_name]) }}"
                                                    style="font-family: 14px;font-family: 'Source Sans Pro', sans-serif;color:#fff;background: #b8905d;border-radius:20px;font-weight: 500;"
                                                    class="mb-2 text-center btn-more btn px-3  text-decoration-none shadow-none">
                                                    MORE DETAILS
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center">
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
    <script>
        $(document).ready(function() {
            function fetchRooms(url) {
                const roomsContainer = $('#rooms-container');
                const formData = $('#filter-form').serialize(); // Include form data for filtering

                $.ajax({
                    url: url,
                    method: "GET",
                    data: formData,
                    beforeSend: function() {
                        roomsContainer.html('<p>Loading rooms...</p>'); // Loading message
                    },
                    success: function(response) {
                        roomsContainer.html(response); // Update the room list dynamically
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching rooms:', error);
                        roomsContainer.html('<p>Failed to load rooms. Please try again.</p>');
                    }
                });
            }

            // Handle form submission
            $('#search-btn').on('click', function(e) {
                e.preventDefault();
                fetchRooms("{{ route('rooms.filter') }}");
            });

            // Handle pagination link clicks
            $(document).on('click', '.pagination-links a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                fetchRooms(url);
            });
        });

        // Initialize the noUiSlider
        const priceSlider = document.getElementById('price-range-slider');

        noUiSlider.create(priceSlider, {
            start: [50, 1000], // Default range values
            connect: true, // Connect the handles
            range: {
                min: 0, // Minimum value
                max: 2000 // Maximum value
            },
            step: 50, // Increment step
            tooltips: [true, true] // Display tooltips
        });

        // Update the displayed values dynamically
        const priceMin = document.getElementById('price-min');
        const priceMax = document.getElementById('price-max');

        priceSlider.noUiSlider.on('update', function(values, handle) {
            if (handle === 0) {
                priceMin.textContent = Math.round(values[0]);
            } else {
                priceMax.textContent = Math.round(values[1]);
            }
        });

        // Pass the values to the filter form when submitting
        $('#search-btn').on('click', function() {
            const priceValues = priceSlider.noUiSlider.get();
            $('<input>').attr({
                type: 'hidden',
                name: 'price_min',
                value: Math.round(priceValues[0])
            }).appendTo('#filter-form');

            $('<input>').attr({
                type: 'hidden',
                name: 'price_max',
                value: Math.round(priceValues[1])
            }).appendTo('#filter-form');
        });


        //Select Date 
        document.addEventListener('DOMContentLoaded', function() {
            // Add click event listener to all "Select Booking Date" links
            document.querySelectorAll('.select-booking-date').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent default behavior of the link

                    // Scroll to the Check In field
                    const checkInField = document.getElementById('checkin');
                    checkInField.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Highlight the Check In field (optional)
                    checkInField.classList.add('highlight');
                    setTimeout(() => checkInField.classList.remove('highlight'), 2000);
                });
            });
        });
    </script>
@endsection

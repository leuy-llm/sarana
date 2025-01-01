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
            /* font-family: Arial, sans-serif; */
            /* background-color: #f8f9fa; */
            background-color: #eff3f8;
            font-family: 'Jost', serif
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

        .btn-book-now {
            background-color: #28a745;
            color: white;
        }

        h5 {
            font-family: 'Jost', serif font-weight: bold;

            font-size: 20px;
        }

        h6 {
            font-family: 'Jost', serif
        }




        .btn-book-now:hover {
            background-color: #218838;
        }

        .search-box {
            background-color: #f8f9fa;
            /* border: 1px solid #413d3d; */
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

        .form-control {
            font-family: 'Jost', serif
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

        span {
            font-family: 'Jost', serif
        }

        label {
            font-size: 15px;
            font-family: 'Jost', serif
        }

        h5 {
            text-transform: uppercase;
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

        .card-body h5 {
            font-weight: bold;
            font-family: 'Jost', serif
        }

        .card-body h6,
        span {
            font-family: 'Jost', serif
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;

        }

        input {
            font-family: 'Jost', serif
        }

        p.text-muted.small {
            font-family: 'Jost', serif
        }

        p.text-muted {
            font-family: 'Jost', serif
        }

        h5.text-primary {
            font-size: 25px;
            font-family: 'jost'
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

        @media screen and (max-width: 991px) {
            .search-box {
                width: 100%;
            }

            .search-box.form-group {
                width: 100%;
            }
        }

        #price-range-slider {
            /* height: 10px; */

            background: #b8905d;
            border-radius: 5px;
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

        @media (max-width: 768px) {
            .card-body .btn {
                width: 100%;
                /* Full width for smaller screens */
            }
        }

        .sort-dropdown {
            /* font-family: Arial, sans-serif; */
            font-size: 14px;

        }

        .sort-dropdown select {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
            /* background-color: #fff; */
            color: #333;
            transition: all 0.3s ease;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
            min-width: 160px;
        }

        .sort-dropdown select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .sort-dropdown select option {
            font-size: 14px;
            color: #555;
            border-bottom: 2px solid #ddd;
        }

        .sort-dropdown .text-primary {
            font-weight: bold;
            font-size: 14px;
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-step {
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .progress-step.active {
            font-weight: bold;
            color: #0d6efd;
        }

        .highlight {
            border: 2px solid #007bff;
            background-color: #e7f1ff;
            transition: background-color 0.5s, border 0.5s;
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
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    {{-- <h3>OUR ROOMS</h3> --}}
                    <div class="progress-container">
                        <div class="d-flex justify-content-between">
                            <div class="progress-step active">Search<br><small>Choose your favorite room</small></div>
                            <div class="progress-step">Booking<br><small>Enter your booking details</small></div>
                            <div class="progress-step">Checkout<br><small>Use your preferred payment method</small></div>
                            <div class="progress-step">Confirmation<br><small>Receive a confirmation email</small></div>
                        </div>
                    </div>
                    <div class="h-line bg-dark"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 rounded">
                    <div class="search-box shadow">
                        <div class="search-header">
                            <i class="fas fa-search"></i> Modify Search
                        </div>
                        {{-- <form id="filter-form" method="GET" action="{{ route('rooms.filter') }}">
                            <div class="px-3 pt-3">
                                <label for="checkin" class="form-label">Check In</label>
                                <input type="date" name="check_in" id="checkin" class="form-control shadow-none me-1" required>
                            </div>
                            <div class="px-3">
                                <label for="checkout" class="form-label">Check Out</label>
                                <input type="date" name="check_out" id="checkout" class="form-control shadow-none me-1" required>
                            </div>
                            <div class="footer-label p-3">
                                <div class="d-flex justify-content-center align-items-center gap-4">
                                    <div>
                                        <label for="adults" class="form-label">Adults</label>
                                        <select name="adults" id="adults" class="form-select form-control shadow-none" required>
                                            <option value="" disabled selected>Select adults</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }} Adult{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="ml-3">
                                        <label for="children" class="form-label">Children</label>
                                        <select name="children" id="children" class="form-select form-control shadow-none me-1" required>
                                            <option value="" disabled selected>Select children</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }} Children{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 mb-3">
                                <button type="submit" class="btn btn-primary shadow-none py-2 w-100" style="border-radius: 0;">Search Rooms</button>
                            </div>
                        </form>                         --}}
                        <form id="filter-form">
                            <div class="px-3 pt-3">
                                <label for="checkin" class="form-label">Check In</label>
                                <input type="date" name="check_in" id="checkin" class="form-control shadow-none me-1"
                                    required>
                            </div>
                            <div class="px-3 pt-3">
                                <label for="checkout" class="form-label">Check Out</label>
                                <input type="date" name="check_out" id="checkout" class="form-control shadow-none me-1"
                                    required>
                            </div>
                            <div class="footer-label p-3">
                                <div class="d-flex justify-content-center align-items-center gap-4">
                                    <div>
                                        <label for="adults" class="form-label">Adults</label>
                                        <select name="adults" id="adults" class="form-select form-control shadow-none"
                                            required>
                                            <option value="" disabled selected>Select adults</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                    Adult{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="ml-3">
                                        <label for="children" class="form-label">Children</label>
                                        <select name="children" id="children"
                                            class="form-select form-control shadow-none me-1" required>
                                            <option value="" disabled selected>Select children</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                    Children{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 pt-3">
                                <label for="price-range" class="form-label">Price Range</label>
                                <div id="price-range-slider" style="margin: 20px 0;"></div>
                                <p class="text-center mt-2">
                                    <span id="price-min">50</span> - <span id="price-max">5000</span>
                                </p>
                            </div>
                            <div class="px-3 mb-3">
                                <button type="button" id="search-btn" class="btn btn-primary mb-3 shadow-none py-2 w-100"
                                    style="border-radius: 0;">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div id="rooms-container" class="container py-4">
                        <div class="results-header">
                            <div class="d-flex justify-content-between align-items-center py-2 w-100">
                                <!-- Left Side: Sort Dropdown -->
                                <span class="total-rooms d-flex align-items-center">
                                    You found <strong>{{ $rooms->count() }}</strong> rooms
                                </span>
                                </span>
                                <div class="d-flex align-items-center sort-dropdown">
                                    {{-- <span class="text-primary me-1 small">Sort by</span> --}}
                                    <select class="form-select form-select-sm shadow-none">
                                        <option value="default">Sort by: Default</option>
                                        <option value="price_low_high">Sort by: Lowest Price</option>
                                        <option value="price_high_low">Sort by: Highest Price</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach ($rooms as $room)
                            <div class="card mb-4 shadow border-0">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                            alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start"
                                            style="height: 300px; width: 700px; object-fit: cover;" loading="lazy">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                                            <p class="text-muted small">
                                                <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                                            </p>
                                            @if ($room->special_price)
                                                <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                                                <div class="text-success">
                                                    <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                                    <span class="original-price ms-2">
                                                        $ {{ number_format($room->price, 0) }}
                                                    </span>
                                                </div>
                                                {{-- @else
                                                <div>
                                                    <strong>$ {{ number_format($room->price, 0) }}</strong>
                                                </div> --}}
                                            @endif



                                            <div class="d-flex align-items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                                                @endfor
                                                {{-- <span class="ms-2">({{ $room->rating }} / 5)</span> --}}
                                            </div>
                                            {{-- <h6 class="mt-3">Facilities</h6>
                                            @if ($room->facilities->isNotEmpty())
                                                @foreach ($room->facilities as $facility)
                                                    <span
                                                        class="badge bg-light text-dark text-wrap">{{ $facility->name }}</span>
                                                @endforeach
                                            @endif --}}
                                            <h6 class="mt-3 text-uppercase">Guests</h6>
                                            <div>
                                                <span class="badge bg-light text-dark">Max: {{ $room->max_person }}
                                                    Persons</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                                        <div>
                                            @if ($room->special_price)
                                                <span class="badge bg-danger text-white p-2 rounded-0 mb-2 mt-3 text-uppercase">SPECIAL OFFER</span>
                                                <p class="mb-1 text-muted text-uppercase">From</p>
                                                <h5 class="text-primary">${{ number_format($room->special_price, 0) }}
                                                </h5>
                                                <p class="text-muted text-uppercase">per night</p>
                                            @else
                                                <p class="mb-1 text-muted text-uppercase">From</p>
                                                <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                                                <p class="text-muted text-uppercase">per night</p>
                                            @endif
                                        </div>
                                       
                                        {{-- <a href="{{ route('books.create', ['room_id' => $room->id, 'check_in' => $checkIn, 'check_out' => $checkOut, 'adults' => $adults, 'children' => $children]) }}"
                                            class=" mb-2 text-left py-1 w-100 text-primary text-decoration-none shadow-none px-2"
                                            style="font-size: 14px;background:#f1f2f3;">
                                            Select Booking Date
                                        </a> --}}
                                        <a href="#" 
                                            class="select-booking-date mb-2 text-left py-1 w-100 text-primary text-decoration-none shadow-none px-2"
                                            style="font-size: 14px; background:#f1f2f3;">
                                                Select Booking Date
                                            </a>

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
        //        $(document).ready(function () {
        //     $('#search-btn').on('click', function (e) {
        //         e.preventDefault(); // Prevent default form submission
        //         const form = $('#filter-form');
        //         const formData = form.serialize(); // Serialize form data
        //         const roomsContainer = $('#rooms-container');

        //         $.ajax({
        //             url: "{{ route('rooms.filter') }}",
        //             method: "GET",
        //             data: formData,
        //             beforeSend: function () {
        //                 roomsContainer.html('<p>Loading rooms...</p>'); // Loading message
        //             },
        //             success: function (response) {
        //                 roomsContainer.html(response); // Update the room list dynamically
        //             },
        //             error: function (xhr, status, error) {
        //                 console.error('Error fetching rooms:', error);
        //                 roomsContainer.html('<p>Failed to load rooms. Please try again.</p>');
        //             }
        //         });
        //     });
        // });


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
        document.addEventListener('DOMContentLoaded', function () {
            // Add click event listener to all "Select Booking Date" links
            document.querySelectorAll('.select-booking-date').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault(); // Prevent default behavior of the link
                    
                    // Scroll to the Check In field
                    const checkInField = document.getElementById('checkin');
                    checkInField.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    // Highlight the Check In field (optional)
                    checkInField.classList.add('highlight');
                    setTimeout(() => checkInField.classList.remove('highlight'), 2000);
                });
            });
        });

    </script>
@endsection

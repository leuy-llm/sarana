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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />

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
            background-color: #b8c72f;
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

        .stepper-wrapper {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-radius: 3px;
            padding: 20px;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ccc;
            margin-bottom: 6px;
        }

        .stepper-item.active {
            font-weight: bold;
        }

        .stepper-item.completed .step-counter {
            background-color: #ffc107;
        }

        .stepper-item.completed::after {
            border-bottom: 2px solid #ffc107;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }

        .select2-container--default .select2-selection--single:focus {
            border-color: #007bff;
            /* Border color on focus */
            outline: none;
            /* Remove the outline */
            box-shadow: none;
            /* Remove the shadow */
        }

        /* Optionally, style the normal state of the Select2 dropdown */
        .select2-container--default .select2-selection--single {
            border: 2px solid #007bff;
            /* Blue border */
            border-radius: 5px;
            /* Rounded corners */
            padding: 5px;
            /* Padding */
            outline: none;
            /* No outline */
        }

        /* Remove the box shadow when focused or clicked */
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--single:active {
            box-shadow: none;
            /* Remove the focus shadow */
        }

        /* Optional: Style the dropdown arrow */
        .select2-container--default .select2-selection__arrow {
            height: 100%;
            border-left: 1px solid #007bff;
            /* Arrow border */
        }

        .select2-hidden-accessible {
            box-shadow: none;
        }

        .booking-form {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            padding: 50px;
            /* max-width: 800px; */
            margin: auto;
            margin-top: -120px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .stepper-wrapper {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .stepper-item {
                flex-direction: row;
                align-items: center;
                gap: 10px;
                width: 100%;
            }

            .stepper-item::before,
            .stepper-item::after {
                content: none;
            }

            .stepper-item .step-counter {
                flex-shrink: 0;
            }

            .stepper-item .step-name,
            .stepper-item .step-description {
                text-align: left;
            }
        }


        .custom-modal {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 1050;

            border-radius: 8px;
            padding: 1rem;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            opacity: 0;
            transform: translateY(-10px);
        }

        .custom-modal .card {
            background-color: #f1f2f3;
        }

        .custom-modal.show {
            opacity: 1;
            transform: translateY(0);
        }

        .room {
            padding: 1rem 0;
        }

        .d-none {
            display: none !important;
        }

        .btn-done {
            background-color: #958e86;
            border-color: #f7961d;
            color: #fff;
            border: none;
            padding: 10px 20px;
        }

        .btn-done:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(138, 133, 126, 0.5);
        }

        .btn-add {
            background-color: #f7961d;
            border-color: #f7961d;
            color: #fff;
            border: none;
            padding: 10px 20px;
        }

        .btn-add:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(255, 153, 0, 0.5);
        }


        .remove-room {
            color: #dc3545;

            font-size: 1.5rem;

            cursor: pointer;

            transition: transform 0.2s ease, color 0.2s ease;

            vertical-align: middle;
        }

        .remove-room:hover {
            color: #a71d2a;

            transform: scale(1.2);

        }

        .remove-room:active {
            transform: scale(1.1);

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
        {{-- <div class="container">
            <div class="booking-form shadow">
                <div class="row g-3 d-flex align-items-center">
                    <div class="col-3">
                        <label for="children" class="form-label">Check in </label>
                        <input type="date" class="form-control rounded-0 shadow-none">
                    </div>
                    <div class="col-3">
                        <label for="children" class="form-label">Check Out </label>
                        <input type="date" class="form-control rounded-0 shadow-none" placeholder="Check in / Check out">
                    </div>

                    <div class="col-2">
                        <label for="adults" class="form-label">Adults</label>
                        <select name="adults" id="adults" class="form-control shadow-none select2" style="box-shadow: none;"
                            style="" required>
                            <option value="" disabled selected>Select adults</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }} Adult{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>

                    </div>
                    <div class="col-md-2">
                        <label for="children" class="form-label">Children</label>
                        <input type="number" class="form-control rounded-0 shadow-none">
                    </div>
                    <div class="col-2" style="margin-top: 30px;">
                        <button class="btn btn-dark rounded-0 w-100" id="search-btn">Find room</button>
                    </div>

                </div>
            </div>
            {{-- <div class="booking-form shadow">
                <div class="row g-3 d-flex align-items-center">
                    <div class="col-3">
                        <label for="check-in" class="form-label">Check in</label>
                        <input type="date" class="form-control rounded-0 shadow-none" id="check-in">
                    </div>
                    <div class="col-3">
                        <label for="check-out" class="form-label">Check Out</label>
                        <input type="date" class="form-control rounded-0 shadow-none" id="check-out">
                    </div>
                    <div class="col-4 position-relative">
                        <label for="guestInput" class="form-label">Guests</label>

                        <!-- Guest Input Trigger -->
                        <div class="form-control d-flex align-items-center justify-content-between rounded-0 shadow-none"
                            id="guestInput" role="button">
                            <span id="guests-summary">1 adult, 0 children</span>
                            <i class="fa fa-user"></i>
                        </div>

                        <!-- Guest Modal -->
                        <div id="guestModal" class="custom-modal d-none">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Guests</h5>

                                    <!-- Rooms Container -->
                                    <div id="roomsContainer">
                                      
                                        <div class="room" data-room="1">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <strong>Room 1</strong>
                                                <div class="mt-1">
                                                    <i class="bi bi-x-square remove-room" role="button" data-room="1"></i>
                                                </div>
                                            </div>

                                            <!-- Adults Input -->
                                            <div class="row">
                                                <div class="col-12 col-md-12 mb-3">
                                                    <label for="adults" class="form-label"
                                                        style="margin-bottom: -15px;">Adults</label>
                                                    <div class="input-group">
                                                        <button
                                                            class="btn btn-outline-secondary shadow-none decrease-adults rounded-0"
                                                            type="button">-</button>
                                                        <input type="number"
                                                            class="form-control shadow-none rounded-0 text-center adults-input"
                                                            style="margin-top:10px;" value="1" min="1">
                                                        <button
                                                            class="btn btn-outline-secondary shadow-none increase-adults rounded-0"
                                                            type="button">+</button>
                                                    </div>
                                                </div>

                                                <!-- Children Input -->
                                                <div class="col-12 col-md-12">
                                                    <label for="children" class="form-label"
                                                        style="margin-bottom: -15px;">Children under 12 years
                                                        old</label>
                                                    <div class="input-group">
                                                        <button
                                                            class="btn btn-outline-secondary shadow-none decrease-children rounded-0"
                                                            type="button">-</button>
                                                        <input type="number"
                                                            class="form-control shadow-none rounded-0 text-center children-input"
                                                            style="margin-top:10px;" value="0" min="0">
                                                        <button
                                                            class="btn btn-outline-secondary shadow-none increase-children rounded-0"
                                                            type="button">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="border-2 border-danger">
                                        </div>
                                    </div>

                                    <!-- Add Room and Done Buttons -->
                                    <div class="mt-3 d-flex justify-content-between">
                                        <button type="button" class="btn-add" id="addRoomBtn">+ Add a room</button>
                                        <button type="button" class="btn-done" id="doneBtn">Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-2" style="margin-top: 30px;">
                        <button class="btn btn-dark rounded-0 w-100" id="search-btn">Find room</button>
                    </div>
                </div>
            </div> 
        </div> --}}
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <div class="stepper-wrapper">
                        <div class="stepper-item active">
                            <div class="step-counter">1</div>
                            <div class="step-name mt-2">Search</div>
                            <div class="step-description">Choose your favorite room</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">2</div>
                            <div class="step-name mt-2">Book</div>
                            <div class="step-description">Confirm your selection</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">3</div>
                            <div class="step-name mt-2">Checkout</div>
                            <div class="step-description">Use your preferred payment method</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">4</div>
                            <div class="step-name mt-2">Confirmation</div>
                            <div class="step-description">Booking completed</div>
                        </div>
                    </div>
                    <div class="h-line bg-dark"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 rounded">
                    <div class="search-box shadow">
                        <div class="search-header">
                            <i class="fas fa-search"></i>Modify Filter
                        </div>
                        {{-- <form id="filter-form">
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
                                <div id="room-container">
                                    <div class="room" id="room-1">
                                        <h6>ROOM 1</h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <label for="adults-room-1" class="form-label">Adults</label>
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-sm decrement-adults">-</button>
                                                    <input type="number" name="adults[]" id="adults-room-1"
                                                        class="form-control text-center" value="1" min="1"
                                                        max="10" readonly>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-sm increment-adults">+</button>
                                                </div>
                                            </div>
                                            <!-- Children Section -->
                                            <div>
                                                <label for="children-room-1" class="form-label">Children under 12 years
                                                    old</label>
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-sm decrement-children">-</button>
                                                    <input type="number" name="children[]" id="children-room-1"
                                                        class="form-control text-center" value="0" min="0"
                                                        max="5" readonly>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-sm increment-children">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dynamic Children's Ages -->
                                        <div class="children-ages mt-3"></div>
                                    </div>
                                </div>
                                <button type="button" id="add-room" class="btn btn-success btn-sm mt-3">Add
                                    Room</button>
                            </div>
                            <div class="px-3 pt-3">
                                <label for="price-range" class="form-label">Price Range</label>
                                <div id="price-range-slider" style="margin: 20px 0;"></div>
                                <p class="text-center mt-2">
                                    <span id="price-min">50</span> - <span id="price-max">5000</span>
                                </p>
                            </div>
                            <div class="px-3 mb-3">
                                <button type="button" id="search-btn"
                                    class="btn btn-primary mb-3 shadow-none py-2 w-100" style="border-radius: 0;">Apply
                                    Filter</button>
                            </div>
                        </form> --}}

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
                                        <select name="adults" id="adults"
                                            class="form-select select2 form-control shadow-none" required>
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
                                                <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price
                                                </h6>
                                                <div class="text-success">
                                                    <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                                    <span class="original-price ms-2">
                                                        $ {{ number_format($room->price, 0) }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="d-flex align-items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                                                @endfor
                                            </div>

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
                                                <span
                                                    class="badge bg-danger text-white p-2 rounded-0 mb-2 mt-3 text-uppercase">SPECIAL
                                                    OFFER</span>
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
    </section>
    <div class="modal fade" style="z-index: 9999" data-bs-backdrop="static" id="loginRegisterModal" tabindex="-1"
        aria-labelledby="loginRegisterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #d7b661;color: white;">
                    <h5 class="modal-title text-white" id="loginRegisterModalLabel">Login or Register</h5>
                    <button type="button" class=" border-0 outline-none close text-white" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-white px-4 " data-bs-dismiss="modal"
                        style="background: #d7b661">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: "Select adults",
            allowClear: true
        });
        $('form').on('submit', function(e) {
            if ($('#adults').val() === "") {
                alert('Please select the number of adults.');
                e.preventDefault();
            }
        });

        // $(document).ready(function() {
        //     function fetchRooms(url) {
        //         const roomsContainer = $('#rooms-container');
        //         const formData = $('#filter-form').serialize(); // Include form data for filtering

        //         $.ajax({
        //             url: url,
        //             method: "GET",
        //             data: formData,
        //             beforeSend: function() {
        //                 roomsContainer.html('<p>Loading rooms...</p>'); // Loading message
        //             },
        //             success: function(response) {
        //                 roomsContainer.html(response); // Update the room list dynamically
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error fetching rooms:', error);
        //                 roomsContainer.html('<p>Failed to load rooms. Please try again.</p>');
        //             }
        //         });
        //     }

        //     // Handle form submission
        //     $('#search-btn').on('click', function(e) {
        //         e.preventDefault();
        //         fetchRooms("{{ route('rooms.filter') }}");
        //     });

        //     // Handle pagination link clicks
        //     $(document).on('click', '.pagination-links a', function(e) {
        //         e.preventDefault();
        //         const url = $(this).attr('href');
        //         fetchRooms(url);
        //     });
        // });

        // // Initialize the noUiSlider
        // const priceSlider = document.getElementById('price-range-slider');

        // noUiSlider.create(priceSlider, {
        //     start: [50, 1000], // Default range values
        //     connect: true, // Connect the handles
        //     range: {
        //         min: 0, // Minimum value
        //         max: 2000 // Maximum value
        //     },
        //     step: 50, // Increment step
        //     tooltips: [true, true] // Display tooltips
        // });

        // // Update the displayed values dynamically
        // const priceMin = document.getElementById('price-min');
        // const priceMax = document.getElementById('price-max');

        // priceSlider.noUiSlider.on('update', function(values, handle) {
        //     if (handle === 0) {
        //         priceMin.textContent = Math.round(values[0]);
        //     } else {
        //         priceMax.textContent = Math.round(values[1]);
        //     }
        // });

        // // Pass the values to the filter form when submitting
        // $('#search-btn').on('click', function() {
        //     const priceValues = priceSlider.noUiSlider.get();
        //     $('<input>').attr({
        //         type: 'hidden',
        //         name: 'price_min',
        //         value: Math.round(priceValues[0])
        //     }).appendTo('#filter-form');

        //     $('<input>').attr({
        //         type: 'hidden',
        //         name: 'price_max',
        //         value: Math.round(priceValues[1])
        //     }).appendTo('#filter-form');
        // });

        // $(document).ready(function() {
        //     function fetchRooms(url) {
        //         const roomsContainer = $('#rooms-container');
        //         const formData = $('#filter-form').serialize(); // Include form data for filtering

        //         $.ajax({
        //             url: url,
        //             method: "GET",
        //             data: formData,
        //             beforeSend: function() {
        //                 roomsContainer.html('<p>Loading rooms...</p>'); // Loading message
        //             },
        //             success: function(response) {
        //                 roomsContainer.html(response); // Update the room list dynamically
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error fetching rooms:', error);
        //                 roomsContainer.html('<p>Failed to load rooms. Please try again.</p>');
        //             }
        //         });
        //     }

        //     // Disable "Check-out" field initially
        //     $('#checkout').prop('disabled', true);

        //     // Update "Check-out" min date and enable it based on "Check-in" selection
        //     $('#checkin').on('change', function() {
        //         const checkinDate = $(this).val();

        //         if (checkinDate) {
        //             $('#checkout')
        //                 .attr('min', checkinDate) // Set min date
        //                 .prop('disabled', false); // Enable the field
        //         } else {
        //             $('#checkout')
        //                 .prop('disabled', true) // Disable the field
        //                 .val(''); // Clear the value
        //         }
        //     });

        //     // Handle form submission
        //     $('#search-btn').on('click', function(e) {
        //         e.preventDefault();

        //         // Validation
        //         let isValid = true;
        //         const fieldsToValidate = ['#checkin', '#checkout', '#adults', '#children'];

        //         fieldsToValidate.forEach((field) => {
        //             const input = $(field);
        //             if (!input.val()) {
        //                 input.addClass('border-red');
        //                 isValid = false;
        //             } else {
        //                 input.removeClass('border-red');
        //             }
        //         });

        //         if (!isValid) {
        //             // Focus on the first invalid field
        //             $(fieldsToValidate.find((field) => !$(field).val())).focus();
        //             return;
        //         }

        //         // Pass the price range to the form
        //         const priceValues = priceSlider.noUiSlider.get();
        //         $('<input>').attr({
        //             type: 'hidden',
        //             name: 'price_min',
        //             value: Math.round(priceValues[0])
        //         }).appendTo('#filter-form');

        //         $('<input>').attr({
        //             type: 'hidden',
        //             name: 'price_max',
        //             value: Math.round(priceValues[1])
        //         }).appendTo('#filter-form');

        //         fetchRooms("{{ route('rooms.filter') }}");
        //     });

        //     // Handle immediate removal of the red border on input change
        //     $('#filter-form').on('input change', 'input, select', function() {
        //         if ($(this).val()) {
        //             $(this).removeClass('border-red');
        //         }
        //     });

        //     // Handle pagination link clicks
        //     $(document).on('click', '.pagination-links a', function(e) {
        //         e.preventDefault();
        //         const url = $(this).attr('href');
        //         fetchRooms(url);
        //     });

        //     // Initialize the noUiSlider
        //     const priceSlider = document.getElementById('price-range-slider');
        //     noUiSlider.create(priceSlider, {
        //         start: [50, 1000],
        //         connect: true,
        //         range: {
        //             min: 0,
        //             max: 2000
        //         },
        //         step: 50,
        //         tooltips: [true, true]
        //     });

        //     const priceMin = document.getElementById('price-min');
        //     const priceMax = document.getElementById('price-max');

        //     priceSlider.noUiSlider.on('update', function(values, handle) {
        //         if (handle === 0) {
        //             priceMin.textContent = Math.round(values[0]);
        //         } else {
        //             priceMax.textContent = Math.round(values[1]);
        //         }
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

                        // Attach event listeners to "Book Now" buttons after the room list is updated
                        attachBookNowButtonListeners();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching rooms:', error);
                        roomsContainer.html('<p>Failed to load rooms. Please try again.</p>');
                    }
                });
            }

            // Function to attach event listeners to "Book Now" buttons
            function attachBookNowButtonListeners() {
                var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
                var hasVerifiedEmail =
                    {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'true' : 'false' }};

                console.log("isLoggedIn:", isLoggedIn);
                console.log("hasVerifiedEmail:", hasVerifiedEmail);

                var bookNowButtons = document.querySelectorAll('.book-now-btn');
                console.log("Number of Book Now buttons:", bookNowButtons.length);

                bookNowButtons.forEach(function(button) {
                    console.log("Attaching event listener to button:", button);
                    button.addEventListener('click', function(event) {
                        if (!isLoggedIn) {
                            console.log("User is not logged in. Redirecting to register page.");
                            event.preventDefault();
                            window.location.href = "{{ route('register') }}?redirect=" +
                                encodeURIComponent(window.location.href);
                        } else if (!hasVerifiedEmail) {
                            console.log("User has not verified email. Showing modal.");
                            event.preventDefault();
                            var modalTitle = document.querySelector('#loginRegisterModalLabel');
                            var modalBody = document.querySelector(
                                '#loginRegisterModal .modal-body p');
                            modalTitle.textContent = "Verify Your Email";
                            modalBody.textContent =
                                "Please verify your email address to proceed with the payment.";
                            $('#loginRegisterModal').modal('show');
                        }
                    });
                });
            }

            // Attach event listeners to "Book Now" buttons on initial page load
            attachBookNowButtonListeners();

            // Disable "Check-out" field initially
            $('#checkout').prop('disabled', true);

            // Update "Check-out" min date and enable it based on "Check-in" selection
            $('#checkin').on('change', function() {
                const checkinDate = $(this).val();

                if (checkinDate) {
                    $('#checkout')
                        .attr('min', checkinDate) // Set min date
                        .prop('disabled', false); // Enable the field
                } else {
                    $('#checkout')
                        .prop('disabled', true) // Disable the field
                        .val(''); // Clear the value
                }
            });

            // Handle form submission
            $('#search-btn').on('click', function(e) {
                e.preventDefault();

                // Validation
                let isValid = true;
                const fieldsToValidate = ['#checkin', '#checkout', '#adults', '#children'];

                fieldsToValidate.forEach((field) => {
                    const input = $(field);
                    if (!input.val()) {
                        input.addClass('border-red');
                        isValid = false;
                    } else {
                        input.removeClass('border-red');
                    }
                });

                if (!isValid) {
                    // Focus on the first invalid field
                    $(fieldsToValidate.find((field) => !$(field).val())).focus();
                    return;
                }

                // Pass the price range to the form
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

                fetchRooms("{{ route('rooms.filter') }}");
            });

            // Handle immediate removal of the red border on input change
            $('#filter-form').on('input change', 'input, select', function() {
                if ($(this).val()) {
                    $(this).removeClass('border-red');
                }
            });

            // Handle pagination link clicks
            $(document).on('click', '.pagination-links a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                fetchRooms(url);
            });

            // Initialize the noUiSlider
            const priceSlider = document.getElementById('price-range-slider');
            noUiSlider.create(priceSlider, {
                start: [50, 1000],
                connect: true,
                range: {
                    min: 0,
                    max: 2000
                },
                step: 50,
                tooltips: [true, true]
            });

            const priceMin = document.getElementById('price-min');
            const priceMax = document.getElementById('price-max');

            priceSlider.noUiSlider.on('update', function(values, handle) {
                if (handle === 0) {
                    priceMin.textContent = Math.round(values[0]);
                } else {
                    priceMax.textContent = Math.round(values[1]);
                }
            });
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

        document.addEventListener("DOMContentLoaded", () => {
            const guestInput = document.getElementById("guestInput");
            const guestsSummary = document.getElementById("guests-summary");
            const guestModal = document.getElementById("guestModal");
            const addRoomBtn = document.getElementById("addRoomBtn");
            const doneBtn = document.getElementById("doneBtn");
            const roomsContainer = document.getElementById("roomsContainer");

            // Update the guest summary
            // const updateGuestSummary = () => {
            //     let totalAdults = 0;
            //     let totalChildren = 0;

            //     // Sum up all adults and children across all rooms
            //     document.querySelectorAll(".adults-input").forEach(input => {
            //         totalAdults += parseInt(input.value);
            //     });
            //     document.querySelectorAll(".children-input").forEach(input => {
            //         totalChildren += parseInt(input.value);
            //     });

            //     // Update the summary text
            //     guestsSummary.textContent =
            //         `${totalAdults} adult${totalAdults > 1 ? 's' : ''}, ${totalChildren} child${totalChildren > 1 ? 'ren' : ''}`;
            // };
            // Update the guest summary and manage the visibility of remove-room buttons
            const updateGuestSummary = () => {
                let totalAdults = 0;
                let totalChildren = 0;

                // Sum up all adults and children across all rooms
                document.querySelectorAll(".adults-input").forEach(input => {
                    totalAdults += parseInt(input.value);
                });
                document.querySelectorAll(".children-input").forEach(input => {
                    totalChildren += parseInt(input.value);
                });

                // Update the summary text
                guestsSummary.textContent =
                    `${totalAdults} adult${totalAdults > 1 ? 's' : ''}, ${totalChildren} child${totalChildren > 1 ? 'ren' : ''}`;

                // Hide the remove button if only one room exists
                const currentRooms = roomsContainer.querySelectorAll(".room");
                const removeRoomButtons = document.querySelectorAll(".remove-room");
                if (currentRooms.length === 1) {
                    removeRoomButtons.forEach(button => {
                        button.style.display = "none";
                    });
                } else {
                    removeRoomButtons.forEach(button => {
                        button.style.display =
                            "inline"; // Show the button when more than one room exists
                    });
                }
            };


            // Toggle the guest modal
            guestInput.addEventListener("click", () => {
                if (guestModal.classList.contains("d-none")) {
                    guestModal.classList.remove("d-none");
                    setTimeout(() => guestModal.classList.add("show"), 10); // Add animation
                } else {
                    guestModal.classList.remove("show");
                    setTimeout(() => guestModal.classList.add("d-none"), 300);
                }
            });

            // Add a new room dynamically
            // Add a new room dynamically
            const addRoom = () => {
                const currentRooms = roomsContainer.querySelectorAll(".room");
                const nextRoomNumber = currentRooms.length + 1; // Correctly calculate the next room number

                const roomDiv = document.createElement("div");
                roomDiv.classList.add("room");
                roomDiv.setAttribute("data-room", nextRoomNumber);

                roomDiv.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <strong>Room ${nextRoomNumber}</strong>
            <div class="mt-1">
                <i class="bi bi-x-square remove-room" role="button" data-room="${nextRoomNumber}"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 mb-3">
                <label class="form-label" style="margin-bottom: -15px;">Adults</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary shadow-none decrease-adults rounded-0" type="button">-</button>
                    <input type="number" class="form-control shadow-none rounded-0 text-center adults-input" style="margin-top: 10px;" value="1" min="1">
                    <button class="btn btn-outline-secondary shadow-none increase-adults rounded-0" type="button">+</button>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <label class="form-label" style="margin-bottom: -15px;">Children under 12 years old</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary shadow-none decrease-children rounded-0" type="button">-</button>
                    <input type="number" class="form-control shadow-none rounded-0 text-center children-input" style="margin-top: 10px;" value="0" min="0">
                    <button class="btn btn-outline-secondary shadow-none increase-children rounded-0" type="button">+</button>
                </div>
            </div>
        </div>
        <hr class="border-2 border-danger">
    `;

                roomsContainer.appendChild(roomDiv);
                updateGuestSummary(); // Update summary after adding a new room
            };


            addRoomBtn.addEventListener("click", addRoom);

            // Increment and decrement functionality for adults and children
            document.addEventListener("click", (e) => {
                if (e.target.classList.contains("increase-adults")) {
                    const input = e.target.previousElementSibling;
                    input.value = parseInt(input.value) + 1;
                }
                if (e.target.classList.contains("decrease-adults")) {
                    const input = e.target.nextElementSibling;
                    if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
                }
                if (e.target.classList.contains("increase-children")) {
                    const input = e.target.previousElementSibling;
                    input.value = parseInt(input.value) + 1;
                }
                if (e.target.classList.contains("decrease-children")) {
                    const input = e.target.nextElementSibling;
                    if (parseInt(input.value) > 0) input.value = parseInt(input.value) - 1;
                }

                updateGuestSummary(); // Update summary after changing values
            });


            // Remove a room and renumber remaining rooms
            document.addEventListener("click", (e) => {
                if (e.target.classList.contains("remove-room")) {
                    const currentRooms = roomsContainer.querySelectorAll(".room");

                    // Prevent removing the last room
                    if (currentRooms.length === 1) {
                        alert("You cannot remove the last room.");
                        return; // Stop further execution
                    }

                    e.stopPropagation(); // Prevent modal close or click propagation
                    const roomToRemove = e.target.closest(".room");
                    roomToRemove.remove();

                    // Re-number rooms dynamically
                    const rooms = roomsContainer.querySelectorAll(".room");
                    rooms.forEach((room, index) => {
                        const roomNumber = index + 1; // Room numbers start at 1
                        room.querySelector("strong").textContent = `Room ${roomNumber}`;
                        room.setAttribute("data-room", roomNumber);
                        room.querySelector(".remove-room").setAttribute("data-room", roomNumber);
                    });

                    updateGuestSummary(); // Update summary after removing a room
                }
            });
            // Handle the Done button
            doneBtn.addEventListener("click", () => {
                guestModal.classList.remove("show");
                setTimeout(() => guestModal.classList.add("d-none"), 300);
            });
            // Close modal when clicking outside (but not on the modal content or remove button)
            document.addEventListener("click", (e) => {
                if (!guestModal.contains(e.target) && !guestInput.contains(e.target) && !e.target.classList
                    .contains("remove-room")) {
                    guestModal.classList.remove("show");
                    setTimeout(() => guestModal.classList.add("d-none"), 300);
                }
            });
        });
    </script>
@endsection

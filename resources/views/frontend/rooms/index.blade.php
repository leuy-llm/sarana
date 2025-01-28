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
            background-color: #750d0d;
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
            font-family: 'Jost', serif;
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

        .special-offer {
            background-color: #e83e8c;
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

        .card {
            transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
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

            .footer-label {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .footer-label div {
                width: 100%;
            }

            .footer-label select {
                width: 100%;
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

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            /* Longer fade-in/out time */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            width: 80%;
            max-width: 700px;
            border-radius: 10px;
            animation: fadeInScale 0.3s ease-in-out;
            position: relative;
            opacity: 0;
            /* Start invisible */
            transform: scale(0.9);
            /* Start slightly smaller */
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            /* Smooth transition for both */
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }


        /* When the modal is open */
        .modal.open {
            display: flex;
            opacity: 1;
        }

        .modal.open .modal-content {
            opacity: 1;
            transform: scale(1);
            /* Scale to normal size when modal opens */
        }

        /* Fade-out effect (when closing) */
        .modal.closing {
            opacity: 0;
        }

        .modal.closing .modal-content {
            opacity: 0;
            transform: scale(0.9);
            /* Scale down during fade-out */
        }

        /* Modal Header */
        .modal-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        /* The Close Button */
        .close {
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #ff0000;
            text-decoration: none;
        }

        /* Modal Body */
        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .room-section {
            margin-bottom: 20px;
        }

        .room-section h3 {
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #007bff;
        }

        .btn-confirm {
            padding: 15px;
            backgrou border: 0;
            outline: none;

        }

        @keyframes pulsate {
            0% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }
        }

        .no-rooms {
            transition: all 0.3s ease;
            animation: pulsate1 2s infinite;
        }

        @keyframes pulsate1 {
            0% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }
        }

        .book-now-btn {
            background: #deb666;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
            animation: pulsate 2s infinite;
        }

        .book-now-btn:hover {
            background: #c89c55;
            color: #ffffff;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            /* Enhance shadow on hover */
        }

        @media screen and (max-width: 1184px) {
            .card {
                width: 100%;
                border: none;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                /* Ensures the image does not overflow */
            }

            .card img {
                width: 100%;
                /* Make the image fill the card width */
                height: 200px;
                /* Set a fixed height or use 'auto' if you want */
                object-fit: cover;
                /* Ensures the image covers the area properly */
                display: block;
            }

            .card-body {
                text-align: left;
                /* Align text to the left */
                padding: 15px;
            }

            .card-body h5 {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 5px;
            }

            .card-body .location {
                display: flex;
                align-items: center;
                font-size: 14px;
                color: #007bff;
            }

            .card-body .location i {
                margin-right: 5px;
            }

            .rating {
                display: flex;
                gap: 5px;
            }

            .form-check {
                text-align: center;
            }

            .book-now-btn {
                width: 100%;
            }

            .footer-label {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .footer-label div {
                width: 100%;
            }

            .footer-label select {
                width: 100%;
            }

        }

        /* Modal Background */
        .custom-modal {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        /* Modal Content */
        .custom-modal-content {
            background: #fff;
            /* White background */
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            animation: modalFadeIn 0.3s ease-in-out;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .custom-modal-content h5 {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 700;
        }

        /* Modal Header */
        .custom-modal-header {
            background: #deb666;
            /* Gold-like color for elegance */
            color: white;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Close Button */
        .close-modal {
            background: transparent;
            border: none;
            color: white;
            font-size: 30px;
            font-weight: bold;
            outline: none;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;

        }

        .close-modal:focus {
            outline: none;
        }

        .close-modal:hover {
            transform: scale(1.2);
        }

        /* Modal Body */
        .custom-modal-body {
            padding: 20px;
            font-size: 16px;
            color: #555;
            text-align: center;
        }

        /* Modal Footer */
        .custom-modal-footer {
            background: #f9f9f9;
            padding: 15px;
            text-align: center;
        }

        /* Buttons */
        .custom-btn {
            background: #deb666;
            /* Gold-like color */
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .custom-btn:hover {
            background: #cda555;
            /* Slightly darker gold */
        }

        /* Modal Animation */
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modalwarning {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .modal-contentwarning {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            position: relative;
            /* Make it the reference for absolute positioning */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-contentwarning p {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 18px;

        }

        .close-modalwarning {
            cursor: pointer;
            font-size: 22px;
            font-weight: bold;
            color: red;
            position: absolute;
            top: 5px;
            right: 15px;

            transition: scale 0.2s ease-in-out;
        }

        .close-modalwarning:hover {
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
                <div class="col-lg-3 p-3 col-md-12 mb-4 mb-lg-0 rounded">
                    <div class="search-box shadow">
                        <div class="search-header" style="font-size: 20px;font-weight: bold;">
                            Modify Filter
                        </div>
                        <form id="filter-form" action="{{ route('filterRooms') }}#rooms-container" method="GET">
                            <div class="px-3 pt-3">
                                <label for="checkin" class="form-label">Check In</label>
                                <input type="date" name="check_in" id="checkin"
                                    class="form-control rounded-0 shadow-none me-1" style="padding: 22px;"
                                    value="{{ request('check_in') }}" required>
                            </div>
                            <div class="px-3 pt-3">
                                <label for="checkout" class="form-label">Check Out</label>
                                <input type="date" name="check_out" id="checkout"
                                    class="form-control rounded-0 shadow-none me-1" style="padding: 22px;"
                                    value="{{ request('check_out') }}" required>
                            </div>

                            <div class="footer-label p-3">
                                <div class="d-flex justify-content-center align-items-center gap-4">
                                    <div>
                                        <label for="adults" class="form-label" style="color :#212529">Adults</label>
                                        <select name="adults" id="adults" class="form-select  adults shadow-none"
                                            style="padding: 10px;outline: none;border-color: #ced4da" required>
                                            <option value="" disabled>Select adults</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('adults') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Adult{{ $i > 1 ? 's' : '' }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="ml-3">
                                        <label for="children" class="form-label" style="color :#212529">Children</label>
                                        <select name="children" id="children"
                                            style="padding: 10px;outline: none;border-color: #ced4da"
                                            class="form-select shadow-none children shadow-none" required>
                                            <option value="" disabled>Select children</option>
                                            @for ($i = 0; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('children') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Child{{ $i > 1 ? 'ren' : '' }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 pt-3">
                                <label for="price-range" class="form-label">Price Range</label>
                                <div id="price-range-slider" style="margin: 20px 0;"></div>
                                <input type="hidden" name="price_min" id="price_min_input"
                                    value="{{ request('price_min', 50) }}">
                                <input type="hidden" name="price_max" id="price_max_input"
                                    value="{{ request('price_max', 5000) }}">
                                <p class="text-center mt-1">
                                    <span id="price-min">{{ request('price_min', 50) }}</span> -
                                    <span id="price-max">{{ request('price_max', 5000) }}</span>
                                </p>
                            </div>
                            <div class="px-3">
                                <button type="submit" id="search-btn"
                                    class="btn shadow-none  btn-primary mb-3 w-100 py-3">Apply Filter</button>
                            </div>
                            <div class="px-3">
                                <button type="button" id="reset-btn"
                                    class="btn btn-secondary shadow-none mb-3 w-100 py-3">Reset Filter</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-9 col-sm-12 col-md-12">
                    <div id="rooms-container" class="container py-4" data-aos="fade-down" data-aos-duration="1500"
                        data-aos-delay="100">
                        @if ($rooms->isEmpty())
                            <div class="alert alert-warning no-rooms text-center"
                                style="font-family: 'Jost', serif;font-size: 16px;">
                                <h3> No rooms available for the selected criteria. Please adjust your search and try again.
                                </h3>
                            </div>
                        @else
                            @foreach ($rooms as $room)
                                <div class="card mb-4 shadow border-0 rounded-start">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                                alt="{{ $room->roomType->type_name }} image"
                                                class="img-fluid rounded-start"
                                                style="height: 440px; width: 700px; object-fit: cover;" loading="lazy">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                                                <p class="text-muted small">
                                                    <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                                                </p>
                                                @if ($room->special_price)
                                                    <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special
                                                        Price</h6>
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
                                                <h6 class="mt-3 "><strong class="text-uppercase">Guests</strong> :
                                                    {{ $room->max_person }} persons
                                                </h6>

                                                @if ($room->facilities->isEmpty())
                                                    <h6 style="margin-top: -10px;"><strong
                                                            class="text-uppercase">Facilities
                                                        </strong>: None</h6>
                                                @else
                                                    <h6 style="margin-top: -5px;"><strong
                                                            class="text-uppercase">Facilities
                                                        </strong>:
                                                        {{ Str::limit(implode(', ', $room->facilities->pluck('name')->toArray()), 50) }}
                                                    </h6>
                                                @endif
                                                <span><strong>Bed</strong>:
                                                    {{ $room->bed_type }}</span>,
                                                <span><strong>View</strong>:
                                                    {{ $room->view_type }}</span>,
                                                <span><strong>Size</strong>
                                                    : {{ $room->room_size }} m²</span>
                                                <h6 style="margin-top: 15px;">{{ Str::limit($room->description, 60) }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                                            <div>
                                                @if ($room->special_price)
                                                    <span style="font-size: 12px; margin-top:-30px;"
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
                                            <a href="#"
                                                class="select-booking-date mb-2 text-left py-1 w-100 text-primary text-decoration-none shadow-none px-2 booking-date-btn"
                                                style="font-size: 14px; background:#f1f2f3;">
                                                Select Booking Date
                                            </a>

                                            <div class="form-check mb-2">

                                                <input type="checkbox" class="form-check-input"
                                                    id="room_{{ $room->id }}" name="rooms[]"
                                                    value="{{ $room->id }}"
                                                    data-max-person="{{ $room->max_person }}">

                                                <label class="form-check-label" for="room_{{ $room->id }}">Select
                                                    Room</label>
                                            </div>
                                            <div class="adultchild">
                                                <input type="text" placeholder="Enter number of adults"
                                                    class="mb-2 shadow-none rounded-0 form-control form-control-sm"
                                                    id="adults_room_{{ $room->id }}"
                                                    name="adults[{{ $room->id }}]"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    min="1" required>
                                                <input type="text" placeholder="Enter number of children"
                                                    class="shadow-none rounded-0 form-control form-control-sm"
                                                    id="children_room_{{ $room->id }}"
                                                    name="children[{{ $room->id }}]"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    min="0" required>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
                                {{ $rooms->appends(request()->query())->links() }}
                            </div>
                            <div class="col-12 text-center mt-3">
                                <a id="proceedToBooking"
                                    class="btn book-now-btn mb-2 shadow-none rounded-0 py-3 font-weight-bold text-uppercase text-white px-4"
                                    style="background: #deb666; font-size: 14px; border-radius: 3px;">
                                    Proceed to Booking
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="modal fade" id="loginRegisterModal" style="z-index: 9999" tabindex="-1" aria-labelledby="loginRegisterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #d7b661;color: white;">
                    <h5 class="modal-title" id="loginRegisterModalLabel">Login or Register</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please verify your email address to proceed with the payment.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="customModal" class="custom-modal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5 class="custom-modal-title text-white">Verify Your Email</h5>
                <button class="close-modal">&times;</button>
            </div>
            <div class="custom-modal-body">
                <p style=" font-family: 'Source Sans Pro', sans-serif; font-size: 18px;">Please verify your email address
                    to proceed with the booking.</p>
            </div>
            <div class="custom-modal-footer">
                {{-- <button class="custom-btn close-modal">Close</button> --}}
            </div>
        </div>
    </div>

    <div id="errorModal" class="modalwarning" style="display: none;">
        <div class="modal-contentwarning">
            <span class="close-modalwarning" id="closeErrorModal">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>



@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to attach event listeners to "Book Now" buttons
            //         function attachBookNowButtonListeners() {
            //     var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
            //     var hasVerifiedEmail =
            //         {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'true' : 'false' }};

            //     console.log("isLoggedIn:", isLoggedIn);
            //     console.log("hasVerifiedEmail:", hasVerifiedEmail);

            //     var bookNowButtons = document.querySelectorAll('.book-now-btn');

            //     bookNowButtons.forEach(function (button) {
            //         button.addEventListener('click', function (event) {
            //             if (!isLoggedIn) {
            //                 console.log("User is not logged in. Redirecting to register page.");
            //                 event.preventDefault();
            //                 window.location.href = "{{ route('register.guest') }}?redirect=" + encodeURIComponent(window.location.href);
            //             } else if (!hasVerifiedEmail) {
            //                 console.log("User has not verified email. Showing modal.");
            //                 event.preventDefault();
            //                 // showVerificationModal();
            //             }
            //         });
            //     });
            // }
            // // Attach event listeners to "Book Now" buttons on initial page load
            // attachBookNowButtonListeners();

            // Disable "Check-out" field initially
            // $('#checkout').prop('disabled', true);

            // // Enable check-out date based on check-in date selection
            // $('#checkin').on('change', function() {
            //     const checkinDate = $(this).val();
            //     if (checkinDate) {
            //         $('#checkout').attr('min', checkinDate).prop('disabled', false);
            //     } else {
            //         $('#checkout').prop('disabled', true).val('');
            //     }
            // });

            // Form validation and submission
            $('#search-btn').on('click', function(e) {
                e.preventDefault();

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
                    $(fieldsToValidate.find((field) => !$(field).val())).focus();
                    return;
                }

                // Update hidden inputs with price range values before submitting
                const priceValues = priceSlider.noUiSlider.get();
                $('#price_min_input').val(Math.round(priceValues[0]));
                $('#price_max_input').val(Math.round(priceValues[1]));

                $('#filter-form').submit();
            });

            // Handle immediate removal of red border on input change
            $('#filter-form').on('input change', 'input, select', function() {
                if ($(this).val()) {
                    $(this).removeClass('border-red');
                }
            });

            // Initialize price range slider
            const priceSlider = document.getElementById('price-range-slider');
            noUiSlider.create(priceSlider, {
                start: [parseInt($('#price_min_input').val()), parseInt($('#price_max_input').val())],
                connect: true,
                range: {
                    min: 50,
                    max: 5000
                },
                step: 50,
                tooltips: [true, true]
            });

            priceSlider.noUiSlider.on('update', function(values) {
                $('#price-min').text(Math.round(values[0]));
                $('#price-max').text(Math.round(values[1]));
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

        //hide "Select Booking Date" and check box
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filter-form');
            const roomCheckboxes = document.querySelectorAll('input[name="rooms[]"]'); // Select all room checkboxes
            const bookingDateBtns = document.querySelectorAll('.booking-date-btn');

            // Initially hide all room checkboxes before filter
            roomCheckboxes.forEach(checkbox => {
                checkbox.closest('.form-check').style.display = 'none'; // Hide the checkbox wrapper
            });

            const adultchild = document.querySelectorAll('.adultchild');

            // Check if URL has query params (meaning the filter has been applied)
            adultchild.forEach(field => {
                field.closest('.adultchild').style.display = 'none';
            })

            // Check if URL has query params (meaning the filter has been applied)
            if (window.location.search.includes('check_in') && window.location.search.includes('check_out')) {
                // Show room checkboxes after filter is applied
                roomCheckboxes.forEach(checkbox => {
                    checkbox.closest('.form-check').style.display = 'block'; // Show the checkbox wrapper
                });

                // Show "Select Booking Date" buttonsad
                adultchild.forEach(field => {
                    field.closest('.adultchild').style.display = 'block';
                })


                // Hide "Select Booking Date" buttons
                bookingDateBtns.forEach(btn => {
                    btn.style.display = 'none'; // Hide all "Select Booking Date" buttons
                });
                // Show adult/child fields
            }

            // Handle filter form submission (e.g., after user selects filter options)
            filterForm.addEventListener('submit', function() {
                bookingDateBtns.forEach(btn => {
                    btn.style.display = 'none'; // Hide on form submit
                });

                // Show room checkboxes after filter is applied
                roomCheckboxes.forEach(checkbox => {
                    checkbox.closest('.form-check').style.display =
                        'block'; // Show the checkbox wrapper
                });
            });

            // Optional: Show the room checkboxes if the user clicks on a reset filter button
            const resetFilterBtn = document.getElementById('reset-filter-btn'); // Optional reset button
            if (resetFilterBtn) {
                resetFilterBtn.addEventListener('click', function() {
                    // Show room checkboxes when reset is clicked
                    roomCheckboxes.forEach(checkbox => {
                        checkbox.closest('.form-check').style.display =
                            'block'; // Show the checkbox wrapper
                    });
                    // Show booking date buttons after reset
                    bookingDateBtns.forEach(btn => {
                        btn.style.display = 'block'; // Show "Select Booking Date" buttons
                    });
                });
            }
        });
        //Reset filter
        document.addEventListener('DOMContentLoaded', function() {
            const resetBtn = document.getElementById('reset-btn');
            const filterForm = document.getElementById('filter-form');

            resetBtn.addEventListener('click', function() {
                // Reset form fields to their default values
                filterForm.reset();

                // Reset the price range values
                document.getElementById('price_min_input').value = "50";
                document.getElementById('price_max_input').value = "5000";
                document.getElementById('price-min').innerText = "50";
                document.getElementById('price-max').innerText = "5000";
                // Redirect back to the original room page
                window.location.href = "/room";
            });
        });

        //     document.addEventListener("DOMContentLoaded", function() {
        //         const proceedButton = document.getElementById("proceedToBooking");
        //         const checkboxes = document.querySelectorAll('input[name="rooms[]"]');
        //         const maxRooms = 4;
        //         proceedButton.addEventListener("click", function(event) {
        //             event.preventDefault();
        //             let selectedRooms = [];
        //             let adults = {};
        //             let children = {};
        //             let validationErrors = false;

        //             checkboxes.forEach((checkbox) => {
        //                 if (checkbox.checked) {
        //                     const roomId = checkbox.value;
        //                     const maxPerson = parseInt(checkbox.dataset.maxPerson,
        //                         10); // Get max_person from dataset
        //                     const adultCount = parseInt(
        //                         document.getElementById(`adults_room_${roomId}`).value || "0",
        //                         10
        //                     );
        //                     const childCount = parseInt(
        //                         document.getElementById(`children_room_${roomId}`).value || "0",
        //                         10
        //                     );

        //                     // Validate both adults and children must be entered
        //                     if (adultCount === 0 || childCount === 0) {
        //                         alert(`Please enter both adults and children`);
        //                         validationErrors = true;
        //                     } else if (adultCount + childCount > maxPerson) {
        //                         alert(
        //                             `The total number of guests exceeds the limit (${maxPerson}).`
        //                         );
        //                         validationErrors = true;
        //                     }

        //                     if (validationErrors) {
        //                         document.getElementById(`adults_room_${roomId}`).focus();
        //                         return; // Stop further validation
        //                     }

        //                     selectedRooms.push(roomId);
        //                     adults[roomId] = adultCount;
        //                     children[roomId] = childCount;
        //                 }
        //             });

        //             if (validationErrors) {
        //                 return; // Stop form submission if validation fails
        //             }

        //             if (selectedRooms.length === 0) {
        //                 alert("Please select at least one room.");
        //                 return;
        //             } else if (selectedRooms.length > maxRooms) {
        //                 alert(`You can select up to ${maxRooms} rooms only.`);
        //                 return;
        //             }

        //             const checkIn = "{{ $checkIn }}";
        //             const checkOut = "{{ $checkOut }}";
        //             const bookingUrl = `{{ route('books.create') }}?rooms=${selectedRooms.join(
    //     ","
    // )}&check_in=${checkIn}&check_out=${checkOut}&adults=${encodeURIComponent(
    //     JSON.stringify(adults)
    // )}&children=${encodeURIComponent(JSON.stringify(children))}`;
        //             console.log("Booking URL:", bookingUrl);

        //             window.location.href = bookingUrl;
        //         });
        //     });

        //     document.addEventListener("DOMContentLoaded", function () {
        //     const proceedButton = document.getElementById("proceedToBooking");
        //     const checkboxes = document.querySelectorAll('input[name="rooms[]"]');
        //     const maxRooms = 4;

        //     // Show the modal
        //     function showModal() {
        //         const modal = document.getElementById("customModal");
        //         modal.style.display = "flex";
        //     }

        //     // Hide the modal
        //     function closeModal() {
        //         const modal = document.getElementById("customModal");
        //         modal.style.display = "none";
        //     }

        //     // Attach event listeners for modal close buttons
        //     document.querySelectorAll(".close-modal").forEach((button) => {
        //         button.addEventListener("click", closeModal);
        //     });

        //     proceedButton.addEventListener("click", function (event) {
        //         event.preventDefault();
        //         let selectedRooms = [];
        //         let adults = {};
        //         let children = {};
        //         let validationErrors = false;

        //         checkboxes.forEach((checkbox) => {
        //             if (checkbox.checked) {
        //                 const roomId = checkbox.value;
        //                 const maxPerson = parseInt(checkbox.dataset.maxPerson, 10); // Get max_person from dataset
        //                 const adultCount = parseInt(
        //                     document.getElementById(`adults_room_${roomId}`).value || "0",
        //                     10
        //                 );
        //                 const childCount = parseInt(
        //                     document.getElementById(`children_room_${roomId}`).value || "0",
        //                     10
        //                 );

        //                 // Validate both adults and children must be entered
        //                 if (adultCount === 0 || childCount === 0) {
        //                     alert(`Please enter both adults and children`);
        //                     validationErrors = true;
        //                 } else if (adultCount + childCount > maxPerson) {
        //                     alert(
        //                         `The total number of guests exceeds the limit (${maxPerson}).`
        //                     );
        //                     validationErrors = true;
        //                 }

        //                 if (validationErrors) {
        //                     document.getElementById(`adults_room_${roomId}`).focus();
        //                     return; // Stop further validation
        //                 }

        //                 selectedRooms.push(roomId);
        //                 adults[roomId] = adultCount;
        //                 children[roomId] = childCount;
        //             }
        //         });

        //         if (validationErrors) {
        //             return; // Stop form submission if validation fails
        //         }

        //         if (selectedRooms.length === 0) {
        //             alert("Please select at least one room.");
        //             return;
        //         } else if (selectedRooms.length > maxRooms) {
        //             alert(`You can select up to ${maxRooms} rooms only.`);
        //             return;
        //         }

        //         // Use server-side data to check verification status
        //         const isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
        //         const hasVerifiedEmail = {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'true' : 'false' }};

        //         if (!isLoggedIn) {
        //             // Redirect to registration/login if not logged in
        //             window.location.href = "{{ route('register.guest') }}?redirect=" + encodeURIComponent(window.location.href);
        //         } else if (!hasVerifiedEmail) {
        //             // Show modal if the email is not verified
        //             showModal();
        //             return;
        //         } else {
        //             // If the guest is logged in and email is verified, proceed to booking
        //             const checkIn = "{{ $checkIn }}";
        //             const checkOut = "{{ $checkOut }}";
        //             const bookingUrl = `{{ route('books.create') }}?rooms=${selectedRooms.join(
    //                 ","
    //             )}&check_in=${checkIn}&check_out=${checkOut}&adults=${encodeURIComponent(
    //                 JSON.stringify(adults)
    //             )}&children=${encodeURIComponent(JSON.stringify(children))}`;
        //             console.log("Booking URL:", bookingUrl);

        //             window.location.href = bookingUrl;
        //         }
        //     });
        // });

        document.addEventListener("DOMContentLoaded", function() {
            const proceedButton = document.getElementById("proceedToBooking");
            const checkboxes = document.querySelectorAll('input[name="rooms[]"]');
            const maxRooms = 4;

            // Show the modal
            function showModal() {
                const modal = document.getElementById("customModal");
                modal.style.display = "flex";
            }

            // Hide the modal
            function closeModal() {
                const modal = document.getElementById("customModal");
                modal.style.display = "none";
            }

            // Attach event listeners for modal close buttons
            document.querySelectorAll(".close-modal").forEach((button) => {
                button.addEventListener("click", closeModal);
            });

            function showErrorModal(message) {
                const modal = document.getElementById("errorModal");
                const messageContainer = document.getElementById("errorMessage");
                messageContainer.textContent = message;
                modal.style.display = "flex";
            }

            document.getElementById("closeErrorModal").addEventListener("click", function() {
                const modal = document.getElementById("errorModal");
                modal.style.display = "none";
            });


            proceedButton.addEventListener("click", function(event) {
                event.preventDefault();
                let selectedRooms = [];
                let adults = {};
                let children = {};
                let validationErrors = false;

                checkboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                        const roomId = checkbox.value;
                        const maxPerson = parseInt(checkbox.dataset.maxPerson,
                            10); // Get max_person from dataset
                        const adultCount = parseInt(
                            document.getElementById(`adults_room_${roomId}`).value || "0",
                            10
                        );
                        const childCount = parseInt(
                            document.getElementById(`children_room_${roomId}`).value || "0",
                            10
                        );

                        // Validate adults must be at least 1
                        if (adultCount < 1) {
                            // alert(`Please enter both adults and children`);
                            showErrorModal(`Please enter at least 1 adult .`);
                            validationErrors = true;
                        } else if (adultCount + childCount > maxPerson) {
                            // Validate total guests don't exceed maxPerson
                            // alert(
                            //     `The total number of guests exceeds the limit (${maxPerson}) .`
                            // );
                            showErrorModal(
                                `The total number of guests exceeds the limit (${maxPerson}).`
                            );
                            validationErrors = true;
                        }

                        if (validationErrors) {
                            document.getElementById(`adults_room_${roomId}`).focus();
                            return; // Stop further validation
                        }

                        selectedRooms.push(roomId);
                        adults[roomId] = adultCount;
                        children[roomId] = childCount;
                    }
                });

                if (validationErrors) {
                    return; // Stop form submission if validation fails
                }

                if (selectedRooms.length === 0) {
                    // alert("Please select at least one room.");
                    showErrorModal("Please select at least one room.");

                    return;
                } else if (selectedRooms.length > maxRooms) {
                    // alert(`You can select up to ${maxRooms} rooms only.`);
                    showErrorModal(`You can select up to ${maxRooms} rooms only.`);
                    return;
                }

                // Use server-side data to check verification status
                const isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
                const hasVerifiedEmail =
                    {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'true' : 'false' }};

                if (!isLoggedIn) {
                    // Redirect to registration/login if not logged in
                    window.location.href = "{{ route('register.guest') }}?redirect=" + encodeURIComponent(
                        window.location.href);
                } else if (!hasVerifiedEmail) {
                    // Show modal if the email is not verified
                    showModal();
                    return;
                } else {
                    // If the guest is logged in and email is verified, proceed to booking
                    const checkIn = "{{ $checkIn }}";
                    const checkOut = "{{ $checkOut }}";
                    const bookingUrl = `{{ route('books.create') }}?rooms=${selectedRooms.join(
                ","
            )}&check_in=${checkIn}&check_out=${checkOut}&adults=${encodeURIComponent(
                JSON.stringify(adults)
            )}&children=${encodeURIComponent(JSON.stringify(children))}`;
                    console.log("Booking URL:", bookingUrl);

                    window.location.href = bookingUrl;
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Check if the URL contains the anchor (#rooms-container)
            if (window.location.hash === "#rooms-container") {
                // Scroll to the rooms container
                const roomsContainer = document.getElementById("rooms-container");
                if (roomsContainer) {
                    roomsContainer.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const filterForm = document.getElementById("filter-form");

            filterForm.addEventListener("submit", function() {
                // Save the current scroll position in localStorage
                localStorage.setItem("scrollPosition", window.scrollY);
            });

            // Restore the scroll position after the page reloads
            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                localStorage.removeItem("scrollPosition"); // Clear the saved position
            }
        });

        // document.addEventListener("DOMContentLoaded", function () {
        //     // Show the modal
        //     function showModal() {
        //         const modal = document.getElementById("customModal");
        //         modal.style.display = "flex";
        //     }

        //     // Hide the modal
        //     function closeModal() {
        //         const modal = document.getElementById("customModal");
        //         modal.style.display = "none";
        //     }

        //     // Attach event listeners
        //     document.querySelectorAll(".close-modal").forEach((button) => {
        //         button.addEventListener("click", closeModal);
        //     });

        //     // Example: Show the modal when a button is clicked
        //     document.querySelector("#proceedToBooking").addEventListener("click", function (event) {
        //         event.preventDefault();

        //         // Use server-side data to check verification status
        //         const isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
        //         const hasVerifiedEmail = {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'true' : 'false' }};

        //         if (!isLoggedIn) {
        //             // Redirect to registration/login if not logged in
        //             window.location.href = "{{ route('register.guest') }}?redirect=" + encodeURIComponent(window.location.href);
        //         } else if (!hasVerifiedEmail) {
        //             // Show modal if the email is not verified
        //             showModal();
        //             return;
        //         } else {
        //             // Proceed to booking (you can redirect or handle booking logic here)
        //             console.log("Guest is logged in and email is verified. Proceeding to booking...");
        //         }
        //     });
        // });
    </script>
@endsection

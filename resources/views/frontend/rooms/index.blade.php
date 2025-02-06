@extends('layout.master')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');

        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e67e22;
            --light-gray: #f8f9fa;
        }

        body {
            background-color: #f5f5f5;
            font-family: 'Oswald', sans-serif;
        }

        .custom-modal {
            display: none;

            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);

            z-index: 9999;
            justify-content: center;
            align-items: center;
        }


        .custom-modal-content {
            background: #fff;

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


        .custom-modal-header {
            background: #deb666;

            color: white;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


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


        .custom-modal-body {
            padding: 20px;
            font-size: 16px;
            color: #555;
            text-align: center;
        }


        .custom-modal-footer {
            background: #f9f9f9;
            padding: 15px;
            text-align: center;
        }


        .custom-btn {
            background: #deb666;

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

        }


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

        .booking-container {
            position: relative;
            padding: 50px;
        }

        .amenity-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .search-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 40px;
        }

        .room-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            font-family: 'Oswald', sans-serif;
        }

        .room-card:hover {
            transform: translateY(-5px);
        }

        .room-card h5.card-title {
            font-family: 'Oswald', sans-serif;
            font-weight: bold;
            font-size: 24px;
        }

        .room-card.selected {
            border: 2px solid var(--secondary-color);
        }


        .room-image {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .room-features {
            display: flex;
            gap: 15px;
            margin: 15px 0;
            color: #666;
            font-family: 'Oswald', sans-serif;
        }

        .room-features span.room-feature {

            font-size: 16px;
            font-family: 'Oswald', sans-serif;
        }

        .price-tag {
            color: var(--secondary-color);
            font-size: 24px;
            font-weight: bold;
        }

        .btn-book {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-search {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 10px;
            border: none;
            border-radius: 5px;
            margin-top: 32px;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background-color: #d35400;
            transform: translateY(-2px);
            color: white;
        }

        .btn-book:hover {
            background-color: #d35400;
            transform: translateY(-2px);
            color: white;
        }

        .btn-book.selected {
            background-color: #c0392b;
        }

        .badge-custom {
            background-color: var(--secondary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-family: 'Oswald', sans-serif;
        }

        .selected-rooms-summary {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-top: 30px;
            font-family: 'Oswald', sans-serif;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .selected-room-item {
            background: var(--light-gray);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .selected-room-item h5 {
            font-size: 18px;
            font-family: 'Oswald', sans-serif;
            font-weight: bold;
        }

        .selected-room-item span {

            font-family: 'Oswald', sans-serif;
        }

        .guest-inputs {
            background: rgba(230, 126, 34, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
        }

        .proceed-booking {
            background: var(--primary-color);
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            border: none;
            width: 100%;
            margin-top: 20px;
            font-size: 1.1rem;
        }

        .proceed-booking:hover {
            background: #234567;
            color: white;
        }

        .total-price {
            font-size: 24px;
            color: var(--primary-color);
            font-weight: bold;
        }

        .spinner-border {
            width: 1rem;
            height: 1rem;
            margin-right: 8px;
        }

        .filter-section {
            background: white;
            border-radius: 15px;
            padding: 20px;
            height: fit-content;
        }

        .filter-title {
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .form-select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            outline: none;
            width: 100%;
        }

        input.form-control {
            padding: 22px !important;

        }

        .btn-reset {
            background: grey;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            margin-top: 32px;
            font-size: 1.1rem;
        }

        .btn-reset:hover {
            background: #605b5a;
            transform: translateY(-2px);
            color: white;
        }

        .no-rooms {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Styling for H3 */
        .no-rooms h3 {
            font-family: 'Sail', system-ui;
            font-size: 35px;
        }

        /* Gradient Text Effect */
        .gradient-text {
            font-weight: bold;
            background: linear-gradient(45deg, #ff7e5f, #feb47b, #ffec61, #43cea2, #185a9d);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientAnimation 3s ease infinite;
        }

        /* Fade-in Animation */
        .animate-text {
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Gradient Animation */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
@section('content')
    <div class="hero-section" data-aos="fade-down" data-aos-duration="1000">
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
    <div class="booking-container">
        <div class="container-fluid">
            <!-- Search Card -->
            <div class="search-card" data-aos="fade-down" data-aos-duration="2000">
                <form id="filter-form" action="{{ route('filterRooms') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-2">
                            <label class="form-label">Check In</label>
                            <input type="date" class="form-control shadow-none" name="check_in"
                                value="{{ request('check_in') }}" id="checkIn" required>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <label class="form-label">Check Out</label>
                            <input type="date" class="form-control shadow-none" name="check_out"
                                value="{{ request('check_out') }}" id="checkOut" required>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <label class="form-label">Room Type</label>
                            <select class="form-select shadow-none" name="room_type" id="roomType">
                                <option value="">Select Room Type</option>
                                @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType->type_name }}"
                                        {{ request('room_type') == $roomType->type_name ? 'selected' : '' }}>
                                        {{ $roomType->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <label class="form-label">Adults</label>
                            <select name="adults" id="adults" class="form-select  adults shadow-none"required>
                                <option value="" disabled>Select adults</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ request('adults') == $i ? 'selected' : '' }}>
                                        {{ $i }} Adult{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <label class="form-label">Children</label>
                            <select name="children" id="children" class="form-select shadow-none children ">
                                <option value="" disabled>Select children</option>
                                @for ($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ request('children') == $i ? 'selected' : '' }}>
                                        {{ $i }} Child{{ $i > 1 ? 'ren' : '' }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between flex-wrap align-items-center gap-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-search shadow-none text-white " id="searchButton">
                                <span class="spinner-border d-none" role="status" aria-hidden="true"></span>
                                Search Rooms
                            </button>
                            <a href="{{ url('room') }}" class="btn btn-reset shadow-none ml-2" id="resetButton">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-section">
                        <h5 class="filter-title">Filters</h5>
                        <!-- Price Range -->
                        {{-- <div class="mb-4">
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
                        </div> --}}
                        <form id="price-filter-form">
                            @csrf
                            <div class="mb-4">
                                <label for="price-range" class="form-label">Price Range</label>
                                <div id="price-range-slider" style="margin: 20px 0;"></div>
                                <input type="hidden" name="price_min" id="price_min_input"
                                    value="{{ request('price_min', 50) }}">
                                <input type="hidden" name="price_max" id="price_max_input"
                                    value="{{ request('price_max', 5000) }}">
                                <p class="text-center mt-1">
                                    <span id="price-min"
                                        style="font-family: 'Oswald', sans-serif;">{{ request('price_min', 50) }}</span> -
                                    <span id="price-max"
                                        style="font-family: 'Oswald', sans-serif;">{{ request('price_max', 5000) }}</span>
                                </p>
                            </div>
                        </form>
                        <div class="mb-4">
                            <label class="form-label">Amenities</label>
                            <div class="amenity-item form-check">
                                <input class="form-check-input" type="checkbox" value="wifi" id="wifi">
                                <label class="form-check-label" for="wifi">
                                    <i class="fas fa-wifi me-2"></i> Free WiFi
                                </label>
                            </div>
                            <div class="amenity-item form-check">
                                <input class="form-check-input" type="checkbox" value="breakfast" id="breakfast">
                                <label class="form-check-label" for="breakfast">
                                    <i class="fas fa-coffee me-2"></i> Breakfast
                                </label>
                            </div>
                            <div class="amenity-item form-check">
                                <input class="form-check-input" type="checkbox" value="parking" id="parking">
                                <label class="form-check-label" for="parking">
                                    <i class="fas fa-parking me-2"></i> Parking
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room Listings -->
                <div class="col-md-9">
                    <div class="row" id="roomListings">
                        {{-- @if ($rooms->isEmpty())
                            <div class="alert alert-warning no-rooms text-center animate-text">
                                <h3 class="gradient-text">
                                    No rooms available for the selected criteria.<br>
                                    Please adjust your search and try again.
                                </h3>
                            </div>
                        @else
                            @foreach ($rooms as $room)
                                <div class="col-md-6">

                                    <div class="card room-card">
                                        <div class="room-image"
                                            style="background-image: url('{{ asset('storage/' . $room->images->first()->image) }}')">
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h5 class="card-title mb-0">{{ $room->roomType->type_name }}</h5>
                                                <span class="badge-custom">Available</span>
                                            </div>
                                            <div class="room-features">
                                                <span class="room-feature"><i class="fas fa-ruler-combined"></i>
                                                    {{ $room->room_size }}m²</span>
                                                <span class="room-feature"><i class="fas fa-bed"></i>
                                                    {{ $room->bed_type }}</span>
                                                <span class="room-feature"><i class="fas fa-mountain-sun"></i>
                                                    {{ $room->view_type }}</span>
                                                <span class="room-feature"><i class="fas fa-user-friends"></i>
                                                    {{ $room->max_person }} Guests</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <p class="card-text text-muted" style="font-family: 'Oswald', sans-serif;">
                                                {{ Str::limit($room->description, 100) }}</p>
                                            <div class="guest-inputs">
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <label class="form-label">Adults</label>
                                                        <select class="form-select  adults-select"
                                                            id="adults_room_{{ $room->id }}"
                                                            name="adults[{{ $room->id }}]">
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ request('adults') == $i ? 'selected' : '' }}>
                                                                    {{ $i }} Adult{{ $i > 1 ? 's' : '' }}
                                                                </option>
                                                            @endfor
                                                        </select>

                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Children</label>
                                                        <select class="form-select children-select"
                                                            id="children_room_{{ $room->id }}"
                                                            name="children[{{ $room->id }}]">
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
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div class="price-tag">
                                                    @if ($room->special_price)
                                                        <span
                                                            class="badge bg-danger text-white p-2 rounded-sm mb-2 text-uppercase">SPECIAL
                                                            OFFER</span>
                                                        ${{ number_format($room->special_price, 0) }}<small>/night</small>
                                                    @else
                                                        ${{ number_format($room->price, 0) }}<small>/night</small>
                                                    @endif
                                                </div>

                                                <button class="btn btn-book " data-room-id="{{ $room->id }}"
                                                    data-price={{ $room->price }}
                                                    data-room-name="{{ $room->roomType->type_name }}"
                                                    data-max-person="{{ $room->max_person }}">
                                                    Select Room
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif --}}
                        @include('frontend.rooms.room_list', ['rooms' => $rooms])
                    </div>
                </div>
            </div>
            <div class="selected-rooms-summary d-none" id="selectedRoomsSummary">
                <h3 class="mb-4" style="font-family: 'Oswald', sans-serif;">Selected Rooms Summary</h3>
                <div id="selectedRoomsList" style="font-family: 'Oswald', sans-serif;">

                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    {{-- <h4 class="mb-0">Total Price:</h4>
                    <div class="total-price" id="totalPrice">$0</div> --}}
                </div>
                <button class="btn proceed-booking" id="proceedToBooking">
                    Proceed to Booking
                </button>
            </div>
        </div>
    </div>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterForm = document.getElementById("filter-form");

            filterForm.addEventListener("submit", function() {
                // Save the current scroll position in localStorage
                localStorage.setItem("scrollPosition", window.scrollY);
            });

            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                localStorage.removeItem("scrollPosition"); // Clear the saved position
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const proceedButton = document.getElementById("proceedToBooking");
            const roomButtons = document.querySelectorAll('.btn-book'); // Use the correct class here
            const maxRooms = 4;

            let selectedRooms = [];
            let totalPrice = 0;

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

            roomButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const roomId = button.dataset.roomId;
                    const maxPerson = parseInt(button.dataset.maxPerson,
                        10); // Get max_person from dataset
                    const price = parseFloat(button.dataset.price); // Get price from dataset
                    const roomCard = button.closest(
                        '.room-card'); // Get the parent room-card element

                    // Toggle room selection
                    if (selectedRooms.includes(roomId)) {
                        selectedRooms = selectedRooms.filter(id => id !== roomId);
                        button.classList.remove('selected'); // Remove selected class
                        roomCard.classList.remove('selected'); // Remove border on the room card
                        button.innerText = "Select Room"; // Reset text to "Select Room"
                        totalPrice -= price; // Subtract price from total
                    } else {
                        if (selectedRooms.length >= maxRooms) {
                            showErrorModal(`You can select up to ${maxRooms} rooms only.`);
                            return;
                        }
                        selectedRooms.push(roomId);
                        button.classList.add('selected'); // Add selected class to button
                        roomCard.classList.add('selected'); // Add border to room card
                        button.innerText = "Remove Room"; // Change text to indicate selection
                        totalPrice += price; // Add price to total
                    }
                    updateSelectedRoomsSummary();
                });
            });


            function updateSelectedRoomsSummary() {
                const selectedRoomsSummary = document.getElementById("selectedRoomsSummary");
                const selectedRoomsList = document.getElementById("selectedRoomsList");
                // const totalPriceElement = document.getElementById("totalPrice");

                selectedRoomsList.innerHTML = ''; // Clear previous list
                selectedRooms.forEach((roomId) => {
                    const roomButton = document.querySelector(`button[data-room-id="${roomId}"]`);
                    const roomName = roomButton.dataset.roomName; // Retrieve room name from dataset
                    const roomPrice = parseFloat(roomButton.dataset
                        .price); // Retrieve room price from dataset

                    const adultsCount = parseInt(document.getElementById(`adults_room_${roomId}`).value ||
                        "1", 10);
                    const childrenCount = parseInt(document.getElementById(`children_room_${roomId}`)
                        .value || "0", 10);

                    // Create room summary element
                    const roomSummary = document.createElement("div");
                    roomSummary.classList.add("room-summary");

                    // Create the room summary content
                    const roomContent = document.createElement("div");
                    roomContent.classList.add("room-content");
                    roomContent.innerHTML = `
                    <div class="selected-room-item">
                        <div class="d-flex justify-content-between">
                            <h5>${roomName}</h5>
                            <span class="price-tag">$${roomPrice.toFixed(2)}</span>
                        </div>
                        <div class="text-muted mt-1">${adultsCount} Adults, ${childrenCount} Children</div>
                    </div>
                    
        `;
                    roomSummary.appendChild(roomContent);
                    selectedRoomsList.appendChild(roomSummary);
                    // Update total price
                    totalPrice += roomPrice;

                });

                // totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;

                // Show or hide the selected rooms summary based on whether any rooms are selected
                if (selectedRooms.length > 0) {
                    selectedRoomsSummary.classList.remove('d-none');
                } else {
                    selectedRoomsSummary.classList.add('d-none');
                }
            }
            proceedButton.addEventListener("click", function(event) {
                event.preventDefault();
                let adults = {};
                let children = {};
                let validationErrors = false;
                selectedRooms.forEach((roomId) => {
                    const roomButton = document.querySelector(`button[data-room-id="${roomId}"]`);
                    const maxPerson = parseInt(roomButton.dataset.maxPerson,
                        10); // Get max_person for this room
                    const roomTypeName = roomButton.dataset
                        .roomName; // Retrieve the room type name from the dataset

                    const adultCount = parseInt(document.getElementById(`adults_room_${roomId}`)
                        .value || "0", 10);
                    const childCount = parseInt(document.getElementById(`children_room_${roomId}`)
                        .value || "0", 10);
                    adults[roomId] = adultCount;
                    children[roomId] = childCount;

                    // Validate adults must be at least 1
                    if (adultCount < 1) {
                        showErrorModal(
                            `Please enter at least 1 adult for the ${roomTypeName} room.`);
                        validationErrors = true;
                        return;
                    } else if (adultCount + childCount > maxPerson) {
                        showErrorModal(
                            `The total number of guests for the ${roomTypeName} room exceeds the limit (${maxPerson}).`
                        );
                        validationErrors = true;
                        return;
                    }
                });

                if (validationErrors) return;

                if (selectedRooms.length === 0) {
                    showErrorModal("Please select at least one room.");
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
                    const checkIn = "{{ request('check_in') }}";
                    const checkOut = "{{ request('check_out') }}";
                    const bookingUrl =
                        `{{ route('books.create') }}?rooms=${selectedRooms.join(",")}&check_in=${checkIn}&check_out=${checkOut}&adults=${encodeURIComponent(JSON.stringify(adults))}&children=${encodeURIComponent(JSON.stringify(children))}`;

                    // Log the booking URL for debugging
                    console.log("Booking URL:", bookingUrl);

                    // Redirect to booking page
                    window.location.href = bookingUrl;
                }
            });

        });

        // $(document).ready(function() {
        //     // Initialize the price range slider
        //     $("#price-range-slider").slider({
        //         range: true,
        //         min: 50,
        //         max: 5000,
        //         values: [$('#price_min_input').val(), $('#price_max_input').val()],
        //         slide: function(event, ui) {
        //             console.log("Slider moved:", ui.values); // Debugging
        //             $("#price-min").text(ui.values[0]);
        //             $("#price-max").text(ui.values[1]);
        //             $("#price_min_input").val(ui.values[0]);
        //             $("#price_max_input").val(ui.values[1]);
        //             updateRoomList(); // Trigger AJAX request
        //         }
        //     });

        //     // Update price range text on page load (to reflect default values)
        //     $("#price-min").text($('#price_min_input').val());
        //     $("#price-max").text($('#price_max_input').val());
        // });

        // function updateRoomList() {
        //     console.log("Updating room list..."); // Debugging
        //     const priceFormData = $("#price-filter-form").serialize(); // Price range data
        //     const mainFormData = $("#filter-form").serialize(); // Other filter data

        //     $.ajax({
        //         url: "{{ route('filterRooms') }}",
        //         type: "GET",
        //         data: priceFormData + "&" + mainFormData, // Combine both sets of data
        //         success: function(response) {
        //             console.log("AJAX Response:", response); // Debugging
        //             $("#roomListings").html(response);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("AJAX Error: " + status + ": " + error); // Log AJAX errors
        //         }
        //     });
        // }
        $(document).ready(function() {
            // Initialize price range slider using noUiSlider
            const priceSlider = document.getElementById('price-range-slider');
            noUiSlider.create(priceSlider, {
                start: [parseInt($('#price_min_input').val()), parseInt($('#price_max_input').val())],
                connect: true,
                range: {
                    min: 50,
                    max: 5000
                },
                step: 50,
                tooltips: [true, true],
                format: {
                    to: function(value) {
                        return Math.round(value);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            });

            // Update input fields and labels when slider changes
            priceSlider.noUiSlider.on('update', function(values) {
                $('#price_min_input').val(values[0]);
                $('#price_max_input').val(values[1]);
                $('#price-min').text(values[0]);
                $('#price-max').text(values[1]);
            });

            // Submit the filter form when slider is released
            priceSlider.noUiSlider.on('change', function() {
                $('#filter-form').submit(); // Trigger form submission
            });

            // AJAX form submission for filtering rooms
            $('#filter-form').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                const priceFormData = $("#price-filter-form").serialize(); // Price range data
                const mainFormData = $("#filter-form").serialize(); // Other filter data

                $.ajax({
                    url: "{{ route('filterRooms') }}",
                    type: "GET",
                    data: priceFormData + "&" + mainFormData, // Combine both sets of data
                    success: function(response) {
                        console.log("AJAX Response:", response); // Debugging
                        $("#roomListings").html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + ": " +
                            error); // Log AJAX errors
                    }
                });
            });
        });
        //Price range

        // $(document).ready(function() {
        //     $(".btn-book").on("click", function(e) {
        //         e.preventDefault(); // Prevent default button action

        //         const checkInDate = $("#checkIn").val(); // Get check-in date value
        //         const checkOutDate = $("#checkOut").val(); // Get check-out date value

        //         if (!checkInDate || !checkOutDate) {
        //             alert("Please select check-in and check-out dates before selecting a room.");
        //             $("html, body").animate({
        //                 scrollTop: $("#filter-form").offset().top
        //             }, 800); // Scroll to the filter form
        //             return;
        //         }

        //         // Proceed with room selection
        //         const roomId = $(this).data("room-id");
        //         const price = $(this).data("price");
        //         const roomName = $(this).data("room-name");

        //         console.log("Room Selected:", {
        //             roomId,
        //             price,
        //             roomName
        //         });
        //     });
        // });

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".btn-book").forEach(function (button) {
                button.addEventListener("click", function (event) {
                    // Get check-in and check-out values
                    let checkIn = document.querySelector("input[name='check_in']").value;
                    let checkOut = document.querySelector("input[name='check_out']").value;

                    // Check if both fields are filled
                    if (!checkIn || !checkOut) {
                        event.preventDefault(); // Prevent default action
                        
                        // Show alert or redirect
                        alert("Please select check-in and check-out dates before booking a room.");
                        
                        // Redirect to the filter form section
                        document.getElementById("filter-form").scrollIntoView({ behavior: "smooth" });
                        return;
                    }

                    // If dates are selected, proceed with room booking logic
                    let roomId = this.getAttribute("data-room-id");
                    let roomName = this.getAttribute("data-room-name");
                    let roomPrice = this.getAttribute("data-price");

                    console.log("Room selected:", roomId, roomName, roomPrice);
                    
                    // Here you can proceed with booking logic or redirection
                });
            });
        });

    </script>
@endsection

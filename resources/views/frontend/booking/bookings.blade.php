@extends('layout.master')
@section('style')
    <style>
        body {
            background-color: #eff3f8;
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        label {
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        input[type="date"] {
            cursor: pointer;
        }

        body {
            background-color: #f8f9fa;
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

        .billing-section {
            background: white;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, .5);
            /* border-radius: 8px; */
            padding: 20px;
            padding-bottom: 25px;

        }

        .billing-section h5 {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .booking-summary {
            background: white;
            /* padding: 20px; */
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        }

        .booking-summary h5 {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 18px;
        }

        .booking-summary img {
            width: 100%;
            height: auto;
        }

        .booking-summary p {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            margin-top: -10px;
        }

        .booking-summary h6 {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 18px;
        }

        .booking-summary .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #555;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .form-control {
            font-size: 14px;
            padding: 20px;

        }

        input.form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }

        .price-summary {
            font-weight: bold;
            margin-top: 20px;
        }

        input[type="email"] {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
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

        .close {
            outline: none !important;
            border: none;
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

        /* Card hover effect */
        .room-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Image styling */
        .room-image {
            height: 300px;
            /* Adjust image height as needed */
            object-fit: cover;
            width: 100%;
            border-radius: 10px 10px 0 0;
            /* Rounded corners on top */
        }

        /* Special Price */
        .special-price {
            font-size: 0.9rem;
            font-weight: 600;
            color: #28a745;
        }

        /* Price styling */
        .original-price {
            text-decoration: line-through;
            color: #6c757d;
        }

        /* Guest Badge styling */
        .badge {
            font-size: 0.9rem;
        }

        /* Card Title */
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        /* Card text and price */
        .text-muted {
            font-size: 0.9rem;
        }

        /* Star Rating */
        .bi-star,
        .bi-star-fill {
            font-size: 1.1rem;
        }

        select.form-select {
            display: block;
            width: 100%;
            padding: 10px;

            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            outline: none !important;
        }

        .modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }


        .room-list-container {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 1rem;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 1rem;
            /* background: #f8f9fa; */
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #e9ecef;
            border: none;
        }

        .custom-close-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            outline: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .custom-close-btn:hover {
            background-color: white;
            color: #f44336;
            border: 2px solid #f44336;
        }

        .custom-close-btn:active {
            background-color: #d32f2f;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            transform: translateY(2px);
            outline: none;
        }

        main {
            max-width: 720px;
            margin: 5% auto;
        }

        .card {
            box-shadow: 0 6px 6px rgba(0, 0, 0, 0.3);
            transition: 200ms;
            background: #fff;
        }

    /* Room Cards Layout */
.room-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Individual Card Styling */
.room-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    max-width: 400px;
    margin: auto;  /* Center when there's only one card */
}

.room-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

/* Room Image */
.room-image img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 15px 15px 0 0;
}

/* Room Content */
.room-content {
    padding: 20px;
    
}

.room-title {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 10px;
    color: #333;
}

.room-location {
    font-size: 14px;
    color: #777;
    margin-bottom: 15px;
}

/* Price Styling */
.room-price {
    font-size: 18px;
    font-weight: bold;
    color: #27ae60;
    margin-bottom: 10px;
}

.special-price {
    font-size: 20px;
    font-weight: bold;
    color: #e74c3c;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    margin-left: 10px;
}

/* Rating Styling */
.room-rating {
    margin: 10px 0;
    font-size: 18px;
    color: #f39c12;
}

.filled-star {
    color: #f39c12;
}

.empty-star {
    color: #ddd;
}

/* Guest Details */
.room-guests,
.room-adults,
.room-children {
    font-size: 14px;
    color: #555;
    margin: 5px 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .room-container {
        grid-template-columns: 1fr;
    }
}


    </style>
@endsection
@section('content')
    <section id="gallery" class="booking_wrapper" style="margin-top: 60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid">
                    <div class="stepper-wrapper">
                        <div class="stepper-item completed">
                            <div class="step-counter">1</div>
                            <div class="step-name mt-2">Search</div>
                            <div class="step-description">Choose your favorite room</div>
                        </div>
                        <div class="stepper-item active">
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
                </div>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="billing-section p-5">
                                <h5 class="mb-4">Billing Details</h5>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">First name</label>
                                        <input type="text" class="form-control shadow-none"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->first_name : old('first_name') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            style="border-radius: 0;" name="first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Last name</label>
                                        <input type="text" class="form-control shadow-none rounded-0"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->last_name : old('last_name') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            name="last_name" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Phone</label>
                                        <input type="text" class="form-control shadow-none rounded-0" name="mobile"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->mobile : old('mobile') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            placeholder="Phone number" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Email</label>
                                        <input type="email" class="form-control shadow-none" style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->email : old('email') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            name="email" placeholder="Email" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Address</label>
                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->address : old('address') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            name="address" placeholder="Address" required>
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->city : old('city') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            placeholder="City" name="city" required>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Country</label>
                                        <input type="text" class="form-control shadow-none" name="country"
                                            style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->country : old('country') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            placeholder="Country">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="">Zip</label>
                                        <input type="text" class="form-control shadow-none" name="zip"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->zip : old('zip') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            style="border-radius: 0;" placeholder="Zip">
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}"> --}}
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
    
                            {{-- <div class="room-container">
                                @foreach ($rooms as $roomDetail)
                                <div class="room-card">
                                    
                                        <img src="{{ asset('storage/' . $roomDetail['room']->images->first()->image) }}" 
                                             alt="{{ $roomDetail['room']->roomType->type_name }} image" style="height: 250px;" loading="lazy">
                                    <div class="room-content">
                                        <h2 class="room-title">{{ $roomDetail['room']->roomType->type_name }}</h2>
                                        <p class="room-location">📍 Siem Reap</p>
                                        
                                        @if ($roomDetail['room']->special_price)
                                            <p class="room-price">
                                                <span class="special-price">${{ number_format($roomDetail['room']->special_price, 0) }}</span>
                                                <span class="original-price">${{ number_format($roomDetail['room']->price, 0) }}</span>
                                            </p>
                                        @else
                                            <span class="price">${{ number_format($roomDetail['room']->price, 0) }}</span>
                                            @endif
                                        
                                        <p class="room-guests">Max Guests: {{ $roomDetail['room']->max_person }} Persons</p>
                                        <p class="room-adults">Adults: {{ $roomDetail['adults'] }}</p>
                                        <p class="room-children">Children: {{ $roomDetail['children'] }}</p>
                                        <p><strong>Check In/Out: </strong>{{ date('d-m-Y', strtotime($checkIn)) }} <i class="fa fa-arrow"></i> {{ date('d-m-Y', strtotime($checkOut)) }}</p>
                                       
                                    </div>
                                </div>
                                @endforeach
                                <div class="booking-summary p-4">
                                 
                                    <h4>Total Price: ${{ number_format($totalPrice, 2) }}</h4>
                                    <h5>Total Guests:
                                        @php
                                            $totalGuests = 0;
                                            foreach ($rooms as $roomDetail) {
                                                $totalGuests += $roomDetail['adults'] + $roomDetail['children'];
                                            }
                                        @endphp
                                        {{ $totalGuests }}
                                    </h5>
                                </div>
                            </div> --}}

                            {{-- <div class="room-container">
                                <form action="{{ route('proceedToCheckout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="check_in" value="{{ $checkIn }}">
                                    <input type="hidden" name="check_out" value="{{ $checkOut }}">
                                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                    <input type="hidden" name="guest_id" value="{{ auth()->guard('guest')->user()->id }}">
                                    
                                    
                                    <div class="rooms">
                                        @foreach ($rooms as $roomDetail)
                                        <div class="room-card">
                                            <img src="{{ asset('storage/' . $roomDetail['room']->images->first()->image) }}" 
                                                 alt="{{ $roomDetail['room']->roomType->type_name }} image" style="height: 250px;" loading="lazy">
                                            <div class="room-content">
                                                <h2 class="room-title">{{ $roomDetail['room']->roomType->type_name }}</h2>
                                                <p class="room-location">📍 Siem Reap</p>
                                                
                                                @if ($roomDetail['room']->special_price)
                                                    <p class="room-price">
                                                        <span class="special-price">${{ number_format($roomDetail['room']->special_price, 0) }}</span>
                                                        <span class="original-price">${{ number_format($roomDetail['room']->price, 0) }}</span>
                                                    </p>
                                                @else
                                                    <span class="price">${{ number_format($roomDetail['room']->price, 0) }}</span>
                                                @endif
                            
                                                <p class="room-guests">Max Guests: {{ $roomDetail['room']->max_person }} Persons</p>
                                                <p class="room-adults">Adults: {{ $roomDetail['adults'] }}</p>
                                                <p class="room-children">Children: {{ $roomDetail['children'] }}</p>
                                                <p><strong>Check In/Out: </strong>{{ date('d-m-Y', strtotime($checkIn)) }} <i class="fa fa-arrow"></i> {{ date('d-m-Y', strtotime($checkOut)) }}</p>
                            
                                                <!-- Hidden inputs for room details -->
                                                <input type="hidden" name="rooms[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['room']->id }}">
                                                <input type="hidden" name="adults[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['adults'] }}">
                                                <input type="hidden" name="children[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['children'] }}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                            
                                    <!-- Booking Summary -->
                                    <div class="booking-summary p-4">
                                        <h4>Total Price: ${{ number_format($totalPrice, 2) }}</h4>
                                        <h5>Total Guests:
                                            @php
                                                $totalGuests = 0;
                                                foreach ($rooms as $roomDetail) {
                                                    $totalGuests += $roomDetail['adults'] + $roomDetail['children'];
                                                }
                                            @endphp
                                            {{ $totalGuests }}
                                        </h5>
                                    </div>
                            
                                    <!-- Proceed to Checkout Button -->
                                    <button type="submit" class="btn btn-primary mt-4">Proceed to Payment</button>
                                </form>
                            </div>                             --}}
                            <div class="room-container">
                                <form action="{{ route('proceedToCheckout') }}" method="POST">
                                    @csrf
                                    <!-- Hidden fields for check-in, check-out, total price, and guest -->
                                    <input type="hidden" name="check_in" value="{{ $checkIn }}">
                                    <input type="hidden" name="check_out" value="{{ $checkOut }}">
                                    <input type="hidden" name="guest_id" value="{{ auth()->guard('guest')->user()->id }}">
                                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                    <!-- Loop through available rooms -->
                                    <div class="rooms">
                                        @foreach ($rooms as $roomDetail)
                                            <div class="room-card">
                                                <img src="{{ asset('storage/' . $roomDetail['room']->images->first()->image) }}" alt="{{ $roomDetail['room']->roomType->type_name }} image" style="height: 250px;" loading="lazy">
                                                <div class="room-content">
                                                    <h2 class="room-title">{{ $roomDetail['room']->roomType->type_name }}</h2>
                                                    <p class="room-location">📍 Siem Reap</p>
                    
                                                    <!-- Display price (with special price if applicable) -->
                                                    @if ($roomDetail['room']->special_price)
                                                        <p class="room-price">
                                                            <span class="special-price">${{ number_format($roomDetail['room']->special_price, 0) }}</span>
                                                            <span class="original-price">${{ number_format($roomDetail['room']->price, 0) }}</span>
                                                        </p>
                                                    @else
                                                        <span class="price">${{ number_format($roomDetail['room']->price, 0) }}</span>
                                                    @endif
                            
                                                    <p class="room-guests">Max Guests: {{ $roomDetail['room']->max_person }} Persons</p>
                                                    <p class="room-adults">Adults: {{ $roomDetail['adults'] }}</p>
                                                    <p class="room-children">Children: {{ $roomDetail['children'] }}</p>
                                                    <p><strong>Check In/Out: </strong>{{ date('d-m-Y', strtotime($checkIn)) }} <i class="fa fa-arrow"></i> {{ date('d-m-Y', strtotime($checkOut)) }}</p>
                        
                                                    <!-- Hidden inputs for room details (passed to checkout) -->
                                                    <input type="hidden" name="rooms[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['room']->id }}">
                                                    <input type="hidden" name="adults[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['adults'] }}">
                                                    <input type="hidden" name="children[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['children'] }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Proceed to Payment</button>
                                </form>
                                <div class="booking-summary p-4">
                                    <h4>Total Price: ${{ number_format($totalPrice, 2) }}</h4>
                                    <h5>Total Guests:
                                        @php
                                            $totalGuests = 0;
                                            foreach ($rooms as $roomDetail) {
                                                $totalGuests += $roomDetail['adults'] + $roomDetail['children'];
                                            }
                                        @endphp
                                        {{ $totalGuests }}
                                    </h5>
                                </div>
                            </div>                            
                        </div>
                        {{-- <a href="{{ route('checkout.index', [
                                        'room_id' => $room->id,
                                        'check_in' => $checkIn->format('Y-m-d'),
                                        'check_out' => $checkOut->format('Y-m-d'),
                                        'adults' => $adults,
                                        'children' => $children,
                                        'first_name' => optional($guest)->first_name,
                                        'last_name' => optional($guest)->last_name,
                                        'email' => optional($guest)->email,
                                        'mobile' => optional($guest)->mobile,
                                    ]) }}"
                                        class="btn btn-warning w-100 rounded-0 text-white">
                                        Proceed to Checkout
                                    </a> --}}
                                    {{-- @foreach ($rooms as $roomDetail)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card__body">
                                                <div class="half">
                                                        <img src="{{ asset('storage/' . $roomDetail['room']->images->first()->image) }}"
                                                        alt="{{ $roomDetail['room']->roomType->type_name }} image"
                                                        class="" style="height: 350px;" loading="lazy">
                                                </div>
                                                <div class="half mt-4 px-3">
                                                    <div class="description">
                                                        <h3>{{ $roomDetail['room']->roomType->type_name }}</h3>
                                                        <p>Facilities</p>
                                                        Tv,
                                                        Wifi,
                                                        Air Condition,
                                                        Room Service,
                                                        Swimming Pool
                                                    </div>
                                                    <p>Check In : 01-25-2025</p>
                                                    <p style="margin-top: -15px;">Check Out : 01-25-2025</p>
                                                    <p><strong>Days : </strong> 2 Nights</p>
                                                    <div class="descriptions mt-1">
                                                        <p>2 Adults , 3 Children</p>
                                                        <p>Total Guest : 5 peoples</p>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="card__footer">
                                               
                                                <div class="recommend">
                                                    <p>Room Price : $ 200</p>
                                                   
                                                    <h3 class="mt-2">Total Price : $ 400</h3>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @endforeach --}}
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

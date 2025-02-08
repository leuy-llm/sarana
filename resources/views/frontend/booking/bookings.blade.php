@extends('layout.master')

@section('style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');

        body {
            font-family: 'Oswald', sans-serif;
        }

        .booking-header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://camo.githubusercontent.com/567a36423f96409baec854bb60d3f90a87f10407ac2fbc38124338d23b62b195/68747470733a2f2f677261616d6f646468616172616b656e6472612e696e2f6173736574732f696d672f70616765732f34335f74385f30373031323030313531353735312e6a7067');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }

        .booking-header h1 {
            color: white;
            font-weight: 700;
            font-family: 'Sail', system-ui;
            font-size: 75px;


        }

        .room-card:hover {
            transform: translateY(-5px);
        }

        .form-section {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }

        .form-section h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 26px;
            font-weight: 600;
            margin: 0 0 24px;
        }

        .booking-summary {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .booking-summary h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 26px;
            font-weight: 600;
            margin: 0 0 24px;
        }

        .booking-info {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .booking-info h3 {
            font-family: 'Oswald', sans-serif;
            font-size: 26px;
            margin: 0 0 24px;
            font-weight: 600;
        }

        .booking-info-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .booking-info-item span {
            font-family: 'Oswald', sans-serif;
        }

        .booking-info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            font-weight: 500;
            color: #333;
        }

        .room-card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 1.5rem;
        }

        .room-card:hover {
            transform: translateY(-5px);
        }

        .form-section {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
        }

        .booking-summary {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .room-info {
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .room-info h5 {
            font-family: 'Oswald', sans-serif;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .room-info p {
            font-family: 'Oswald', sans-serif;
            font-size: 14.4px;
            margin: 0 0 4px;
            margin-top: -5px;
        }

        .room-info span {
            font-family: 'Oswald', sans-serif;
        }
        .room-info span.room-price{
          margin-top: -5px;
        }

        .room-info:last-of-type {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 1.5rem;
        }

        .room-details {
            font-size: 0.9rem;
            color: #666;
        }

        .booking-container {
            padding: 50px;
            position: relative;
        }

        .room-price {
            color: #28a745;
            font-weight: 500;
        }

        .total-section {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }

        .total-section span {
            font-family: 'Oswald', sans-serif;
        }

        .small-room-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://camo.githubusercontent.com/567a36423f96409baec854bb60d3f90a87f10407ac2fbc38124338d23b62b195/68747470733a2f2f677261616d6f646468616172616b656e6472612e696e2f6173736574732f696d672f70616765732f34335f74385f30373031323030313531353735312e6a7067');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }
        input[type="email"]{
          font-family: 'Oswald', sans-serif;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="booking-header text-center">
    <h1>Complete Your Booking</h1>
    <p class="lead">Just a few steps away from your perfect stay</p>
  </div> --}}
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4" data-aos="zoom-in" data-aos-duration="2000"
                style="color: white;font-weight: 700;font-family: 'Sail', system-ui;font-size: 70px;">
                Complete Your Booking
            </h1>
            <p class="lead" style="color: #fff;font-family: 'Sail', system-ui;font-size: 25px;">
                Just a few steps away from your perfect stay
            </p>
        </div>
    </div>
    <div class="booking-container">
        <div class="container-fluid mb-5">
            <!-- Booking Information Display -->
            <div class="booking-info mb-4">
                <h3 class="mb-4">Booking Information</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="booking-info-item">
                            <span class="info-label">Check-in:</span>
                            <span class="info-value ms-2">{{$checkIn}}</span>
                        </div>
                        <div class="booking-info-item">
                            <span class="info-label">Check-out:</span>
                            <span class="info-value ms-2">{{$checkOut}}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="booking-info-item">
                            <span class="info-label">Nights:</span>
                            <span class="info-value ms-2">{{$nights}}</span>
                        </div>
                        <div class="booking-info-item">
                            <span class="info-label">Guests:</span>
                            @php
                                $totalAdults = $rooms->sum('adults');
                                $totalChildren = $rooms->sum('children');
                            @endphp

                              <span class="info-value ms-2">Guests: {{ $totalAdults }} Adults, {{ $totalChildren }} Children</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Billing Details Form -->
                <div class="col-lg-8">
                    <div class="form-section mb-4">
                        <h3 class="mb-4">Billing Details</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control shadow-none" name="first_name" id="firstName"
                                        value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->first_name : old('first_name') }}"
                                        {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control shadow-none" name="last_name"
                                        value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->last_name : old('last_name') }}"
                                        {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                        id="lastName">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label ">Email</label>
                                <input type="email" class="form-control shadow-none" id="email" name="email"
                                    value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->email : old('email') }}"
                                    {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}>
                            </div>

                            <div class="mb-3">
                                <label for="mobile" class="form-label">Phone</label>
                                <input type="text" class="form-control shadow-none" name="mobile"
                                    value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->mobile : old('mobile') }}"
                                    {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                    id="mobile" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control shadow-none" id="address" name="address"
                                    value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->address : old('address') }}"
                                    {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control shadow-none" name="city" id="city"
                                        value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->city : old('city') }}"
                                        {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="zip" class="form-label">ZIP Code</label>
                                    <input type="text" class="form-control" id="zip" name="zip"
                                        value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->zip : old('zip') }}"
                                        {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}>
                                </div>
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Country</label>
                                  <input type="text" class="form-control" id="country" name="country"
                                  value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->country : old('country') }}"
                                          {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}>
                              </div>
                        </form>
                    </div>
                </div>

                <!-- Booking Summary -->
                <div class="col-lg-4">
                    <div class="booking-summary">
                        <h3 class="mb-4">Your Booking</h3>
                        <!-- Room 1 -->
                        <form action="{{ route('proceedToCheckout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="check_in" value="{{ $checkIn }}">
                            <input type="hidden" name="check_out" value="{{ $checkOut }}">
                            <input type="hidden" name="guest_id" value="{{ auth()->guard('guest')->user()->id }}">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                            @foreach ($rooms as $roomDetail)
                            <div class="room-info">
                                <div class="d-flex gap-3 mb-3">
                                    
                                        <img src="{{ asset('storage/' . $roomDetail['room']->images->first()->image) }}" alt="{{ $roomDetail['room']->roomType->type_name }} image" class="small-room-img" loading="lazy">
                                    <div>
                                        <h5 class="mb-1 ml-3">{{$roomDetail['room']->roomType->type_name}}</h5>
                                        <p class="room-details mb-1 ml-3" s>{{ $roomDetail['room']->bed_type }} • {{ $roomDetail['room']->view_type }} • {{ $roomDetail['room']->room_size }}m²</p>
                                        <span class="room-price ml-3">${{ number_format($roomDetail['room']->price, 0) }}/night</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">{{$nights}} nights</span>
                                    <span>${{$roomDetail['room']->price * $nights}}</span>
                                </div>
                            </div>
                            <input type="hidden" name="rooms[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['room']->id }}">
                            <input type="hidden" name="adults[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['adults'] }}">
                            <input type="hidden" name="children[{{ $roomDetail['room']->id }}]" value="{{ $roomDetail['children'] }}">
                            @endforeach


                        <!-- Total Calculation -->
                        <div class="total-section">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>${{$totalPrice}}</span>
                            </div>
                            {{-- <div class="d-flex justify-content-between mb-2">
                <span>Taxes & Fees (10%)</span>
                <span>$100</span>
              </div> --}}
                            <div class="d-flex justify-content-between fw-bold mt-3">
                                <span>Total</span>
                                <span>${{$totalPrice}}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary shadow-none w-100 py-3">Confirm Booking</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

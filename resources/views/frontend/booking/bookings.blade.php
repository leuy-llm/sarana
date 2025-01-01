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

            .reservation-title {
                /* font-family: 'Georgia', serif; */
                color: #a38354;
                font-size: 2rem;
                /* margin-bottom: 0.2rem; */
            }

            .form-control:focus {
                border-color: #a38354;
                box-shadow: none;
            }

            .btn-booking {
                background-color: #7d2e1e;
                color: white;
                font-family: 'Hanuman', sans-serif;
            }

            .btn-booking:hover {
                background-color: #a83c2d;
                color: white
            }

            .hidden {
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.5s ease, visibility 0.5s ease;
            }

            .visible {
                opacity: 1;
                visibility: visible;
                transition: opacity 0.5s ease, visibility 0.5s ease;
            }

            .modal-content {
                -webkit-border-radius: 0;
                -webkit-background-clip: padding-box;
                -moz-border-radius: 0;
                -moz-background-clip: padding;
                border-radius: 6px;
                background-clip: padding-box;
                -webkit-box-shadow: 0 0 40px rgba(0, 0, 0, .5);
                -moz-box-shadow: 0 0 40px rgba(0, 0, 0, .5);
                box-shadow: 0 0 40px rgba(0, 0, 0, .5);
                color: #000;
                /* background-color: #fff; */
                border: rgba(0, 0, 0, 0);
            }

            .modal-message .modal-dialog {
                width: 400px;
            }

            .modal-message .modal-body,
            .modal-message .modal-footer,
            .modal-message .modal-header,
            .modal-message .modal-title {
                background: 0 0;
                border: none;
                margin: 0;
                padding: 0 20px;
                text-align: center !important;
                font-family: 'Coda', system-ui;
            }

            .modal-message .modal-title {
                font-size: 17px;
                color: #737373;
                margin-bottom: 3px;
            }

            .modal-message .modal-body {
                color: #737373;
            }

            .modal-message .modal-header {
                color: #fff;
                margin-bottom: 10px;
                padding: 15px 0 8px;
            }

            .modal-message .modal-header .fa,
            .modal-message .modal-header .glyphicon,
            .modal-message .modal-header .typcn,
            .modal-message .modal-header .wi {
                font-size: 30px;
            }

            .modal-message .modal-footer {
                margin: 25px 0 20px;
                padding-bottom: 10px;
            }

            .modal-backdrop.in {
                zoom: 1;
                filter: alpha(opacity=75);
                -webkit-opacity: .75;
                -moz-opacity: .75;
                opacity: .75;
            }

            .modal-backdrop {
                background-color: #fff;
            }

            .modal-message.modal-success .modal-header {
                color: #53a93f;
                border-bottom: 3px solid #a0d468;
            }

            .modal-message.modal-info .modal-header {
                color: #57b5e3;
                border-bottom: 3px solid #57b5e3;
            }

            .modal-message.modal-danger .modal-header {
                color: #d73d32;
                border-bottom: 3px solid #e46f61;
            }

            .modal-message.modal-warning .modal-header {
                color: #f4b400;
                border-bottom: 3px solid #ffce5 5;
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
        </style>
    @endsection
    @section('content')
        <section id="home" class="banner_wrapper p-0">
            <div class="overlay">
                @if (isset($banner) && $banner)
                    <img src="{{ asset('storage/' . $banner->banner_image) }}"
                        style="width: 100%; height: 90vh; object-fit: cover;" alt="Banner Image">
                @endif
                <div class="img-overlay">
                    <h2>{{ $data }}</h2>
                </div>
            </div>
        </section>
        <section id="gallery" class="gallery_wrapper" style="margin-top: 60px;">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-md-6">
                        <img src="{{ asset('storage/' . $rooms->images->first()->image) }}" class="img-fluid"
                            style="height: 500px; object-fit: cover; border-radius: 3px;"
                            alt="{{ $rooms->roomType->type_name }}">
                        <h4
                            style="font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:600;font-size: 25px;">
                            {{ $rooms->roomType->type_name }}</h4>
                        <h4
                            style="font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:400; margin-top: -10px;">
                            $ {{ number_format($rooms->price, 0) }}</h4>
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <h3 class="reservation-title text-center">Make Your Reservation</h3> --}}

                    {{-- <form id="reservation-form" action="{{ route('books.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Full Name"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->name : old('name') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="number" min="0" name="mobile" class="form-control" placeholder="Phone"
                                        value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->mobile : old('name') }}"
                                        {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->email : old('name') }}"
                                        {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: -14px">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->address : old('name') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="checkIn">Check In</label>
                                    <input type="date" name="check_in_date" class="form-control checkin_date" id="checkIn"
                                        value="{{ $checkIn ?? old('check_in_date') }}" {{ $checkIn ? 'readonly' : '' }}>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="checkOut">Check Out</label>
                                    <input type="date" name="check_out_date" class="form-control" id="checkOut"
                                        value="{{ $checkOut ?? old('check_out_date') }}" {{ $checkOut ? 'readonly' : '' }}
                                        min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}">

                            <div class="form-row" style="margin-top: -14px">
                                <div class="form-group col-md-6">
                                    <label for="adults">Children</label>
                                    <input type="number" min="0" name="total_children" class="form-control"
                                        id="checkOut" value="{{ $children ?? old('total_children') }}"
                                        {{ $children ? 'readonly' : '' }}>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adults">Adults</label>
                                    <input type="number" min="1" name="total_adults" class="form-control" id="checkOut"
                                        value="{{ $adults ?? old('total_adults') }}" {{ $adults ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <input type="hidden" id="room-price" value="{{ $rooms->price }}">
                            <div id="details-section" style="display: none;">
                                <div class="form-group" style="margin-top: -10px">
                                    <label>No. of Days: <span id="num-days">0</span></label>
                                </div>
                                <div class="form-group" style="margin-top: -10px">
                                    <input type="hidden" name="total_amount" id="hidden-total-amount" value="0">
                                    <label>Total Amount to Pay: <span id="total-amount">0</span>$</label>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex">
                            
                                <button id="payment-button" type="button" class="btn btn-booking btn-block">Proceed to Payment</button>
                            
                            </div>
                    </form> --}}
                    {{-- <form id="reservation-form" action="{{ route('books.store') }}" method="POST">
                        @csrf
                    
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->name : old('name') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="number" min="0" name="mobile" class="form-control" placeholder="Phone"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->mobile : old('mobile') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->email : old('email') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->address : old('address') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                        </div>
                    
                    
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="checkIn">Check In</label>
                                <input type="date" name="check_in_date" value="{{ $checkIn }}" class="form-control checkin_date"
                                    id="checkIn">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="checkOut">Check Out</label>
                                <input type="date" name="check_out_date" value="{{ $checkOut }}" class="form-control" id="checkOut"
                                    min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    
                    
                        <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}">
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="adults">Adults</label>
                                <input type="number" min="0" name="total_adults" class="form-control" id="adults"
                                    value="{{ $adults ?? old('total_adults') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="children">Children</label>
                                <input type="number" min="0" name="total_children" class="form-control" id="children"
                                    value="{{ $children ?? old('total_children') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="extra_beds">Extra Bed Capacity</label>
                                <input type="number" min="0" name="extra_bed_capacity" class="form-control" id="extra_beds"
                                    value="{{ old('extra_bed_capacity') }}" placeholder="Enter extra bed capacity">
                            </div>
                        </div>
                    
                    
                        <button type="submit" class="btn btn-booking btn-block">PROCEED TO CHECKOUT</button>
                    
                        <h3>Payment</h3>
                        <div>
                            <label>
                                <input type="radio" name="payment_option" value="pay_now" required> Pay Now
                            </label>
                            <label>
                                <input type="radio" name="payment_option" value="skip_payment" required> Skip Payment
                            </label>
                        </div> 
                    
                    
                    </form> --}}


                    <div class="container">
                        <!-- Progress Indicator -->
                        <div class="progress-container">
                            <div class="d-flex justify-content-between">
                                <div class="progress-step active">Search<br><small>Choose your favorite room</small></div>
                                <div class="progress-step active">Booking<br><small>Enter your booking details</small></div>
                                <div class="progress-step">Checkout<br><small>Use your preferred payment method</small>
                                </div>
                                <div class="progress-step">Confirmation<br><small>Receive a confirmation email</small></div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Left Section -->
                            <div class="col-md-8">
                                {{-- <div class="billing-section">
                                    <h5 class="mb-4">Billing Details</h5>
                                    <ul class="nav nav-tabs nav-pills bg-nav-pills text-center" style="border-radius: 0;" id="billingTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active rounded-0 px-5" id="guest-tab" style="border-radius: 0;border: none;outline: none;" data-bs-toggle="tab" data-bs-target="#guest" type="button" role="tab" aria-controls="guest" aria-selected="true">
                                                Guest Checkout
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link rounded-0 px-5" style="border-radius: 0;border: none;outline: none;" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab" aria-controls="create" aria-selected="false">
                                                Create Account
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link  rounded-0 px-4" style="border-radius: 0;border: none;outline: none;background: rgba(90, 148, 190, 0.507);" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="false">
                                                Existing Customer Login
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-4" id="billingTabsContent">
                                    
                                        <div class="tab-pane fade show active" id="guest" role="tabpanel" aria-labelledby="guest-tab">
                                            <form>
                                                <div class="row mb-3" >
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="First Name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="email" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Email" required>
                                                    </div>
                                                    <div class=" col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Phone number" required>
                                                    </div>
                                                
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Address" required>
                                                    </div>
                                                    <div class=" col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="City" required>
                                                    </div>
                                                
                                                </div>
                                            
                                                <div class="row mb-3">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Country">
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Zip">
                                                    </div>
                                                </div>
                                            
                                            </form>
                                        </div>
                
                                    
                                        <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="create-tab">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"  placeholder="First Name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-2 ">
                                                        <input type="text" class="form-control  shadow-none" style="border-radius: 0;"  placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="email" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Password" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Confirm Password" required>
                                                </div>
                                            </form>
                                        </div>
                
                                    
                                        <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                                            <form>
                                                <div class="row mb-3">
                                                    <div class="col-md-5">
                                                        <input type="email" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Email" required>
                                                    </div>
                                                    <div class="col-md-5">
                                                    
                                                            <input type="password" class="form-control shadow-none" style="border-radius: 0;"  placeholder="Password" required>
                                                    
                                                    </div>
                                                    <div class="col-md-2">
                                                    
                                                            <button class="btn btn-primary w-100 shadow-none rounded-0">Login</button>
                                                    </div>
                                                
                                                </div>
                                            
                                            
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="billing-section">
                                    <h5 class="mb-4">Billing Details</h5>
                                    <form id="reservation-form" action="{{ route('books.store') }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="adults">First name</label>
                                                <input type="text" class="form-control shadow-none"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->first_name : old('first_name') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}
                                                    style="border-radius: 0;" name="first_name" placeholder="First Name"
                                                    required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="adults">Last name</label>
                                                <input type="text" class="form-control shadow-none rounded-0"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->last_name : old('last_name') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }} name="last_name"
                                                    placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="adults">Phone</label>
                                                <input type="text" class="form-control shadow-none rounded-0"
                                                    name="mobile"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->mobile : old('mobile') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}
                                                    placeholder="Phone number" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="adults">Email</label>
                                                <input type="email" class="form-control shadow-none"
                                                    style="border-radius: 0;"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->email : old('email') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }} name="email"
                                                    placeholder="Last Name" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="adults">Address</label>
                                                <input type="text" class="form-control shadow-none"
                                                    style="border-radius: 0;"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->address : old('address') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }} name="address"
                                                    placeholder="Address" required>
                                            </div>
                                            <div class=" col-md-6 mb-3">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control shadow-none"
                                                    style="border-radius: 0;"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->city : old('city') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}
                                                    placeholder="City" name="city" required>
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="">Country</label>
                                                <input type="text" class="form-control shadow-none" name="country"
                                                    style="border-radius: 0;"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->country : old('country') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}
                                                    placeholder="Country">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="">Zip</label>
                                                <input type="text" class="form-control shadow-none" name="zip"
                                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->zip : old('zip') }}"
                                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}
                                                    style="border-radius: 0;" placeholder="Zip">
                                            </div>
                                        </div>
                                        <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}">
                                </div>
                            </div>
                            <!-- Right Section -->
                            <div class="col-md-4 mt-3">
                                <div class="booking-summary ">
                                    <img src="{{ asset('storage/' . $rooms->images->first()->image) }}" class="img-fluid"
                                        style="width:600px;object-fit: cover;border-top-left-radius:5px;border-top-right-radius: 5px;"
                                        alt="{{ $rooms->roomType->type_name }}">
                                    <div class="card-body">
                                        <h5>Booking Details</h5>

                                        <p><strong>Check-In: </strong> {{ date('d-m-Y', strtotime($checkIn)) }}</p>
                                        <p><strong>Check-Out: </strong> {{ date('d-m-Y', strtotime($checkOut)) }}</p>
                                        <p><strong>Nights:</strong> {{ $nights }}</p>
                                        <p><strong>Guests:</strong> {{ $adults }} Adults, {{ $children }}
                                            Children
                                        </p>

                                        <h6 class="mt-4 section-title">Price Summary</h6>
                                        <p><strong>{{ $rooms->roomType->type_name }}:</strong> $
                                            {{ number_format($room->price, 0) }}</p>

                                        <p class="price-summary"><strong>Total Price:</strong>
                                            ${{ number_format($totalPrice, 2) }}</p>

                                        
                                            <a href="{{ route('checkout.index', [
                                                'room_id' => $room->id,
                                                
                                                'check_in' => $checkIn->format('Y-m-d'),
                                                'check_out' => $checkOut->format('Y-m-d'),
                                                'adults' => $adults,
                                                'children' => $children,
                                                'first_name' => optional($guest)->first_name,
                                                'last_name' => optional($guest)->last_name,
                                                'email' => optional($guest)->email,
                                                'mobile' => optional($guest)->mobile
                                            ]) }}" 
                                            class="btn btn-warning w-100 rounded-0 text-white">
                                                Proceed to Checkout
                                            </a>
                                            {{-- <form action="{{ route('booking.proceedToPayment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                                <input type="hidden" name="check_in" value="{{ $checkIn->format('Y-m-d') }}">
                                                <input type="hidden" name="check_out" value="{{ $checkOut->format('Y-m-d') }}">
                                                <input type="hidden" name="adults" value="{{ $adults }}">
                                                <input type="hidden" name="children" value="{{ $children }}">
                                                <input type="hidden" name="first_name" value="{{ optional($guest)->first_name }}">
                                                <input type="hidden" name="last_name" value="{{ optional($guest)->last_name }}">
                                                <input type="hidden" name="email" value="{{ optional($guest)->email }}">
                                                <input type="hidden" name="mobile" value="{{ optional($guest)->mobile }}">
                                            
                                                <button type="submit" class="btn btn-warning w-100 rounded-0 text-white">
                                                    Proceed to Checkout
                                                </button>
                                            </form> --}}

                                        
                                            
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </section>
        <div id="modal-success" class="modal modal-message modal-success fade" role="dialog" data-bs-backdrop="static"
            style="display: none;z-index: 9999" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        {{-- <span class="glyphicon glyphicon-check"></span> --}}
                        <i class="fa fa-check text-white fa-3x m-auto"></i>
                    </div>
                    <div class="modal-title text-center">Please</div>
                    <div class="modal-body">Sign in to Booking</div>
                    <div class="modal-footer">
                        <button type="button" id="ok-btn" class="btn btn-success"
                            style="text-align: center;margin: 0 auto;" data-dismiss="modal">OK</button>
                    </div>
                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div>
        <!--End Success Modal Templates-->
        @include('auth.register')
    @endsection

    @section('script')
        <script>
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif
            var checkInDateInput = document.getElementById('checkIn');
            var checkOutDateInput = document.getElementById('checkOut');
            document.addEventListener('DOMContentLoaded', function() {

                checkInDateInput.addEventListener('change', function() {
                    var checkInDate = this.value; // Get the selected check-in date

                    checkOutDateInput.setAttribute('min', checkInDate);

                    // Clear check-out date if it is before the new check-in date
                    if (checkOutDateInput.value < checkInDate) {
                        checkOutDateInput.value = ''; // Clear the value if invalid
                    }
                });
            })


            document.addEventListener('DOMContentLoaded', function() {
                const checkInInput = document.querySelector('#checkIn');
                const checkOutInput = document.querySelector('#checkOut');
                const roomPrice = parseFloat(document.getElementById('room-price').value);
                const numDaysSpan = document.getElementById('num-days');
                const totalAmountSpan = document.getElementById('total-amount');
                const hiddenTotalAmountInput = document.getElementById('hidden-total-amount');
                const paymentButton = document.getElementById('payment-button');

                function calculateTotalAmount() {
                    const checkInDate = new Date(checkInInput.value);
                    const checkOutDate = new Date(checkOutInput.value);

                    if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
                        const timeDifference = checkOutDate - checkInDate;
                        const days = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
                        const totalAmount = days * roomPrice;

                        numDaysSpan.textContent = days;
                        totalAmountSpan.textContent = totalAmount.toFixed(2);
                        hiddenTotalAmountInput.value = totalAmount;
                        return totalAmount;
                    } else {
                        numDaysSpan.textContent = 0;
                        totalAmountSpan.textContent = 0;
                        hiddenTotalAmountInput.value = 0;
                        return 0;
                    }
                }

                checkInInput.addEventListener('change', calculateTotalAmount);
                checkOutInput.addEventListener('change', calculateTotalAmount);

                paymentButton.addEventListener('click', function() {
                    const totalAmount = calculateTotalAmount();

                    if (totalAmount > 0) {
                        const paymentUrl = `{{ url('stripe') }}/${totalAmount}`;
                        window.location.href = paymentUrl;
                    } else {
                        alert("Please ensure valid dates are selected.");
                    }
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                var reservationForm = document.getElementById('reservation-form');
                var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
                // Ensure reservation form exists before proceeding
                if (reservationForm) {
                    reservationForm.addEventListener('submit', function(event) {
                        // Prevent submission and show modal if guest is not logged in
                        if (!isLoggedIn) {
                            event.preventDefault();
                            $('#modal-success').modal('show');
                        } else {
                            // If logged in, check for empty check-in and check-out dates
                            if (!checkInDateInput.value || !checkOutDateInput.value) {
                                event.preventDefault(); // Prevent form submission
                                alert('Please select both check-in and check-out dates before booking.');
                            }
                        }
                    });
                }

                // Add event listener to the OK button to show the login modal if button exists
                var okButton = document.getElementById('ok-btn');
                if (okButton) {
                    okButton.addEventListener('click', function() {
                        $('#modal-success').modal('hide'); // Hide the success modal
                        $('#registerModal').modal('show'); // Show the login modal
                    });
                }
            });


            // Handle 'Proceed to Payment' click event
            // document.getElementById('payment-button').addEventListener('click', function(event) {
            // event.preventDefault(); // Prevents default navigation

            // if (!isLoggedIn) {
            // // If user is not logged in, show the login modal
            // $('#registerModal').modal('show');
            // } else {
            // // User is logged in, proceed with payment
            // const totalAmount = document.getElementById('total-amount').textContent;
            // const bookingId = document.getElementById('bookingId').value;
            // if (totalAmount > 0) {
            // // Redirect to the payment page with the total amount
            // const url = `{{ url('reservation/payment') }}/${bookingId}/${totalAmount}`;
            // window.location.href = url; // Proceed to payment page
            // } else {
            // // Show an alert if no valid dates or amount is selected
            // alert('Please select a valid check-in and check-out date.');
            // }
            // }
            // });
        </script>
    @endsection

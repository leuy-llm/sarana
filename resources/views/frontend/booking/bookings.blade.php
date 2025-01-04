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
            /* background: rgba(255, 255, 255, 0.9);
                                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
            border-radius: 3px;
            padding: 20px;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;

            @media (max-width: 768px) {
                font-size: 12px;
            }
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
            position: absolute;
            content: "";
            border-bottom: 2px solid #ffc107;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 3;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }

        </style>
    @endsection
    @section('content')
        {{-- <section id="home" class="banner_wrapper p-0">
            <div class="overlay">
                @if (isset($banner) && $banner)
                    <img src="{{ asset('storage/' . $banner->banner_image) }}"
                        style="width: 100%; height: 90vh; object-fit: cover;" alt="Banner Image">
                @endif
                <div class="img-overlay">
                    <h2>{{ $data }}</h2>
                </div>
            </div>
        </section> --}}
        <section id="gallery" class="gallery_wrapper" style="margin-top: 60px;">
            <div class="container-fluid">
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

                    <div class="container-fluid">
                        
                        {{-- <div class="progress-container">
                            <div class="d-flex justify-content-between">
                                <div class="progress-step active">Search<br><small>Choose your favorite room</small></div>
                                <div class="progress-step active">Booking<br><small>Enter your booking details</small></div>
                                <div class="progress-step">Checkout<br><small>Use your preferred payment method</small>
                                </div>
                                <div class="progress-step">Confirmation<br><small>Receive a confirmation email</small></div>
                            </div>
                        </div> --}}
                        <div class="stepper-wrapper">
                            <div class="stepper-item completed">
                                <div class="step-counter">1</div>
                                <div class="step-name" style="margin-top: 5px;">Search</div>
                                <div class="step-name" style="font-size: 12px;">Choose your favorite room</div>
            
                            </div>
                            <div class="stepper-item active">
                                <div class="step-counter">2</div>
                                <div class="step-name" style="margin-top: 5px;">Booking</div>
                                <div class="step-name" style="font-size: 12px;">Enter your booking details</div>
            
                            </div>
                            <div class="stepper-item ">
                                <div class="step-counter">3</div>
                                <div class="step-name" style="margin-top: 5px;">Checkout</div>
                                <div class="step-name" style="font-size: 12px;">Use your preferred payment method
                                    Confirmation
                                </div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">4</div>
                                <div class="step-name" style="margin-top: 5px;">Confirmation
                                </div>
                                <div class="step-name" style="font-size: 12px;">Choose your favorite room</div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-5">
                        <div class="row">
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
                                                   k {{ auth()->guard('guest')->check() ? 'readonly' : '' }} name="last_name"
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
                                            'mobile' => optional($guest)->mobile,
                                        ]) }}"
                                            class="btn btn-warning w-100 rounded-0 text-white">
                                            Proceed to Checkout
                                        </a>
                                    
                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <div class="modal fade" style="z-index: 9999" id="loginRegisterModal" tabindex="-1" aria-labelledby="loginAlertModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginRegisterModalLabel">Login or Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please sign in or sign up to proceed with your payment. You must be logged in to complete your booking.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        
    @endsection

    @section('script')
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};

            // Add an event listener to the "Proceed to Checkout" button
            document.querySelector('.btn-warning').addEventListener('click', function (event) {
                if (!isLoggedIn) {
                    event.preventDefault(); // Prevent the default action (navigation)
                    $('#loginRegisterModal').modal('show'); // Show the modal
                }
            });
        });

        </script>
    @endsection

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
    <section id="gallery" class="booking_wrapper" style="margin-top: 60px;">
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
                        <div class="col-md-8">
                            <div class="billing-section">
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
                                <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}">

                            </div>
                        </div>
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
                                    <p><strong>{{ $rooms->roomType->type_name }}:</strong>
                                        @if ($room->special_price)
                                            ${{ number_format($room->special_price, 0) }}
                                        @else
                                            ${{ number_format($room->price, 0) }}
                                    </p>
                                    @endif
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
                    <p></p> <!-- Content dynamically updated by the script -->
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: #d7b661">Close</button> --}}
                    <button type="button" class="btn text-white px-4 " data-bs-dismiss="modal"
                        style="background: #d7b661">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
            // Add an event listener to the "Proceed to Checkout" button
            document.querySelector('.btn-warning').addEventListener('click', function(event) {
                if (!isLoggedIn) {
                    event.preventDefault(); // Prevent the default action (navigation)
                    $('#loginRegisterModal').modal('show'); // Show the modal
                }
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
            var hasVerifiedEmail =
                {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'true' : 'false' }};

            // Add an event listener to the "Proceed to Checkout" button
            document.querySelector('.btn-warning').addEventListener('click', function(event) {
                if (!isLoggedIn || !hasVerifiedEmail) {
                    event.preventDefault(); // Prevent the default action (navigation)

                    // Update modal title and message
                    var modalTitle = document.querySelector('#loginRegisterModalLabel');
                    var modalBody = document.querySelector('#loginRegisterModal .modal-body p');

                    if (!isLoggedIn) {
                        modalTitle.textContent = "Login or Register";
                        modalBody.textContent =
                            "Please sign in or sign up to proceed with your payment. You must be logged in to complete your booking.";
                    } else if (!hasVerifiedEmail) {
                        modalTitle.textContent = "Verify Your Email";
                        modalBody.textContent =
                            "Please verify your email address to proceed with the payment.";
                    }

                    $('#loginRegisterModal').modal('show'); // Show the modal
                }
            });
        });
    </script>
@endsection

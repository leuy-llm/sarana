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

        .modal-fullscreen-custom {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);

            z-index: 9999;
            display: none;

            overflow: hidden;
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out forwards;
            justify-content: center;
            align-items: center;
        }

        /* Center and Style Modal Content */
        .modal-content {
            background-color: white;
            width: 90%;
            /* Adjust width */
            height: 90%;
            /* Fullscreen modal height */
            max-height: 90%;
            /* Ensures content is scrollable */
            margin: auto;
            border-radius: 8px;
            overflow-y: auto;
            /* padding: 20px; */
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-header {
            padding: 1.5rem;
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header span {
            font-size: 2rem;
            color: rgb(214, 15, 15);
            cursor: pointer;
        }

        .modal-title {
            margin: 0;
            font-size: 1.5rem;
        }

        .close {
            font-size: 1.5rem;
            cursor: pointer;
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
                                {{-- <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}"> --}}
                            </div>
                        </div>
                        {{-- <div class="col-md-4 mt-3">
                            <div class="booking-summary ">
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
                                </div>
                            </div>
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
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
   

    <script>
        
    </script>
@endsection

@extends('layout.master')

@section('style')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700,700i');
        @import url('https://fonts.googleapis.com/css?family=Bree+Serif');


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

        .booking-details {
            margin-top: 50px;
            margin-bottom: 30px;
        }

        .booking-details h4 {

            font-family: 'Source Sans Pro', sans-serif;
        }

        .booking-details p {
            font-family: 'Source Sans Pro', sans-serif;
            margin-top: 20px;
            margin-bottom: 0;
            padding: 0;
            /* font-size: 20px; */
            line-height: 1.5;
        }

        .booking-details h1 {
            margin: 0;
            font-family: 'Bree Serif', serif;
            /* font-size: 36px; */
        }

        .payment-options {
            margin-top: 30px;
        }

        .payment-options h4 {
            font-size: 25px;
            font-weight: bold;
            font-family: 'Source Sans Pro', sans-serif;
            margin-bottom: 30px;

        }

        body {
            background-color: #eff3f8;
            font-family: 'Source Sans Pro', sans-serif;
        }

        @media (min-width: 600px) {
            .panel {
                order: 99;
            }
        }

        .nav-tabs {
            border-bottom: none;
            /* Remove the bottom line from nav-tabs */

            margin-bottom: -1px;
            /* Align with tab-content border */
        }

        .nav-tabs .nav-link {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            margin-right: 5px;
            padding: 20px 30px;

            color: #555;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            background-color: #e9ecef;
        }

        .nav-tabs .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
            border: 1px solid #0d6efd;
            border-top: 2px solid red;
            outline: none;
        }

        .nav-item {
            margin-right: 10px;
            border-bottom: 0;

        }


        .tab-content {
            background-color: #fff;
            border: 1px solid #ddd;
            border-top: none;
            /* Prevent overlap with nav-tabs */
            padding: 20px;
            /* max-width: 600px; */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tab-pane {
            animation: fadeEffect 0.5s;
        }

        @keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            color: #fff;
        }

        /* Make nav-tabs and tab-content equal */
        .tabs-container {
            /* max-width: 550px; */
            margin: 0 auto;
            /* Center the container */
        }

        #card-errors {
            color: red;
            /* Set text color to red */
            font-size: 14px;
            margin-top: 10px;
        }

        .tab-content p {
            font-family: 'Source Sans Pro', sans-serif;
            margin-top: -8px;
        }
    </style>
@endsection
@section('content')
    <section id="gallery" class="gallery_wrapper" style="margin-top: 60px; margin-bottom: 60px;">
        <div class="container-fluid">
            <div class="stepper-wrapper">
                <div class="stepper-item completed">
                    <div class="step-counter">1</div>
                    <div class="step-name" style="margin-top: 5px;">Search</div>
                    <div class="step-name" style="font-size: 12px;">Choose your favorite room</div>

                </div>
                <div class="stepper-item completed">
                    <div class="step-counter">2</div>
                    <div class="step-name" style="margin-top: 5px;">Search</div>
                    <div class="step-name" style="font-size: 12px;">Choose your favorite room</div>

                </div>
                <div class="stepper-item active">
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
        <div class="container">
            <div class="booking-details">
                <h4>Booking Details</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <p><strong>Full Name: </strong>{{ $guestData['first_name'] }} {{ $guestData['last_name'] }}</p>
                        <p><strong>Room:</strong> {{ $rooms->roomType->type_name }}</p>

                    </div>
                    <div class="col-md-4">
                        <p><strong>Email:</strong> {{ $guestData['email'] }}</p>
                        {{-- <p><strong>Guests:</strong> 1 Adult, 0 Children</p> --}}

                        <p><strong>Guests:</strong> {{ $adults }} Adult, {{ $children }} Children</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Phone:</strong> {{ $guestData['mobile'] }}</p>
                        {{-- <p><strong>Guests:</strong> 1 Adult, 0 Children</p> --}}
                        <p><strong>Check In/Out:</strong>{{ date('d-m-Y H:i A', strtotime($checkIn)) }} →
                            {{ date('d-m-Y H:i A', strtotime($checkOut)) }}</p>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</p>
                    </div>
                    {{-- <p><strong>Deposit Amount:</strong> $172</p> --}}

                </div>

            </div>

            <div class="payment-options">
                <h4>Payment Options</h4>
                <div class="tabs-container">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="paymentTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-0 border-bottom-0" id="credit-card-tab"
                                data-bs-toggle="tab" data-bs-target="#credit-card" type="button" role="tab"
                                aria-controls="credit-card" aria-selected="false">
                                <i class="bi bi-credit-card mr-2"></i> Credit Card
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0 border-bottom-0" id="payment-on-arrival-tab"
                                data-bs-toggle="tab" data-bs-target="#payment-on-arrival" type="button" role="tab"
                                aria-controls="payment-on-arrival" aria-selected="false">
                                <i class="bi bi-cash-coin mr-2"></i> Payment On Arrival
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <div class="tab-pane fade  show active" id="credit-card" role="tabpanel"
                            aria-labelledby="credit-card-tab">
                            <p class="mt-4">Pay with your credit card Using Stripe . Account for test purpose</p>
                            <p>Card Number: 4242 4242 4242 4242</p>
                            <p>Expiry Month : 05</p>
                            <p>Expriy Year : 2025</p>
                            <p>CVC : 555</p>
                            <p>Zip : 55555</p>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('payment.process') }}" method="POST" id="payment-form"
                                class="require-validation">
                                @csrf

                                <input type="hidden" name="amount" value="{{ $totalPrice }}">
                                <!-- Pass the total price -->
                                <input type="hidden" name="room_id" value="{{ $room->id }}"> <!-- Add room ID -->
                                <input type="hidden" name="check_in" value="{{ $checkIn }}">
                                <!-- Add check-in date -->
                                <input type="hidden" name="check_out" value="{{ $checkOut }}">
                                <!-- Add check-out date -->
                                <input type="hidden" name="adults" value="{{ $adults }}">
                                <!-- Add number of adults -->
                                <input type="hidden" name="children" value="{{ $children }}">
                                <!-- Add number of children -->

                                <div id="card-element" class="" style="border: 1px solid #ccc; padding: 13px;">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>

                                <button type="submit"
                                    class="btn btn-warning rounded-0 py-2 font-weight-bold text-white mt-3 px-4">
                                    Checkout Now
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="payment-on-arrival" role="tabpanel"
                            aria-labelledby="payment-on-arrival-tab">
                            {{-- <p>You can pay upon arrival at our hotel.</p> --}}
                            <p class="mt-4">You could pay directly in our hotel with any kind of credit card or cash</p>
                            <form action="" method="POST">
                                <button type="submit"
                                    class="btn btn-warning rounded-0 py-2 font-weight-bold text-white mt-3 px-4">
                                    Book Now
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        
        </div>
         
    </section>
@endsection

@section('script')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: card,
            });

            if (error) {
                // Display error message
                document.getElementById('card-errors').textContent = error.message;
            } else {
                // Add payment method ID to form
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        });
    </script>
@endsection

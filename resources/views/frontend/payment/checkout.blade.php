{{-- <div class="container my-5">
    <h2>Payment Checkout</h2>
    <div class="booking-summary p-4">
        <h4>Total Price: ${{ number_format($totalPrice, 2) }}</h4>
        <h5>Check-in: {{ date('d-m-Y', strtotime($booking->check_in_date)) }}</h5>
        <h5>Check-out: {{ date('d-m-Y', strtotime($booking->check_out_date)) }}</h5>
        <h5>Guest Details:</h5>
        <p>Name: {{ $booking->guest->first_name }} {{ $booking->guest->last_name }}</p>
        <p>Email: {{ $booking->guest->email }}</p>
        <p>Mobile: {{ $booking->guest->mobile }}</p>
        <h5>Room Details:</h5>
        @foreach ($booking->rooms as $roomDetail)
            <div>
                <p>Room Type: {{ $roomDetail->roomType->type_name }}</p>
                <p>Price: ${{ number_format($roomDetail->price, 2) }}</p>
                <p>Guest : {{ $roomDetail->pivot->total_adults }} Adutls, {{ $roomDetail->pivot->total_children }}
                    Children</p>
            </div>
        @endforeach
    </div>

    <form id="payment-form" action="{{ route('stripe.process') }}" method="POST">
        @csrf
        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
        <div id="card-element">
           
        </div>
        <div id="card-errors" role="alert" class="text-danger mt-3"></div>
        <button id="submit-button" class="btn btn-primary mt-4">Pay ${{ number_format($totalPrice, 2) }}</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
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
            document.getElementById('card-errors').textContent = error.message;
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethodId');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script> --}}

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

        /* Responsive Styles */
        @media (max-width: 768px) {
            .stepper-wrapper {
                flex-direction: column;
                align-items: flex-start;
                text-align: center;
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

        @media (max-width: 768px) {
            .booking-details h1 {
                font-size: 24px;
            }


            .booking-details p {
                font-size: 14px;
            }

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

        .booking-details {
            /* background-color: #f8f9fa; */
            /* border: 1px solid #dee2e6; */
            /* border-radius: 10px; */
            padding: 20px;
        }
        .card-title{
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 16px;
        }

        .section {
            margin-bottom: 20px;
        }

        .room-details {
            border: 1px solid #dee2e6;
            /* border-radius: 10px; */
            /* background-color: #ffffff; */
            padding: 15px;
        }

        h3,
        h4,
        h5 {
            font-weight: bold;
            color: #343a40;
        }

        p {
            margin: 0;
            color: #495057;
        }

        .custom-section-title {
            border-bottom: 3px solid red
               
                padding-bottom: 5px;
            /
            margin-bottom: 15px;
        
            font-size: 1.25rem;
              font-weight: bold;
            /* Makes the text stand out */
            /* color: #007bff; */
            /* Matches the border color */
            text-transform: uppercase;
            font-family: 'Source Sans Pro', sans-serif;
        }



        .room-card:hover {
            transform: scale(1.02);
            /* Slightly enlarges on hover */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            /* Adds a stronger shadow */
        }
    </style>
@endsection
@section('content')
    <section id="gallery" class="payment_wrapper" style="margin-top: 60px; margin-bottom: 60px;">
        <div class="container-fluid">
            <div class="stepper-wrapper">
                <div class="stepper-item completed">
                    <div class="step-counter">1</div>
                    <div class="step-name mt-2">Search</div>
                    <div class="step-description">Choose your favorite room</div>
                </div>
                <div class="stepper-item completed">
                    <div class="step-counter">2</div>
                    <div class="step-name mt-2">Book</div>
                    <div class="step-description">Confirm your selection</div>
                </div>
                <div class="stepper-item active">
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
        <div class="container">
            {{-- <div class="booking-details">
                <h4>Booking Details</h4>
                
                <div class="row mb-3">
                    <div class="col-md-4 col-6">
                        <p><strong>Full Name: </strong>{{ $booking->guest->first_name }} {{ $booking->guest->last_name }}
                        </p>
                      
                        @foreach ($booking->rooms as $roomDetail)
                            <div>
                              
                                <p><strong>Room:</strong> {{ $roomDetail->roomType->type_name }}</p>
                                <p><strong>Room Price:</strong> ${{ number_format($roomDetail->price, 2) }}</p>

                            </div>
                        @endforeach
                        </p>
                    </div>
                    <div class="col-md-4  col-6">
                        <p><strong>Email:</strong> {{ $booking->guest->email }}</p>
                        
                        @foreach ($booking->rooms as $roomDetail)
                            <div>
                                <p>Guest : {{ $roomDetail->pivot->total_adults }} Adutls,
                                    {{ $roomDetail->pivot->total_children }}
                                    Children</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4 col-12">
                        <p><strong>Phone:</strong> {{ $booking->guest->mobile }}</p>
                        
                        <p><strong>Check In/Out:</strong>{{ date('d-m-Y', strtotime($booking->check_in_date)) }} →
                            {{ date('d-m-Y', strtotime($booking->check_in_out)) }}</p>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</p>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="booking-details p-4 rounded shadow-sm">
                <h3 class="text-center mb-4" style="font-family: 'Source Sans Pro', sans-serif;font-weight: bold;font-size: 30px;">Booking Details</h3>

                <!-- Guest Information -->
                <div class="section mb-4">
                    <h5 class="border-bottom pb-2 mb-3" style="font-family: 'Source Sans Pro', sans-serif;font-weight: bold;font-size: 20px;">Guest Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Full Name:</strong> {{ $booking->guest->first_name }}
                                {{ $booking->guest->last_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Email:</strong> {{ $booking->guest->email }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Phone:</strong> {{ $booking->guest->mobile }}</p>
                        </div>
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="section mb-4">
                    <h5 class="border-bottom  border-primary pb-2 mb-3" style="font-family: 'Source Sans Pro', sans-serif;font-weight: bold;font-size: 20px;">Booking Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Check-In Date:</strong> {{ date('d-m-Y', strtotime($booking->check_in_date)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Check-Out Date:</strong> {{ date('d-m-Y', strtotime($booking->check_out_date)) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Room Details -->
                <div class="section mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Room Details</h5>
                    <div class="row">
                        @foreach ($booking->rooms as $roomDetail)
                            <div class="room-details col-md-4 mb-3 p-3  ">
                                <p><strong>Room Type:</strong> {{ $roomDetail->roomType->type_name }}</p>
                                <p><strong>Room Price:</strong> ${{ number_format($roomDetail->price, 2) }}</p>
                                <p><strong>Guests:</strong> {{ $roomDetail->pivot->total_adults }} Adults,
                                    {{ $roomDetail->pivot->total_children }} Children</p>

                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- Total Price -->
                <div class="section text-center">
                    <h4><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</h4>
                </div>
            </div> --}}

            <div class="booking-details p-4 ">
                <h3 class="text-center mb-4 text-uppercase custom-section-title"
                    style="font-family: 'Source Sans Pro', sans-serif;font-weight: bold;font-size: 30px;">Booking Details
                </h3>

                <!-- Guest Information -->
                <div class="section mb-4">
                    <h5 class="custom-section-title">Guest Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Full Name:</strong> {{ $booking->guest->first_name }}
                                {{ $booking->guest->last_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Email:</strong> {{ $booking->guest->email }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Phone:</strong> {{ $booking->guest->mobile }}</p>
                        </div>
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="section mb-4">
                    <h5 class="custom-section-title">Booking Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Check-In Date:</strong> {{ date('d-m-Y', strtotime($booking->check_in_date)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Check-Out Date:</strong> {{ date('d-m-Y', strtotime($booking->check_out_date)) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Room Details -->
                {{-- <div class="section mb-4">
                    <h5 class="custom-section-title">Room Details</h5>
                    @foreach ($booking->rooms as $roomDetail)
                        <div class="room-details mb-3 p-3 rounded bg-white shadow-sm">
                            <p><strong>Room Type:</strong> {{ $roomDetail->roomType->type_name }}</p>
                            <p><strong>Room Price:</strong> ${{ number_format($roomDetail->price, 2) }}</p>
                            <p><strong>Guests:</strong> {{ $roomDetail->pivot->total_adults }} Adults, 
                                {{ $roomDetail->pivot->total_children }} Children</p>
                        </div>
                    @endforeach
                </div> --}}
                <div class="section mb-4">
                    <h5 class="custom-section-title">Room Details</h5>
                    <div class="row">
                        @foreach ($booking->rooms as $roomDetail)
                            <div class="col-md-6 mb-4">
                                <div class="room-card card border-0 shadow-sm">
                                    <div class="card-body">
                                        {{-- <h6 class="card-title"><strong>Room Type:</strong> {{ $roomDetail->roomType->type_name }}</h6> --}}
                                        <h6 class="card-title">{{ $roomDetail->roomType->type_name }}</h6>
                                        <p class="mb-2"><strong>Price:</strong>
                                            ${{ number_format($roomDetail->price, 2) }}</p>
                                        <p class="mb-2"><strong>Guests:</strong> {{ $roomDetail->pivot->total_adults }}
                                            Adults,
                                            {{ $roomDetail->pivot->total_children }} Children</p>
                                        <p class="mb-0"><strong>Special View:</strong> {{ $roomDetail->view_type }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total Price -->
                <div class="section text-left">
                    <h4><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</h4>
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
                    </ul>
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="credit-card" role="tabpanel"
                            aria-labelledby="credit-card-tab">
                            <div
                                class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mt-2 gap-2">
                                <p class="mt-3 mt-md-0">
                                    Safe money transfer using your bank account. We support Mastercard, Visa, Discover, and
                                    Stripe.
                                </p>
                                <div class="mt-3 mt-md-0 text-end">
                                    <img src="{{ asset('admin_dashboard') }}/assets/images/payments/master.png"
                                        class="img-fluid me-2" height="24" alt="master-card-img">
                                    <img src="{{ asset('admin_dashboard') }}/assets/images/payments/discover.png"
                                        class="img-fluid me-2" height="24" alt="discover-card-img">
                                    <img src="{{ asset('admin_dashboard') }}/assets/images/payments/visa.png"
                                        class="img-fluid me-2" height="24" alt="visa-card-img">
                                    <img src="{{ asset('admin_dashboard') }}/assets/images/payments/stripe.png"
                                        class="img-fluid" height="24" alt="stripe-card-img">
                                </div>
                            </div>
                            {{-- <div class="mt-4">
                                <p><strong>Card Number:</strong> 4242 4242 4242 4242</p>
                                <p><strong>Expiry Month:</strong> 05</p>
                                <p><strong>Expiry Year:</strong> 2025</p>
                                <p><strong>CVC:</strong> 555</p>
                                <p><strong>Zip:</strong> 55555</p>
                            </div> --}}

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form action="{{ route('payment.process') }}" method="POST" id="payment-form"
                                class="require-validation">
                                @csrf
                                <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                <input type="hidden" name="stripeToken" id="stripeToken">
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <div id="card-element" class="mt-3 p-3 border rounded">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                <div class="text-left">
                                    <button type="submit"
                                        class="btn btn-warning rounded-0 py-2 font-weight-bold text-white mt-3 px-4">
                                        <i class="bi bi-cash-stack mr-2"></i>Checkout Now
                                    </button>
                                </div>
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
        const stripe = Stripe(
            "pk_test_51QEuUNCtdzaqHN41dP5wt4wNnFJ1MIAqxIo7EyT9yuYOQGpgYZcBT10iluUEEoJatWXtkszJKzVzi7XQ5SpEtTdt00qomJhOFU"
        );
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


    {{-- <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    const style = {
        base: {
            fontSize: '16px',
            color: '#32325d',
        },
    };

    const cardNumber = elements.create('cardNumber', { style });
    cardNumber.mount('#card-number');

    const cardExpiry = elements.create('cardExpiry', { style });
    cardExpiry.mount('#card-expiry');

    const cardCvc = elements.create('cardCvc', { style });
    cardCvc.mount('#card-cvc');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const cardHolderName = document.getElementById('card-name').value;

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardNumber,
            billing_details: { name: cardHolderName },
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    });
</script> --}}
@endsection

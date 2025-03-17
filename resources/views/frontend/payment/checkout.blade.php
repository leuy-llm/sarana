@extends('layout.master')

@section('style')
    <style>
        .payment-header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://cdn.prod.website-files.com/6200f59a3635458e77aa891e/6438309c39b25a90682effba_hotel-online%20payments.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 3rem 0;
            margin-bottom: 4rem;

        }

        .payment-header h1 {
            color: white;
            font-weight: 700;
            font-family: 'Sail', system-ui;
            font-size: 70px;
        }

        .payment-section {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .payment-section h3 {
            font-family: 'Oswald', sans-serif;
        }

        .card-input {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            border-radius: 6px;
            transition: border-color 0.15s ease-in-out;
        }

        .card-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .booking-summary {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            position: sticky;
            top: 20px;
        }

        .booking-summary h4 {
            font-family: 'Oswald', sans-serif;
        }

        .booking-summary span {
            font-family: 'Oswald', sans-serif;
        }

        .secure-badge {
            background-color: #e9ecef;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-cards {
            padding: 1rem;
            /* border: 1px solid #dee2e6; */
            border-radius: 8px;
            /* background-color: #f8f9fa; */
            margin-bottom: 1.5rem;
        }

        .payment-cards img {
            height: 24px;
            width: auto;
            transition: opacity 0.2s;
        }

        .payment-cards img:hover {
            opacity: 0.8;
        }

        .stripe-powered {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .stripe-powered span {
            font-family: 'Oswald', sans-serif;
        }

        .stripe-powered img {
            height: 20px;
        }

        #card-errors {
            font-family: 'Oswald', sans-serif;
        }

        #card-element {
            /* padding: 10px; */
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f9fa;
            font-family: 'Oswald', sans-serif;
        }

        .btn-pay {
            font-family: 'Oswald', sans-serif;
        }
          /* Loading overlay styles */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure it's on top of everything */
}

/* Spinner size */
.loading-overlay .spinner-border {
    width: 3rem;
    height: 3rem;
}
    </style>
@endsection
@section('content')
    <!-- Payment Header -->
    <div class="payment-header text-center">
        <h1>Complete Payment</h1>
        <p class="lead" style="color: #fff;font-family: 'Sail', system-ui;font-size: 25px;">
            Secure payment processed by Stripe
        </p>
    </div>
    <div class="container mb-5">
        <div id="loading-overlay" class="loading-overlay d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div> 
        <form action="{{ route('payment.process') }}" method="POST" id="payment-form" class="require-validation">
            @csrf
            <div class="row" style="margin-bottom: 150px;">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <!-- Payment Form Section -->
                <div class="col-lg-8">
                    <div class="payment-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="mb-0">Payment Details</h3>
                            <span class="secure-badge" style="font-family: 'Oswald', sans-serif;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Secure Payment
                            </span>
                        </div>

                        <!-- Accepted Cards -->
                        <div class="payment-cards text-right">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/payments/master.png"
                                class="img-fluid me-2" height="24" alt="master-card-img">

                            <img src="{{ asset('admin_dashboard') }}/assets/images/payments/stripe.png" class="img-fluid"
                                height="24" alt="stripe-card-img">
                        </div>
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                        <input type="hidden" name="stripeToken" id="stripeToken">
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <div id="card-element" class="mt-3 p-3 border rounded">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        <div class="stripe-powered text-center">
                            <span>Powered by</span>
                            <img src="{{ asset('admin_dashboard') }}/assets/images/payments/stripe.png" alt="Stripe">
                        </div>
                    </div>
                </div>
                <!-- Booking Summary -->
                <div class="col-lg-4">
                    <div class="booking-summary">
                        @php
                            $checkIn = \Carbon\Carbon::parse($booking->check_in_date);
                            $checkOut = \Carbon\Carbon::parse($booking->check_out_date);
                            $totalNights = $checkIn->diffInDays($checkOut);
                        @endphp
                        <h4 class="mb-4">Booking Summary</h4>
                        @foreach ($booking->rooms as $roomDetail)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $roomDetail->roomType->type_name }} ({{ $totalNights }} nights)</span>
                                    <span>${{ number_format($roomDetail->price*$totalNights, 2) }}</span>
                                </div>
                            </div>
                        @endforeach

                        <div class="border-top pt-3">
                            
                            <div class="d-flex justify-content-between fw-bold mt-3">
                                <span>Total</span>
                                <span>${{ number_format($totalPrice, 2) }}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-pay shadow-none btn-primary w-100 py-3 mt-4">Pay Securely
                            ${{ number_format($totalPrice, 2) }}</button>

                        <div class="text-center mt-3">
                            <small class="text-muted" style=" font-family: 'Oswald', sans-serif;">Your card will not be
                                charged yet</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
        document.addEventListener("DOMContentLoaded", function () {
            const filterForm = document.getElementById("payment-form");
            const loadingOverlay = document.getElementById("loading-overlay");

            filterForm.addEventListener("submit", function () {
                loadingOverlay.classList.remove("d-none"); // Show loading overlay
            });
        });
    </script>
@endsection

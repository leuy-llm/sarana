<!-- resources/views/frontend/payment/success.blade.php -->
@extends('layout.master')
@section('style')
    <style>
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

        .booking-details-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .booking-details-card h5 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .details-label {
            /* font-weight: bold; */

            color: #333;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .details-value {
            color: #666;
        }

        .print-btn {
            background-color: #f0ad4e;
            color: #fff;
            border: none;
            border: none;
            font-family: 'Source Sans Pro', sans-serif;

        }

        .print-btn:hover {
            background-color: #ec971f;
        }

        @media print {
            .print-font-size {
                font-size: 20px;
                /* Adjust as needed for print */
            }
        }
    </style>
@endsection
@section('content')
    <div class="container " style="margin-top: 100px;">
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
            <div class="stepper-item completed">
                <div class="step-counter">3</div>
                <div class="step-name" style="margin-top: 5px;">Checkout</div>
                <div class="step-name" style="font-size: 12px;">Use your preferred payment method
                    Confirmation
                </div>
            </div>
            <div class="stepper-item completed ">
                <div class="step-counter">4</div>
                <div class="step-name" style="margin-top: 5px;">Confirmation
                </div>
                <div class="step-name" style="font-size: 12px;">Choose your favorite room</div>
            </div>
        </div>
        {{-- <div class="alert alert-success text-center">
            <h3>Payment Successful!</h3>
            <p>Your payment has been processed successfully. Thank you for your booking!</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
        </div> --}}
        <div class="" style="margin:100px 0;">
            @if (session('success'))
                {{-- <div class="alert alert-success">{{ session('success') }}</div> --}}
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong><i class="dripicons-checkmark me-2"></i></strong> {{ session('success') }}
                </div>
            @elseif(session('error'))
                {{-- <div class="alert alert-danger">{{ session('error') }}</div> --}}
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong> <i class="dripicons-wrong me-2"></i></strong> {{ session('error') }}
                </div>
            @endif
            <div id="printArea" class="booking-details-card shadow-sm p-5 mx-auto print-font-size"
                style="max-width: 550px;">
                <h5 class="text-center mb-5">Booking Details</h5>

                <!-- Transaction ID -->
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Transaction ID</div>
                    <div class="col-7 details-value">{{ $payment->payment_intent_id }}</div>
                </div>

                <!-- Full Name -->
                <div class="row mb-3">
                    <div class="col-5 details-label">Full Name</div>
                    <div class="col-7 details-value">
                        {{ $payment->guest->first_name }} {{ $payment->guest->last_name }}
                    </div>
                </div>

                <!-- Email -->
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Email</div>
                    <div class="col-7 details-value">{{ $payment->guest->email }}</div>
                </div>

                <!-- Phone -->
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Phone</div>
                    <div class="col-7 details-value">{{ $payment->guest->mobile }}</div>
                </div>

                <!-- Room -->
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Room</div>
                    <div class="col-7 details-value">
                        {{ $payment->booking->room->roomType->type_name ?? 'Room details not available' }}
                    </div>
                </div>

                <!-- Check In/Out -->
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Check In/Out</div>
                    <div class="col-7 details-value">
                        {{ date('d-m-y', strtotime($payment->booking->check_in_date ?? 'Check-in date not available')) }} →
                        {{ date('d-m-y', strtotime($payment->booking->check_out_date ?? 'Check-out date not available')) }}

                    </div>
                </div>
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Guests</div>
                    <div class="col-7 details-value">
                        {{ $payment->booking->total_adults ?? 'N/A' }} Adults,
                        {{ $payment->booking->total_children ?? 'N/A' }} Children
                    </div>
                </div>
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Payment </div>
                    <div class="col-7 details-value">
                        Stripe
                    </div>
                </div>


                <!-- Payment Amount -->
                <div class="row mb-3 print-font-size">
                    <div class="col-5 details-label">Total Price</div>
                    <div class="col-7 details-value">${{ number_format($payment->amount / 100, 2) }}</div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button id="printButton" class="btn print-btn rounded-0 text-uppercase py-3 text-white mt-3 px-5"
                    style="font-weight: 500;">
                    Print Booking Details
                </button>
            </div>
        </div>
    </div>
    <!-- Hidden Logo and Hotel Name for Printing -->
    <div id="printHeader" style="display: none;">
        <div class="text-center d-flex mt-3 justify-content-between align-items-center mb-4">
            <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                alt="Hotel Logo" style="width: 100px; margin-bottom: 10px;">
            <h1
                style="font-family: 'Source Sans Pro', sans-serif;; font-size: 28px; font-weight: 900; letter-spacing: 2px; color: #333;">
                SINAKA ANGKOR HOTEL
            </h1>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            const printArea = document.getElementById('printArea').innerHTML;
            const printHeader = document.getElementById('printHeader').innerHTML;
            const originalContent = document.body.innerHTML;
            // Combine the hidden header (logo and hotel name) with the booking details
            document.body.innerHTML = printHeader + printArea;
            // Trigger the print dialog
            window.print();
            // Restore the original page content
            document.body.innerHTML = originalContent;
            // Reload the page to restore event listeners and original content
            window.location.reload();
        });
    </script>
@endsection

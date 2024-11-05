@extends('layout.master')
@section('style')
    <style>
        .card {
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .display-4 {
            /* font-weight: 700; */
            font-size: 2.5rem;
            font-family: "Coda", system-ui;
            font-weight: 500;
        }

        .lead {
            font-size: 1.1rem;
            color: #6c757d;
            font-family: "Coda", system-ui;

        }

        .booking-details p {
            font-size: 1rem;
            margin-bottom: 0.5rem;
            font-family: "Coda", system-ui;

        }

        .booking-details span {
            font-weight: 500;

        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        body {
            background-color: #f8f9fa;
        }

        .reservation-title {
            font-family: 'Georgia', serif;
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
            font-family: "Coda", system-ui;
        }

        .btn-primary {
            background-color: #004085;
            color: white;
            border-color: #004085;
            font-family: "Coda", system-ui;
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

        .alert {
            font-family: "Coda", system-ui;

        }

        .close {
            color: black !important;
            opacity: 1 !important;
            text-shadow: none !important;
            border: none !important;
            outline: none !important;
            font-bold: 900 !important;
            font-family: "Coda", system-ui;

        }
    </style>
@endsection
@section('content')
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>! {{ session('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h1 class="display-4 text-success mb-4">{{ $data }}</h1>
                <p class="lead text-muted">Thank you for your reservation. Your booking has been successfully.</p>
                <hr class="my-4">
                <div class="booking-details text-left mt-4">
                    <p><span>Booking ID:</span> #{{ $booking->id }}</p>
                    <p><span>Room Type:</span> {{ $roomType }}</p>
                    <p><span>Room Price per Night:</span> ${{ number_format($roomPrice, 2) }}</p>
                    @if ($guest)
                        <p>Guest Name : {{ $guest->name }}!</p>
                    @else
                        <p>Welcome, Guest!</p>
                    @endif
                    <p><span>Check-in Date:</span> {{ date('d-m-Y', strtotime($booking->check_in_date)) }}</p>
                    <p><span>Check-out Date:</span> {{ date('d-m-Y', strtotime($booking->check_out_date)) }}</p>
                    <p><span>Total Amount:</span> ${{ number_format($totalAmount, 2) }}</p>
                    <p>Booking Status: <span class="badge badge-success"
                            style="font-size: 1rem">{{ ucfirst($booking->status) }}</span></p>
                </div>
                <div class="flex-row justify-content-between d-flex align-items-between">
                    <a href="{{ url('/') }}" class="btn mt-4 btn-primary btn-block" style="width: 200px">Return to
                        Home</a>
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-booking btn-block mt-4">Cancel Booking</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout.master')

@section('content')
    <h3>Payment for Booking</h3>
    <p>Room: {{ $booking->room->roomType->type_name }} ({{ $booking->room->room_number }})</p>
    <p>Total Amount: ${{ number_format($amount, 2) }}</p>

    <form action="{{ route('payment.complete') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <!-- Stripe Elements for Card Details -->
        <div id="card-element"></div>

        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
@endsection

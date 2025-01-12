@extends('layout.app')

@section('content')
<div class="container text-center">
    <h1 class="text-danger">Payment Failed!</h1>
    <p>Something went wrong with your payment. Please try again.</p>
    <h1>Payment Error</h1>
<p>{{ $errorMessage }}</p>

    <a href="{{ route('bookings.index') }}" class="btn btn-warning">Back to Booking</a>
</div>
@endsection

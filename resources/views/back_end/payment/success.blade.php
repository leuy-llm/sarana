@extends('layout.app')

@section('content')
    <div class="container text-center">
        <h1 class="text-success">Payment Successful!</h1>
        <p>Thank you for your payment. Your transaction ID is <strong>{{ $payment->payment_intent_id }}</strong>.</p>
        <a href="#" class="btn btn-primary">Return to Home</a>
    </div>
@endsection

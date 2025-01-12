@extends('layout.app')

@section('content')
    <div class="row">
        {{-- <div class="col-md-12">
            <div class="card">
                 <div class="card-header">
                    <h4 class="card-title">Create Payment</h4>
                    <a href="{{ url('payments') }}" class="btn btn-secondary float-end">Back</a>
                </div> 
                 <div class="card-body">
                    <form action="{{ route('payments.store') }}" class="require-validation" id="payment-form" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="hidden" name="total_price" value="{{ $total_price }}">
                        <div>
                            <label>Amount</label>
                            <input type="number" name="amount" value="{{ $total_price }}" readonly>
                        </div>
                        <div>
                            <label>Currency</label>
                            <input type="text" name="currency" value="USD" readonly>
                        </div>
                        <div>
                            <label>Payment Method</label>
                            <div id="card-element" class="mt-3 p-3 border rounded">

                            </div>
                            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        </div>
                       
                        <div class="text-left">
                            <button type="submit"
                                class="btn btn-warning rounded-0 py-2 font-weight-bold text-white mt-3 px-4">
                                <i class="bi bi-cash-stack me-2"></i>Pay Now ( $ {{$total_price}} )
                            </button>
                        </div>
                    </form>
                </div> 
                
            </div>
        </div> --}}
        <div class="col-12 card col-md-7">
            <div class="card-body">
                <div class="mb-3 rounded">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input type="radio" id="BillingOptRadio1" name="billingOptions" class="form-check-input"
                                    checked="">
                                <label class="form-check-label font-16 fw-bold" for="BillingOptRadio1">Credit / Debit
                                    Card</label>
                            </div>
                            <p class="mb-0 ps-3 pt-1">Safe money transfer using your bank account. We support Mastercard,
                                Visa,
                                Discover and Stripe.</p>
                        </div>
                        <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/payments/master.png" height="24"
                                alt="master-card-img">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/payments/discover.png" height="24"
                                alt="discover-card-img">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/payments/visa.png" height="24"
                                alt="visa-card-img">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/payments/stripe.png" height="24"
                                alt="stripe-card-img">
                        </div>
                    </div> <!-- end row -->
                    {{-- <form action="{{ route('payments.store') }}" method="POST" id="payment-form"
                        class="require-validation">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $total_price }}">
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="card-number" class="form-label">Card Number</label>
                                    <input type="text" id="card-number" class="form-control" data-toggle="input-mask"
                                        data-mask-format="0000 0000 0000 0000" placeholder="4242 4242 4242 4242">
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="card-name-on" class="form-label">Name on card</label>
                                    <input type="text" id="card-name-on" class="form-control"
                                        placeholder="Master Shreyu">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="card-expiry-date" class="form-label">Expiry date</label>
                                    <input type="text" id="card-expiry-date" class="form-control"
                                        data-toggle="input-mask" data-mask-format="00/00" placeholder="MM/YY">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="card-cvv" class="form-label">CVV code</label>
                                    <input type="text" id="card-cvv" class="form-control" data-toggle="input-mask"
                                        data-mask-format="000" placeholder="012">
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="text-left">
                            <button type="submit"
                                class="btn btn-warning rounded-0 py-2 font-weight-bold text-white mt-3 px-4">
                                <i class="bi bi-cash-stack me-2"></i>Pay Now ( $ {{ $total_price }} )
                            </button>
                        </div>
                    </form> --}}
                    <form action="{{ route('payments.store') }}" method="POST" id="payment-form"
                        class="require-validation">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $total_price }}">
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        <div id="card-element" class="mt-3 p-3 border rounded">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        <div class="text-left">
                            <button type="submit"
                                class="btn btn-warning rounded-0 py-2 font-weight-bold text-white mt-3 px-4">
                                <i class="bi bi-cash-stack mr-2"></i>Pay now
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-12 col-md-5">
            <div class="border p-3 mb-3 rounded">
                <div class="row g-0">
                    {{-- <div class="col-sm-8">
                        <div class="form-check">
                            <input type="radio" id="BillingOptRadio1" name="billingOptions" class="form-check-input"
                                checked="">
                            <label class="form-check-label font-16 fw-bold" for="BillingOptRadio1">Credit / Debit
                                Card</label>
                        </div>
                        <p class="mb-0 ps-3 pt-1">Safe money transfer using your bank account. We support Mastercard, Visa,
                            Discover and Stripe.</p>
                    </div>
                    <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">
                        <img src="{{ asset('admin_dashboard') }}/assets/images/payments/master.png" height="24"
                            alt="master-card-img">
                        <img src="{{ asset('admin_dashboard') }}/assets/images/payments/discover.png" height="24"
                            alt="discover-card-img">
                        <img src="{{ asset('admin_dashboard') }}/assets/images/payments/visa.png" height="24"
                            alt="visa-card-img">
                        <img src="{{ asset('admin_dashboard') }}/assets/images/payments/stripe.png" height="24"
                            alt="stripe-card-img">
                    </div> --}}

                    <h3 class="mb-3">Booking Summary</h3>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.roomType') : </strong>{{ $booking->room->roomType->type_name }}</p>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.roomNumber') : </strong> {{ $booking->room->room_number }}</p>
                    </div>
                    <div class="col-6 col-md-6">
                        <p><strong>@lang('label.price') : </strong>$ {{ $booking->room->price }} per night</p>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.floor') : {{ $booking->room->floor }}</strong></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>@lang('label.checkIn') : {{ $booking->check_in_date->format('d-m-y') }}</strong></p>

                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.checkOut') : {{ $booking->check_out_date->format('d-m-y') }}</strong></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>@lang('label.totalAdults') : {{ $booking->total_adults }}</strong></p>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.totalChildren') : {{ $booking->total_children }}</strong></p>
                    </div>
                    <hr class="border-2 border-danger">
                    {{-- <div class="col-12 col-md-6">
                            <p><strong>@lang('label.totalNights') : {{$booking->days}} ថ្ងៃ</strong></p>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <p><strong>@lang('label.totalPrice') : </strong>${{$total_price}}</p>
                        </div> --}}
                    {{-- 
                        <div class="col-6 col-md-6">
                            <p><strong>@lang('label.totalPrice') : </strong>${{$total_price}}</p>
                        </div> --}}


                    {{-- <h5><strong>Check-in:</strong> {{ $booking->check_in_date }}</h5>
                        <h5><strong>Check-out:</strong> {{ $booking->check_out_date }}</h5>
                        <h5><strong>Total Price:</strong> ${{$total_price}}</h5>
                        <h5><strong>Payment Method:</strong> Credit / Debit Card</h5> --}}
                    <div class="col-12 col-md-6">
                        <p><strong>@lang('label.firstName') : </strong>{{ $booking->guest->first_name }}</p>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.lastName') : </strong>{{ $booking->guest->last_name }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>@lang('label.email') : </strong>{{ $booking->guest->email }}</p>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.phone') : </strong>{{ $booking->guest->mobile }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>@lang('label.zip') : </strong>{{ $booking->guest->zip }}</p>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.city') : </strong>{{ $booking->guest->city }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>@lang('label.country') : </strong>{{ $booking->guest->country }}</p>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <p><strong>@lang('label.address') : </strong>{{ $booking->guest->address }}</p>
                    </div>
                    <div class="col-12 col-md-12">
                        <p><strong>@lang('label.paymentNote') : </strong>Please provide your payment details (credit card number,
                            expiry date, and CVV) during checkout.</p>
                    </div>
                    <hr>
                    <div class="col-12 col-md-12">
                        <p><strong>@lang('label.totalPrice') : </strong>$ {{ $total_price }}</p>
                    </div>
                </div> <!-- end row -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://js.stripe.com/v3/"></script>
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
                token,
                error
            } = await stripe.createToken(card);
            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        });
    </script>
@endsection

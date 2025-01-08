@extends('layout.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.booking'), 'url' => route('bookings.index')],
            ['title' => __('label.bookingDetail'), 'url' => route('bookings.create')],
        ];
        $currentPageTitle = __('label.bookingDetail');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="mb-4">@lang('label.bookingDetail')</h4>
                        <div class="col-md-4">
                            <h5 class="card-title">@lang('label.name') : {{ $booking->guest->first_name }}
                                {{ $booking->guest->last_name }}</h5>
                        </div>
                        <div class="col-md-4 flex-wrap">
                            <h5 class="card-title">@lang('label.room') : {{ $booking->room->roomType->type_name }}</h5>
                            {{-- <p class="card-text">{{ $booking->room->roomType->type_name }}</p> --}}
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap">
                            <h5 class="card-title">@lang('label.id') : {{ $booking->room->id }}</h5>

                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h5 class="card-title">@lang('label.checkIn') : {{ $booking->check_in_date->format('d-m-Y') }}</h5>

                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h5 class="card-title">@lang('label.checkOut') : {{ $booking->check_out_date->format('d-m-Y') }}</h5>

                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h5 class="card-title">@lang('label.adults') : {{ $booking->total_adults }}</h5>

                        </div>

                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h5 class="card-title">@lang('label.children') : {{ $booking->total_children }}</h5>
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h5 class="card-title">@lang('label.status') :
                                <span
                                    style="padding-top: 5px;padding-left: 10px; border-radius: 20px; padding-right: 10px;text-transform: uppercase;"
                                    class="badge @if ($booking->status == 'Pending') bg-warning
                                                @elseif ($booking->status == 'Approved') bg-primary 
                                                @elseif ($booking->status == 'Checked-In') bg-info 
                                                @elseif ($booking->status == 'Checked-Out') bg-success 
                                                @elseif ($booking->status == 'Completed') bg-success 
                                                @elseif ($booking->status == 'Cancelled') bg-danger @endif">
                                    {{ $booking->status }}
                                </span>
                            </h5>
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h5 class="card-title">@lang('label.createDate') : {{ $booking->created_at->format('d-m-Y') }}</h5>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div>

            <div class="card">
                <div class="card-body">
                    <h4>@lang('label.paymentDetails')</h4>
                    @if ($booking->payment)
                        <p class="mt-3"><strong>Transaction ID:</strong> {{ $booking->payment->payment_intent_id }}</p>
                        <p class="mt-3"><strong>Amount:</strong> {{ $booking->payment->amount }}
                            {{ strtoupper($booking->payment->currency) }}</p>
                        <p class="mt-3"><strong>Status:</strong> {{ ucfirst($booking->payment->status) }}</p>
                        <p class="mt-3"><strong>Payment Method:</strong> {{ ucfirst($booking->payment->payment_method) }}
                        </p>
                    @else
                        <p>No payment information available.</p>
                    @endif
                </div>
            </div>
        </div> <!-- end col-->
    </div>
@endsection
@section('script')
    <script></script>
@endsection

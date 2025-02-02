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
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                      
                        <div class="col-md-4">
                            <h5 class="card-title">@lang('label.name') : {{ $booking->guest->first_name }}
                                {{ $booking->guest->last_name }}</h5>
                        </div>
                        @foreach ($booking->rooms as $room)
                            <div class="col-md-4 flex-wrap">
                                <h5 class="card-title">@lang('label.room') : {{ $room->roomType->type_name }}</h5>
                            </div>
                            <div class="col-md-4 d-flex gap-2 flex-wrap">
                                <h5 class="card-title">@lang('label.id') : {{ $room->id }}</h5>
                            </div>
                        @endforeach
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
    </div> --}}

    <div class="row">
        <div class="col-12">
            <!-- Booking Details Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">@lang('label.bookingDetail')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h5 class="card-title">@lang('label.name'):</h5>
                            <p class="card-text">{{ $booking->guest->first_name }} {{ $booking->guest->last_name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="card-title">@lang('label.createDate'):</h5>
                            <p class="card-text">{{ $booking->created_at->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="card-title">@lang('label.checkIn'):</h5>
                            <p class="card-text">{{ $booking->check_in_date->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="card-title">@lang('label.checkOut'):</h5>
                            <p class="card-text">{{ $booking->check_out_date->format('d-m-Y') }}</p>
                        </div>
                        {{--     
                        @php
                            $totalAdults = 0;
                            $totalChildren = 0;
                        @endphp
    
                        @foreach ($booking->rooms as $room)
                            @php
                                $totalAdults += $room->pivot->total_adults;
                                $totalChildren += $room->pivot->total_children;
                            @endphp
                        @endforeach --}}

                        {{-- <div class="col-md-6 mb-3">
                            <h5 class="card-title">@lang('label.adults'):</h5>
                            <p class="card-text">{{ $totalAdults }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="card-title">@lang('label.children'):</h5>
                            <p class="card-text">{{ $totalChildren }}</p>
                        </div> --}}

                        <div class="col-md-6 mb-3">
                            <h5 class="card-title">@lang('label.status'):</h5>
                            <span
                                class="badge 
                                @if ($booking->status == 'Pending') bg-warning 
                                @elseif ($booking->status == 'Approved') bg-primary 
                                @elseif ($booking->status == 'Checked-In') bg-info 
                                @elseif ($booking->status == 'Checked-Out' || $booking->status == 'Completed') bg-success 
                                @elseif ($booking->status == 'Cancelled') bg-danger @endif">
                                {{ $booking->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Room Details -->
           @php
                $totalAdults = 0;
                $totalChildren = 0;
            @endphp
       
       <div class="card shadow-sm mb-4">
           <div class="card-header bg-secondary text-white">
               <h4 class="mb-0">@lang('label.roomDetails')</h4>
           </div>
           <div class="card-body">
               <table class="table table-bordered">
                   <thead class="bg-light">
                       <tr>
                        
                           <th>@lang('label.room')</th>
                           <th>@lang('label.adults')</th>
                           <th>@lang('label.children')</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($booking->rooms as $room)
                           <tr>
                               <td>{{ $room->roomType->type_name }}</td>
                               <td>{{ $room->pivot->total_adults }}</td>
                               <td>{{ $room->pivot->total_children }}</td>
                           </tr>
                           @php
                               $totalAdults += $room->pivot->total_adults;
                               $totalChildren += $room->pivot->total_children;
                           @endphp
                       @endforeach
                   </tbody>
               </table>
               <div class="mt-4" style="display: flex; justify-content: center; align-items: center; gap:10px;">
                <strong>@lang('label.totalAdults'):</strong> {{ $totalAdults }} <br>
                <strong>@lang('label.totalChildren'):</strong> {{ $totalChildren }}
            </div>
           </div>
       </div>
            <!-- Payment Details -->
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">@lang('label.paymentDetails')</h4>
                </div>
                <div class="card-body">
                    @if ($booking->payment)
                        <table class="table table-striped">
                            <tr>
                                <th>Transaction ID:</th>
                                <td>{{ $booking->payment->payment_intent_id }}</td>
                            </tr>
                            <tr>
                                <th>Amount:</th>
                                <td>{{ number_format($booking->payment->amount, 2) }}
                                    {{ strtoupper($booking->payment->currency) }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>{{ ucfirst($booking->payment->status) }}</td>
                            </tr>
                            <tr>
                                <th>Payment Method:</th>
                                <td>{{ ucfirst($booking->payment->payment_method) }}</td>
                            </tr>
                        </table>
                    @else
                        <p class="text-danger">No payment information available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection

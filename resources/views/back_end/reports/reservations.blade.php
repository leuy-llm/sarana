@extends('layout.app')

@section('style')
    <style>
        body {
            font-family: 'Oswald', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-family: 'Oswald', sans-serif;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-family: 'Oswald', sans-serif;
        }

        th {
            background-color: #343a40;
            color: white;
            font-family: 'Oswald', sans-serif;
        }

        thead th {
            font-family: 'Oswald', sans-serif;

        }
    </style>
@endsection
@section('content')
    <h1 class="text-center mb-4 mt-3">@lang('label.reportReservation')</h1>
    <form method="GET" action="{{ route('reports.reservations') }}" class="mb-4">
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">

            <div class="d-flex flex-column ">
                <label for="start_date" class="">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control "
                    value="{{ request()->start_date }}" style="width: 350px;">
            </div>
            <div class="d-flex flex-column">
                <label for="end_date" class="">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->end_date }}"
                    style="width: 350px;">
            </div>
            <div class="d-flex gap-2 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('reports.reservations.export', ['start_date' => request()->start_date, 'end_date' => request()->end_date]) }}"
                    class="btn btn-danger">
                    Export
                </a>
                <a href="{{ route('reports.reservations') }}" class="btn btn-dark">
                    Reset
                </a>
            </div>
        </div>
    </form>
    <!-- Check if Start Date and End Date are present to display table -->
    {{-- @if (request()->has('start_date') && request()->has('end_date'))
        <!-- Reservation Table -->

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>@lang('label.guestName')</th>
                    <th>@lang('label.room')</th>
                    <th>@lang('label.roomType')</th>
                    <th>@lang('label.price')</th>
                    <th>@lang('label.checkIn')</th>
                    <th>@lang('label.checkOut')</th>
                    <th>@lang('label.totalAdults')</th>
                    <th>@lang('label.totalChildren')</th>
                    <th>@lang('label.status')</th>
                   
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    @foreach ($reservation->rooms as $room)
                        <tr>
                            <td>{{ $loop->parent->iteration }}</td> <!-- Use parent loop for iteration -->
                            <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->roomType->type_name }}</td>
                            <td>${{ $room->price }}</td>
                            <td>{{ date('d-m-Y', strtotime($reservation->check_in_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($reservation->check_out_date)) }}</td>
                            <td>{{ $room->pivot->total_adults }}</td> <!-- Fetch from pivot table -->
                            <td>{{ $room->pivot->total_children }}</td> <!-- Fetch from pivot table -->
                            <td>{{ ucfirst($reservation->status) }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No reservations found for the selected dates.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif --}}

    @if (request()->has('start_date') && request()->has('end_date'))
        <table class="table table-bordered table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>@lang('label.guestName')</th>
                    <th>@lang('label.room')</th>
                    <th>@lang('label.roomType')</th>
                    <th>@lang('label.price')</th>
                    <th>@lang('label.checkIn')</th>
                    <th>@lang('label.checkOut')</th>
                    <th>@lang('label.totalAdults')</th>
                    <th>@lang('label.totalChildren')</th>
                    <th>@lang('label.status')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    @foreach ($reservation->rooms as $room)
                        <tr>
                            <td>{{ $loop->parent->iteration }}</td> <!-- Use parent loop for iteration -->
                            <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->roomType->type_name }}</td>
                            <td>${{ $room->price }}</td>
                            <td>{{ date('d-m-Y', strtotime($reservation->check_in_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($reservation->check_out_date)) }}</td>
                            <td>{{ $room->pivot->total_adults }}</td> <!-- Fetch from pivot table -->
                            <td>{{ $room->pivot->total_children }}</td> <!-- Fetch from pivot table -->
                            <td>{{ ucfirst($reservation->status) }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No reservations found for the selected dates.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
@endsection

@section('script')
    <script></script>
@endsection

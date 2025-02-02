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
            /* this font is work */
        }

        th {
            background-color: #343a40;
            color: white;
            font-family: 'Oswald', sans-serif;

        }

        thead th {
            font-family: 'Oswald', sans-serif;
            /* Apply to table headers */
        }
    </style>
@endsection
@section('content')
    <h1 class="text-center mb-4 mt-3">@lang('label.roomOccupancyReport')</h1>
    <!-- Date Range Filter Form -->
    <form method="GET" action="{{ route('reports.rooms') }}" class="mb-4">
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
            <!-- Start Date -->
            <div class="d-flex flex-column ">
                <label for="start_date" class="">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control "
                    value="{{ request()->start_date }}" style="width: 350px;">
            </div>
            <!-- End Date -->
            <div class="d-flex flex-column">
                <label for="end_date" class="">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->end_date }}"
                    style="width: 350px;">
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-2 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('reports.rooms.export', ['start_date' => request()->start_date, 'end_date' => request()->end_date]) }}"
                    class="btn btn-danger">
                    Export
                </a>
                <a href="{{ route('reports.rooms') }}" class="btn btn-dark">
                    Reset
                </a>
            </div>
        </div>
    </form>

    @if (request()->has('start_date') && request()->has('end_date'))
        <table class="table table-bordered table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>@lang('label.roomNumber')</th>
                    <th>@lang('label.roomType')</th>
                    <th>@lang('label.status')</th>
                    <th>@lang('label.guestName')</th>
                    <th>@lang('label.checkIn')</th>
                    <th>@lang('label.checkOut')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    @foreach ($room->bookings as $booking)
                        <tr>
                            <td>{{ $loop->parent->iteration }}</td>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->roomType->type_name }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                            <td>{{ $booking->guest->first_name }} {{ $booking->guest->last_name }}</td>
                            <td>{{ date('d-m-Y', strtotime($booking->check_in_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($booking->check_out_date)) }}</td>
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

<!DOCTYPE html>
<html>

<head>
    <title>Reservation Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Hanuman', 'serif';
        }

        table,
        th,
        td {
            border: 1px solid #313a46;
            font-family: 'Hanuman', 'serif';
        }

        thead {
            background: #313a46;
            color: white;
            font-family: 'Hanuman', 'serif';
            /* font-size: 12px; */
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            font-family: 'Hanuman', 'serif';

        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        body {
            font-family: 'Hanuman', 'serif';
        }
    </style>

    </style>
</head>

<body>
    <h1>Reservation Report</h1>
    <img src="image/logo1.png" alt="Logo" height="60px">

    <p>Date Range: {{ request()->start_date ?? 'N/A' }} to {{ request()->end_date ?? 'N/A' }}</p>
    <table class="table table-striped table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Guest Name</th>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Price</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Status</th>
            </tr>

        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->guest->name }}</td>
                    <td>{{ $reservation->room->room_number }}</td>
                    <td>{{ $reservation->room->roomType->type_name }}</td>
                    <td>${{ $reservation->room->price }}</td>
                    <td>{{ date('d-m-Y', strtotime($reservation->check_in_date)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($reservation->check_out_date)) }}</td>
                    <td>{{ $reservation->total_adults }}</td>
                    <td>{{ $reservation->total_children }}</td>
                    <td>{{ ucfirst($reservation->status) }}</td>
                    {{-- <td>{{ ucfirst($reservation->payment_status) }}</td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="11">No reservations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

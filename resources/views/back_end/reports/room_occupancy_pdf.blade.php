<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Occupancy Report</title>
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
            /* Ensure font is applied here */
        }

        thead th {
            font-family: 'Oswald', sans-serif;
            /* Apply to table headers */
        }

        .status-table th,
        .status-table td {
            text-align: left;
            font-family: 'Oswald', sans-serif;
            /* Ensure font is applied here */
        }

        .logo {
            width: 150px;
            height: auto;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
            alt="Logo" class="logo">
        <h1>Room Occupancy Report</h1>
        <p><strong>Date Range:</strong> {{ request()->start_date ?? 'N/A' }} to {{ request()->end_date ?? 'N/A' }}</p>
        <p><strong>Total Rooms:</strong> {{ $totalRooms }}</p>
        <p><strong>Occupied Rooms:</strong> {{ $occupiedRooms }}</p>
        <p><strong>Vacant Rooms:</strong> {{ $vacantRooms }}</p>
        <p><strong>Occupancy Rate:</strong> {{ number_format($occupancyRate, 2) }}%</p>
    </div>

    <h3>Room Occupancy Details</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Status</th>
                <th>Guest Name</th>
                <th>Check In</th>
                <th>Check Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
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
            @endforeach
        </tbody>
    </table>
</body>

</html>

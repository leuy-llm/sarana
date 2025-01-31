<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Report</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');

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
        <h1 style="font-family: 'Oswald', sans-serif;">Reservation Report</h1>
        <p style="font-family: 'Oswald', sans-serif;">
            <strong style="font-family: 'Oswald', sans-serif;">Date Range:</strong> {{ request()->start_date ?? 'N/A' }} to {{ request()->end_date ?? 'N/A' }}
        </p>
    </div>
    
    <!-- Add Total Reservations and Total Guests -->
    <h3 style="font-family: 'Oswald', sans-serif;">Summary</h3>
    <table class="summary-table" style="font-family: 'Oswald', sans-serif;">
        <tr>
            <th>Total Reservations</th>
            <th>Total Guests</th>
            <th>Total Payments Status</th>
        </tr>
        <tr>
            <td>{{ $totalReservations }}</td>
            <td>{{ $totalGuests }}</td>
            <td>Paid : {{$tatalPaid}} / Unpaid : {{$totalUnpaid}}</td>
        </tr>
    </table>
    
    <h3 style="font-family: 'Oswald', sans-serif;">Status Breakdown</h3>
    <table class="status-table" style="font-family: 'Oswald', sans-serif;">
        <tr>
            <th>Reserved</th>
            <th>Pending</th>
            <th>Cancelled</th>
            <th>Checked-In</th>
            <th>Checked-Out</th>
            <th>Completed</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>{{ $statusBreakdown['Reserved'] }}</td>
            <td>{{ $statusBreakdown['Pending'] }}</td>
            <td>{{ $statusBreakdown['Cancelled'] }}</td>
            <td>{{ $statusBreakdown['Checked-In'] }}</td>
            <td>{{ $statusBreakdown['Checked-Out'] }}</td>
            <td>{{ $statusBreakdown['Completed'] }}</td>
            <td>{{ $statusBreakdown['Total'] }}</td>
        </tr>
    </table>
    

    <h3>Reservation Details</h3>
    <table>
        <thead style="font-family: 'Oswald', sans-serif;">
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
                <th>Paymenent Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($reservations as $reservation)
                @foreach ($reservation->rooms as $room)
                    <tr>
                        <td>{{ $loop->parent->iteration }}</td>
                        <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->roomType->type_name }}</td>
                        <td>${{ $room->price }}</td>
                        <td>{{ date('d-m-Y', strtotime($reservation->check_in_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($reservation->check_out_date)) }}</td>
                        <td>{{ $room->pivot->total_adults }}</td>
                        <td>{{ $room->pivot->total_children }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>{{ ucfirst($reservation->payment_status) }}</td>
                        
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="10" class="text-center">No reservations found for the selected dates.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>

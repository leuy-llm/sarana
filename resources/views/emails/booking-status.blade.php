{{-- <!DOCTYPE html>
<html>
<head>
    <title>Your Booking Status</title>
</head>
<body>
    <h1>Hello, {{ $guest->first_name }} {{ $guest->last_name }}</h1>
    <p>Thank you for choosing {{ config('app.name') }}.</p>
    <p>Your booking details are as follows:</p>
    <ul>
        <li>Room: {{ $booking->room->room_number }} - {{ $booking->room->roomType->type_name }}</li>
        <li>Check-in Date: {{ $booking->check_in_date }}</li>
        <li>Check-out Date: {{ $booking->check_out_date }}</li>
        <li>Status: {{ ucfirst($booking->status) }}</li>
    </ul>
    <p>We look forward to welcoming you. If you have any questions, feel free to contact us.</p>
    <p>Best Regards,</p>
    <p>{{ config('app.name') }} Team</p>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro' !important;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #d9b46b;
            color: #ffffff;
            text-align: center;
            padding: 20px 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .body {
            padding: 20px;
            color: #333333;
        }

        .body p {
            margin: 0 0 10px;
        }

        .reservation-details {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .reservation-details h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #d9b46b;
        }

        .reservation-details table {
            width: 100%;
            margin-bottom: 20px;
        }

        .reservation-details table th,
        .reservation-details table td {
            text-align: left;
            padding: 5px 0;
        }

        .reservation-details table td {
            color: #555;
        }

        .footer {
            text-align: center;
            padding: 20px 10px;
            background-color: #f9f9f9;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #ddd;
        }

        .footer a {
            color: #d9b46b;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1 class="mb-2">Sinaka Angkor Hotel</h1>
            <p>Reservation Details</p>
        </div>

        <!-- Body -->
        <div class="body">
            <p>Dear  <strong>{{ $guest->last_name }}</strong>,</p>
            <p class="mb-2">Thank you for choosing Sinaka Angkor Hotel.</p>
            <div class="reservation-details">
                <h3 class="mt-4">Here are the details of your reservation:</h3>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $guest->first_name }} {{ $guest->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $guest->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $guest->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Room:</th>
                            <td>@foreach ($rooms as $room)
                                
                                    <strong>Room Type:</strong> {{ $room->roomType->type_name }}<br>
                                    {{-- <strong>Room Number:</strong> {{ $room->room_number }}<br> --}}
                                    <strong>Room Floor:</strong> {{ $room->floor }}<br>
                                
                            @endforeach</td>
                        </tr>
                       
                        {{-- <tr>
                            <th>Room Floor:</th>
                            <td>{{ optional($booking->room)->floor ?? 'N/A' }}</td>
                        </tr> --}}
                        <tr>
                            <th>Guests:</th>
                            <td>{{ $booking->rooms->sum('pivot.total_adults') }} Adults, {{ $booking->rooms->sum('pivot.total_children') }} Children</td>
                        </tr>
                        <tr>
                            <th>Check In:</th>
                            <td>{{ date('d-m-Y', strtotime($booking->check_in_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Check Out:</th>
                            <td>{{ date('d-m-Y', strtotime($booking->check_out_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $guest->address }}</td>
                        </tr>
                        <tr>
                            <th>City:</th>
                            <td>{{ $guest->city }}</td>
                        </tr>
                        <tr>
                            <th>Country:</th>
                            <td>{{ $guest->country }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method:</th>
                            <td>Stripe</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>{{ ucfirst($payment->status) }}</td>
                        </tr>
                        <tr>
                            <th>Transaction ID:</th>
                            <td>{{ $payment->payment_intent_id }}</td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                <p>We look forward to welcoming you. If you have any questions, feel free to contact us.</p>
                <p>Best Regards,</p>
            </div>
        </div>
        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 Sinaka Angkor Hotel. All Rights Reserved.</p>
            <a href="#">facebook</a>
            <a href="#">twitter</a>
            <a href="#">instagram</a>
        </div>
    </div>
</body>

</html>

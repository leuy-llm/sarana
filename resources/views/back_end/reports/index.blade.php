<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Statistics Report</title>
</head>
<body>

    <h1>Generate Guest Statistics Report</h1>

    <!-- Date Range Form -->
    <form action="{{ route('report.show') }}" method="GET">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>

        <button type="submit">Generate Report</button>
    </form>

    @if(isset($guestStatistics))
        <h2>Report for the date range: {{ $startDate }} to {{ $endDate }}</h2>

        <!-- Report Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Total Adults</th>
                    <th>Total Children</th>
                    <th>Average Party Size</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $guestStatistics->total_adults }}</td>
                    <td>{{ $guestStatistics->total_children }}</td>
                    <td>{{ number_format($guestStatistics->avg_party_size, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Optional PDF Export -->
        {{-- <a href="{{ route('report.export_pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}">Download PDF Report</a> --}}
    @endif

</body>
</html>

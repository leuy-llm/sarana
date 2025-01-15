@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li> --}}
                    <li class="breadcrumb-item active">
                        {{-- <form method="GET" id="timeRangeForm">
                            <select name="time_range" class="form-select" onchange="document.getElementById('timeRangeForm').submit()">
                                <option value="30" {{ request('time_range') == '30' ? 'selected' : '' }}>Past 30 Days</option>
                                <option value="90" {{ request('time_range') == '90' ? 'selected' : '' }}>Past 90 Days</option>
                                <option value="365" {{ request('time_range') == '365' ? 'selected' : '' }}>Past 1 Year</option>
                                <option value="all" {{ request('time_range') == 'all' ? 'selected' : '' }}>All Time</option>
                            </select>
                        </form> --}}
                        
                    </li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>     


<!-- end page title --> 

@include('layout.total_all')
<!-- end row -->
@include('layout.chart')
<!-- end row-->
@endsection

@section('script')
{{-- <script>
    var roomTypeData = @json($roomTypeBookings);

    const roomTypes = roomTypeData.map(item => item.room_type);
    const bookingsCount = roomTypeData.map(item => item.bookings_count);

    var options = {
        chart: {
            height: 320,
            type: 'pie',
        },
        series: bookingsCount,
        labels: roomTypes,
        colors: ['#727cf5', '#0acf97', '#fa5c7c', '#ffbc00'],
        legend: {
            position: 'bottom'
        },
        tooltip: {
            y: {
                formatter: function(value) {
                    return value + " bookings";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#room-type-chart"), options);
    chart.render();
</script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterOptions = document.querySelectorAll('.filter-option');
        
        filterOptions.forEach(option => {
            option.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');
                
                // Update the URL with the filter and reload the page
                const url = new URL(window.location.href);
                url.searchParams.set('filter', filter);
                window.location.href = url.toString();
            });
        });
    });

    // Prepare chart data from PHP
    const roomTypeData = @json($roomTypeBookings);
    const roomTypes = roomTypeData.map(item => item.room_type);
    const bookingsCount = roomTypeData.map(item => item.bookings_count);

    // Render the chart
    var options = {
        chart: {
            height: 320,
            type: 'pie',
        },
        series: bookingsCount,
        labels: roomTypes,
        colors: ['#727cf5', '#0acf97', '#fa5c7c', '#ffbc00'],
        legend: {
            position: 'bottom'
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return value + " bookings";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#room-type-chart"), options);
    chart.render();
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterOptions = document.querySelectorAll('.filter-option');
        
        filterOptions.forEach(option => {
            option.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');
                
                // Update the URL with the selected filter and reload the page
                const url = new URL(window.location.href);
                url.searchParams.set('filter', filter);
                window.location.href = url.toString();
            });
        });
    });

    // Prepare chart data from PHP
    const roomTypeData = @json($roomTypeBookings);

    // Check if there are any bookings
    if (roomTypeData.length > 0) {
        const roomTypes = roomTypeData.map(item => item.room_type);
        const bookingsCount = roomTypeData.map(item => item.bookings_count);

        // Render the chart if data is available
        var options = {
            chart: {
                height: 320,
                type: 'pie',
            },
            series: bookingsCount,
            labels: roomTypes,
            colors: ['#727cf5', '#0acf97', '#fa5c7c', '#ffbc00','#ffff00','#ff0000'],
            legend: {
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return value + " bookings";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#room-type-chart"), options);
        chart.render();
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Get monthly booking data from the backend
        const monthlyBookings = @json($monthlyBookings);

        // Prepare the data for the line chart
        const categories = Object.keys(monthlyBookings);
        const seriesData = Object.values(monthlyBookings);

        // Line Chart Configuration
        const lineChartOptions = {
            chart: {
                type: 'line',
                height: 350,
                zoom: { enabled: false }
            },
            series: [{
                name: 'Bookings',
                data: seriesData
            }],
            xaxis: {
                categories: categories,
                title: { text: 'Month' }
            },
            yaxis: {
                title: { text: 'Number of Bookings' }
            },
            colors: ['#1f77b4'],
            stroke: { curve: 'smooth' },
            tooltip: {
                y: { formatter: (val) => `${val} bookings` }
            },
            noData: {
                text: 'No bookings available',
                align: 'center',
                verticalAlign: 'middle',
                style: {
                    color: '#ccc',
                    fontSize: '18px'
                }
            }
        };

        const bookingLineChart = new ApexCharts(document.querySelector("#booking-line-chart"), lineChartOptions);
        bookingLineChart.render();
    });
</script>


@endsection
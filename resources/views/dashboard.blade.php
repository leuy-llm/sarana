@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">
                        </li>
                    </ol>
                </div>
                <h4 class="page-title" style="font-family: 'Oswald', sans-serif;font-size: 21px;">Dashboard</h4>
            </div>
        </div>
    </div>
    @include('layout.total_all')
    <!-- end row -->
    @include('layout.chart')
    <!-- end row-->
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterOptions = document.querySelectorAll('.filter-option');

            filterOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');

                    // Update the URL with the selected filter and reload the page
                    const url = new URL(window.location.href);
                    url.searchParams.set('filter', filter);
                    window.location.href = url.toString();
                });
            });
        });

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
                colors: ['#727cf5', '#0acf97', '#fa5c7c', '#ffbc00', '#ffff00', '#ff0000'],
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
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Get monthly booking data from the backend
            const monthlyBookings = @json($monthlyBookings);

            // Prepare the data for the line chart
            const categories = Object.keys(monthlyBookings);
            const seriesData = Object.values(monthlyBookings);

            // Line Chart Configuration
            const lineChartOptions = {
                chart: {
                    type: 'bar',
                    height: 350,
                    zoom: {
                        enabled: false
                    }
                },
                series: [{
                    name: 'Bookings',
                    data: seriesData
                }],
                xaxis: {
                    categories: categories,
                    title: {
                        text: 'Month'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Number of Bookings'
                    }
                },
                colors: ['#1f77b4'],
                stroke: {
                    curve: 'smooth'
                },
                tooltip: {
                    y: {
                        formatter: (val) => `${val} bookings`
                    }
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

            const bookingLineChart = new ApexCharts(document.querySelector("#booking-line-chart"),
            lineChartOptions);
            bookingLineChart.render();

        });
        document.addEventListener("DOMContentLoaded", function() {
            // Occupancy Report
            new Chart(document.getElementById("occupancyChart"), {
                type: "line",
                data: {
                    labels: @json(array_keys($monthlyBookingss)),
                    datasets: [{
                        label: "Total Bookings",
                        data: @json(array_values($monthlyBookingss)),
                        borderColor: "blue",
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            display: false // Hides the x-axis labels (dates)
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            new Chart(document.getElementById("guestStatusChart"), {
                type: "bar",
                data: {
                    labels: @json(array_keys($bookingData)), // Status labels
                    datasets: [{
                        label: "Total Bookings by Status",
                        data: @json(array_values($bookingData)), // Booking count per status
                        backgroundColor: [
                            "orange", // Pending
                            "blue", // Reserved
                            "green", // Checked-In
                            "purple", // Checked-Out
                            "gray", // Completed
                            "red" // Cancelled
                        ]
                    }]
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            let labels = @json(array_keys($bookingSourceData)); // Booking sources
            let dataValues = @json(array_values($bookingSourceData)); // Counts

            console.log("Labels:", labels);
            console.log("Data Values:", dataValues);

            if (labels.length === 0) {
                console.log("No data available for chart.");
                return;
            }

            let ctx = document.getElementById("bookingSourceChart");
            if (!ctx) {
                console.error("Canvas element 'bookingSourceChart' not found!");
                return;
            }

            new Chart(ctx, {
                type: "pie", // You can change to "bar" if preferred
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Bookings by Source",
                        data: dataValues,
                        backgroundColor: ["#ff6384", "#36a2eb"]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
@endsection

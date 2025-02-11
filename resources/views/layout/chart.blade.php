<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="all_time">All
                            Time</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="today">Today</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option"
                            data-filter="yesterday">Yesterday</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="last_week">Last
                            Week</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="last_month">Last
                            Month</a>
                    </div>
                </div>

                <h4 class="header-title mb-1">
                    Popular Room Types - {{ ucfirst(str_replace('_', ' ', $filter)) }}
                </h4>
                <!-- Check if there's any data -->
                @if (count($roomTypeBookings) > 0)
                    <div id="room-type-chart"></div>
                @else
                    <div class="text-center mt-4">
                        <h5>No data available for {{ ucfirst(str_replace('_', ' ', $filter)) }}</h5>
                        <p class="text-muted">No bookings found for the selected time period.</p>
                    </div>
                @endif
                <div id="room-type-chart" class="apex-charts" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    {{-- <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a> --}}
                    {{-- <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Today</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                    </div> --}}
                </div>

                <h4 class="header-title mb-3">Monthly Booking Trend</h4>
                <div dir="ltr">
                    <div id="booking-line-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c"></div>
                </div>

            </div>
            <!-- end card body-->
        </div>
        <!-- end card -->
    </div>


    <!-- Booking Source Analysis -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-1">
                    Booking Source
                </h4>
                <!-- Check if there's any data -->
                @if (count($bookingSourceData) > 0)
                    <div style="height: 400px; overflow: hidden;">
                        <canvas id="guestStatusChart"></canvas>
                    </div>
                @else
                    <div class="text-center mt-4">
                        <h5>No data available </h5>
                        <p class="text-muted">No bookings found for the selected time period.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-1">Booking Source Analysis</h4>
                @if (count($bookingSourceData) > 0)
                    <div style="height: 400px; overflow: hidden;">
                        <canvas id="bookingSourceChart"></canvas>
                    </div>
                @else
                    <div class="text-center mt-4">
                        <h5>No data available</h5>
                        <p class="text-muted">No bookings found for the selected period.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-1">
                    Occupancy Report
                </h4>
                <!-- Check if there's any data -->
                @if(count($occupancyReport) > 0)
                    <canvas id="occupancyChart"></canvas>
                @else
                <div class="text-center mt-4">
                    <h5>No data available </h5>
                    <p class="text-muted">No bookings found for the selected time period.</p>
                </div>
                @endif                
                {{-- <div id="room-type-chart" class="apex-charts" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div> --}}
            </div>
        </div>
    </div>


</div>

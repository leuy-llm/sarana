<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="all_time">All Time</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="today">Today</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="yesterday">Yesterday</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="last_week">Last Week</a>
                        <a href="javascript:void(0);" class="dropdown-item filter-option" data-filter="last_month">Last Month</a>
                    </div>
                </div>

                <h4 class="header-title mb-1">
                    Popular Room Types - {{ ucfirst(str_replace('_', ' ', $filter)) }}
                </h4>
                <!-- Check if there's any data -->
                @if(count($roomTypeBookings) > 0)
                <div id="room-type-chart"></div>
                @else
                <div class="text-center mt-4">
                    <h5>No data available for {{ ucfirst(str_replace('_', ' ', $filter)) }}</h5>
                    <p class="text-muted">No bookings found for the selected time period.</p>
                </div>
                @endif                
                

                {{-- <div id="dash-campaigns-chart" class="apex-charts" data-colors="#ffbc00,#727cf5,#0acf97"></div> --}}
                <div id="room-type-chart" class="apex-charts" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>

                {{-- <div class="row text-center mt-2">
                    <div class="col-md-4">
                        <i class="mdi mdi-send widget-icon rounded-circle bg-light-lighten text-muted"></i>
                        <h3 class="fw-normal mt-3">
                            <span>6,510</span>
                        </h3>
                        <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Total Sent</p>
                    </div>
                    <div class="col-md-4">
                        <i class="mdi mdi-flag-variant widget-icon rounded-circle bg-light-lighten text-muted"></i>
                        <h3 class="fw-normal mt-3">
                            <span>3,487</span>
                        </h3>
                        <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Reached</p>
                    </div>
                    <div class="col-md-4">
                        <i class="mdi mdi-email-open widget-icon rounded-circle bg-light-lighten text-muted"></i>
                        <h3 class="fw-normal mt-3">
                            <span>1,568</span>
                        </h3>
                        <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Opened</p>
                    </div>
                </div> --}}
            </div>
            <!-- end card body-->
        </div>
        <!-- end card -->
    </div>
    <!-- end col-->

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
    <!-- end col-->
</div>
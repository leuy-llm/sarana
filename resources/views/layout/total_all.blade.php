<div class="row">
    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #e64a3b;background:#4f73df;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-white fw-normal mt-0 text-truncate" title="New Leads" style="font-family: 'Oswald', sans-serif;font-size: 17px;">TOTAL GUESTS</h5>
                        <h3 class="my-2 py-1 text-white">{{ $currentGuests }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <i class="mdi mdi-account-group text-warning" style="font-size: 65px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #4f73df;background:#f4c13d;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-white fw-normal mt-0 text-truncate" title="New Leads" style="font-family: 'Oswald', sans-serif;font-size: 17px;">TOTAL USERS</h5>
                        <h3 class="my-2 py-1 text-white">{{ $currentUsers }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <i class="mdi mdi-account-lock" style="font-size: 65px;color:#4f73df; "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #0acf97;background:#e64a3b;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-danger fw-normal text-white mt-0 text-truncate" title="Total Rooms" style="font-family: 'Oswald', sans-serif;font-size: 17px;">TOTAL ROOMS
                        </h5>
                        <h3 class="my-2 py-1 text-white">{{ $currentRooms }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <i class="mdi mdi-bed-king" style="font-size: 65px;color:#0acf97;"></i>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        </div>
    </div>

    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #f4c13d;;background:#0acf97;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class=" fw-normal text-white text-truncate mt-0" title="Total RoomType" style="font-family: 'Oswald', sans-serif;font-size: 17px;">TOTAL ROOMTYPES
                        </h5>
                        <h3 class="my-2 py-1 text-white">{{ $currentRoomTypes }}</h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-sofa" style="font-size: 65px;color:#e64a3b;"></i>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
<div class="row">
    <h4 class="page-title my-3" style="font-family: 'Oswald', sans-serif;font-size: 21px;">Booking Analytics</h4>
    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #FF8911;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="fw-normal mt-0 text-truncate" title="New Leads" style="font-family: 'Oswald', sans-serif;font-size: 17px;">TOTAL BOOKINGS</h5>
                        <h3 class="my-2 py-1">{{ $currentBookings }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <i class="mdi mdi-clipboard-list" style="font-size: 65px;color:#1F2544;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #1F2544;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class="fw-normal text-truncate mt-0 text-uppercase" style="font-family: 'Oswald', sans-serif;font-size: 17px;" title="Checked-In Today">Checked-In
                            Today</h5>
                        <h3 class="my-2 py-1">{{ $checkInsToday }}</h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-login" style="font-size: 65px;color:#1F2544;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #1F2544;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class="fw-normal text-truncate mt-0 text-uppercase" style="font-family: 'Oswald', sans-serif;font-size: 17px;" title="Checked-Out Today">Checked-Out
                            Today</h5>
                        <h3 class="my-2 py-1">{{ $checkOutsToday }}</h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-logout" style="font-size: 65px;color:#1F2544;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #1F2544;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class="fw-normal text-truncate  mt-0 text-uppercase" style="font-family: 'Oswald', sans-serif;font-size: 17px;"  title="Cancelled  Bookings">Guests
                            Currently Staying</h5>
                        <h3 class="my-2 py-1">{{ $guestsStayingToday }}</h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-account-plus" style="font-size: 65px;color:#1F2544;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-1" style="font-family: 'Oswald', sans-serif;font-size: 16px;font-weight: 500" >
                    Booking Status
                </h4>
                <!-- Check if there's any data -->
                @if (count($bookingSourceData) > 0)
                    <div style="height: 370px; overflow: hidden;">
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
                <h4 class="header-title mb-3" style="font-family: 'Oswald', sans-serif;font-size: 16px;font-weight: 500">Monthly Booking Trend</h4>
                <div dir="ltr">
                    <div id="booking-line-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c"></div>
                </div>
            </div>
            <!-- end card body-->
        </div>
        <!-- end card -->
    </div>
</div>
<div class="row">
    {{-- <h4 class="page-title my-3">User, Queries Analytics</h4>
    <div class="col-lg-6 col-xl-3">
        <div class="card" style="border-left: 4px solid #001B79;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class="fw-normal text-truncate text-uppercase mt-0" title="query">Queries</h5>
                        <h3 class="my-2 py-1">{{ $currentQueries }}</h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-comment-question-outline " style="font-size: 65px;color:#a49999"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<div class="row">
    <div class="col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-success fw-normal mt-0 text-truncate" title="New Leads">Total Guests</h5>
                        <h3 class="my-2 py-1 text-success">{{ $currentGuests }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <i class="mdi mdi-calendar-check-outline text-success" style="font-size: 65px"></i>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
    </div> 

    <div class="col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-primary fw-normal mt-0 text-truncate" title="New Leads">Total Users</h5>
                        <h3 class="my-2 py-1 text-primary">{{ $currentUsers }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <i class="mdi mdi-shield-account-outline text-primary" style="font-size: 65px"></i>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </div>

    <div class="col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="text-danger fw-normal text-danger mt-0 text-truncate" title="Total Rooms">Total Rooms
                        </h5>
                        <h3 class="my-2 py-1 text-danger">{{ $currentRooms }}</h3>
                        {{-- <p class="mb-0 text-muted me-2">
                            @if ($guestGrowth >= 0)
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> {{ $guestGrowth }}%</span>
                            @else
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> {{ abs($guestGrowth) }}%</span>
                            @endif
                        </p> --}}
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <i class="mdi mdi-bed-king-outline text-danger" style="font-size: 65px"></i>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        </div>
    </div>

    <div class="col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class=" fw-normal text-warning text-truncate mt-0" title="Total RoomType">Total RoomType
                        </h5>
                        <h3 class="my-2 py-1 text-warning">{{ $currentRoomTypes }}</h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-sofa text-warning" style="font-size: 65px"></i>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">
                        <!-- Combined form for booking and query filters -->
                        <form method="GET" id="bookingForm">
                            <input type="hidden" name="time_ranges" value="{{ request('time_ranges', '30') }}">
                            {{-- <label for="time_range">Booking Time Range:</label> --}}
                            <select name="time_range" class="form-select" onchange="document.getElementById('bookingForm').submit()">
                                <option value="30" {{ request('time_range') == '30' ? 'selected' : '' }}>Past 30 Days</option>
                                <option value="90" {{ request('time_range') == '90' ? 'selected' : '' }}>Past 90 Days</option>
                                <option value="365" {{ request('time_range') == '365' ? 'selected' : '' }}>Past 1 Year</option>
                                <option value="all" {{ request('time_range') == 'all' ? 'selected' : '' }}>All Time</option>
                            </select>
                        </form>
            </li>
            </ol>
        </div>
        <h4 class="page-title">Booking Analytics</h4>
    </div>
</div>
<div class="col-lg-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-7">
                    <h5 class="fw-normal text-primary mt-0" title="Total RoomType">Total Booking</h5>
                    <h3 class="my-2 py-1 text-primary">{{ $currentBookings }}</h3>
                </div>
                <div class="col-5">
                    <div class="text-end">
                        <i class="mdi mdi-clipboard-list text-primary" style="font-size: 65px"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-7">
                    <h5 class="fw-normal text-success  text-truncate    mt-0" title="Confirmed Bookings<">Confirmed
                        Bookings</h5>
                    <h3 class="my-2 py-1 text-success">{{ $confirmedBookings }}</h3>
                </div>
                <div class="col-5">
                    <div class="text-end">
                        <i class="mdi mdi-check-decagram text-success" style="font-size: 65px"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-7">
                    <h5 class="fw-normal text-danger text-truncate mt-0" title="Cancelled  Bookings<">Cancelled
                        Bookings</h5>
                    <h3 class="my-2 py-1 text-danger">{{ $cancelledBookings }}</h3>
                </div>
                <div class="col-5">
                    <div class="text-end">
                        <i class="mdi mdi-alert-circle-outline text-danger" style="font-size: 65px"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-7">
                    <h5 class="fw-normal text-warning text-truncate mt-0" title="Cancelled  Bookings<">Pending Bookings</h5>
                    <h3 class="my-2 py-1 text-warning">{{ $pendingBookings }}</h3>
                </div>
                <div class="col-5">
                    <div class="text-end">
                        <i class="mdi mdi-progress-clock text-warning" style="font-size: 65px"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">
                        <form method="GET" id="queriesForm">
                            <input type="hidden" name="time_range" value="{{ request('time_range', '30') }}">
                            {{-- <label for="time_ranges">Queries & Registrations Time Range:</label> --}}
                            <select name="time_ranges" class="form-select" onchange="document.getElementById('queriesForm').submit()">
                                <option value="30" {{ request('time_ranges') == '30' ? 'selected' : '' }}>Past 30 Days</option>
                                <option value="90" {{ request('time_ranges') == '90' ? 'selected' : '' }}>Past 90 Days</option>
                                <option value="365" {{ request('time_ranges') == '365' ? 'selected' : '' }}>Past 1 Year</option>
                                <option value="all" {{ request('time_ranges') == 'all' ? 'selected' : '' }}>All Time</option>
                            </select>
                        </form>
                    </li>
                </ol>
            </div>
            <h4 class="page-title">User, Queries Analytics</h4>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class="fw-normal text-truncate mt-0" title="Cancelled  Bookings"
                            style="color: rgb(23, 179, 235)">Queries</h5>
                        <h3 class="my-2 py-1 " style="color: rgb(23, 179, 235)">{{ $currentQueries }}</h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-comment-question-outline "
                                style="font-size: 65px;color: rgb(23, 179, 235)"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h5 class="fw-normal text-truncate mt-0" title="Cancelled  Bookings"
                            style="color: rgb(228, 10, 119)">New Registrations</h5>
                        <h3 class="my-2 py-1 " style="color: rgb(228, 10, 119)">{{ $currentNewRegistrations ?? 0 }}
                        </h3>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <i class="mdi mdi-comment-question-outline "
                                style="font-size: 65px;color: rgb(23, 179, 235)"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

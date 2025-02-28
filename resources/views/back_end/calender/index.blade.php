@extends('layout.app')
@section('style')
    <style>
        .font {

            font-size: 10px font - family: 'Hanuman', 'serif' !important;
        }

        .fc-daygrid-day-frame {
            height: 130px;

            padding: 5px;
        }

        .fc-daygrid-day {
            min-height: 130px;

        }

        .fc-event {
            line-height: 1.5;
            padding: 5px;
        }


        .fc-toolbar h2 {
            font-size: 1.5rem;

        }

        .fc-button {
            font-size: 1rem;

            padding: 10px;

        }

        .fc-toolbar-chunk {
            margin-bottom: 10px;

        }

        .tooltip-content {
            position: absolute;
            background-color: #333;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            z-index: 1000;
            font-size: 12px;
            white-space: nowrap;
        }

        .calendar-legend {
            margin-bottom: 10px;
            text-align: center
        }

        .calendar-legend .badge {
            margin-right: 5px;
        }

        .fc-event-title i {
            margin-right: 5px;

            font-size: 14px;

            vertical-align: middle;

        }

        .red {
            background-color: #f8312f;
            color: red;
        }

        hr {
            border: 1px solid;
        }

        .btn-close {
            color: white !important;
        }
        .wide-input {
                width: 100%;
                max-width: 200px; /* Adjust as needed */
            }

    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [['title' => __('label.calender'), 'url' => route('bookings.index')]];
        $currentPageTitle = __('label.calenderList');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <form method="GET" action="{{url('calenders')}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkIn')</label>
                                    <input type="date" name="check_in_date" value="{{ Request::get('    ') }}"
                                        class="form-control" placeholder="@lang('label.date') . . .">
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkOut')</label>
                                    <input type="date" name="check_out_date" value="{{ Request::get('check_out_date') }}"
                                        class="form-control" placeholder="@lang('label.date') . . .">
                                </div>
                            </div>
                        
                          
                            <div class="col-12 text-center">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary wide-input font">
                                        <i class="mdi mdi-filter"></i> @lang('label.search')
                                    </button>
                                    <a href="{{ url('/rooms') }}" class="btn btn-success  wide-input">
                                        <i class="mdi mdi-restore"></i> @lang('label.reset')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                    <form method="GET" action="{{url('calenders')}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkIn')</label>
                                    <input type="date" name="check_in_date" value="{{ Request::get('check_in_date') }}"
                                        class="form-control" placeholder="@lang('label.date') . . .">
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkOut')</label>
                                    <input type="date" name="check_out_date" value="{{ Request::get('check_out_date') }}"
                                        class="form-control" placeholder="@lang('label.date') . . .">
                                </div>
                            </div>
                    
                            <div class="col-12 text-center">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary shadow-none wide-input font">
                                        <i class="mdi mdi-filter"></i> @lang('label.search')
                                    </button>
                                    <a href="{{ url('calenders') }}" class="btn btn-success shadow-none wide-input">
                                        <i class="mdi mdi-restore"></i> @lang('label.reset')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="calendar-legend text-center">
                                <span class="badge bg-danger py-1">Previous</span>
                                <span class="badge bg-success py-1">Current</span>
                            </div>
                            <div class="mt-4 mt-lg-0 ">
                                <div id="calendar" class="font"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" data-bs-backdrop="static" id="bookingDetailsModal" tabindex="-1"
        aria-labelledby="bookingDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-success">
                    <h4 class="modal-title" id="bookingDetailsModalLabel">@lang('label.bookingDetail')</h4>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>@lang('label.guestName') :</strong> <span id="modalGuestName"></span></p>
                    <hr>
                    <p><strong>@lang('label.roomType') :</strong> <span id="modalRoomType"></span></p>
                    <hr>
                    <p><strong>@lang('label.roomNumber') :</strong> <span id="modalRoomNumber"></span></p> <!-- Add this line -->
                    <hr>
                    <p><strong>@lang('label.checkIn') :</strong> <span id="modalCheckInDate"></span></p>
                    <hr>
                    <p><strong>@lang('label.checkOut') :</strong> <span id="modalCheckOutDate"></span></p>
                    <hr>
                    <p><strong>@lang('label.totalAdults') :</strong> <span id="modalTotalAdults"></span></p>
                    <hr>
                    <p><strong>@lang('label.totalChildren') :</strong> <span id="modalTotalChildren"></span></p>
                    <hr>
                    <p><strong>@lang('label.bookingSource') :</strong> <span id="modalBookingSource"></span></p>
                    <hr>

                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn text-white btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";

            function CalendarApp() {
                this.$calendar = $("#calendar");
                this.$calendarObj = null;
            }

            CalendarApp.prototype.onEventClick = function(event) {
                document.getElementById("modalGuestName").innerText = event.extendedProps.guestName;
                document.getElementById("modalRoomType").innerText = event.extendedProps.roomTypeName;
                document.getElementById("modalRoomNumber").innerText = event.extendedProps.roomNumber;
                document.getElementById("modalTotalAdults").innerText = event.extendedProps.total_adults;
                document.getElementById("modalTotalChildren").innerText = event.extendedProps.total_children;
                document.getElementById("modalCheckInDate").innerText = event.start.toLocaleDateString();
                document.getElementById("modalCheckOutDate").innerText = event.end.toLocaleDateString();

                // Set booking source in modal
                document.getElementById("modalBookingSource").innerText = event.extendedProps.bookingSource;

                const modalHeader = document.querySelector('#bookingDetailsModal .modal-header');
                modalHeader.className = event.classNames.includes('bg-danger') ?
                    'modal-header text-white bg-danger' :
                    event.classNames.includes('bg-warning') ?
                    'modal-header text-white bg-warning' // Change color for walk-in bookings
                    :
                    'modal-header text-white bg-success';

                const modal = new bootstrap.Modal(document.getElementById('bookingDetailsModal'));
                modal.show();
            };

            CalendarApp.prototype.onEventMouseEnter = function(info) {
                const tooltipContent = `
                    <div>
                        <strong>Guest:</strong> ${info.event.extendedProps.guestName}<br>
                        <strong>Room Type:</strong> ${info.event.extendedProps.roomTypeName}<br>
                        <strong>Total Adults:</strong> ${info.event.extendedProps.total_adults}<br>
                        <strong>Total Children:</strong> ${info.event.extendedProps.total_children}
                    </div>
                    `;

                const tooltip = $('<div class="tooltip-content"></div>').html(tooltipContent).appendTo('body');

                $(info.el).on('mousemove', function(e) {
                    tooltip.css({
                        top: e.pageY + 10 + 'px',
                        left: e.pageX + 10 + 'px'
                    });
                });
            };

            CalendarApp.prototype.onEventMouseLeave = function(info) {
                $('.tooltip-content').remove();
            };

            CalendarApp.prototype.init = function(bookings) {
                const events = bookings.map(booking => {
                    const guestName = booking.guest ? booking.guest.first_name + ' ' + booking.guest
                        .last_name : 'Unknown Guest';

                    // Since booking.rooms is a collection, extract room details
                    const roomDetails = booking.rooms.map(room => {
                        return {
                            roomTypeName: room.room_type ? room.room_type.type_name :
                                'Unknown Room Type',
                            roomNumber: room.room_number || 'N/A',
                            totalAdults: room.pivot ? room.pivot.total_adults : 0, // Get from pivot
                            totalChildren: room.pivot ? room.pivot.total_children :
                                0 // Get from pivot
                        };
                    });
                    // If multiple rooms exist, join their details into a single string
                    const roomTypeNames = roomDetails.map(r => r.roomTypeName).join(', ') ||
                        'Unknown Room Type';
                    const roomNumbers = roomDetails.map(r => r.roomNumber).join(', ') || 'N/A';
                    const totalAdults = roomDetails.reduce((sum, r) => sum + r.totalAdults, 0);
                    const totalChildren = roomDetails.reduce((sum, r) => sum + r.totalChildren, 0);
                    const bookingSource = booking.booking_source || 'Unknown';
                    // Determine booking type color
                    let eventClassName = 'bg-success border-0'; // Default for current bookings
                    if (new Date(booking.check_out_date) < new Date()) {
                        eventClassName = 'bg-danger border-0'; // Mark previous bookings
                    } else if (bookingSource === 'walk-in') {
                        eventClassName = 'bg-warning border-0'; // Different color for walk-in
                    }

                    return {
                        title: `${guestName} - ${roomTypeNames} (${bookingSource})`,
                        start: booking.check_in_date,
                        end: booking.check_out_date,
                        className: eventClassName,
                        extendedProps: {
                            guestName: guestName,
                            roomTypeName: roomTypeNames,
                            roomNumber: roomNumbers,
                            total_adults: totalAdults,
                            total_children: totalChildren,
                            bookingSource: bookingSource,
                        }
                    };
                });

                this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
                    initialView: "dayGridMonth",
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                    },
                    events: events,
                    editable: false,
                    selectable: true,
                    eventClick: (info) => {
                        this.onEventClick(info.event);
                    },
                    eventContent: function(arg) {
                        return {
                            html: `<div>
                    <i class="mdi mdi-lock-check-outline text-white"></i> 
                    ${arg.event.title}
                </div>`
                        };
                    }
                });
                this.$calendarObj.render();
            };

            // Initialize the app with booking data
            $(document).ready(function() {
                const bookings = @json($bookings); // Pass Laravel bookings data to JavaScript
                const calendarApp = new CalendarApp();
                calendarApp.init(bookings);
            });

        })(window.jQuery);
    </script>
@endsection

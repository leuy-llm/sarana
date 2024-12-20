@extends('layout.app')
@section('style')
    <style>
        .font {
            /* font-weight: 200; */
            /* font-family: 'Courier New', Courier, monospace; */
            font-size: 10px font - family: 'Hanuman', 'serif' !important;
        }

        /* Make the calendar cells taller */
        .fc-daygrid-day-frame {
            height: 130px;
            /* Increase this value to make the cells taller */
            padding: 5px;
            /* Adjust padding to control the space inside the cells */
        }

        .fc-daygrid-day {
            min-height: 130px;
            /* Ensure the minimum height of day cells is consistent */
        }

        /* Adjust the height of events within the cells */
        .fc-event {
            line-height: 1.5;
            /* Adjust line-height to ensure the event text fits well */
            padding: 5px;
            /* Adjust padding to add more space around event text */
        }

        /* Adjust the header and title sizes if needed */
        .fc-toolbar h2 {
            font-size: 1.5rem;
            /* Adjust the title size */
        }

        .fc-button {
            font-size: 1rem;
            /* Adjust the button text size */
            padding: 10px;
            /* Add padding to buttons */
        }

        .fc-toolbar-chunk {
            margin-bottom: 10px;
            /* Add space between toolbar elements */
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
            /* Add spacing between the icon and text */
            font-size: 14px;
            /* Adjust the icon size */
            vertical-align: middle;
            /* Align icon vertically */
        }

        .red {
            background-color: #f8312f;
            color: red;
        }

        hr {
            border: 1px solid;
        }
        .btn-close{
            color: white !important;
        }
    </style>
@endsection
@section('content')
    <!-- start page title -->
    @php
        $breadcrumbs = [['title' => __('label.calender'), 'url' => route('bookings.index')]];
        $currentPageTitle = __('label.calenderList');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="calendar-legend text-center">
                                {{-- <span class="badge bg-warning">Pending</span> --}}
                                <span class="badge bg-danger py-1">Previous</span>
                                <span class="badge bg-success py-1">Current</span>
                            </div>
                            <div class="mt-4 mt-lg-0 ">
                                <!-- Legend placed here -->

                                <div id="calendar" class="font"></div>

                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div> <!-- end row -->

    <!-- Booking Details Modal -->
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
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn text-white btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/scheduler@5.11.3/main.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-timeline@5.11.3/main.min.js"></script> --}}
    <script>
        (function($) {
            "use strict";

            function CalendarApp() {
                this.$calendar = $("#calendar");
                this.$calendarObj = null;
            }

            // CalendarApp.prototype.onEventClick = function(info) {
            //     // Populate modal with event details
            //     $('#modalGuestName').text(info.event.extendedProps.guestName);
            //     $('#modalRoomType').text(info.event.extendedProps.roomTypeName);
            //     $('#modalCheckInDate').text(info.event.start.toISOString().split('T')[0]); // Format start date
            //     $('#modalCheckOutDate').text(info.event.end ? info.event.end.toISOString().split('T')[0] :
            //     'N/A'); // Format end date
            //     $('#modalTotalAdults').text(info.event.extendedProps.total_adults);
            //     $('#modalTotalChildren').text(info.event.extendedProps.total_children);

            //     // Show the modal
            //     $('#bookingDetailsModal').modal('show');
            // };


            CalendarApp.prototype.onEventClick = function(event) {
                // Populate modal fields
                document.getElementById("modalGuestName").innerText = event.extendedProps.guestName;
                document.getElementById("modalRoomType").innerText = event.extendedProps.roomTypeName;
                document.getElementById("modalRoomNumber").innerText = event.extendedProps
                    .roomNumber; // Add room number here
                document.getElementById("modalTotalAdults").innerText = event.extendedProps.total_adults;
                document.getElementById("modalTotalChildren").innerText = event.extendedProps.total_children;
                document.getElementById("modalCheckInDate").innerText = event.start.toLocaleDateString();
                document.getElementById("modalCheckOutDate").innerText = event.end.toLocaleDateString();

                // Get modal header and set color dynamically
                const modalHeader = document.querySelector('#bookingDetailsModal .modal-header');
                if (event.classNames.includes('bg-danger')) {
                    modalHeader.className = 'modal-header text-white bg-danger';
                } else {
                    modalHeader.className = 'modal-header text-white bg-success';
                }

                // Show the modal
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

            // CalendarApp.prototype.init = function(bookings) {
            //     const events = bookings.map(booking => {
            //         const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
            //         const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type
            //             .type_name : 'Unknown Room Type';
            //         const totalAdults = booking.total_adults || 0;
            //         const totalChildren = booking.total_children || 0;

            //         // Determine if the booking is past the check-out date
            //         const today = new Date();
            //         const checkOutDate = new Date(booking.check_out_date);
            //         const eventClassName = checkOutDate < today ? 'bg-danger border-0' :
            //             'bg-success border-0';

            //         return {
            //             title: `${guestName} - ${roomTypeName}`, // Plain text title
            //             start: booking.check_in_date,
            //             end: booking.check_out_date,
            //             className: eventClassName,
            //             extendedProps: {
            //                 guestName: guestName,
            //                 roomTypeName: roomTypeName,
            //                 total_adults: totalAdults,
            //                 total_children: totalChildren,
            //             }
            //         };
            //     });

            //     // Initialize the calendar with event content customization
            //     this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
            //         initialView: "dayGridMonth",
            //         headerToolbar: {
            //             left: "prev,next today",
            //             center: "title",
            //             right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            //         },
            //         events: events,
            //         editable: false,
            //         selectable: true,
            //         eventColor: "#3786D6",
            //         eventLimit: true,
            //         eventClick: (event) => this.onEventClick(event),
            //         eventMouseEnter: (info) => this.onEventMouseEnter(info),
            //         eventMouseLeave: (info) => this.onEventMouseLeave(info),
            //         eventContent: function(arg) {
            //             // Custom event content with icon
            //             return {
            //                 html: `<div>
        //             <i class="mdi mdi-lock-check-outline text-white text-left"></i> 
        //             ${arg.event.title}
        //            </div>`
            //             };
            //         }
            //     });
            //     this.$calendarObj.render();
            // };


            CalendarApp.prototype.init = function(bookings) {
                const events = bookings.map(booking => {
                    const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
                    const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type
                        .type_name : 'Unknown Room Type';
                    const roomNumber = booking.room ? booking.room.room_number : 'N/A'; // Fetch room_number
                    const totalAdults = booking.total_adults || 0;
                    const totalChildren = booking.total_children || 0;

                    // Determine if the booking is past the check-out date
                    const today = new Date();
                    const checkOutDate = new Date(booking.check_out_date);
                    const eventClassName = checkOutDate < today ? 'bg-danger border-0' :
                        'bg-success border-0';

                    return {
                        title: `${guestName} - ${roomTypeName}`,
                        start: booking.check_in_date,
                        end: booking.check_out_date,
                        className: eventClassName, // Pass event color class
                        extendedProps: {
                            guestName: guestName,
                            roomTypeName: roomTypeName,
                            roomNumber: roomNumber, // Add room_number here
                            total_adults: totalAdults,
                            total_children: totalChildren,
                            isExpired: checkOutDate < today, // Flag for expired bookings
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
                    eventColor: "#3786D6",
                    eventLimit: true,
                    eventClick: (info) => {
                        this.onEventClick(info.event); // Pass the clicked event
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

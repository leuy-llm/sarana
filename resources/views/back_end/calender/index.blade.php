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
    </style>
@endsection
@section('content')
    <!-- start page title -->
    @php
        $breadcrumbs = [['title' => __('label.guests'), 'url' => route('guests.index')]];
        $currentPageTitle = __('label.guestList');
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
                        <div class="col-lg-2">
                            <div class="d-grid">
                                <button class="btn btn-lg font-16 btn-danger" id="btn-new-event">
                                    Status Indicators</button>
                            </div>
                            <div id="external-events" class="m-t-20">
                                <br>
                                <p class="text-muted">These are the notes for booking</p>
                                <div class="external-event bg-success-lighten text-success " style="font-size: 12px"
                                    data-class="bg-success">
                                    <i class="mdi mdi-checkbox-blank-circle vertical-middle"></i>
                                    Reservation confirmed
                                </div>

                                <div class="external-event bg-warning-lighten text-warning" style="font-size: 12px"
                                    data-class="bg-warning">
                                    <i class="mdi mdi-checkbox-blank-circle  vertical-middle"></i>
                                    Reservation pending
                                </div>
                                <div class="external-event bg-danger-lighten text-danger" style="font-size: 12px"
                                    data-class="bg-danger">
                                    <i class="mdi mdi-checkbox-blank-circle vertical-middle"></i>
                                    Reservation canceled
                                </div>
                                <div class="external-event bg-secondary-lighten  text-secondary " style="font-size: 12px"
                                    data-class="bg-secodary">
                                    <i class="mdi mdi-checkbox-blank-circle vertical-middle"></i>
                                    Reservation in the past
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-10 ">
                            <div class="mt-4 mt-lg-0 ">
                                <!-- Legend placed here -->

                                <div id="calendar" class="font"></div>
                                <div class="calendar-legend mt-3">
                                    <span class="badge bg-warning">Pending</span>
                                    <span class="badge bg-success">Confirmed</span>
                                    <span class="badge bg-danger">Canceled</span>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div> <!-- end row -->

    <!-- Booking Details Modal -->
    <div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="bookingDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light ">
                    <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close " style="color: red" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Guest:</strong> <span id="modalGuestName"></span></p>
                    <p><strong>Room Type:</strong> <span id="modalRoomType"></span></p>
                    <p><strong>Check-in Date:</strong> <span id="modalCheckInDate"></span></p>
                    <p><strong>Check-out Date:</strong> <span id="modalCheckOutDate"></span></p>
                    <p><strong>Total Adults:</strong> <span id="modalTotalAdults"></span></p>
                    <p><strong>Total Children:</strong> <span id="modalTotalChildren"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        //     (function($) {
        //     "use strict";

        //     function CalendarApp() {
        //         this.$calendar = $("#calendar");
        //         this.$calendarObj = null;
        //     }

        //     CalendarApp.prototype.onEventClick = function(event) {
        //         alert("Event: " + event.event.title);
        //         // Handle your event click logic here
        //     };

        //     CalendarApp.prototype.init = function(bookings) {


        //         const events = bookings.map(booking => {
        //             const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
        //             const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type.type_name : 'Unknown Room Type';
        //             const totalAdults = booking.total_adults || 0;
        //             const totalChildren = booking.total_children || 0;

        //             return {
        //                 title: `${guestName} - ${roomTypeName} - Adults: ${totalAdults}, Children: ${totalChildren}`,
        //                 start: booking.check_in_date,
        //                 end: booking.check_out_date,
        //                 className: 'bg-info',
        //                 extendedProps: {
        //                     total_adults: totalAdults,
        //                     total_children: totalChildren
        //                 }
        //             };
        //         });
        //         // Initialize the calendar
        //         this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
        //             initialView: "dayGridMonth",
        //             headerToolbar: {
        //                 left: "prev,next today",
        //                 center: "title",
        //                 right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        //             },
        //             events: events, // Use the transformed bookings as events
        //             editable: true,
        //             selectable: true,
        //             eventClick: (event) => this.onEventClick(event)
        //         });

        //         this.$calendarObj.render();
        //     };

        //     // Initialize the app with booking data
        //     $(document).ready(function() {
        //         const bookings = @json($bookings); // Pass Laravel bookings data to JavaScript
        //         const calendarApp = new CalendarApp();
        //         calendarApp.init(bookings);
        //     });

        // })(window.jQuery);
        // (function($) {
        //     "use strict";

        //     function CalendarApp() {
        //         this.$calendar = $("#calendar");
        //         this.$calendarObj = null;
        //     }

        //     CalendarApp.prototype.onEventClick = function(event) {
        //         alert("Event: " + event.event.title);
        //     };

        //     CalendarApp.prototype.init = function(bookings) {
        //         // Map the bookings data to FullCalendar event format
        //         const events = bookings.map(booking => {
        //             const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
        //             const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type.type_name : 'Unknown Room Type';
        //             const totalAdults = booking.total_adults || 0;
        //             const totalChildren = booking.total_children || 0;

        //             // Determine if the booking is past the check-out date
        //             const today = new Date();
        //             const checkOutDate = new Date(booking.check_out_date);
        //             const eventClassName = checkOutDate < today ? 'bg-danger' : 'bg-info';

        //             return {
        //                 title: `${guestName} - ${roomTypeName} - Adults: ${totalAdults}, Children: ${totalChildren}`,
        //                 start: booking.check_in_date,
        //                 end: booking.check_out_date,
        //                 className: eventClassName, // Use the determined class name
        //                 extendedProps: {
        //                     total_adults: totalAdults,
        //                     total_children: totalChildren
        //                 }
        //             };
        //         });

        //         // Initialize the calendar
        //         this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
        //             initialView: "dayGridMonth",
        //             headerToolbar: {
        //                 left: "prev,next today",
        //                 center: "title",
        //                 right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        //             },
        //             events: events, 
        //             editable: true,
        //             selectable: true,
        //             eventClick: (event) => this.onEventClick(event)
        //         });

        //         this.$calendarObj.render();
        //     };

        //     // Initialize the app with booking data
        //     $(document).ready(function() {
        //         const bookings = @json($bookings); // Pass Laravel bookings data to JavaScript
        //         const calendarApp = new CalendarApp();
        //         calendarApp.init(bookings);
        //     });

        // })(window.jQuery);

        // (function($) {
        //     "use strict";

        //     function CalendarApp() {
        //         this.$calendar = $("#calendar");
        //         this.$calendarObj = null;
        //     }

        //     CalendarApp.prototype.onEventClick = function(event) {
        //         alert("Event: " + event.event.title);
        //     };

        //     CalendarApp.prototype.onEventMouseEnter = function(info) {
        //         const tooltipContent = `
    //             <div>
    //                 <strong>Guest:</strong> ${info.event.extendedProps.guestName}<br>
    //                 <strong>Room Type:</strong> ${info.event.extendedProps.roomTypeName}<br>
    //                 <strong>Total Adults:</strong> ${info.event.extendedProps.total_adults}<br>
    //                 <strong>Total Children:</strong> ${info.event.extendedProps.total_children}
    //             </div>
    //         `;

        //         const tooltip = $('<div class="tooltip-content"></div>').html(tooltipContent).appendTo('body');

        //         $(info.el).on('mousemove', function(e) {
        //             tooltip.css({
        //                 top: e.pageY + 10 + 'px',
        //                 left: e.pageX + 10 + 'px'
        //             });
        //         });
        //     };

        //     CalendarApp.prototype.onEventMouseLeave = function(info) {
        //         $('.tooltip-content').remove();
        //     };

        //     CalendarApp.prototype.init = function(bookings) {
        //         // Map the bookings data to FullCalendar event format
        //         const events = bookings.map(booking => {
        //             const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
        //             const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type.type_name : 'Unknown Room Type';
        //             const totalAdults = booking.total_adults || 0;
        //             const totalChildren = booking.total_children || 0;

        //             // Determine if the booking is past the check-out date
        //             const today = new Date();
        //             const checkOutDate = new Date(booking.check_out_date);
        //             const eventClassName = checkOutDate < today ? 'bg-danger' : 'bg-info';

        //             return {
        //                 title: `${guestName} - ${roomTypeName} - Adults: ${totalAdults}, Children: ${totalChildren}`,
        //                 start: booking.check_in_date,
        //                 end: booking.check_out_date,
        //                 className: eventClassName, // Use the determined class name
        //                 extendedProps: {
        //                     guestName: guestName,
        //                     roomTypeName: roomTypeName,
        //                     total_adults: totalAdults,
        //                     total_children: totalChildren
        //                 }
        //             };
        //         });

        //         // Initialize the calendar
        //         this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
        //             initialView: "dayGridMonth",
        //             headerToolbar: {
        //                 left: "prev,next today",
        //                 center: "title",
        //                 right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        //             },
        //             events: events, 
        //             editable: true,
        //             selectable: true,
        //             eventClick: (event) => this.onEventClick(event),
        //             eventMouseEnter: (info) => this.onEventMouseEnter(info),
        //             eventMouseLeave: (info) => this.onEventMouseLeave(info)
        //         });

        //         this.$calendarObj.render();
        //     };

        //     // Initialize the app with booking data
        //     $(document).ready(function() {
        //         const bookings = @json($bookings); // Pass Laravel bookings data to JavaScript
        //         const calendarApp = new CalendarApp();
        //         calendarApp.init(bookings);
        //     });

        // })(window.jQuery);

        // (function($) {
        //     "use strict";

        //     function CalendarApp() {
        //         this.$calendar = $("#calendar");
        //         this.$calendarObj = null;
        //     }

        //     CalendarApp.prototype.onEventClick = function(event) {
        //         alert("Event: " + event.event.title);
        //     };

        // CalendarApp.prototype.onEventMouseEnter = function(info) {
        //     const tooltipContent = `
    //     <div>
    //         <strong>Guest:</strong> ${info.event.extendedProps.guestName}<br>
    //         <strong>Room Type:</strong> ${info.event.extendedProps.roomTypeName}<br>
    //         <strong>Total Adults:</strong> ${info.event.extendedProps.total_adults}<br>
    //         <strong>Total Children:</strong> ${info.event.extendedProps.total_children}
    //     </div>
    // `;

        //     const tooltip = $('<div class="tooltip-content"></div>').html(tooltipContent).appendTo('body');

        //     $(info.el).on('mousemove', function(e) {
        //         // Position the tooltip above the mouse cursor
        //         const tooltipHeight = tooltip.outerHeight();
        //         tooltip.css({
        //             top: e.pageY - tooltipHeight - 10 + 'px', // Adjust the -10 for some padding
        //             left: e.pageX + 10 + 'px' // Adjust the +10 for some padding
        //         });
        //     });
        // };

        // CalendarApp.prototype.onEventMouseLeave = function(info) {
        //     $('.tooltip-content').remove();
        // };

        //     CalendarApp.prototype.init = function(bookings) {
        //         // Map the bookings data to FullCalendar event format
        //         const events = bookings.map(booking => {
        //             const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
        //             const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type.type_name : 'Unknown Room Type';
        //             const totalAdults = booking.total_adults || 0;
        //             const totalChildren = booking.total_children || 0;

        //             // Determine if the booking is past the check-out date
        //             const today = new Date();
        //             const checkOutDate = new Date(booking.check_out_date);
        //             const eventClassName = checkOutDate < today ? 'bg-danger' : 'bg-info';

        //             return {
        //                 title: `${guestName} - ${roomTypeName} - Adults: ${totalAdults}, Children: ${totalChildren}`,
        //                 start: booking.check_in_date,
        //                 end: booking.check_out_date,
        //                 className: eventClassName, // Use the determined class name
        //                 extendedProps: {
        //                     guestName: guestName,
        //                     roomTypeName: roomTypeName,
        //                     total_adults: totalAdults,
        //                     total_children: totalChildren
        //                 }
        //             };
        //         });

        //         // Initialize the calendar
        //         this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
        //             initialView: "dayGridMonth",
        //             headerToolbar: {
        //                 left: "prev,next today",
        //                 center: "title",
        //                 right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        //             },
        //             events: events, 
        //             editable: true,
        //             selectable: true,
        //             eventClick: (event) => this.onEventClick(event),
        //             eventMouseEnter: (info) => this.onEventMouseEnter(info),
        //             eventMouseLeave: (info) => this.onEventMouseLeave(info)
        //         });

        //         this.$calendarObj.render();
        //     };

        //     // Initialize the app with booking data
        //     $(document).ready(function() {
        //         const bookings = @json($bookings); // Pass Laravel bookings data to JavaScript
        //         const calendarApp = new CalendarApp();
        //         calendarApp.init(bookings);
        //     });

        // })(window.jQuery);
        // (function($) {
        //     "use strict";

        //     function CalendarApp() {
        //         this.$calendar = $("#calendar");
        //         this.$calendarObj = null;
        //     }

        //     CalendarApp.prototype.onEventClick = function(info) {
        //         // Populate the modal with booking data
        //         $('#modalGuestName').text(info.event.extendedProps.guestName);
        //         $('#modalRoomType').text(info.event.extendedProps.roomTypeName);
        //         $('#modalCheckInDate').text(info.event.start.toISOString().substring(0, 10));
        //         $('#modalCheckOutDate').text(info.event.end.toISOString().substring(0, 10));
        //         $('#modalTotalAdults').text(info.event.extendedProps.total_adults);
        //         $('#modalTotalChildren').text(info.event.extendedProps.total_children);

        //         // Open the modal
        //         $('#bookingDetailsModal').modal('show');
        //     };
        //     CalendarApp.prototype.onEventMouseEnter = function(info) {
        //         const tooltipContent = `
        //         <div>
        //             <strong>Guest:</strong> ${info.event.extendedProps.guestName}<br>
        //             <strong>Room Type:</strong> ${info.event.extendedProps.roomTypeName}<br>
        //             <strong>Total Adults:</strong> ${info.event.extendedProps.total_adults}<br>
        //             <strong>Total Children:</strong> ${info.event.extendedProps.total_children}
        //         </div>
        //     `;

        //         const tooltip = $('<div class="tooltip-content"></div>').html(tooltipContent).appendTo('body');

        //         $(info.el).on('mousemove', function(e) {
        //             // Position the tooltip above the mouse cursor
        //             const tooltipHeight = tooltip.outerHeight();
        //             tooltip.css({
        //                 top: e.pageY - tooltipHeight - 10 + 'px', // Adjust the -10 for some padding
        //                 left: e.pageX + 10 + 'px' // Adjust the +10 for some padding
        //             });
        //         });
        //     };

        //     CalendarApp.prototype.onEventMouseLeave = function(info) {
        //         $('.tooltip-content').remove();
        //     };

        //     CalendarApp.prototype.init = function(bookings) {
        //         // Map the bookings data to FullCalendar event format
        //         const events = bookings.map(booking => {
        //             const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
        //             const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type
        //                 .type_name : 'Unknown Room Type';
        //             const totalAdults = booking.total_adults || 0;
        //             const totalChildren = booking.total_children || 0;

        //             let eventClassName;
        //             const today = new Date();
        //             const checkOutDate = new Date(booking.check_out_date);

        //             if (checkOutDate < today) {
        //                 eventClassName =
        //                     'bg-secondary border-0'; // Past check-out date (changed from bg-danger to bg-secondary)
        //             } else {
        //                 switch (booking.status) {
        //                     case 'pending':
        //                         eventClassName = 'bg-warning border-0';
        //                         break;
        //                     case 'confirmed':
        //                         eventClassName = 'bg-success border-0';
        //                         break;
        //                     case 'canceled':
        //                         eventClassName = 'bg-danger border-0';
        //                         break;
        //                     default:
        //                         eventClassName =
        //                             'bg-info border-0'; // Default class for ongoing or future bookings
        //                 }
        //             }

        //             return {
        //                 title: `${guestName} - ${roomTypeName} - Adults: ${totalAdults}, Children: ${totalChildren}`,
        //                 start: booking.check_in_date,
        //                 end: booking.check_out_date,
        //                 className: eventClassName, // Use the determined class name
        //                 extendedProps: {
        //                     guestName: guestName,
        //                     roomTypeName: roomTypeName,
        //                     total_adults: totalAdults,
        //                     total_children: totalChildren,
        //                     status: booking.status
        //                 }
        //             };
        //         });

        //         // Initialize the calendar
        //         this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
        //             initialView: "dayGridMonth",
        //             headerToolbar: {
        //                 left: "prev,next today",
        //                 center: "title",
        //                 right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        //             },
        //             events: events,
        //             editable: false,
        //             selectable: false,
        //             eventClick: (info) => this.onEventClick(info),
        //             eventMouseEnter: (info) => this.onEventMouseEnter(info),
        //             eventMouseLeave: (info) => this.onEventMouseLeave(info)
        //         });

        //         this.$calendarObj.render();
        //     };

        //     // Initialize the app with booking data
        //     $(document).ready(function() {
        //         const bookings = @json($bookings); // Pass Laravel bookings data to JavaScript
        //         const calendarApp = new CalendarApp();
        //         calendarApp.init(bookings);
        //     });

        // })(window.jQuery);

        (function($) {
    "use strict";

    function CalendarApp() {
        this.$calendar = $("#calendar");
        this.$calendarObj = null;
    }

    CalendarApp.prototype.onEventClick = function(info) {
        // Format the dates using moment.js
        const formattedCheckInDate = moment(info.event.start).format('DD-MM-YYYY');
        const formattedCheckOutDate = moment(info.event.end).format('DD-MM-YYYY');

        // Populate the modal with booking data
        $('#modalGuestName').text(info.event.extendedProps.guestName);
        $('#modalRoomType').text(info.event.extendedProps.roomTypeName);
        $('#modalCheckInDate').text(formattedCheckInDate);
        $('#modalCheckOutDate').text(formattedCheckOutDate);
        $('#modalTotalAdults').text(info.event.extendedProps.total_adults);
        $('#modalTotalChildren').text(info.event.extendedProps.total_children);

        // Open the modal
        $('#bookingDetailsModal').modal('show');
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
            // Position the tooltip above the mouse cursor
            const tooltipHeight = tooltip.outerHeight();
            tooltip.css({
                top: e.pageY - tooltipHeight - 10 + 'px', // Adjust the -10 for some padding
                left: e.pageX + 10 + 'px' // Adjust the +10 for some padding
            });
        });
    };

    CalendarApp.prototype.onEventMouseLeave = function(info) {
        $('.tooltip-content').remove();
    };

    CalendarApp.prototype.init = function(bookings) {
        // Map the bookings data to FullCalendar event format
        const events = bookings.map(booking => {
            const guestName = booking.guest ? booking.guest.name : 'Unknown Guest';
            const roomTypeName = booking.room && booking.room.room_type ? booking.room.room_type.type_name : 'Unknown Room Type';
            const totalAdults = booking.total_adults || 0;
            const totalChildren = booking.total_children || 0;

            let eventClassName;
            const today = new Date();
            const checkOutDate = new Date(booking.check_out_date);

            if (checkOutDate < today) {
                eventClassName = 'bg-secondary border-0'; // Past check-out date
            } else {
                switch (booking.status) {
                    case 'pending':
                        eventClassName = 'bg-warning border-0';
                        break;
                    case 'confirmed':
                        eventClassName = 'bg-success border-0';
                        break;
                    case 'canceled':
                        eventClassName = 'bg-danger border-0';
                        break;
                    default:
                        eventClassName = 'bg-info border-0'; // Default class for ongoing or future bookings
                }
            }

            return {
                title: `${guestName} - ${roomTypeName} - Adults: ${totalAdults}, Children: ${totalChildren}`,
                start: booking.check_in_date,
                end: booking.check_out_date,
                className: eventClassName, // Use the determined class name
                extendedProps: {
                    guestName: guestName,
                    roomTypeName: roomTypeName,
                    total_adults: totalAdults,
                    total_children: totalChildren,
                    status: booking.status
                }
            };
        });

        // Initialize the calendar
        this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
            initialView: "dayGridMonth",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            },
            events: events,
            editable: false,
            selectable: false,
            eventClick: (info) => this.onEventClick(info),
            eventMouseEnter: (info) => this.onEventMouseEnter(info),
            eventMouseLeave: (info) => this.onEventMouseLeave(info)
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

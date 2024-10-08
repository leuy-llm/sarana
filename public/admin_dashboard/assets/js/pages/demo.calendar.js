// (function($) {
//     "use strict";

//     function CalendarApp() {
//         this.$body = $("body");
//         this.$calendar = $("#calendar");
//         this.$calendarObj = null;
//         this.$selectedEvent = null;
//         this.$newEventData = null;
//     }

//     CalendarApp.prototype.onEventClick = function(event) {
//         alert("Event: " + event.event.title);
//         // Handle your event click logic here
//     };

//     CalendarApp.prototype.onSelect = function(info) {
//         const eventTitle = prompt("Enter Event Title:");
//         if (eventTitle) {
//             this.$calendarObj.addEvent({
//                 title: eventTitle,
//                 start: info.start,
//                 end: info.end,
//                 allDay: info.allDay
//             });
//         }
//         this.$calendarObj.unselect();
//     };

//     CalendarApp.prototype.init = function() {
//         const today = new Date($.now());

//         // Initialize the calendar
//         this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
//             slotDuration: "00:15:00", // 15 min slots
//             slotMinTime: "08:00:00",
//             slotMaxTime: "19:00:00",
//             themeSystem: "bootstrap",
//             bootstrapFontAwesome: false,
//             buttonText: {
//                 today: "Today",
//                 month: "Month",
//                 week: "Week",
//                 day: "Day",
//                 list: "List",
//                 prev: "Prev",
//                 next: "Next"
//             },
//             initialView: "dayGridMonth",
//             handleWindowResize: true,
//             height: $(window).height() - 200,
//             headerToolbar: {
//                 left: "prev,next today",
//                 center: "title",
//                 right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
//             },
//             initialEvents: [
//                 {
//                     title: "Meeting with Mr. Shreyu",
//                     start: new Date($.now() + 158e6),
//                     end: new Date($.now() + 338e6),
//                     className: "bg-warning"
//                 },
//                 {
//                     title: "Interview - Backend Engineer",
//                     start: today,
//                     end: today,
//                     className: "bg-success"
//                 },
//                 {
//                     title: "Phone Screen - Frontend Engineer",
//                     start: new Date($.now() + 168e6),
//                     className: "bg-info"
//                 },
//                 {
//                     title: "Buy Design Assets",
//                     start: new Date($.now() + 338e6),
//                     end: new Date($.now() + 4056e5),
//                     className: "bg-primary"
//                 }
//             ],
//             editable: true,
//             droppable: false,
//             selectable: true,
//             dateClick: (info) => this.onSelect(info),
//             eventClick: (event) => this.onEventClick(event)
//         });

//         this.$calendarObj.render();
//     };

//     // Initialize the app
//     $.CalendarApp = new CalendarApp();
//     $.CalendarApp.init();

// })(window.jQuery);
(function($) {
    "use strict";

    function CalendarApp() {
        this.$body = $("body");
        this.$calendar = $("#calendar");
        this.$calendarObj = null;
        this.$selectedEvent = null;
        this.$newEventData = null;
    }

    CalendarApp.prototype.onEventClick = function(event) {
        alert("Event: " + event.event.title);
        // Handle your event click logic here
    };

    CalendarApp.prototype.onSelect = function(info) {
        const eventTitle = prompt("Enter Event Title:");
        if (eventTitle) {
            this.$calendarObj.addEvent({
                title: eventTitle,
                start: info.start,
                end: info.end,
                allDay: info.allDay
            });
        }
        this.$calendarObj.unselect();
    };

    CalendarApp.prototype.fetchEvents = function() {
        return $.ajax({
            url: '/api/bookings', // Your Laravel endpoint to fetch bookings
            method: 'GET',
            dataType: 'json'
        });
    };

    CalendarApp.prototype.init = function() {
        const today = new Date($.now());

        // Initialize the calendar
        this.$calendarObj = new FullCalendar.Calendar(this.$calendar[0], {
            slotDuration: "00:15:00", // 15 min slots
            slotMinTime: "08:00:00",
            slotMaxTime: "19:00:00",
            themeSystem: "bootstrap",
            bootstrapFontAwesome: false,
            buttonText: {
                today: "Today",
                month: "Month",
                week: "Week",
                day: "Day",
                list: "List",
                prev: "Prev",
                next: "Next"
            },
            initialView: "dayGridMonth",
            handleWindowResize: true,
            height: $(window).height() - 200,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            },
            editable: true,
            droppable: false,
            selectable: true,
            dateClick: (info) => this.onSelect(info),
            eventClick: (event) => this.onEventClick(event),
            events: this.fetchEvents() // Fetch and display events from the database
        });

        this.$calendarObj.render();
    };

    // Initialize the app
    $.CalendarApp = new CalendarApp();
    $.CalendarApp.init();

})(window.jQuery);


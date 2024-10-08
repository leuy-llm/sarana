@extends('layout.app')
@section('style')
    <style>
        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }

        .filepond--panel-root {
            border-radius: 2em;
            background-color: #edf0f4;
            height: 1em;
        }

        .filepond--item-panel {
            background-color: #595e68;
        }

        .filepond--drip-blob {
            background-color: #7f8a9a;
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
        }

        .upload-box:hover {
            border-color: #999;
        }

        .booked-date {
            background-color: red !important;

            border-radius: 50%;
            /* Optional: make the date rounded */
        }



        /* Style the gallery container */
        #lightgallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        #image-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            row-gap: 20px;
            column-gap: 1rem;
            width: 100%;
        }

        #image-gallery img {
            max-width: 1;
            width: 100%;
            display: block;
            height: 250px;
            cursor: pointer;
        }

        /* Style individual gallery items */
        #lightgallery a {
            display: block;
            width: 200px;
            /* Adjust the width as needed */
            height: auto;
            margin: 10px;
        }

        /* Style the images */
        #lightgallery img {
            width: 100%;
            height: auto;
            display: block;

        }

        /* Custom styles for LightGallery */
        .lg-outer .lg-thumb-outer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .lg-outer .lg-thumb-outer .lg-thumb {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.roomList'), 'url' => route('rooms.index')],
            ['title' => __('label.createRoom'), 'url' => route('rooms.create')],
        ];
        $currentPageTitle = __('label.createRooms');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary btn-rounded mb-2"><span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" enctype="multipart/form-data"
                        action="{{ route('bookings.update', $booking->id) }}"" method="POST" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.guestName') <span class="text-danger">*</span></label>
                                    <select name="guest_id" required class="form-control select2" data-toggle="select2">
                                        <option value="" selected disabled>Select Guest</option>
                                        @foreach ($guests as $guest)
                                            <option value="{{ $guest->id }}"
                                                {{ $guest->id == $booking->guest_id ? 'selected' : '' }}>
                                                {{ $guest->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkIn') <span class="text-danger">*</span></label>
                                    <input type="date" id="check_in_date" name="check_in_date"
                                        value="{{ old('check_in_date', $booking->check_in_date) }}"
                                        class="form-control checkin_date @error('check_in_date') is-invalid @enderror"
                                        required="">
                                    @error('check_in_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkOut') <span class="text-danger">*</span></label>
                                    <input type="date" id="check_out_date"
                                        value="{{ old('check_out_date', $booking->check_out_date) }}" name="check_out_date"
                                        class="form-control  @error('check_out_date') is-invalid @enderror" required="">
                                    @error('check_out_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.avaiableRoom') <span class="text-danger">*</span></label>
                                    <select name="room_id" required="" class="form-control room-list select2"
                                        data-toggle="select2">
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}"
                                                {{ $room->id == $booking->room_id ? 'selected' : '' }}>
                                                {{ $room->room_number }} - {{ $room->roomType->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.totalAdults') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('total_adults', $booking->total_adults) }}"
                                        name="total_adults"
                                        class="form-control  @error('total_adults') is-invalid @enderror "
                                        placeholder="@lang('label.entertoalAdult') . . ." required="">
                                    @error('total_adults')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.totalChildren') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('total_children', $booking->total_children) }}"
                                        name="total_children"
                                        class="form-control  @error('total_children') is-invalid @enderror "
                                        placeholder="@lang('label.entertotalChildren') . . ." required="">
                                    @error('total_children')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                                    <select name="status"
                                        class="form-control @error('status') is-invalid @enderror select2" data-toggle="select2" >
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                            Confirmed</option>
                                        <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>
                                            Canceled</option>
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>

                        <a href="{{ url('bookings') }}" class="btn btn-light btn-rounded ">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>

        </div>

    </div>



    </div>
@endsection
@section('script')
    <script>
        // document.getElementById('check_in_date').addEventListener('change', function() {
        //     var checkInDate = this.value; // Get the selected check-in date
        //     document.getElementById('check_out_date').setAttribute('min',
        //     checkInDate); // Set the min attribute of check-out date
        // });

        /*=========== Date available ==========*/
        document.getElementById('check_in_date').addEventListener('change', function() {
            var checkInDate = this.value;
            document.getElementById('check_out_date').setAttribute('min', checkInDate);

            checkIfDateIsBooked(checkInDate, 'check_in_date');
        });

        document.getElementById('check_out_date').addEventListener('change', function() {
            var checkOutDate = this.value;
            checkIfDateIsBooked(checkOutDate, 'check_out_date');
        });

        function checkIfDateIsBooked(date, elementId) {
            $.ajax({
                url: "{{ url('bookings/check-date') }}/" + date,
                dataType: 'json',
                success: function(response) {
                    if (response.isBooked) {
                        // document.getElementById(elementId).style.backgroundColor = 'gray';
                        document.getElementById(elementId).style.color = 'red';
                    } else {
                        document.getElementById(elementId).style.backgroundColor = '';
                        document.getElementById(elementId).style.color = '#6c757d';
                    }
                }
            });
        }

        /* ========= Show date booked and it fit for edit form ========*/

        // document.addEventListener("DOMContentLoaded", function() {
        //     const bookedDates = @json($bookedDates); // Ensure bookedDates is correctly defined


        //     // Initialize the check-in date picker
        //     let checkInPicker = flatpickr("#check_in_date", {
        //         dateFormat: "Y-m-d",


        //         disable: bookedDates.map(date => ({
        //             from: date.check_in_date,
        //             to: date.check_out_date
        //         })),
        //         // Disable booked date ranges
        //         // for check - in

        //         onChange: function(selectedDates, dateStr, instance) {
        //             let checkInDate = selectedDates[0];

        //             if (checkInDate) {
        //                 console.log("Check-in date selected:", dateStr);

        //                 // Automatically set the check-out date to the same as check-in date
        //                 checkOutPicker.setDate(checkInDate);

        //                 // Set the minimum date for check-out to be the same as check-in date
        //                 checkOutPicker.set("minDate", checkInDate);
        //             }
        //         },
        //         onDayCreate: function(dObj, dStr, fp, dayElem) {
        //             let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //             if (bookedDates.some(date => dateStr >= date.check_in_date && dateStr <= date
        //                     .check_out_date)) {
        //                 dayElem.style.backgroundColor =
        //                     "#FFCCCC"; // Custom background color for booked dates
        //                 dayElem.style.color = "#000"; // Optional: Custom text color
        //             }
        //         }
        //     });

        //     // Initialize the check-out date picker
        //     let checkOutPicker = flatpickr("#check_out_date", {
        //         dateFormat: "Y-m-d",
        //         disable: bookedDates.map(date => ({
        //                     from: date.check_in_date,
        //                     to: date.check_out_date
        //                 })),
        //         onDayCreate: function(dObj, dStr, fp, dayElem) {
        //             let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //             if (bookedDates.some(date => dateStr >= date.check_in_date && dateStr <= date
        //                     .check_out_date)) {
        //                 dayElem.style.backgroundColor = "#FFCCCC";
        //                 dayElem.style.color = "#000";
        //             }
        //         }
        //     });
        // });

        /* ========= End Show date booked and it fit for edit form ========*/

        /* ========= Disabe checkout date before clicked check_in date ========*/
        // document.addEventListener("DOMContentLoaded", function() {
        //     const bookedDates = @json($bookedDates);

        //     let checkOutDateInput = document.querySelector("#check_out_date");
        //     checkOutDateInput.disabled = true; // Initially disable the check-out date field

        //     let flatpickrInstance = flatpickr("#check_in_date", {
        //         dateFormat: "Y-m-d",
        //         onDayCreate: function(dObj, dStr, fp, dayElem) {
        //             let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //             if (bookedDates.some(date => dateStr >= date.check_in_date && dateStr <= date
        //                     .check_out_date)) {
        //                 dayElem.style.backgroundColor =
        //                 "#FFCCCC"; // Custom background color for booked dates
        //                 dayElem.style.color = "#000"; // Optional: Custom text color
        //             }
        //         },
        //         onChange: function(selectedDates, dateStr, instance) {
        //             checkOutDateInput.disabled =
        //             false; // Enable the check-out date field after selecting a check-in date
        //             checkOutDateInput.flatpickr({
        //                 dateFormat: "Y-m-d",
        //                 minDate: dateStr, // Set the selected check-in date as the minimum date for check-out
        //                 onDayCreate: function(dObj, dStr, fp, dayElem) {
        //                     let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //                     if (bookedDates.some(date => dateStr >= date.check_in_date &&
        //                             dateStr <= date.check_out_date)) {
        //                         dayElem.style.backgroundColor = "#FFCCCC";
        //                         dayElem.style.color = "#000";
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });

        /* ========= End Disabe checkout date before clicked check_in date ========*/

        // document.addEventListener("DOMContentLoaded", function() {
        //     const bookedDates = @json($bookedDates);

        //     let checkOutDateInput = document.querySelector("#check_out_date");
        //     checkOutDateInput.disabled = true; // Initially disable the check-out date field

        //     let flatpickrInstance = flatpickr("#check_in_date", {
        //         dateFormat: "m/d/Y", // Use m/d/Y format for check-in date
        //         disable: bookedDates.map(date => ({
        //             from: date.check_in_date,
        //             to: date.check_out_date
        //         })), // Disable booked date ranges for check-in
        //         onDayCreate: function(dObj, dStr, fp, dayElem) {
        //             let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //             if (bookedDates.some(date => dateStr >= date.check_in_date && dateStr <= date
        //                     .check_out_date)) {
        //                 dayElem.style.backgroundColor =
        //                 "#FFCCCC"; // Custom background color for booked dates
        //                 dayElem.style.color = "#000"; // Optional: Custom text color
        //             }
        //         },
        //         onChange: function(selectedDates, dateStr, instance) {
        //             checkOutDateInput.disabled =
        //             false; // Enable the check-out date field after selecting a check-in date
        //             checkOutDateInput.flatpickr({
        //                 dateFormat: "m/d/Y", // Use m/d/Y format for check-out date
        //                 minDate: dateStr, // Set the selected check-in date as the minimum date for check-out
        //                 disable: bookedDates.map(date => ({
        //                     from: date.check_in_date,
        //                     to: date.check_out_date
        //                 })), // Disable booked date ranges for check-out
        //                 onDayCreate: function(dObj, dStr, fp, dayElem) {
        //                     let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //                     if (bookedDates.some(date => dateStr >= date.check_in_date &&
        //                             dateStr <= date.check_out_date)) {
        //                         dayElem.style.backgroundColor = "#FFCCCC";
        //                         dayElem.style.color = "#000";
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });
        // document.addEventListener("DOMContentLoaded", function() {
        //     const bookedDates = @json($bookedDates);

        //     let checkOutDateInput = document.querySelector("#check_out_date");
        //     checkOutDateInput.disabled = true; // Initially disable the check-out date field

        //     let flatpickrInstance = flatpickr("#check_in_date", {
        //         dateFormat: "Y-m-d",
        //         disable: bookedDates.map(date => ({
        //             from: date.check_in_date,
        //             to: date.check_out_date
        //         })), // Disable booked date ranges for check-in
        //         onDayCreate: function(dObj, dStr, fp, dayElem) {
        //             let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //             if (bookedDates.some(date => dateStr >= date.check_in_date && dateStr <= date
        //                     .check_out_date)) {
        //                 dayElem.style.backgroundColor =
        //                     "#FFCCCC"; // Custom background color for booked dates
        //                 dayElem.style.color = "#000"; // Optional: Custom text color
        //             }
        //         },
        //         onChange: function(selectedDates, dateStr, instance) {
        //             checkOutDateInput.disabled =
        //                 false; // Enable the check-out date field after selecting a check-in date
        //             checkOutDateInput.flatpickr({
        //                 dateFormat: "Y-m-d",
        //                 minDate: dateStr, // Set the selected check-in date as the minimum date for check-out
        //                 disable: bookedDates.map(date => ({
        //                     from: date.check_in_date,
        //                     to: date.check_out_date
        //                 })), // Disable booked date ranges for check-out
        //                 onDayCreate: function(dObj, dStr, fp, dayElem) {
        //                     let dateStr = dayElem.dateObj.toISOString().split('T')[0];

        //                     if (bookedDates.some(date => dateStr >= date.check_in_date &&
        //                             dateStr <= date.check_out_date)) {
        //                         dayElem.style.backgroundColor = "#FFCCCC";
        //                         dayElem.style.color = "#000";
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });
        // /*=========== room available ==========*/
        $(document).ready(function() {

            // Store the original check-in date and room ID
            var originalCheckInDate = "{{ $booking->check_in_date }}";
            var originalRoomId = "{{ $booking->room_id }}";

            $(".checkin_date").on('blur', function() {
                var selectedCheckInDate = $(this).val();

                // Check if the selected date is the same as the original date
                if (selectedCheckInDate === originalCheckInDate) {
                    return; // Do nothing if the date hasn't changed
                }

                // Proceed with AJAX call if the date is different
                $.ajax({
                    url: "{{ url('bookings') }}/available-rooms/" + selectedCheckInDate,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".room-list").html('<option>--- Loading ---</option>');
                    },
                    success: function(res) {
                        var _html = '';
                        $.each(res.data, function(index, row) {
                            // Check if the room is the originally selected room
                            var selected = (row.id == originalRoomId) ? 'selected' : '';
                            _html += '<option value="' + row.id + '" ' + selected +
                                '>' + row.room_number + ' - ' + row.type_name +
                                '</option>';
                        });
                        $(".room-list").html(_html);
                    }
                });

            });
        });
    </script>
@endsection

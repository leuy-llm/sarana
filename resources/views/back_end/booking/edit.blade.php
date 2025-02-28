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
            ['title' => __('label.bookingList'), 'url' => route('bookings.index')],
            ['title' => __('label.editBooking'), 'url' => route('bookings.create')],
        ];
        $currentPageTitle = __('label.editBooking');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="edit-booking-form" enctype="multipart/form-data"
                        action="{{ route('bookings.update', $booking->id) }}" method="POST">
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
                                                {{ $booking->guest_id == $guest->id ? 'selected' : '' }}>
                                                {{ $guest->first_name }} {{ $guest->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkIn')</label>
                                    <input type="date" id="check_in_date" name="check_in_date"
                                        value="{{ \Carbon\Carbon::parse($booking->check_in_date)->format('Y-m-d') }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkIn')</label>
                                    <input type="date" id="check_out_date" name="check_out_date"
                                        value="{{ \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.bookingSource') <span class="text-danger">*</span></label>
                                    <select name="booking_source" required class="form-control select2"
                                        data-toggle="select2">
                                        <option value="" selected disabled>Choose Booking Source</option>
                                        <option value="website" {{ $booking->booking_source == 'website' ? 'selected' : '' }}>
                                            Website</option>
                                        <option value="walk-in" {{ $booking->booking_source == 'walk-in' ? 'selected' : '' }}>
                                            Walk-In </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="room-selection">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">@lang('label.room') <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">@lang('label.totalAdults') <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">@lang('label.totalChildren') <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    @foreach ($booking->rooms as $key => $room)
                                        <div class="room-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <select class="room-list form-select" name="rooms[]" required>
                                                            <option value="{{ $room->id }}" data-max-person="{{ $room->max_person }}" selected>
                                                                {{ $room->room_number }} - {{ $room->roomType->type_name }}
                                                            </option>
                                                            @foreach ($availableRooms as $availableRoom)
                                                                @if ($availableRoom->id != $room->id)
                                                                    <option value="{{ $availableRoom->id }}" data-max-person="{{ $availableRoom->max_person }}">
                                                                        {{ $availableRoom->room_number }} -
                                                                        {{ $availableRoom->roomType->type_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                       
                                                        <div class="invalid-feedback room-error d-none">This room is not
                                                            available.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">

                                                        <input type="number" name="total_adults[]"
                                                            value="{{ $room->pivot->total_adults }}" class="form-control"
                                                            min="1" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <input type="number" name="total_children[]"
                                                            value="{{ $room->pivot->total_children }}" class="form-control"
                                                            min="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-end">
                                                    <button type="button"
                                                        class="btn btn-sm mb-3 btn-danger remove-room">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                               
                                <button type="button" id="add-room" class="btn btn-success btn-sm mb-3">
                                    <i class="bi bi-plus fs-5"></i> Add Room
                                </button>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2" data-toggle="select2">
                                        <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Approved" {{ $booking->status == 'Approved' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                                    <select name="payment_status" class="form-control select2" data-toggle="select2"
                                        required>
                                        <option value="Paid" {{ $booking->payment_status == 'Paid' ? 'selected' : '' }}>
                                            Paid</option>
                                        <option value="Unpaid"
                                            {{ $booking->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update Booking</button>
                        <a href="{{ route('bookings.index') }}" class="btn btn-dark">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal HTML -->
<div id="error-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="error-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="error-modal-label">Validation Error</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="error-message"></p> <!-- The error message will go here -->
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        document.getElementById('check_out_date').addEventListener('change', function() {
            const checkIn = document.getElementById('check_in_date').value;
            const checkOut = this.value;

            if (!checkIn || !checkOut) {
                alert('Please select both check-in and check-out dates.');
                return;
            }

            fetch(`/check-room-availability?check_in=${checkIn}&check_out=${checkOut}`)
                .then(response => response.json())
                .then(data => {
                    const allDropdowns = document.querySelectorAll('.room-list');
                    const selectedRoomIds = new Set();

                    // Collect current selections
                    allDropdowns.forEach(select => {
                        if (select.value) {
                            selectedRoomIds.add(select.value);
                        }
                    });

                    // Update each dropdown
                    allDropdowns.forEach(select => {
                        const currentSelectedRoom = select.value; // Current selection for this dropdown
                        select.innerHTML = ''; // Clear options

                        // Add updated room options
                        data.availableRooms.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.id;
                            option.textContent = `${room.room_number} - ${room.room_type}`;

                            // Disable the option if the room is already selected elsewhere
                            if (selectedRoomIds.has(room.id) && room.id !==
                                currentSelectedRoom) {
                                option.disabled = true;
                            }

                            select.appendChild(option);
                        });

                        // Check if the current selection is still available
                        if (currentSelectedRoom && data.availableRooms.some(room => room.id ==
                                currentSelectedRoom)) {
                            select.value = currentSelectedRoom; // Keep the selection if available
                        } else {
                            alert('Your previously selected room is no longer available.');
                            select.value = ''; // Clear the selection
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching available rooms.');
                });
        });

        let selectedRoomIds = new Set();

        // Function to update dropdown options
        function updateRoomDropdowns() {
            const allDropdowns = document.querySelectorAll('.room-list');

            allDropdowns.forEach(select => {
                const currentSelectedRoom = select.value;

                select.querySelectorAll('option').forEach(option => {
                    if (option.value) {
                        // Disable option if it's already selected in another dropdown
                        if (selectedRoomIds.has(option.value) && option.value !== currentSelectedRoom) {
                            option.disabled = true;
                        } else {
                            option.disabled = false; // Enable if not selected elsewhere
                        }
                    }
                });
            });
        }

        // Function to add a new room dropdown
        function addRoomDropdown() {
            const container = document.getElementById('room-selection');
            const newDropdown = document.createElement('div');
            newDropdown.classList.add('room-dropdown');

            newDropdown.innerHTML = `
                <select class="room-list">
                    <option value="">Select a Room</option>
                    <!-- Options will be populated dynamically -->
                </select>
                <button type="button" class="remove-room">Remove</button>
            `;

            container.appendChild(newDropdown);

            // Populate the new dropdown with available rooms
            fetch(
                    `/check-room-availability?check_in=${document.getElementById('check_in_date').value}&check_out=${document.getElementById('check_out_date').value}`
                    )
                .then(response => response.json())
                .then(data => {
                    const dropdown = newDropdown.querySelector('.room-list');

                    data.availableRooms.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.id;
                        option.textContent = `${room.room_number} - ${room.room_type}`;
                        dropdown.appendChild(option);
                    });

                    // Bind change event to update the selectedRoomIds
                    dropdown.addEventListener('change', function() {
                        selectedRoomIds.clear();
                        document.querySelectorAll('.room-list').forEach(dropdown => {
                            if (dropdown.value) {
                                selectedRoomIds.add(dropdown.value);
                            }
                        });
                        updateRoomDropdowns();
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching available rooms.');
                });

            // Bind remove functionality
            newDropdown.querySelector('.remove-room').addEventListener('click', function() {
                container.removeChild(newDropdown);
                selectedRoomIds.clear();
                document.querySelectorAll('.room-list').forEach(dropdown => {
                    if (dropdown.value) {
                        selectedRoomIds.add(dropdown.value);
                    }
                });
                updateRoomDropdowns();
            });
        }

        // Add change event listener to each room dropdown
        document.querySelectorAll('.room-list').forEach(select => {
            select.addEventListener('change', function() {
                selectedRoomIds.clear();

                // Collect selected room IDs from all dropdowns
                document.querySelectorAll('.room-list').forEach(dropdown => {
                    if (dropdown.value) {
                        selectedRoomIds.add(dropdown.value);
                    }
                });

                // Immediately update dropdowns to reflect the selected rooms
                updateRoomDropdowns();
            });
        });

        // Handle room availability check on date change
        document.getElementById('check_out_date').addEventListener('change', function() {
            const checkIn = document.getElementById('check_in_date').value;
            const checkOut = this.value;

            if (!checkIn || !checkOut) {
                alert('Please select both check-in and check-out dates.');
                return;
            }

            fetch(`/check-room-availability?check_in=${checkIn}&check_out=${checkOut}`)
                .then(response => response.json())
                .then(data => {
                    const allDropdowns = document.querySelectorAll('.room-list');

                    // Update dropdown options dynamically
                    allDropdowns.forEach(select => {
                        const currentSelectedRoom = select.value;
                        select.innerHTML = ''; // Clear options

                        // Add updated room options
                        data.availableRooms.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.id;
                            option.textContent = `${room.room_number} - ${room.room_type}`;

                            // Disable the option if the room is already selected elsewhere
                            if (selectedRoomIds.has(room.id) && room.id !==
                                currentSelectedRoom) {
                                option.disabled = true;
                            }

                            select.appendChild(option);
                        });

                        // Check if the current selection is still available
                        if (currentSelectedRoom && data.availableRooms.some(room => room.id ==
                                currentSelectedRoom)) {
                            select.value = currentSelectedRoom; // Keep the selection if available
                        } else {
                            alert('Your previously selected room is no longer available.');
                            select.value = ''; // Clear the selection
                        }
                    });

                    // Refresh room dropdowns to handle immediate disabling
                    updateRoomDropdowns();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching available rooms.');
                });
        });
        // document.getElementById('add-room').addEventListener('click', addRoomDropdown);

        document.addEventListener('DOMContentLoaded', function() {
            const roomSelectionContainer = document.getElementById('room-selection');
            const addRoomButton = document.getElementById('add-room');
            let selectedRoomIds = new Set();

            // Add Room
            addRoomButton.addEventListener('click', function() {
                const roomGroup = document.querySelector('.room-group');
                const newRoomGroup = roomGroup.cloneNode(true);

                // Clear input values in the cloned group
                newRoomGroup.querySelector('.room-list').value = '';
                newRoomGroup.querySelector('[name="total_adults[]"]').value = 1;
                newRoomGroup.querySelector('[name="total_children[]"]').value = 0;

                // Append the new room group
                roomSelectionContainer.appendChild(newRoomGroup);

                // Refresh event listeners for dropdowns
                refreshRoomDropdowns();
            });

            // Remove Room
            roomSelectionContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-room')) {
                    const roomGroup = event.target.closest('.room-group');
                    roomGroup.remove();
                    refreshRoomDropdowns();
                }
            });

            // Update dropdown options
            function refreshRoomDropdowns() {
                const allDropdowns = document.querySelectorAll('.room-list');
                selectedRoomIds.clear();

                allDropdowns.forEach(select => {
                    if (select.value) {
                        selectedRoomIds.add(select.value);
                    }
                });

                allDropdowns.forEach(select => {
                    const currentValue = select.value;

                    select.querySelectorAll('option').forEach(option => {
                        if (option.value) {
                            if (selectedRoomIds.has(option.value) && option.value !==
                                currentValue) {
                                option.disabled = true;
                            } else {
                                option.disabled = false;
                            }
                        }
                    });
                });
            }
            // Refresh room dropdowns on page load
            refreshRoomDropdowns();
            // Update dropdowns on change
            roomSelectionContainer.addEventListener('change', function(event) {
                if (event.target.classList.contains('room-list')) {
                    refreshRoomDropdowns();
                }
            });
        });

        document.getElementById('edit-booking-form').addEventListener('submit', function(event) {
    const roomGroups = document.querySelectorAll('.room-group');
    let isValid = true;
    let errorMessage = '';

    roomGroups.forEach(group => {
        const roomSelect = group.querySelector('.room-list');
        const maxPerson = parseInt(roomSelect.options[roomSelect.selectedIndex].getAttribute('data-max-person'));
        const totalAdults = parseInt(group.querySelector('[name="total_adults[]"]').value);
        const totalChildren = parseInt(group.querySelector('[name="total_children[]"]').value || 0);
        const totalGuests = totalAdults + totalChildren;

        if (totalGuests > maxPerson) {
            isValid = false;
            errorMessage += `Room ${roomSelect.options[roomSelect.selectedIndex].textContent} exceeds the maximum number of guests (${maxPerson}).\n`;
        }
    });

    if (!isValid) {
        event.preventDefault(); // Prevent form submission if validation fails
        // Show the error modal with the error message
        document.getElementById('error-message').textContent = errorMessage;
        $('#error-modal').modal('show'); // Use jQuery to show the modal (Bootstrap modal)
    }
    });
            
    </script>
@endsection

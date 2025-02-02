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
            ['title' => __('label.createBooking'), 'url' => route('bookings.create')],
        ];
        $currentPageTitle = __('label.newBooking');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form id="booking-form" enctype="multipart/form-data" action="{{ url('/bookings') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.guestName') <span class="text-danger">*</span></label>
                                    <select name="guest_id" required class="form-control select2" data-toggle="select2">
                                        <option value="" selected disabled>Select Guest</option>
                                        @foreach ($guests as $guest)
                                            <option value="{{ $guest->id }}"
                                                {{ old('guest_id') == $guest->id ? 'selected' : '' }}>
                                                {{ $guest->first_name }} {{ $guest->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkIn') <span class="text-danger">*</span></label>
                                    <input type="date" id="check_in_date" name="check_in_date"
                                        class="form-control @error('check_in_date') is-invalid @enderror " required>
                                    @error('check_in_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkOut') <span class="text-danger">*</span></label>
                                    <input type="date" id="check_out_date" name="check_out_date"
                                        class="form-control @error('check_out_date') is-invalid @enderror" required>
                                    @error('check_out_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.bookingSource') <span class="text-danger">*</span></label>
                                    <select name="booking_source" required class="form-control select2"
                                        data-toggle="select2">
                                        <option value="" selected disabled>Choose Booking Source</option>
                                        <option value="website" {{ old('booking_source') == 'website' ? 'selected' : '' }}>
                                            Website</option>
                                        <option value="walk-in" {{ old('booking_source') == 'walk-in' ? 'selected' : '' }}>
                                            Walk-In </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div id="room-selection">
                                    <div class="room-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('label.room') <span
                                                            class="text-danger">*</span></label>
                                                    <select class="room-list form-select" name="rooms[]" required>
                                                        <option value="">--- Select Room ---</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('label.totalAdults') <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" name="total_adults[]"
                                                        value="{{ old('total_adults.0') }}"
                                                        class="form-control @error('total_adults') is-invalid @enderror"
                                                        min="1" placeholder="@lang('label.enterTotalAdults')" required>
                                                    @error('total_adults')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('label.totalChildren')</label>
                                                    <input type="number" name="total_children[]"
                                                        value="{{ old('total_children.0') }}"
                                                        class="form-control @error('total_children') is-invalid @enderror"
                                                        min="0" placeholder="@lang('label.enterTotalChildren')">
                                                    @error('total_children')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-end mb-3">
                                                <i class=" badge bg-danger text-light p-1 cursor-pointer border-none border-0 mdi mdi-close-thick fs-5 remove-room"
                                                    style="cursor: pointer;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="add-room" class="btn btn-success btn-sm mb-3"><i
                                        class="bi bi-plus fs-5"></i> Add Room</button>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2" data-toggle="select2">
                                        <option value="" selected disabled>Choose Status</option>
                                        <option value="Reserved" {{ old('status') == 'Reserved' ? 'selected' : '' }}>
                                            Reserved</option>
                                        <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>
                                            Canceled</option>
                                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Checked-In" {{ old('status') == 'Checked-In' ? 'selected' : '' }}>
                                            Checked-In</option>
                                        <option value="Checked-Out" {{ old('status') == 'Checked-Out' ? 'selected' : '' }}>
                                            Checked-Out</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.paymentStatus') <span
                                            class="text-danger">*</span></label>
                                    <select name="payment_status"
                                        class="form-control @error('payment_status') is-invalid @enderror select2"
                                        data-toggle="select2" required>
                                        <option value="" selected disabled>Choose Payment Status</option>
                                        <option value="Unpaid" {{ old('payment_status') == 'Unpaid' ? 'selected' : '' }}>
                                            @lang('label.unpaid')</option>
                                        <option value="Paid" {{ old('payment_status') == 'Paid' ? 'selected' : '' }}>
                                            @lang('label.paid')</option>
                                    </select>
                                    @error('payment_status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">@lang('label.save')</button>
                        <a href="{{ url('bookings') }}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        let allAvailableRooms = []; // Store all available rooms globally
        document.addEventListener('DOMContentLoaded', function() {
            const checkInDateInput = document.getElementById('check_in_date');
            const checkOutDateInput = document.getElementById('check_out_date');
            const addRoomButton = document.getElementById('add-room');
            const roomSelectionDiv = document.getElementById('room-selection');

            // Event listeners for date changes
            checkInDateInput.addEventListener('change', function() {
                fetchAllAvailableRooms(this.value, checkOutDateInput.value);
            });

            checkOutDateInput.addEventListener('change', function() {
                fetchAllAvailableRooms(checkInDateInput.value, this.value);
            });

            // Event listener for adding new room dropdowns
            addRoomButton.addEventListener('click', function() {
                addNewRoomDropdown();
            });

            // Fetch all available rooms
            function fetchAllAvailableRooms(checkInDate, checkOutDate) {
                if (!checkInDate || !checkOutDate) return;

                $.ajax({
                    url: "{{ url('bookings') }}/available-room/" + checkInDate,
                    method: "GET",
                    data: {
                        check_out_date: checkOutDate
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        updateAllRoomDropdowns('<option>Loading...</option>');
                    },
                    success: function(res) {
                        allAvailableRooms = res.data; // Store available rooms globally
                        updateAllRoomDropdowns();
                    },
                });
            }

            // Add a new room dropdown dynamically
            function addNewRoomDropdown() {
                const newRoomGroup = document.createElement('div');
                newRoomGroup.classList.add('room-group');

                newRoomGroup.innerHTML = `
                    <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select name="rooms[]" required class="form-select room-list" >
                                        <option value="">--- Select Room ---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    
                                    <input type="number" name="total_adults[]" class="form-control" placeholder="@lang('label.enterTotalAdults')" min="1" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <input type="number" name="total_children[]" placeholder="@lang('label.enterTotalChildren')" class="form-control" min="0">
                                </div>
                            </div>

                            <div class="col-md-12 text-end mb-3">
                            <button type="button" class="remove-room badge bg-danger pt-1 border-none border-0"><i class="mdi mdi-close-thick fs-5"></i></button>	
                            
                            </div>
                        </div>
                    `;

                // Add event listener for removing the room
                newRoomGroup.querySelector('.remove-room').addEventListener('click', function() {
                    newRoomGroup.remove();
                    updateAllRoomDropdowns(); // Refresh dropdowns after removal
                });

                roomSelectionDiv.appendChild(newRoomGroup);
                updateAllRoomDropdowns(); // Update options for the new dropdown
            }

            // Update all room dropdowns dynamically
            function updateAllRoomDropdowns(loadingMessage = null) {
                // Get all selected room IDs from dropdowns
                const selectedRoomIds = Array.from(document.querySelectorAll('.room-list'))
                    .map(roomDropdown => roomDropdown.value)
                    .filter(value => value); // Only keep selected values

                const roomDropdowns = document.querySelectorAll('.room-list');
                roomDropdowns.forEach(function(roomDropdown) {
                    const selectedValue = roomDropdown.value; // Preserve the current selection
                    let options = loadingMessage || '<option value="">--- Select Room ---</option>';

                    // Iterate through all available rooms
                    allAvailableRooms.forEach(function(room) {

                        if (!selectedRoomIds.includes(String(room.id)) || room.id ==
                            selectedValue) {
                            options += `<option value="${room.id}" data-max-person="${room.max_person}" data-room-type-name="${room.type_name}" ${
                                room.id == selectedValue ? 'selected' : ''
                            }>${room.room_number} - ${room.type_name}</option>`;

                        }
                    });
                    // Update the dropdown's options
                    roomDropdown.innerHTML = options;
                });
            }
            // Check if the total adults and children exceed max_person for the selected room
            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('room-list') || event.target.classList.contains(
                        'form-control')) {
                    validateRoomCapacity();
                    updateAllRoomDropdowns();
                }
            });

            function validateRoomCapacity() {
                const roomDropdowns = document.querySelectorAll('.room-list');
                const totalAdultsInputs = document.querySelectorAll('input[name="total_adults[]"]');
                const totalChildrenInputs = document.querySelectorAll('input[name="total_children[]"]');

                roomDropdowns.forEach((dropdown, index) => {
                    const selectedRoomId = dropdown.value;
                    const maxPerson = parseInt(dropdown.selectedOptions[0].dataset.maxPerson, 10);
                    const roomTypeName = dropdown.selectedOptions[0].dataset
                        .roomTypeName; // Fetch the room type name

                    const totalAdults = parseInt(totalAdultsInputs[index].value, 10);
                    const totalChildren = parseInt(totalChildrenInputs[index].value, 10) || 0;
                    const totalPersons = totalAdults + totalChildren;
                    if (totalPersons > maxPerson) {
                        alert(
                            `The total number of persons for the ${roomTypeName} exceeds the maximum capacity of ${maxPerson}.`
                        );
                        dropdown.setCustomValidity("Total persons exceed room capacity.");
                    } else {
                        dropdown.setCustomValidity("");
                    }
                });
            }
        });
    </script>
@endsection

@extends('layout.app')
@section('style')
    <style>
        .toast-success.custom-toast {
            background-color: #0acf97 !important;
            /* Your desired background color */
        }

        .toast-error.custom-toast {
            background-color: #f44336 !important;
            /* Your desired error background color */
        }

        .text-truncate {
            max-width: 100px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .popover-body,
        .popover-header {
            font-family: 'Hanuman', 'serif' !important;
        }

        .three-state-switch {
            position: relative;
            width: 120px;
            height: 30px;
            display: flex;
            align-items: center;
            background-color: #ccc;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            /* border: 1px solid #ea0808; */
        }

        .slider {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0;
            font-size: 14px;
            color: black;
            transition: color 0.3s ease;
        }

        .label {
            flex: 1;
            text-align: center;
            z-index: 2;
            font-size: 12px;
            padding: 0 10px;
            transition: color 0.3s ease;
        }

        .knob {
            position: absolute;
            top: 3px;
            width: calc(100% / 3 - 6px);
            height: 24px;
            background-color: #ffc107;
            border-radius: 12px;
            transition: left 0.3s ease, background-color 0.3s ease;
            z-index: 1;
        }

        .slider[data-status="pending"] .knob {
            background-color: #ffc107;
            margin-left: 5px;
            text-align: center;
        }

        .slider[data-status="confirmed"] .knob {
            background-color: #28a745;
        }

        .slider[data-status="canceled"] .knob {
            background-color: #dc3545;
        }

        .slider[data-status="pending"] .label.pending,
        .slider[data-status="confirmed"] .label.confirmed,
        .slider[data-status="canceled"] .label.canceled {
            color: white;
        }

        .badge-active {
            background-color: #0056b3 !important;
            /* Dark blue for active state */
            color: white !important;
            padding-top: 5px !important;
            border: 1px solid #0056b3;
            box-shadow: 0px 0px 3px #0056b3;
            
        }
    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [['title' => __('label.bookingList'), 'url' => route('bookings.index')]];
        $currentPageTitle = __('label.bookingList');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form method="GET">
                            <div class="row">
                                
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('label.roomNumber')</label>
                                        <input type="text" name="roomNumber" value="{{ Request::get('roomNumber') }}"
                                            class="form-control " placeholder="@lang('label.enterRoomNumber') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('label.floor')</label>
                                        <input type="number" name="floor" value="{{ Request::get('floor') }}"
                                            class="form-control" placeholder="@lang('label.enterFloor') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-2">
                                        <label class="form-label">@lang('label.price')</label>
                                        <input type="number" name="price" value="{{ Request::get('price') }}"
                                            class="form-control" placeholder="@lang('label.enterPrice') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-2">
                                        <label class="form-label">@lang('label.status')</label>
                                        <select name="status" class="form-control select2" data-toggle="select2">
                                            <option value="" selected>@lang('label.selectStatus')</option>
                                            <option value="Available"
                                                {{ Request::get('status') == 'Available' ? 'selected' : '' }}>Available
                                            </option>
                                            <option value="Booked"
                                                {{ Request::get('status') == 'Booked' ? 'selected' : '' }}>Booked</option>
                                            <option value="Maintenance"
                                                {{ Request::get('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('label.date')</label>
                                        <input type="date" name="date" value="{{ Request::get('date') }}"
                                            class="form-control" placeholder="@lang('label.date') . . .">
                                    </div>
                                </div>

                                <div class="col-sm-3 d-flex gap-2">
                                    <div class="mb-3">
                                        <button type="submit" style="margin-top: 29px;" class="btn btn-primary font"
                                            tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover"
                                            data-bs-content="@lang('label.searchRoom')" data-bs-placement="top"
                                            title="">@lang('label.search')</button>
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ url('/rooms') }}" tabindex="0" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-content="@lang('label.resetGuest')"
                                            data-bs-placement="top" title="" class="btn btn-success"
                                            style="margin-top: 29px">@lang('label.reset')</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <a href="{{ url('bookings/create') }}" tabindex="0" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="right" data-bs-content="@lang('label.CanBooking')"
                                title="@lang('label.createNewBooking')" class="btn btn-danger mb-2">
                                <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addBooking')</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100" id="bookings-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheckAll">
                                            <label class="form-check-label" for="customCheckAll">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>@lang('label.guestName')</th>
                                    <th>@lang('label.room')</th>
                                    <th>@lang('label.checkIn')</th>
                                    <th>@lang('label.checkOut')</th>
                                    <th>@lang('label.totalAdults')</th>
                                    <th>@lang('label.totalChildren')</th>
                                    <th>@lang('label.date')</th>
                                    <th>@lang('label.status')</th>
                                    <th>@lang('label.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck{{ $booking->id }}">
                                                <label class="form-check-label" for="customCheck{{ $booking->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($booking->guest->first_name . ' ' . $booking->guest->last_name, 15) }}</td>
                                        <td>
                                            @if ($booking->room && $booking->room->roomType)
                                                {{ $booking->room->room_number }} - {{ Str::limit($booking->room->roomType->type_name, 15) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($booking->check_in_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($booking->check_out_date)) }}</td>
                                        <td>{{ $booking->total_adults }}</td>
                                        <td>{{ $booking->total_children }}</td>
                                        <td>{{ date('d-m-Y', strtotime($booking->created_at)) }}</td>
                                        <td>
                                            <span class="badge 
                                                @if ($booking->status == 'Pending') bg-warning 
                                                @elseif ($booking->status == 'Approved') bg-primary 
                                                @elseif ($booking->status == 'Checked-In') bg-info 
                                                @elseif ($booking->status == 'Checked-Out') bg-success 
                                                @elseif ($booking->status == 'Completed') bg-success 
                                                @elseif ($booking->status == 'Cancelled') bg-danger 
                                                @endif">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="table-action">
                                            <!-- Status-based actions -->
                                            @if ($booking->status == 'Pending')
                                            <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Approved']) }}" class="btn btn-sm btn-success">Approve</a>
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Cancelled']) }}" 
                                                   class="btn btn-sm btn-danger">Cancel</a>
                                            @elseif ($booking->status == 'Approved')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Checked-In']) }}" 
                                                   class="btn btn-sm btn-info">Check-In</a>
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Cancelled']) }}" 
                                                   class="btn btn-sm btn-danger">Cancel</a>
                                            @elseif ($booking->status == 'Checked-In')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Checked-Out']) }}" 
                                                   class="btn btn-sm btn-primary">Check-Out</a>
                                            @elseif ($booking->status == 'Checked-Out')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Completed']) }}" 
                                                   class="btn btn-sm btn-success">Complete</a>
                                            @endif
                        
                                            <!-- Common actions -->
                                            <a href="{{ route('rooms.show', $booking->id) }}" class="action-icon text-success"> 
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ url('bookings/' . $booking->id . '/edit') }}" class="action-icon text-primary">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            <a href="{{ url('bookings/' . $booking->id . '/delete') }}" onclick="confirmation(event)" 
                                               class="action-icon text-danger"> 
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        ! function(i) {
            "use strict";

            function showSuccessNotification(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "4000",
                    "hideDuration": "2000",
                    "timeOut": "5000",
                    "extendedTimeOut": "4000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "toastClass": "custom-toast"
                }

                toastr.success(message);
            }

            function showErrorNotification(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "3000",
                    "timeOut": "7000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "toastClass": "custom-toast"
                }

                toastr.error(message);
            }

            @if (session('success'))
                showSuccessNotification(@json(session('success')));
            @endif

            @if (session('error'))
                showErrorNotification(@json(session('error')));
            @endif
        }(window.jQuery);


        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            var question = @json(__('label.areYourSure'));
            var maksure = @json(__('label.youWontBe'));
            var confirm = @json(__('label.ok'));
            var cancel = @json(__('label.cancel'));
            console.log(urlToRedirect);

            swal({
                    title: question,
                    text: maksure,
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: cancel,
                            value: null,
                            visible: true,
                            // className: "btn btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: confirm,
                            value: true,
                            visible: true,
                            // className: "btn btn-primary",
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                })

                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });


        }


        /*============= Tranlsate ==============*/
        /*============= Tranlsate ==============*/
        var displayText = @json(__('label.display'));
        var displayBooking = @json(__('label.booking'));
        var showingBookingText =
            "{{ __('label.showing_bookings', ['start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}";


        // document.querySelectorAll('.three-state-switch').forEach(function(switchElement) {
        //     const slider = switchElement.querySelector('.slider');
        //     const knob = slider.querySelector('.knob');
        //     const input = switchElement.querySelector('#status');
        //     const statuses = ['pending', 'confirmed', 'canceled'];

        //     function updateKnobPosition(status) {
        //         const index = statuses.indexOf(status);
        //         knob.style.left = `${index * 40}px`; // Adjust for your layout
        //         slider.setAttribute('data-status', status); // Set status for CSS updates
        //     }

        //     // Initialize with the current status
        //     updateKnobPosition(input.value);

        //     slider.addEventListener('click', function() {
        //         const currentStatus = slider.getAttribute('data-status');
        //         const currentIndex = statuses.indexOf(currentStatus);
        //         const nextIndex = (currentIndex + 1) % statuses.length;
        //         const nextStatus = statuses[nextIndex];

        //         // Update UI
        //         updateKnobPosition(nextStatus);

        //         // Update hidden input value
        //         input.value = nextStatus;

        //         // Submit the form (if needed)
        //         switchElement.closest('form').submit();
        //     });
        // });
        // document.querySelectorAll('.three-state-switch').forEach(function(switchElement) {
        //     const slider = switchElement.querySelector('.slider');
        //     const knob = slider.querySelector('.knob');
        //     const input = switchElement.querySelector('#status');
        //     const labels = slider.querySelectorAll('.label');
        //     const statuses = ['pending', 'confirmed', 'canceled'];

        //     function updateKnobPosition(status) {
        //         const index = statuses.indexOf(status);
        //         if (index === -1) return;

        //         // Calculate knob position based on label width
        //         const labelWidth = slider.offsetWidth / statuses.length;
        //         knob.style.left = `${index * labelWidth}px`;

        //         // Set the status for styling
        //         slider.setAttribute('data-status', status);

        //         // Update input value
        //         input.value = status;

        //         // Update label colors
        //         labels.forEach((label, i) => {
        //             label.style.color = i === index ? 'white' : 'black';
        //         });
        //     }

        //     // Initialize with the current status
        //     updateKnobPosition(input.value);

        //     // Add click event for switching status
        //     slider.addEventListener('click', function(event) {
        //         const rect = slider.getBoundingClientRect();
        //         const clickX = event.clientX - rect.left;

        //         const labelWidth = slider.offsetWidth / statuses.length;
        //         const clickedIndex = Math.floor(clickX / labelWidth);

        //         if (clickedIndex >= 0 && clickedIndex < statuses.length) {
        //             const nextStatus = statuses[clickedIndex];
        //             updateKnobPosition(nextStatus);

        //             // Optionally submit the form
        //             switchElement.closest('form').submit();
        //         }
        //     });
        // });

        document.querySelectorAll('.three-state-switch').forEach(function(switchElement) {
            const slider = switchElement.querySelector('.slider');
            const knob = slider.querySelector('.knob');
            const input = switchElement.querySelector('#status');
            const labels = slider.querySelectorAll('.label');
            const statuses = ['pending', 'confirmed', 'canceled'];

            function updateKnobPosition(status) {
                const index = statuses.indexOf(status);
                if (index === -1) return;

                const labelWidth = slider.offsetWidth / statuses.length;
                knob.style.left = `${index * labelWidth}px`;
                slider.setAttribute('data-status', status);

                // Update label colors
                labels.forEach((label, i) => {
                    label.style.color = i === index ? 'white' : 'black';
                });
            }

            // Initialize with the current status from the backend
            updateKnobPosition(input.value);

            slider.addEventListener('click', function(event) {
                const rect = slider.getBoundingClientRect();
                const clickX = event.clientX - rect.left;

                const labelWidth = slider.offsetWidth / statuses.length;
                const clickedIndex = Math.floor(clickX / labelWidth);

                if (clickedIndex >= 0 && clickedIndex < statuses.length) {
                    const nextStatus = statuses[clickedIndex];
                    updateKnobPosition(nextStatus);

                    // Update the hidden input value
                    input.value = nextStatus;

                    // Submit the form
                    switchElement.closest('form').submit();
                }
            });
        });
    </script>
@endsection

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

        .p-button-icon {
            position: relative;
            display: inline-block;
            text-decoration: none;
            color: #ffffff !important;
            padding: 2px 6px;
            border-radius: 3px;
            justify-content: center;
            text-align: center;
            align-items: center;
            outline: transparent;
            transition: background-color 0.2s, color 0.2s, border-color 0.2s, box-shadow 0.2s outline-color 0.2s;
        }

        /* Tooltip styling */
        .tooltip {
            visibility: hidden;
            width: 120px;
            background-color: #313a46;
            color: #fff;
            text-align: center;
            border-radius: 3px;
            padding: 4px;
            font-family: "Nunito", serif;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            /* Position above the button */
            left: 50%;
            margin-left: -60px;
            /* Center the tooltip */
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Tooltip arrow */
        .tooltip::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #313a46 transparent transparent transparent;
        }

        /* Show tooltip on hover */
        .p-button-icon:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        .p-button-icon.p-button-approve {
            background-color: #689f38 !important;
            border: 1px solid #689f38;
        }

        .p-button-icon.p-button-cancel {
            background-color: #d32f2f !important;
            border: 1px solid #d32f2f;
        }

        .p-button-icon.p-button-in {
            background-color: #2196f3 !important;
            border: 1px solid #2196f3;
        }

        .p-button-icon.p-button-out {
            background-color: #ff9800 !important;
            border: 1px solid #ff9800;
        }
        .p-button-icon.p-button-complete{
            background-color: #4caf50 !important;
            border: 1px solid #4caf50;
        }


        /* .p-button:hover{
                                background-color: #10b981 !important;
                            }
                            .p-button-icon-only{
                                justify-content: center;
                            }
                            .p-button.p-button-icon-only{
                               
                                padding: 0.5rem 0;
                            } */
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
                                data-bs-trigger="hover" data-bs-placement="top" 
                                title="@lang('label.createNewBooking')" class="btn btn-danger mb-2">
                                <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addBooking')</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100"
                            id="bookings-datatable">
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
                                                <input type="checkbox" class="form-check-input"
                                                    id="customCheck{{ $booking->id }}">
                                                <label class="form-check-label"
                                                    for="customCheck{{ $booking->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($booking->guest->first_name . ' ' . $booking->guest->last_name, 15) }}
                                        </td>
                                        <td>
                                            @if ($booking->room && $booking->room->roomType)
                                                {{ $booking->room->room_number }} -
                                                {{ Str::limit($booking->room->roomType->type_name, 15) }}
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
                                            <span
                                                style="padding-top: 5px;padding-bottom: 4px;padding-left: 10px; border-radius: 20px; padding-right: 10px;"
                                                class="badge
                                                @if ($booking->status == 'Pending') bg-warning
                                                @elseif ($booking->status == 'Approved') bg-primary 
                                                @elseif ($booking->status == 'Checked-In') bg-info 
                                                @elseif ($booking->status == 'Checked-Out') bg-success 
                                                @elseif ($booking->status == 'Completed') bg-success 
                                                @elseif ($booking->status == 'Cancelled') bg-danger @endif">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="table-action">
                                            <!-- Status-based actions -->
                                            {{-- @if ($booking->status == 'Pending')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Approved']) }}"
                                                    class="p-button-icon p-button-approve"><i class="mdi mdi-check"></i></a>
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Cancelled']) }}" --}}
                                            @if ($booking->status == 'Pending')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Approved']) }}"
                                                    class="p-button-icon p-button-approve">
                                                    <i class="mdi mdi-check"></i>
                                                    <span class="tooltip">Approve</span>
                                                </a>
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Cancelled']) }}"
                                                    class="p-button-icon p-button-cancel">
                                                    <i class="mdi mdi-cancel"></i>
                                                    <span class="tooltip">Cancel</span>
                                                </a>
                                            @elseif ($booking->status == 'Approved')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Checked-In']) }}"
                                                    class="p-button-icon p-button-in"><i class="mdi mdi-login"></i>
                                                    <span class="tooltip">Check In</span>
                                                </a>
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Cancelled']) }}"
                                                    class="p-button-icon p-button-cancel"><i class="mdi mdi-cancel"></i>
                                                
                                                    <span class="tooltip">Cancel</span></a>
                                            @elseif ($booking->status == 'Checked-In')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Checked-Out']) }}"
                                                    class="p-button-icon p-button-out"><i class="mdi mdi-logout"></i>
                                                
                                                    <span class="tooltip">Check Out</span></a>
                                            @elseif ($booking->status == 'Checked-Out')
                                                <a href="{{ route('booking.status', ['id' => $booking->id, 'status' => 'Completed']) }}"
                                                    class="p-button-icon p-button-complete"><i
                                                        class="mdi mdi-check-all"></i>
                                                        <span class="tooltip">Complete</span>
                                                    </a>
                                            @endif

                                            <a href="{{ route('bookings.show', $booking->id) }}"
                                                class="action-icon text-success">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ url('bookings/' . $booking->id . '/edit') }}"
                                                class="action-icon text-primary">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            <a href="{{ url('bookings/' . $booking->id . '/delete') }}"
                                                onclick="confirmation(event)" class="action-icon text-danger">
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
        
    </script>
@endsection

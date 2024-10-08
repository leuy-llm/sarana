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
            /* Adjust the width as needed */
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .popover-body,
        .popover-header {
            font-family: 'Hanuman', 'serif' !important;
        }
    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [['title' => __('label.roomList'), 'url' => route('rooms.index')]];
        $currentPageTitle = __('label.roomList');
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
                        <table class="table table-centered table-striped dt-responsive nowrap w-100"
                            id="bookings-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
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
                                    <th style="width: 75px;">@lang('label.action')</th><!--style="width: 75px;"-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>

                                            {{ Str::limit($booking->guest->name, 5) }}


                                        </td>
                                        <td>

                                            @if ($booking->room && $booking->room->roomType)
                                                {{ $booking->room->room_number }} -
                                                {{ Str::limit($booking->room->roomType->type_name, 5) }}
                                            @else
                                                {{ $booking->room->room_number ?? 'N/A' }} -
                                                {{ $booking->room->roomType->type_name ?? 'N/A' }}
                                            @endif

                                        </td>

                                        <td>
                                            {{ Str::limit(\Carbon\Carbon::parse($booking->check_in_date)->translatedFormat('d F Y'), 10) }}
                                        </td>
                                        <td>
                                            {{ Str::limit(\Carbon\Carbon::parse($booking->check_out_date)->translatedFormat('d F Y'), 10) }}
                                        </td>

                                        <td class="">
                                            {{ $booking->total_adults }}
                                        <td>
                                            {{ $booking->total_children }}
                                        </td>

                                        <td>
                                            {{ Str::limit(\Carbon\Carbon::parse($booking->created_at)->translatedFormat('d F Y'), 10) }}
                                        </td>
                                        <td>
                                            @if ($booking->status == 'confirmed')
                                                <span class="badge badge-success-lighten">{{ $booking->status }}</span>
                                            @elseif ($booking->status == 'canceled')
                                                <span class="badge badge-danger-lighten">{{ $booking->status }}</span>
                                            @elseif ($booking->status == 'pending')
                                                <span class="badge badge-warning-lighten">{{ $booking->status }}</span>
                                            @endif
                                        </td>
                                        <td class="table-action">
                                            <a href="{{ route('rooms.show', $booking->id) }}" class="action-icon"> <i
                                                    class="mdi mdi-eye"></i></a>
                                            <a href="{{ url('bookings/' . $booking->id . '/edit') }}" class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ url('rooms/' . $booking->id . '/delete') }}"
                                                onclick="confirmation(event)" class="action-icon"> <i
                                                    class="mdi mdi-delete"></i></a>
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
                            className: "btn btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: confirm,
                            value: true,
                            visible: true,
                            className: "btn btn-primary",
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
        var displayRoom = @json(__('label.room'));
        var showingRoomText =
            "{{ __('label.showing_rooms', ['start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}";
    </script>
@endsection

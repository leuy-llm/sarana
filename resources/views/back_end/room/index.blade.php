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
            max-width: 150px;
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <form method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        {{-- <label class="form-label">@lang('label.roomTypeName')</label>
                                        <input type="text" name="roomTypeName" value="{{ Request::get('name') }}"
                                            placeholder="@lang('label.enterRoomTypeName') . . ." class="form-control filter"> --}}
                                        <label class="form-label">@lang('label.roomTypeName')</label>
                                        <select name="room_type_id" id="room_type_id" class="form-control select2"
                                            data-toggle="select2">
                                            <option value="" disabled selected>@lang('label.selectRoomType')</option>
                                            @foreach ($roomTypes as $roomType)
                                                <option value="{{ $roomType->id }}"
                                                    {{ Request::get('room_type_id') == $roomType->id ? 'selected' : '' }}>
                                                    {{ $roomType->type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <a href="{{ url('rooms/create') }}" tabindex="0" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="right" data-bs-content="@lang('label.roomCan')"
                                title="@lang('label.createNewRoom')" class="btn btn-danger mb-2">
                                <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addRoom')</a>
                        </div>
                        <div class="col-sm-3">
                            <div class="text-sm-start text-sm ">
                                <form action="{{ url('guest/export') }}" method="GET"
                                    class="d-flex justify-content-end  gap-2">
                                    <select name="type" class="form-control select2" data-toggle="select2">
                                        <option selected disabled>Select Type</option>
                                        <option value="xlsx">XLSX</option>
                                        <option value="csv">CVS</option>
                                        <option value="xls">XLS</option>
                                    </select>
                                    <button type="submit" style="width: 90px"
                                        class="btn btn-dark  mb-2">@lang('label.export')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100" id="rooms-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>@lang('label.roomTypeName')</th>
                                    <th>@lang('label.roomNumber')</th>
                                    <th>@lang('label.floor')</th>

                                    <th>@lang('label.description')</th>
                                    <th>@lang('label.price')</th>
                                    <th>@lang('label.date')</th>
                                    <th>@lang('label.status')</th>
                                    <th style="width: 75px;">@lang('label.action')</th><!--style="width: 75px;"-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $room->roomType->type_name }}
                                        </td>
                                        <td class="table-user">
                                            @if ($room->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                                    alt="table-user" class="rounded me-3" height="48">
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="javascript:void(0);"
                                                        class="text-body fw-semibold">{{ $room->room_number }}</a>
                                                </p>
                                            @else
                                                <img src="{{ asset('default-image.jpg') }}" alt="table-user"
                                                    class="me-2 rounded-circle">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $room->floor }}
                                        </td>
                                        <td>
                                            {{ Str::limit($room->description, 10) }}
                                        </td>
                                        <td>
                                            {{ $room->price }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i A', strtotime($room->created_at)) }}
                                        </td>
                                        <td>
                                            @if ($room->status == 'Available')
                                                <span class="badge badge-success-lighten">{{ $room->status }}</span>
                                            @elseif ($room->status == 'Booked')
                                                <span class="badge badge-danger-lighten">{{ $room->status }}</span>
                                            @elseif ($room->status == 'Maintenance')
                                                <span class="badge badge-warning-lighten">{{ $room->status }}</span>
                                            @endif
                                        </td>
                                        <td class="table-action">
                                            <a href="{{ route('rooms.show', $room->id) }}" class="action-icon"> <i
                                                    class="mdi mdi-eye"></i></a>
                                            <a href="{{ url('rooms/' . $room->id . '/edit') }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ url('rooms/' . $room->id . '/delete') }}"
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

        document.addEventListener('DOMContentLoaded', function() {
            var gallery = document.getElementById('image-gallery');
            var viewer = new Viewer(gallery, {
                inline: false, // Display the viewer inline
                navbar: true, // Show the navbar
                toolbar: true, // Show the toolbar
                title: true, // Show the title
                tooltip: true, // Show the tooltip
                movable: true, // Make the image movable
                zoomable: true // Make the image zoomable
            });
        });

        /*============= Tranlsate ==============*/
        /*============= Tranlsate ==============*/
        var displayText = @json(__('label.display'));
        var displayRoom = @json(__('label.room'));
        var showingRoomText =
            "{{ __('label.showing_rooms', ['start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}";
    </script>
@endsection

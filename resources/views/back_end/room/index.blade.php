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

        /* General styling for the switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #e64a3b;
            transition: 0.4s;
            border-radius: 34px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        input:checked+.slider {
            background-color: #4CAF50;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }

        .switch .slider::after {
            content: attr(data-tooltip);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            opacity: 0;
            pointer-events: none;
            white-space: nowrap;
            transition: opacity 0.3s ease, transform 0.3s ease;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        /* Triangle for the tooltip */
        .slider::before-tooltip {
            content: "";
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 6px;
            border-style: solid;
            border-color: transparent transparent #333 transparent;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .switch:hover .slider::after {
            opacity: 1;
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
                                        <label class="form-label">@lang('label.roomid')</label>
                                        <input type="number" min="0" name="room_id"
                                            value="{{ Request::get('room_id') }}" class="form-control "
                                            placeholder="@lang('label.enterId') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
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
                                        <input type="number" min="0" name="floor"
                                            value="{{ Request::get('floor') }}" class="form-control"
                                            placeholder="@lang('label.enterFloor') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-2">
                                        <label class="form-label">@lang('label.price')</label>
                                        <input type="number" min="0" name="price"
                                            value="{{ Request::get('price') }}" class="form-control"
                                            placeholder="@lang('label.enterPrice') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-2">
                                        <label class="form-label">@lang('label.status')</label>
                                        {{-- <select name="status" class="form-control select2" data-toggle="select2">
                                            <option selected disabled>@lang('label.selectStatus')</option>
                                            <option value="1" {{ Request::get('status') == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ Request::get('status') == 0 ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select> --}}
                                        <select name="status" class="form-control select2" data-toggle="select2">
                                            <option value="" selected disabled>@lang('label.selectStatus')</option>
                                            <option value="1" {{ Request::get('status') === '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ Request::get('status') === '0' ? 'selected' : '' }}>Inactive</option>
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
                                            data-bs-content="@lang('label.searchRoom')" data-bs-placement="top" title=""><i
                                                class="mdi mdi-filter"></i> @lang('label.search')
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ url('/rooms') }}" tabindex="0" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-content="@lang('label.resetGuest')"
                                            data-bs-placement="top" title="" class="btn btn-success"
                                            style="margin-top: 29px"><i class="mdi mdi-restore"></i> @lang('label.reset') </a>
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
                                class="btn btn-danger mb-2">
                                <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addRoom')</a>
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
                                    <th>@lang('label.maxPerson')</th>
                                    <th>@lang('label.status')</th>
                                    <th>@lang('label.date')</th>
                                    <th style="width: 75px;">@lang('label.action')</th><!--style="width: 75px;"-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>
                                            <div class="form-check" style="display: none">
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
                                            {{ $room->max_person }}
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('room.toggleActive', $room->id) }}">
                                                @csrf
                                                <label class="switch">
                                                    <input type="checkbox" onchange="this.form.submit()"
                                                        {{ $room->status ? 'checked' : '' }}
                                                        data-tooltip="{{ $room->status ? 'Active' : 'Inactive' }}">
                                                    <span class="slider round"></span>
                                                </label>
                                            </form>
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($room->created_at)) }}
                                        </td>
                                        <td class="table-action">
                                            <a href="{{ route('rooms.show', $room->id) }}"
                                                class="action-icon text-success"> <i class="mdi mdi-eye"></i></a>
                                            <a href="{{ url('rooms/' . $room->id . '/edit') }}"
                                                class="action-icon text-primary"> <i
                                                    class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ url('rooms/' . $room->id . '/delete') }}"
                                                onclick="confirmation(event)" class="action-icon text-danger"> <i
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
        document.querySelectorAll('.switch input').forEach(input => {
            const slider = input.nextElementSibling;
            slider.setAttribute('data-tooltip', input.checked ? 'Active' : 'Inactive');

            input.addEventListener('change', function() {
                slider.setAttribute('data-tooltip', this.checked ? 'Active' : 'Inactive');
            });
        });

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

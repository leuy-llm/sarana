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
        $breadcrumbs = [['title' => __('label.guests'), 'url' => route('guests.index')]];
        $currentPageTitle = __('label.guestList');
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
                                        <label class="form-label">@lang('label.guests')</label>
                                        <input type="text" name="name" value="{{ Request::get('name') }}"
                                            placeholder="@lang('label.guestName') . . ." class="form-control filter">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('label.phone')</label>
                                        <input type="number" name="mobile" value="{{ Request::get('mobile') }}"
                                            class="form-control " placeholder="@lang('label.phoneNumber') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('label.email')</label>
                                        <input type="email" name="email" value="{{ Request::get('email') }}"
                                            class="form-control " placeholder="@lang('label.email') . . .">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('label.date')</label>
                                        <input type="date" name="date" value="{{ Request::get('date') }}"
                                            class="form-control" placeholder="@lang('label.date') . . ."
                                            id="birthdatepicker ">
                                    </div>
                                </div>
                                <div class="col-sm-3 d-flex gap-2">
                                    <div class="mb-3">
                                        <button type="submit" style="margin-top: 29px;" class="btn btn-primary font"
                                            tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover"
                                            data-bs-content="@lang('label.searchGuest')" data-bs-placement="top"
                                            title="">@lang('label.search')</button>
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ url('/guests') }}" tabindex="0" data-bs-toggle="popover"
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
                            <a href="{{ url('guests/create') }}" tabindex="0" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="right"
                                data-bs-content="@lang('label.youcan')"
                                title="@lang('label.createNewGuest')" class="btn btn-danger mb-2">
                                <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addGuest')</a>
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
                        <table class="table table-centered table-striped dt-responsive nowrap w-100"
                            id="products-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>@lang('label.guest')</th>
                                    <th>@lang('label.phone')</th>
                                    <th>@lang('label.email')</th>
                                    <th>@lang('label.address')</th>
                                    <th>@lang('label.createDate')</th>
                                    <th>@lang('label.status')</th>
                                    <th style="width: 75px;">@lang('label.action')</th><!--style="width: 75px;"-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $guest)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td class="table-user">
                                            <img src="{{ asset('admin_dashboard') }}/assets/images/users/avatar-4.jpg"
                                                alt="table-user" class="me-2 rounded-circle">
                                            <a href="javascript:void(0);"
                                                class="text-body fw-semibold">{{ $guest->name }}</a>
                                        </td>
                                        <td>
                                            {{ $guest->mobile }}
                                        </td>
                                        <td>
                                            {{ $guest->email }}
                                        </td>
                                        <td>
                                            {{ Str::limit($guest->address, 34) }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i A', strtotime($guest->created_at)) }}
                                        </td>
                                        <td>
                                            <span class="badge badge-success-lighten">Active</span>
                                        </td>
                                        <td class="table-action">
                                            <a href="" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="{{ url('guests/' . $guest->id . '/edit') }}"
                                                class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ url('guests/' . $guest->id . '/delete') }}"
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
        var displayText = @json(__('label.display'));
        var displayGuest = @json(__('label.guest'));
        var showingGuestsText =
            "{{ __('label.showing_guests', ['start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}";
    </script>
@endsection

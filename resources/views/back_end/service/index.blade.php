@extends('layout.app')
@section('style')
    <style>
        .custom-toast1 {
            background-color: #f8f9fa;
            /* Default background color */
            color: #212529;
            /* Default text color */
            border: 1px solid #ced4da;
            /* Default border color */
            border-radius: 5px;
            /* Rounded corners */
            padding: 10px;
            /* Padding inside the toast */
            font-size: 14px;
            /* Font size */
            font-family: Arial, sans-serif;
            /* Font family */
        }

        .custom-toast-success {
            background-color: #155724;
            /* Success background color */
            color: #fff;
            /* Success text color */
        }

        .custom-toast-error {
            background-color: #721c24;
            /* Error background color */
            color: #fff;
            /* Error text color */
        }

        .toast-success.custom-toast {
            background-color: #0acf97 !important;
            /* Your desired background color */
        }

        .toast-error.custom-toast {
            background-color: #f44336 !important;
            /* Your desired error background color */
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
    <div iv class="container-fluid">
        @php
            $breadcrumbs = [['title' => __('label.service'), 'url' => route('services.index')]];
            $currentPageTitle = __('label.serviceList');
        @endphp
        @include('layout.breadcrumbs', [
            'breadcrumbs' => $breadcrumbs,
            'currentPageTitle' => $currentPageTitle,
        ])
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{ url('services/create') }}" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover" data-bs-placement="top" title="@lang('label.createNewService')"
                                    class="btn btn-danger mb-2">
                                    <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addService')</a>
                            </div>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-centered w-100 dt-responsive nowrap"
                                id="service-datatable">
                                <thead class="table-dark">
                                    <tr class="even">
                                        <th class="all" style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th class="all">@lang('label.image')</th>
                                        <th class="all">@lang('label.title')</th>
                                        <th class="all">@lang('label.description')</th>
                                        <th class="all">@lang('label.status')</th>
                                        <th>@lang('label.date')</th>

                                        <th style="width: 85px;">@lang('label.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $data)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $data->image) }}" alt="table-user"
                                                    class="rounded me-3" height="48">
                                            </td>
                                            <td>
                                                {{ $data->title }}
                                            </td>
                                            <td>
                                                {{ Str::limit($data->description, 10) }}
                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('service.toggleActive', $data->id) }}">
                                                    @csrf
                                                    <label class="switch">
                                                        <input type="checkbox" onchange="this.form.submit()"
                                                            {{ $data->status ? 'checked' : '' }}
                                                            data-tooltip="{{ $data->status ? 'Active' : 'Inactive' }}">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="table-action">

                                                <a href="{{ url('services/' . $data->id . '/edit') }}" id="roomTypeEdit"
                                                    class="action-icon text-primary"> <i
                                                        class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="{{ url('services/' . $data->id . '/delete') }}"
                                                    onclick="confirmation(event)" class="action-icon text-danger"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
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
        // $(document).ready(function() {
        //     $('body').on('click', '#roomTypeEdit', function(event) {
        //         event.preventDefault();
        //         var url = $(this).data('url');
        //         $.get(url, function(data) {
        //             // Populate the form fields with the data
        //             $('#editRoomType').modal('show');
        //             $('#edit-id').val(data.id);
        //             $('#edit-type_name').val(data.type_name);
        //             // Update form action URL if necessary
        //             $('form').attr('action', '{{ url('roomtypes/') }}/' + data.id);
        //         });
        //     });
        // });

        // Handle form submission via AJAX
        // $('#editRoomType form').on('submit', function(event) {
        //     event.preventDefault();
        //     var form = $(this);
        //     var action = form.attr('action');
        //     var formData = form.serialize();

        //     $.ajax({
        //         url: action,
        //         type: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             $('#editRoomType').modal('hide');
        //             showSuccessNotification(response.success);
        //         },
        //         error: function(xhr) {
        //             var errorMsg = xhr.responseJSON.error || 'An error occurred';
        //             showErrorNotification(errorMsg);
        //         }
        //     });
        // });
        //Message alert
        // Function to show success notification
        // Custom function to show success notification
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
                "toastClass": "custom-toast1 custom-toast-success"
            };

            toastr.success(message);
        }


        // Custom function to show error notification
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
                "toastClass": "custom-toast1 custom-toast-error"
            };

            toastr.error(message);
        }

        ! function(i) {
            "use strict";
            i("#toastr-one").on("click", function(t) {
                i.NotificationApp.send("Heads up!",
                    "This alert needs your attention, but it is not super important.", "top-right",
                    "rgba(0,0,0,0.2)", "info");
            });

            // Custom function to show success notification
            function showSuccess(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "4000", // Increase duration for slow show
                    "hideDuration": "2000", // Increase duration for slow hide
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

            function showError(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000", // Slow fade in
                    "hideDuration": "3000", // Slow fade out
                    "timeOut": "7000", // Time before the notification disappears
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "toastClass": "custom-toast"
                }

                toastr.error(message);
            }

            // Check for session success message and display it
            @if (session('success'))
                showSuccess('{{ session('success') }}');
            @endif

            // Check for session error message and display it
            @if (session('error'))
                showError('{{ session('error') }}');
            @endif
        }
        (window.jQuery);



        /* =============== Remove RoomType ============ */


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
    </script>
@endsection

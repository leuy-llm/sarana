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
        $breadcrumbs = [['title' => __('label.Setting'), 'url' => route('guests.index')]];
        $currentPageTitle = __('label.Settings');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 style="margin-top: -10px">@lang('label.aboutUs')</h4>
                        {{-- Removed the Create button for brevity --}}
                        @foreach ($abouts as $data)
                            <a href="{{ url('settings/' . $data->id . '/edit') }}" id="roomTypeEdit" class="action-icon"
                                data-id="{{ $data->id }}">
                                <i class="mdi mdi-square-edit-outline fs-3"></i>
                            </a>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h5>@lang('label.Title')</h5>
                            @foreach ($abouts as $data)
                                <p id="{{ $data->id }}">{{ $data->title }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12 mb-2">
                            <h5>@lang('label.description')</h5>
                            @foreach ($abouts as $data)
                                <p id="{{ $data->id }}">{{ $data->description }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12 mb-2">
                            <h5>@lang('label.image')</h5>
                            @foreach ($abouts as $data)
                                <p id="{{ $data->id }}">{{ $data->image }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('back_end.setting.edit')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Populate modal form when edit button is clicked
            $('body').on('click', '#roomTypeEdit', function(event) {
                event.preventDefault();
                var url = $(this).attr('href');

                $.get(url, function(data) {
                    $('#standard-modal').modal('show');
                    $('#edit-id').val(data.id);
                    $('#edit-site_title').val(data.site_title);
                    $('#edit-site_logo').val(''); // Clear the file input

                    // Reset image preview
                    $('#image-preview').hide().attr('src', '');

                    // Set form action dynamically based on data.id
                    $('#edit-form').attr('action', '{{ url('settings/') }}/' + data.id);
                });
            });

            // Show image preview when a file is selected
            $('#edit-site_logo').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result).show();
                    }

                    reader.readAsDataURL(file);
                } else {
                    // Hide the preview if no file is selected
                    $('#image-preview').hide();
                }
            });

            // Handle form submission via AJAX
            $('#edit-form').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                var action = form.attr('action');

                // Create a FormData object
                var formData = new FormData(this);

                $.ajax({
                    url: action,
                    type: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from automatically transforming the data into a query string
                    contentType: false, // Let jQuery set the Content-Type header
                    success: function(response) {
                        $('#standard-modal').modal('hide');
                        showSuccessNotification(response.success);
                        // Optionally, refresh data on the page or update the DOM dynamically
                    },
                    error: function(xhr) {
                        var errorMsg = xhr.responseJSON && xhr.responseJSON.error ? xhr
                            .responseJSON.error : 'An error occurred';
                        showErrorNotification(errorMsg);
                    }
                });
            });
        });



        // Functions for notifications
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

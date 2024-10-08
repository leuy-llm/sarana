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
                        <h4 style="margin-top: -10px">@lang('label.generalSetting')</h4>
                     
                        @foreach ($settings as $data)
                            < <a href="{{ url('settings/' . $data->id . '/edit') }}" class="action-icon"> <i
                                class="mdi mdi-square-edit-outline fs-3"></i></a>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h5>@lang('label.siteTitle')</h5>
                            @foreach ($settings as $data)
                                <p id="site-title-{{ $data->id }}">{{ $data->site_title }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12 mb-2">
                            <h5>@lang('label.siteLogo')</h5>
                            @foreach ($settings as $data)
                                <img id="site-logo-{{ $data->id }}" src="{{ asset('storage/' . $data->site_logo) }}"
                                    alt="table-user" class="rounded me-3 "
                                    style="border: 2px solid rgba(70, 48, 48, 0.112); padding: 2px" height="120">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 style="margin-top: -10px">@lang('label.aboutUs')</h4>
                        {{-- Removed the Create button for brevity --}}

                        @foreach ($abouts as $data)
                            <a href="{{ url('abouts/edit/' . $data->id) }}" class="action-icon"
                                data-id="{{ $data->id }}">
                                <i class="mdi mdi-square-edit-outline fs-3"></i>
                            </a>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h5>@lang('label.title')</h5>
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
                                <img id="site-logo-{{ $data->id }}" src="{{ asset('storage/' . $data->image) }}"
                                    alt="table-user" class="rounded me-3 " style="" height="120">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 style="margin-top: -10px">@lang('label.contactSetting')</h4>
                        @foreach ($contacts as $data)
                            <a href="{{ url('contacts/edit/' . $data->id) }}" class="action-icon" data-id="{{ $data->id }}">
                                <i class="mdi mdi-square-edit-outline fs-3"></i>
                            </a>
                        @endforeach
                    </div>
                    <div class="row">
                        @foreach($contacts as $data)
                        <div class="col-md-6 ">
                            <div class="mb-4">
                                <h5 class="card-subtitle mb-1 fw-bold">@lang('label.address')</h5>
                                <p class="card-text" id="address">{{$data->address}}</p>
                            </div>
                            <div class="mb-4">
                                <h5 class="card-subtitle mb-1 fw-bold">@lang('label.googleMap')</h5>
                                <p class="card-text" id="gmap">{{$data->gmap}}</p>
                            </div>
                            <div class="mb-4">
                                <h5 class="card-subtitle mb-1 fw-bold">@lang('label.phones')</h5>
                                <p class="card-text"> 
                                    <i class="mdi mdi-phone" style="margin-right: 10px"></i>
                                    <span id="phone" >{{$data->pn1}}</span>
                                </p>
                                <p class="card-text"> 
                                    <i class="mdi mdi-phone" style="margin-right: 10px"></i>
                                    <span id="phone" >{{$data->pn2}}</span>
                                </p>
                                <p class="card-text"> 
                                    <i class="mdi mdi-phone" style="margin-right: 10px"></i>
                                    <span id="phone" >{{$data->pn3}}</span>
                                </p>
                            </div>
                            <div class="mb-4">
                                <h5 class="card-subtitle mb-1 fw-bold">@lang('label.email')</h5>
                                <p class="card-text" id="gmap">{{$data->email}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="card-subtitle mb-1 fw-bold">@lang('label.socialLink')</h5>
                                <p class="card-text"> 
                                    <i class="mdi mdi-facebook  fs-4 text-primary" style="margin-right: 10px"></i>
                                    <span>{{$data->fb}}</span>
                                </p>
                                <p class="card-text"> 
                                    <i class="mdi mdi-instagram fs-4 text-warning " style="margin-right: 10px"></i>
                                    <span id="insta" >{{$data->insta}}</span>
                                </p>
                                <p class="card-text"> 
                                    <i class="mdi mdi-telegram fs-4 text-primary" style="margin-right: 10px"></i>
                                    <span>{{$data->tele}}</span>
                                </p>
                                <p class="card-text"> 
                                    <i class="mdi mdi-compass-outline fs-4 text-primary" style="margin-right: 10px"></i>
                                    <span >{{$data->tripa}}</span>
                                </p>
                            </div>
                            <div class="mb-4">
                                <h5 class="card-subtitle mb-1 fw-bold">@lang('label.iFrame')</h5>
                                <iframe src="{{$data->iframe}}" width="100%" height="350px" frameborder="10"></iframe>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
  
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

       
        /* ============ Edit About ===============*/
        $(document).ready(function() {
            // Populate modal form when edit button is clicked
            $('body').on('click', '#aboutEdit', function(event) {
                event.preventDefault();
                var url = $(this).attr('href');

                $.get(url, function(data) {
                    $('#standards-modal').modal('show');
                    $('#edit_id').val(data.id);
                    $('#edit_title').val(data.title);
                    $('#edit_description').val(data.description);
                    $('#edit_image').val(''); // Clear the file input

                    // Reset image preview
                    $('#image-preview').hide().attr('src', '');

                    // Set form action dynamically based on data.id
                    $('#edit-forms').attr('action', '{{ route('abouts.update', '') }}/' + data.id);
                });
            });

            // Show image preview when a file is selected
            $('#edit_image').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#image-previews').attr('src', e.target.result).show();
                    }

                    reader.readAsDataURL(file);
                } else {
                    // Hide the preview if no file is selected
                    $('#image-previews').hide();
                }
            });

            // Handle form submission via AJAX
            $('#edit-forms').on('submit', function(event) {
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
                        $('#standards-modal').modal('hide');
                        showSuccessNotification(response.success);
                        // Optionally, refresh data on the page or update the DOM dynamically
                    },
                    error: function(xhr) {
                        var errorMsg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'An error occurred';
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

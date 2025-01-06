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
    </style>
@endsection

@section('content')
    <div iv class="container-fluid">
        @php
            $breadcrumbs = [['title' => __('label.banner'), 'url' => route('queries.index')]];
            $currentPageTitle = __('label.bannerList');
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
                            <div class="col-sm-9">
                                <a href="{{ route('banner.create') }}" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover" data-bs-placement="top" 
                                    title="@lang('label.createNewBanner')" class="btn btn-danger mb-2">
                                    <i class="mdi mdi-plus-circle me-1"></i>@lang('label.addBanner')</a>
                            </div>
    
                        </div>
                        <div class="table-responsive">
                            <table class="table table-centered table-striped w-100 dt-responsive nowrap" id="banner-datatable">
                                <thead class="table-dark">
                                    <tr class="even">
                                        <th class="all" style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th class="all">@lang('label.pageName')</th>
                                        <th class="all">@lang('label.bannerImage')</th>
                                        <th class="all">@lang('label.date')</th>
                                        <th style="width: 85px;">@lang('label.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banner as $data)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $data->page_name }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $data->banner_image) }}" 
                                                    class="rounded me-3" height="70px" width="100px">
                                            </td>
                                            <td>
                                                {{ date('d-m-Y H:i A', strtotime($data->created_at)) }}
                                            </td>
                                            <td class="table-action">
                                                  
                                                 <form id="mark-as-read-form-{{ $data->id }}" action="{{ url('queries/' . $data->id . '/mark-as-read') }}" method="POST" style="display: none;">
                                                     @csrf
                                                     @method('PUT')
                                                 </form>
                                                <a href="{{ route('banner.delete',$data->id) }}"
                                                    onclick="confirmation(event)" class="action-icon"> 
                                                    <i class="mdi mdi-delete text-danger" style=""></i></a>
                                                      
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


        /*============= Tranlsate ==============*/
        var displayText = @json(__('label.display'));
        var displayBanner = @json(__('label.banner'));
        var showingBannerText =
            "{{ __('label.showing_banners', ['start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}";
    </script>
@endsection

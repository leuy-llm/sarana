<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title style="font-family: 'Hanuman', 'serif'!important;">{{ !empty($header_title) ? $header_title : '' }} @lang('label.for_hotel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Hotel Reservation" name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_dashboard') }}/assets/images/favicon.ico">
    <!-- third party css -->
    <link href="{{ asset('admin_dashboard') }}/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('admin_dashboard') }}/assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet"
        type="text/css">
    <!-- Datatables css -->
    <link href="{{ asset('admin_dashboard') }}/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet"
        type="text/css" />
    <!-- App css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('admin_dashboard') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_dashboard') }}/assets/css/app.min.css" rel="stylesheet" type="text/css"
        id="light-style">
    <link href="{{ asset('admin_dashboard') }}/assets/css/app-dark.min.css" rel="stylesheet" type="text/css"
        id="dark-style">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">

    {{-- <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" /> --}}
    <!-- Fine Uploader styles -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fine-uploader/5.16.2/fine-uploader-new.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" /> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/css/lightgallery.min.css">
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/plugins/thumbnail/lg-thumbnail.min.css"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/viewerjs@1.10.1/dist/viewer.min.css">
    <script src="https://cdn.jsdelivr.net/npm/viewerjs@1.10.1/dist/viewer.min.js"></script>
    <!-- third party css -->
    <link href="{{ asset('admin_dashboard') }}/assets/css/vendor/fullcalendar.min.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <!-- JavaScript -->
       
            @yield('style')
                <style >
                   
                .font {
                    font - family: 'Hanuman', 'serif'!important;
                }
                body {
                    font-family: 'Hanuman', 'serif'!important;
    
                }
                #products-datatable td {
                    font - size: 13px
                }
                #product-datatable tr: nth - child(odd) td
                {
                    background: #f1f3fa;
                    font-size: 13px
                }
                label
                {
                    font-family: 'Hanuman', 'serif' !important; 
                } 
                ::placeholder {
                    font-size: 12px;
                }
                .popover-body,
                .popover-header {
                    font-family: 'Hanuman', 'serif'!important;
                }

                </style> 
                </head>
                <body class ="loading" data-layout-config = '{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}' >
                    <div class = "wrapper" >
                    
                    !-- === === === = Left Sidebar Start === === === = -- >
                    @include('layout.sidebar') 
                    <div class = "content-page" >
                        <div class = "content" >                    
                        @include('layout.navbar') 
                    
                        <div class = "container-fluid" >
                        
                            @yield('content') 
                        </div>
                </div>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/app.min.js"></script>

        <!-- Apex js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/apexcharts.min.js"></script>

        <!-- Todo js -->
        {{-- <script src="{{ asset('admin_dashboard') }}/assets/js/ui/component.todo.js"></script> --}}

        <!-- demo app -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.dashboard-crm.js"></script>

        <!-- third party js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/dataTables.bootstrap5.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/dataTables.responsive.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/responsive.bootstrap5.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/dataTables.checkboxes.min.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.customers.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.payment.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.products.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.rooms.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.permission.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.role.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.userquery.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.banner.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.users.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.bookings.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.facilitys.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.services.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.gallerys.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.meetings.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.restaurants.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.tours.js"></script>

        <!-- Typehead -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/handlebars.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/typeahead.bundle.min.js"></script>
        
        <!-- Demo -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.typehead.js"></script>

        <!-- Timepicker -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.timepicker.js"></script>
        <!-- demo js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.toastr.js"></script>
        <!-- -->

        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.datatable-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
        <!-- end demo js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/dataTables.buttons.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/buttons.bootstrap5.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/buttons.html5.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/buttons.flash.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fine-uploader/5.16.2/fine-uploader.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/lightgallery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/plugins/zoom/lg-zoom.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!-- third party js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/fullcalendar.min.js"></script>
        <!-- third party js ends -->
        <!-- demo app -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.calendar.js"></script>
        
        @yield('script')
        
        </body>

</html>

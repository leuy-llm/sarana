<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ !empty($header_title) ? $header_title : '' }} - Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <!-- Fine Uploader styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fine-uploader/5.16.2/fine-uploader-new.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/css/lightgallery.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/plugins/thumbnail/lg-thumbnail.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/viewerjs@1.10.1/dist/viewer.min.css">
    <script src="https://cdn.jsdelivr.net/npm/viewerjs@1.10.1/dist/viewer.min.js"></script>
    <!-- third party css -->
    <link href="{{ asset('admin_dashboard') }}/assets/css/vendor/fullcalendar.min.css" rel="stylesheet" type="text/css">
    <!-- third party css end -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/air-datepicker@2.2.3/dist/css/datepicker.min.css" />

        <!-- JavaScript -->
        <script src="https://unpkg.com/air-datepicker@2.2.3/dist/js/datepicker.min.js"></script>
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

                <body class = "loading" data-layout-config = '{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}' >
                
                
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
        
        <div class="end-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="end-bar-toggle float-end">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar="">
                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <!-- Settings -->
                    <h5 class="mt-3">Color Scheme</h5>
                    <hr class="mt-1">

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light"
                            id="light-mode-check" checked="">
                        <label class="form-check-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark"
                            id="dark-mode-check">
                        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                    </div>

                    <!-- Width -->
                    <h5 class="mt-4">Width</h5>
                    <hr class="mt-1">
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check"
                            checked="">
                        <label class="form-check-label" for="fluid-check">Fluid</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="width" value="boxed"
                            id="boxed-check">
                        <label class="form-check-label" for="boxed-check">Boxed</label>
                    </div>

                    <!-- Left Sidebar -->
                    <h5 class="mt-4">Left Sidebar</h5>
                    <hr class="mt-1">
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="default"
                            id="default-check">
                        <label class="form-check-label" for="default-check">Default</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="light"
                            id="light-check" checked="">
                        <label class="form-check-label" for="light-check">Light</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="theme" value="dark"
                            id="dark-check">
                        <label class="form-check-label" for="dark-check">Dark</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="fixed"
                            id="fixed-check" checked="">
                        <label class="form-check-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="condensed"
                            id="condensed-check">
                        <label class="form-check-label" for="condensed-check">Condensed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="scrollable"
                            id="scrollable-check">
                        <label class="form-check-label" for="scrollable-check">Scrollable</label>
                    </div>

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                        <a href="../../product/hyper-responsive-admin-dashboard-template/index.htm"
                            class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase
                            Now</a>
                    </div>
                </div> <!-- end padding-->
            </div>
        </div>

        <div class="rightbar-overlay"></div>
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor.min.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/app.min.js"></script>

        <!-- Apex js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/apexcharts.min.js"></script>

        <!-- Todo js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/ui/component.todo.js"></script>

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
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.products.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.rooms.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.permission.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.role.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.userquery.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.users.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.bookings.js"></script>
        <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.facilitys.js"></script>

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

        <!-- plugin js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/dropzone.min.js"></script>
        <!-- init js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/ui/component.fileupload.js"></script>

        <!-- Datatables js -->


        <!-- Datatable Init js -->
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
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/lightgallery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.3.0/plugins/zoom/lg-zoom.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- third party js -->
        <script src="{{ asset('admin_dashboard') }}/assets/js/vendor/fullcalendar.min.js"></script>
        <!-- third party js ends -->

        
    <!-- demo app -->
    <script src="{{ asset('admin_dashboard') }}/assets/js/pages/demo.calendar.js"></script>
    <!-- end demo js-->


        @yield('script')
        </body>

</html>

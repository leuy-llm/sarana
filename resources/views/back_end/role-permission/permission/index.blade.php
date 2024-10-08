@extends('layout.app')
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
                        <div class="col-sm-9">
                            <a href="{{ url('permissions/create') }}" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover"
                                data-bs-placement="right" data-bs-content="@lang('label.roomCan')" title="@lang('label.createNewRoom')"
                                class="btn btn-danger mb-2">
                                <i class="mdi mdi-plus-circle me-1"></i> @lang('label.addRoom')</a>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100"
                            id="permission-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>@lang('label.name')</th>
                                    <th>@lang('label.guardName')</th>
                                    
                                    <th>@lang('label.date')</th>
                                   
                                    <th style="width: 75px;">@lang('label.action')</th><!--style="width: 75px;"-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $permission->name }}
                                        </td>
                                        <td>
                                            {{ $permission->guard_name }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($permission->created_at)->translatedFormat('d F Y') }}
                                        </td>
                                        
                                        <td class="table-action">
                                            {{-- <a href="{{ route('rooms.show', $permission->id) }}" class="action-icon"> <i
                                                    class="mdi mdi-eye"></i></a> --}}
                                            <a href="{{ url('permissions/' . $permission->id . '/edit') }}" class="action-icon"> <i
                                                    class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ url('permissions/' . $permission->id . '/delete') }}"
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
        var displayPermission = @json(__('label.permission'));
        var showingPermissionText =
            "{{ __('label.showing_permissions', ['start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}";
    </script>
@endsection

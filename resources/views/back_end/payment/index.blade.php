   {{-- @extends('layout.app')
@section('style')
@endsection

@section('content')
  <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Payment</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered w-100 dt-responsive nowrap" id="payment-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th class="all">@lang('label.payment_intent_id')</th>
                                    <th class="all">@lang('label.guestName')</th>
                                    <th class="all">@lang('label.room')</th>
                                   
                                    <th class="all">@lang('label.date')</th>
                                    <th class="all">@lang('label.status')</th>
                                    <th class="all">@lang('label.amount')</th>
                                    <th class="all">@lang('label.method')</th>
                                    <th style="width: 85px;">@lang('label.action')</th>
                                </tr>
                            <tbody>

                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{ $payment->payment_intent_id }}</td>
                                        <td>{{ $payment->booking->guest->first_name ?? 'N/A' }}
                                            {{ $payment->booking->guest->last_name ?? '' }}</td>
                                        <td>{{ $payment->booking->room->roomType->type_name ?? 'N/A' }} -
                                            (Room number {{ $payment->booking->room->room_number ?? 'N/A' }})
                                        </td>
                                        <td>{{$payment->created_at->format('m-d-y')}}</td>

                                       
                                        <td>{{ $payment->status }}</td>
                                        <td>{{ $payment->amount }} {{ $payment->currency }} </td>
                                        <td>{{ $payment->payment_method }}</td>
                                        <td class="table-action">
                                            <a href="}"
                                                class="action-icon text-success"> <i class="mdi mdi-eye"></i>
                                            </a>
                                            </a>
                                            <a href=""
                                                class="action-icon text-primary"> <i
                                                    class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            <a href=""
                                                onclick="confirmation(event)" class="action-icon  text-danger"> <i
                                                    class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                    @endforeach
                    </tbody>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> 
    
@endsection --}}
   @extends('layout.app')
   @section('style')
       <style>
           .toast-success.custom-toast {
               background-color: #0acf97 !important;

           }

           .toast-error.custom-toast {
               background-color: #f44336 !important;

           }

           .text-truncate {
               max-width: 150px;

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
           $breadcrumbs = [['title' => __('label.payment'), 'url' => route('payments.index')]];
           $currentPageTitle = __('label.paymentList');
       @endphp
       @include('layout.breadcrumbs', [
           'breadcrumbs' => $breadcrumbs,
           'currentPageTitle' => $currentPageTitle,
       ])
       {{-- <div class="row">
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
                                            data-bs-content="@lang('label.searchGuest')" data-bs-placement="top"> <i
                                                class="mdi mdi-filter"></i> @lang('label.search')</button>
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ url('/guests') }}" tabindex="0" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-content="@lang('label.resetGuest')"
                                            data-bs-placement="top" title="" class="btn btn-success"
                                            style="margin-top: 29px"><i class="mdi mdi-restore"></i> @lang('label.reset')</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-body">

                       <div class="table-responsive">
                           <table class="table table-centered table-striped dt-responsive nowrap w-100"
                               id="payment-datatable">
                               <thead class="table-dark">
                                   <tr>
                                       <th style="width: 20px;">
                                           <div class="form-check">
                                               <input type="checkbox" class="form-check-input" id="customCheck1">
                                               <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                           </div>
                                       </th>
                                       <th class="all">@lang('label.payment_intent_id')</th>
                                       <th class="all">@lang('label.guestName')</th>
                                       <th class="all">@lang('label.room')</th>

                                       <th class="all">@lang('label.date')</th>
                                       <th class="all">@lang('label.status')</th>
                                       <th class="all">@lang('label.amount')</th>
                                       <th class="all">@lang('label.method')</th>

                                       <th style="width: 75px;">@lang('label.action')</th><!--style="width: 75px;"-->
                                   </tr>
                               </thead>
                               <tbody>
                                   @foreach ($payments as $payment)
                                       <tr>
                                           <td>
                                               <div class="form-check">
                                                   <input type="checkbox" class="form-check-input" id="customCheck2">
                                                   <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                               </div>
                                           </td>
                                           <td>{{ $payment->payment_intent_id }}</td>
                                           <td>{{ $payment->booking->guest->first_name ?? 'N/A' }}
                                               {{ $payment->booking->guest->last_name ?? '' }}</td>
                                           <td>{{ $payment->booking->room->roomType->type_name ?? 'N/A' }}
                                           </td>
                                           <td>{{ $payment->created_at->format('m-d-y') }}</td>
                                           <td>{{ $payment->status }}</td>
                                           <td>${{ number_format($payment->amount, 2) }} </td>
                                           <td>{{ $payment->payment_method }}</td>
                                           <td class="table-action">
                                               {{-- <a href="{{ url('payments/' . $payment->payment_id . '/delete') }}" onclick="confirmation(event)"
                                                   class="action-icon  text-danger"> <i class="mdi mdi-delete"></i>
                                               </a> --}}
                                               <a href="{{ route('payments.destroy', $payment->payment_id) }}"
                                                   onclick="confirmation(event)" class="action-icon text-danger">
                                                   <i class="mdi mdi-delete"></i>
                                               </a>
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

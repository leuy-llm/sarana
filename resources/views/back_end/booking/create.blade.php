@extends('layout.app')
@section('style')
    <style>
        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }

        .filepond--panel-root {
            border-radius: 2em;
            background-color: #edf0f4;
            height: 1em;
        }

        .filepond--item-panel {
            background-color: #595e68;
        }

        .filepond--drip-blob {
            background-color: #7f8a9a;
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
        }

        .upload-box:hover {
            border-color: #999;
        }

        /* Style the gallery container */
        #lightgallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        #image-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            row-gap: 20px;
            column-gap: 1rem;
            width: 100%;
        }

        #image-gallery img {
            max-width: 1;
            width: 100%;
            display: block;
            height: 250px;
            cursor: pointer;
        }

        /* Style individual gallery items */
        #lightgallery a {
            display: block;
            width: 200px;
            /* Adjust the width as needed */
            height: auto;
            margin: 10px;
        }

        /* Style the images */
        #lightgallery img {
            width: 100%;
            height: auto;
            display: block;

        }

        /* Custom styles for LightGallery */
        .lg-outer .lg-thumb-outer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .lg-outer .lg-thumb-outer .lg-thumb {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.roomList'), 'url' => route('rooms.index')],
            ['title' => __('label.createRoom'), 'url' => route('rooms.create')],
        ];
        $currentPageTitle = __('label.createRooms');
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
                        <div class="col-sm-4">
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary btn-rounded mb-2"><span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                        <form class="needs-validation" enctype="multipart/form-data" action="{{ url('/bookings') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.guestName') <span class="text-danger">*</span></label>
                                    <select name="guest_id" required class="form-control select2" data-toggle="select2">
                                        <option value="" selected disabled>Select Guest</option>
                                        @foreach ($guests as $guest)
                                            <option value="{{ $guest->id }}">{{ $guest->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkIn') <span class="text-danger">*</span></label>
                                    <input type="date" id="check_in_date" name="check_in_date"
                                        value="{{ old('check_in_date') }}"
                                        class="form-control checkin_date  @error('check_in_date') is-invalid @enderror "
                                        required="">
                                    @error('check_in_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.checkOut') <span class="text-danger">*</span></label>
                                    <input type="date" id="check_out_date" value="{{ old('check_out_date') }}"
                                        name="check_out_date"
                                        class="form-control  @error('check_out_date') is-invalid @enderror " required="">
                                    @error('check_out_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.avaiableRoom') <span class="text-danger">*</span></label>
                                    <select name="room_id" required="" class="form-control room-list select2"
                                        data-toggle="select2">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.totalAdults') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('total_adults') }}" name="total_adults"
                                        class="form-control  @error('total_adults') is-invalid @enderror "
                                        placeholder="@lang('label.entertoalAdult') . . ." required="">
                                    @error('total_adults')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.totalChildren') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('total_children') }}" name="total_children"
                                        class="form-control  @error('total_children') is-invalid @enderror "
                                        placeholder="@lang('label.entertotalChildren') . . ." required="">
                                    @error('total_children')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2" data-toggle="select2">
                                        <option value="" selected disabled>Choose Status</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="canceled">Canceled</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>

                        <a href="{{ url('bookings') }}" class="btn btn-light btn-rounded ">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>

        </div>

    </div>



    </div>
@endsection
@section('script')
    <script>
        // document.getElementById('check_in_date').addEventListener('change', function() {
        //     var checkInDate = this.value; // Get the selected check-in date
        //     document.getElementById('check_out_date').setAttribute('min',
        //     checkInDate); // Set the min attribute of check-out date
        // });

        // $(document).ready(function() {
        //     $(".checkin_date").on('blur', function() {

        //         var _checkindate = $(this).val();
        //         console.log(_checkindate);

        //         //Ajax
        //         $.ajax({
        //             url: "{{ url('bookings') }}/available-rooms/" + _checkindate,
        //             dataType: 'json',
        //             beforSend: function() {
        //                 $(".room-list").html('<option>--- Loading ---</option>');
        //             },
        //             success: function(res) {

        //                 var _html = '';
        //                 $.each(res.data, function(index, row) {

        //                     _html += '<option value="' + row.id + '">' + row.room_number + ' - ' + row.type_name +
        //                         '</option>';
        //                 });

        //                 $(".room-list").html(_html);

        //             }
        //         })

        //     })
        // })
        document.addEventListener('DOMContentLoaded', function() {
            var checkInDateInput = document.getElementById('check_in_date');
            var checkOutDateInput = document.getElementById('check_out_date');

            // Initially disable the check-out date input
            checkOutDateInput.disabled = true;

            // Set the min attribute for check-out date based on check-in date selection
            checkInDateInput.addEventListener('change', function() {
                var checkInDate = this.value; // Get the selected check-in date

                // Enable the check-out date input
                checkOutDateInput.disabled = false;

                // Set the minimum date for check-out date to be the selected check-in date
                checkOutDateInput.setAttribute('min', checkInDate);

                // Clear check-out date if it is before the new check-in date
                if (checkOutDateInput.value < checkInDate) {
                    checkOutDateInput.value = ''; // Clear the value if invalid
                }
            });

            // Fetch available rooms based on check-in date
            $(document).ready(function() {
                $(".checkin_date").on('blur', function() {
                    var _checkindate = $(this).val();
                    console.log(_checkindate);

                    // Ajax to get available rooms based on check-in date
                    $.ajax({
                        url: "{{ url('bookings') }}/available-rooms/" + _checkindate,
                        dataType: 'json',
                        beforeSend: function() {
                            $(".room-list").html('<option>--- Loading ---</option>');
                        },
                        success: function(res) {
                            var _html = '';
                            $.each(res.data, function(index, row) {
                                _html += '<option value="' + row.id + '">' + row
                                    .room_number + ' - ' + row.type_name +
                                    '</option>';
                            });
                            $(".room-list").html(_html);
                        }
                    });
                });
            });
        });
    </script>
@endsection

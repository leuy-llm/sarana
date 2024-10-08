@extends('layout.app')
@section('content')
@php
$breadcrumbs = [
    ['title' => __('label.guests'), 'url' => route('guests.index')],
    ['title' => __('label.createGuest'), 'url' => route('guests.create')]
];
$currentPageTitle =  __('label.newGuest');
@endphp
@include('layout.breadcrumbs', ['breadcrumbs' => $breadcrumbs, 'currentPageTitle' => $currentPageTitle])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ url('guests') }}"  tabindex="0"
                            data-bs-toggle="popover" 
                            data-bs-trigger="hover"
                            data-bs-content="@lang('label.backGuest')" data-bs-placement="top"
                            title="" class="btn btn-danger btn-rounded mb-2 font">
                            <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('/guests') }}" method="POST"
                        novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.guestName')</label>
                            <input type="text" value="{{ old('name') }}" name="name"
                                class="form-control  @error('name') is-invalid @enderror "
                                placeholder="@lang('label.enterGuestName') . . . " required="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.email')</label>
                            <input type="email" value="{{ old('email') }}" name="email"
                                class="form-control @error('email') is-invalid @enderror" required=""
                                placeholder="@lang('label.enterEmail') . . . ">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.phoneNumber')</label>
                            <input type="number" value="{{ old('mobile') }}" name="mobile"
                                class="form-control  @error('mobile') is-invalid @enderror" required=""
                                placeholder="@lang('label.phoneNumber') . . . ">
                            @error('mobile')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.address')</label>
                            <input type="text" value="{{ old('address') }}" name="address" class="form-control"
                                required="" maxlength="255" data-toggle="maxlength" data-threshold="12"
                                data-provide="typeahead" id="the-basics" placeholder="@lang('label.enterAddress') . . . ">
                        </div>


                        <div class="mb-3">
                            <label for="password" class="form-label">@lang('label.password')</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" class="form-control"
                                    placeholder="@lang('label.enterPassword') . . . " required>
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>
                        <button type="button" class="btn btn-light btn-rounded">@lang('label.cancel')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Apply the input mask
            $("input[name='mobile']").inputmask("(999) 999-9999");

            // Strip mask characters before form submission
            $('form').on('submit', function() {
                var phone = $("input[name='mobile']").val();
                var strippedPhone = phone.replace(/\D/g, ''); // Remove non-digit characters
                $("input[name='mobile']").val(strippedPhone);
            });
        });
    </script>
@endsection

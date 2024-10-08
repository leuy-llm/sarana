@extends('layout.app')
@section('content')
     @php
    $breadcrumbs = [
        ['title' => __('label.guests'), 'url' => route('guests.index')],
        ['title' => __('label.editGuest'), 'url' => route('guests.edit', $guest->id)]
    ];
    $currentPageTitle = __('label.editGuests');
@endphp
@include('layout.breadcrumbs', ['breadcrumbs' => $breadcrumbs, 'currentPageTitle' => $currentPageTitle])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ url('guests/') }}" class="btn btn-danger btn-rounded mb-2"> <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" method="POST" action="{{ url('guests/' . $guest->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">@lang('label.guestName')</label>
                            <input type="text" value="{{ old('name', $guest->name) }}" name="name"
                                class="form-control" placeholder="Full name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.email')</label>
                            <input type="email" value="{{ old('email', $guest->email) }}" name="email"
                                class="form-control" required placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.phone')</label>
                            <input type="number" value="{{ old('mobile', $guest->mobile) }}" name="mobile"
                                class="form-control" required placeholder="Mobile phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.address')</label>
                            <input type="text" value="{{ old('address', $guest->address) }}" name="address"
                                class="form-control" required maxlength="255" data-toggle="maxlength" data-threshold="12"
                                data-provide="typeahead" id="the-basics" placeholder="Address">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">@lang('label.password')</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter your password">
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>
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

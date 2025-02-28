@extends('layout.app')

@section('style')
    
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.guests'), 'url' => route('guests.index')],
            ['title' => __('label.createGuest'), 'url' => route('guests.create')],
        ];
        $currentPageTitle = __('label.newGuest');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('/guests') }}" method="POST"
                        novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.firstName')</label>
                                    <input type="text" value="{{ old('first_name') }}" name="first_name"
                                        class="form-control  @error('first_name') is-invalid @enderror "
                                        placeholder="@lang('label.enterGuestName') . . . " required="">
                                    @error('first_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.zip')</label>
                                    <input type="text" value="{{ old('zip') }}" name="zip"
                                        class="form-control @error('zip') is-invalid @enderror"
                                        placeholder="@lang('label.enterZip') . . .">
                                    @error('zip')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.country')</label>
                                    <input type="text" value="{{ old('country') }}" name="country"
                                        class="form-control @error('country') is-invalid @enderror"
                                        placeholder="@lang('label.enterCountry') . . .">
                                    @error('country')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.city')</label>
                                    <input type="text" value="{{ old('city') }}" name="city"
                                        class="form-control @error('city') is-invalid @enderror"
                                        placeholder="@lang('label.enterCity') . . .">
                                    @error('city')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.lastName')</label>
                                    <input type="text" value="{{ old('last_name') }}" name="last_name"
                                        class="form-control  @error('last_name') is-invalid @enderror "
                                        placeholder="@lang('label.enterGuestName') . . . " required="">
                                    @error('last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.email')</label>
                                    <input type="email" value="{{ old('email') }}" name="email"
                                        class="form-control @error('email') is-invalid @enderror" required=""
                                        placeholder="@lang('label.enterEmail') . . . ">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.phoneNumber')</label>
                                    <input type="number" value="{{ old('mobile') }}" name="mobile"
                                        class="form-control  @error('mobile') is-invalid @enderror" required=""
                                        placeholder="@lang('label.phoneNumber') . . . ">
                                    @error('mobile')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.address')</label>
                                    <input type="text" value="{{ old('address') }}" name="address" class="form-control"
                                        required="" maxlength="255" data-toggle="maxlength" data-threshold="12"
                                        data-provide="typeahead" id="the-basics" placeholder="@lang('label.enterAddress') . . . ">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">@lang('label.password')</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="@lang('label.enterPassword') . . . " required>
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save"></i>@lang('label.save')</button>
                        <a href="{{ url('guests') }}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection
@section('script')
    
@endsection

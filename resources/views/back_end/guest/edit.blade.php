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
                    {{-- <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ url('guests/') }}" class="btn btn-danger btn-rounded mb-2"> <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div> --}}
                    <form class="needs-validation" method="POST" action="{{ url('guests/' . $guest->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                               
                                    <div class="mb-3">
                                        <label class="form-label">@lang('label.firstName')</label>
                                        <input type="text" value="{{ old('first_name', $guest->first_name) }}" name="first_name"
                                            class="form-control  @error('first_name') is-invalid @enderror "
                                            placeholder="@lang('label.enterGuestName') . . . " required="">
                                        @error('first_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.lastName')</label>
                                    <input type="text" value="{{ old('last_name', $guest->last_name) }}" name="last_name"
                                        class="form-control  @error('last_name') is-invalid @enderror "
                                        placeholder="@lang('label.enterGuestName') . . . " required="">
                                    @error('last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.zip')</label>
                                    <input type="text" value="{{ old('zip', $guest->zip) }}" name="zip" 
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
                                    <input type="text" value="{{ old('country', $guest->country) }}" name="country" 
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
                                    <input type="text" value="{{ old('city', $guest->city) }}" name="city" 
                                        class="form-control @error('city') is-invalid @enderror" 
                                        placeholder="@lang('label.enterCity') . . .">
                                    @error('city')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.email')</label>
                                    <input type="text" value="{{ old('email', $guest->email) }}" name="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        placeholder="@lang('label.enterState') . . .">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.address')</label>
                                    <input type="text" value="{{ old('address', $guest->address) }}" name="address" 
                                        class="form-control @error('address') is-invalid @enderror" 
                                        placeholder="@lang('label.enterAddress') . . .">
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.phone')</label>
                                    <input type="number" value="{{ old('mobile', $guest->mobile) }}" name="mobile"
                                        class="form-control" required placeholder="Mobile phone">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.address')</label>
                                    <input type="text" value="{{ old('address', $guest->address) }}" name="address"
                                        class="form-control" required maxlength="255" data-toggle="maxlength" data-threshold="12"
                                        data-provide="typeahead" id="the-basics" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    {{-- <label for="password" class="form-label">@lang('label.password')</label> --}}
                                    <div class="input-group input-group-merge">
                                        <input type="hidden" name="password" class="form-control"
                                            placeholder="Enter your password">
                                        {{-- <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary " type="submit">@lang('label.update')</button>
                        <a href="{{url('guests')}}" class="btn btn-dark">@lang('label.cancel')</a>
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

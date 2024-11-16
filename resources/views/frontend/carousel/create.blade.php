@extends('layout.app')
@section('content')
@php
$breadcrumbs = [
    ['title' => __('label.Carousels'), 'url' => route('carousels.index')],
    ['title' => __('label.createCarousels'), 'url' => route('carousels.create')]
];
$currentPageTitle =  __('label.newCarousels');
@endphp
@include('layout.breadcrumbs', ['breadcrumbs' => $breadcrumbs, 'currentPageTitle' => $currentPageTitle])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ url('carousels') }}"  tabindex="0"
                            data-bs-toggle="popover" 
                            data-bs-trigger="hover"
                            data-bs-content="@lang('label.backGuest')" data-bs-placement="top"
                            title="" class="btn btn-danger btn-rounded mb-2 font">
                            <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div> --}}
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('/carousels') }}" method="POST"
                        novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.name')</label>
                            <input type="text" value="{{ old('name') }}" name="name"
                                class="form-control  @error('name') is-invalid @enderror "
                                placeholder="@lang('label.enterCarouselName') . . . " required="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.image')</label>
                            <input type="file" value="{{ old('email') }}" name="image"
                                class="form-control @error('image') is-invalid @enderror" required=""
                                placeholder="@lang('label.enterEmail') . . . ">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.description')</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="@lang('label.enterDescription') . . ."></textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">@lang('label.save')</button>
                        <a href="{{ url('carousels') }}" class="btn btn-dark">@lang('label.cancel')</a>
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

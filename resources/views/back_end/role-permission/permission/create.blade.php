@extends('layout.app')
@section('content')
    @php
        $breadcrumbs = [['title' => __('label.guests'), 'url' => route('guests.index')]];
        $currentPageTitle = __('label.guestList');
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
                            <a href="{{ url('permissions') }}" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover"
                                data-bs-content="@lang('label.backGuest')" data-bs-placement="top" title=""
                                class="btn btn-danger btn-rounded mb-2 font">
                                <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('/permissions') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.permissionName')</label>
                            <input type="text" value="{{ old('name') }}" name="name"
                                class="form-control  @error('name') is-invalid @enderror "
                                placeholder="@lang('label.enterPermissionName') . . . " required="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>
                        <button type="button" class="btn btn-light btn-rounded">@lang('label.cancel')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

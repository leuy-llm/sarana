
<!-- =========== Edit Setting ==============-->


@extends('layout.app')
@section('content')
@php
$breadcrumbs = [
    ['title' => __('label.roomType'), 'url' => route('rooms.index')],
    ['title' => __('label.editRoomType'), 'url' => route('rooms.create')],
];
$currentPageTitle = __('label.editRoomTypes');
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
                            <a href="{{ url('settings') }}" class="btn btn-danger btn-rounded mb-2"> <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" method="POST" action="{{ url('settings/' . $setting->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">@lang('label.siteTitle') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('site_title', $setting->site_title) }}"  name="site_title" class="form-control  @error('type_name') is-invalid @enderror " placeholder="RoomType name ..." required="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.siteLogo') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('site_logo') }}" name="site_logo"
                                class="form-control  @error('site_logo') is-invalid @enderror ">
                            @if ($setting->site_logo)
                                <img src="{{ asset('storage/' . $setting->site_logo) }}" alt="Facility Icon"
                                    class="img-thumbnail mt-2" width="100">
                            @endif
                            @error('site_logo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>
                        <a href="{{ url('settings') }}" class="btn btn-light btn-rounded">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- =========== Edit Setting ==============-->
<div id="standards-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit About Us</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" action=""
                    id="edit-forms" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden"  name="id">
                    <div class="mb-3">
                        <label class="form-label">@lang('label.title') <span class="text-danger">*</span></label>
                        <input type="text" id="edit_title" name="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Site title..."
                            required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('label.description') <span class="text-danger">*</span></label>
                        <input type="text" id="edit_description" name="description"
                            class="form-control @error('description') is-invalid @enderror" placeholder="Site title..."
                            required>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('label.image')</label>
                        <input type="file" id="edit_image" name="image"
                            class="form-control @error('image') is-invalid @enderror">
                        <img id="image-previews" src="" alt="Image Preview" class="mt-2"
                            style="max-width: 100px; display: none;" />
                        @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">@lang('label.update')</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

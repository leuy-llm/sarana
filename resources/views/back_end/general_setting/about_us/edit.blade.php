<!-- =========== Edit Setting ==============-->


@extends('layout.app')
@section('content')
@php
$breadcrumbs = [
    ['title' => __('label.Setting'), 'url' => route('settings.index')],
    ['title' => __('label.editSetting'), 'url' => route('settings.create')],
];
$currentPageTitle = __('label.editSettings');
@endphp
@include('layout.breadcrumbs', [
'breadcrumbs' => $breadcrumbs,
'currentPageTitle' => $currentPageTitle,
])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="{{ route('abouts.update', $about->id) }}"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.title') <span class="text-danger">*</span></label>
                            <input type="text" id="edit_title" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $about->title) }}" placeholder="Site title..." required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.description') <span class="text-danger">*</span></label>
                            <textarea name="description" rows="7" class="form-control">{{ old('description', $about->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.images') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('image') }}" name="image"
                                class="form-control  @error('image') is-invalid @enderror ">
                            @if ($about->image)
                                <img src="{{ asset('storage/' . $about->image) }}" alt="Facility Icon"
                                    class="img-fluid mt-2 rounded" width="200">
                            @endif
                            @error('icon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                     
                        <button class="btn btn-primary" type="submit">@lang('label.update')</button>
                        <a href="{{ url('settings') }}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

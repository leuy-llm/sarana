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
                            <a href="{{ url('settings') }}" class="btn btn-danger btn-rounded mb-2"> <span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
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
                     
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>
                        <a href="{{ url('settings') }}" class="btn btn-light btn-rounded">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

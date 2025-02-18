

@extends('layout.app')
@section('content')
@php
$breadcrumbs = [
    ['title' => __('label.roomType'), 'url' => route('rooms.index')],
    ['title' => __('label.editRoomType'), 'url' => route('rooms.create')],
];
$currentPageTitle = __('label.editRoomType');
@endphp
@include('layout.breadcrumbs', [
'breadcrumbs' => $breadcrumbs,
'currentPageTitle' => $currentPageTitle,
])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  
                    <form class="needs-validation" method="POST" action="{{ url('roomtypes/' . $roomtype->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">@lang('label.roomTypeName') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('type_name', $roomtype->type_name) }}"  name="type_name" class="form-control  @error('type_name') is-invalid @enderror " placeholder="RoomType name ..." required="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.description')</label>
                            <input type="text" name="description" value="{{ old('description', $roomtype->description) }}" class="form-control @error('description') is-invalid @enderror">
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">@lang('label.update')</button>
                        <a href="{{ url('roomtypes') }}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

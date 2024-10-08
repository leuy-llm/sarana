

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
                            <a href="{{ url('roomtypes') }}" class="btn btn-danger btn-rounded mb-2"> <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
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
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.maxPerson') <span class="text-danger">*</span></label>
                            <input type="number" name="max_persons" value="{{ old('max_persons', $roomtype->max_persons) }}" class="form-control @error('max_persons') is-invalid @enderror" required>
                            @error('max_persons')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.basePrice') <span class="text-danger">*</span></label>
                            <input type="text" name="base_price" value="{{ old('base_price', $roomtype->base_price) }}" class="form-control"required>
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.amenities') <span class="text-danger">*</span></label>
                            @php
                                $amenities = json_decode($roomtype->amenities, true);
                                $amenitiesString = is_array($amenities) ? implode(', ', $amenities) : '';
                            @endphp
                            <input type="text" name="amenities" value="{{ old('amenities', $amenitiesString) }}" class="form-control @error('amenities') is-invalid @enderror" required>
                            @error('amenities')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Separate amenities with commas.</small>
                        </div> --}}
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>
                        <a href="{{ url('roomtypes') }}" class="btn btn-light btn-rounded">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

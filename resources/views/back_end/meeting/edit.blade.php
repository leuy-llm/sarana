@extends('layout.app')
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.meeting'), 'url' => route('meetings.index')],
            ['title' => __('label.editMeeting'), 'url' => route('meetings.create')],
        ];
        $currentPageTitle = __('label.editMeetings');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('meetings/' . $meeting->id) }}"
                        method="POST" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">@lang('label.title') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('title', $meeting->title) }}" name="title"
                                class="form-control  @error('title') is-invalid @enderror "
                                placeholder="@lang('label.enterMeetingName') . . ." required="">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.image') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('images') }}" name="images[]"
                                class="form-control  @error('images') is-invalid @enderror ">
                            {{-- @if ($meeting->image)
                                <img src="{{ asset('storage/' . $meeting->image) }}" alt="{{ $meeting->title }}"
                                    class="img-thumbnail mt-2" width="100">
                            @endif --}}
                            @error('images')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($meeting->images->isNotEmpty())
                            <div class="mb-3">
                                <label>@lang('label.currentImage'):</label>
                                <div class="row mt-1 ">
                                    @foreach ($meeting->images as $image)
                                        <div class="col-md-4 col-sm-6 col-xl-3">
                                            <img src="{{ asset('storage/' . $image->image) }}" class="rounded mb-1"
                                                height="150px" style="max-width: 100%" width="200px" alt="Room Image">
                                            <div class="d-flex gap-1">
                                                <input type="checkbox" name="remove_images[]" value="{{ $image->id }}">
                                                <label for="remove_images[]" class="text-danger">@lang('label.remove')</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                            <select name="availability" class="form-control select2" data-toggle="select2">
                                <option value="" selected disabled>@lang('label.selectStatus')</option>
                                <option value="1" {{ $meeting->availability == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $meeting->availability == 0 ? 'selected' : '' }}>Inactive</option>

                            </select>
                            @error('availability')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>

                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="@lang('label.enterDescription') . . .">{{ old('description', $meeting->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary " type="submit">@lang('label.update')</button>
                        <a href="{{ url('meetings') }}" class="btn btn-dark ">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

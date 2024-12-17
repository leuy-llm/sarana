@extends('layout.app')
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.tour'), 'url' => route('tours.index')],
            ['title' => __('label.editTour'), 'url' => route('tours.edit', $tour->id)],
        ];
        $currentPageTitle = __('label.editTour');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('tours/' . $tour->id) }}"
                        method="POST" novalidate="">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.name') <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('name', $tour->name) }}" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="@lang('label.enterTourName') . . ." required="">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.price') <span class="text-danger">*</span></label>
                                    <input type="number"  step="0.01" value="{{ old('price', $tour->price) }}"
                                        name="price" class="form-control @error('price') is-invalid @enderror"
                                        placeholder="@lang('label.enterPrice') . . ." required="">
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.price') <span class="text-danger">*</span></label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text text-danger" id="basic-addon1">$</span>
                                        <input type="text" name="price" step="0.01"
                                        class="form-control @error('tour') is-invalid @enderror"
                                        value="{{ old('price', $tour->price) }}"
                                        required>
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>                                                
                                </div>                                               
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.duration') <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('duration', $tour->duration) }}" name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        placeholder="@lang('label.enterDuration') . . ." required="">
                                    @error('duration')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.location') <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('location', $tour->location) }}" name="location"
                                        class="form-control @error('location') is-invalid @enderror"
                                        placeholder="@lang('label.enterLocation') . . ." required="">
                                    @error('location')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.description') <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="@lang('label.enterDescription') . . .">{{ old('description', $tour->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.images') <span class="text-danger">*</span></label>
                                    <input type="file" name="images[]"
                                        class="form-control @error('images') is-invalid @enderror" multiple>

                                        @if ($tour->images->isNotEmpty())
                                        <div class="mb-3 mt-2">
                                            <label>@lang('label.currentImage'):</label>
                                            <div class="row mt-2 ">
                                                @foreach ($tour->images as $image)
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
                                    @error('images')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">@lang('label.update')</button>
                        <a href="{{ route('tours.index') }}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

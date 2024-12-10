@extends('layout.app')
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.restaurant'), 'url' => route('restaurants.index')],
            ['title' => __('label.editRes'), 'url' => route('restaurants.create')],
        ];
        $currentPageTitle = __('label.editRes');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('restaurants/' . $restaurant->id) }}"
                        method="POST" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">@lang('label.title') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('name', $restaurant->name) }}" name="name"
                                class="form-control  @error('name') is-invalid @enderror "
                                placeholder="@lang('label.enterResName') . . ." required="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.image') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('image') }}" name="image"
                                class="form-control  @error('image') is-invalid @enderror ">
                            @if ($restaurant->image)
                                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Service Image"
                                    class="img-thumbnail mt-2" width="100">
                            @endif
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                            <select name="status" class="form-control select2" data-toggle="select2">
                                <option value="" selected disabled>@lang('label.selectStatus')</option>
                                <option value="1" {{ $restaurant->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $restaurant->status == 0 ? 'selected' : '' }}>Inactive</option>

                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>

                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="@lang('label.enterDescription') . . .">{{ old('description', $restaurant->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary " type="submit">@lang('label.update')</button>
                        <a href="{{ url('restaurants') }}" class="btn btn-dark ">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

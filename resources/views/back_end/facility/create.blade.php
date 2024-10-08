@extends('layout.app')
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.roomType'), 'url' => route('roomtypes.index')],
            ['title' => __('label.createRoomType'), 'url' => route('roomtypes.create')],
        ];
        $currentPageTitle = __('label.createRoomTypes');
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
                            <a href="{{ url('facilitys') }}" class="btn btn-danger btn-rounded mb-2">
                                <span class="uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('facilitys') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.name') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('name') }}" name="name"
                                class="form-control  @error('name') is-invalid @enderror "
                                placeholder="@lang('label.enterFacilityName') . . ." required="">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.icon') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('icon') }}" name="icon"
                                class="form-control  @error('icon') is-invalid @enderror "
                                placeholder="@lang('label.enterFacilityName') . . ." required="">
                            @error('icon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="@lang('label.enterDescription') . . ."></textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>
                        <button type="button" class="btn btn-light btn-rounded ">@lang('label.cancel')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function addAmenityField() {
            const wrapper = document.getElementById('amenities-wrapper');
            const newField = document.createElement('div');
            newField.className = 'amenity-item mb-2';
            newField.innerHTML =
                '<input type="text" name="amenities[]" class="form-control" placeholder="@lang('label.enterAmenity') . . ." required="">';
            wrapper.appendChild(newField);
        }
    </script>
@endsection

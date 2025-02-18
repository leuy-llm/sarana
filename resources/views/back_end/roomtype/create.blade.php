
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
                    
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('roomtypes') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.roomTypeName') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('type_name') }}" name="type_name"
                                class="form-control  @error('type_name') is-invalid @enderror "
                                placeholder="@lang('label.enterRoomTypeName') . . ." required="">
                            @error('type_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>
                            <input type="text" value="{{ old('description') }}" name="description"
                                class="form-control  @error('description') is-invalid @enderror "
                                placeholder="@lang('label.enterDescription') . . ." required="">
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">@lang('label.submit')</button>
                        <a href="{{url('roomtypes')}}" class="btn btn-dark ">@lang('label.cancel')</a>
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

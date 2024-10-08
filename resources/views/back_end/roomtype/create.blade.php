{{-- <div id="primary-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel">Create RoomType</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="ps-1 pe-1" enctype="multipart/form-data" action="{{ url('roomtypes') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="roomtype" class="form-label">RoomType Name <span class="text-danger"></span></label>
                        <input class="form-control" name="type_name" type="text" id="roomtype" required=""
                            placeholder="Single Room ..">
                    </div>
                    <div class="d-flex justify-content-end gap-1 mt-2 text-right ">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div> --}}

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
                            <a href="{{ url('guests') }}" class="btn btn-danger btn-rounded mb-2"><span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
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
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.maxPerson') <span class="text-danger">*</span></label>
                            <input type="number" value="{{ old('max_persons') }}" name="max_persons"
                                class="form-control  @error('max_persons') is-invalid @enderror "
                                placeholder="@lang('label.enterMaxPerson') . . ." required="">
                            @error('max_persons')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.basePrice') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('base_price') }}" name="base_price"
                                class="form-control  @error('base_price') is-invalid @enderror "
                                placeholder="@lang('label.enterBesePrice') . . ." required="">
                            @error('base_price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.amenities') <span class="text-danger">*</span></label>
                            <div id="amenities-wrapper">
                                <div class="amenity-item mb-2">
                                    <input type="text" name="amenities[]"
                                        class="form-control @error('amenities') is-invalid @enderror"
                                        placeholder="@lang('label.enterAmenity') . . ." required="">
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="addAmenityField()">+
                                @lang('label.addAmenity')</button>
                            @error('amenities')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}

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

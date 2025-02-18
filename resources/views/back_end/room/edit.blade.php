@extends('layout.app')
@section('style')
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.room'), 'url' => route('rooms.index')],
            ['title' => __('label.editRoom'), 'url' => route('rooms.create')],
        ];
        $currentPageTitle = __('label.editRooms');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('rooms.index') }}" class="btn btn-light btn-rounded mb-2"><span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div> --}}
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('rooms/' . $room->id) }}"
                        method="POST" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.roomTypeName')</label>
                                    <select name="room_type_id" id="room_type_id" required class="form-control select2"
                                        data-toggle="select2">
                                        @foreach ($roomTypes as $roomType)
                                            <option value="{{ $roomType->id }}"
                                                {{ $room->room_type_id == $roomType->id ? 'selected' : '' }}>
                                                {{ $roomType->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.roomNumber') <span class="text-danger">*</span></label>
                                    <input type="text" name="room_number" id="room_number"
                                        value="{{ old('room_number', $room->room_number) }}"
                                        class="form-control  @error('room_number') is-invalid @enderror "
                                        placeholder="@lang('label.enterRoomNumber') . . ." required="">
                                    @error('room_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.floor') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('floor', $room->floor) }}" name="floor"
                                        class="form-control  @error('floor') is-invalid @enderror "
                                        placeholder="@lang('label.enterFloor') . . ." required="">
                                    @error('floor')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.price') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('price', $room->price) }}" name="price"
                                        class="form-control  @error('price') is-invalid @enderror "
                                        placeholder="@lang('label.enterPrice') . . ." required="">
                                    @error('floor')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.maxPerson') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('max_person', $room->max_person) }}" name="max_person"
                                        class="form-control  @error('max_person') is-invalid @enderror "
                                        placeholder="@lang('label.enterPrice') . . ." required="">
                                    @error('max_person')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2" data-toggle="select2">
                                        <option value="1" {{ $room->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $room->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.viewType')</label>
                                    <input type="text" value="{{ old('view_type', $room->view_type) }}" name="view_type"
                                           class="form-control @error('view_type') is-invalid @enderror"
                                           placeholder="@lang('label.enterViewType') . . .">
                                    @error('view_type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.bedType')</label>
                                    <input type="text" value="{{ old('bed_type', $room->bed_type) }}" name="bed_type"
                                           class="form-control @error('bed_type') is-invalid @enderror"
                                           placeholder="@lang('label.enterBedType') . . .">
                                    @error('bed_type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.size')</label>
                                    <input type="number" value="{{ old('room_size', $room->room_size) }}" name="room_size"
                                           class="form-control @error('room_size') is-invalid @enderror"
                                           placeholder="@lang('label.enterRoomSize') (e.g., in sq. ft)">
                                    @error('room_size')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.rating')</label>
                                    <input type="number" step="0.1" min="0" max="5" value="{{ old('rating', $room->rating) }}" name="rating"
                                           class="form-control @error('rating') is-invalid @enderror"
                                           placeholder="@lang('label.enterRating') (0-5)">
                                    @error('rating')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.specialPrice')</label>
                                    <input type="number" value="{{ old('special_price', $room->special_price) }}" name="special_price"
                                           class="form-control @error('special_price') is-invalid @enderror"
                                           placeholder="@lang('label.enterSpecialPrice')">
                                    @error('special_price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.extraBedCapacity')</label>
                                    <input type="number" value="{{ old('extra_bed_capacity', $room->extra_bed_capacity) }}" name="extra_bed_capacity"
                                           class="form-control @error('extra_bed_capacity') is-invalid @enderror"
                                           placeholder="@lang('label.enterExtraBedCapacity')">
                                    @error('extra_bed_capacity')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>
                                    <textarea name="description" class="form-control">{{ old('description', $room->description) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.facilities')</label>
                                    <div>
                                        @foreach ($facilities as $facility)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="facilities[]"
                                                    id="facility_{{ $facility->id }}" value="{{ $facility->id }}"
                                                    {{ in_array($facility->id, $room->facilities->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="facility_{{ $facility->id }}">
                                                    {{ $facility->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="images">@lang('label.images')</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                </div>
                                @if ($room->images->isNotEmpty())
                                    <div class="mb-3">
                                        <label>@lang('label.currentImage'):</label>
                                        <div class="row mt-1 ">
                                            @foreach ($room->images as $image)
                                                <div class="col-md-4 col-sm-6 col-xl-3">
                                                    <img src="{{ asset('storage/' . $image->image) }}" class="rounded mb-1"
                                                        height="150px" style="max-width: 100%" width="200px"
                                                        alt="Room Image">
                                                    <div class="d-flex gap-1">
                                                        <input type="checkbox" name="remove_images[]"
                                                            value="{{ $image->id }}">
                                                        <label for="remove_images[]"
                                                            class="text-danger">@lang('label.remove')</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">@lang('label.update')</button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-light">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection

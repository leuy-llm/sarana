@extends('layout.app')
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.banner'), 'url' => route('banner.index')],
            ['title' => __('label.createBanner'), 'url' => route('banner.create')],
        ];
        $currentPageTitle = __('label.newBanner');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('banner.store') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.pageName') <span class="text-danger">*</span></label>
                            <select name="page_name" id="page_name" class="form-control  @error('page_name') is-invalid @enderror select2" data-toggle="select2" required>
                                <option value="" selected disabled>@lang('label.selectPageName')</option>
                                @foreach ($pageNames as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">@lang('label.bannerImage') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('banner_image') }}" name="banner_image"
                                class="form-control  @error('banner_image') is-invalid @enderror "
                                placeholder="@lang('label.enterFacilityName') . . ." required="">
                            @error('banner_image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        
                        <button class="btn btn-primary" type="submit">@lang('label.save')</button>
                        <a href="{{url('banners')}}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>
                    {{-- <form class="needs-validation" enctype="multipart/form-data" action="{{ route('banner.store') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.pageName') <span class="text-danger">*</span></label>
                            <select name="page_name" id="page_name" class="form-control select2" required>
                                <option value="" selected disabled>@lang('label.selectPageName')</option>
                                @foreach ($pageNames as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="room_type_div" style="display: none;">
                            <label class="form-label">@lang('label.roomType') <span class="text-danger">*</span></label>
                            <select name="room_type_id" id="room_type_id" class="form-control select2" >
                                <option value="">@lang('label.selectRoomTypeBanner')</option>
                                @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}">{{ $roomType->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.bannerImage') <span class="text-danger">*</span></label>
                            <input type="file" name="banner_image" id="banner_image" class="form-control" required>
                        </div>

                        <button class="btn btn-primary" type="submit">@lang('label.save')</button>
                        <a href="{{url('banners')}}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form> --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pageNameSelect = document.getElementById('page_name');
            const roomTypeDiv = document.getElementById('room_type_div');

            // Show or hide the Room Type dropdown based on the selected Page Name
            pageNameSelect.addEventListener('change', function() {
                // Check if "Rooms Page" is selected
                if (this.value === 'rooms') {
                    roomTypeDiv.style.display = 'block'; // Show the Room Type dropdown
                } else {
                    roomTypeDiv.style.display = 'none'; // Hide the Room Type dropdown
                }
            });

            // Trigger the change event on page load in case of form prefill
            pageNameSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection

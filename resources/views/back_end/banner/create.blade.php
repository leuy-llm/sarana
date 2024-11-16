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
                    
                    {{-- <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ url('banners') }}" class="btn btn-danger btn-rounded mb-2">
                                <span class="uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div> --}}
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('banner.store') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.pageName') <span class="text-danger">*</span></label>
                            <select name="page_name" id="page_name" class="form-control  @error('page_name') is-invalid @enderror select2" data-toggle="select2" required>
                                @foreach($pageNames as $key => $value)
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

@extends('layout.app')
@section('style')
    <style>
        .filepond--drop-label {
            color: #4c4e53;
        }

        .filepond--label-action {
            text-decoration-color: #babdc0;
        }

        .filepond--panel-root {
            border-radius: 2em;
            background-color: #edf0f4;
            height: 1em;
        }

        .filepond--item-panel {
            background-color: #595e68;
        }

        .filepond--drip-blob {
            background-color: #7f8a9a;
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
        }

        .upload-box:hover {
            border-color: #999;
        }
        /* Style the gallery container */
        #lightgallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        #image-gallery{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            row-gap: 20px;
            column-gap: 1rem;
            width: 100%;
        }
        #image-gallery img{
            max-width: 1;
            width: 100%;
            display: block;
            height: 250px;
            cursor: pointer;
        }
        /* Style individual gallery items */
        #lightgallery a {
            display: block;
            width: 200px; /* Adjust the width as needed */
            height: auto;
            margin: 10px;
        }

        /* Style the images */
        #lightgallery img {
            width: 100%;
            height: auto;
            display: block;
            
        }
        
        /* Custom styles for LightGallery */
        .lg-outer .lg-thumb-outer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .lg-outer .lg-thumb-outer .lg-thumb {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.roomList'), 'url' => route('rooms.index')],
            ['title' => __('label.createRoom'), 'url' => route('rooms.create')],
        ];
        $currentPageTitle = __('label.createRooms');
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
                            <a href="{{ route('rooms.store') }}" class="btn btn-danger btn-rounded mb-2"><span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('rooms.store') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.roomTypeName')</label>
                                    <select name="room_type_id" id="room_type_id" required class="form-control select2"
                                        data-toggle="select2">
                                        @foreach ($roomTypes as $roomType)
                                            <option value="{{ $roomType->id }}">{{ $roomType->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.roomNumber') <span class="text-danger">*</span></label>
                                    <input type="text" name="room_number" id="room_number"
                                        value="{{ old('room_number') }}"
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
                                    <input type="number" value="{{ old('floor') }}" name="floor"
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
                                    <input type="number" value="{{ old('price') }}" name="price"
                                        class="form-control  @error('price') is-invalid @enderror "
                                        placeholder="@lang('label.enterPrice') . . ." required="">
                                    @error('floor')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2" data-toggle="select2">
                                        <option value="Available">Available</option>
                                        <option value="Booked">Booked</option>
                                        <option value="Maintenance">Maintenance</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="@lang('label.enterDescription') . . ."></textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.facilities') <span class="text-danger">*</span></label>
                                    <div class="">
                                        @foreach ($facilities as $facility)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="facilities[]" id="facility-{{ $facility->id }}" value="{{ $facility->id }}" class="form-check-input">
                                            <label for="facility-{{ $facility->id }}" class="form-check-label" style="margin-top: 2px;">{{ $facility->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="images">Images</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple
                                        required>
                                </div>
                            </div>
                            
                        </div>
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>
                        <button type="button" class="btn btn-light btn-rounded ">@lang('label.cancel')</button>
                    </form>
                </div>
            </div>
            
        </div>
        
        </div>
        
          
        
    </div>
@endsection
@section('script')
    <script>
        
        // lightGallery(document.getElementById('lightgallery'), {
        //     plugins: [lgZoom, lgThumbnail],
        //     speed: 500,
        //     thumbnail: true,
        //     animateThumb: false,
        //     showThumbByDefault: true,
        //     thumbWidth: 100, // Adjust thumbnail width as needed
        //     thumbHeight: 100 // Adjust thumbnail height as needed
        // });

        document.addEventListener('DOMContentLoaded', function() {
    var gallery = document.getElementById('image-gallery');
    var viewer = new Viewer(gallery, {
      // options
    });
  });
    </script>
@endsection

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

        #image-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            row-gap: 20px;
            column-gap: 1rem;
            width: 100%;
        }

        #image-gallery img {
            max-width: 1;
            width: 100%;
            display: block;
            height: 250px;
            cursor: pointer;
        }

        /* Style individual gallery items */
        #lightgallery a {
            display: block;
            width: 200px;
            /* Adjust the width as needed */
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

         //translate Date
      
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
                            <a href="{{ route('users.store') }}" class="btn btn-secondary btn-rounded mb-2"><span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('users.store') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.userName')</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control  @error('name') is-invalid @enderror "
                                        placeholder="@lang('label.enterUserName') . . ." required="">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.fullName') <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                                        class="form-control  @error('full_name') is-invalid @enderror "
                                        placeholder="@lang('label.enterFullname') . . ." required="">
                                    @error('full_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">@lang('label.dob') <span class="text-danger">*</span></label>
                                    <input type="date" id="datepicker" name="DateOfBirth"
                                        value="{{ old('DateOfBirth') }}"
                                        class="form-control  @error('DateOfBirth') is-invalid @enderror "
                                        placeholder="@lang('label.enterDob') . . ." required="">
                                    @error('DateOfBirth')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.gender') <span class="text-danger">*</span></label>
                                    <div class="mt-1">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="male" name="gender" value="male"
                                                {{ old('gender') == 'male' ? 'checked' : '' }}  class="form-check-input">
                                            <label class="form-check-label" style="margin-top: 2px;">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="female" name="gender" value="female"
                                                {{ old('gender') == 'female' ? 'checked' : '' }}  class="form-check-input">
                                            <label class="form-check-label" style="margin-top: 2px;">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="other" name="gender" value="other"
                                                {{ old('gender') == 'other' ? 'checked' : '' }}  class="form-check-input">
                                            <label class="form-check-label" style="margin-top: 2px;">Other</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.phone') <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ old('phone') }}" name="phone"
                                        class="form-control  @error('phone') is-invalid @enderror "
                                        placeholder="@lang('label.enterPhone') . . ." required="">
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.email') <span class="text-danger">*</span></label>
                                    <input type="email" value="{{ old('email') }}" name="email"
                                        class="form-control  @error('email') is-invalid @enderror "
                                        placeholder="@lang('label.enterEmail') . . ." required="">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">@lang('label.password')</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror "
                                            placeholder="@lang('label.enterPassword') . . . " required>
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.role') <span
                                            class="text-danger">*</span></label>
                                    <select name="roles[]" data-toggle="select2" multiple="multiple"
                                        data-placeholder="Choose Role . . ."
                                        class="form-control select2-multiple @error('roles') is-invalid @enderror"
                                        required>
                                        {{-- @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach --}}

                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach

                                    </select>
                                    @error('roles')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.address') <span
                                            class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" required placeholder="@lang('label.enterAddress') . . ."></textarea>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>
                        <a href="{{ url('users') }}" class="btn btn-light btn-rounded ">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>

        </div>

    </div>



    </div>
@endsection
@section('script')
    <script>
        const datepicker = new AirDatepicker('#datepicker', {
            dateFormat: 'yyyy-mm-dd',
            minDate: new Date(), // Disable past dates
            maxDate: new Date(new Date().setFullYear(new Date().getFullYear() +
            1)), // Disable dates more than 1 year from now
            startDate: new Date(), // Set the initial selected date
            inline: false, // Show date picker as a popup
        });
    </script>
@endsection

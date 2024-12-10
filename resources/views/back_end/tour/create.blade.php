@extends('layout.app')
@section('style')
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.tour'), 'url' => route('tours.index')],
            ['title' => __('label.createTour'), 'url' => route('tours.create')],
        ];
        $currentPageTitle = __('label.newTour');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('tours') }}" method="POST"
                        novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.name') <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('name') }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror "
                                        placeholder="@lang('label.enterTourName') . . ." required="">
                                    @error('name')
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
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.duration') <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('duration') }}" name="duration"
                                        class="form-control  @error('duration') is-invalid @enderror "
                                        placeholder="@lang('label.enterDuration') . . ." required="">
                                    @error('duration')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.featured') <span class="text-danger">*</span></label>
                                    <select name="is_featured" class="form-control select2" data-toggle="select2">
                                        <option value="" selected disabled>@lang('label.selectStatus')</option>
                                        <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_featured') == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('is_featured')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.location') <span class="text-danger">*</span></label>
                                    <textarea name="location" required class="form-control @error('location') is-invalid @enderror"
                                placeholder="@lang('label.enterLocation') . . ."></textarea>
                            @error('location')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                                </div>
                            </div>
                             <div class="col-md-6">
                                 <div class="mb-3">
                                <label class="form-label">@lang('label.description') <span class="text-danger">*</span></label>
                                <textarea name="description" required class="form-control @error('description') is-invalid @enderror"
                            placeholder="@lang('label.enterDescription') . . ."></textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            </div>                             
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.images') <span class="text-danger">*</span></label>
                                    <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple required>
                                    @error('images')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                            <select name="status" class="form-control select2" data-toggle="select2">
                                <option value="" selected disabled>@lang('label.selectStatus')</option>
                                <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        
                        {{-- <div class="mb-3">
                            <label class="form-label">@lang('label.description') <span class="text-danger"></span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="@lang('label.enterDescription') . . ."></textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <button class="btn btn-primary " type="submit">@lang('label.save')</button>
                        <a href="{{ url('tours') }}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('file-upload').addEventListener('change', function() {
            const fileNameSpan = document.getElementById('file-name');
            const fileName = this.files[0]?.name || '@lang('label.no_file_chosen')';
            fileNameSpan.textContent = fileName;
        });
    </script>
@endsection

@extends('layout.app')
@section('style')

@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.service'), 'url' => route('services.index')],
            ['title' => __('label.createService'), 'url' => route('services.create')],
        ];
        $currentPageTitle = __('label.newService');
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
                            <a href="{{ url('facilitys') }}" class="btn btn-danger btn-rounded mb-2">
                                <span class="uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div> --}}
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('services') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.title') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('title') }}" name="title"
                                class="form-control  @error('title') is-invalid @enderror "
                                placeholder="@lang('label.enterServiceName') . . ." required="">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.image') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('image') }}" name="image"
                                class="form-control  @error('image') is-invalid @enderror "
                                 required="">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                                <select name="status" class="form-control select2" data-toggle="select2">
                                    <option value="" selected disabled>@lang('label.selectStatus')</option>
                                    <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
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
                        <button class="btn btn-primary " type="submit">@lang('label.save')</button>
                        <a href="{{url('services')}}" class="btn btn-dark">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    document.getElementById('file-upload').addEventListener('change', function () {
        const fileNameSpan = document.getElementById('file-name');
        const fileName = this.files[0]?.name || '@lang("label.no_file_chosen")';
        fileNameSpan.textContent = fileName;
    });
</script>

@endsection

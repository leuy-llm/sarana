@extends('layout.app')
@section('style')

@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.meeting'), 'url' => route('meetings.index')],
            ['title' => __('label.createMeeting'), 'url' => route('meetings.create')],
        ];
        $currentPageTitle = __('label.newMeeting');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" enctype="multipart/form-data" action="{{ url('meetings') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('label.title') <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('title') }}" name="title"
                                class="form-control  @error('title') is-invalid @enderror "
                                placeholder="@lang('label.enterMeetingName') . . ." required="">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('label.image') <span class="text-danger">*</span></label>
                            <input type="file" value="{{ old('image') }}" multiple name="images[]"
                                class="form-control  @error('image') is-invalid @enderror "
                                 required="">
                            @error('images')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('label.status') <span class="text-danger">*</span></label>
                                <select name="availability" class="form-control select2" data-toggle="select2">
                                    <option value="" selected disabled>@lang('label.selectStatus')</option>
                                    <option value="1" {{ old('availability') === '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('availability') === '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('availability')
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
                        <a href="{{url('meetings')}}" class="btn btn-dark">@lang('label.cancel')</a>
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

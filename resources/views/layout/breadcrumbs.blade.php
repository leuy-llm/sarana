<!-- resources/views/layouts/breadcrumbs.blade.php -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box" style="margin-top: -20px">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">@lang('label.dashboard')</a></li>
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if (!$loop->last)
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a></li>
                        @else
                            <li class="breadcrumb-item active">{{ $breadcrumb['title'] }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
            <h4 class="page-title">{{ $currentPageTitle }}</h4>
        </div>
    </div>
</div>

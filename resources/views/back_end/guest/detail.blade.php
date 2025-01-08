@extends('layout.app')
@section('style')
    <style>

    </style>
@endsection
@section('content')
@php
$breadcrumbs = [
    ['title' => __('label.guest'), 'url' => route('guests.index')],
    ['title' => __('label.detailGuest'), 'url' => route('guests.create')],
];
$currentPageTitle = __('label.detailGuest');

//translate Date
\Carbon\Carbon::setLocale('km');
@endphp
@include('layout.breadcrumbs', [
'breadcrumbs' => $breadcrumbs,
'currentPageTitle' => $currentPageTitle,
])

    

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 d-flex gap-2 flex-wrap">
                            <h4 class="card-title">@lang('label.name') :</h4>
                            <p class="card-text">{{ $guest->first_name }} {{ $guest->last_name }}</p>
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap">
                            <h4 class="card-title">@lang('label.email') :</h4>
                            <p class="card-text">{{ $guest->email }}</p>
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap">
                            <h4 class="card-title">@lang('label.phone') :</h4>
                            <p class="card-text">{{ $guest->mobile }}</p>
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h4 class="card-title">@lang('label.address') :</h4>
                            <p class="card-text">{{ $guest->address }}</p>
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h4 class="card-title">@lang('label.country') :</h4>
                            <p class="card-text">{{ $guest->country }}</p>
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h4 class="card-title">@lang('label.city') :</h4>
                            <p class="card-text">{{ $guest->city }}</p>
                        </div>

                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h4 class="card-title">@lang('label.zip') :</h4>
                            <p class="card-text">{{ $guest->zip }}</p>
                        </div>

                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h4 class="card-title">@lang('label.status') :</h4>
                            @if ($guest->email_verified_at)
                                <p class="p-1 badge bg-success">Active</p>
                            @else
                                <p class="p-1 badge bg-danger">Blocked</p>
                            @endif
                        </div>
                        <div class="col-md-4 d-flex gap-2 flex-wrap mt-3">
                            <h4 class="card-title">@lang('label.createDate') :</h4>
                            <p class="card-text">{{ $guest->created_at->format('d-m-Y') }}</p>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection
@section('script')
    <script></script>
@endsection

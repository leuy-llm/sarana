@extends('layout.app')
@section('style')
    <style>
        #roomdetails .single-pro-image {
            width: 100%;
            margin-right: 50px;
        }

        .single-pro-image img {
            display: block;
            max-width: 100%;
            /* height: auto; */
            height: 310px;
            margin-bottom: 10px;
            object-position: 80% 100%;
            border-radius: 2px;
        }

        .small-img-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .small-img-col {
            width: calc(25% - 10px);
            /* Adjusts width to 25% minus the gap */
            cursor: pointer;
            height: 100px;
            /* Set a fixed height for all small images */
        }

        .small-img-col img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the area without stretching */
        }

        #mainImage{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.room'), 'url' => route('rooms.index')],
            ['title' => __('label.detailRoom'), 'url' => route('rooms.create')],
        ];
        $currentPageTitle = __('label.detailRoom');

        //translate Date
        \Carbon\Carbon::setLocale('km');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

    {{-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $header_title }}</h4>
                <a href="{{ url('rooms') }}" class="btn btn-secondary float-end">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Room Type: {{ $room->roomType->type_name }}</h5>
                        <p><strong>Room Number:</strong> {{ $room->room_number }}</p>
                        <p><strong>Floor:</strong> {{ $room->floor }}</p>
                        <p><strong>Price:</strong> ${{ $room->price }}</p>
                        <p><strong>Status:</strong> {{ $room->status }}</p>
                        <p><strong>Description:</strong> {{ $room->description }}</p>
                    </div>
                    <div class="col-md-6">
                        @if ($room->images->isNotEmpty())
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($room->images as $key => $image)
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($room->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100" alt="...">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <p>No images available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('rooms.store') }}" class="btn btn-secondary btn-rounded mb-2"><span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <div class="row">
                        @if ($room->images->isNotEmpty())
                            <div class="col-lg-5">
                                <div class="single-pro-image">
                                    <img src="{{ asset('storage/' . $room->images->first()->image) }}" width="100%"
                                        id="mainImage" alt="{{$room->roomType->type_name}}">
                                    <div class="small-img-group">
                                        @foreach ($room->images as $image)
                                            <div class="small-img-col">
                                                <img src="{{ asset('storage/' . $image->image) }}" width="100%"
                                                    onclick="changeImage('{{ asset('storage/' . $image->image) }}')">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <form class="ps-lg-4" method="POST">
                                    <!-- Product title -->
                                    <h3 class="mt-0">{{ $room->roomType->type_name }}<a
                                            href="{{ url('rooms/' . $room->id) }}" class="text-muted"><i
                                                class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>
                                    <p class="mb-1">@lang('label.addDate'):
                                        {{ \Carbon\Carbon::parse($room->created_at)->translatedFormat('d F Y') }}</p>


                                    <!-- Product stock -->
                                    <div class="mt-3">
                                        <h4>
                                            @if ($room->status == 'Available')
                                                <span class="badge badge-success-lighten">{{ $room->status }}</span>
                                            @elseif ($room->status == 'Booked')
                                                <span class="badge badge-danger-lighten">{{ $room->status }}</span>
                                            @elseif ($room->status == 'Maintenance')
                                                <span class="badge badge-warning-lighten">{{ $room->status }}</span>
                                            @endif
                                        </h4>
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-3">
                                        <h6 class="font-14">@lang('label.roomPrice'):</h6>
                                        <h3> ${{ $room->price }}</h3>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="mt-3">
                                        <h6 class="font-14">@lang('label.roomFloor'):</h6>
                                        <div class="d-flex">
                                            <h3> {{ $room->floor }}</h3>
                                        </div>
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-3">
                                        <h6 class="font-14">@lang('label.description'):</h6>
                                        <p>{{ $room->description }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="font-14">@lang('label.facilities'):</h6>

                                        @if ($room->facilities->isNotEmpty())
                                            <div class="row">
                                                @foreach ($room->facilities as $facility)
                                                    <div class="col-md-3">
                                                        <p>{{ $facility->name }}</p>
                                                    </div>
                                                @endforeach
                                            </div>                                          
                                        @else
                                            <p>@lang('label.noFacilities')</p>
                                        @endif
                                    </div>

                                    <!-- Product information -->
                                    {{-- <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="font-14">Available Stock:</h6>
                                            <p class="text-sm lh-150">1784</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Number of Orders:</h6>
                                            <p class="text-sm lh-150">5,458</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Revenue:</h6>
                                            <p class="text-sm lh-150">$8,57,014</p>
                                        </div>
                                    </div>
                                </div> --}}

                                </form>
                            </div> <!-- end col -->
                        @else
                            <p>No images available.</p>
                        @endif
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection
@section('script')
    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var gallery = document.getElementById('mainImage');
            var viewer = new Viewer(gallery, {
                // options
            });
        });
    </script>
@endsection

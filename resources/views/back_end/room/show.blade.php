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

        #mainImage {
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if ($room->images->isNotEmpty())
                            <div class="col-lg-5">
                                <div class="single-pro-image">
                                    <img src="{{ asset('storage/' . $room->images->first()->image) }}" width="100%"
                                        id="mainImage" alt="{{ $room->roomType->type_name }}">
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
                                            href="{{ url('rooms/' . $room->id) }}" class="text-muted"></a> </h3>
                                    <p class="mb-1">@lang('label.addDate'):
                                        {{ date('d-m-Y', strtotime($room->created_at)) }}</p>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="font-14">@lang('label.bedType'):</h6>
                                                <p class="text-sm lh-150">{{ $room->bed_type }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">@lang('label.viewType'):</h6>
                                                <p class="text-sm lh-150">{{ $room->view_type }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">@lang('label.size'):</h6>
                                                <p class="text-sm lh-150 ml-3">{{ $room->room_size }} m<sup>2</sup></p>
                                            </div>
                                            <div class="col-md-4">
                                                @if ($room->special_price)
                                                    <h6 class="font-14">@lang('label.specialPrice'):</h6>
                                                    <p class="text-sm lh-150 ml-3">$ {{ $room->special_price }}</p>
                                                @else
                                                    <h6 class="font-14">@lang('label.price'):</h6>
                                                    <p class="text-sm lh-150 ml-3">$ {{ $room->price }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">@lang('label.rating'):</h6>
                                                <div class="d-flex align-items-center gap-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-2 text-muted' }}"></i>
                                                    @endfor
                                                    {{-- <span class="ms-2">({{ $room->rating }} / 5)</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">

                                        <div class="col-md-4">
                                            <h6 class="font-14">@lang('label.roomFloor'):</h6>
                                            <p class="text-sm lh-150">{{ $room->floor }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">@lang('label.maxPerson'):</h6>
                                            <p>{{ $room->max_person }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">@lang('label.status'):</h6>
                                            @if ($room->status == '1')
                                                    <span class="badge badge-success-lighten">Active</span>
                                            @elseif ($room->status == '0')
                                                    <span class="badge badge-danger-lighten">Inactive</span>
                                            @endif
                                        </div>
                                        {{-- <div class="mt-3">
                                            <p> @lang('label.status'):
                                                @if ($room->status == '1')
                                                    <span class="badge badge-success-lighten">Active</span>
                                                @elseif ($room->status == '0')
                                                    <span class="badge badge-danger-lighten">Inactive</span>
                                                @endif
                                            </p>
                                        </div> --}}
                                    </div>


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

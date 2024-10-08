@extends('layout.master')
@section('content')
    <section id="home" class="banner_wrapper p-0">
        <div class="overlay">
            <img src="{{ asset('hotel') }}/image/rooms/room_banner.png" style="width: 100%; height: 90vh; object-fit: cover;"
                alt="Banner Image">
            <div class="img-overlay">
                <h2>{{ $rooms->roomType->type_name }} {{$data}}</h2>
            </div>
        </div>
    </section>
    <section id="rooms" class="rooms_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <!-- <h3>Our Awesome Services</h3> -->
                </div>
            </div>
            <div class="row">
                @if ($rooms && $rooms->images->isNotEmpty())
                    <div class="col-md-7">
                        <div class="slide-container1 swiper">
                            <div class="swiper-wrapper swiper-wrapper1">
                                @foreach ($rooms->images as $image)
                                    <div class="swiper-slide swiper-slide1">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="" />
                                    </div>
                                @endforeach
                               
                            </div>
                            <!-- <div class="swiper-pagination"></div> -->
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="row justify-content-center ">
                            <div class="col-md-8 py-3">
                                <h3 class="display-4 heading">{{ $rooms->roomType->type_name }}</h3>
                                <div class="room-exerpt">
                                    <div class="room-price mb-4">${{ number_format($rooms->price),0 }}<span class="per">/night</span></div>
                                    
                                        <p>{{ $rooms->description }}</p>
                                       
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <h3 class="mb-4">Amenities</h3>
                                            @if ($rooms->facilities->isNotEmpty())
                                            <ul class="list-unstyled ul-check">
                                                @foreach ($rooms->facilities as $facility)
                                                <li><i class="fa-solid fa-check" style="color:#"></i> {{ $facility->name }}</li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <p>@lang('label.noFacilities')</p>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mb-5">
                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline
                            of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own
                            road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.
                        </p>
                        <div class="d-md-flex mt-4 mb-4">
                            <ul class="list-none" style="list-style: none;">
                                <li><span>Max:</span> 3 Persons</li>
                                <li><span>Size:</span> 45 m2</li>
                            </ul>
                            <ul class="list-none ml-md-5" style="list-style: none;">
                                <li><span>View:</span> Sea View</li>
                                <li><span>Bed:</span> 1</li>
                            </ul>
                        </div>
                        <p>
                            When she reached the first hills of the Italic Mountains, she had a last view back on the
                            skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her
                            own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her
                            way.
                        </p>
                    </div>
                @else
                    <p>No images available.</p>
                @endif
            </div>
        </div>
    </section>
    
    
@endsection

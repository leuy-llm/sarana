@extends('layout.master')
@section('content')
    <section id="home" class="banner_wrapper p-0">
        <div class="overlay">
            @if ($banner)
                <img src="{{ asset('storage/' . $banner->banner_image) }}"
                    style="width: 100%; height: 90vh; object-fit: cover;" alt="{{ $rooms->roomType->type_name }} Banner">
            @endif
            <div class="img-overlay">
                <h2>{{ $rooms->roomType->type_name }} {{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="rooms" class="rooms_wrapper">
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <!-- <h3>Our Awesome Services</h3> -->
                </div>
            </div>
            <div class="row">
                {{-- @if ($rooms && $rooms->images->isNotEmpty())
                    <div class="col-md-7">
                        <div class="slide-container1 swiper">
                            <div class="swiper-wrapper swiper-wrapper1">
                                @foreach ($rooms->images as $image)
                                    <div class="swiper-slide swiper-slide1">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="" />
                                    </div>
                                @endforeach
                               
                            </div>
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
                @else --}}
                <div class="col-lg-6">
                    @if ($rooms && $rooms->images->isNotEmpty())
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($rooms->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="d-block w-100 rounded animate__animated animate__fadeIn"
                                            src="{{ asset('storage/' . $image->image) }}" alt="{{ $key + 1 }}"
                                            style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);height: 450px;">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @else
                        <div class="text-center">
                            <img src="{{ asset('default-image.jpg') }}" alt="Default Image"
                                class="img-fluid rounded shadow">
                        </div>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <h3 class="display-4 heading">{{ $rooms->roomType->type_name }}</h3>
                    <div class="room-exerpt">
                        <div class="room-price mb-3"  >${{ number_format($rooms->price), 0 }}<span
                                class="per" style="font-family: 'Playfair Display', serif;">/night</span>
                        </div>
                        <p style="line-height: 2.5;text-align: justify;">{{ $rooms->description }}</p>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h3 class="mb-4">Amenities</h3>
                                @if ($rooms->facilities->isNotEmpty())
                                    <ul class="list-unstyled ul-check" style="line-height: 2.5;text-align: justify;">
                                        @foreach ($rooms->facilities as $facility)
                                            <li><i class="fa-solid fa-check" style="color:#"></i> {{ $facility->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>@lang('label.noFacilities')</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex" style="display: flex;align-items: center;line-height: 2.3;">
                        <ul class="list-none" style="list-style: none;">
                            <li><strong>Bed:</strong> King Size<br></li>
                            <li><strong>Size:</strong> 45m<sup>2</sup></li>
                        </ul>
                        <ul class="list-none ml-md-5" style="list-style: none;margin-top: -1px;">
                            <li><strong>View:</strong> Ocean View</li>
                            <li><strong>Bed:</strong> 5</li>
                        </ul>
                       
                    </div>
                    
                </div>
            </div>

        </div>
    </section>


@endsection

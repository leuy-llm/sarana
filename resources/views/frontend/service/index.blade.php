@extends('layout.master')
@section('style')
    <style>
        /* Hover effect */
        .hover-effect {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-effect:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            filter: brightness(1.2);
            /* Brighten the image */
            cursor: pointer;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9b2c2c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0 " data-aos="zoom-in" data-aos-duration="2000">
        <div class="overlay">
            @if ($banner)
                <img src="{{ asset('storage/' . $banner->banner_image) }}" 
                    style="width: 100%; height: 90vh; object-fit: cover;" alt="Banner Image">
            @else
                <img src="{{ asset('hotel') }}/image/services/service3.png"
                    style="width: 100%; height: 90vh; object-fit: cover;" alt="">
            @endif
            <div class="img-overlay">
                <h2>{{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="services" class="services_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h6 data-aos="zoom-in"  data-aos="fade-right">We Are Here For You</h6>
                    <h3 style="margin-top: -10px"  data-aos="fade-right" data-aos-duration="1500">Our Awesome Services</h3>
                </div>
            </div>
            <div class="py-3 service-12">
                <div class="container" >
                    <div class="row" >
                        <div class="col-lg-6" >
                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-md-6">
                                        <h6 class="font-weight-medium" data-aos="fade-right">{{ $service->title }}</h6>
                                        <p style="line-height: 1.6;" data-aos="fade-right" data-aos-duration="1500">{{ $service->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6"  data-aos="fade-down-right" data-aos-duration="2000">
                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-md-6 mt-2 img-hover">
                                        <img src="{{ asset('storage/' . $service->image) }}" style="height: 100%; max-height: 600px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"
                                            class="rounded img-shadow img-fluid hover-effect" alt="{{ $service->title }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('auth.register')
@endsection
@section('script')
    <script></script>
@endsection

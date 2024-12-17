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

        .meeting-space-section {
            background-color: #fff;
            font-family: 'Georgia', serif;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9b2c2c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .section-subtitle {
            font-size: 1.75rem;
            font-weight: 600;
            font-style: italic;
            color: #9b2c2c;
        }

        .description {
            font-size: 1rem;
            color: #333;
            line-height: 1.8;
        }

        img {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;

        }

        img:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;

        }

        .carousel-inner img {
            max-height: 500px;
            object-fit: cover;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            color: wheat;
        }
    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0 ">
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
                    <h6 class="text-center">Explore our meeting plans and schedules</h6>
                    @foreach ($meetings as $meeting)
                        <h3 style="margin-top: -10px">{{ $meeting->title }}</h3>
                    @endforeach
                </div>
            </div>
            <div class="service-12">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($meetings as $meeting)
                                <p style="line-height: 2.8; text-align: justify">{{ $meeting->description }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($meeting->images as $image)
                            @if ($meeting->images->isNotEmpty())
                                <div class="col-md-6 mt-3 img-hover">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Meeting Image"
                                        class="img-fluid rounded shadow"
                                        style="width: 100%; max-width: 700px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                </div>
                            @else
                                <div class="col-md-6 mt-3 img-hover">
                                    <img src="{{ asset('default-image.jpg') }}" alt="Default Image"
                                        class="rounded img-shadow ">
                                </div>
                            @endif
                        @endforeach

                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-6">
                            @foreach ($meetings as $meeting)
                                <p style="line-height: 2.8; text-align: justify">{{ $meeting->description }}</p>
                            @endforeach
                        </div>
                        <div class="col-lg-6">
                            @if ($meeting->images->isNotEmpty())
                                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($meeting->images as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img class="d-block w-100 rounded animate__animated animate__fadeIn" 
                                                        src="{{ asset('storage/' . $image->image) }}" 
                                                        alt="{{ $key + 1 }}"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('default-image.jpg') }}" alt="Default Image"
                                            class="img-fluid rounded shadow">
                                    </div>
                                @endif
                        </div>
                    </div> --}}
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

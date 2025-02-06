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

        @media (max-width: 768px) {
            /* For screens smaller than 768px */
           .section-title {
                font-size: 2rem;
            }
            .section-subtitle {
                font-size: 1.5rem;
            }
            img {
                width: 100%;
            }
            img:hover {
                transform: scale(1);
            }
           
            /* For screens smaller than 768px */
        }
    </style>
@endsection
@section('content')
<div class="hero-section banner_wrapper"  data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <h1 class="display-4 mb-4" data-aos="zoom-in" data-aos-duration="2000"
            style="color: white;font-weight: 700;font-family: 'Sail', system-ui;font-size: 75px;">
            {{ $data }}
        </h1>
        {{-- <p class="lead" style="color: #fff;font-family: 'Sail', system-ui;font-size: 25px;">
            Find your perfect room with stunning views and ultimate comfort
        </p> --}}
    </div>
</div>
@if ($banner)
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('{{ asset('storage/' . $banner->banner_image) }}');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-bottom: -100px;
        }
    </style>
@else
    <p>No banner found for this page.</p>
@endif
    <section id="meeting" class="meeting_wrapper" style="margin-top: 100px;">
        <div class="container-fluid">
            <div class="text-center" data-aos="fade-down" data-aos-duration="1000">
                @foreach($meetings as $meeting)
                <h3 class="fw-bold" style="font-family: 'Sail', system-ui;font-size: 50px;color: #caa169">{{$meeting->title}}</h3>
                @endforeach
                <p class=""
                    style="font-family: 'Sail', system-ui; letter-spacing: 1px; line-height:1.5; font-size: 25px; font-weight: 100;  margin-top: 10px;">
                </p>
            </div>
            <div class="meeting">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($meetings as $meeting)
                                <p style="line-height: 2.1; text-align: justify;font-family: 'Source Sans Pro', sans-serif;font-size: 20px;'" data-aos="fade-right" data-aos-duration="2000">{{ $meeting->description }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-5">
                        @foreach ($meeting->images as $image)
                            @if ($meeting->images->isNotEmpty())
                                <div class="col-md-6 mt-3 img-hover" data-aos="fade-down" data-aos-duration="1500">
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
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    <script></script>
@endsection

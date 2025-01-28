@extends('layout.master')
@section('style')
    <style>
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9b2c2c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
        }


        .image-container {
            overflow: hidden;

        }

        .image-container img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease-in-out;

        }

        .image-container img:hover {
            transform: scale(1.1);
            background: rgba(0, 0, 0, 0.5);

        }

        @media (max-width: 768px) {

            .banner_wrapper img {
                width: 100%;

            }

            h6 {
                font-size: 16px;

            }

            h3 {
                font-size: 30px;
            }

            .image-container img {
                width: 100%;
                height: 350px;
                object-fit: cover;

            }

        }

        .menu {
            padding: 80px 0;
           
        }

        .menu h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 40px;
            color: #333;
        }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .food-item {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .food-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .food-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .food-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .food-item:hover .food-image img {
            transform: scale(1.1);
        }

        .food-details {
            padding: 20px;
            text-align: center;
        }

        .food-details h3 {
            font-size: 24px;
            margin: 0 0 10px;
            color: #333;
        }

        .food-details p {
            font-size: 16px;
            margin: 0 0 15px;
            color: #666;
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
    <section id="services" class="services_wrapper" style="margin-bottom: 60px;">
        <div class="container-fluid">
            <div class="my-5">
                <div class="text-center" data-aos="fade-down" data-aos-duration="1000">
                    <h3 class="fw-bold" style="font-family: 'Sail', system-ui;font-size: 50px;">Our Delicious Menu</h3>
                    <p class=""
                        style="font-family: 'Sail', system-ui; letter-spacing: 1px; line-height:1.5; font-size: 25px; font-weight: 100;  margin-top: 10px;">
                        Savor the art of fine dining at our hotel. From locally inspired dishes to international cuisines,
                        our chefs use the freshest ingredients to craft meals that will tantalize your taste buds.
                        Whether you're in the mood for a hearty breakfast, a quick bite, or a gourmet dinner,
                        we have something special for every palate.
                    </p>
                </div>
                <section id="menu" class="menu">
                    <div class="container">
                        <div class="food-grid">
                            @foreach ($foodItems as $food)
                                <div class="food-item">
                                    <div class="food-image">
                                        <img src="{{ asset('storage/' . $food->image) }}" alt="Food 1">
                                    </div>
                                    <div class="food-details">
                                        <h3 style="font-family: 'Source Sans Pro', sans-serif;font-size: 25px;">{{ $food->name }}</h3>
                                        <p style="font-family: 'Source Sans Pro', sans-serif;font-size: 18px;">{{ $food->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        
    </script>
@endsection

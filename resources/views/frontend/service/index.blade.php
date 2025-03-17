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

        .service-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            cursor: pointer;
        }

      

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .service-card.bg-dark {
            background-color: #212529;
            color: white;
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

        .service-card.bg-dark h5,
        .service-card.bg-dark p {
            color: white;
        }

        .service-card h5 {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 20px;
            font-weight: bold;
            color: #212529;
        }

        .service-card p {
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 18px;

        }

        @media (max-width: 768px) {
            .service-card {
                margin-bottom: 18px;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                margin-top: 10px;

            }

            .banner_wrapper img {
                width: 100%;

            }

            .image-container img {
                width: 100%;
                height: 350px;
                object-fit: cover;

            }

            .service-card h5 {
                font-size: 18px;
            }

            .service-card p {
                font-size: 14px;
            }
        }
        .hero-section {
           
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
@endsection
@section('content')
   
    <div class="hero-section banner_wrapper"  data-aos="fade-down" data-aos-duration="1000">
        <div class="container">
            <h1 class="display-4 mb-4" data-aos="zoom-in" data-aos-duration="2000"
                style="color: white;font-weight: 700;font-family: 'Sail', system-ui;font-size: 75px;">
                {{ $data }}
            </h1>
          
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
    <section id="services" class="services_wrapper" style="margin-bottom: 60px;margin-top: 40px;">
        <div class="container">
            <div class="my-5">
                <div class="text-center" data-aos="fade-down" data-aos-duration="1000">
                    <h3 class="fw-bold" style="font-family: 'Sail', system-ui;font-size: 50px;">Our Awesome Services</h3>
                    <p class=""
                        style="font-family: 'Sail', system-ui; letter-spacing: 1px; line-height:1.5; font-size: 25px; font-weight: 100;  margin-top: 10px;">
                        Experience exceptional hospitality with a range of services designed to make your stay truly
                        unforgettable.
                    </p>
                </div>
                <div class="row align-items-stretch mt-5">
                    <div class="col-md-6 d-flex image-container" data-aos="fade-right" data-aos-duration="1000">
                        <img id="mainImage" src="{{ asset('storage/' . $services[0]->image) }}" alt="Awesome Services"
                            class="img-fluid w-100">

                    </div>
                    <div class="col-md-6 d-flex flex-column" data-aos="fade-left" data-aos-duration="1000">
                        @foreach ($services as $index => $service)
                            <div class="service-card p-3 mb-3 {{ $index === $services->count() - 1 ? 'bg-dark text-white' : '' }}"
                                onclick="changeBackground(this, '{{ asset('storage/' . $service->image) }}')">
                                <h5 class="fw-bold">{{ $service->title }}</h5>
                                <p class="{{ $index === $services->count() - 1 ? '' : 'text-muted' }}">
                                    {{ $service->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function changeBackground(selectedCard, imageUrl) {
            const allCards = document.querySelectorAll('.service-card');
            const mainImage = document.getElementById('mainImage');

            // Reset all cards to their default style
            allCards.forEach(card => {
                card.classList.remove('bg-dark', 'text-white');
                card.style.backgroundColor = ''; // Reset any inline styles

                // Reset text styles for all child elements
                const childElements = card.querySelectorAll('h5, p');
                childElements.forEach(child => {
                    child.classList.remove('text-white');
                    if (child.tagName === 'P') {
                        child.classList.add('text-muted'); // Restore muted text for paragraphs
                    }
                });
            });

            // Apply dark background to the selected card
            selectedCard.classList.add('bg-dark', 'text-white');

            // Change text styles for all child elements of the selected card
            const childElements = selectedCard.querySelectorAll('h5, p');
            childElements.forEach(child => {
                child.classList.remove('text-muted'); // Remove muted text class
                child.classList.add('text-white'); // Add white text class
            });
            // Change the main image
            mainImage.src = imageUrl;
        }
    </script>
@endsection

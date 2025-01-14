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

        body {
            font-family: 'Source Sans Pro', sans-serif;
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
        .service-card h5{
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 21px;
            font-weight: bold;
            color: #212529;
        }
        .service-card p{
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 18px;
            
        }

        @media (max-width: 768px) {
            .service-card {
                margin-bottom: 20px;
                flex-direction: column;
                align-items: center;
                gap: 10px;
                margin-top: 10px;

            }
            .banner_wrapper img{
                width: 100%;
               
            }
            h6{
                font-size: 16px;
               
            }
            h3{
                font-size: 30px;
            }
            .image-container img{
                width: 100%;
                height: 350px;
                object-fit: cover;
               
            }
            .service-card h5{
                font-size: 18px;
            }
            .service-card p{
                font-size: 14px;
            }

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
                <div class="text-center" style="margin-bottom: 60px;">
                    <h6 class="fw-bold">OUR AWESOME SERVICES</h6>
                    <h3 class="text-muted" style="margin-top: -10px">Check out our awesome services</h3>
                </div>
                <div class="row align-items-stretch">
                    <div class="col-md-6 d-flex image-container">
                        <img id="mainImage" 
                            src="{{ asset('storage/' . $services[0]->image) }}" 
                            alt="Awesome Services" class="img-fluid w-100">

                    </div>
                    <div class="col-md-6 d-flex flex-column">
                        @foreach($services as $index => $service)
                        <div class="service-card p-3 mb-3 {{ $index === $services->count() - 1 ? 'bg-dark text-white' : '' }}"
                            onclick="changeBackground(this, '{{ asset('storage/' . $service->image) }}')">
                           <h5 class="fw-bold">{{ $service->title }}</h5>
                           <p class="{{ $index === $services->count() - 1 ? '' : 'text-muted' }}">{{ $service->description }}</p>
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

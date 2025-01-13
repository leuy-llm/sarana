<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
    body{
        font-family: 'Source Sans Pro' , sans-serif;
    }

    .room-card {
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        position: relative;
        height: 100%;
    }

    .room-card img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .room-card:hover img {
        transform: scale(1.1);
        filter: brightness(70%);

    }

    .room-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 1rem;
        /* background: rgba(0, 0, 0, 0.7); */
        color: white;
        text-align: left;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        transition: all 0.3s ease;
    }

    .room-info h5 {
        font-weight: bold;
        font-size: 25px;
        font-family: 'Source Sans Pro' , sans-serif;
    }
    .room-info small{
        font-family: 'Source Sans Pro' , sans-serif;
        
    }

    .room-card:hover .room-info {
        padding: 1.5rem;
    }

    .read-more-btn {
        display: none;
        margin-top: 0.5rem;

        background: rgba(0, 0, 0, 0.4);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .read-more-btn:hover {
        background: rgba(255, 255, 255, 0.8);
        color: black;
    }

    .read-more-btn:hover::after {
        transform: scaleX(1);
    }

    .room-card:hover .read-more-btn {
        display: inline-block;
    }

    .view-all-btn {
        margin-top: 2rem;
        display: flex;
        justify-content: end;
    }

    @media (max-width: 768px) {
        .view-all-btn {
            justify-content: center;
            font-size: 18px;
            font-family: 'Source Sans Pro' , sans-serif;
            font-weight: bold;

        }
        /* For smaller screens */
        /* Hide the read more button */
       .read-more-btn {
            display: none;
            margin-top: 0;
        }
        /* For smaller screens */
        /* Add a margin-bottom for last item */
       .owl-carousel.owl-item:last-child {
            margin-bottom: 1rem;
        }
        /* For smaller screens */
        /* Hide the view all button */
       .view-all-btn {
            display: none;
       }
    .room-card {
        margin-bottom: 1rem;
        /* Add margin-bottom for last item */
        }
       .owl-carousel.owl-item:last-child {
            margin-bottom: 1rem;
        }
        /* For smaller screens */
    .room-card img {
        height: 350px;
        /* Adjust height for smaller screens */

    }
    }


       /* For smaller screens */

    
</style>
<div class="container-fluid mt-5">
    
    <div class="col-sm-12 section-title text-center mb-md-3 mb-sm-2">
        <h6 data-aos="zoom-in" style="font-weight: bold;font-size: 20px">Discover Your Perfect Stay</h6>
        <h2 data-aos="zoom-in">Our Favorite Rooms</h2>
    </div>
    
    
    <div class="container text-center"> 
        <div class="row g-4 equal-height">
            <!-- Room Card -->
            <div class="owl-carousel">
                @foreach ($rooms as $data)
                    <div class="room-card">
                        <a href="{{ route('roomDetail', ['id' => $data->id, 'type_name' => Str::slug($data->roomType->type_name)]) }}">
                        @if ($data->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $data->images->first()->image) }}" alt="">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" alt="" class="me-2 img-fluid">
                        @endif
                        <div class="room-info">
                            <small>FROM ${{$data->price}}/NIGHT</small>
                            <h5 class="text-white">{{$data->roomType->type_name}}</h5>
                            <button class="read-more-btn rounded-pill">Read More <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(".owl-carousel").owlCarousel({
            items: 3,
            margin: 10,
            loop: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplaySpeed: 1000,
            smartSpeed: 1000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    </script>

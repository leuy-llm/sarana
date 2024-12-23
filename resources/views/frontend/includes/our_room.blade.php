<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 section-title text-center mb-5">
            <h6 data-aos="zoom-in">What I can do for you</h6>
            <h3 data-aos="zoom-in"> Our Favorite Rooms</h3>
        </div>
    </div>
    {{-- <div class="row">
        @foreach ($rooms as $data)
            <div class="col-md-6 col-sm-12 col-xl-4 mb-md-4 mb-sm-2 mb-3">
                <div class="room-items"  data-aos="zoom-in"  data-aos-duration="1500" >
                    @if ($data->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $data->images->first()->image) }}" alt=""
                            class="img-fluid " style="height: 350px;">
                    @else
                        <img src="{{ asset('default-image.jpg') }}" alt="" class="me-2 img-fluid">
                    @endif
                    <div class="room-item-wrap">
                        <div class="room-content">
                            <h5 class="text-white mb-lg-3 text-decoration-underline" data-aos="zoom-in-right" >{{ $data->roomType->type_name }}</h5>
                            <p class="text-white" data-aos="zoom-in"> {{ Str::limit($data->description, 200) }}</p>
                            <div class="" style="display: flex; align-items: center;">
                                <p class="text-white font-bold">${{ $data->price }} / Per Night</p>
                                <p class="text-white ml-lg-3" style="margin-top: 1px;">Max {{$data->max_person}} Persons</p>
                            </div>
                            <a href="{{ route('roomDetail', ['id' => $data->id, 'type_name' => Str::slug($data->roomType->type_name)]) }}" class="main-btn border-white text-white">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .room-card {
            position: relative;
            overflow: hidden;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }


        .room-card img {
            width: 100%;
            height: 450px;
        }

        .room-card .price-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            font-weight: bold;
        }

        .room-card .room-title {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            padding: 15px 10px;
            /* font-weight: bold; */
            transition: background-color 0.3s ease-in-out;
            width: calc(100% - 30px);
            background: #ffa37b;
            font-size: 20px;
            text-align: center;
            text-transform: capitalize;
            letter-spacing: 1px;
            font-family: 'Sail', system-ui;
        }

        .owl-carousel .owl-stage {
            transition: all 1s ease-in-out;
        }

        .booking_overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(13, 9, 30, 0.67);
            pointer-events: none;
            visibility: hidden;
            opacity: 0;
            animation: fade-in 0.5s ease-in-out;
            transition: visibility 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .room-card:hover .booking_overlay {
            visibility: visible;
            opacity: 1;
        }

        /* Search Icon with Animation */
        .room-card .search-icon {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.5);
            visibility: hidden;
            opacity: 0;
            transition: all 0.5s ease-in-out;
            font-size: 30px;
            color: white;
            z-index: 2;
            cursor: pointer;
        }

        .room-card:hover .search-icon {
            visibility: visible;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
    <div class="container mt-5">
        <div class="owl-carousel">
            @foreach ($rooms as $data)
                <div class="room-card">
                    <a
                        href="{{ route('roomDetail', ['id' => $data->id, 'type_name' => Str::slug($data->roomType->type_name)]) }}">
                        @if ($data->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $data->images->first()->image) }}" alt="">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" alt="" class="me-2 img-fluid">
                        @endif
                    </a>
                    <div class="booking_overlay trans_200"></div>
                    <i class="search-icon fas fa-search"></i>
                    <span class="price-badge">${{ $data->price }}/Night</span>
                    <div class="room-title">{{ $data->roomType->type_name }}</div>
                </div>
            @endforeach
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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

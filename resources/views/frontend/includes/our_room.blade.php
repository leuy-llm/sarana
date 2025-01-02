<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-sm-12 section-title text-center mb-5">
            <h6 data-aos="zoom-in" style="font-weight: bold;font-size: 20px">What I can do for you</h6>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        /* .room-card {
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
        } */


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
            height: 100%;
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
            color: white;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .room-info small {
            font-family: 'Source Sans Pro', sans-serif;

        }

        .room-card:hover .room-info {
            padding: 1.5rem;
        }

        .read-more-btn {
            display: none;
            margin-top: 0.5rem;
            /* background: rgba(255, 255, 255, 0.8); */
            background: rgba(0, 0, 0, 0.4);
            /* background-color: transparent !important; */

            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            font-family: 'Source Sans Pro', sans-serif;
            transition: all 0.3s ease;
        }

        .read-more-btn:hover {
            background: rgba(255, 255, 255, 0.8);
            color: black;
        }

        /* .read-more-btn::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            width: 100%;
            background-color: rgb(241, 141, 9);

            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s ease-in-out;
        } */

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
            font-family: 'Source Sans Pro', sans-serif;
        }

        .equal-height {
            display: flex;
            flex-wrap: wrap;
        }

        .equal-height>.col-md-4 {
            display: flex;
        }
    </style>
    {{-- <div class="container mt-5" >
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
    </div> --}}

    <div class="container text-center mt-5">
        <div class="row g-4 equal-height">
            @foreach ($rooms as $room)
                <div class="col-md-{{ $loop->index === 0 ? '6' : '3' }}">
                    <!-- Dynamic column size for the first item -->
                    <div class="room-card">
                        <img src="{{ $room->images->isNotEmpty() ? asset('storage/' . $room->images->first()->image) : asset('default-image.jpg') }}"
                            alt="{{ $room->roomType->type_name }}">
                        <div class="room-info">
                            <small>FROM ${{ $room->price }}/NIGHT</small>
                            <h5>{{ $room->roomType->type_name }}</h5>
                            <button class="read-more-btn rounded-pill">Read More <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- View All Button -->
            {{-- <div class="view-all-btn">
                <button class="btn btn-outline-dark rounded-pill text-right px-4">View all Rooms</button>
            </div> --}}
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

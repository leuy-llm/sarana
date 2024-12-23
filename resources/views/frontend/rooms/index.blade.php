@extends('layout.master')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            /* font-family: Arial, sans-serif; */
            /* background-color: #f8f9fa; */
            background-color: #eff3f8;
            font-family: 'Montserrat', sans-serif;
        }

        .room-card img {
            border-radius: 0.5rem;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .room-details {
            padding: 1rem;
        }

        .room-price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #28a745;
        }

        .btn-book-now {
            background-color: #28a745;
            color: white;
        }

        h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;

            font-size: 20px;
        }

        h6 {
            font-family: 'Montserrat', sans-serif;
        }




        .btn-book-now:hover {
            background-color: #218838;
        }

        .search-box {
            background-color: #f8f9fa;
            border: 1px solid #413d3d;
            border-radius: 3px 3px;
            /* padding: 20px; */
            max-width: 350px;
            margin: auto;

        }

        .search-header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            border-radius: 3px 3px 0 0;
            text-align: center;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
        }

        .form-control {
            font-family: "Montserrat", sans-serif;
        }

        .clear-btn {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            color: #17a2b8;
        }

        .footer-label {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #6c757d;
            margin-top: 10px;
        }

        span {
            font-family: "Montserrat", sans-serif;
        }

        label {
            font-size: 15px;
            font-family: "Montserrat", sans-serif;
        }

        h5 {
            text-transform: uppercase;
        }
        

        .results-header {
            /* margin-bottom: 10px; */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hotel-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .hotel-card img {
            width: 100%;
            height: auto;
        }

        .price-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #17a2b8;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 18px;
        }

        .special-offer {
            background-color: #e83e8c;
        }

        .hotel-details {
            padding: 15px;
        }

        .hotel-details h5 {
            margin-bottom: 10px;
        }

        .rating {
            color: #ffc107;
            font-size: 14px;
        }

        .location {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .select-btn {
            /* width: 100%; */
            border-radius: 5px;
            padding: 5px 25px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 20px;

        }

        .card1 {
            border-radius: 0.5rem;
            background: white;
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.15);
            position: relative;
            color: #434343;
            transition: border 0.3s ease, box-shadow 0.3s ease;

        }


        .card1 .card__container {
            padding: 2rem;
            width: 100%;
            height: 100%;
            background: white;
            /* border-radius: 1rem; */
            position: relative;
        }

        .card1 .card__header {
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .card1 .card__body {
            font-family: 'Roboto', sans-serif;
        }

        .card1::before {
            position: absolute;
            top: 5.1rem;
            right: -14.9px;
            content: '';
            background: #283593;
            height: 28px;
            width: 28px;
            padding: 0.8rem;

            transform: rotate(45deg);
            z-index: -1;

        }


        .card1::after {
            position: absolute;
            content: attr(data-label);
            /* top: 3.7rem; */
            /* top: 146px; */
            top: 47px;

            right: -21px;
            padding: 0.4rem;
            width: 10rem;
            background: #3949ab;
            color: white;
            text-align: center;
            /* font-family: 'Roboto', sans-serif; */
            font-family: "Montserrat", sans-serif;
            box-shadow: 4px 4px 15px rgba(26, 35, 126, 0.2);
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 24px;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;

        }

        input {
            font-family: "Montserrat", sans-serif;
        }

        p.text-muted.small {
            font-family: "Montserrat", sans-serif;
        }

        p.text-muted {
            font-family: "Montserrat", sans-serif;
        }

        h5.text-primary {
            font-size: 25px;
        }

        .card:hover {
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.5);
            cursor: pointer;
        }

        .form-select {
            cursor: pointer;
            transition: border 0.3s ease, box-shadow 0.3s ease;
            -moz-appearance: none;
            cursor: pointer;
            font-family: "Montserrat", sans-serif;

        }

        .results-header .text-primary {
            color: #00bcd4;
            /* Use the primary color */
            font-weight: bold;
        }

        .results-header .text-primary:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .results-header select {
            color: #00bcd4;
            border: none !important;
            background-color: #eff3f8;
            outline: none;
        }
        @media screen and (max-width: 991px) {
           .search-box {
                width: 100%;
            }
            .search-box.form-group {
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0">
        <div class="overlay" data-aos="zoom-in" data-aos-duration="2000">
            <img src="https://images.pexels.com/photos/453201/pexels-photo-453201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                style="width: 100%; height: 90vh; object-fit: cover;" alt="">

            <div class="img-overlay">
                <h2> {{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="rooms" class="rooms_wrapper">
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h3>OUR ROOMS</h3>
                    <div class="h-line bg-dark"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 rounded">
                    <div class="search-box shadow">
                        <div class="search-header">
                            <i class="fas fa-search"></i> Modify Search
                        </div>
                        {{-- <form method="GET" action="{{ route('rooms.filter') }}">
                            <div class="px-3 pt-3">
                                <label for="checkin" class="form-label">Check In</label>
                                <input type="date" name="check_in_date" class="form-control shadow-none me-1" id="checkin" required>
                            </div>
                            <div class="px-3">
                                <label for="checkout" class="form-label">Check Out</label>
                                <input type="date" name="check_out_date" class="form-control shadow-none me-1" id="checkout" required>
                            </div>
                            <div class="footer-label p-3">
                                <div class="d-flex justify-content-center align-items-center gap-4">
                                    <div>
                                        <label for="adults" class="form-label">Adults</label>
                                        <input type="number" name="adults" class="form-control shadow-none" id="adults" min="1" required>
                                    </div>
                                    <div class="ml-3">
                                        <label for="children" class="form-label">Children</label>
                                        <input type="number" name="children" class="form-control shadow-none" id="children" min="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid text-center mb-4">
                                <input type="submit" value="Search" style="background: #08c1da" class="btn border-0 text-white">
                            </div>
                        </form> --}}
                        {{-- <form id="filter-form">
                            <div class="px-3 pt-3">
                                <label for="checkin" class="form-label">Check In</label>
                                <input type="date" name="check_in_date" id="checkin"
                                    class="form-control shadow-none me-1" required>
                            </div>
                            <div class="px-3">
                                <label for="checkout" class="form-label">Check Out</label>
                                <input type="date" name="check_out_date" id="checkout"
                                    class="form-control shadow-none me-1" required>
                            </div>
                            <div class="footer-label p-3">
                                <div class="d-flex justify-content-center align-items-center gap-4">
                                    <div>
                                        <label for="adults" class="form-label">Adults</label>

                                        <select name="adults" id="adults" class="form-select form-control shadow-none "
                                            required>
                                            <option value="" disabled selected>Select adults</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                    Adult{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="ml-3">
                                        <label for="children" class="form-label">Children</label>
                                        <select name="children" id="children"
                                            class="form-select form-control shadow-none me-1 " required>
                                            <option value="" disabled selected>Select children</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                    Children{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                        </form> --}}

                        <form id="filter-form">
                            <div class="px-3 pt-3">
                                <label for="checkin" class="form-label">Check In</label>
                                <input type="date" name="check_in_date" id="checkin"
                                    class="form-control shadow-none me-1" required>
                            </div>
                            <div class="px-3">
                                <label for="checkout" class="form-label">Check Out</label>
                                <input type="date" name="check_out_date" id="checkout"
                                    class="form-control shadow-none me-1" required>
                            </div>
                            <div class="footer-label p-3">
                                <div class="d-flex justify-content-center align-items-center gap-4">
                                    <div>
                                        <label for="adults" class="form-label">Adults</label>
                                        <select name="adults" id="adults" class="form-select form-control shadow-none"
                                            required>
                                            <option value="" disabled selected>Select adults</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                    Adult{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="ml-3">
                                        <label for="children" class="form-label">Children</label>
                                        <select name="children" id="children"
                                            class="form-select form-control shadow-none me-1" required>
                                            <option value="" disabled selected>Select children</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                    Children{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="results-header">
                        <h4><span class="text-primary">{{ $rooms->count() }}</span> results found</h4>
                        <div class="d-flex items-center justify-between py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-primary me-1 small">Sort by</span>


                                {{-- <form id="sortForm" method="POST">
                                    @csrf
                                    <select name="sort_by" id="sort-by" class="shadow-none small border-0 rounded px-2 py-1" style="background: #eff3f8;">
                                        <option value="" selected disabled>Sort</option>
                                        <option value="price" data-order="desc">High Price</option>
                                        <option value="price" data-order="asc">Low Price</option>
                                    </select>
                                    <input type="hidden" name="order_by" id="order-by" value="asc">
                                </form> --}}
                                <form id="sortForm">
                                    <select id="sort-by" name="sort_by">
                                        {{-- <option value="price" data-order="asc">Price: Low to High</option>
                                        <option value="price" data-order="desc">Price: High to Low</option> --}}
                                        <option value="" selected disabled></option>
                                        <option value="price" data-order="asc">Low pric</option>
                                        <option value="price" data-order="desc">High price</option>

                                    </select>
                                    <input type="hidden" id="order-by" name="order_by" value="asc">
                                </form>


                            </div>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Results Header -->
                        <h4>
                            <span class="text-primary">{{ $rooms->count() }}</span> results found
                        </h4>
                
                        <!-- Sort and Show Options -->
                        <div class="d-flex align-items-center">
                            <!-- Sort by Dropdown -->
                            <div class="dropdown me-3">
                                <span class="me-2">Sort by</span>
                                <button class="btn border-0 btn-sm dropdown-toggle shadow-none" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Price
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end text-center shadow" aria-labelledby="sortDropdown" style="min-width: auto; font-size: 0.875rem; padding: 0.25rem 0; border-radius: 8px; border: 1px solid #ddd;">
                                    <li><a class="dropdown-item py-2" href="#">Price</a></li>
                                    <li><a class="dropdown-item py-2" href="#">Rating</a></li>
                                    <li><a class="dropdown-item py-2" href="#">Popular</a></li>
                                </ul>
                            </div>
                            
                            
                
                            <!-- Show Items Dropdown -->
                            <div class="dropdown">
                                <span class="me-2">Show</span>
                                <button class="btn btn-outline-secondary dropdown-toggle shadow-none" type="button" id="showItemsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    9 items
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="showItemsDropdown">
                                    <li><a class="dropdown-item" href="#">9 items</a></li>
                                    <li><a class="dropdown-item" href="#">18 items</a></li>
                                    <li><a class="dropdown-item" href="#">27 items</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="results-header flex items-center justify-between py-2">
                        <div class="flex items-center">
                            <span class="text-primary me-1">Sort by</span>
                            <select class="border rounded px-2 py-1">
                                <option value="price">Price</option>
                                <option value="rating">Rating</option>
                                <option value="popularity">Popularity</option>
                            </select>
                        </div>
                        <div>
                            <span>Show <span class="text-primary cursor-pointer">27</span> items</span>
                        </div>
                    </div> --}}

                    {{-- <div class="row g-4">
                        @foreach ($rooms as $room)
                        <div class="col-md-4">
                            <div class="card1" data-label="${{ number_format($room->price),0 }}">
                                <p class="card__body">
                                <div class="hotel-card shadow">
                                    <img src="{{ asset('storage/' . $room->images->first()->image) }}" alt="{{ $room->roomType->type_name }}">
                                    <div class="hotel-details">
                                        <h5>{{ $room->roomType->type_name }}</h5>
                                        <div class="rating mb-1" >Capacity {{$room->max_person}}</div>
                                        <div class="location">{{ $room->description }}</div>
                                        <button class="btn btn-outline-info select-btn">Select</button>
                                    </div>

                                </div>
                                </p>
                            </div>
                        </div>
                        @endforeach

                    </div> --}}
                    {{-- <div id="rooms-container" class="px-3 mb-4 border-0 shadow-none">
                        <div class="row g-0 align-items-center p-3 card-wrapper">
                            @foreach ($rooms as $room)
                                <div class="card1 mb-3 card2" data-label="$ {{ number_format($room->price), 0 }}">
                                    <div class="row">
                                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                            <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                                alt="{{ $room->roomType->type_name }}"
                                                style="width: 700px; height: 260px; rounded">
                                        </div>
                                        <div class="col-md-5 px-3 py-3">
                                            <h5 class="mb-3">{{ $room->roomType->type_name }}</h5>
                                            <div class="features mb-3">
                                                <h6 class="mb-1 "
                                                    style="font-family: 'Montserrat', sans-serif;font-weight:400;">
                                                    Facilities</h6>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap"
                                                    style="font-family: 'Montserrat', sans-serif;">2 Room</span>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap"
                                                    style="font-family: 'Montserrat', sans-serif;">Feature</span>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap"
                                                    style="font-family: 'Montserrat', sans-serif;">2 Room</span>

                                                <h6 class="mb-1"
                                                    style="font-family: 'Montserrat', sans-serif;font-weight:400;">Guests
                                                </h6>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap"
                                                    style="font-family: 'Montserrat', sans-serif;">5 Adults</span>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap"
                                                    style="font-family: 'Montserrat', sans-serif;">4 Children</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 py-3 px-4 text-left">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}
                    <div id="rooms-container" class="container py-4">
                        {{-- @foreach ($rooms as $room)
                            <div class="card mb-4 shadow border-0" data-aos="fade-down" data-aos-duration="1000">
                                <div class="row g-0">

                                    <div class="col-md-5">
                                        <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                            alt="{{ $room->roomType->type_name }}" class="img-fluid rounded-start"
                                            style="height: 100%; width: 700px; object-fit: cover;">
                                    </div>


                                    <div class="col-md-5">
                                        <div class="card-body">

                                            <h5 class="card-title">{{ $room->roomType->type_name }}</h5>


                                            <p class="text-muted small">
                                                <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                                            </p>


                                            <h6 class="mb-2"
                                                style="font-family: 'Montserrat', sans-serif;font-weight:400;">Facilities
                                            </h6>
                                            @if ($room->facilities->isNotEmpty())
                                                @foreach ($room->facilities as $facility)
                                                    <span class="badge bg-light text-dark text-wrap">{{ $facility->name }}</span>
                                                @endforeach
                                            @endif


                                            <h6 class="mb-2"
                                                style="font-family: 'Montserrat', sans-serif;font-weight:400;'">Guests</h6>
                                            <div class="">

                                                <span class="badge bg-light text-dark">Max: {{ $room->max_person }}
                                                    Persons</span>
                                            </div>


                                            <p class="text-muted small mb-0">
                                                <span class="badge bg-light text-dark">View : Sea View</span>
                                                <span class="badge bg-light text-dark">Size : 45 m<sup>2</sup></span>
                                                <span class="badge bg-light text-dark">View : Sea View</span>
                                                <span class="badge bg-light text-dark">Bed : 1</span>
                                            </p>
                                        </div>
                                    </div>

                                   
                                    <div
                                        class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                                        <div>
                                            @if ($room->is_special_offer)
                                                <span class="badge bg-danger text-white mb-2">SPECIAL OFFER</span>
                                            @endif
                                            <p class="mb-1 text-muted">From</p>
                                            <h5 class="text-primary">$ {{ number_format($room->price, 0) }}</h5>
                                            <p class="text-muted">per night</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                        @include('frontend.rooms.room_list')

                            {{ $rooms->appends(request()->query())->links() }}

                            
                        

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        // document.addEventListener('DOMContentLoaded', () => {
        //     const form = document.getElementById('filter-form');
        //     const roomsContainer = document.getElementById('rooms-container');

        //     const reloadRooms = () => {
        //         const formData = new FormData(form);
        //         const params = new URLSearchParams();

        //         for (const [key, value] of formData.entries()) {
        //             if (value) {
        //                 params.append(key, value); // Only append non-empty values
        //             }
        //         }

        //         fetch(`{{ route('rooms.filter') }}?${params.toString()}`, {
        //                 headers: {
        //                     'X-Requested-With': 'XMLHttpRequest',
        //                 },
        //             })
        //             .then((response) => {
        //                 if (!response.ok) {
        //                     throw new Error('Failed to fetch rooms');
        //                 }
        //                 return response.text();
        //             })
        //             .then((html) => {
        //                 roomsContainer.innerHTML = html;
        //             })
        //             .catch((error) => {
        //                 console.error('Error:', error);
        //             });
        //     };


        //     form.querySelectorAll('input').forEach((input) => {
        //         input.addEventListener('change', reloadRooms);
        //     });
        // });
        // document.addEventListener('DOMContentLoaded', () => {
        //     const form = document.getElementById('filter-form');
        //     const roomsContainer = document.getElementById('rooms-container');
        //     const resultsHeader = document.querySelector('.results-header h4 span.text-primary');

        //     const reloadRooms = () => {
        //         const formData = new FormData(form);
        //         const params = new URLSearchParams();

        //         for (const [key, value] of formData.entries()) {
        //             if (value) {
        //                 params.append(key, value); // Only append non-empty values
        //             }
        //         }

        //         fetch(`{{ route('rooms.filter') }}?${params.toString()}`, {
        //                 headers: {
        //                     'X-Requested-With': 'XMLHttpRequest',
        //                 },
        //             })
        //             .then((response) => {
        //                 if (!response.ok) {
        //                     throw new Error('Failed to fetch rooms');
        //                 }
        //                 return response.text();
        //             })
        //             .then((html) => {
        //                 roomsContainer.innerHTML = html;

        //                 // Update the room count dynamically
        //                 const roomsCount = roomsContainer.querySelectorAll('.card1').length;
        //                 resultsHeader.textContent = roomsCount;
        //             })
        //             .catch((error) => {
        //                 console.error('Error:', error);
        //             });
        //     };

        //     // Listen for changes on the filter fields
        //     form.querySelectorAll('input, select').forEach((input) => {
        //         input.addEventListener('change', reloadRooms);
        //     });
        // });

        // document.addEventListener('DOMContentLoaded', () => {
        //     const form = document.getElementById('filter-form');
        //     const roomsContainer = document.getElementById('rooms-container');
        //     const resultsHeader = document.querySelector('.results-header h4 span.text-primary');

        //     const reloadRooms = () => {
        //         const formData = new FormData(form);
        //         const params = new URLSearchParams();

        //         for (const [key, value] of formData.entries()) {
        //             if (value) {
        //                 params.append(key, value);
        //             }
        //         }

        //         fetch(`{{ route('rooms.filter') }}?${params.toString()}`, {
        //                 headers: {
        //                     'X-Requested-With': 'XMLHttpRequest',
        //                 },
        //             })
        //             .then((response) => {
        //                 if (!response.ok) {
        //                     throw new Error('Failed to fetch rooms');
        //                 }
        //                 return response.text();
        //             })
        //             .then((html) => {
        //                 roomsContainer.innerHTML = html;

        //                 const roomsCount = roomsContainer.querySelectorAll('.card').length;
        //                 resultsHeader.textContent = roomsCount;
        //             })
        //             .catch((error) => console.error('Error:', error));
        //     };

        //     form.querySelectorAll('input, select').forEach((input) => {
        //         input.addEventListener('change', reloadRooms);
        //     });
        // });

        document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('filter-form');
    const roomsContainer = document.getElementById('rooms-container');
    const resultsHeader = document.querySelector('.results-header h4 span.text-primary');

    const reloadRooms = () => {
        const formData = new FormData(form);
        const params = new URLSearchParams();

        for (const [key, value] of formData.entries()) {
            if (value) {
                params.append(key, value);
            }
        }

        // Fade out the rooms container before loading new content
        $(roomsContainer).fadeOut(300, function () {
            fetch(`{{ route('rooms.filter') }}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch rooms');
                    }
                    return response.text();
                })
                .then((html) => {
                    roomsContainer.innerHTML = html;

                    // Update the rooms count
                    const roomsCount = roomsContainer.querySelectorAll('.card').length;
                    resultsHeader.textContent = roomsCount;

                    // Fade in with animation after new content is loaded
                    $(roomsContainer).fadeIn(500).css({
                        position: 'relative',
                        top: '-20px',
                        opacity: 0,
                    }).animate({
                        top: '0px',
                        opacity: 1,
                    }, 500);
                })
                .catch((error) => console.error('Error:', error));
        });
    };

    // Add change event listener to all filter inputs
    form.querySelectorAll('input, select').forEach((input) => {
        input.addEventListener('change', reloadRooms);
    });
});



        // document.addEventListener("DOMContentLoaded", function() {

        //     gsap.registerPlugin(ScrollTrigger);
        //     const cards = document.querySelectorAll('.card1');
        //     cards.forEach(card => {
        //         gsap.from(card, {
        //             scrollTrigger: {
        //                 trigger: card, // Trigger animation when the card enters the viewport
        //                 start: "top 85%", // Animation starts when the top of the card is 85% down the viewport
        //                 end: "bottom 15%", // Animation ends when the bottom of the card is 15% down the viewport
        //                 toggleActions: "play none none reverse", // Reverses animation when scrolling back up
        //             },
        //             opacity: 0, // Start fully transparent
        //             y: -50, // Start with the card 50px above its original position (fade-up)
        //             duration: 1, // Animation duration
        //             ease: "power2.out", // Smooth easing
        //         });
        //     });
        // });

        //         $(document).ready(function() {
        //             $('#sort-by').change(function() {
        //                 var sortBy = $(this).val();
        //                 var orderBy = (sortBy == 'price' && $('input[name="order_by"]').val() == 'asc') ? 'desc' : 'asc';

        //                 // Update the hidden input to reflect the new order
        //                 $('input[name="order_by"]').val(orderBy);

        //                 $.ajax({
        //                     url: '{{ route('rooms.sort') }}',
        //                     type: 'POST',
        //                     data: {
        //                         _token: $('meta[name="csrf-token"]').attr('content'),  // CSRF Token
        //                         sort_by: sortBy,
        //                         order_by: orderBy
        //                     },
        //                     success: function(response) {
        //                         // Update the rooms container with the sorted data
        //                         $('#rooms-container').html(response.rooms);
        //                     },
        //                     error: function(xhr, status, error) {
        //                         console.error("AJAX Error: ", error);
        //                     }
        //                 });
        //             });
        // });

        $(document).ready(function() {
            $('#sort-by').change(function() {
                const sortBy = $(this).val();
                const orderBy = $(this).find(':selected').data('order');

                $('#order-by').val(orderBy); // Update the hidden input

                fetchRooms(1, sortBy, orderBy); // Fetch rooms, reset to page 1
            });
        });

        function fetchRooms(page = 1, sortBy = 'price', orderBy = 'asc') {
            $.ajax({
                url: '{{ route('rooms.sort') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    page: page,
                    sort_by: sortBy,
                    order_by: orderBy,
                },
                success: function(response) {
                    $('#rooms-container').html(response.rooms);
                },
                error: function(xhr, status, error) {
                    console.error('Fetch Rooms Error:', error);
                },
            });
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault(); // Prevent the default page reload

            const page = $(this).attr('href').split('page=')[1];
            const sortBy = $('#sort-by').val();
            const orderBy = $('#order-by').val();

            fetchRooms(page, sortBy, orderBy);
        });

        // $(document).ready(function() {
        //     $('#sort-by').change(function() {
        //         const sortBy = $(this).val();
        //         const orderBy = $(this).find(':selected').data('order');

        //         $('#order-by').val(orderBy); // Update the hidden input

        //         fetchRooms(1, sortBy, orderBy); // Fetch rooms, reset to page 1
        //     });
        // });

        // function fetchRooms(page = 1, sortBy = 'price', orderBy = 'asc') {
        //     $('#rooms-container').fadeOut(300, function() {
        //         $.ajax({
        //             url: '{{ route('rooms.sort') }}',
        //             type: 'POST',
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 page: page,
        //                 sort_by: sortBy,
        //                 order_by: orderBy,
        //             },
        //             success: function(response) {
        //                 $('#rooms-container').html(response.rooms).fadeIn(500).css({
        //                     position: 'relative',
        //                     top: '-20px',
        //                     opacity: 0,
        //                 }).animate({
        //                     top: '0px',
        //                     opacity: 1,
        //                 }, 500);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Fetch Rooms Error:', error);
        //             },
        //         });
        //     });
        // }

        // $(document).on('click', '.pagination a', function(e) {
        //     e.preventDefault(); // Prevent the default page reload

        //     const page = $(this).attr('href').split('page=')[1];
        //     const sortBy = $('#sort-by').val();
        //     const orderBy = $('#order-by').val();

        //     fetchRooms(page, sortBy, orderBy);
        // });



        // When sorting options are changed
    </script>
@endsection

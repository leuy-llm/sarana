<style>
    @keyframes pulsate {
        0% {
            transform: scale(1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        50% {
            transform: scale(1.1);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
        }

        100% {
            transform: scale(1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    }

    .book-now-btn {
        background: #deb666;
        color: #fff;
        font-size: 14px;
        transition: all 0.3s ease;
        animation: pulsate 2s infinite;
    }

    .book-now-btn:hover {
        background: #c89c55;
        color: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        /* Enhance shadow on hover */
    }

    .custom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .custom-modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .close-modal-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }
</style>
@if ($rooms->isEmpty())
    <div class="alert alert-warning text-center" style="font-family: 'Jost', serif;font-size: 16px;">
        <h3> No rooms available for the selected criteria. Please adjust your search and try again.</h3>
    </div>
@else
    {{-- @foreach ($rooms as $room)
        <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                        alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start"
                        style="height: 300px; width: 700px; object-fit: cover;" loading="lazy">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                        <p class="text-muted small">
                            <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                        </p>
                        <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                        @if ($room->special_price)
                            <div class="text-success">
                                <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                <span class="original-price ms-2">
                                    $ {{ number_format($room->price, 0) }}
                                </span>
                            </div>
                        @endif

                        <div class="d-flex align-items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                            @endfor

                        </div>
                        
                        <h6 class="mt-3 text-uppercase">Guests</h6>
                        <div>
                            <span class="badge bg-light text-dark">Max: {{ $room->max_person }}
                                Persons</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                    <div>
                        @if ($room->special_price)
                            <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL
                                OFFER</span>
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @else
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @endif
                    </div>
                    <a href="{{ route('books.create', ['room_id' => $room->id, 'check_in' => $checkIn, 'check_out' => $checkOut, 'adults' => $adults, 'children' => $children]) }}"
                        class="btn book-now-btn mb-2 shadow-none rounded-0 py-2 font-weight-bold text-uppercase text-white px-4"
                        style="background: #deb666; font-size: 14px">
                        Book now
                     </a>
                </div>
            </div>
        </div>
    @endforeach --}}

    {{-- <form  method="POST">
        @csrf
        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                    <div>
                        @if ($room->special_price)
                            <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL OFFER</span>
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @else
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @endif
                    </div>
                    <div>
                        <!-- Checkbox for selecting the room -->
                        <input type="checkbox" name="selected_rooms[]" value="{{ $room->id }}" id="room_{{ $room->id }}">
                        <label for="room_{{ $room->id }}">Select Room</label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            <!-- Hidden inputs for booking details -->
            <input type="hidden" name="check_in" value="{{ $checkIn }}">
            <input type="hidden" name="check_out" value="{{ $checkOut }}">
            <input type="hidden" name="adults" value="{{ $adults }}">
            <input type="hidden" name="children" value="{{ $children }}">
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary w-100">Book Selected Rooms</button>
        </div>
    </form> --}}
    {{-- <form  method="POST">
        @csrf
        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                    <div>
                        @if ($room->special_price)
                            <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL OFFER</span>
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @else
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @endif
                    </div>
                    <div>
                        <!-- Checkbox for selecting the room -->
                        <input type="checkbox" name="selected_rooms[{{ $room->id }}]" value="{{ $room->id }}" 
                               id="room_{{ $room->id }}" onchange="toggleInputs({{ $room->id }})">
                        <label for="room_{{ $room->id }}">Select Room</label>
                    </div>
                    <!-- Inputs for Adults and Children -->
                    <div class="mt-2">
                        <label for="adults_{{ $room->id }}" class="form-label">Adults</label>
                        <input type="number" name="adults[{{ $room->id }}]" id="adults_{{ $room->id }}" 
                               class="form-control" min="1" disabled>
                        <label for="children_{{ $room->id }}" class="form-label mt-2">Children</label>
                        <input type="number" name="children[{{ $room->id }}]" id="children_{{ $room->id }}" 
                               class="form-control" min="0" disabled>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            <!-- Hidden inputs for booking dates -->
            <input type="hidden" name="check_in" value="{{ $checkIn }}">
            <input type="hidden" name="check_out" value="{{ $checkOut }}">
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary w-100">Book Selected Rooms</button>
        </div>
    </form> --}}

    {{-- @foreach ($rooms as $room)
               
                <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                                alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start"
                                style="height: 300px; width: 700px; object-fit: cover;" loading="lazy">
                        </div>
                        <div class="col-md-5">
                            <div class="card-body">
                                <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                                <p class="text-muted small">
                                    <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                                </p>
                                <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                                @if ($room->special_price)
                                    <div class="text-success">
                                        <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                        <span class="original-price ms-2">
                                            $ {{ number_format($room->price, 0) }}
                                        </span>
                                    </div>
                                @endif
        
                                <div class="d-flex align-items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                                    @endfor
        
                                </div>
                                
                                <h6 class="mt-3 text-uppercase">Guests</h6>
                                <div>
                                    <span class="badge bg-light text-dark">Max: {{ $room->max_person }}
                                        Persons</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                            <div>
                                @if ($room->special_price)
                                    <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL
                                        OFFER</span>
                                    <p class="mb-1 text-muted text-uppercase">From</p>
                                    <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                                    <p class="text-muted text-uppercase">per night</p>
                                @else
                                    <p class="mb-1 text-muted text-uppercase">From</p>
                                    <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                                    <p class="text-muted text-uppercase">per night</p>
                                @endif
                            </div>
                           
                            <a href="{{ route('books.create', ['room_id' => $room->id, 'check_in' => $checkIn, 'check_out' => $checkOut, 'adults' => $adults, 'children' => $children]) }}"
                                class="btn book-now-btn mb-2 shadow-none rounded-0 py-2 font-weight-bold text-uppercase text-white px-4"
                                style="background: #deb666; font-size: 14px">
                                Book now
                             </a>
                        </div>
                    </div>
                </div>
            @endforeach --}}
    {{-- <div class="pagination-links">
        {!! $rooms->links() !!}
    </div>
     --}}
    {{-- @foreach ($rooms as $room)
    <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                    alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start"
                    style="height: 300px; width: 700px; object-fit: cover;" loading="lazy">
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                    <p class="text-muted small">
                        <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                    </p>
                    <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                    @if ($room->special_price)
                        <div class="text-success">
                            <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                            <span class="original-price ms-2">
                                $ {{ number_format($room->price, 0) }}
                            </span>
                        </div>
                    @endif

                    <div class="d-flex align-items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                        @endfor
                    </div>

                    <h6 class="mt-3 text-uppercase">Guests</h6>
                    <div>
                        <span class="badge bg-light text-dark">Max: {{ $room->max_person }}
                            Persons</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                <div>
                    @if ($room->special_price)
                        <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL
                            OFFER</span>
                        <p class="mb-1 text-muted text-uppercase">From</p>
                        <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                        <p class="text-muted text-uppercase">per night</p>
                    @else
                        <p class="mb-1 text-muted text-uppercase">From</p>
                        <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                        <p class="text-muted text-uppercase">per night</p>
                    @endif
                </div>

                <!-- Checkbox for room selection -->
                <input type="checkbox" name="selected_rooms[{{ $room->id }}]" id="room_{{ $room->id }}"
                    onchange="toggleInputs({{ $room->id }})" class="mb-2">
                <label for="room_{{ $room->id }}">Select Room</label>

                <!-- Inputs for adults and children -->
                <div class="mt-3">
                    <label for="adults_{{ $room->id }}" class="form-label">Adults</label>
                    <input type="number" name="adults[{{ $room->id }}]" id="adults_{{ $room->id }}"
                        class="form-control mb-2" min="1" placeholder="0" disabled>

                    <label for="children_{{ $room->id }}" class="form-label">Children</label>
                    <input type="number" name="children[{{ $room->id }}]" id="children_{{ $room->id }}"
                        class="form-control" min="0" placeholder="0" disabled>
                </div>

                <!-- Book Now Button -->
                <a href="{{ route('books.create', ['room_id' => $room->id, 'check_in' => $checkIn, 'check_out' => $checkOut, 'adults' => $adults, 'children' => $children]) }}"
                    class="btn book-now-btn mb-2 shadow-none rounded-0 py-2 font-weight-bold text-uppercase text-white px-4"
                    style="background: #deb666; font-size: 14px">
                    Book now
                </a>
            </div>
        </div>
    </div>
    @endforeach --}}

    {{-- @foreach ($rooms as $room)
        <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                        alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start"
                        style="height: 370px; width: 700px; object-fit: cover;" loading="lazy">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                        <p class="text-muted small">
                            <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                        </p>
                        <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                        @if ($room->special_price)
                            <div class="text-success">
                                <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                <span class="original-price ms-2">
                                    $ {{ number_format($room->price, 0) }}
                                </span>
                            </div>
                        @endif

                        <div class="d-flex align-items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                            @endfor
                        </div>

                        <h6 class="mt-3 text-uppercase">Guests</h6>
                        <div>
                            <span class="badge bg-light text-dark">Max: {{ $room->max_person }} Persons</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                    <div>
                        @if ($room->special_price)
                            <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL
                                OFFER</span>
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @else
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @endif
                    </div>
                    <!-- Checkbox for room selection -->
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="room_{{ $room->id }}" name="rooms[]"
                            value="{{ $room->id }}">
                        <label class="form-check-label" for="room_{{ $room->id }}">Select Room </label>
                    </div>
                   
                </div>
            </div>
        </div>
    @endforeach --}}

    {{-- <form action="{{ route('booking.details') }}" method="POST">
    @csrf
    @foreach ($rooms as $room)
        <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $room->images->first()->image) }}" alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start" style="height: 370px; width: 700px; object-fit: cover;" loading="lazy">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                        <p class="text-muted small">
                            <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                        </p>
                        <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                        @if ($room->special_price)
                            <div class="text-success">
                                <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                <span class="original-price ms-2">$ {{ number_format($room->price, 0) }}</span>
                            </div>
                        @endif
                        <div class="d-flex align-items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                            @endfor
                        </div>
                        <h6 class="mt-3 text-uppercase">Guests</h6>
                        <div>
                            <span class="badge bg-light text-dark">Max: {{ $room->max_person }} Persons</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                    <div>
                        @if ($room->special_price)
                            <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL OFFER</span>
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @else
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @endif
                    </div>
                    <!-- Checkbox for room selection -->
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="room_{{ $room->id }}" name="rooms[]" value="{{ $room->id }}">
                        <label class="form-check-label" for="room_{{ $room->id }}">Select Room </label>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <button type="submit" class="btn btn-primary shadow-none py-2 w-100">Go to Booking Details</button>
</form> --}}

@foreach ($rooms as $room)
    <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $room->images->first()->image) }}" alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start" style="height: 370px; width: 700px; object-fit: cover;" loading="lazy">
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                    <p class="text-muted small">
                        <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                    </p>
                    <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                    @if ($room->special_price)
                        <div class="text-success">
                            <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                            <span class="original-price ms-2">$ {{ number_format($room->price, 0) }}</span>
                        </div>
                    @endif
                    <div class="d-flex align-items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                        @endfor
                    </div>
                    <h6 class="mt-3 text-uppercase">Guests</h6>
                    <div>
                        <span class="badge bg-light text-dark">Max: {{ $room->max_person }} Persons</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                <div>
                    @if ($room->special_price)
                        <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL OFFER</span>
                        <p class="mb-1 text-muted text-uppercase">From</p>
                        <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                        <p class="text-muted text-uppercase">per night</p>
                    @else
                        <p class="mb-1 text-muted text-uppercase">From</p>
                        <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                        <p class="text-muted text-uppercase">per night</p>
                    @endif
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="room_{{ $room->id }}" name="rooms[]"
                        value="{{ $room->id }}">
                    <label class="form-check-label" for="room_{{ $room->id }}">Select Room </label>
                </div>
                <!-- Book Now Button -->
            </div>
        </div>
    </div>
    @endforeach
@endif
<!-- Add your JavaScript at the bottom of the page or inside a script tag -->
<script>


</script>

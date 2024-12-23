
@if ($rooms->isEmpty())
    <div class="alert alert-warning text-center" style="font-family: 'Montserrat', sans-serif;font-size: 16px;">
       <h3> No rooms available for the selected criteria. Please adjust your search and try again.</h3>
    </div>
@else
    {{-- @foreach ($rooms as $room)
        <div class="card1 mb-3" data-aos="zoom-in" data-aos-duration="1500"   data-label="$ {{ number_format($room->price, 0) }}">
            <div class="row" >
                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                    <img src="{{ asset('storage/' . $room->images->first()->image) }}" 
                        alt="{{ $room->roomType->type_name }}" 
                        style="width: 700px; height: 260px; rounded">
                </div>
                <div class="col-md-5 px-3 py-3">
                    <h5 class="mb-3">{{ $room->roomType->type_name }}</h5>
                    <div class="features mb-3">
                        <h6 class="mb-1" style="font-family: 'Montserrat', sans-serif; font-weight: 400;">
                            Facilities
                        </h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap" 
                            style="font-family: 'Montserrat', sans-serif;">
                            2 Room
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap" 
                            style="font-family: 'Montserrat', sans-serif;">
                            Feature
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap" 
                            style="font-family: 'Montserrat', sans-serif;">
                            2 Room
                        </span>

                        <h6 class="mb-1" style="font-family: 'Montserrat', sans-serif; font-weight: 400;">
                            Guests
                        </h6>

                        <span class="badge rounded-pill bg-light text-dark text-wrap" 
                            style="font-family: 'Montserrat', sans-serif;">
                            {{ $room->max_person }} Total Persons
                        </span>
                        @php
                            // Calculate adults and children from bookings
                            $adultsBooked = $room->bookings->sum('adults');
                            $childrenBooked = $room->bookings->sum('children');
                        @endphp

                        <span class="badge rounded-pill bg-light text-dark text-wrap" 
                            style="font-family: 'Montserrat', sans-serif;">
                            {{ $adultsBooked }} Adults
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap" 
                            style="font-family: 'Montserrat', sans-serif;">
                            {{ $childrenBooked }} Children
                        </span>
                    </div>
                </div>
                <div class="col-md-2 py-3 pl-4 text-left">
                    <!-- Add any additional information or actions for the room here -->
                </div>
            </div>
        </div>
    @endforeach --}}
    @foreach ($rooms as $room)
        <div class="card mb-4 shadow border-0" data-aos="fade-down" data-aos-delay='100'>
            <div class="row g-0">
                <!-- Room Image -->
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                        alt="{{ $room->roomType->type_name }}" class="img-fluid rounded-start"
                        style="height: 100%; width: 700px; object-fit: cover;">
                </div>

                <!-- Room Details -->
                <div class="col-md-5">
                    <div class="card-body">
                        <!-- Room Title -->
                        <h5 class="card-title">{{ $room->roomType->type_name }}</h5>

                        <!-- Location -->
                        <p class="text-muted small">
                            <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                        </p>

                        <!-- Facilities -->
                        <h6 class="mb-2" style="font-family: 'Montserrat', sans-serif;font-weight:400;">Facilities
                        </h6>
                        @if ($room->facilities->isNotEmpty())
                            @foreach ($room->facilities as $facility)
                                <span class="badge bg-light text-dark">{{ $facility->name }}</span>
                            @endforeach
                        @endif

                        <!-- Guests -->
                        <h6 class="mb-2" style="font-family: 'Montserrat', sans-serif;font-weight:400;'">Guests</h6>
                        <div class="">
                            {{-- <span class="badge bg-light text-dark">5 Adults</span> --}}
                            <span class="badge bg-light text-dark">Max: {{ $room->max_person }} Persons</span>
                        </div>

                        <!-- Last Booking Info -->
                        <p class="text-muted small mb-0">
                            <span class="badge bg-light text-dark">View : Sea View</span>
                            <span class="badge bg-light text-dark">Size : 45 <sub>2</sub></span>
                            <span class="badge bg-light text-dark">View : Sea View</span>
                            <span class="badge bg-light text-dark">Bed : 1</span>
                        </p>
                    </div>
                </div>

                <!-- Price & Action -->
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                    <div>
                        @if ($room->is_special_offer)
                            <span class="badge bg-danger text-white mb-2">SPECIAL OFFER</span>
                        @endif
                        <p class="mb-1 text-muted">From</p>
                        <h5 class="text-primary">$ {{ number_format($room->price, 0) }}</h5>
                        <p class="text-muted">per night</p>
                    </div>
                    <a href="{{ route('roomDetail', ['id' => $room->id, 'type_name' => $room->roomType->type_name]) }}" class="btn btn-outline-primary shadow-none w-100">Select</a>

                    {{-- <a href="{{ route('roomDetail', ['id' => $data->id, 'type_name' => Str::slug($data->roomType->type_name)]) }}></a> --}}
                       
                    
                </div>
            </div>
        </div>
    @endforeach
    <nav>
        {{ $rooms->appends([
            'sort_by' => request('sort_by', 'price'),
            'order_by' => request('order_by', 'asc')
        ])->links() }}
        

    </nav>
    
@endif

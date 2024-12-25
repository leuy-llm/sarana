@if ($rooms->isEmpty())
    <div class="alert alert-warning text-center" style="font-family: 'Montserrat', sans-serif;font-size: 16px;">
        <h3> No rooms available for the selected criteria. Please adjust your search and try again.</h3>
    </div>
@else
    @foreach ($rooms as $room)
        <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
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
                    <a href="{{ route('roomDetail', ['id' => $room->id, 'type_name' => Str::slug($room->roomType->type_name), 'check_in_date' => $checkIn, 'check_out_date' => $checkOut, 'adults' => $adults, 'children' => $children]) }}"
                        class="btn btn-outline-primary shadow-none">
                        View Details
                    </a>


                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="pagination-links">
        {!! $rooms->links() !!}
    </div>
     --}}
@endif

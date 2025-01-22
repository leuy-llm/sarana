@foreach ($availableRooms as $room)
    <div class="card mb-4 shadow border-0">
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
                    @if ($room->special_price)
                        <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
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
                        <span class="badge bg-danger text-white p-2 rounded-0 mb-2 mt-3 text-uppercase">SPECIAL OFFER</span>
                        <p class="mb-1 text-muted text-uppercase">From</p>
                        <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                        <p class="text-muted text-uppercase">per night</p>
                    @else
                        <p class="mb-1 text-muted text-uppercase">From</p>
                        <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                        <p class="text-muted text-uppercase">per night</p>
                    @endif
                </div>
                <a href="#"
                    class="select-booking-date mb-2 text-left py-1 w-100 text-primary text-decoration-none shadow-none px-2"
                    style="font-size: 14px; background:#f1f2f3;">Select Booking Date</a>
            </div>
        </div>
    </div>
@endforeach

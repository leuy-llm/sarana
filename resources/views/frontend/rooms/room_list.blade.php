                {{-- <style>
                         .room-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-5px);
        }

        .room-image {
            height: 100%;
            min-height: 300px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .badge-offer {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .room-features {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 15px 0;
            color: #666;
        }

        .room-feature {
            display: flex;
            align-items: center;
            gap: 5px;
            background: #f8f9fa;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .price-tag {
            color: #e67e22;
            font-size: 28px;
            font-weight: bold;
        }

        .btn-book {
            background-color: #e67e22;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-book:hover {
            background-color: #d35400;
            transform: translateY(-2px);
        }

        .guest-inputs {
            background: rgba(230,126,34,0.1);
            border-radius: 10px;
            padding: 15px;
        }

        .star-rating {
            color: #ffc107;
            margin: 10px 0;
        }

        .description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }
                </style> --}}
                <style>
                    .original-price {
                        color: #95a5a6;
                        text-decoration: line-through;
                        font-size: 16px;
                        margin-bottom: 4px;
                        font-family: 'Oswald', sans-serif;
                    }
                </style>

                @if ($rooms->isEmpty())
                    <div class="alert alert-warning no-rooms text-center animate-text">
                        <h3 class="gradient-text">
                            No rooms available for the selected criteria.<br>
                            Please adjust your search and try again.
                        </h3>
                    </div>
                @else
                    @foreach ($rooms as $room)
                        <div class="col-md-6">
                            <div class="card room-card">
                                <div class="room-image position-relative"
                                    style="background-image: url('{{ asset('storage/' . $room->images->first()->image) }}')">

                                    <div class="position-absolute top-0 left-0 end-0 text-white p-2 m-2 rounded">
                                        @if ($room->special_price)
                                            <span class="badge bg-danger text-white rounded-sm text-uppercase"
                                                style="padding: 10px;">SPECIAL
                                                OFFER
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $room->roomType->type_name }}</h5>
                                        <span class="badge-custom">Available</span>
                                    </div>
                                    <div class="room-features">
                                        <span class="room-feature"><i class="fas fa-ruler-combined"></i>
                                            {{ $room->room_size }}m²</span>
                                        <span class="room-feature"><i class="fas fa-bed"></i>
                                            {{ $room->bed_type }}</span>
                                        <span class="room-feature"><i class="fas fa-mountain-sun"></i>
                                            {{ ucfirst($room->view_type) }}</span>
                                        <span class="room-feature"><i class="fas fa-user-friends"></i>
                                            {{ $room->max_person }} Guests</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="card-text text-muted" style="font-family: 'Oswald', sans-serif;">
                                        {{ Str::limit($room->description, 100) }}</p>
                                    <div class="guest-inputs">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label">Adults</label>
                                                <select class="form-select  adults-select"
                                                    id="adults_room_{{ $room->id }}"
                                                    name="adults[{{ $room->id }}]">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ request('adults') == $i ? 'selected' : '' }}>
                                                            {{ $i }} Adult{{ $i > 1 ? 's' : '' }}
                                                        </option>
                                                    @endfor
                                                </select>

                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Children</label>
                                                <select class="form-select children-select"
                                                    id="children_room_{{ $room->id }}"
                                                    name="children[{{ $room->id }}]">
                                                    @for ($i = 0; $i <= 10; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ request('children') == $i ? 'selected' : '' }}>
                                                            {{ $i }} Child{{ $i > 1 ? 'ren' : '' }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="price-tag">
                                            @if ($room->special_price)
                                                <span class="original-price">$299<small>/night</small></span>
                                                ${{ number_format($room->special_price, 0) }}<small>/night</small>
                                            @else
                                                ${{ number_format($room->price, 0) }}<small>/night</small>
                                            @endif
                                        </div>

                                        <button class="btn btn-book " data-room-id="{{ $room->id }}"
                                            data-price={{ $room->price }}
                                            data-room-name="{{ $room->roomType->type_name }}"
                                            data-max-person="{{ $room->max_person }}">
                                            Select Room
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="container">
                        @foreach ($rooms as $room)
                        <div class="card room-card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="room-image" style="background-image: url('{{ asset('storage/' . $room->images->first()->image) }}')">
                                        @if ($room->special_price)
                                        <span class="badge-offer">Special Offer</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h4 class="card-title mb-0">{{ $room->roomType->type_name }}</h4>
                                            <div class="star-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="bi {{ $i <= $room->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                
                                        <div class="room-features">
                                            <span class="room-feature">
                                                <i class="fas fa-ruler-combined"></i>
                                                {{ $room->room_size }}m²
                                            </span>
                                            <span class="room-feature">
                                                <i class="fas fa-bed"></i>
                                                {{ $room->bed_type }}
                                            </span>
                                            <span class="room-feature">
                                                <i class="fas fa-mountain-sun"></i>
                                                {{ ucfirst($room->view_type) }}
                                            </span>
                                            <span class="room-feature">
                                                <i class="fas fa-user-friends"></i>
                                                {{ $room->max_person }} Guests
                                            </span>
                                        </div>
                
                                        <p class="description">{{ Str::limit($room->description, 150) }}</p>
                
                                        <div class="guest-inputs mb-3">
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label class="form-label">Adults</label>
                                                    <select class="form-select adults-select" id="adults_room_{{ $room->id }}" name="adults[{{ $room->id }}]">
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ request('adults') == $i ? 'selected' : '' }}>
                                                                {{ $i }} Adult{{ $i > 1 ? 's' : '' }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Children</label>
                                                    <select class="form-select children-select" id="children_room_{{ $room->id }}" name="children[{{ $room->id }}]">
                                                        @for ($i = 0; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ request('children') == $i ? 'selected' : '' }}>
                                                                {{ $i }} Child{{ $i > 1 ? 'ren' : '' }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="price-tag">
                                                @if ($room->special_price)
                                                    ${{ number_format($room->special_price, 0) }}<small>/night</small>
                                                @else
                                                    ${{ number_format($room->price, 0) }}<small>/night</small>
                                                @endif
                                            </div>
                                            <button class="btn btn-book" 
                                                data-room-id="{{ $room->id }}"
                                                data-price="{{ $room->price }}"
                                                data-room-name="{{ $room->roomType->type_name }}"
                                                data-max-person="{{ $room->max_person }}">
                                                Select Room
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div> --}}
                @endif

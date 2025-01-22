<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-custom">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoomModalLabel">Add Another Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($rooms as $room)
                        <div class="col-md-4">
                            <div class="card shadow border-0">
                                @if ($room->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $room->images->first()->image) }}" 
                                         alt="{{ $room->roomType->type_name }}" 
                                         class="card-img-top" 
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-room.jpg') }}" 
                                         alt="Default Room Image" 
                                         class="card-img-top" 
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">{{ $room->roomType->type_name }}</h6>
                                    <p class="text-muted small"><i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap</p>
                                    <p class="text-primary">${{ number_format($room->special_price ?? $room->price, 0) }} / night</p>
                                    <button type="button" class="btn btn-sm btn-success select-room" 
                                            data-room-id="{{ $room->id }}">
                                        Select Room
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

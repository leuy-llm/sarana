<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 section-title text-center mb-5">
            <h6>What I can do for you</h6>
            <h3> Our Favorite Rooms</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($rooms as $data)
            <div class="col-md-6 col-sm-12 col-xl-4  mb-md-4 mb-sm-2 ">
                <div class="room-items">
                    @if ($data->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $data->images->first()->image) }}" alt=""
                            class="img-fluid " style="height: 310px;">
                    @else
                        <img src="{{ asset('default-image.jpg') }}" alt="" class="me-2 img-fluid">
                    @endif
                    <div class="room-item-wrap">
                        <div class="room-content">
                            <h5 class="text-white mb-lg-3 text-decoration-underline">{{ $data->roomType->type_name }}
                            </h5>
                            <p class="text-white"> {{ Str::limit($data->description, 200) }}</p>
                            <p class="text-white font-bold mt-lg-4">{{ $data->price }} / Per Night</p>
                            <a href="{{ route('roomDetail', ['id' => $data->id, 'type_name' => Str::slug($data->roomType->type_name)]) }}" class="main-btn border-white text-white">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

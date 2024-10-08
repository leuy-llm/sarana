<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="">
      @foreach ($settings as $setting)
        <img src="{{ asset('storage/' . $setting->site_logo) }}" style="height: 50px" class="img-fluid"  alt="" />
      @endforeach
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-stream navbar-toggler-icon"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav menu-navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" style="font-size: 15px; font-weight: 500;text-transform: uppercase;"
                href="{{route('homepage')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton"
             style="font-size: 15px; font-weight: 500; text-transform: uppercase;"
             data-mdb-toggle="dropdown" aria-expanded="false">
             OUR ROOMS
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($roomTypes as $roomType)
                @php
                    // Get the first room that matches this room type
                    $room = $roomType->rooms->first();
                @endphp
        
                @if ($room)
                <li>
                    <a class="dropdown-item"
                        style="font-size: 15px; padding-top: 10px; border-bottom: 1px solid #dee2e6; font-weight: 500; text-transform: uppercase;"
                        href="{{ route('roomDetail', ['id' => $room->id, 'type_name' => Str::slug($room->roomType->type_name)]) }}">
                        {{ $room->roomType->type_name }}
                    </a>
              </li>
                @endif
            @endforeach
        </ul>  
        </li>
        
        <li class="nav-item">
          <a class="nav-link" style="font-size: 15px; font-weight: 500; text-transform: uppercase;"
            href="service.html">Services</a>
        </li>
        <li class=" nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-mdb-button-init data-mdb-ripple-init
            data-mdb-dropdown-init class=" dropdown-toggle" type="button" id="dropdownMenuButton"
            style="font-size: 15px; font-weight: 500; text-transform: uppercase;" data-mdb-toggle="dropdown"
            aria-expanded="false">
            facilities
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item"
                style="font-size: 15px; padding-top: 5px; font-weight: 500; text-transform: uppercase;"
                href="#">Food & Drink</a></li>
            <li><a class="dropdown-item"
                style="font-size: 15px; padding-top: 10px; font-weight: 500; text-transform: uppercase;"
                href="#">Meetings</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="font-size: 15px; font-weight: 500; text-transform: uppercase;"
            href="gallery.html">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="font-size: 15px; font-weight: 500; text-transform: uppercase;"
            href="{{ route('contact')}}">Contact</a>
        </li>
        <li class="nav-item mt-3 mt-lg-0">
          <a class="main-btn" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
            style="font-size: 15px; font-weight: 500; text-transform: uppercase;">Book now</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

@include('frontend.includes.reservation')
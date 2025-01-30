@extends('layout.master')
@section('style')
    <style>
        h4 {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .form-group label {
            font-family: 'Source Sans Pro', sans-serif;
        }

        input[type="text"] {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .btn-primary1 {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: bold;
            font-size: 20px;

        }
    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0 ">
        <div class="overlay">
            @if ($banner)
                <img src="{{ asset('storage/' . $banner->banner_image) }}"
                    style="width: 100%; height: 90vh; object-fit: cover;" alt="Banner Image">
            @else
                <p>No banner found for this page.</p>
            @endif

            <div class="img-overlay">
                <h2>{{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="contacts" class="contacts_wrapper mb-5" style="margin-bottom: 160px;">
        <div class="container">
            <div class="text-center" data-aos="fade-down" data-aos-duration="1000">
                <h3 class="fw-bold" style="font-family: 'Sail', system-ui;font-size: 50px;">Contact Us</h3>
                {{-- <p class=""
                    style="font-family: 'Sail', system-ui; letter-spacing: 1px; line-height:1.5; font-size: 25px; font-weight: 100;  margin-top: 10px;">
                    Savor the art of fine dining at our hotel. From locally inspired dishes to international cuisines,
                    our chefs use the freshest ingredients to craft meals that will tantalize your taste buds.
                    Whether you're in the mood for a hearty breakfast, a quick bite, or a gourmet dinner,
                    we have something special for every palate.
                </p> --}}
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{ route('queries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required
                                class="form-control shadow-none rounded p-3 @error('name') is-invalid @enderror"
                                name="name" placeholder="YourName">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                class="form-control rounded p-3 shadow-none @error('email') is-invalid @enderror" required
                                name="email" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control p-3 rounded shadow-none" name="message" rows="5" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn-primary1">Send</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h4 style="font-family: 'Source Sans Pro', sans-serif;font-size: 23px;font-weight: 600;">Contact
                            Information</h4>
                        @foreach ($contact as $data)
                            <p style="text-decoration: none; font-family: 'Source Sans Pro', sans-serif;font-weight: 100;">
                                <i class="fa fa-map-marker"></i>{{ $data->address }}
                            </p>
                            <p style="text-decoration: none; font-family: 'Source Sans Pro', sans-serif;font-weight: 100;">
                                <i class="fa fa-envelope"></i>{{ $data->email }}
                            </p>
                            <p>
                                <i class="fa fa-phone"></i>
                                <a href="tel:{{ $data->pn1 }}"
                                    style="text-decoration: none; font-family: 'Source Sans Pro', sans-serif;font-weight: 100;">{{ $data->pn1 }}</a>
                            </p>
                            <p>
                                <i class="fa fa-phone"></i>
                                <a href="tel:{{ $data->pn2 }}"
                                    style="text-decoration: none; font-family: 'Source Sans Pro', sans-serif;font-weight: 100;">{{ $data->pn2 }}</a>
                            </p>
                            <p>
                                <i class="fa fa-phone"></i>
                                <a href="tel:{{ $data->pn3 }}"
                                    style="text-decoration: none; font-family: 'Source Sans Pro', sans-serif;font-weight: 100;">{{ $data->pn3 }}</a>
                            </p>
                            <h4 style="font-family: 'Source Sans Pro', sans-serif;font-size: 23px;font-weight: 600;">Our
                                Social Media</h4>
                            <div class="social-icons">
                                <a href="{{ $data->fb }}"><i class="fab fa-facebook"></i></a>
                                <a href="{{ $data->insta }}"><i class="fab fa-instagram"></i></a>
                                <a href="{{ $data->tele }}"><i class="fab fa-telegram"></i></a>
                                <a href="{{ $data->tripa }}"><i class="fas fa-envelope"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map w-full mb-3 mx-auto">
            <iframe src="{{ $data->iframe }}" height="500px" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    @endforeach
@endsection

@section('script')
    <script></script>
@endsection

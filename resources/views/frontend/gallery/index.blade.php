@extends('layout.master')
@section('style')
    <style>
        /* .gallery_wrapper {
        padding: 60px 0;
    }*/

        /* .gallery_wrapper .section-title {
        margin-bottom: 40px;
    }  */
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9b2c2c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .gallery-img {
            height: 300px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.05);
            /* Slight zoom on hover */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .img-hover {
            overflow: hidden;
            /* Ensures no part of the image exceeds its container */
            border-radius: 8px;
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
                <img src="{{ asset('hotel') }}/image/services/service3.png"
                    style="width: 100%; height: 90vh; object-fit: cover;" alt="">
            @endif
            <div class="img-overlay">
                <h2>{{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="gallery" class="gallery_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h6>Explore Our Collection</h6>
                    <h3 style="margin-top: -10px">More Galleries</h3>
                </div>
            </div>
            <div class="row" k-grid uk-lightbox="animation: scale">
                @foreach ($galleries as $gallery)
                    <div class="col-md-4 mb-4">
                        <div class="img-hover">
                            <a class="uk-inline" href="{{ asset('storage/' . $gallery->image) }}"
                                data-caption="{{ $gallery->title }}" data-group="gallery">
                                <img src="{{ asset('storage/' . $gallery->image) }}"
                                    class="rounded img-shadow img-fluid gallery-img" alt="{{ $gallery->title }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('auth.register')
@endsection

@section('script')
    <script>
        UIkit.lightbox(element).show(index);
    </script>
@endsection

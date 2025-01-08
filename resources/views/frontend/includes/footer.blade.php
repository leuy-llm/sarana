<style>
    ::selection {
        background-color: #6351ce;
        color: white;
    }

    p {
        font-family: "Poppins", sans-serif;
    }

    h6,
    span {
        font-family: "Poppins", sans-serif;
    }
</style>
<div class="w-full ">
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
        <section class="d-flex justify-content-between p-4" style="background-color: #750d0d">
            <div class="me-5">
                <span>Get connected with us on social media :</span>
            </div>
            <div>
                <a href="" class="text-white me-4" style="margin-right: 10px;">
                    <i class="fab fa-facebook" style="font-size: 1.5rem;"></i>
                </a>
                <a href="" class="text-white me-4" style="margin-right: 10px;">
                    <i class="fab fa-telegram" style="font-size: 1.5rem;"></i>
                </a>
                <a href="" class="text-white me-4" style="margin-right: 10px;">
                    <i class="fab fa-instagram" style="font-size: 1.5rem;"></i>
                </a>
                <a href="" class="text-white me-4" style="margin-right: 10px;">
                    <i class="fas fa-envelope" style="font-size: 1.5rem;"></i>
                </a>
            </div>
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                        @foreach ($settings as $data)
                            <img id="site-logo-{{ $data->id }}" src="{{ asset('storage/' . $data->site_logo) }}"
                                alt="table-user" class="rounded me-3 "
                                style="border: 0px solid rgba(70, 48, 48, 0.112); padding: 2px" height="120">
                        @endforeach
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold text-white">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="{{ route('homepage') }}" class="text-white">Home</a>
                        </p>
                        <p>
                            <a href="#" id="service" class="text-white">Service</a>
                        </p>
                        <p>
                            <a href="#" id="facilities" class="text-white">Facilities</a>
                        </p>
                        <p>
                            <a href="#" id="gallery" class="text-white">Gallery</a>
                        </p>
                        <p>
                            <a href="{{ route('contact') }}" id="Contact" class="text-white">Contact</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold text-white">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        @foreach ($contact as $data)
                            <p class="text-white"><i class="fas fa-home mr-3 text-white"></i> {{ $data->address }}</p>
                            <p class="text-white">{{ $data->email }}
                            </p>
                            <p class="text-white"><i class="fas fa-phone mr-3 text-white"></i> {{ $data->pn1 }}</p>
                            <p class="text-white"><i class="fas fa-phone mr-3 text-white"></i> {{ $data->pn2 }}</p>
                            <p class="text-white"><i class="fas fa-phone mr-3 text-white"></i> {{ $data->pn3 }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </footer>
</div>

<div class=" w-full mt-5">
    <footer class="text-center text-lg-start text-white" style="background-color: #661f1f">
        {{-- <section class="d-flex justify-content-between p-4" style="background-color: #661f1f;">
      <!-- Left -->
      <div class="me-5">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section> --}}
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold text-white">SiNAKA ANGKOR HOTEL</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 90px; background-color: #7c4dff; height: 2px" />
                        <p class="text-white">
                            @foreach ($settings as $data)
                                <img id="site-logo-{{ $data->id }}" src="{{ asset('storage/' . $data->site_logo) }}"
                                    alt="table-user" class="rounded me-3 "
                                    style="border: 0px solid rgba(70, 48, 48, 0.112); padding: 2px" height="120">
                            @endforeach
                        </p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold text-white">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 90px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-white " style="text-decoration: none">Home</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white" style="text-decoration: none">Service</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white" style="text-decoration: none">Gallery</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white" style="text-decoration: none">Contact</a>
                        </p>
                        <p>
                            <a href="#!" class="text-white">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    {{-- <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                        <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                        <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                    </div> --}}
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->
    </footer>
    <!-- Footer -->
</div>

@extends('layout.master')
@section('content')
    <section id="home" class="banner_wrapper p-0">
        <div class="overlay">
            <img src="{{ asset('hotel') }}/image/room5.png" style="width: 100%; height: 90vh; object-fit: cover;"
                alt="Banner Image">
            <div class="img-overlay">
                <h2>{{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="contacts" class="contacts_wrapper">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h3>Contact Us</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{ route('queries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="YourName">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn-primary1">Send</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h4>Contact Information</h4>
                        @foreach ($contact as $data)
                            <p><i class="fa fa-map-marker"></i>{{ $data->address }}</p>
                            <p><i class="fa fa-envelope"></i>{{ $data->email }}</p>
                            <p>
                                <i class="fa fa-phone"></i>
                                <a href="tel:{{ $data->pn1 }}" style="text-decoration: none">{{ $data->pn1 }}</a>
                            </p>
                            <p>
                                <i class="fa fa-phone"></i>
                                <a href="tel:{{ $data->pn2 }}" style="text-decoration: none">{{ $data->pn2 }}</a>
                            </p>
                            <p>
                                <i class="fa fa-phone"></i>
                                <a href="tel:{{ $data->pn3 }}" style="text-decoration: none">{{ $data->pn3 }}</a>
                            </p>
                            <h4>Our Social Media</h4>
                            <div class="social-icons">
                                <a href="{{ $data->fb }}"><i class="fab fa-facebook"></i></a>
                                <a href="{{ $data->insta }}"><i class="fab fa-instagram"></i></a>
                                <a href="{{ $data->tele }}"><i class="fab fa-telegram"></i></a>
                                <a href="{{ $data->tripa }}"><i class="fas fa-envelope"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="map mt-5">
                <iframe src="{{ $data->iframe }}" height="470" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
         // Functions for notifications
         function showSuccessNotification(message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "4000",
                "hideDuration": "2000",
                "timeOut": "5000",
                "extendedTimeOut": "4000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "toastClass": "custom-toast1 custom-toast-success"
            };

            toastr.success(message);
        }

        function showErrorNotification(message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "3000",
                "hideDuration": "3000",
                "timeOut": "7000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "toastClass": "custom-toast1 custom-toast-error"
            };

            toastr.error(message);
        }

        ! function(i) {
            "use strict";
            i("#toastr-one").on("click", function(t) {
                i.NotificationApp.send("Heads up!",
                    "This alert needs your attention, but it is not super important.", "top-right",
                    "rgba(0,0,0,0.2)", "info");
            });

            // Custom function to show success notification
            function showSuccess(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "4000", // Increase duration for slow show
                    "hideDuration": "2000", // Increase duration for slow hide
                    "timeOut": "5000",
                    "extendedTimeOut": "4000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "toastClass": "custom-toast"
                }

                toastr.success(message);
            }

            function showError(message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000", // Slow fade in
                    "hideDuration": "3000", // Slow fade out
                    "timeOut": "7000", // Time before the notification disappears
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "toastClass": "custom-toast"
                }

                toastr.error(message);
            }

            // Check for session success message and display it
            @if (session('success'))
                showSuccess('{{ session('success') }}');
            @endif

            // Check for session error message and display it
            @if (session('error'))
                showError('{{ session('error') }}');
            @endif
        }
        (window.jQuery);
    </script>
@endsection
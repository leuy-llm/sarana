<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="{{ asset('hotel') }}/css/style.css" />
    <link rel="stylesheet" href="{{ asset('hotel') }}/css/responsive.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" />
   
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- end demo js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    

    
        @yield('style')
    {{--     
    <script src="https://js.stripe.com/v2/"></script> --}}
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="100">
    <div id="loading" style="display:none;">
        <div class="spinner-border" style="color: brown;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <header class="header_wrapper">
        @include('frontend.includes.navbar')
    </header>
    <div class="loader">
        @yield('content')
    </div>

    @include('frontend.includes.footer')

    <a href="#" id="scroll-up" class="scrollup">
        <i class="fa fa-arrow-up"></i>
    </a>
    {{-- @if (request()->routeIs('reservation') || request()->routeIs('contact'))
        @include('auth.register')
    @endif --}}
   
    <script>
        $(document).ready(function() {
            const hideLoadingSpinner = () => {
                $('#loading').fadeOut(500); // Ensure the loading spinner is hidden
            };

            // Show the loading spinner only for specific user actions
            $('a.nav-link, a.main-btn, ul.dropdown-menu a').on('click', function(e) {
                $('#loading').fadeIn(900); // Show the loading spinner
            });

            // Hide the loading spinner when the page finishes loading
            $(window).on('load', hideLoadingSpinner);

            // Handle browser back/forward navigation
            if (history && history.pushState) {
                window.addEventListener('pageshow', function(event) {
                    // Check if the page was loaded from cache
                    if (event.persisted) {
                        hideLoadingSpinner();
                    }
                });

                window.addEventListener('popstate', function() {
                    hideLoadingSpinner();
                });
            }

            // Handle loading spinner for modals
            $('#registerModal, #loginModal').on('show.bs.modal', function() {
                $('#loading').fadeIn();
                $('#modal-content').hide();
            }).on('shown.bs.modal', function() {
                $('#loading').fadeOut();
                $('#modal-content').fadeIn(700);
            });
        });

        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="{{ asset('hotel') }}/js/swipper.js"></script>
    <script src="{{ asset('hotel') }}/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.16/dist/js/uikit-icons.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        AOS.init({
        // duration: 2000, // Animation duration in milliseconds
        once: false,    // Allow animations to trigger both on scroll down and up
        mirror: true    // Trigger animations when elements scroll back into view
    });
      </script>
       @yield('script')

</body>

</html>

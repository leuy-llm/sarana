<style>
    @keyframes pulsate {
        0% {
            transform: scale(1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        50% {
            transform: scale(1.1);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
        }

        100% {
            transform: scale(1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    }

    .book-now-btn {
        background: #deb666;
        color: #fff;
        font-size: 14px;
        transition: all 0.3s ease;
        animation: pulsate 2s infinite;
    }

    .book-now-btn:hover {
        background: #c89c55;
        color: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        /* Enhance shadow on hover */
    }
</style>
@if ($rooms->isEmpty())
    <div class="alert alert-warning text-center" style="font-family: 'Jost', serif;font-size: 16px;">
        <h3> No rooms available for the selected criteria. Please adjust your search and try again.</h3>
    </div>
@else
    @foreach ($rooms as $room)
        <div class="card mb-4 shadow border-0" data-aos="zoom-in" data-aos-duration="1500">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $room->images->first()->image) }}"
                        alt="{{ $room->roomType->type_name }} image" class="img-fluid rounded-start"
                        style="height: 300px; width: 700px; object-fit: cover;" loading="lazy">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->roomType->type_name }}</h5>
                        <p class="text-muted small">
                            <i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap
                        </p>
                        <h6 class="mb-2 text-uppercase" style="margin-top: -5px;">Special Price</h6>
                        @if ($room->special_price)
                            <div class="text-success">
                                <strong>$ {{ number_format($room->special_price, 0) }}</strong>
                                <span class="original-price ms-2">
                                    $ {{ number_format($room->price, 0) }}
                                </span>
                            </div>
                        @endif

                        <div class="d-flex align-items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="bi {{ $i <= $room->rating ? 'bi-star-fill ml-1 text-warning' : 'bi-star ml-1 text-muted' }}"></i>
                            @endfor

                        </div>
                        {{--@if ($room->facilities->isNotEmpty())
                            @foreach ($room->facilities as $facility)
                                <span class="badge bg-light text-dark text-wrap">{{ $facility->name }}</span>
                            @endforeach
                        @endif --}}
                        <h6 class="mt-3 text-uppercase">Guests</h6>
                        <div>
                            <span class="badge bg-light text-dark">Max: {{ $room->max_person }}
                                Persons</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center text-center bg-light">
                    <div>
                        @if ($room->special_price)
                            <span class="badge bg-danger text-white p-2 mb-2 mt-3" style="border-radius: 0">SPECIAL
                                OFFER</span>
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->special_price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @else
                            <p class="mb-1 text-muted text-uppercase">From</p>
                            <h5 class="text-primary">${{ number_format($room->price, 0) }}</h5>
                            <p class="text-muted text-uppercase">per night</p>
                        @endif
                    </div>
                    <a href="{{ route('books.create', ['room_id' => $room->id, 'check_in' => $checkIn, 'check_out' => $checkOut, 'adults' => $adults, 'children' => $children]) }}"
                        class="btn book-now-btn mb-2 shadow-none rounded-0 py-2 font-weight-bold text-uppercase text-white px-4"
                        style="background: #deb666; font-size: 14px">
                        Book now
                     </a>
                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="pagination-links">
        {!! $rooms->links() !!}
    </div>
     --}}
@endif

<script>
//     document.addEventListener('DOMContentLoaded', function() {
//     console.log("Script loaded!");

//     var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
//     var hasVerifiedEmail = {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'true' : 'false' }};

//     console.log("isLoggedIn:", isLoggedIn);
//     console.log("hasVerifiedEmail:", hasVerifiedEmail);

//     var bookNowButtons = document.querySelectorAll('.book-now-btn');
//     console.log("Number of Book Now buttons:", bookNowButtons.length);

//     bookNowButtons.forEach(function(button) {
//         console.log("Attaching event listener to button:", button);
//         button.addEventListener('click', function(event) {
//             if (!isLoggedIn) {
//                 console.log("User is not logged in. Redirecting to register page.");
//                 event.preventDefault();
//                 window.location.href = "{{ route('register') }}";
//             } else if (!hasVerifiedEmail) {
//                 console.log("User has not verified email. Showing modal.");
//                 event.preventDefault();
//                 var modalTitle = document.querySelector('#loginRegisterModalLabel');
//                 var modalBody = document.querySelector('#loginRegisterModal .modal-body p');
//                 modalTitle.textContent = "Verify Your Email";
//                 modalBody.textContent = "Please verify your email address to proceed with the payment.";
//                 $('#loginRegisterModal').modal('show');
//             }
//         });
//     });
// });
</script>

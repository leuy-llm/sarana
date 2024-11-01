@extends('layout.master')
@section('style')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .reservation-title {
            font-family: 'Georgia', serif;
            color: #a38354;
            font-size: 2rem;
            /* margin-bottom: 0.2rem; */
        }

        .form-control:focus {
            border-color: #a38354;
            box-shadow: none;
        }

        .btn-booking {
            background-color: #7d2e1e;
            color: white;
            font-family: 'Hanuman', sans-serif;
        }

        .btn-booking:hover {
            background-color: #a83c2d;
            color: white
        }

        .hidden {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .visible {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
    </style>
@endsection
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
    <section id="gallery" class="gallery_wrapper" style="margin-top: 60px;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5">
                    <img src="https://images.pexels.com/photos/10973940/pexels-photo-10973940.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        class="img-fluid" style="height: 535px; object-fit: cover; border-radius: 3px;" alt="Room Image">
                </div>
                <div class="col-md-7">
                    <h3 class="reservation-title text-center">Make Your Reservation</h3>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="reservation-form" method="POST" action="{{ route('reservation.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->name : old('name') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }} required>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="number" min="0" name="mobile" class="form-control" placeholder="Phone"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->mobile : old('name') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }} required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->email : old('name') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }} required>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -14px">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->address : old('name') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }} required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="checkIn">Check In</label>
                                <input type="date" name="check_in_date" required class="form-control checkin_date"
                                    id="checkIn" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="checkOut">Check Out</label>
                                <input type="date" required name="check_out_date" class="form-control" id="checkOut"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: -14px">
                            <div class="form-group col-md-4">
                                <label for="room">Rooms</label>
                                <select name="room_type_id" required class="form-control room-type-list">
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="adults">Adults</label>
                                <select id="adults" name="total_adults" required class="form-control" required>
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="children">Children</label>
                                <select id="children" name="total_children" class="form-control" required>
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                        <div id="details-section" style="display: none;">
                            <div class="form-group" style="margin-top: -10px">
                                <label>No. of Days: <span id="num-days">0</span></label>
                            </div>
                            <div class="form-group" style="margin-top: -10px">
                                <input type="hidden" name="total_amount" id="hidden-total-amount" value="0">
                                <label>Total Amount to Pay: <span id="total-amount">0</span>$</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <button type="submit"  value="true" class="btn btn-booking btn-block">Skip Payment</button>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <a href="#" id="payment-button" class="btn btn-booking btn-block">Proceed to Payment</a>
                            </div>
                        </div>
                    </form>
                    {{-- @else
                    <div class="alert alert-warning">
                        Please <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">log in</a> to make a reservation.
                    </div> --}}

                </div>
            </div>
        </div>
    </section>
    @include('auth.register')
@endsection

{{-- @section('script')
    <script>
        $(document).ready(function() {
            $(".checkin_date").on('blur', function() {
                var _checkindate = $(this).val();
                console.log(_checkindate);

                // Encode the date to make it URL-safe
                var encodedDate = encodeURIComponent(_checkindate);

                // Ajax to get available room types based on check-in date
                $.ajax({
                    url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".room-type-list").html('<option>--- Loading ---</option>');
                    },
                    success: function(res) {
                        var _html = '';
                        $.each(res.data, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.type_name + " - " + row.price + "/night"+
                                '</option>';
                        });
                        $(".room-type-list").html(_html);
                    }
                });
            });
        });
    </script>
@endsection --}}

{{-- @section('script')
<script>
    $(document).ready(function () {
        let roomPrice = 0; // Variable to store the selected room's price

        $(".checkin_date, #checkOut").on('blur', function () {
            calculateTotalAmount();
        });

        $(".room-type-list").on('change', function () {
            roomPrice = $(this).find(':selected').data('price');
            calculateTotalAmount();
        });

        $(".checkin_date").on('blur', function () {
            var _checkindate = $(this).val();
            console.log(_checkindate);

            // Encode the date to make it URL-safe
            var encodedDate = encodeURIComponent(_checkindate);

            // Ajax to get available room types based on check-in date
            $.ajax({
                url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
                dataType: 'json',
                beforeSend: function () {
                    $(".room-type-list").html('<option>--- Loading ---</option>');
                },
                success: function (res) {
                    var _html = '';
                    $.each(res.data, function (index, row) {
                        _html += '<option value="' + row.id + '" data-price="' + row.price + '">' + row.type_name + " - " + "$" + row.price + "/night" + '</option>';
                    });
                    $(".room-type-list").html(_html);
                }
            });
        });

        function calculateTotalAmount() {
            const checkInDate = new Date($('#checkIn').val());
            const checkOutDate = new Date($('#checkOut').val());

            // Calculate the number of days between the check-in and check-out dates
            const timeDifference = checkOutDate - checkInDate;
            const numDays = timeDifference > 0 ? Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) : 0;

            // Calculate the total amount based on the room price and the number of days
            const totalAmount = numDays * roomPrice;

            // Update the display of number of days and total amount
            $('#num-days').text(numDays);
            $('#total-amount').text(totalAmount.toFixed(2));
        }
    });
</script>
@endsection --}}

{{-- @section('script')
<script>
    $(document).ready(function () {
        let roomPrice = 0; // Variable to store the selected room's price

        $(".checkin_date, #checkOut").on('blur', function () {
            calculateTotalAmount();
        });

        $(".room-type-list").on('change', function () {
            roomPrice = $(this).find(':selected').data('price');
            calculateTotalAmount();
        });

        $(".checkin_date").on('blur', function () {
            var _checkindate = $(this).val();

            // Encode the date to make it URL-safe
            var encodedDate = encodeURIComponent(_checkindate);

            // Ajax to get available room types based on check-in date
            $.ajax({
                url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
                dataType: 'json',
                beforeSend: function () {
                    $(".room-type-list").html('<option>--- Loading ---</option>');
                },
                success: function (res) {
                    var _html = '';
                    $.each(res.data, function (index, row) {
                        _html += '<option value="' + row.id + '" data-price="' + row.price + '">' + row.type_name + " - " + row.price + "/night" + '</option>';
                    });
                    $(".room-type-list").html(_html);

                    // Auto-select the first available room type and trigger calculation
                    if (res.data.length > 0) {
                        const firstRoomOption = $(".room-type-list option:first");
                        roomPrice = firstRoomOption.data('price'); // Get the price of the first room
                        firstRoomOption.prop('selected', true); // Automatically select the first room option
                        calculateTotalAmount(); // Trigger the calculation to update number of days and total amount
                    }
                }
            });
        });

        function calculateTotalAmount() {
            const checkInDate = new Date($('#checkIn').val());
            const checkOutDate = new Date($('#checkOut').val());

            // Calculate the number of days between the check-in and check-out dates
            const timeDifference = checkOutDate - checkInDate;
            const numDays = timeDifference > 0 ? Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) : 0;

            // Calculate the total amount based on the room price and the number of days
            const totalAmount = numDays * roomPrice;

            // Update the display of number of days and total amount
            $('#num-days').text(numDays);
            $('#total-amount').text(totalAmount.toFixed(2));
        }
    });
</script>
@endsection --}}

{{-- នេះជា Script យកពិតប្រាកដ --}}
{{-- @section('script')
<script>
    $(document).ready(function () {
        let roomPrice = 0; // Variable to store the selected room's price

        $(".checkin_date, #checkOut").on('blur', function () {
            calculateTotalAmount();
        });

        $(".room-type-list").on('change', function () {
            roomPrice = $(this).find(':selected').data('price');
            calculateTotalAmount();
        });

        $(".checkin_date").on('blur', function () {
            var _checkindate = $(this).val();

            // Encode the date to make it URL-safe
            var encodedDate = encodeURIComponent(_checkindate);

            // Ajax to get available room types based on check-in date
            $.ajax({
                url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
                dataType: 'json',
                beforeSend: function () {
                    $(".room-type-list").html('<option>--- Loading ---</option>');
                },
                success: function (res) {
                    var _html = '';
                    $.each(res.data, function (index, row) {
                        _html += '<option value="' + row.id + '" data-price="' + row.price + '">' + row.type_name + " - " + row.price + "/night" + '</option>';
                    });
                    $(".room-type-list").html(_html);

                    // Auto-select the first available room type and trigger calculation
                    if (res.data.length > 0) {
                        const firstRoomOption = $(".room-type-list option:first");
                        roomPrice = firstRoomOption.data('price'); // Get the price of the first room
                        firstRoomOption.prop('selected', true); // Automatically select the first room option
                        calculateTotalAmount(); // Trigger the calculation to update number of days and total amount
                    }
                }
            });
        });

        function calculateTotalAmount() {
            const checkInDate = new Date($('#checkIn').val());
            const checkOutDate = new Date($('#checkOut').val());

            // Calculate the number of days between the check-in and check-out dates
            const timeDifference = checkOutDate - checkInDate;
            const numDays = timeDifference > 0 ? Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) : 0;

            // Calculate the total amount based on the room price and the number of days
            const totalAmount = numDays * roomPrice;

            // Update the display of number of days and total amount
            $('#num-days').text(numDays);
            $('#total-amount').text(totalAmount.toFixed(2));

            // Show the details section if both check-in and check-out dates are selected and valid
            if (numDays > 0 && roomPrice > 0) {
                $('#details-section').show();
            } else {
                $('#details-section').hide();
            }
        }
    });
</script>

@endsection --}}
{{-- នេះជា Script យកពិតប្រាកដ --}}

@section('script')
    {{-- <script>
    $(document).ready(function () {
        let roomPrice = 0; // Variable to store the selected room's price

        $(".checkin_date, #checkOut").on('blur', function () {
            calculateTotalAmount();
        });

        $(".room-type-list").on('change', function () {
            roomPrice = $(this).find(':selected').data('price');
            calculateTotalAmount();
        });

        $(".checkin_date").on('blur', function () {
            var _checkindate = $(this).val();

            // Encode the date to make it URL-safe
            var encodedDate = encodeURIComponent(_checkindate);

            // Ajax to get available room types based on check-in date
            $.ajax({
                url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
                dataType: 'json',
                beforeSend: function () {
                    $(".room-type-list").html('<option>--- Loading ---</option>');
                },
                success: function (res) {
                    var _html = '';
                    $.each(res.data, function (index, row) {
                        _html += '<option value="' + row.id + '" data-price="' + row.price + '">' + row.type_name + " - " + row.price + "/night" + '</option>';
                    });
                    $(".room-type-list").html(_html);

                    // Auto-select the first available room type and trigger calculation
                    if (res.data.length > 0) {
                        const firstRoomOption = $(".room-type-list option:first");
                        roomPrice = firstRoomOption.data('price'); // Get the price of the first room
                        firstRoomOption.prop('selected', true); // Automatically select the first room option
                        calculateTotalAmount(); // Trigger the calculation to update number of days and total amount
                    }
                }
            });
        });

        function calculateTotalAmount() {
            const checkInDate = new Date($('#checkIn').val());
            const checkOutDate = new Date($('#checkOut').val());

            // Calculate the number of days between the check-in and check-out dates
            const timeDifference = checkOutDate - checkInDate;
            const numDays = timeDifference > 0 ? Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) : 0;

            // Calculate the total amount based on the room price and the number of days
            const totalAmount = numDays * roomPrice;

            // Update the display of number of days and total amount
            $('#num-days').text(numDays);
            $('#total-amount').text(totalAmount.toFixed(2));

            // Smooth transition: Show or hide the details section with sliding animation
            if (numDays > 0 && roomPrice > 0) {
                $('#details-section').slideDown(200); // Show with sliding effect
            } else {
                $('#details-section').slideUp(200); // Hide with sliding effect
            }
        }
    });
</script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkInDateInput = document.getElementById('checkIn');
            var checkOutDateInput = document.getElementById('checkOut');

            checkInDateInput.addEventListener('change', function() {
                var checkInDate = this.value; // Get the selected check-in date

                checkOutDateInput.setAttribute('min', checkInDate);

                // Clear check-out date if it is before the new check-in date
                if (checkOutDateInput.value < checkInDate) {
                    checkOutDateInput.value = ''; // Clear the value if invalid
                }
            });
        })
        $(document).ready(function() {
            let roomPrice = 0; // Variable to store the selected room's price

            // Event listeners for when check-in, check-out, and room type are changed
            $(".checkin_date, #checkOut").on('change blur', function() {
                calculateTotalAmount();
            });

            // $(".room-type-list").on('change', function() {
            //     roomPrice = $(this).find(':selected').data('price');
            //     calculateTotalAmount();
            // });
                $(".room-type-list").on('change', function() {
                    roomPrice = $(this).find(':selected').data('price');
                    calculateTotalAmount();
                });


            $(".checkin_date").on('blur', function() {
                var _checkindate = $(this).val();

                // Encode the date to make it URL-safe
                var encodedDate = encodeURIComponent(_checkindate);

                // Ajax to get available room types based on check-in date
                $.ajax({
                    url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".room-type-list").html('<option>--- Loading ---</option>');
                    },
                    success: function(res) {
                        var _html = '';
                        $.each(res.data, function(index, row) {
                            _html += '<option value="' + row.id + '" data-price="' + row
                                .price + '">' + row.type_name + " - $" + row.price +
                                "/night" + '</option>';
                        });
                        $(".room-type-list").html(_html);

                        // Auto-select the first available room type and trigger calculation
                        if (res.data.length > 0) {
                            const firstRoomOption = $(".room-type-list option:first");
                            roomPrice = firstRoomOption.data(
                                'price'); // Get the price of the first room
                            firstRoomOption.prop('selected',
                                true); // Automatically select the first room option
                            calculateTotalAmount
                                (); // Trigger the calculation to update number of days and total amount
                        }
                    }
                });
            });

            // Function to calculate the total amount based on dates and room price
            function calculateTotalAmount() {
                const checkInDate = new Date($('#checkIn').val());
                const checkOutDate = new Date($('#checkOut').val());

                // Calculate the number of days between the check-in and check-out dates
                const timeDifference = checkOutDate - checkInDate;
                const numDays = timeDifference > 0 ? Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) : 0;

                // Calculate the total amount based on the room price and the number of days
                const totalAmount = numDays * roomPrice;

                // Update the display of number of days and total amount
                $('#num-days').text(numDays);
                $('#total-amount').text(totalAmount.toFixed(2));
                $('#hidden-total-amount').val(totalAmount.toFixed(2)); // Update hidden input

                if (numDays > 0 && roomPrice > 0) {
                    $('#details-section').slideDown(400); // Show with sliding effect
                } else {
                    $('#details-section').slideUp(400); // Hide with sliding effect
                }
            }
        });

        //         document.getElementById('payment-button').addEventListener('click', function (event) {
        //     event.preventDefault(); // Prevents default navigation
        //     const totalAmount = document.getElementById('total-amount').textContent;
        //     if (totalAmount > 0) {
        //         const url = `{{ url('reservation/payment') }}/${totalAmount}`;
        //         window.location.href = url; // Redirect to payment page with totalAmount
        //     } else {
        //         alert('Please select a valid check-in and check-out date.');
        //     }
        // });

        document.addEventListener('DOMContentLoaded', function() {
            var reservationForm = document.getElementById('reservation-form');

            // Check if the user is logged in
            var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};

            // Intercept form submission for "Pay Later"
            reservationForm.addEventListener('submit', function(event) {
                if (!isLoggedIn) {
                    event.preventDefault(); // Prevent form submission
                    $('#registerModal').modal('show'); // Show the login modal
                }
            });

            document.getElementById('pay-later-button').addEventListener('click', function(event) {
                event.preventDefault();

                if (!isLoggedIn) {
                    $('#registerModal').modal('show');
                }
            })

            // Handle 'Proceed to Payment' click event
            document.getElementById('payment-button').addEventListener('click', function(event) {
                event.preventDefault(); // Prevents default navigation

                if (!isLoggedIn) {
                    // If user is not logged in, show the login modal
                    $('#registerModal').modal('show');
                } else {
                    // User is logged in, proceed with payment
                    const totalAmount = document.getElementById('total-amount').textContent;
                    if (totalAmount > 0) {
                        // Redirect to the payment page with the total amount
                        const url = `{{ url('reservation/payment') }}/${totalAmount}`;
                        window.location.href = url; // Proceed to payment page
                    } else {
                        // Show an alert if no valid dates or amount is selected
                        alert('Please select a valid check-in and check-out date.');
                    }
                }
            });
        });
    </script>
@endsection

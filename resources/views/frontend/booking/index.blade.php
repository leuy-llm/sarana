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

         .modal-content {
            -webkit-border-radius: 0;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 0;
            -moz-background-clip: padding;
            border-radius: 6px;
            background-clip: padding-box;
            -webkit-box-shadow: 0 0 40px rgba(0, 0, 0, .5);
            -moz-box-shadow: 0 0 40px rgba(0, 0, 0, .5);
            box-shadow: 0 0 40px rgba(0, 0, 0, .5);
            color: #000;
            /* background-color: #fff; */
            border: rgba(0, 0, 0, 0);
        }

        .modal-message .modal-dialog {
            width: 400px;
        }

        .modal-message .modal-body,
        .modal-message .modal-footer,
        .modal-message .modal-header,
        .modal-message .modal-title {
            background: 0 0;
            border: none;
            margin: 0;
            padding: 0 20px;
            text-align: center !important;
            font-family: 'Coda', system-ui;
        }

        .modal-message .modal-title {
            font-size: 17px;
            color: #737373;
            margin-bottom: 3px;
        }

        .modal-message .modal-body {
            color: #737373;
        }

        .modal-message .modal-header {
            color: #fff;
            margin-bottom: 10px;
            padding: 15px 0 8px;
        }

        .modal-message .modal-header .fa, 
         .modal-message .modal-header .glyphicon,
        .modal-message .modal-header .typcn,
        .modal-message .modal-header .wi {
            font-size: 30px;
        }

        .modal-message .modal-footer {
            margin: 25px 0 20px;
            padding-bottom: 10px;
        }

        .modal-backdrop.in {
            zoom: 1;
            filter: alpha(opacity=75);
            -webkit-opacity: .75;
            -moz-opacity: .75;
            opacity: .75;
        }

        .modal-backdrop {
            background-color: #fff;
        }

        .modal-message.modal-success .modal-header {
            color: #53a93f;
            border-bottom: 3px solid #a0d468;
        }

        .modal-message.modal-info .modal-header {
            color: #57b5e3;
            border-bottom: 3px solid #57b5e3;
        }

        .modal-message.modal-danger .modal-header {
            color: #d73d32;
            border-bottom: 3px solid #e46f61;
        }

        .modal-message.modal-warning .modal-header {
            color: #f4b400;
            border-bottom: 3px solid #ffce5 5;
        } 
    </style>
@endsection
@section('content')
    <section id="home" class="banner_wrapper p-0">
        <div class="overlay">
            @if (isset($banner) && $banner)
                <img src="{{ asset('storage/' . $banner->banner_image) }}" style="width: 100%; height: 90vh; object-fit: cover;" alt="Banner Image">
            @endif
            <div class="img-overlay">
                <h2>{{ $data }}</h2>
            </div>
        </div>
    </section>
    <section id="gallery" class="gallery_wrapper" style="margin-top: 60px;">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <img src="https://images.pexels.com/photos/10973940/pexels-photo-10973940.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        class="img-fluid" style="height: 535px; object-fit: cover; border-radius: 3px;" alt="Room Image">
                </div>
                <div class="col-md-6">
                    <h3 class="reservation-title text-center">Make Your Reservation</h3>
                    {{-- @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    {{-- <form id="reservation-form" method="POST" action="{{ route('reservation.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->name : old('name') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="number" min="0" name="mobile" class="form-control" placeholder="Phone"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->mobile : old('name') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->email : old('name') }}"
                                    {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -14px">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->address : old('name') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="checkIn">Check In</label>
                                <input type="date" name="check_in_date" class="form-control checkin_date" id="checkIn">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="checkOut">Check Out</label>
                                <input type="date"name="check_out_date" class="form-control" id="checkOut"
                                    min="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: -14px">
                            <div class="form-group col-md-4">
                                <label for="room">Rooms</label>
                                <input type="text" name="room_type_id" class="form-control room-type-list">
                                </input>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="adults">Adults</label>
                                <select id="adults" name="total_adults" class="form-control">
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="3">4</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="children">Children</label>
                                <select id="children" name="total_children" class="form-control">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="2">3</option>
                                    <option value="2">4</option>
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

                        <div class="col-md-12">
                            <input type="hidden" id="bookingId" value="{{ $bookingId }}">
                            
                            <button type="submit" class="btn btn-booking btn-block">Booking</button>
                        </div>
                    </div>
                </form> --}}
                <form id="reservation-form" action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Full Name"
                            value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->name : old('name') }}"
                            {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="number" min="0" name="mobile" class="form-control" placeholder="Phone"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->mobile : old('name') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->email : old('name') }}"
                                {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: -14px">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Address"
                            value="{{ auth()->guard('guest')->check() ? auth()->guard('guest')->user()->address : old('name') }}"
                            {{ auth()->guard('guest')->check() ? 'readonly' : '' }}>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkIn">Check In</label>
                            <input type="date" name="check_in_date" value="{{ $checkIn }}"
                                class="form-control checkin_date" id="checkIn">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="checkOut">Check Out</label>
                            <input type="date"name="check_out_date" value="{{ $checkOut }}" class="form-control"
                                id="checkOut" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="form-row" style="margin-top: -14px">

                        <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}">

                        <div class="form-group col-md-6">
                            <label for="adults">Adults</label>

                            <input type="number" min="0" name="total_adults" class="form-control" id="adults"
                                value="{{ $adults ?? old('total_adults') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="children">Children</label>

                            <input type="number" min="0" name="total_children" class="form-control"
                                id="children" value="{{ $children ?? old('total_children') }}">
                        </div>
                    </div>
                                        <!-- Payment Option -->
                    <h3>Payment</h3>
                    <div>
                        <label>
                            <input type="radio" name="payment_option" value="pay_now" required> Pay Now
                        </label>
                        <label>
                            <input type="radio" name="payment_option" value="skip_payment" required> Skip Payment
                        </label>
                    </div>



                    <button type="submit" class="btn btn-booking btn-block">Proceed</button>
                </form>  
            </div>
        </div>
        </div>
    </section>
    <div id="modal-success" class="modal modal-message modal-success fade" role="dialog" data-bs-backdrop="static"
        style="display: none;z-index: 9999" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    {{-- <span class="glyphicon glyphicon-check"></span> --}}
                    <i class="fa fa-check text-white fa-3x m-auto"></i>
                </div>
                <div class="modal-title text-center">Please</div>
                <div class="modal-body">Sign in to Booking</div>
                <div class="modal-footer">
                    <button type="button" id="ok-btn" class="btn btn-success"
                        style="text-align: center;margin: 0 auto;" data-dismiss="modal">OK</button>
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!--End Success Modal Templates-->
    @include('auth.register')
@endsection

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
        @if (session('success'))
        toastr.success('{{ session('success') }}');
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    @endif
        var checkInDateInput = document.getElementById('checkIn');
        var checkOutDateInput = document.getElementById('checkOut');
        document.addEventListener('DOMContentLoaded', function() {

            checkInDateInput.addEventListener('change', function() {
                var checkInDate = this.value; // Get the selected check-in date

                checkOutDateInput.setAttribute('min', checkInDate);

                // Clear check-out date if it is before the new check-in date
                if (checkOutDateInput.value < checkInDate) {
                    checkOutDateInput.value = ''; // Clear the value if invalid
                }
            });
        })

        // $(document).ready(function() {
        //     let roomPrice = 0; // Variable to store the selected room's price

        //     // Event listeners for when check-in, check-out, and room type are changed
        //     $(".checkin_date, #checkOut").on('change blur', function() {
        //         calculateTotalAmount();
        //     });

        //     // $(".room-type-list").on('change', function() {
        //     //     roomPrice = $(this).find(':selected').data('price');
        //     //     calculateTotalAmount();
        //     // });
        //     $(".room-type-list").on('change', function() {
        //         roomPrice = $(this).find(':selected').data('price');
        //         calculateTotalAmount();
        //     });


        //     $(".checkin_date").on('blur', function() {
        //         var _checkindate = $(this).val();

        //         // Encode the date to make it URL-safe
        //         var encodedDate = encodeURIComponent(_checkindate);

        //         // Ajax to get available room types based on check-in date
        //         $.ajax({
        //             url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
        //             dataType: 'json',
        //             beforeSend: function() {
        //                 $(".room-type-list").html('<option>--- Loading ---</option>');
        //             },
        //             success: function(res) {
        //                 var _html = '';
        //                 $.each(res.data, function(index, row) {
        //                     _html += '<option value="' + row.id + '" data-price="' + row
        //                         .price + '">' + row.type_name + " - $" + row.price +
        //                         "/night" + '</option>';
        //                 });
        //                 $(".room-type-list").html(_html);

        //                 // Auto-select the first available room type and trigger calculation
        //                 if (res.data.length > 0) {
        //                     const firstRoomOption = $(".room-type-list option:first");
        //                     roomPrice = firstRoomOption.data(
        //                         'price'); // Get the price of the first room
        //                     firstRoomOption.prop('selected',
        //                         true); // Automatically select the first room option
        //                     calculateTotalAmount
        //                         (); // Trigger the calculation to update number of days and total amount
        //                 }
        //             }
        //         });
        //     });

        //     function calculateTotalAmount() {
        //         const checkInDate = new Date($('#checkIn').val());
        //         const checkOutDate = new Date($('#checkOut').val());
        //         // Calculate the number of days between the check-in and check-out dates
        //         const timeDifference = checkOutDate - checkInDate;
        //         const numDays = timeDifference > 0 ? Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) : 0;

        //         const totalAmount = numDays * roomPrice;

        //         // Update the display of number of days and total amount
        //         $('#num-days').text(numDays);
        //         $('#total-amount').text(totalAmount.toFixed(2));
        //         $('#hidden-total-amount').val(totalAmount.toFixed(2)); // Update hidden input

        //         if (numDays > 0 && roomPrice > 0) {
        //             $('#details-section').slideDown(400); // Show with sliding effect
        //         } else {
        //             $('#details-section').slideUp(400); // Hide with sliding effect
        //         }
        //     }
        // });

        $(document).ready(function() {
    let roomPrice = 0; // Variable to store the selected room's price

    // Trigger AJAX when the check-in date changes
    $(".checkin_date").on('blur', function() {
        var _checkindate = $(this).val();

        // Encode the date to make it URL-safe
        var encodedDate = encodeURIComponent(_checkindate);

        // Ajax to get available room types based on check-in date
        $.ajax({
            url: "{{ url('bookings') }}/available-room-types/" + encodedDate,
            dataType: 'json',
            beforeSend: function() {
                $(".room-type-list").val('--- Loading ---'); // Display loading message in input
            },
            success: function(res) {
                if (res.data.length > 0) {
                    // Prepare a string of available room types and prices
                    let roomOptions = res.data.map(row => `${row.type_name} - $${row.price}/night`).join(', ');
                    
                    // Update the room type input with available options
                    $(".room-type-list").val(roomOptions);

                    // Auto-select the first room and update the price
                    roomPrice = res.data[0].price; // Price of the first room
                    calculateTotalAmount(); // Trigger the calculation
                } else {
                    // If no rooms are available
                    $(".room-type-list").val('No rooms available');
                    roomPrice = 0; // Reset price
                    calculateTotalAmount(); // Trigger calculation to reset total amount
                }
            },
            error: function() {
                $(".room-type-list").val('Failed to load rooms'); // Handle error case
            }
        });
    });

    // Recalculate total amount when check-in or check-out date changes
    $(".checkin_date, #checkOut").on('change blur', function() {
        calculateTotalAmount();
    });

    // Function to calculate total amount
    function calculateTotalAmount() {
        const checkInDate = new Date($(".checkin_date").val());
        const checkOutDate = new Date($("#checkOut").val());

        if (!isNaN(checkInDate) && !isNaN(checkOutDate) && checkOutDate > checkInDate) {
            const days = (checkOutDate - checkInDate) / (1000 * 60 * 60 * 24);
            const totalAmount = days * roomPrice;

            $("#num-days").text(days); // Update number of days
            $("#total-amount").text(totalAmount.toFixed(2)); // Update total amount to pay
            $("#hidden-total-amount").val(totalAmount.toFixed(2)); // Update hidden input for form submission
            $("#details-section").show(); // Show details section
        } else {
            $("#num-days").text(0);
            $("#total-amount").text(0);
            $("#hidden-total-amount").val(0);
            $("#details-section").hide(); // Hide details section if dates are invalid
        }
    }
});


        document.addEventListener('DOMContentLoaded', function() {
            var reservationForm = document.getElementById('reservation-form');
            var isLoggedIn = {{ auth()->guard('guest')->check() ? 'true' : 'false' }};
            // Ensure reservation form exists before proceeding
            if (reservationForm) {
                reservationForm.addEventListener('submit', function(event) {
                    // Prevent submission and show modal if guest is not logged in
                    if (!isLoggedIn) {
                        event.preventDefault();
                        $('#modal-success').modal('show');
                    } else {
                        // If logged in, check for empty check-in and check-out dates
                        if (!checkInDateInput.value || !checkOutDateInput.value) {
                            event.preventDefault(); // Prevent form submission
                            alert('Please select both check-in and check-out dates before booking.');
                        }
                    }
                });
            }
            // Add event listener to the OK button to show the login modal if button exists
            var okButton = document.getElementById('ok-btn');
            if (okButton) {
                okButton.addEventListener('click', function() {
                    $('#modal-success').modal('hide'); // Hide the success modal
                    $('#registerModal').modal('show'); // Show the login modal
                });
            }
        });
        

        // Handle 'Proceed to Payment' click event
        // document.getElementById('payment-button').addEventListener('click', function(event) {
        // event.preventDefault(); // Prevents default navigation

        // if (!isLoggedIn) {
        // // If user is not logged in, show the login modal
        // $('#registerModal').modal('show');
        // } else {
        // // User is logged in, proceed with payment
        // const totalAmount = document.getElementById('total-amount').textContent;
        // const bookingId = document.getElementById('bookingId').value;
        // if (totalAmount > 0) {
        // // Redirect to the payment page with the total amount
        // const url = `{{ url('reservation/payment') }}/${bookingId}/${totalAmount}`;
        // window.location.href = url; // Proceed to payment page
        // } else {
        // // Show an alert if no valid dates or amount is selected
        // alert('Please select a valid check-in and check-out date.');
        // }
        // }
        // });
    </script>
@endsection

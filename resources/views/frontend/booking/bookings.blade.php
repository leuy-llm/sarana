@extends('layout.master')
@section('style')
    <style>
        body {
            background-color: #eff3f8;
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        label {
            font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }



        input[type="date"] {
            cursor: pointer;
        }

        body {
            background-color: #f8f9fa;
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-step {
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .progress-step.active {
            font-weight: bold;
            color: #0d6efd;
        }

        .billing-section {
            background: white;
            box-shadow: 0px 0px 0px rgba(0, 0, 0, .5);
            /* border-radius: 8px; */
            padding: 20px;
            padding-bottom: 25px;

        }

        .billing-section h5 {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .booking-summary {
            background: white;
            /* padding: 20px; */
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        }

        .booking-summary h5 {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 18px;
        }

        .booking-summary img {
            width: 100%;
            height: auto;
        }

        .booking-summary p {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            margin-top: -10px;
        }

        .booking-summary h6 {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 18px;
        }

        .booking-summary .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #555;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .form-control {
            font-size: 14px;
            padding: 20px;

        }

        input.form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }

        .price-summary {
            font-weight: bold;
            margin-top: 20px;
        }

        input[type="email"] {
            font-family: 'Montserrat', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .stepper-wrapper {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-radius: 3px;
            padding: 20px;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ccc;
            margin-bottom: 6px;
        }

        .stepper-item.active {
            font-weight: bold;
        }

        .stepper-item.completed .step-counter {
            background-color: #ffc107;
        }

        .stepper-item.completed::after {
            border-bottom: 2px solid #ffc107;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }

        .close {
            outline: none !important;
            border: none;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .stepper-wrapper {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .stepper-item {
                flex-direction: row;
                align-items: center;
                gap: 10px;
                width: 100%;
            }

            .stepper-item::before,
            .stepper-item::after {
                content: none;
            }

            .stepper-item .step-counter {
                flex-shrink: 0;
            }

            .stepper-item .step-name,
            .stepper-item .step-description {
                text-align: left;
            }
        }



        /* Modal Styles */
        /* Full-Screen Modal Customization */
        /* Full-Screen Modal Customization */
        .modal-fullscreen-custom {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            z-index: 9999;
            display: none;
            /* Initially hidden */
            overflow: hidden;
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out forwards;
            justify-content: center;
            align-items: center;
        }

        /* Center and Style Modal Content */
        .modal-content {
            background-color: white;
            width: 90%;
            /* Adjust width */
            height: 90%;
            /* Fullscreen modal height */
            max-height: 90%;
            /* Ensures content is scrollable */
            margin: auto;
            border-radius: 8px;
            overflow-y: auto;
            /* Enable vertical scrolling */
            padding: 20px;
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Modal Header */
        .modal-header {
            padding: 1.5rem;
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header span {
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
        }

        .modal-title {
            margin: 0;
            font-size: 1.5rem;
        }

        .close {
            font-size: 1.5rem;
            cursor: pointer;
        }
        select.form-select{
            display: block;
            width: 100%;
            padding: 10px;
            margin: 4px;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            outline: none !important;
        }

        /* Modal Body */
        .modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }

        /* Room List Styling */
        .room-list-container {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 1rem;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 1rem;
            background: #f8f9fa;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #e9ecef;
        }
    </style>
@endsection
@section('content')
    <section id="gallery" class="booking_wrapper" style="margin-top: 60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid">
                    <div class="stepper-wrapper">
                        <div class="stepper-item completed">
                            <div class="step-counter">1</div>
                            <div class="step-name mt-2">Search</div>
                            <div class="step-description">Choose your favorite room</div>
                        </div>
                        <div class="stepper-item active">
                            <div class="step-counter">2</div>
                            <div class="step-name mt-2">Book</div>
                            <div class="step-description">Confirm your selection</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">3</div>
                            <div class="step-name mt-2">Checkout</div>
                            <div class="step-description">Use your preferred payment method</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">4</div>
                            <div class="step-name mt-2">Confirmation</div>
                            <div class="step-description">Booking completed</div>
                        </div>
                    </div>
                </div>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="billing-section">
                                <h5 class="mb-4">Billing Details</h5>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">First name</label>
                                        <input type="text" class="form-control shadow-none"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->first_name : old('first_name') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            style="border-radius: 0;" name="first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Last name</label>
                                        <input type="text" class="form-control shadow-none rounded-0"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->last_name : old('last_name') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            name="last_name" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Phone</label>
                                        <input type="text" class="form-control shadow-none rounded-0" name="mobile"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->mobile : old('mobile') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            placeholder="Phone number" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Email</label>
                                        <input type="email" class="form-control shadow-none" style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->email : old('email') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            name="email" placeholder="Email" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="adults">Address</label>
                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->address : old('address') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            name="address" placeholder="Address" required>
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control shadow-none" style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->city : old('city') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            placeholder="City" name="city" required>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Country</label>
                                        <input type="text" class="form-control shadow-none" name="country"
                                            style="border-radius: 0;"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->country : old('country') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            placeholder="Country">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="">Zip</label>
                                        <input type="text" class="form-control shadow-none" name="zip"
                                            value="{{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? auth()->guard('guest')->user()->zip : old('zip') }}"
                                            {{ auth()->guard('guest')->check() && auth()->guard('guest')->user()->hasVerifiedEmail() ? 'readonly' : '' }}
                                            style="border-radius: 0;" placeholder="Zip">
                                    </div>
                                </div>
                                <input type="hidden" name="room_type_id" value="{{ $rooms->roomType->id }}">
                            </div>
                        </div>
                        {{-- <div class="col-md-4 mt-3">
                            <div class="booking-summary ">
                                <div class="card-body">
                                    <h5>Booking Details</h5>
                                    <p><strong>Check-In: </strong> {{ date('d-m-Y', strtotime($checkIn)) }}</p>
                                    <p><strong>Check-Out: </strong> {{ date('d-m-Y', strtotime($checkOut)) }}</p>
                                    <p><strong>Nights:</strong> {{ $nights }}</p>
                                    <p><strong>Guests:</strong> {{ $adults }} Adults, {{ $children }}
                                        Children
                                    </p>
                                    <h6 class="mt-4 section-title">Price Summary</h6>
                                    <p><strong>{{ $rooms->roomType->type_name }}:</strong>
                                        @if ($room->special_price)
                                            ${{ number_format($room->special_price, 0) }}
                                        @else
                                            ${{ number_format($room->price, 0) }}
                                    </p>
                                    @endif
                                    <p class="price-summary"><strong>Total Price:</strong>
                                        ${{ number_format($totalPrice, 2) }}</p>
                                   
                                    
                                </div>
                            </div>
                            <div class="booking-summary p-3">
                                <div class="card-body">
                                    <div id="defaultBookingDetails">
                                    </div>
                                    <div id="dynamicSelectedRooms">
                                        <h5>Selected Additional Rooms:</h5>
                                        <div id="selectedRoomsList"></div>
                                        <p id="dynamicTotalPrice"><strong>Additional Total:</strong> $0.00</p>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary w-100 shadow-none"
                                    id="openFilterModalBtn">Add Another
                                    Room</button>
                                    <a href="{{ route('checkout.index', [
                                        'room_id' => $room->id,
                                        'check_in' => $checkIn->format('Y-m-d'),
                                        'check_out' => $checkOut->format('Y-m-d'),
                                        'adults' => $adults,
                                        'children' => $children,
                                        'first_name' => optional($guest)->first_name,
                                        'last_name' => optional($guest)->last_name,
                                        'email' => optional($guest)->email,
                                        'mobile' => optional($guest)->mobile,
                                    ]) }}"
                                        class="btn btn-warning w-100 rounded-0 text-white">
                                        Proceed to Checkout
                                    </a>
                            </div>


                            
                            {{-- <div id="defaultBookingDetails">
                                <h5>Booking Details</h5>
                                <p><strong>Check-In: </strong> {{ date('d-m-Y', strtotime($checkIn)) }}</p>
                                <p><strong>Check-Out: </strong> {{ date('d-m-Y', strtotime($checkOut)) }}</p>
                                <p><strong>Nights:</strong> {{ $nights }}</p>
                                <p><strong>Guests:</strong> {{ $adults }} Adults, {{ $children }} Children</p>
                                <h6 class="mt-4 section-title">Price Summary</h6>
                                <p><strong>{{ $rooms->roomType->type_name }}:</strong>
                                    @if ($room->special_price)
                                        ${{ number_format($room->special_price, 0) }}
                                    @else
                                        ${{ number_format($room->price, 0) }}
                                    @endif
                                </p>
                                <p class="price-summary"><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</p>
                            </div> 

                            
                        </div> --}}
                        <!-- Booking Summary Section -->
                        {{-- <div class="col-md-4 mt-3">
                            <div class="booking-summary">
                                <div class="card-body">
                                    <h5>Booking Details</h5>
                                    <div id="defaultBookingDetails">
                                        <!-- Filtered Booking Details Will Appear Here -->
                                    </div>

                                    <h6 class="mt-4 section-title">Price Summary</h6>
                                    <p><strong>Selected Rooms:</strong></p>
                                    <div id="selectedRoomsList"></div>
                                    <p id="dynamicTotalPrice"><strong>Additional Total:</strong> $0.00</p>
                                </div>
                                <button type="button" class="btn btn-primary w-100 shadow-none"
                                    id="openFilterModalBtn">Add Another
                                    Room</button>
                                <a href="{{ route('checkout.index', [
                                    'room_id' => $room->id,
                                    'check_in' => $checkIn->format('Y-m-d'),
                                    'check_out' => $checkOut->format('Y-m-d'),
                                    'adults' => $adults,
                                    'children' => $children,
                                    'first_name' => optional($guest)->first_name,
                                    'last_name' => optional($guest)->last_name,
                                    'email' => optional($guest)->email,
                                    'mobile' => optional($guest)->mobile,
                                ]) }}"
                                    class="btn btn-warning w-100 mt-3 rounded-0 text-white">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div> --}}
                        <div class="col-md-4 mt-3">
                            <div class="booking-summary">
                                <div class="card-body">
                                    <h5>Booking Details</h5>
                                    <p><strong>Check-In: </strong> {{ date('d-m-Y', strtotime($checkIn)) }}</p>
                                    <p><strong>Check-Out: </strong> {{ date('d-m-Y', strtotime($checkOut)) }}</p>
                                    <p><strong>Nights:</strong> {{ $nights }}</p>
                                    <p><strong>Guests:</strong> {{ $adults }} Adults, {{ $children }} Children
                                    </p>
                                    <h6 class="mt-4 section-title">Price Summary</h6>
                                    <p><strong>{{ $room->roomType->type_name }}:</strong>
                                        @if ($room->special_price)
                                            ${{ number_format($room->special_price, 0) }}
                                        @else
                                            ${{ number_format($room->price, 0) }}
                                        @endif
                                    </p>
                                    <p class="price-summary"><strong>Total Price:</strong>
                                        ${{ number_format($totalPrice, 2) }}</p>

                                    <!-- Hidden Form for Confirming Booking -->
                                    <form action="{{ route('bookings.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                                        <input type="hidden" name="check_in_date" value="{{ $checkIn }}">
                                        <input type="hidden" name="check_out_date" value="{{ $checkOut }}">
                                        <input type="hidden" name="adults" value="{{ $adults }}">
                                        <input type="hidden" name="children" value="{{ $children }}">
                                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">

                                        <!-- Proceed to Booking Button -->
                                        <button type="button" class="btn btn-primary" id="openFilterModalBtn">Add
                                            Another Room</button>
                                        <button type="submit" class="btn btn-primary">Confirm Booking</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Modal (Custom Modal) -->
    {{-- <div id="customModal" class="modal modal-fullscreen-custom ">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="modalClose">&times;</span>
            </div>
            <form id="addRoomForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="checkIn">Check-In</label>
                            <input type="date" class="form-control" id="checkIn" name="check_in" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="checkOut">Check-Out</label>
                            <input type="date" class="form-control" id="checkOut" name="check_out" required>
                        </div>
                        <div class="col-md-6">
                            <label for="adults">Adults</label>
                            <input type="text" class="form-control" id="adults" name="children" required
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-6">
                            <label for="children">Children</label>
                            <input type="text" class="form-control" id="children" name="children" required
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">


                        </div>
                    </div>

                    <!-- Dynamic Room List -->
                    <div class="row mt-4" id="roomList">
                        <!-- Room Data Will Be Populated Here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modalCloseBtn">Close</button>
                    <button type="submit" class="btn btn-primary shadow-none rounded-0">Filter Room</button>
                </div>
            </form>
        </div>
    </div> --}}

    <!-- Modal for Adding Rooms -->
    {{-- <div id="customModal" class="modal modal-fullscreen-custom">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="modalClose">&times;</span>
        </div>
        <form id="addRoomForm">
            <div class="modal-body">
                <!-- Dynamically added room selection fields -->
                <div class="room-entry" id="room1">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="room">Room 1</label>
                            <select name="rooms[]" class="form-control shadow-none room-select" id="rooms">
                                <option value="" selected disabled>----- Select Room -----</option>
                                <!-- Available rooms will be added here dynamically -->
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="adults">Adults</label>
                            <input type="text" class="form-control" name="total_adults[]" required inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-6">
                            <label for="children">Children</label>
                            <input type="text" class="form-control" name="total_children[]" required inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-6 text-end" style="margin-top: 32px;">
                            <button type="button" class="btn btn-success shadow-none rounded-0" id="addAnotherRoomBtn">Add Room</button>
                        </div>
                    </div>
                </div>

                <!-- Button to Add More Rooms -->
                <div class="col-md-12">
                   
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="modalCloseBtn">Close</button>
                <button type="submit" class="btn btn-primary shadow-none rounded-0">Submit</button>
            </div>
        </form>
    </div>
</div> --}}

    <!-- Modal -->
    <div id="customModal" class="modal modal-fullscreen-custom">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="modalClose">&times;</span>
            </div>
            <form id="addRoomForm">
                <div class="modal-body">
                    <div class="room-entry" id="room1">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group d-flex flex-column">
                                    <label for="my-input">Room 1</label>
                                    <select name="rooms[]" class="form-select shadow-none room-select">
                                        <option value="" selected disabled>----- Select Room -----</option>
                                        <!-- Available rooms will be added here dynamically -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="adults">Adults</label>
                                <input type="text" class="form-control" name="total_adults[]" required
                                    inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div class="col-md-6">
                                <label for="children">Children</label>
                                <input type="text" class="form-control" name="total_children[]" required
                                    inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div class="col-md-6 text-end" style="margin-top: 32px;">
                                <button type="button" class="btn btn-success shadow-none rounded-0"
                                    id="addAnotherRoomBtn">Add Room</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modalCloseBtn">Close</button>
                    <button type="submit" class="btn btn-primary shadow-none rounded-0">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <!-- Room Modal -->
    {{-- <div class="modal" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomModalLabel">Available Rooms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="roomList"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    {{-- <script>
        document.getElementById('openFilterModalBtn').addEventListener('click', function() {
            openCustomModal(); // Open the Filter Modal
        });

        function openCustomModal() {
            document.getElementById('customModal').style.display = 'block';
        }

        // Close the custom modal (Filter Modal)
        function closeCustomModal() {
            document.getElementById('customModal').style.display = 'none';
           
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('customModal')) {
                closeCustomModal();
            }
        }

        // Add event listener for closing the modal
        document.getElementById('modalClose').addEventListener('click', closeCustomModal);
        document.getElementById('modalCloseBtn').addEventListener('click', closeCustomModal);
        // Event listener for the room search form
        document.getElementById('addRoomForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get values dynamically from the form
            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;
            const adults = document.getElementById('adults').value;
            const children = document.getElementById('children').value;

            console.log("Fetching rooms with filters:", {
                checkIn,
                checkOut,
                adults,
                children
            });

            // Call the function to fetch and display rooms based on dynamic form data
            fetchAvailableRooms(checkIn, checkOut, adults, children);
        });

        // Function to fetch available rooms and display them in the modal
        function fetchAvailableRooms(checkIn, checkOut, adults, children) {
            fetch(`/api/available-rooms?check_in=${checkIn}&check_out=${checkOut}&adults=${adults}&children=${children}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Fetched rooms data:", data); // Log the data for debugging

                    const roomList = document.getElementById('roomList');
                    roomList.innerHTML = ''; // Clear old content

                    if (data && data.rooms && Array.isArray(data.rooms) && data.rooms.length > 0) {
                       
                        data.rooms.forEach(room => {
                            console.log("Room data:", room); // Log each room for debugging

                            // Correct access to roomType properties
                            const roomType = room.room_type && room.room_type.type_name ? room.room_type
                                .type_name : 'N/A';
                            const roomImage = room.images && room.images[0] && room.images[0].image ? room
                                .images[0].image : 'default.jpg';

                            const roomCard = document.createElement('div');
                            roomCard.classList.add('col-md-6', 'mb-4');
                            roomCard.innerHTML = `
                                <div class="card">
                                    <img src="/storage/${roomImage}" class="card-img-top" alt="${roomType}">
                                    <div class="card-body">
                                        <h5 class="card-title">${roomType}</h5>
                                        <p class="text-muted small"><i class="bi bi-geo-alt-fill text-primary"></i> Siem Reap</p>
                                        <h6 class="mb-2 text-uppercase">Special Price</h6>
                                        <div class="text-success">
                                            <strong>$ ${room.special_price ? room.special_price.toLocaleString() : room.price.toLocaleString()}</strong>
                                            ${room.special_price ? `<span class="original-price ms-2">$ ${room.price.toLocaleString()}</span>` : ''}
                                        </div>
                                        <button class="btn btn-primary w-100 mt-3" onclick="addRoomToBooking(${room.id})">Add Room</button>
                                    </div>
                                </div>
                            `;
                            roomList.appendChild(roomCard);
                        });

                    } else {
                        roomList.innerHTML = '<p>No rooms available for the selected dates.</p>';
                    }

                    // Open the Room Modal
                    $('#roomModal').modal('show');
                })


                .catch(error => {
                    console.error('Error fetching rooms:', error);
                    document.getElementById('roomList').innerHTML =
                        '<p>Error loading rooms. Please try again later.</p>';
                });
        }

        // Function to handle adding a room to the booking (Placeholder for now)
        function addRoomToBooking(roomId) {
            console.log(`Room ${roomId} added to booking`);
        }
        
    </script> --}}

    {{-- <script>
        let selectedRooms = []; // To store selected room details
    
        document.getElementById('openFilterModalBtn').addEventListener('click', function () {
            openCustomModal(); // Open the Filter Modal
        });
    
        function openCustomModal() {
            document.getElementById('customModal').style.display = 'block';
        }
    
        function closeCustomModal() {
            document.getElementById('customModal').style.display = 'none';
        }
    
        window.onclick = function (event) {
            if (event.target == document.getElementById('customModal')) {
                closeCustomModal();
            }
        };
    
        document.getElementById('modalClose').addEventListener('click', closeCustomModal);
        document.getElementById('modalCloseBtn').addEventListener('click', closeCustomModal);
    
        document.getElementById('addRoomForm').addEventListener('submit', function (e) {
            e.preventDefault();
    
            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;
            const adults = document.getElementById('adults').value;
            const children = document.getElementById('children').value;
    
            fetchAvailableRooms(checkIn, checkOut, adults, children);
        });
    
        function fetchAvailableRooms(checkIn, checkOut, adults, children) {
            fetch(`/api/available-rooms?check_in=${checkIn}&check_out=${checkOut}&adults=${adults}&children=${children}`)
                .then(response => response.json())
                .then(data => {
                    const roomList = document.getElementById('roomList');
                    roomList.innerHTML = ''; // Clear old content
    
                    if (data && data.rooms && Array.isArray(data.rooms) && data.rooms.length > 0) {
                        data.rooms.forEach(room => {
                            const roomType = room.room_type?.type_name || 'N/A';
                            const roomImage = room.images?.[0]?.image || 'default.jpg';
    
                            const roomCard = document.createElement('div');
                            roomCard.classList.add('col-md-6', 'mb-4');
                            roomCard.innerHTML = `
                                <div class="card">
                                    <img src="/storage/${roomImage}" class="card-img-top" alt="${roomType}">
                                    <div class="card-body">
                                        <h5 class="card-title">${roomType}</h5>
                                        <h6 class="mb-2">Price: $${room.price}</h6>
                                        <button class="btn btn-primary add-room-btn w-100 mt-3" 
                                            data-id="${room.id}" 
                                            data-type="${roomType}" 
                                            data-price="${room.price}">
                                            Add Room
                                        </button>
                                    </div>
                                </div>
                            `;
                            roomList.appendChild(roomCard);
                        });
                    } else {
                        roomList.innerHTML = '<p>No rooms available for the selected dates.</p>';
                    }
    
                    $('#roomModal').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching rooms:', error);
                    document.getElementById('roomList').innerHTML = '<p>Error loading rooms. Please try again later.</p>';
                });
        }
    
        // Use event delegation for dynamically added buttons
        document.getElementById('roomList').addEventListener('click', function (e) {
            if (e.target.classList.contains('add-room-btn')) {
                const roomId = e.target.getAttribute('data-id');
                const roomType = e.target.getAttribute('data-type');
                const roomPrice = e.target.getAttribute('data-price');
    
                addRoomToBooking(roomId, roomType, roomPrice);
            }
        });
    
        function addRoomToBooking(roomId, roomType, roomPrice) {
            const newRoom = { id: roomId, type: roomType, price: parseFloat(roomPrice) };
            selectedRooms.push(newRoom);
            updateBookingSummary();
            closeCustomModal();
        }
    
        function updateBookingSummary() {
            const bookingSummary = document.querySelector('.booking-summary .card-body');
            let summaryHtml = `
                <h5>Booking Details</h5>
                ${selectedRooms.map(room => `
                    <p><strong>${room.type}:</strong> $${room.price}</p>
                `).join('')}
                <p class="price-summary"><strong>Total Price:</strong> $${selectedRooms.reduce((sum, room) => sum + room.price, 0).toFixed(2)}</p>
            `;
            bookingSummary.innerHTML = summaryHtml + `
                <button type="button" class="btn btn-primary" id="openFilterModalBtn">Add Another Room</button>
                <a href="checkout-link" class="btn btn-warning w-100 rounded-0 text-white">Proceed to Checkout</a>
            `;
        }
    </script> --}}




    {{-- <script>
        let selectedRooms = []; // To store selected room details

        // Event listener for opening the filter modal
        document.getElementById('openFilterModalBtn').addEventListener('click', function() {
            openCustomModal();
        });

        function openCustomModal() {
            document.getElementById('customModal').style.display = 'block';
        }

        function closeCustomModal() {
            document.getElementById('customModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('customModal')) {
                closeCustomModal();
            }
        };

        // Event listener for form submission
        document.getElementById('addRoomForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;
            const adults = document.getElementById('adults').value;
            const children = document.getElementById('children').value;

            fetchAvailableRooms(checkIn, checkOut, adults, children);
        });

        function fetchAvailableRooms(checkIn, checkOut, adults, children) {
            fetch(`/api/available-rooms?check_in=${checkIn}&check_out=${checkOut}&adults=${adults}&children=${children}`)
                .then(response => response.json())
                .then(data => {
                    const roomList = document.getElementById('roomList');
                    roomList.innerHTML = ''; // Clear old content

                    if (data && data.rooms && Array.isArray(data.rooms) && data.rooms.length > 0) {
                        data.rooms.forEach(room => {
                            const roomType = room.room_type?.type_name || 'N/A';
                            const roomImage = room.images?.[0]?.image || 'default.jpg';

                            const roomCard = document.createElement('div');
                            roomCard.classList.add('col-md-6', 'mb-4');
                            roomCard.innerHTML = `
                                <div class="card">
                                    <img src="/storage/${roomImage}" class="card-img-top" alt="${roomType}">
                                    <div class="card-body">
                                        <h5 class="card-title">${roomType}</h5>
                                        <h6 class="mb-2">Price: $${room.price}</h6>
                                        <button class="btn btn-primary add-room-btn w-100 mt-3" 
                                            data-id="${room.id}" 
                                            data-type="${roomType}" 
                                            data-price="${room.price}">
                                            Add Room
                                        </button>
                                    </div>
                                </div>
                            `;
                            roomList.appendChild(roomCard);
                        });
                    } else {
                        roomList.innerHTML = '<p>No rooms available for the selected dates.</p>';
                    }

                    $('#roomModal').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching rooms:', error);
                    document.getElementById('roomList').innerHTML =
                        '<p>Error loading rooms. Please try again later.</p>';
                });
        }

        // Add event listener to the parent container using delegation
        document.getElementById('roomList').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-room-btn')) {
                const roomId = e.target.dataset.id;
                const roomType = e.target.dataset.type;
                const roomPrice = e.target.dataset.price;

                addRoomToBooking(roomId, roomType, roomPrice);
            }
        });

        function addRoomToBooking(roomId, roomType, roomPrice) {
            const room = {
                id: roomId,
                type: roomType,
                price: parseFloat(roomPrice)
            };
            selectedRooms.push(room);

            alert(`Room added: ${roomType} ($${roomPrice})`);

            updateSelectedRooms();
            $('#roomModal').modal('hide'); // Close the modal after adding the room
        }
        document.getElementById('modalClose').addEventListener('click', closeCustomModal);
        document.getElementById('modalCloseBtn').addEventListener('click', closeCustomModal);

       

        function updateSelectedRooms() {
            const selectedRoomsList = document.getElementById('selectedRoomsList');
            const dynamicTotalPrice = document.getElementById('dynamicTotalPrice');

            // Update the list of selected rooms
            selectedRoomsList.innerHTML = selectedRooms
                .map(room => `<p>${room.type} - $${room.price}</p>`)
                .join('');

            // Calculate the total for dynamically selected rooms
            const dynamicTotal = selectedRooms.reduce((sum, room) => sum + room.price, 0).toFixed(2);

            dynamicTotalPrice.innerHTML = `<strong>Additional Total:</strong> $${dynamicTotal}`;
        }

      

        function addRoomToBooking(roomId, roomType, roomPrice) {
            // Check if the room is already added
            const isRoomAlreadyAdded = selectedRooms.some(room => room.id === roomId);

            if (isRoomAlreadyAdded) {
                alert('This room has already been added!');
                // $('#roomModal').modal('hide'); // Hide the modal after the alert is dismissed
                return;
            }

            // Add the room to the selection
            const room = {
                id: roomId,
                type: roomType,
                price: parseFloat(roomPrice)
            };
            selectedRooms.push(room);

            alert(`Room added: ${roomType} ($${roomPrice})`);

            // Find the room card element and hide it
            const roomCard = document.querySelector(`[data-id="${roomId}"]`).closest('.card');
            if (roomCard) {
                roomCard.style.display = 'none'; // Hide the room card
            }

            // $('#roomModal').modal('hide'); // Hide the modal after the alert is dismissed

            updateSelectedRooms(); // Update the UI with selected rooms
        }
    </script> --}}





    {{-- <script>
        let selectedRooms = []; // To store selected room details
        let bookingDetails = {
            checkIn: '',
            checkOut: '',
            adults: '',
            children: ''
        }; // Store booking details

        // Event listener for opening the filter modal
        document.getElementById('openFilterModalBtn').addEventListener('click', function() {
            openCustomModal();
        });

        function openCustomModal() {
            document.getElementById('customModal').style.display = 'block';
        }

        function closeCustomModal() {
            document.getElementById('customModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('customModal')) {
                closeCustomModal();
            }
        };

        // Event listener for form submission
        document.getElementById('addRoomForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;
            const adults = document.getElementById('adults').value;
            const children = document.getElementById('children').value;

            // Store the booking details
            bookingDetails = {
                checkIn,
                checkOut,
                adults,
                children
            };

            fetchAvailableRooms(checkIn, checkOut, adults, children);
        });

        function fetchAvailableRooms(checkIn, checkOut, adults, children) {
            fetch(`/api/available-rooms?check_in=${checkIn}&check_out=${checkOut}&adults=${adults}&children=${children}`)
                .then(response => response.json())
                .then(data => {
                    const roomList = document.getElementById('roomList');
                    roomList.innerHTML = ''; // Clear old content

                    if (data && data.rooms && Array.isArray(data.rooms) && data.rooms.length > 0) {
                        data.rooms.forEach(room => {
                            const roomType = room.room_type?.type_name || 'N/A';
                            const roomImage = room.images?.[0]?.image || 'default.jpg';

                            const roomCard = document.createElement('div');
                            roomCard.classList.add('col-md-6', 'mb-4');
                            roomCard.innerHTML = `
                        <div class="card">
                            <img src="/storage/${roomImage}" class="card-img-top" alt="${roomType}">
                            <div class="card-body">
                                <h5 class="card-title">${roomType}</h5>
                                <h6 class="mb-2">Price: $${room.price}</h6>
                                <button class="btn btn-primary add-room-btn w-100 mt-3" 
                                    data-id="${room.id}" 
                                    data-type="${roomType}" 
                                    data-price="${room.price}">
                                    Add Room
                                </button>
                            </div>
                        </div>
                    `;
                            roomList.appendChild(roomCard);
                        });
                    } else {
                        roomList.innerHTML = '<p>No rooms available for the selected dates.</p>';
                    }

                    $('#roomModal').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching rooms:', error);
                    document.getElementById('roomList').innerHTML =
                        '<p>Error loading rooms. Please try again later.</p>';
                });
        }

        // Add event listener to the parent container using delegation
        document.getElementById('roomList').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-room-btn')) {
                const roomId = e.target.dataset.id;
                const roomType = e.target.dataset.type;
                const roomPrice = e.target.dataset.price;

                addRoomToBooking(roomId, roomType, roomPrice);
            }
        });

        function addRoomToBooking(roomId, roomType, roomPrice) {
            const room = {
                id: roomId,
                type: roomType,
                price: parseFloat(roomPrice)
            };
            selectedRooms.push(room);

            alert(`Room added: ${roomType} ($${roomPrice})`);

            updateSelectedRooms();
            $('#roomModal').modal('hide'); // Close the modal after adding the room
        }

        function updateSelectedRooms() {
            const selectedRoomsList = document.getElementById('selectedRoomsList');
            const dynamicTotalPrice = document.getElementById('dynamicTotalPrice');

            // Update the list of selected rooms
            selectedRoomsList.innerHTML = selectedRooms
                .map(room => `<p>${room.type} - $${room.price}</p>`)
                .join('');

            // Calculate the total for dynamically selected rooms
            const dynamicTotal = selectedRooms.reduce((sum, room) => sum + room.price, 0).toFixed(2);

            dynamicTotalPrice.innerHTML = `<strong>Additional Total:</strong> $${dynamicTotal}`;

            // Update the Booking Summary with filtered details
            updateBookingSummary();
        }

        function updateBookingSummary() {
            const bookingSummary = document.getElementById('defaultBookingDetails');
            const {
                checkIn,
                checkOut,
                adults,
                children
            } = bookingDetails;
            const nights = calculateNights(checkIn, checkOut);

            // Update booking summary with the filtered details
            bookingSummary.innerHTML = `
        <h5>Booking Details</h5>
        <p><strong>Check-In: </strong> ${checkIn}</p>
        <p><strong>Check-Out: </strong> ${checkOut}</p>
        <p><strong>Nights:</strong> ${nights}</p>
        <p><strong>Guests:</strong> ${adults} Adults, ${children} Children</p>
    `;
        }
        function calculateNights(checkIn, checkOut) {
            const checkInDate = new Date(checkIn);
            const checkOutDate = new Date(checkOut);
            const timeDiff = checkOutDate - checkInDate;
            const nights = timeDiff / (1000 * 3600 * 24); // Convert milliseconds to days
            return nights;
        }

        document.getElementById('modalClose').addEventListener('click', closeCustomModal);
        document.getElementById('modalCloseBtn').addEventListener('click', closeCustomModal);
    </script> --}}
    {{-- <script>
        // Room count tracker
        let roomCount = 1;
        document.getElementById('openFilterModalBtn').addEventListener('click', function() {
            openCustomModal(); // Open the Filter Modal
        });

        function openCustomModal() {
            document.getElementById('customModal').style.display = 'block';
        }

        // Close the custom modal (Filter Modal)
        function closeCustomModal() {
            document.getElementById('customModal').style.display = 'none';
           
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('customModal')) {
                closeCustomModal();
            }
        }

        // Add event listener for closing the modal
        document.getElementById('modalClose').addEventListener('click', closeCustomModal);
        document.getElementById('modalCloseBtn').addEventListener('click', closeCustomModal);
        // Open the modal when "Add Room" button is clicked
        // document.getElementById('addAnotherRoomBtn').addEventListener('click', function() {
        //     roomCount++;
        //     const newRoomEntry = document.createElement('div');
        //     newRoomEntry.classList.add('room-entry');
        //     newRoomEntry.id = 'room' + roomCount;
        //     newRoomEntry.innerHTML = `
        //         <div class="row">
        //             <div class="col-md-6">
        //                 <label for="room">Room ${roomCount}</label>
        //                 <select name="rooms[]" class="form-control shadow-none room-select" id="rooms">
        //                     <option value="" selected disabled>----- Select Room -----</option>
        //                     <!-- Available rooms will be added here dynamically -->
        //                 </select>
        //             </div>
        //             <div class="col-md-6 mb-4">
        //                 <label for="adults">Adults</label>
        //                 <input type="text" class="form-control" name="adults[]" required inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        //             </div>
        //             <div class="col-md-6">
        //                 <label for="children">Children</label>
        //                 <input type="text" class="form-control" name="children[]" required inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        //             </div>
        //         </div>
        //     `;
        //     document.querySelector('#addRoomForm').insertBefore(newRoomEntry, document.getElementById('addAnotherRoomBtn'));
        //     loadAvailableRooms(); // Load available rooms into the new select dropdown
        // });
        
        // // Close the modal when the close button is clicked
        // document.getElementById('modalClose').addEventListener('click', function() {
        //     document.getElementById('customModal').style.display = 'none';
        // });
        
        // // Fetch available rooms and load them into the modal's room selection dropdown
        // function loadAvailableRooms() {
        //     // You would fetch available rooms based on the selected check-in/check-out dates
        //     // Assuming you have the check-in and check-out values
        //     const checkInDate = document.getElementById('checkIn').value;
        //     const checkOutDate = document.getElementById('checkOut').value;
        
        //     if (checkInDate && checkOutDate) {
        //         fetch(`/api/available-rooms?check_in=${checkInDate}&check_out=${checkOutDate}`)
        //             .then(response => response.json())
        //             .then(rooms => {
        //                 // Loop through all room selects and populate options
        //                 document.querySelectorAll('.room-select').forEach(selectElement => {
        //                     selectElement.innerHTML = '<option value="" selected disabled>----- Select Room -----</option>'; // Reset options
        //                     rooms.forEach(room => {
        //                         const option = document.createElement('option');
        //                         option.value = room.id;
        //                         option.textContent = room.name; // Assuming the room has a "name" property
        //                         selectElement.appendChild(option);
        //                     });
        //                 });
        //             });
        //     }
        // }
        
        // // Automatically load rooms when the modal is opened
        // document.getElementById('customModal').addEventListener('show', function() {
        //     loadAvailableRooms();
        // });

        let allAvailableRooms = []; // Store all available rooms globally

        document.addEventListener('DOMContentLoaded', function() {
            const checkInDateInput = document.getElementById('check_in_date');
            const checkOutDateInput = document.getElementById('check_out_date');
            const addRoomButton = document.getElementById('add-room');
            const roomSelectionDiv = document.getElementById('room-selection');

            // Event listeners for date changes
            checkInDateInput.addEventListener('change', function() {
                fetchAllAvailableRooms(this.value, checkOutDateInput.value);
            });

            checkOutDateInput.addEventListener('change', function() {
                fetchAllAvailableRooms(checkInDateInput.value, this.value);
            });

            // Event listener for adding new room dropdowns
            addRoomButton.addEventListener('click', function() {
                addNewRoomDropdown();
            });

            // Fetch all available rooms
            function fetchAllAvailableRooms(checkInDate, checkOutDate) {
                if (!checkInDate || !checkOutDate) return;

                $.ajax({
                    url: "{{ url('bookings') }}/available-room/" + checkInDate,
                    method: "GET",
                    data: {
                        check_out_date: checkOutDate
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        updateAllRoomDropdowns('<option>Loading...</option>');
                    },
                    success: function(res) {
                        allAvailableRooms = res.data; // Store available rooms globally
                        updateAllRoomDropdowns();
                    },
                });
            }

            // Add a new room dropdown dynamically
            function addNewRoomDropdown() {
                const newRoomGroup = document.createElement('div');
                newRoomGroup.classList.add('room-group');

                newRoomGroup.innerHTML = `
                <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.room') <span class="text-danger">*</span></label>
                                <select name="rooms[]" required class="form-select room-list" >
                                    <option value="">--- Select Room ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.totalAdults') <span class="text-danger">*</span></label>
                                <input type="number" name="total_adults[]" class="form-control" min="1" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.totalChildren')</label>
                                <input type="number" name="total_children[]" class="form-control" min="0">
                            </div>
                        </div>

                        <div class="col-md-12 text-end">
                        <button type="button" class="remove-room badge bg-danger pt-1 border-none border-0"><i class="mdi mdi-close-thick fs-5"></i></button>	
                        
                        </div>
                    </div>
                `;

                // Add event listener for removing the room
                newRoomGroup.querySelector('.remove-room').addEventListener('click', function() {
                    newRoomGroup.remove();
                    updateAllRoomDropdowns(); // Refresh dropdowns after removal
                });

                roomSelectionDiv.appendChild(newRoomGroup);
                updateAllRoomDropdowns(); // Update options for the new dropdown
            }

            // Update all room dropdowns dynamically
            function updateAllRoomDropdowns(loadingMessage = null) {
                // Get all selected room IDs from dropdowns
                const selectedRoomIds = Array.from(document.querySelectorAll('.room-list'))
                    .map(roomDropdown => roomDropdown.value)
                    .filter(value => value); // Only keep selected values

                const roomDropdowns = document.querySelectorAll('.room-list');
                roomDropdowns.forEach(function(roomDropdown) {
                    const selectedValue = roomDropdown.value; // Preserve the current selection
                    let options = loadingMessage || '<option value="">--- Select Room ---</option>';

                    // Iterate through all available rooms
                    allAvailableRooms.forEach(function(room) {
                        // A room is available if:
                        // 1. It's not selected by another dropdown OR
                        // 2. It's already selected in the current dropdown
                        // if (!selectedRoomIds.includes(String(room.id)) || room.id == selectedValue) {
                        //     options += `<option value="${room.id}" data-max-person="${room.max_person}" ${
                    //         room.id == selectedValue ? 'selected' : ''
                    //     }>${room.room_number} - ${room.type_name}</option>`;
                        // }
                        if (!selectedRoomIds.includes(String(room.id)) || room.id == selectedValue){
                            options += `<option value="${room.id}" data-max-person="${room.max_person}" data-room-type-name="${room.type_name}" ${
                                room.id == selectedValue ? 'selected' : ''
                            }>${room.room_number} - ${room.type_name}</option>`;

                        }
                    });
                    // Update the dropdown's options
                    roomDropdown.innerHTML = options;
                });
            }
           // document.addEventListener('change', function(event) {
        //         if (event.target.classList.contains('room-list')) {
        //             updateAllRoomDropdowns
        //                 (); // Refresh options dynamically when a room is selected/deselected
        //         }
        //     });

            // Check if the total adults and children exceed max_person for the selected room
            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('room-list') || event.target.classList.contains(
                        'form-control')) {
                    validateRoomCapacity();
                    updateAllRoomDropdowns();
                }
            });

            function validateRoomCapacity() {
                const roomDropdowns = document.querySelectorAll('.room-list');
                const totalAdultsInputs = document.querySelectorAll('input[name="total_adults[]"]');
                const totalChildrenInputs = document.querySelectorAll('input[name="total_children[]"]');

                roomDropdowns.forEach((dropdown, index) => {
                    const selectedRoomId = dropdown.value;
                    const maxPerson = parseInt(dropdown.selectedOptions[0].dataset.maxPerson, 10);
                    const roomTypeName = dropdown.selectedOptions[0].dataset
                    .roomTypeName; // Fetch the room type name

                    const totalAdults = parseInt(totalAdultsInputs[index].value, 10);
                    const totalChildren = parseInt(totalChildrenInputs[index].value, 10) || 0;
                    const totalPersons = totalAdults + totalChildren;

                    // If the total number of persons exceeds max_person, show an error
                    if (totalPersons > maxPerson) {
                        alert(
                            `The total number of persons for the ${roomTypeName} exceeds the maximum capacity of ${maxPerson}.`);
                        dropdown.setCustomValidity("Total persons exceed room capacity.");
                    } else {
                        dropdown.setCustomValidity(""); // Remove custom validity if valid
                    }
                });
            }
        });

        </script> --}}


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Assuming check-in and check-out dates are passed from the filter page to the view
            const checkInDate = '{{ $checkIn }}';
            const checkOutDate = '{{ $checkOut }}';


            document.getElementById('openFilterModalBtn').addEventListener('click', function() {
                openCustomModal(); // Open the Filter Modal
                fetchAvailableRooms(checkInDate, checkOutDate);
            });

            function openCustomModal() {
                document.getElementById('customModal').style.display = 'block';
                fetchAvailableRooms(checkInDate, checkOutDate);
            }

            // Close the custom modal (Filter Modal)
            function closeCustomModal() {
                document.getElementById('customModal').style.display = 'none';
                fetchAvailableRooms(checkInDate, checkOutDate);

            }

            // Close modal when clicking outside of it
            window.onclick = function(event) {
                if (event.target == document.getElementById('customModal')) {
                    closeCustomModal();
                }
            }

            // Add event listener for closing the modal
            document.getElementById('modalClose').addEventListener('click', closeCustomModal);
            document.getElementById('modalCloseBtn').addEventListener('click', closeCustomModal);

            function fetchAvailableRooms(checkInDate, checkOutDate) {
                $.ajax({
                    url: "{{ url('bookings/available-room') }}/" + checkInDate,
                    method: "GET",
                    data: {
                        check_out_date: checkOutDate
                    },
                    dataType: 'json',
                    success: function(res) {
                        const rooms = res.data;
                        updateRoomDropdown(rooms);
                    },
                    error: function(err) {
                        console.error('Error fetching rooms:', err);
                    }
                });
            }

            function updateRoomDropdown(rooms) {
                const roomSelect = document.getElementById('rooms');
                roomSelect.innerHTML = ''; // Clear previous options

                // Add a default option
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = '----- Select Room -----';
                roomSelect.appendChild(defaultOption);

                // Populate with available rooms
                rooms.forEach(room => {
                    const option = document.createElement('option');
                    option.value = room.id;
                    option.text = `${room.room_number} - ${room.type_name}`;
                    roomSelect.appendChild(option);
                });
            }
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const checkInDate = '{{ $checkIn }}';
    const checkOutDate = '{{ $checkOut }}';

    // Ensure the modal elements exist in the DOM before trying to add event listeners
    const openFilterModalBtn = document.getElementById('openFilterModalBtn');
    const modalClose = document.getElementById('modalClose');
    const modalCloseBtn = document.getElementById('modalCloseBtn');
    const customModal = document.getElementById('customModal');

    // Only add event listeners if the elements exist
    if (openFilterModalBtn) {
        openFilterModalBtn.addEventListener('click', function() {
            openCustomModal(); // Open the Filter Modal
            fetchAvailableRooms(checkInDate, checkOutDate);
        });
    }

    function openCustomModal() {
        if (customModal) {
            customModal.style.display = 'block';
            fetchAvailableRooms(checkInDate, checkOutDate);
        }
    }

    // Close the custom modal (Filter Modal)
    function closeCustomModal() {
        if (customModal) {
            customModal.style.display = 'none';
        }
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == customModal) {
            closeCustomModal();
        }
    }

    // Add event listener for closing the modal
    if (modalClose) {
        modalClose.addEventListener('click', closeCustomModal);
    }
    if (modalCloseBtn) {
        modalCloseBtn.addEventListener('click', closeCustomModal);
    }

    function fetchAvailableRooms(checkInDate, checkOutDate) {
        $.ajax({
            url: "{{ url('bookings/available-room') }}/" + checkInDate,
            method: "GET",
            data: {
                check_out_date: checkOutDate
            },
            dataType: 'json',
            success: function(res) {
                const rooms = res.data;
                updateRoomDropdown(rooms);
            },
            error: function(err) {
                console.error('Error fetching rooms:', err);
            }
        });
    }

//     function updateRoomDropdown(rooms) {
//     const roomSelects = document.querySelectorAll('.room-select'); // Get all room dropdowns

//     roomSelects.forEach(roomSelect => {
//         roomSelect.innerHTML = '';  // Clear previous options

//         // Add a default option
//         const defaultOption = document.createElement('option');
//         defaultOption.value = '';
//         defaultOption.text = '----- Select Room -----';
//         roomSelect.appendChild(defaultOption);

//         // Populate with available rooms
//         rooms.forEach(room => {
//             const option = document.createElement('option');
//             option.value = room.id;
//             option.text = `${room.type_name}`;
//             roomSelect.appendChild(option);
//         });

//         // Ensure the first dropdown is pre-selected (or you can skip if you want)
//         if (roomSelect.options.length > 1) {
//             roomSelect.selectedIndex = 1; // Pre-select the first available room
//         }
//     });
// }

function updateRoomDropdown(rooms) {
    const roomSelects = document.querySelectorAll('.room-select'); // Get all room dropdowns

    roomSelects.forEach(roomSelect => {
        roomSelect.innerHTML = '';  // Clear previous options

        // Add a default option
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = '----- Select Room -----';
        roomSelect.appendChild(defaultOption);

        // Populate with available rooms
        rooms.forEach(room => {
            const option = document.createElement('option');
            option.value = room.id;
            option.text = `${room.type_name}`;

            // Ensure the selected room stays selected
            if (roomSelect.getAttribute('data-selected-room-id') === room.id.toString()) {
                option.selected = true;
            }

            roomSelect.appendChild(option);
        });
    });
}

// Update this function to store selected room when user selects it.
document.querySelectorAll('.room-select').forEach(select => {
    select.addEventListener('change', function () {
        // Store selected room ID in data attribute
        this.setAttribute('data-selected-room-id', this.value);
    });
});


});

    </script>
@endsection

<form action="{{ route('booking.process') }}" method="POST">
    @csrf
    <!-- Guest Information -->
    <h3>Guest Information</h3>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="mobile">Phone:</label>
        <input type="text" id="mobile" name="mobile" required>
    </div>

    <!-- Booking Details -->
    <h3>Booking Details</h3>
    <div>
        <label for="check_in_date">Check-in Date:</label>
        <input type="date" id="check_in_date" name="check_in_date" required>
    </div>
    <div>
        <label for="check_out_date">Check-out Date:</label>
        <input type="date" id="check_out_date" name="check_out_date" required>
    </div>
    <div>
        <label for="adults">Adults:</label>
        <input type="number" id="adults" name="total_adults" required>
    </div>
    <div>
        <label for="children">Children:</label>
        <input type="number" id="children" name="total_children">
    </div>

    <!-- Payment Option -->
    {{-- <h3>Payment</h3>
    <div>
        <label>
            <input type="radio" name="payment_option" value="pay_now" required> Pay Now
        </label>
        <label>
            <input type="radio" name="payment_option" value="skip_payment" required> Skip Payment
        </label>
    </div> --}}

    <!-- Submit -->
    <button type="submit">Proceed</button>
</form>

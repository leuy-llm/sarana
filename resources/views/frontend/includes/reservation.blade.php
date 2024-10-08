<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="min-width:600px; width: 100%;">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="reservation-form">
                  <h2 class="text-center">Sinaka Angkor Hotel</h2>
                  <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <label for="destination">Full Name</label>
                    <input type="text" placeholder="Enter full name">
                    <div class="date-group">
                      <div class="date">
                        <label>Phone</label>
                        <input type="number" id="destination" placeholder="Enter your name . . .">
                      </div>
                      <div class="date">
                        <label>Email</label>
                        <input type="email" id="destination" placeholder="Enter email . . .">
                      </div>
                    </div>
                    <div class="date-group">
                      <div class="date">
                        <label for="checkin">Check In</label>
                        <input type="date" id="checkin" placeholder="mm/dd/yyyy">
                      </div>
                      <div class="date">
                        <label for="checkout">Check Out</label>
                        <input type="date" id="checkout" placeholder="mm/dd/yyyy">
                      </div>
                    </div>
                    <div class="guest-group">
                      <div class="guest">
                        <label for="rooms">Rooms</label>
                        <select id="rooms">
                          <option>Single Room</option>
                          <option>Double Room</option>
                          <option>Family Room</option>
                        </select>
                      </div>
                      <div class="guest">
                        <label for="adults">Adults</label>
                        <select id="adults">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                        </select>
                      </div>
                      <div class="guest">
                        <label for="children">Children</label>
                        <select id="children">
                          <option>0</option>
                          <option>1</option>
                          <option>2</option>
                        </select>
                      </div>
                    </div>
                    <h2 class="text-center mt-2">Select Extra Services</h2>
                    <div class="serviceform">
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">MESSAGE & SPA</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">LAUNDRY</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">ROOM SERVICE</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">LAUNDRY</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">ROOM SERVICE</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">ROOM SERVICE</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">LAUNDRY</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">ROOM SERVICE</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input id="my-input" class="form-check-input" type="checkbox" name="" value="true">
                        <label for="my-input" class="form-check-label">ROOM SERVICE</label>
                      </div>
                    </div>
                    <button type="submit" class="mt-2">BOOKING</button>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
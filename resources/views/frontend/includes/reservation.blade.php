<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="min-width:600px; width: 100%;">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="reservation-form">
                  <h2 class="text-center">Sinaka Angkor Hotel</h2>
                  <form action="{{ url('/bookings') }}" method="POST">
                    @csrf
                    <label for="destination">Full Name</label>
                    <input type="text" name="name" placeholder="Enter full name">
                    <div class="date-group">
                      <div class="date">
                        <label>Phone</label>
                        <input type="number" id="mobile" name="mobile" placeholder="Enter your name . . .">
                      </div>
                      <div class="date">
                        <label>Email</label>
                        <input type="email" id="eamil" name="email" placeholder="Enter email . . .">
                      </div>
                    </div>
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Enter your address ...">
                    <div class="date-group">
                      <div class="date">
                        <label>Check In</label>
                        <input type="date" id="checkin" name="check_in_date" placeholder="mm/dd/yyyy">
                      </div>
                      <div class="date">
                        <label for="checkout">Check Out</label>
                        <input type="date" id="checkout" name="check_out_date" placeholder="mm/dd/yyyy">
                      </div>
                    </div>
                    <div class="guest-group">
                      <div class="guest">
                        <label for="rooms">Rooms</label>
                        <select name="room_id" required="" class="form-control room-list select2">

                        </select>
                      </div>
                      <div class="guest">
                        <label for="adults">Adults</label>
                        <select id="adults" name="total_adults">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                        </select>
                      </div>
                      <div class="guest">
                        <label for="children">Children</label>
                        <select id="children" name="total_children">
                          <option>0</option>
                          <option>1</option>
                          <option>2</option>
                        </select>
                      </div>
                    </div>
                   
                    <div class="serviceform">
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

  <script>
    $(document).ready(function() {
                $(".checkin_date").on('blur', function() {
                    var _checkindate = $(this).val();
                    console.log(_checkindate);

                    // Ajax to get available rooms based on check-in date
                    $.ajax({
                        url: "{{ url('bookings') }}/available-rooms/" + _checkindate,
                        dataType: 'json',
                        beforeSend: function() {
                            $(".room-list").html('<option>--- Loading ---</option>');
                        },
                        success: function(res) {
                            var _html = '';
                            $.each(res.data, function(index, row) {
                                _html += '<option value="' + row.id + '">' + row
                                    .room_number + ' - ' + row.type_name +
                                    '</option>';
                            });
                            $(".room-list").html(_html);
                        }
                    });
                });
            });
        });

  </script>
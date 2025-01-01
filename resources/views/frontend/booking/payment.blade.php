<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Coda:wght@400;800&display=swap");
    body {
        background-color: #f8f9fa;
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
    }

    .panel-title {
        font-family: "Coda", system-ui;
        color: #a38354;
        font-size: 2rem;
       
    }

    .form-control:focus {
        border-color: #a38354;
        box-shadow: none;
    }

    .btn-booking {
        background-color: #7d2e1e;
        color: white;
        font-family: "Coda", system-ui;
        margin-top: 20px;
        padding: 10px;
        border: none;
      /
        outline: none;
       
    }

    .btn-booking:focus,
    .btn-booking:active,
    .btn-booking:hover {
        background-color: #a83c2d;
        color: white;
        border: none;
        
        outline: none;
       
    }



    .control-label {
        font-family: "Coda", system-ui;
        font-weight: 200;
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

    .form-row {
        margin-top: 10px;
    }

    h3 {
        font-family: "Coda", system-ui;

    }

    ::placeholder {
        font-family: "Coda", system-ui;
    }

    .alert-danger {
        font-family: "Coda", system-ui;
    }
</style> 


 <body>
    <div class="container ">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table"
                        style="display: flex; justify-content: space-between;align-items: center ">
                        <h3 class="panel-title">Payment Details</h3>
                        <h3>${{ $totalprice }}</h3>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                            <form role="form" 
                                action="{{ route('payment.process', ['totalAmount' => $totalprice]) }}" 
                                method="POST" 
                                class="require-validation" 
                                data-cc-on-file="false" 
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" 
                                id="payment-form">
                                @csrf
                        
                            <input type="hidden" name="bookingId" value="{{ $bookingId }}">
                            <input type="hidden" name="stripeToken" id="stripeToken">
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group  required'>
                                <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                                    type='text'>
                            </div>
                        </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label> <input autocomplete='off'
                                class='form-control card-number' size='20' type='text'>
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary w-full p-2 btn-block" type="submit">Pay Now(${{ $totalprice }})</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
</body>
    <section id="rooms" class="rooms_wrapper">
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h3>Payment Page</h3>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table"
                        style="display: flex; justify-content: space-between;align-items: center ">
                        <h3 class="panel-title">Payment Details</h3>
                        <h3>${{ $totalprice }}</h3>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                            <form role="form" 
                                action="{{ route('payment.process', ['totalAmount' => $totalprice]) }}" 
                                method="POST" 
                                class="require-validation" 
                                data-cc-on-file="false" 
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" 
                                id="payment-form">
                                @csrf
                        
                            <input type="hidden" name="bookingId" value="{{ $bookingId }}">
                            <input type="hidden" name="stripeToken" id="stripeToken">
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group  required'>
                                <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                                    type='text'>
                            </div>
                        </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label> <input autocomplete='off'
                                class='form-control card-number' size='20' type='text'>
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary w-full p-2 btn-block" type="submit">Pay Now(${{ $totalprice }})</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

            {{-- <div class="row" style="display: flex; justify-content: center; align-items: center">
                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                <form role="form" 
                    action="{{ route('payment.process', ['totalAmount' => $totalprice]) }}" 
                    method="POST" 
                    class="require-validation shadow p-4  rounded-sm" style="width: 500px; margin:auto;" 
                    data-cc-on-file="false" 
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" 
                    id="payment-form">
            
                    @csrf
                    <input type="hidden" name="bookingId" value="{{ $bookingId }}">
                    <input type="hidden" name="stripeToken" id="stripeToken">
                    
                    
                        <div class='col-xs-12 form-group  required'>
                            <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                                type='text'>
                        </div>
                  
                     <div class='col-xs-12 form-group card border-0 required'>
                            <label class='control-label' style="font-family: 'Coda', system-ui;">Card Number</label> 
                            <input autocomplete='off'
                                class='form-control card-number' size='20' type='text'>
                        </div>
                   
                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label' style="font-family: 'Coda', system-ui;">CVC</label> <input autocomplete='off'
                                class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label' style="font-family: 'Coda', system-ui;">Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label' style="font-family: 'Coda', system-ui;">Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>
                    </div>
                    <div class="form-group">
        
                            <div class="col-xs-12">
                                <button class="btn btn-primary w-full p-2 shadow-none btn-block" type="submit">Pay Now(${{ $totalprice }})</button>
                            </div>
                       
                    </div>
                    
                </form>
                </div>
            </div> --}}

            {{-- <div class="row" style="display: flex; justify-content: center; align-items: center">
                <div class="panel-body">
                    <!-- Success Message -->
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    
                    <!-- Payment Form -->
                    <form role="form" 
                        action="{{ route('payment.process', ['totalAmount' => $totalprice]) }}" 
                        method="POST" 
                        class="require-validation shadow p-4  rounded-sm" style="width: 500px; margin:auto;" 
                        data-cc-on-file="false" 
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" 
                        id="payment-form">
                        
                        @csrf
                        <input type="hidden" name="bookingId" value="{{ $bookingId }}">
                        <input type="hidden" name="stripeToken" id="stripeToken">
            
                      
                        <!-- Name on Card -->
                        <div class="col-xs-12 form-group required">
                            <label class="control-label" style="font-family: 'Coda', system-ui;">Name on Card</label>
                            <input class="form-control" size="4" type="text" required>
                        </div>
            
                        <!-- Card Number -->
                        <div class="col-xs-12 form-group card border-0 required">
                            <label class="control-label" style="font-family: 'Coda', system-ui;">Card Number</label>
                            <input autocomplete="off" class="form-control card-number" size="20" type="text" required>
                        </div>
            
                        <!-- CVC -->
                        <div class="form-row row">
                            <div class="col-xs-12 col-md-4 form-group cvc required">
                                <label class="control-label" style="font-family: 'Coda', system-ui;">CVC</label>
                                <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="text" required>
                            </div>
            
                            <!-- Expiration Month -->
                            <div class="col-xs-12 col-md-4 form-group expiration required">
                                <label class="control-label" style="font-family: 'Coda', system-ui;">Expiration Month</label>
                                <input class="form-control card-expiry-month" placeholder="MM" size="2" type="text" required>
                            </div>
            
                            <!-- Expiration Year -->
                            <div class="col-xs-12 col-md-4 form-group expiration required">
                                <label class="control-label" style="font-family: 'Coda', system-ui;">Expiration Year</label>
                                <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="text" required>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert alert-danger'>Please correct the errors and try again.</div>
                            </div>
                        </div>
                        

                        <!-- Submit Button -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-primary w-full p-2 shadow-none btn-block" type="submit">Pay Now (${{ $totalprice }})</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            
            
        </div>
    </section>
@endsection
@section('script')
    {{-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    {{-- <script>
        $(function() {


            /*------------------------------------------

            --------------------------------------------

            Stripe Payment Code

            --------------------------------------------

            --------------------------------------------*/

            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });



            /*------------------------------------------

            --------------------------------------------

            Stripe Response Handler

            --------------------------------------------

            --------------------------------------------*/

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error').removeClass('hide').find('.alert').text(response.error.message);

                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();

                }
            }
        });
    </script> --}}
    <script>
    // Make sure the Stripe script is loaded
    $(function () {
    var $form = $(".require-validation");

    $('form.require-validation').on('submit', function (e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('.error'),
            valid = true;

        // Always hide the error message initially
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');

        // Check required inputs for empty values
        $inputs.each(function (i, el) {
            var $input = $(el);
            if ($input.val().trim() === '') {
                $input.parent().addClass('has-error');
                valid = false;
            }
        });

        // Show error message if any validation fails
        if (!valid) {
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }

        // If Stripe token isn't already set, generate a new one
        if (!$form.data('cc-on-file') && valid) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));

            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });

    // Stripe response handler
    function stripeResponseHandler(status, response) {
        var $form = $(".require-validation");

        if (response.error) {
            $('.error').removeClass('hide').find('.alert-danger').text(response.error.message);
        } else {
            var token = response.id;
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});

</script>

@endsection

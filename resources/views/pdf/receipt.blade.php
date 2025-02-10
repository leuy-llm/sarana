<style>
    body {
        background-color: white !important;
        font-family: 'Oswald', sans-serif;
    }

    /* .confirmation-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            margin: 4rem auto;
            max-width: 800px;
        }

        .alert-center {
            max-width: 800px;
            margin: 4rem auto;
        }

        .booking-header {
            background-color: #f8f9fa;
            padding: 2rem;
            border-bottom: 1px solid #dee2e6;
            position: relative;
        }

        .booking-header h3 {
            font-family: 'Oswald', sans-serif;
        }

        .booking-body {
            padding: 2rem;
        }

        .booking-detail {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-label .detail-value {
            color: #212529;
            font-weight: 500;
            font-family: 'Oswald', sans-serif;
            /* margin-top: 0.3rem; */


    /* .detail-value.price {
                    font-size: 2rem;
                } */

    .transaction-id {
        font-family: monospace;
        background-color: #f8f9fa;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-size: 0.9rem;
        display: inline-block;
    }







    /* Print Styles */

    .booking-header {
        border: none;
    }

    .container {
        width: 100%;
        max-width: 100%;
        padding: 0;
        margin: 0;
    }

    .print {
        font-family: 'Oswald', sans-serif;
        font-weight: 300;
        font-size: 20px;
    }

    .no-print {
        display: none !important;
    }

    .print-only {
        display: block !important;
    }

    .print-only h2 {
        font-family: 'Oswald', sans-serif;
        font-size: 30px;
        /* font-weight: 200; */
    }

    .print-only p {
        font-family: 'Oswald', sans-serif;
        font-weight: 400;
        font-size: 20px;
    }

    .confirmation-card {
        box-shadow: none !important;
        border: none !important;
    }

    .booking-detail .detail-label {
        font-family: 'Oswald', sans-serif;
        font-weight: 400;
        font-size: 20px;
    }

    .booking-detail .detail-value {
        font-family: 'Oswald', sans-serif;
        font-weight: 400;
        font-size: 20px;
    }

    .print-header {
        text-align: center;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .print-footer {
        text-align: center;
        font-size: 1rem;
        margin-bottom: 1rem;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;

    }

    .page-number::after {
        content: counter(page);
    }

    .print-logo {
        width: 150px;
        height: auto;
    }

    .detail-value.price {
        font-size: 1.3rem;
    }
</style>

<!-- Print Only Elements -->
<div class="print-only" style="display: none;">
    <div class="print-header">
        <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
            alt="Hotel Logo" class="print-logo">
        <h2 style="font-family: 'Oswald', sans-serif;">Sinaka Angkor Hotel</h2>
        @foreach($contact as $contact)
        <p>{{ $contact->address }}</p>
        <p>Tel: {{ $contact->pn1 }} | {{ $contact->pn2 }} | {{ $contact->pn3 }} </p>
        
        <p>{{ $contact->email }}</p>
        @endforeach
    </div>

</div>
<!-- Success Header (Screen Only) -->
<div class="success-header no-print">

    <h1>Booking Confirmed!</h1>
    <p class="lead" style="color: #fff;font-family: 'Sail', system-ui;font-size: 25px;">
        Your reservation has been successfully processed
    </p>
</div>
<!-- Main Content -->
<div class="container">
    <div class="alert-center no-print">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show alert-center"
                role="alert">
                <strong>
                    <i class="bi bi-check-all mr-2"></i>
                </strong>
                {{ session('success') }}
                <button type="button" class="close btn-close shadow-none border-0" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show alert-center"
                role="alert">
                <strong>
                    <i class="bi bi-exclamation-triangle mr-2"></i>
                </strong>
                {{ session('error') }}
                <button type="button" class="close btn-close shadow-none border-0" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="confirmation-card">
        <div class="booking-header mt-3">
            <div class="row align-items-center justify-content-end">
                <div class="col-md-12">
                    <h3 class="mb-2">Booking Confirmation</h3>
                    <div class=" mb-2 print">Transaction ID: {{ $data['payment_intent_id'] }}</div>
                </div>

            </div>
        </div>
        <div class="booking-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="booking-detail">
                        <div class="detail-label">Full Name :
                            <span class="detail-value">{{ $data['first_name'] }} {{ $data['last_name'] }}</span>
                        </div>
                    </div>
                    <div class="booking-detail">
                        <div class="detail-label">Email : <span class="detail-value">{{ $data['email'] }}</span></div>
                    </div>
                    <div class="booking-detail">
                        <div class="detail-label">Phone : <span class="detail-value">{{ $data['mobile'] }}</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="booking-detail">
                        <div class="detail-label">Room Type : <span class="detail-value">
                                {{ implode(', ', $data['room_types']) }}</span></div>
                    </div>
                    <div class="booking-detail">
                        <div class="detail-label">Check In/Out : <span class="detail-value">
                                {{ date('d-m-y', strtotime($data['check_in_date'])) }} -
                                {{ date('d-m-y', strtotime($data['check_out_date'])) }}</span>
                        </div>
                    </div>
                    <div class="booking-detail">
                        <div class="detail-label">Guests : <span class="detail-value">
                                {{ $data['total_adults'] }} Adults
                                {{ $data['total_children'] }} Children</span></div>
                    </div>
                </div>
            </div>
            <!-- Payment Information -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="booking-detail">
                        <div class="detail-label">Payment Method : <span class="detail-value">Stripe</span> </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="booking-detail">
                        <div class="detail-label">Total Price : <span
                                class="detail-value price ">${{ number_format($data['amount'], 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="print-only" style="display: none;">
    <div class="print-footer">
        <p class="mb-1">Generated on: <span id="print-date">{{ date('d-m-Y') }}</span></p>
        <p class="mb-1">Page <span class="page-number"></span></p>
    </div>
</div>
</div>

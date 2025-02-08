@extends('layout.master')

@section('style')
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Oswald', sans-serif;
        }

        .confirmation-card {
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
        }

        .transaction-id {
            font-family: monospace;
            background-color: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            display: inline-block;
        }

        .success-header {
            text-align: center;
            padding: 3rem 0;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://d.newsweek.com/en/full/2144365/hotel-room.jpg?w=1200&f=a8f5a5c3d86878a3049329d47508e650');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .success-header h1 {

            color: white;
            font-weight: 700;
            font-family: 'Sail', system-ui;
            font-size: 70px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background-color: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .qr-code {
            text-align: center;
            margin: 2rem 0;
        }

        .qr-code img {
            width: 100px;
            height: 100px;
        }

        /* Print Styles */
        @media print {
            @page {
                size: A4;

            }

            body {
                background-color: white !important;
                font-family: 'Oswald', sans-serif;
                font-weight: 200;
            }

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

            .print-header,
            .print-footer {
                text-align: center;
                font-size: 1rem;
                margin-bottom: 1rem;

            }

            .print-logo {
                width: 150px;
                height: auto;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Print Only Elements -->
    <div class="print-only" style="display: none;">
        <div class="print-header">
            <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                alt="Hotel Logo" class="print-logo">
            <h2 style="font-family: 'Oswald', sans-serif;">Sinaka Angkor Hotel</h2>
            <p>123 Paradise Street, Wonderland</p>
            <p>Tel: +1 234 567 890 | Email: contact@luxuryhotel.com</p>
        </div>

    </div>
    <!-- Success Header (Screen Only) -->
    <div class="success-header no-print">
        {{-- <div class="success-icon">
            <i class="fas fa-check" style="color: white; font-size: 2rem;"></i>
        </div> --}}
        <h1>Booking Confirmed!</h1>

        <p class="lead" style="color: #fff;font-family: 'Sail', system-ui;font-size: 25px;">
            Your reservation has been successfully processed
        </p>
    </div>
    <!-- Main Content -->
    <div class="container">
        <div class="alert-center">
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

                    <div class="col-md-6">
                        <h3 class="mb-2">Booking Confirmation</h3>
                        <div class=" mb-2 print">Transaction ID: pi_3QqF5KCtdzaqHN410I5IhVBM</div>

                    </div>
                    <div class="col-md-6 text-md-end text-right mt-3 mt-md-0 no-print">
                        <button class="btn btn-outline-primary shadow-none me-2" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>Print
                        </button>
                        <button class="btn btn-primary shadow-none">
                            <i class="fas fa-download me-2"></i>Download PDF
                        </button>
                    </div>
                </div>
            </div>

            <div class="booking-body">
                <!-- Guest Information -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="booking-detail">
                            <div class="detail-label">Full Name :
                                <span class="detail-value">Luke Johnson</span>
                            </div>
                            {{-- <div class="detail-value">Luke Johnson</div> --}}
                        </div>
                        <div class="booking-detail">
                            <div class="detail-label">Email : <span class="detail-value">leuylom022@gmail.com</span></div>
                            {{-- <div class="detail-value">leuylom022@gmail.com</div> --}}
                        </div>
                        <div class="booking-detail">
                            <div class="detail-label">Phone : <span class="detail-value">+0975894546</span></div>
                            {{-- <div class="detail-value">+0975894546</div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="booking-detail">
                            <div class="detail-label">Room Type : <span class="detail-value">Trip Room, Family 3
                                    bedroom</span></span></div>
                            {{-- <div class="detail-value">Trip Room, Family 3 bedroom</div> --}}
                        </div>
                        <div class="booking-detail">
                            <div class="detail-label">Check In/Out : <span class="detail-value">19-02-25 → 20-02-25</span>
                            </div>
                            {{-- <div class="detail-value">19-02-25 → 20-02-25</div> --}}
                        </div>
                        <div class="booking-detail">
                            <div class="detail-label">Guests : <span class="detail-value"> 2 Adults, 0 Children</span></div>
                            {{-- <div class="detail-value">2 Adults, 0 Children</div> --}}
                        </div>
                    </div>
                </div>
                <!-- Payment Information -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="booking-detail">
                            <div class="detail-label">Payment Method : <span class="detail-value">Stripe</span> </div>
                            {{-- <div class="detail-value">Stripe</div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="booking-detail">
                            <div class="detail-label">Total Price : <span class="detail-value"
                                    style="color: #28a745; font-size: 1rem; font-weight: bold;">$400.00</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center align-items-center" style="margin-bottom: 150px;">
            <a href="{{ route('homepage') }}" class="btn btn-warning py-2 px-4 text-white shadow-none text-center no-print">Return
                Home</a>
        </div>
    </div>
    <!-- Print Footer -->
    <div class="print-only" style="display: none;">
        <div class="print-footer">
            <p class="mb-1">Generated on: <span id="print-date"></span></p>
            <p class="mb-1">Page <span class="page-number"></span></p>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Set current date/time in print footer
        document.getElementById('print-date').textContent = new Date().toLocaleString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

        // Handle print events
        window.onbeforeprint = function() {
            // Any preparations before printing
        };

        window.onafterprint = function() {
            // Any cleanup after printing
        };
    </script>
@endsection

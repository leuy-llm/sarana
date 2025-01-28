<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sinaka Angkor Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
        @import url("https://fonts.googleapis.com/css2?family=Coda:wght@400;800&display=swap");

        body {
            font-family: 'Coda', system-ui;
            background-color: #f8f9fa;
            background-image: url('{{ asset('admin_dashboard') }}/assets/images/login/login.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .register-container {
            max-width: 800px;
            margin: 30px auto;
            display: flex;
            flex-wrap: wrap;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.9);
        }

        .register-left {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            flex: 1;
        }

        .register-left img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .register-left h1 {
            font-size: 18px;
            margin: 0;
        }

        .register-right {
            padding: 20px;
            flex: 2;
        }

        .register-right h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-control {
            font-size: 14px;
        }

        label {
            font-size: 14px;
        }

        .btn {
            font-size: 14px;
            padding: 10px;
        }

        ::placeholder {
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .register-left {
                display: none;
            }

            .register-container {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .register-right h2 {
                font-size: 20px;
            }

            .btn {
                font-size: 12px;
            }

            label {
                font-size: 12px;
            }

            .form-control {
                font-size: 12px;
            }
        }

        button:before {
            background: red;
            height: 150px;
            width: 200px;
            top: 100%;
            left: 100%;
            transition: all 0.7;
        }

        button::hover::before {
            top: -30px;
            left: -30px;
        }

        button:active::before {
            background: yellow;
            transition: background 0s;
        }
    </style>
</head>

<body>
    <div class="register-container d-flex flex-md-row flex-column">
        <div class="register-left d-md-flex align-items-center flex-column d-none">
            <img src="{{ asset('admin_dashboard') }}/assets/images/logo1.png" alt="Sinaka Angkor Hotel Logo">
            <h1 class="mt-2">SINAKA ANGKOR HOTEL</h1>
        </div>
        <div class="register-right ">
            <h2 class="text-center">Register as Guest</h2>
            <form method="POST" action="{{ route('register') }}" class="needs-validation" id="registerForm">
                @csrf
                <div class="d-flex flex-md-row flex-column gap-1 mb-1 py-1">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" value="{{ old('first_name') }}" name="first_name"
                            class="form-control shadow-none rounded-none" style="border-radius: 0"
                            placeholder="Enter your first name" required>
                    </div>
                    <div class="col-md-6 ">
                        <label for="fullName" class="form-label">Last name</label>
                        <input type="text" value="{{ old('last_name') }}" name="last_name"
                            class="form-control shadow-none rounded-none" style="border-radius: 0"
                            placeholder="Enter your last name" required>
                    </div>

                </div>
                <div class="d-flex flex-md-row flex-column gap-1 mb-1 py-1">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email"
                            class="form-control shadow-none @error('email') is-invalid @enderror"
                            style="border-radius: 0" placeholder="Enter your email" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" value="{{ old('mobile') }}" name="mobile"
                            class="form-control shadow-none @error('mobile') is-invalid @enderror"
                            style="border-radius: 0" placeholder="Enter your phone number" required>
                        @error('mobile')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                </div>

                <div class="d-flex flex-md-row flex-column gap-1 mb-1 py-1">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address"
                            class="form-control shadow-none @error('address') is-invalid @enderror"
                            style="border-radius: 0" placeholder="Enter your address" required>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">City</label>
                        <input type="text" value="{{ old('city') }}" name="city"
                            class="form-control shadow-none @error('city') is-invalid @enderror"
                            style="border-radius: 0" placeholder="Enter your city" required>
                        @error('city')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-md-row flex-column gap-1 mb-1 py-1">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Country</label>
                        <input type="text" name="country"
                            class="form-control shadow-none @error('country') is-invalid @enderror"
                            style="border-radius: 0" placeholder="Enter your country" required>
                        @error('country')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Zip</label>
                        <input type="text" value="{{ old('zip') }}" name="zip"
                            class="form-control shadow-none @error('zip') is-invalid @enderror" style="border-radius: 0"
                            placeholder="Enter your zip" required>
                        @error('zip')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-1 py-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" style="border-radius: 0"
                        class="form-control shadow-none @error('password') is-invalid @enderror"
                        placeholder="Enter your password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2 py-2">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" style="border-radius: 0"
                        class="form-control shadow-none @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" placeholder="Confirm your password" required>
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100" id="previewButton"><i
                        class="bi bi-person-plus"></i> Sign up</button>
                <div class="d-flex justify-content-between mt-1">
                    <a href="{{ route('guest.logins') }}?redirect={{ request()->input('redirect', url()->current()) }}"
                        class="d-block text-center mt-2">
                        Already have an account? <span class="text-primary">Sign in</span>
                    </a>
                    <a href="{{ route('homepage') }}" class="btn border-0 px-4 btn-outline-secondary "
                        style="font-size: 12px;">
                        <i class="bi bi-arrow-90deg-left me-2 font-weight-bold"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="confirmationModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #d7b661;color: white;">
                    <h5 class="modal-title text-white" id="confirmationModalLabel">Confirm Your Information</h5>
                    <button type="button" class="btn-close shadow-none text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please confirm that all the information entered is correct before submitting the form. Once
                        submitted, the information will be registered, and it cannot be changed. If any information is
                        incorrect, please make sure to correct it before confirming.</p>
                    <p><strong>Important:</strong></p>
                    <ul>
                        <li>Ensure your email address is valid as it will be used for communication.</li>
                    </ul>
                    <p>Once you confirm, your information will be permanently submitted, and no further changes can be
                        made to the registration details.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn text-white" style="background: #d7b661"
                        id="submitForm">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            // Prevent the form from being submitted immediately
            e.preventDefault();

            // Show the modal without displaying form data
            $('#confirmationModal').modal('show');
        });

        // When the "Confirm" button is clicked, submit the form
        document.getElementById('submitForm').addEventListener('click', function() {
            // Submit the form programmatically
            document.getElementById('registerForm').submit();
        });
    </script>
</body>

</html>

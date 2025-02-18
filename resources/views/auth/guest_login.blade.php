<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Sinaka Angkor Hotel</title>
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

        .signin-container {
            max-width: 500px;
            margin: 70px auto;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.9);
        }

        .signin-left {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .signin-left img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .signin-left h1 {
            font-size: 18px;
            margin: 0;
        }

        .signin-right {
            padding: 20px;
        }

        .signin-right h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-control {
            font-size: 14px;
        }

        .btn {
            font-size: 14px;
            padding: 10px;
        }

        ::placeholder {
            font-size: 12px;
        }

        @media (min-width: 768px) {
            .signin-container {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .signin-right h2 {
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
    </style>
</head>

<body>
    <div class="signin-container">
        <div class="signin-left d-flex align-items-center flex-column text-center">
            <img src="{{ asset('admin_dashboard') }}/assets/images/logo1.png" alt="Sinaka Angkor Hotel Logo">
            <h1 class="mt-2">SINAKA ANGKOR HOTEL</h1>
        </div>
        <div class="signin-right mt-4">
            {{-- <h2 class="text-center">Sign in as Guest</h2> --}}
            <form method="POST" action="{{ route('guest.login') }}" class="">
                @csrf
                <input type="hidden" name="redirect" value="{{ request('redirect', url()->previous()) }}">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-1 py-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" autocomplete="off" id="email" name="email"
                        class="form-control py-2 shadow-none " style="border-radius: 0" placeholder="Enter your email"
                        required>
                </div>
                <div class="mb-2 py-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" autocomplete="off" name="password" id="password" style="border-radius: 0"
                        class="form-control py-2 shadow-none" placeholder="Enter your password" required>
                    <i class="bi bi-eye-slash position-absolute end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;top:69px;"></i>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-lock"></i> Sign in</button>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('register.guest') }}" class="d-block text-center mt-2">Don't have an account?
                        <span class="text-primary">Sign up</span></a>
                    <a href="{{ route('homepage') }}" class="btn px-4 btn-outline-secondary border-0"
                        style="font-size: 12px;">
                        <i class="bi bi-arrow-90deg-left me-2 font-weight-bold"></i> Back
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Toggle the eye icon
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>

</html>
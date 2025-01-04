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
            background: url('https://images.pexels.com/photos/189333/pexels-photo-189333.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')
        }

        .register-container {
            max-width: 800px;
            margin: 70px auto;
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
    </style>
</head>

<body>
    <div class="register-container d-flex flex-md-row flex-column">
        <div class="register-left d-md-flex align-items-center flex-column d-none">
            <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                alt="Sinaka Angkor Hotel Logo">
            <h1 class="mt-2">SINAKA ANGKOR HOTEL</h1>
        </div>
        <div class="register-right">
            <h2 class="text-center">Sign in as Guest</h2>
            <form method="POST" action="{{ route('guest.login') }}" class="">
                @csrf
                <input type="hidden" name="redirect" value="{{ request('redirect', url()->previous()) }}">
                <!-- Display success or error messages -->
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
                        class="form-control py-2 shadow-none "
                        style="border-radius: 0" placeholder="Enter your email" required>
                </div>
                <div class="mb-2 py-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" autocomplete="off" name="password" id="password" style="border-radius: 0"
                        class="form-control py-2 shadow-none"
                        placeholder="Enter your password" required>
                    
                </div>

                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-lock"></i> Sign in</button>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('register') }}" class="d-block text-center mt-2">Don't have an account? <span
                            class="text-primary">Sign up</span></a>
                    <a href="{{ route('homepage') }}" class="btn px-4 btn-outline-secondary border-0"
                        style="font-size: 12px;">
                        <i class="bi bi-arrow-90deg-left me-2 font-weight-bold"></i> Back
                    </a>
                </div>

            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
{{-- <!DOCTYPE html>
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
            background: url('https://images.pexels.com/photos/189333/pexels-photo-189333.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
        }

        .register-container {
            max-width: 800px;
            margin: 50px auto;
            display: flex;
            flex-wrap: nowrap;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background: white;
            position: relative;
            transition: transform 0.6s ease-in-out;
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
            width: 100%;
            transition: transform 0.6s ease-in-out;
        }

        .form-control {
            font-size: 14px;
            
        }

        .btn {
            font-size: 14px;
            padding: 10px;
        }

        .hidden {
            display: none;
        }

        .slide-left {
            transform: translateX(-100%);
        }

        .register-right.slide-to-sign-in {
            transform: translateX(0%);
        }

        .register-right.slide-to-register {
            transform: translateX(10);
        }

        ::placeholder {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-left">
            <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                alt="Sinaka Angkor Hotel Logo">
            <h1 class="mt-2">SINAKA ANGKOR HOTEL</h1>
        </div>
        <div class="register-right" id="form-container">
            <h2 class="text-center" id="form-title">Register as Guest</h2>
            <form method="POST" action="{{ route('register') }}" class="" id="register-form">
                @csrf
                <div class="mb-1 py-1">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" value="{{old('name')}}" id="fullName" name="name" class="form-control py-2 shadow-none rounded-none"
                        style="border-radius: 0" placeholder="Enter your full name" required>
                </div>
                <div class="mb-1 py-1">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control py-2 shadow-none @error('email') is-invalid @enderror"
                        style="border-radius: 0" placeholder="Enter your email" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-1 py-1">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" value="{{old('mobile')}}" id="phone" name="mobile" class="form-control py-2 shadow-none @error('mobile') is-invalid @enderror"
                        style="border-radius: 0" placeholder="Enter your phone number" required>
                    @error('mobile')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-1 py-1">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" class="form-control py-2 shadow-none @error('address') is-invalid @enderror" style="border-radius: 0"
                        placeholder="Enter your address" rows="2" required>{{old('address')}}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-1 py-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" style="border-radius: 0" class="form-control py-2 shadow-none @error('password') is-invalid @enderror" 
                    placeholder="Enter your password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-2 py-2">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password"  style="border-radius: 0" id="confirmPassword"
                        class="form-control py-2 shadow-none @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                        placeholder="Confirm your password" required>
                        @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign up</button>
            </form>
            
            <form method="POST" action="{{ route('login') }}" id="login-form" class="hidden">
                @csrf
               
                <div class="mb-2 py-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control py-2 shadow-none @error('email') is-invalid @enderror"
                        style="border-radius: 0" placeholder="Enter your email" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 py-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" style="border-radius: 0" class="form-control py-2 shadow-none @error('password') is-invalid @enderror" 
                    placeholder="Enter your password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Sign In</button>
            </form>
            <div class="d-flex justify-content-between align-items-center mt-1">
                <button id="toggle-button" class="btn btn-link mt-2">Already have an account? <span class="text-primary">Sign in</span></button>
                <a href="{{ route('homepage') }}" class="btn px-4 btn-outline-secondary " style="font-size: 12px;">
                    <i class="bi bi-arrow-90deg-left me-2 font-weight-bold"></i> Back 
                </a>
               
            </div>
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('toggle-button');
        const registerForm = document.getElementById('register-form');
        const loginForm = document.getElementById('login-form');
        const formTitle = document.getElementById('form-title');
        const formContainer = document.getElementById('form-container');

        toggleButton.addEventListener('click', () => {
            if (registerForm.classList.contains('hidden')) {
                // Switch to Register
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                formTitle.textContent = 'Register as Guest';
                toggleButton.innerHTML = `Already have an account? <span class="text-primary">Sign in</span>`;
                formContainer.classList.remove('slide-to-sign-in');
                formContainer.classList.add('slide-to-register');
            } else {
                // Switch to Sign In
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                formTitle.textContent = 'Sign In';
                toggleButton.innerHTML = `Don't have an account? <span class="text-primary">Sign up</span>`;
                formContainer.classList.remove('slide-to-register');
                formContainer.classList.add('slide-to-sign-in');
            }
        });
    </script>
</body>

</html> --}}

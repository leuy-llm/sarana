{{-- 
<div class="container">
    <h1>Email Verification</h1>
    <p>A verification link has been sent to your email address. Please check your inbox.</p>
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>
</div> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="styles.css">
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Coda:wght@400;800&display=swap");
        body {
            background: linear-gradient(90deg, #007bff 50%, #f8f9fa 50%);
            font-family: 'Coda', sans-serif;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            
        }

        .card {
            border: none;
        }

        button {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        @guest
        <div class="card shadow-lg p-4 text-center" style="max-width: 500px; border-radius: 12px;">
            <div class="text-center mb-3">
                <img src="https://i.pinimg.com/736x/03/54/58/035458bcabe26060e9deaab70de70ce8.jpg" alt="Logo"
                    style="width: 200px;"> 
            </div>
            <h4 class="fw-bold">Verify your email</h4>
            <p class="text-muted">You're in. An email has been sent to <strong>{{$guest->email}}</strong>. Hit
                confirm and you'll be ready to start working.</p>
            <p class="text-muted">Didn’t see an email?</p>
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary w-100 mb-3">Resend Verification Email</button>
            </form>
            <a href="{{ route('register') }}" class="text-decoration-none d-block" id="backToSignIn">← Back to sign in</a>
        </div>
        @else
        <div class="card shadow-lg p-4 text-center" style="max-width: 500px; border-radius: 12px;">
            <div class="text-center mb-3">
                <img src="https://i.pinimg.com/736x/03/54/58/035458bcabe26060e9deaab70de70ce8.jpg" alt="Logo"
                    style="width: 200px;"> 
            </div>
            <h4 class="fw-bold">You're already logged in</h4>
            <p class="text-muted">You have already logged in, no need for email verification.</p>
            <a href="{{url('/')}}" class="btn btn-primary w-100 mb-3">Back to Home</a>
        </div>
        @endguest
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

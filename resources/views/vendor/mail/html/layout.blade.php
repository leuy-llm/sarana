<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background: white;
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .email-header {
            background-color: #0066cc;
            padding: 20px;
            text-align: center;
        }
        .email-header img {
            max-width: 150px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            margin: 0 0 10px;
        }
        .email-footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #555;
        }
        .email-footer a {
            color: #0066cc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('images/sinaka-logo.png') }}" alt="SINAKA ANGKOR HOTEL">
        </div>
        <div class="email-body">
            <h1>Welcome to SINAKA ANGKOR HOTEL</h1>
            <p>Thank you for registering with us! Please confirm your email address by clicking the button below.</p>
            <p>
                <a href="{{ $actionUrl }}" style="display: inline-block; background-color: #0066cc; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
                    Verify Email Address
                </a>
            </p>
            <p>If you did not create an account, no further action is required.</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 SINAKA ANGKOR HOTEL. All rights reserved.</p>
            <p><a href="{{ url('/') }}">Visit our website</a></p>
        </div>
    </div>
</body>
</html>

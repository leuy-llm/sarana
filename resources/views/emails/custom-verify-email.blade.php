{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email Address</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Coda&display=swap');
        body {
          font-family: "Coda", sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        body, h1, p, a {
        font-family: 'Coda', system-ui, sans-serif !important;
    }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          
           
        }

        .header {
            text-align: center;
           
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .content {
            margin: 20px 0;
           
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0066cc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: white;
            
        }

        a:hover {
            background-color: #005599;
        }
        
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                alt="SINAKA ANGKOR HOTEL">
        </div>
        <div class="content">
            <h1 style="text-align: center;">Verify Your Email Address</h1>
            <p>Thank you for registering with SINAKA ANGKOR HOTEL! To complete your registration, please verify your
                email address by clicking the button below.</p>
            <p>
                <a href="{{ $actionUrl }}" class="button" style="color: white;">Verify Email Address</a>
            </p>
            <p>If you did not create this account, no further action is required.</p>
        </div
                 <tr>
                    <td>
                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="content-cell" align="center" style="font-family: Arial, sans-serif; font-size: 12px; color: #777; padding: 20px;">
                                    <p>
                                        &copy; {{ date('Y') }} Sinaka Angkor Hotel. @lang('All rights reserved.')
                                    </p>
                                    <p>
                                        123 Hotel St., Siem Reap, Cambodia | +855 123 456 789
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email Address</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

        body {
            margin: 0;
            padding: 0;
            /* font-family: 'Roboto', sans-serif; */
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .email-container {
            max-width: 530px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            /* background-color: #0066cc; */
            background-color: #661f1f;
            text-align: center;
            padding: 20px;
        }

        .email-header img {
            max-width: 120px;
        }

        .email-content {
            padding: 30px 20px;
            text-align: center;
        }

        .email-content h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            line-height: 2;
        }

        .email-content p {
            color: #555;
            font-size: 16px;
            line-height: 2;
            margin-bottom: 20px;
        }

        .email-content a.button {
            display: inline-block;
            background-color: #661f1f;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .email-content a.button:hover {
            background-color: #005599;
        }

        .email-footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 15px 20px;
            font-size: 12px;
            color: #777;
        }

        .email-footer p {
            margin: 5px 0;
        }

        .email-footer a {
            color: #0066cc;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                alt="SINAKA ANGKOR HOTEL">
        </div>

        <!-- Content Section -->
        <div class="email-content">
            <h1>Verify Your Email Address</h1>
            <p>Thank you for registering with SINAKA ANGKOR HOTEL! To complete your registration, please verify your
                email address by clicking the button below.</p>
            <a href="{{ $actionUrl }}" class="button">Verify Email Address</a>
            <p>If you did not create this account, no further action is required.</p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Sinaka Angkor Hotel. All rights reserved.</p>
            <p>123 Hotel St., Siem Reap, Cambodia | +855 93 76 66 42| +855 89 570 589 | +855 89 570 589</p>
            <p><a href="{{ url('/') }}">Visit our website</a> | <a href="mailto:info@sinakaangkorhotel.com">Contact
                    us</a></p>
        </div>
    </div>
</body>

</html>

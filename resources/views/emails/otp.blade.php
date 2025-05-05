<!-- emails.otp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #22c55e;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 0 0 5px 5px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .otp-box {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin: 15px 0;
            font-size: 24px;
            letter-spacing: 5px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            background-color: #22c55e;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Verification Code</h1>
        </div>
        <div class="content">
            <p>Hello {{ $name }},</p>
            <p>You recently registered for an account. Please use the verification code below to complete your registration:</p>
            
            <div class="otp-box">
                {{ $otp }}
            </div>
            
            <p>This code will expire in 10 minutes. If you did not request this code, please ignore this email.</p>
            
            <p>Once verified, you can access your account using the link below:</p>
            <div style="text-align: center;">
                <a href="{{ $link }}" class="button">Go to Login</a>
            </div>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; 2025 Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
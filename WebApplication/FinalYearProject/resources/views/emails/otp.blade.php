<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .otp-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #604BB0;
            letter-spacing: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Email Verification</h2>
    </div>

    <p>Dear {{ $name }},</p>

    <p>Thank you for registering with Fundus Disease Analysis. To complete your registration, please use the following OTP to verify your email address:</p>

    <div class="otp-container">
        <div class="otp-code">{{ $otp }}</div>
    </div>

    <p>This OTP will expire in 10 minutes. If you did not request this verification, please ignore this email.</p>

    <p>Best regards,<br>Fundus Disease Analysis Team</p>

    <div class="footer">
        <p>This is an automated message, please do not reply to this email.</p>
    </div>
</body>
</html> 
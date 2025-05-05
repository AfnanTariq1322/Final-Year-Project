<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #604BB0;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 10px 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-approved { background: #d4edda; color: #155724; }
        .status-completed { background: #cce5ff; color: #004085; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Appointment Status Update</h2>
        </div>
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            
            <p>Your appointment with Dr. {{ $doctor->name }} has been updated.</p>
            
            <div class="appointment-details">
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</p>
                <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                <p><strong>New Status:</strong> 
                    <span class="status-badge status-{{ $appointment->status }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </p>
            </div>

            <p>If you have any questions, please contact the doctor's office directly.</p>

            <p>Best regards,<br>
            Fundus Disease Analysis Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html> 
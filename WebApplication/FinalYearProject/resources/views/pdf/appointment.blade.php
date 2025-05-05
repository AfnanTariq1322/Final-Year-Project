<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #604BB0;
            position: relative;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 15px;
        }
        .header h1 {
            color: #604BB0;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            color: #666;
            margin: 5px 0 0;
            font-size: 14px;
        }
        .section {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .section-title {
            color: #604BB0;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 8px;
        }
        .info-row {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }
        .label {
            font-weight: bold;
            color: #666;
            width: 120px;
            flex-shrink: 0;
        }
        .value {
            color: #333;
            flex-grow: 1;
        }
        .profile-section {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
        }
        .profile-card {
            flex: 1;
            text-align: center;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 10px;
            border: 3px solid #604BB0;
            object-fit: cover;
        }
        .profile-name {
            font-weight: bold;
            color: #604BB0;
            margin: 5px 0;
        }
        .profile-role {
            color: #666;
            font-size: 14px;
            margin: 0;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }
        .receipt-section {
            text-align: center;
            margin-top: 20px;
        }
        .receipt-image {
            max-width: 300px;
            margin: 20px auto;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 5px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        .status-confirmed {
            background: #cce5ff;
            color: #004085;
        }
        .notes-section {
            background: #fff;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/newicon.png') }}" alt="Logo" class="logo">
        <h1>Appointment Details</h1>
        <p>Fundus Disease Analysis System</p>
    </div>

    <div class="profile-section">
        <div class="profile-card">
            <img src="{{ $appointment->user->image ? storage_path('app/public/' . $appointment->user->image) : public_path('img/user-avatar.png') }}" 
                 alt="Patient" class="profile-image">
            <h3 class="profile-name">{{ $appointment->user->name }}</h3>
            <p class="profile-role">Patient</p>
        </div>
        <div class="profile-card">
            <img src="{{ $appointment->doctor->profile_image ? storage_path('app/public/' . $appointment->doctor->profile_image) : public_path('img/doctor-avatar.png') }}" 
                 alt="Doctor" class="profile-image">
            <h3 class="profile-name">Dr. {{ $appointment->doctor->name }}</h3>
            <p class="profile-role">{{ $appointment->doctor->specialization }}</p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Patient Information</div>
        <div class="info-row">
            <span class="label">Name:</span>
            <span class="value">{{ $appointment->user->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Email:</span>
            <span class="value">{{ $appointment->user->email }}</span>
        </div>
        <div class="info-row">
            <span class="label">Phone:</span>
            <span class="value">{{ $appointment->user->phone ?? 'Not provided' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Address:</span>
            <span class="value">{{ $appointment->user->address ?? 'Not provided' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Appointment Details</div>
        <div class="info-row">
            <span class="label">Date:</span>
            <span class="value">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Time:</span>
            <span class="value">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Status:</span>
            <span class="value">
                {{ ucfirst($appointment->status) }}
                <span class="status-badge status-{{ $appointment->status }}">
                    {{ ucfirst($appointment->status) }}
                </span>
            </span>
        </div>
        <div class="info-row">
            <span class="label">Reason:</span>
            <span class="value">{{ $appointment->reason }}</span>
        </div>
    </div>

    @if($appointment->notes)
    <div class="section">
        <div class="section-title">Doctor's Notes</div>
        <div class="notes-section">
            {{ $appointment->notes }}
        </div>
    </div>
    @endif

    @if($appointment->payment_receipt)
    <div class="section">
        <div class="section-title">Payment Receipt</div>
        <div class="receipt-section">
            <img src="{{ storage_path('app/public/' . $appointment->payment_receipt) }}" 
                 alt="Payment Receipt" class="receipt-image">
        </div>
    </div>
    @endif

    <div class="footer">
        <p>Generated on {{ now()->format('F d, Y h:i A') }}</p>
        <p>This is an official document from Fundus Disease Analysis System</p>
        <p>For any queries, please contact our support team</p>
    </div>
</body>
</html> 
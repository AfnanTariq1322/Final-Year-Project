<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 40px;
            color: #333;
            background-color: #f9f9f9;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #604BB0;
            padding-bottom: 20px;
            position: relative;
        }
        .header h1 {
            color: #604BB0;
            font-size: 32px;
            margin: 0;
            font-weight: 700;
        }
        .header p {
            color: #666;
            margin: 10px 0;
            font-size: 16px;
        }
        .receipt-number {
            position: absolute;
            top: 0;
            right: 0;
            background: #604BB0;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .section {
            margin-bottom: 35px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #eee;
        }
        .section-title {
            color: #604BB0;
            font-size: 22px;
            margin-bottom: 20px;
            border-bottom: 2px solid #604BB0;
            padding-bottom: 10px;
            font-weight: bold;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #604BB0;
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
        }
        .value {
            color: #333;
            font-size: 16px;
        }
        .doctor-image {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }
        .doctor-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #604BB0;
            object-fit: cover;
            box-shadow: 0 0 20px rgba(96, 75, 176, 0.2);
        }
        .doctor-image p {
            margin-top: 15px;
            font-weight: bold;
            color: #604BB0;
            font-size: 16px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 25px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }
        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(96, 75, 176, 0.03);
            z-index: -1;
            white-space: nowrap;
        }
        .payment-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }
        .payment-details .label {
            color: #155724;
        }
        .payment-receipt {
            text-align: center;
            margin: 40px 0;
            page-break-before: always;
        }
        .payment-receipt img {
            max-width: 100%;
            height: auto;
            border: 2px solid #604BB0;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .payment-receipt-title {
            color: #604BB0;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .important-note {
            margin: 40px 0;
            padding: 25px;
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 12px;
        }
        .important-note p {
            color: #856404;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="watermark">PAYMENT RECEIPT</div>
    <div class="container">
        <div class="header">
            <span class="receipt-number">Receipt #APT-{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</span>
            <h1>Payment Receipt</h1>
            <p>Fundus Image Analysis System</p>
        </div>

        <div class="doctor-image">
            @if($appointment->doctor->profile_image)
                <img src="{{ public_path('storage/' . $appointment->doctor->profile_image) }}" alt="Doctor">
            @else
                <img src="{{ public_path('images/default-doctor.png') }}" alt="Doctor">
            @endif
            <p>Dr. {{ $appointment->doctor->name }}</p>
        </div>

        <div class="section">
            <div class="section-title">Appointment Details</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Date</span>
                    <span class="value">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Time</span>
                    <span class="value">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Status</span>
                    <span class="status-badge status-confirmed">{{ ucfirst($appointment->status) }}</span>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Doctor Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Name</span>
                    <span class="value">Dr. {{ $appointment->doctor->name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Specialization</span>
                    <span class="value">{{ $appointment->doctor->specialization }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Contact</span>
                    <span class="value">{{ $appointment->doctor->contact_number }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $appointment->doctor->email }}</span>
                </div>
            </div>
        </div>

        @if($appointment->doctor->clinic_address)
        <div class="section">
            <div class="section-title">Clinic Location</div>
            <div class="info-item">
                <span class="label">Address</span>
                <span class="value">{{ $appointment->doctor->clinic_address }}</span>
            </div>
        </div>
        @endif

        <div class="footer">
            <p>This is a computer-generated receipt and does not require a signature.</p>
            <p>Generated on: {{ now()->format('F d, Y h:i A') }}</p>
            <p>© {{ date('Y') }} Fundus Image Analysis System. All rights reserved.</p>
        </div>

        <div class="important-note">
            <div class="section-title">Important Note</div>
            <p>Please bring this receipt with you when visiting our office for your appointment. This receipt serves as proof of your payment and appointment confirmation.</p>
        </div>

        @if($appointment->payment_receipt)
        <div class="payment-receipt">
            <div class="payment-receipt-title">Payment Receipt Image</div>
            <img src="{{ public_path('storage/' . $appointment->payment_receipt) }}" alt="Payment Receipt">
        </div>
        @endif
    </div>
</body>
</html> 
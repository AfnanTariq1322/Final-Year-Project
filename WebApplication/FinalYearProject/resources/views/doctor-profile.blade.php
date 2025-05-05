<!DOCTYPE html>
<html class="no-js" lang="ZXX">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Doctor Profile - {{ $doctor->name }}</title>

    <link rel="icon" href="../img/newicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/aos.min.css">
    <link rel="stylesheet" href="../css/font-awesome-all.min.css">
    <link rel="stylesheet" href="../css/swiper-slider.min.css">
    <link rel="stylesheet" href="../css/select2-min.css">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <link rel="stylesheet" href="../css/video-popup.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme-default.css') }}">
    <link rel="stylesheet" href="../style.css">
    <style>
        .doctor-profile {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .profile-image {
            width: 200px;
            height: 200px;
            margin: 0 auto 20px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .specialization-badge {
            background: #604BB0;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .profile-info p {
            margin-bottom: 15px;
            color: #666;
        }
        .profile-info i {
            color: #604BB0;
            width: 25px;
        }
        .availability-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .availability-day {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .appointment-form {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
        }
        .appointment-form h3 {
            color: #604BB0;
            margin-bottom: 25px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .form-control:focus, .form-select:focus {
            border-color: #604BB0;
            box-shadow: 0 0 0 0.2rem rgba(96, 75, 176, 0.25);
        }
        .btn-primary {
            background: #604BB0;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background: #4a3a8a;
        }
        .section-title {
            color: #604BB0;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #604BB0;
        }
        .sub-specialization-badge {
            background: #8a7ac9;
            color: white;
            padding: 6px 15px;
            border-radius: 15px;
            display: inline-block;
            font-size: 0.9rem;
            font-weight: 400;
        }
        .doctor-bio {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .doctor-bio h5 {
            color: #604BB0;
            margin-bottom: 10px;
        }
        .doctor-bio p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }
        .bank-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 15px;
        }
        
        .bank-details h5 {
            color: #604BB0;
            font-size: 18px;
            font-weight: 600;
            border-bottom: 2px solid #604BB0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .payment-option {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .payment-option h6 {
            color: #604BB0;
            font-size: 16px;
            font-weight: 600;
        }
        
        .payment-option p {
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }
        
        .payment-option i {
            color: #604BB0;
            width: 20px;
        }
        .profile-section-divider {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .profile-section-divider h5 {
            color: #604BB0;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .profile-section-divider h5 i {
            margin-right: 10px;
            color: #604BB0;
        }

        .bank-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .bank-detail-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .bank-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .bank-name {
            color: #604BB0;
            font-weight: 600;
            font-size: 15px;
        }

        .account-name {
            color: #666;
            font-size: 14px;
        }

        .account-number {
            color: #666;
            font-size: 14px;
            word-break: break-all;
        }

        .bank-details-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .bank-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .bank-detail-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .bank-detail-card:hover {
            transform: translateY(-5px);
        }

        .bank-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .bank-info span {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bank-name {
            color: #604BB0;
            font-weight: 600;
            font-size: 16px;
        }

        .account-name, .account-number {
            color: #666;
            font-size: 14px;
        }

        .bank-info i {
            color: #604BB0;
            width: 20px;
        }

        .map-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .map-container {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .map-container:hover {
            transform: scale(1.02);
        }
        
        .section-title {
            color: #604BB0;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
        }
        
        .btn-outline-primary {
            color: #604BB0;
            border-color: #604BB0;
        }
        
        .btn-outline-primary:hover {
            background-color: #604BB0;
            color: white;
        }

        .receipt-preview {
            display: none;
            margin-top: 10px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .receipt-preview img {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
        }
        
        .receipt-preview:hover {
            transform: scale(1.02);
        }
        
        .file-input-wrapper {
            position: relative;
            width: 100%;
        }
        
        .file-input-trigger {
            display: block;
            padding: 20px;
            background: #f8f9fa;
            border: 2px dashed #604BB0;
            border-radius: 8px;
            text-align: center;
            color: #604BB0;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-input-trigger:hover {
            background: #e9ecef;
            border-color: #4a3a8a;
        }
        
        .file-input-trigger i {
            font-size: 24px;
            margin-bottom: 8px;
        }
        
        .receipt-preview {
            display: none;
            margin-top: 10px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .receipt-preview img {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
        }
        
        .receipt-preview:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body>
    @include('includes.header')

    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
                <div class="object" id="object_five"></div>
            </div>
        </div>
    </div>

    <br><br><br>

    <section class="inflanar-section-shape inflanar-bg-cover pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="doctor-profile">
                        <div class="profile-image">
                            <img src="{{ asset('storage/' . ($doctor->profile_image ?? 'default-doctor.jpg')) }}" 
                                 alt="{{ $doctor->name }}">
                        </div>
                        <h2 class="text-center mb-3">{{ $doctor->name }}</h2>
                        <div class="specialization-badge text-center mb-2">
                            {{ $doctor->specialization }}
                        </div>
                        @if($doctor->sub_specialization)
                        <div class="sub-specialization-badge text-center mb-3">
                            {{ $doctor->sub_specialization }}
                        </div>
                        @endif
                        <div class="profile-info">
                            <p><i class="fas fa-graduation-cap"></i> {{ $doctor->qualifications }}</p>
                            <p><i class="fas fa-map-marker-alt"></i> {{ $doctor->clinic_address }}</p>
                            <p><i class="fas fa-phone"></i> {{ $doctor->contact_number }}</p>
                            <p><i class="fas fa-money-bill-wave"></i> Consultation Fee: Rs {{ number_format($doctor->consultation_fee, 0) }}</p>
                            <p><i class="fas fa-clock"></i> Experience: {{ $doctor->experience_years }} years</p>
                            
                            <div class="map-section mt-4">
                                <h5 class="section-title mb-3">Location</h5>
                                <div class="map-container" style="height: 300px; border-radius: 10px; overflow: hidden;">
                                    {!! $doctor->map !!} 
                                </div>
                                <div class="mt-3">
                                    <p class="mb-1"><i class="fas fa-map-marker-alt text-primary"></i> {{ $doctor->clinic_address }}</p>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($doctor->clinic_address) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-directions"></i> Get Directions
                                    </a>
                                </div>
                            </div>
                          
                            @if($doctor->bio)
                            <div class="doctor-bio mt-3">
                                <h5>About Doctor</h5>
                                <p>{{ $doctor->bio }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="availability-section">
                        <h3 class="section-title">Availability</h3>
                        <div class="row">
                            @php
                                $availability = json_decode($doctor->availability, true);
                                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                            @endphp
                            @foreach($days as $day)
                                @if($availability[$day]['enabled'])
                                    <div class="col-md-6">
                                        <div class="availability-day">
                                            <strong>{{ ucfirst($day) }}:</strong>
                                            {{ date('h:i A', strtotime($availability[$day]['start'])) }} - 
                                            {{ date('h:i A', strtotime($availability[$day]['end'])) }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if($doctor->bankdetails)
                        <div class="bank-details-section">
                            <h3 class="section-title">Bank Details</h3>
                            <div class="bank-details-grid">
                                @php
                                    $bankDetails = json_decode($doctor->bankdetails, true);
                                    \Log::info('Decoded Bank Details: ' . print_r($bankDetails, true));
                                @endphp
                                @if(is_array($bankDetails) && count($bankDetails) > 0)
                                    @foreach($bankDetails as $bank)
                                        <div class="bank-detail-card">
                                            <div class="bank-info">
                                                <span class="bank-name"><i class="fas fa-university"></i> {{ $bank['bank_name'] ?? 'N/A' }}</span>
                                                <span class="account-name"><i class="fas fa-user"></i> {{ $bank['account_name'] ?? 'N/A' }}</span>
                                                <span class="account-number"><i class="fas fa-credit-card"></i> {{ $bank['account_number'] ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No bank details available.</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="appointment-form">
                        <h3 class="section-title">Book Appointment</h3>
                        @if(!session('LoggedUserInfo'))
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Please <a href="{{ route('user.login') }}" class="alert-link">login</a> first to book an appointment.
                            </div>
                        @else
                            @php
                                $userId = session('LoggedUserInfo');
                                $user = \App\Models\User::find($userId);
                                $currentMonthStart = new DateTime('first day of this month');
                                $currentMonthEnd = new DateTime('last day of this month');
                                $monthlyAppointments = \App\Models\Appointment::where('user_id', $userId)
                                    ->where('doctor_id', $doctor->id)
                                    ->whereBetween('appointment_date', [$currentMonthStart, $currentMonthEnd])
                                    ->where('status', 'pending')
                                    ->count();
                            @endphp

                            @if($monthlyAppointments >= 4)
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Appointment Limit Reached</strong>
                                    <p class="mb-0 mt-2">You have 4 pending appointments with this doctor. Please wait for the doctor to confirm or reject them before booking more appointments.</p>
                                    <p class="mb-0">You can check your appointment status on your <a href="{{ route('user.dashboard') }}" class="alert-link">dashboard</a>.</p>
                                </div>
                            @else
                                <form id="appointmentForm" action="{{ route('appointment.request') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="appointment_date" class="form-label">Available Date</label>
                                            <select class="form-select" id="appointment_date" name="appointment_date" required>
                                                <option value="">Select Date</option>
                                                @php
                                                    $availability = json_decode($doctor->availability, true);
                                                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                                    $today = new DateTime();
                                                    $next30Days = new DateInterval('P30D');
                                                    $endDate = (clone $today)->add($next30Days);
                                                    
                                                    while ($today <= $endDate) {
                                                        $dayName = strtolower($today->format('l'));
                                                        if ($availability[$dayName]['enabled']) {
                                                            echo '<option value="' . $today->format('Y-m-d') . '">' . 
                                                                 $today->format('D, M d, Y') . '</option>';
                                                        }
                                                        $today->modify('+1 day');
                                                    }
                                                @endphp
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="appointment_time" class="form-label">Available Time</label>
                                            <select class="form-select" id="appointment_time" name="appointment_time" required>
                                                <option value="">Select Time</option>
                                                @php
                                                    $startTime = strtotime($availability[$dayName]['start']);
                                                    $endTime = strtotime($availability[$dayName]['end']);
                                                    $interval = 60 * 60; // 1 hour interval
                                                    
                                                    for ($time = $startTime; $time < $endTime; $time += $interval) {
                                                        echo '<option value="' . date('H:i', $time) . '">' . 
                                                             date('h:i A', $time) . '</option>';
                                                    }
                                                @endphp
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="reason" class="form-label">Reason for Visit</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="payment_receipt" class="form-label">Payment Receipt</label>
                                        <div class="file-input-wrapper">
                                            <div class="file-input-trigger" id="fileInputTrigger">
                                                <i class="fas fa-upload"></i>
                                                <p class="mb-0">Click to upload receipt</p>
                                                <small class="text-muted">(Image or PDF)</small>
                                            </div>
                                            <input type="file" class="form-control" id="payment_receipt" name="payment_receipt" accept="image/*,.pdf" required style="display: none;">
                                        </div>
                                        <div class="receipt-preview mt-3"></div>
                                        <small class="text-muted d-block mt-2">Upload your payment receipt (Image or PDF)</small>
                                    </div>

                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Please make the payment of Rs {{ number_format($doctor->consultation_fee, 0) }} to the doctor's bank account and upload the receipt.
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Request Appointment</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Analysis Report Modal -->
    @if($user && $user->acute_disease_detected)
    <div class="modal fade" id="aiReportModal" tabindex="-1" aria-labelledby="aiReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aiReportModalLabel">Share AI Analysis Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Would you like to share your recent AI fundus image analysis report with the doctor?</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Analysis Details:</strong>
                        @php
                            $diseaseData = is_string($user->acute_disease_detected) 
                                ? json_decode($user->acute_disease_detected, true) 
                                : $user->acute_disease_detected;
                            
                            $predictedClass = is_array($diseaseData) ? ($diseaseData['predicted_class'] ?? 'N/A') : 'N/A';
                            $confidence = is_array($diseaseData) && isset($diseaseData['confidence']) 
                                ? number_format($diseaseData['confidence'] * 100, 2) . '%' 
                                : 'N/A';
                            
                            // Handle recommendations which could be string or array
                            $recommendations = 'N/A';
                            if (is_array($diseaseData) && isset($diseaseData['recommendations'])) {
                                if (is_array($diseaseData['recommendations'])) {
                                    $recommendations = implode(', ', array_map('htmlspecialchars', $diseaseData['recommendations']));
                                } else {
                                    $recommendations = htmlspecialchars($diseaseData['recommendations']);
                                }
                            }
                        @endphp
                        <ul class="mt-2 mb-0">
                            <li>Predicted Class: {{ $predictedClass }}</li>
                            <li>Confidence: {{ $confidence }}</li>
                            @if($recommendations !== 'N/A')
                                <li>Recommendations: {!! $recommendations !!}</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="declineShare">No, Don't Share</button>
                    <button type="button" class="btn btn-primary" id="confirmShare">Yes, Share Report</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Appointment Confirmation Modal -->
    <div class="modal fade" id="appointmentConfirmationModal" tabindex="-1" aria-labelledby="appointmentConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentConfirmationModalLabel">Confirm Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-calendar-check me-2"></i>
                        <strong>Please confirm your appointment details:</strong>
                        <div class="mt-3">
                            <p><strong>Date:</strong> <span id="confirmDate"></span></p>
                            <p><strong>Time:</strong> <span id="confirmTime"></span></p>
                            <p><strong>Doctor:</strong> {{ $doctor->name }}</p>
                            <p><strong>Fee:</strong> Rs {{ number_format($doctor->consultation_fee, 0) }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAppointment">Confirm Appointment</button>
                </div>
            </div>
        </div>
    </div>

    @include('includes.section')
    @include('includes.footer')

    <a href="#" class="scrollToTop"><img src="img/output-onlinepngtools (32).png"></a>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/aos.min.js"></script>
    
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/aos.min.js"></script>
    <script src="../js/ckeditor.min.js"></script>
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/select2-min.js"></script>
    <script src="../js/video-popup.min.js"></script>
    <script src="../js/swiper-slider.min.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/jquery.counterup.min.js"></script>
    <script src="../js/active.js"></script>
    <script>
        $(document).ready(function() {
            // Update available times when date is selected
            $('#appointment_date').on('change', function() {
                var selectedDate = $(this).val();
                if (selectedDate) {
                    var dayName = new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'lowercase' });
                    var availability = @json($doctor->availability);
                    var dayAvailability = availability[dayName];
                    
                    var timeSelect = $('#appointment_time');
                    timeSelect.empty().append('<option value="">Select Time</option>');
                    
                    if (dayAvailability.enabled) {
                        var startTime = new Date('1970-01-01 ' + dayAvailability.start);
                        var endTime = new Date('1970-01-01 ' + dayAvailability.end);
                        var interval = 60 * 60 * 1000; // 1 hour in milliseconds
                        
                        for (var time = startTime; time < endTime; time = new Date(time.getTime() + interval)) {
                            var timeStr = time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
                            var value = time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
                            timeSelect.append('<option value="' + value + '">' + timeStr + '</option>');
                        }
                    }
                }
            });

            // Handle file input trigger click
            $('#fileInputTrigger').on('click', function() {
                $('#payment_receipt').click();
            });

            // Handle file input change
            $('#payment_receipt').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        let previewHtml = '';
                        if (file.type.startsWith('image/')) {
                            previewHtml = `<img src="${e.target.result}" alt="Receipt Preview">`;
                        } else {
                            previewHtml = `<div class="alert alert-info">
                                <i class="fas fa-file-pdf me-2"></i>
                                PDF File Selected: ${file.name}
                            </div>`;
                        }
                        $('.receipt-preview').html(previewHtml).slideDown();
                        
                        // Update trigger text
                        $('#fileInputTrigger').html(`
                            <i class="fas fa-check-circle text-success"></i>
                            <p class="mb-0">File Selected: ${file.name}</p>
                            <small class="text-muted">Click to change</small>
                        `);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            $('#appointmentForm').on('submit', function(e) {
                e.preventDefault();
                
                @if($user && $user->acute_disease_detected)
                    // Show the AI report modal
                    var aiReportModal = new bootstrap.Modal(document.getElementById('aiReportModal'));
                    aiReportModal.show();
                @else
                    // If no AI report, show appointment confirmation
                    showAppointmentConfirmation();
                @endif
            });

            // Handle share report confirmation
            $('#confirmShare').on('click', function() {
                $('#aiReportModal').modal('hide');
                showAppointmentConfirmation();
            });

            // Handle decline share
            $('#declineShare').on('click', function() {
                $('#aiReportModal').modal('hide');
                showAppointmentConfirmation();
            });

            // Handle final appointment confirmation
            $('#confirmAppointment').on('click', function() {
                submitAppointmentForm();
            });

            function showAppointmentConfirmation() {
                const date = $('#appointment_date option:selected').text();
                const time = $('#appointment_time option:selected').text();
                
                $('#confirmDate').text(date);
                $('#confirmTime').text(time);
                
                var confirmationModal = new bootstrap.Modal(document.getElementById('appointmentConfirmationModal'));
                confirmationModal.show();
            }

            function submitAppointmentForm() {
                var formData = new FormData($('#appointmentForm')[0]);
                @if($user && $user->acute_disease_detected)
                    if (window.includeReport) {
                        formData.append('include_report', '1');
                        @php
                            $reportData = is_string($user->acute_disease_detected) 
                                ? $user->acute_disease_detected 
                                : json_encode($user->acute_disease_detected);
                        @endphp
                        formData.append('user_report', @json($reportData));
                    }
                @endif
                
                $.ajax({
                    url: $('#appointmentForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Create success message HTML
                        var successMessage = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Appointment Request Successful!</strong>
                                <p class="mb-0 mt-2">Your appointment request has been submitted successfully. Please wait for the doctor to approve your request.</p>
                                <p class="mb-0">You can check your appointment status on your <a href="{{ route('user.dashboard') }}" class="alert-link">dashboard</a>.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `;
                        
                        // Replace the form with success message
                        $('.appointment-form').html(successMessage);
                        
                        // Close all modals
                        $('.modal').modal('hide');
                    },
                    error: function(xhr) {
                        // Create error message HTML
                        var errorMessage = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Error!</strong> ${xhr.responseJSON.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `;
                        
                        // Show error message above the form
                        $('.appointment-form').prepend(errorMessage);
                        
                        // Close all modals
                        $('.modal').modal('hide');
                    }
                });
            }
        });
    </script>
</body>
</html> 
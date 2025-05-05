<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fundus Disease Analysis - Completed Appointments</title>

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
</head>

<body>
    <header class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-6">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/newicon.png') }}" alt="Logo">
                            <span>Fundus Disease Analysis</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-6">
                    <div class="header-right">
                        <div class="header-right__profile">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/doctor-avatar.png') }}" alt="Profile">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('doctor.profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('doctor.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <style>
        .header-area {
            background: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo a {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .logo span {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .header-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 20px;
        }

        .header-right__profile .dropdown-toggle {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            color: #333;
        }

        .header-right__profile .dropdown-toggle:after {
            display: none;
        }

        .header-right__profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .header-right__profile span {
            color: #333;
            font-weight: 500;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px;
            min-width: 200px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-item i {
            margin-right: 10px;
            color: #604BB0;
            width: 20px;
            text-align: center;
        }

        .dropdown-item:hover {
            background: rgba(96, 75, 176, 0.1);
            color: #604BB0;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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

    <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="inflanar-dashboard-sidebar">
                        <div class="inflanar-dashboard-sidebar__profile">
                            <div class="inflanar-dashboard-sidebar__profile-image">
                                <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/doctor-avatar.png') }}" alt="Doctor Profile">
                            </div>
                            <div class="inflanar-dashboard-sidebar__profile-info">
                                <h4>{{ $doctor->name }}</h4>
                                <p>{{ $doctor->specialization }}</p>
                            </div>
                        </div>
                        @include('includes.doctor_sidebar')
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12 inflanar-personals__content">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="profile-card">
                        <div class="profile-header">
                            <h3 class="profile-title">
                                <i class="fas fa-calendar-alt"></i> Appointments
                            </h3>
                        </div>
                        <div class="profile-content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Patient</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $appointment)
                                            <tr data-status="{{ $appointment->status }}" data-appointment-id="{{ $appointment->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $appointment->user && $appointment->user->image ? asset('storage/' . $appointment->user->image) : asset('img/user-avatar.png') }}" 
                                                             alt="Patient" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                                        <div>
                                                            <div class="fw-bold">{{ $appointment->user ? $appointment->user->name : 'Unknown User' }}</div>
                                                            <small class="text-muted">{{ $appointment->user ? $appointment->user->email : 'N/A' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</div>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge status-badge status-{{ $appointment->status }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                    @if($appointment->status === 'confirmed')
                                                        <div class="appointment-timer mt-2" 
                                                             data-appointment-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}"
                                                             data-appointment-time="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i:s') }}">
                                                            <small class="text-muted">Time remaining: <span class="countdown"></span></small>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        @if($appointment->status === 'confirmed')
                                                            <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#completeModal{{ $appointment->id }}">
                                                                <i class="fas fa-check-circle"></i> Mark as Completed
                                                            </button>
                                                        @endif
                                                        <button type="button" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#viewModal{{ $appointment->id }}">
                                                            <i class="fas fa-eye"></i> View
                                                        </button>
                                                        @if($appointment->status === 'completed')
                                                            <a href="{{ route('doctor.download.appointment', $appointment->id) }}" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-download"></i> Download PDF
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- View Details Modal -->
                                            <div class="modal fade" id="viewModal{{ $appointment->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Patient Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- Patient Profile Section -->
                                                                <div class="col-md-4 text-center mb-4">
                                                                    <div class="patient-profile">
                                                                        <img src="{{ $appointment->user && $appointment->user->image ? asset('storage/' . $appointment->user->image) : asset('img/user-avatar.png') }}" 
                                                                        alt="Patient" class="rounded-circle mb-3" 
                                                                        style="width: 120px; height: 120px; object-fit: cover;">
                                                                     <h5 class="mb-1">{{ $appointment->user ? $appointment->user->name : 'Unknown User' }}</h5>
                                                                        <p class="text-muted mb-0">{{ $appointment->user ? $appointment->user->email : 'N/A' }}</p>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Contact Information -->
                                                                <div class="col-md-8">
                                                                    <div class="card mb-3">
                                                                        <div class="card-header bg-light">
                                                                            <h6 class="mb-0">Contact Information</h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6 mb-2">
                                                                                    <strong>Phone:</strong>
                                                                                    <p class="mb-0">{{ $appointment->user ? $appointment->user->phone : 'Not provided' }}</p>
                                                                                </div>
                                                                                <div class="col-md-6 mb-2">
                                                                                    <strong>Location:</strong>
                                                                                    <p class="mb-0">
                                                                                        {{ $appointment->user ? $appointment->user->city : 'Not provided' }}, 
                                                                                        {{ $appointment->user ? $appointment->user->country : 'Not provided' }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <strong>Address:</strong>
                                                                                    <p class="mb-0">{{ $appointment->user ? $appointment->user->address : 'Not provided' }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Medical Information -->
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="card mb-3">
                                                                        <div class="card-header bg-light">
                                                                            <h6 class="mb-0">Medical Information</h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <strong>Medical History:</strong>
                                                                                    <p class="mb-0">{{ $appointment->user ? $appointment->user->medical_history : 'Not provided' }}</p>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <strong>Current Symptoms:</strong>
                                                                                    <p class="mb-0">{{ $appointment->user ? $appointment->user->symptoms : 'Not provided' }}</p>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <strong>Visual Acuity:</strong>
                                                                                    <p class="mb-0">{{ $appointment->user ? $appointment->user->visual_acuity : 'Not provided' }}</p>
                                                                                </div>
                                                                                <div class="col-md-6 mb-3">
                                                                                    <strong>Eye Condition:</strong>
                                                                                    <p class="mb-0">{{ $appointment->user ? $appointment->user->eye_condition : 'Not provided' }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- AI Analysis Report Section -->
                                                            @if($appointment->user_report)
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="card mb-3">
                                                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                                                <h6 class="mb-0">AI Analysis Report</h6>
                                                                                <a href="{{ route('doctor.download.user.report', $appointment->id) }}" class="btn btn-sm btn-primary">
                                                                                    <i class="fas fa-download"></i> Download Report
                                                                                </a>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                @php
                                                                                    $reportData = json_decode($appointment->user_report, true);
                                                                                @endphp
                                                                                <div class="row">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <strong>Predicted Condition:</strong>
                                                                                        <p class="mb-0">{{ $reportData['predicted_class'] ?? 'Not available' }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <strong>Confidence Level:</strong>
                                                                                        <p class="mb-0">{{ isset($reportData['confidence']) ? number_format($reportData['confidence'] * 100, 2) . '%' : 'Not available' }}</p>
                                                                                    </div>
                                                                                    <div class="col-12 mb-3">
                                                                                        <strong>Detailed Analysis:</strong>
                                                                                        <ul class="list-unstyled mb-0">
                                                                                            @foreach($reportData['conditions'] ?? [] as $condition)
                                                                                                <li class="mb-2">
                                                                                                    <span class="badge bg-info">{{ $condition['name'] }}</span>
                                                                                                    <span class="ms-2">{{ number_format($condition['confidence'] * 100, 2) }}%</span>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <strong>Recommendations:</strong>
                                                                                        <ul class="mb-0">
                                                                                            @foreach($reportData['recommendations'] ?? [] as $recommendation)
                                                                                                <li>{{ $recommendation }}</li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <!-- Appointment Details -->
                                                            <div class="card">
                                                                <div class="card-header bg-light">
                                                                    <h6 class="mb-0">Appointment Details</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <strong>Date:</strong>
                                                                            <p class="mb-0">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <strong>Time:</strong>
                                                                            <p class="mb-0">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <strong>Reason:</strong>
                                                                            <p class="mb-0">{{ $appointment->reason }}</p>
                                                                        </div>
                                                                        <div class="col-12 mt-2">
                                                                            <strong>Status:</strong>
                                                                            <span class="badge status-badge status-{{ $appointment->status }}">
                                                                                {{ ucfirst($appointment->status) }}
                                                                            </span>
                                                                        </div>
                                                                        @if($appointment->notes)
                                                                            <div class="col-12 mt-3">
                                                                                <strong>Doctor's Notes:</strong>
                                                                                <p class="mb-0">{{ $appointment->notes }}</p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Complete Appointment Modal -->
                                            <div class="modal fade" id="completeModal{{ $appointment->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Complete Appointment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form action="{{ route('doctor.complete.appointment', $appointment->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="notes" class="form-label">Appointment Notes</label>
                                                                    <textarea class="form-control" id="notes" name="notes" rows="4" required 
                                                                              placeholder="Enter appointment notes, diagnosis, and recommendations..."></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="fas fa-check-circle"></i> Mark as Completed
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No completed appointments found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Sidebar Styles */
        .inflanar-dashboard-sidebar {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            position: sticky;
            top: 30px;
        }

        .inflanar-dashboard-sidebar__profile {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(96, 75, 176, 0.1);
        }

        .inflanar-dashboard-sidebar__profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid #604BB0;
            padding: 3px;
        }

        .inflanar-dashboard-sidebar__profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .inflanar-dashboard-sidebar__profile-info h4 {
            color: #333;
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .inflanar-dashboard-sidebar__profile-info p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .inflanar-dashboard-sidebar__menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .inflanar-dashboard-sidebar__menu li {
            margin-bottom: 10px;
        }

        .inflanar-dashboard-sidebar__menu li a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #666;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .inflanar-dashboard-sidebar__menu li a i {
            width: 24px;
            text-align: center;
            margin-right: 15px;
            font-size: 18px;
            color: #604BB0;
            transition: all 0.3s ease;
        }

        .inflanar-dashboard-sidebar__menu li.active a,
        .inflanar-dashboard-sidebar__menu li a:hover {
            background: rgba(96, 75, 176, 0.1);
            color: #604BB0;
        }

        .inflanar-dashboard-sidebar__menu li.active a i,
        .inflanar-dashboard-sidebar__menu li a:hover i {
            color: #604BB0;
        }

        /* Profile Card Styles */
        .profile-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .profile-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(96, 75, 176, 0.1);
        }

        .profile-title {
            color: #604BB0;
            font-size: 24px;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .profile-title i {
            margin-right: 10px;
        }

        /* Table Styles */
        .table {
            width: 100%;
            margin-bottom: 0;
            font-size: 0.95rem;
        }

        .table th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            padding: 12px;
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }

        .table td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
            font-size: 0.95rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(96, 75, 176, 0.05);
        }

        /* Button Styles */
        .btn-group .btn {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 4px 8px;
            font-size: 0.85rem;
        }

        /* Status Badge Styles */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .status-pending { 
            background: #fff3cd; 
            color: #856404; 
        }
        .status-confirmed { 
            background: #d4edda; 
            color: #155724; 
        }
        .status-completed { 
            background: #cce5ff; 
            color: #004085; 
        }
        .status-cancelled { 
            background: #f8d7da; 
            color: #721c24; 
        }

        /* Container Styles */
        .inflanar-personals__content {
            padding: 30px;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: #604BB0;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
        }

        .modal-body {
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 15px 20px;
        }

        .card-body {
            padding: 20px;
        }

        /* Add these styles to your existing styles */
        .appointment-timer {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .countdown {
            font-weight: 600;
            color: #604BB0;
            display: inline-block;
            min-width: 100px;
        }

        /* Add these styles to your existing styles */
        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            background: #604BB0;
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .modal-footer {
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #604BB0;
            box-shadow: 0 0 0 0.2rem rgba(96, 75, 176, 0.25);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 8px 20px;
            border-radius: 8px;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/active.js"></script>

    <script>
        function updateCountdowns() {
            document.querySelectorAll('.appointment-timer').forEach(timer => {
                const appointmentDate = timer.dataset.appointmentDate;
                const appointmentTime = timer.dataset.appointmentTime;
                
                // Create a Date object from the appointment date and time
                const [year, month, day] = appointmentDate.split('-').map(Number);
                const [hours, minutes, seconds] = appointmentTime.split(':').map(Number);
                const appointmentDateTime = new Date(year, month - 1, day, hours, minutes, seconds);
                const now = new Date();
                const diff = appointmentDateTime - now;

                const countdownSpan = timer.querySelector('.countdown');
                
                if (diff > 0) {
                    // Calculate days, hours, minutes
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    
                    let timeText = '';
                    if (days > 0) {
                        timeText = `${days}d ${hours}h remaining`;
                    } else if (hours > 0) {
                        timeText = `${hours}h ${minutes}m remaining`;
                    } else if (minutes > 0) {
                        timeText = `${minutes}m ${seconds}s remaining`;
                    } else {
                        timeText = `${seconds}s remaining`;
                    }

                    countdownSpan.textContent = timeText;
                    
                    // Add warning classes based on time remaining
                    timer.classList.remove('timer-warning', 'timer-danger');
                    if (diff <= 1000 * 60 * 60) { // Less than 1 hour
                        timer.classList.add('timer-danger');
                    } else if (diff <= 1000 * 60 * 60 * 24) { // Less than 24 hours
                        timer.classList.add('timer-warning');
                    }
                } else {
                    countdownSpan.textContent = 'Appointment time has passed';
                    timer.classList.add('timer-danger');
                }
            });
        }

        // Update countdowns immediately and then every second
        updateCountdowns();
        setInterval(updateCountdowns, 1000);

        // Function to handle starting an appointment
        function startAppointment(appointmentId) {
            if (confirm('Are you sure you want to start this appointment?')) {
                // Here you can add the logic to mark the appointment as started
                // For now, we'll just show an alert
                alert('Appointment started!');
            }
        }
    </script>
</body>
</html> 
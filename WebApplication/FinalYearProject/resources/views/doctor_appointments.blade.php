<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fundus Disease Analysis - Doctor Appointments</title>

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
            <div class="inflanar-personals">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="inflanar-dashboard-sidebar">
                            <div class="inflanar-dashboard-sidebar__profile">
                                <div class="inflanar-dashboard-sidebar__profile-image">
                                    @if($doctor->profile_image)
                                        <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="Doctor Profile">
                                    @else
                                        <img src="{{ asset('img/doctor-avatar.png') }}" alt="Doctor Profile">
                                    @endif
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
                        <!-- Stats Cards -->
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
                        <!-- Appointments Section -->
                        <div class="inflanar-profile-info mg-top-40">
                            <div class="inflanar-profile-info__head">
                                <h3 class="inflanar-profile-info__heading">
                                    <i class="fas fa-calendar-alt"></i> Pending Appointments
                                </h3>
                            </div>
                            <div class="inflanar-profile-info__content">
                            
                                <div class="mb-4">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-primary filter-btn {{ request('status') == 'pending' || !request('status') ? 'active' : '' }}" data-status="pending">Pending</button>
                                        <button type="button" class="btn btn-outline-primary filter-btn {{ request('status') == 'confirmed' ? 'active' : '' }}" data-status="confirmed">Confirmed</button>
                                        <button type="button" class="btn btn-outline-primary filter-btn {{ request('status') == 'cancelled' ? 'active' : '' }}" data-status="cancelled">Cancelled</button>
                                    </div>
                                </div>
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
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $appointment->id }}">
                                                                <i class="fas fa-eye"></i> View
                                                            </button>
                                                            @if($appointment->status == 'pending')
                                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#statusModal{{ $appointment->id }}">
                                                                <i class="fas fa-check"></i> Confirm
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectConfirmModal{{ $appointment->id }}">
                                                                <i class="fas fa-times"></i> Cancel
                                                            </button>
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
                                                                            <img src="{{ $appointment->user && $appointment->user->profile_image ? asset('storage/' . $appointment->user->profile_image) : asset('img/user-avatar.png') }}" 
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
                                                                                        <p class="mb-0">{{ $appointment->user ? $appointment->user->phone ?? 'Not provided' : 'N/A' }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-2">
                                                                                        <strong>Location:</strong>
                                                                                        <p class="mb-0">
                                                                                            {{ $appointment->user ? ($appointment->user->city ?? 'Not provided') . ', ' . ($appointment->user->country ?? 'Not provided') : 'N/A' }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <strong>Address:</strong>
                                                                                        <p class="mb-0">{{ $appointment->user ? $appointment->user->address ?? 'Not provided' : 'N/A' }}</p>
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
                                                                                        <p class="mb-0">{{ $appointment->user ? $appointment->user->medical_history ?? 'Not provided' : 'N/A' }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <strong>Current Symptoms:</strong>
                                                                                        <p class="mb-0">{{ $appointment->user ? $appointment->user->symptoms ?? 'Not provided' : 'N/A' }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <strong>Visual Acuity:</strong>
                                                                                        <p class="mb-0">{{ $appointment->user ? $appointment->user->visual_acuity ?? 'Not provided' : 'N/A' }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <strong>Eye Condition:</strong>
                                                                                        <p class="mb-0">{{ $appointment->user ? $appointment->user->eye_condition ?? 'Not provided' : 'N/A' }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Add User Report Section -->
                                                                @if($appointment->user_report)
                                                                <div class="card mb-3">
                                                                    <div class="card-header bg-light">
                                                                        <h6 class="mb-0">AI Analysis Report</h6>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                                                                <span>Patient's AI Analysis Report</span>
                                                                            </div>
                                                                            <a href="{{ route('doctor.download.user.report', $appointment->id) }}" 
                                                                               class="btn btn-primary btn-sm">
                                                                                <i class="fas fa-download me-1"></i> Download Report
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                <!-- Add Payment Receipt Section -->
                                                                <div class="card mb-3">
                                                                    <div class="card-header bg-light">
                                                                        <h6 class="mb-0">Payment Information</h6>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        @if($appointment->payment_receipt)
                                                                            <div class="receipt-container">
                                                                                <div class="receipt-label">Payment Receipt</div>
                                                                                <img src="{{ asset('storage/' . $appointment->payment_receipt) }}" 
                                                                                     alt="Payment Receipt" 
                                                                                     class="payment-receipt"
                                                                                     onclick="window.open(this.src, '_blank')"
                                                                                     style="cursor: pointer;">
                                                                            </div>
                                                                        @else
                                                                            <p class="text-muted mb-0">No payment receipt available</p>
                                                                        @endif
                                                                    </div>
                                                                </div>

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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Confirm Modal -->
                                                <div class="modal fade" id="statusModal{{ $appointment->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm Appointment</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form action="{{ route('appointment.update-status', $appointment->id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="confirmed">
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to confirm this appointment?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success">
                                                                        Yes, Confirm Appointment
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Cancel Confirmation Modal -->
                                                <div class="modal fade" id="rejectConfirmModal{{ $appointment->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Cancel Appointment</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form action="{{ route('appointment.update-status', $appointment->id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="cancelled">
                                                            <div class="modal-body">
                                                                    <p>Are you sure you want to cancel this appointment?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep Pending</button>
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Yes, Cancel Appointment
                                                                    </button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No appointments found</td>
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

        /* Stats Cards Styles */
        .inflanar-pdbox {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .inflanar-pdbox:hover {
            transform: translateY(-5px);
        }

        .inflanar-pdbox__icon {
            width: 60px;
            height: 60px;
            background: rgba(96, 75, 176, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .inflanar-pdbox__icon i {
            font-size: 24px;
            color: #604BB0;
        }

        .inflanar-pdbox__content {
            flex: 1;
        }

        .inflanar-pdbox__title {
            margin: 0;
            font-size: 16px;
            color: #666;
        }

        .inflanar-pdbox__title span {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .inflanar-pdbox__title strong {
            color: #333;
            font-size: 24px;
        }

        /* Profile Info Card Styles */
        .inflanar-profile-info {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
            overflow: hidden;
            margin-top: 30px;
        }

        .inflanar-profile-info__head {
            background: #604BB0;
            padding: 20px 30px;
            color: white;
        }

        .inflanar-profile-info__heading {
            margin: 0;
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        .inflanar-profile-info__heading i {
            margin-right: 10px;
            font-size: 24px;
        }

        .inflanar-profile-info__content {
            padding: 30px;
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
        .status-cancelled { 
            background: #f8d7da; 
            color: #721c24; 
        }
        
        .filter-btn {
            padding: 8px 16px;
            font-size: 0.95rem;
            margin-right: 8px;
        }
        
        .filter-btn.active {
            background-color: #604BB0;
            color: white;
        }
        
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
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

        /* Container Styles */
        .inflanar-personals__content {
            padding: 30px;
        }

        .inflanar-profile-info {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
            overflow: hidden;
            margin-top: 30px;
            padding: 30px;
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

        /* Payment Receipt Styles */
        .payment-receipt {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .receipt-container {
            text-align: center;
            margin: 15px 0;
        }
        
        .receipt-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
    </style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Load scripts in correct order -->
    <script src="../js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/active.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });

            // Initialize all modals
            var modalElementList = [].slice.call(document.querySelectorAll('.modal'));
            var modalList = modalElementList.map(function (modalEl) {
                return new bootstrap.Modal(modalEl);
            });

            // Filter appointments by status
            $('.filter-btn').click(function() {
                const status = $(this).data('status');
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                
                // Update URL with status parameter
                const url = new URL(window.location.href);
                url.searchParams.set('status', status);
                window.location.href = url.toString();
            });

            // Set initial active filter based on URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status') || 'pending';
            $(`.filter-btn[data-status="${status}"]`).addClass('active');
        });
    </script>
</body>
</html>

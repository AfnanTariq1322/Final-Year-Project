<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Doctor Dashboard</title>

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
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                                <div class="inflanar-pdbox">
                                    <div class="inflanar-pdbox__icon">
                                        <i class="fas fa-calendar-check fa-2x"></i>
                                    </div>
                                    <div class="inflanar-pdbox__content">
                                        <h4 class="inflanar-pdbox__title">
                                            <span>Today's Appointments</span>
                                            <strong>{{ $todayAppointments }}</strong>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                                <div class="inflanar-pdbox inflanar-pdbox__2">
                                    <div class="inflanar-pdbox__icon">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <div class="inflanar-pdbox__content">
                                        <h4 class="inflanar-pdbox__title">
                                            <span>Completed Appointments</span>
                                            <strong>{{ $completedAppointments }}</strong>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                                <div class="inflanar-pdbox inflanar-pdbox__3">
                                    <div class="inflanar-pdbox__icon">
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                    <div class="inflanar-pdbox__content">
                                        <h4 class="inflanar-pdbox__title">
                                            <span>Pending Appointments</span>
                                            <strong>{{ $pendingAppointments }}</strong>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upcoming Appointments Section -->
                        <div class="inflanar-profile-info mg-top-30">
                            <div class="inflanar-profile-info__head">
                                <h3 class="inflanar-profile-info__heading">
                                    <i class="fas fa-calendar-day"></i> Today's Confirmed Appointments
                                </h3>
                            </div>
                            <div class="inflanar-profile-info__content">
                                <div class="table-responsive">
                                    @if(count($upcomingAppointments) > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                     <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($upcomingAppointments as $appointment)
                                                    <tr>
                                                        <td>{{ $appointment->user->name }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                                  
                                                        <td>
                                                            <a href="{{ route('doctor.completedappointments') }}" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-eye"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-info">
                                            <p>No upcoming appointments found. Debug info:</p>
                                            <ul>
                                                <li>Current time: {{ now()->format('Y-m-d H:i:s') }}</li>
                                                <li>Doctor ID: {{ Session::get('loginId') }}</li>
                                            </ul>
                                        </div>
                                    @endif
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

        .info-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(96, 75, 176, 0.05);
            transform: translateX(5px);
        }

        .info-item i {
            width: 45px;
            height: 45px;
            background: rgba(96, 75, 176, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #604BB0;
            margin-right: 15px;
            font-size: 20px;
        }

        .info-content {
            flex: 1;
        }

        .info-content label {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .info-content p {
            margin: 0;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        /* Table Styles */
        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            padding: 12px;
            font-weight: 600;
            color: #333;
        }

        .table td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-primary {
            background-color: #604BB0;
            color: white;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #333;
        }

        .btn-primary {
            background-color: #604BB0;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4a3a8c;
            transform: translateY(-2px);
        }

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

        .header-right__search form {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: 25px;
            padding: 5px 15px;
        }

        .header-right__search input {
            border: none;
            background: none;
            padding: 5px;
            width: 200px;
        }

        .header-right__search button {
            border: none;
            background: none;
            color: #666;
        }

        .header-right__notification a {
            color: #666;
            font-size: 20px;
            position: relative;
        }

        .header-right__notification a::after {
            content: '';
            position: absolute;
            top: -5px;
            right: -5px;
            width: 8px;
            height: 8px;
            background: #604BB0;
            border-radius: 50%;
        }

        .header-right__profile .dropdown-toggle {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            padding: 0;
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
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-menu a i {
            margin-right: 10px;
            color: #604BB0;
        }

        .dropdown-menu a:hover {
            background: rgba(96, 75, 176, 0.1);
            color: #604BB0;
        }

        .countdown-timer {
            font-family: monospace;
            font-size: 14px;
            color: #604BB0;
            font-weight: 600;
        }
        
        .countdown-timer .countdown {
            display: inline-block;
            min-width: 100px;
            background: rgba(96, 75, 176, 0.1);
            padding: 2px 5px;
            border-radius: 4px;
            text-align: center;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/active.js"></script>

    <script>
        function updateCountdowns() {
            document.querySelectorAll('.countdown-timer').forEach(timer => {
                const appointmentDate = timer.dataset.appointmentDate;
                const appointmentTime = timer.dataset.appointmentTime;
                
                // Create a proper datetime string using ISO format
                const appointmentDateTime = new Date(`${appointmentDate}T${appointmentTime}`);
                const now = new Date();
                const distance = appointmentDateTime - now;

                if (distance < 0) {
                    timer.innerHTML = '<span class="badge badge-info">In Progress</span>';
                    return;
                }

                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                let timeString = '';
                if (hours > 0) timeString += `${hours}h `;
                if (minutes > 0) timeString += `${minutes}m `;
                timeString += `${seconds}s`;

                timer.querySelector('.countdown').textContent = timeString;
            });
        }

        // Update countdowns every second
        setInterval(updateCountdowns, 1000);
        updateCountdowns(); // Initial update
    </script>
</body>
</html>

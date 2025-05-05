<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Profile</title>

    <link rel="icon" href="../img/newicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/jquery-ui.min.css">
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
    <link rel="stylesheet" href="../css/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="../css/aos.min.css">

    <link rel="stylesheet" href="../css/font-awesome-all.min.css">

    <link rel="stylesheet" href="../css/swiper-slider.min.css">

    <link rel="stylesheet" href="../css/select2-min.css">

    <link rel="stylesheet" href="../css/datatables.min.css">

    <link rel="stylesheet" href="../css/video-popup.min.css">

    <link rel="stylesheet" href="../css/theme-default.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
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


    <div class="modal offcanvas-modal inflanar-mobile-menu fade" id="offcanvas-modal">
        <div class="modal-dialog offcanvas-dialog">
            <div class="modal-content">
                <div class="modal-header offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-remove"></i>
                    </button>
                </div>

                <div class="offcanvas-logo">

                </div>

                <span id="offcanvas-menu" class="offcanvas-menu">
                    <br>
                    <span class="nav-menu menu navigation list-none">
                        @if(session('LoggedUserInfo'))
                        <span class="user-name">
                            <a href="{{ route('user.dashboard') }}">
                                @if ($LoggedUserInfo->image)
                                <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}" alt="Profile Image"
                                    class="user-image"
                                    style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
                                @else
                                <img src="{{ asset('path/to/default/image.png') }}" alt="Default Image"
                                    class="user-image"
                                    style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
                                @endif
                                Welcome, {{ session('LoggedUserName') }}
                            </a>
                        </span>
                        <br>
                        <nav id="offcanvas-menu" class="offcanvas-menu">

                            <ul class="nav-menu menu navigation list-none">
                                <br>
                                <li class="active"><a href="/home">Home</a>
                                </li>
                                <li><a href="/about">About</a></li>
                                <li><a href="/blogs">Our Blogs</a></li>
                                <li><a href="">Diseases</a></li>
                                <li><a href="">Contact Us</a></li>
                            </ul>

                        </nav>

                        @else
                        <a href="sign-in.html" class="inflanar-btn1 inflanar-btn__nbg">Login</a>
                        <a href="register.html" class="inflanar-btn inflanar-btn--header"><span>Sign Up</span></a>
                        @endif
                    </span>
                </span>

                <div class="inflanar-header__button">
                    @if(session('LoggedUserInfo'))
                    <span class="user-name">
                        <a href="{{ route('user.dashboard') }}">
                            @if ($LoggedUserInfo->image)
                            <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}" alt="Profile Image"
                                class="user-image"
                                style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
                            @else
                            <img src="{{ asset('path/to/default/image.png') }}" alt="     "
                                class="user-image"
                                style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
                            @endif
                            Welcome, {{ session('LoggedUserName') }}
                        </a>
                    </span>
                    @else
                    <a href="sign-in.html" class="inflanar-btn1 inflanar-btn__nbg">Login</a>
                    <a href="register.html" class="inflanar-btn inflanar-btn--header"><span>Sign Up</span></a>
                    @endif
                </div>

            </div>
        </div>
    </div>





    <header id="active-sticky" class="inflanar-header inflanar-header__v2">
        <div class="inflanar-header__middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="inflanar-header__inside">
                            <div class="inflanar-header__group">
                                <div class="inflanar-header__logo">
                                    <a href="https://createrdirect.corammerswork.com/">
                                        <img src="../img/newicon.png" alt="#"> <span
                                            style="color:#604BB0 !importantfont-size: 18px; vertical-align: middle; margin-left: 4px;">Retina
                                            Fundus Analysis</span>

                                    </a>
                                </div>
                                <div class="inflanar-header__menu">
                                    <div class="navbar">
                                        <div class="nav-item">
                                            <ul class="nav-menu menu navigation list-none">
                                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                                    <a href="{{ route('home') }}" class="menu-blogs">Home</a>
                                                </li>
                                                <li
                                                    class="{{ request()->routeIs('about') || request()->routeIs('about') ? 'active' : '' }}">
                                                    <a href="{{ route('about') }}" class="menu-blogs">About</a>
                                                </li>
    
                                                <li
                                                    class="{{ request()->routeIs('blogs') || request()->routeIs('blogdetail') ? 'active' : '' }}">
                                                    <a href="{{ route('blogs') }}" class="menu-blogs">Our Blogs</a>
                                                </li>
    
                                                <li
                                                    class="{{ request()->routeIs('diagnosis') || request()->routeIs('diagnosis') ? 'active' : '' }}">
                                                    <a href="{{ route('diagnosis') }}" class="menu-blogs">Diagnosis</a>
                                                </li>
    
    
                                                <!-- 🆕 Doctors Menu -->
                                                <li class="{{ request()->routeIs('doctors') ? 'active' : '' }}">
                                                    <a href="{{ route('doctors') }}" class="menu-blogs">Doctors</a>
                                                </li>
    
    
                                                <li
                                                    class="{{ request()->routeIs('contact') || request()->routeIs('contact') ? 'active' : '' }}">
                                                    <a href="{{ route('contact') }}" class="menu-blogs">Contact Us</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="offcanvas-toggler" data-bs-toggle="modal"
                                data-bs-target="#offcanvas-modal">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </button>
                            <div class="inflanar-header__button">
                                @if(session('LoggedUserInfo'))
                                <span class="user-name">
                                    <a href="{{ route('user.dashboard') }}">
                                        @if ($LoggedUserInfo->image)
                                        <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}" alt="Profile Image"
                                            class="user-image"
                                            style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
                                        @else
                                        <img src="{{ asset('path/to/default/image.png') }}" alt="     "
                                            class="user-image"
                                            style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
                                        @endif
                                        Welcome, {{ session('LoggedUserName') }}
                                    </a>
                                </span>

                                @else
                                <a href="sign-in.html" class="inflanar-btn1 inflanar-btn__nbg">Login</a>
                                <a href="register.html" class="inflanar-btn inflanar-btn--header"><span>Sign
                                        Up</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="inflanar-personals">
                <div class="row">
                    @include('user.includes.sidebar')

                    <div class="col-lg-9 col-md-8 col-12 inflanar-personals__content mg-top-30">
                        <div class="inflanar-supports">
                            <!-- Navigation buttons -->
                            <div class="profile-navigation d-flex align-items-center mb-4">
                                <h4 class="mb-0">My Appointments</h4>
                                <div class="filter-buttons ms-auto">
                                    <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" class="profile-btn {{ request('status') == 'all' || !request('status') ? 'active' : '' }}" data-filter="all">All</a>
                                    <a href="{{ request()->fullUrlWithQuery(['status' => 'today']) }}" class="profile-btn {{ request('status') == 'today' ? 'active' : '' }}" data-filter="today">Today</a>
                                    <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}" class="profile-btn {{ request('status') == 'pending' ? 'active' : '' }}" data-filter="pending">Pending</a>
                                    <a href="{{ request()->fullUrlWithQuery(['status' => 'confirmed']) }}" class="profile-btn {{ request('status') == 'confirmed' ? 'active' : '' }}" data-filter="confirmed">Confirmed</a>
                                    <a href="{{ request()->fullUrlWithQuery(['status' => 'completed']) }}" class="profile-btn {{ request('status') == 'completed' ? 'active' : '' }}" data-filter="completed">Completed</a>
                                    <a href="{{ request()->fullUrlWithQuery(['status' => 'cancelled']) }}" class="profile-btn {{ request('status') == 'cancelled' ? 'active' : '' }}" data-filter="cancelled">Cancelled</a>
                                </div>
                            </div>

                            <!-- Appointments List -->
                            <div class="appointments-list">
                                @forelse($appointments as $appointment)
                                <div class="appointment-card" data-status="{{ strtolower($appointment->status) }}">
                                    <div class="appointment-header">
                                        <div class="doctor-info">
                                            @if($appointment->doctor->profile_image)
                                                <img src="{{ asset('storage/' . $appointment->doctor->profile_image) }}" alt="Doctor Image" class="doctor-image" data-bs-toggle="modal" data-bs-target="#doctorModal{{ $appointment->doctor->id }}">
                                            @else
                                                <div class="doctor-image-placeholder" data-bs-toggle="modal" data-bs-target="#doctorModal{{ $appointment->doctor->id }}">
                                                    <i class="fas fa-user-md"></i>
                                                </div>
                                            @endif
                                            <div class="doctor-details">
                                                <h5 class="doctor-name" data-bs-toggle="modal" data-bs-target="#doctorModal{{ $appointment->doctor->id }}">{{ $appointment->doctor->name }}</h5>
                                                <p class="specialization">{{ $appointment->doctor->specialization }}</p>
                                            </div>
                                        </div>
                                        <div class="appointment-status {{ strtolower($appointment->status) }}">
                                            {{ ucfirst($appointment->status) }}
                                            @if($appointment->status === 'confirmed')
                                                <div class="countdown-timer" 
                                                    data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}" 
                                                    data-time="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i:s') }}">
                                                    <i class="fas fa-clock"></i>
                                                    <span class="timer"></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="appointment-details">
                                        <div class="detail-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-comment-medical"></i>
                                            <span>{{ $appointment->reason }}</span>
                                        </div>
                                    </div>

                                    <div class="appointment-actions">
                                        @if($appointment->status === 'confirmed')
                                            <a href="{{ route('user.download.appointment', $appointment->id) }}" class="btn btn-primary">
                                                <i class="fas fa-receipt"></i> Download Receipt
                                            </a>
                                        @endif
                                        @if($appointment->status === 'completed')
                                            <a href="{{ route('user.download.appointment', $appointment->id) }}" class="btn btn-success">
                                                <i class="fas fa-file-medical"></i> Download Report
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="d-flex justify-content-left mt-3">
                                {{ $appointments->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                            <!-- Pagination -->
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('user.includes.footer')

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/aos.min.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/active.js"></script>

    <style>
    .appointments-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .appointment-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .appointment-card:hover {
        transform: translateY(-5px);
    }

    .appointment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .doctor-info {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .doctor-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #604BB0;
    }

    .doctor-image-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #604BB0;
        border: 3px solid #604BB0;
    }

    .doctor-details h5 {
        margin: 0;
        color: #333;
        font-size: 18px;
    }

    .specialization {
        color: #666;
        margin: 5px 0 0;
        font-size: 14px;
    }

    .appointment-status {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        white-space: nowrap;
    }

    .appointment-status.pending {
        background: #fff3cd;
        color: #856404;
    }

    .appointment-status.confirmed {
        background: #d4edda;
        color: #155724;
    }

    .appointment-status.completed {
        background: #cce5ff;
        color: #004085;
    }

    .appointment-status.cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .appointment-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #666;
        flex-wrap: wrap;
    }

    .detail-item i {
        color: #604BB0;
        font-size: 16px;
    }

    .appointment-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-primary {
        background: #604BB0;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        color: white;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-primary:hover {
        background: #4a3a8a;
        transform: translateY(-2px);
    }

    .no-appointments {
        display: none;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .profile-btn {
        padding: 8px 15px;
        border: 2px solid #604BB0;
        background-color: #fff;
        color: #604BB0;
        cursor: pointer;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
    }

    .profile-btn:hover {
        background-color: #604BB0;
        color: #fff;
        text-decoration: none;
    }

    .profile-btn.active {
        background-color: #604BB0;
        color: #fff;
    }

    .doctor-name, .doctor-image, .doctor-image-placeholder {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .doctor-name:hover, .doctor-image:hover, .doctor-image-placeholder:hover {
        opacity: 0.8;
    }

    .modal-doctor-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #604BB0;
        margin-bottom: 20px;
    }

    .modal-doctor-image-placeholder {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #604BB0;
        border: 4px solid #604BB0;
        margin: 0 auto 20px;
    }

    .doctor-profile-content {
        padding: 20px;
    }

    .doctor-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin: 20px 0;
    }

    .doctor-info-grid .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .doctor-info-grid .info-item i {
        color: #604BB0;
        font-size: 18px;
    }

    .doctor-bio {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .doctor-bio h4 {
        color: #604BB0;
        margin-bottom: 10px;
    }

    .sub-specialization {
        color: #666;
        font-style: italic;
        margin-bottom: 15px;
    }

    .modal-content {
        border-radius: 15px;
        border: none;
    }

    .modal-header {
        background: #604BB0;
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .modal-header .btn-close {
        color: white;
        filter: brightness(0) invert(1);
    }

    .modal-title {
        font-weight: 600;
    }

    .clinic-location {
        margin-top: 20px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .clinic-location h4 {
        color: #604BB0;
        margin-bottom: 15px;
        font-size: 18px;
    }

    .address-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 15px;
        padding: 15px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .address-box i {
        color: #604BB0;
        font-size: 20px;
        margin-top: 2px;
    }

    .address-box p {
        margin: 0;
        color: #333;
        line-height: 1.5;
    }

    .map-box {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .map-box iframe {
        width: 100%;
        height: 200px;
        border: none;
        display: block;
    }

    .countdown-timer {
        margin-top: 8px;
        font-size: 14px;
        color: #155724;
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 4px 8px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .countdown-timer i {
        font-size: 12px;
        color: #604BB0;
    }

    .countdown-timer .timer {
        font-weight: 600;
    }

    .timer-warning {
        color: #856404 !important;
        background: #fff3cd !important;
    }

    .timer-danger {
        color: #721c24 !important;
        background: #f8d7da !important;
    }

    .appointment-status.confirmed {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .appointment-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .appointment-status {
            align-self: flex-start;
        }

        .appointment-details {
            grid-template-columns: 1fr;
        }

        .appointment-actions {
            justify-content: flex-start;
        }

        .filter-buttons {
            margin-top: 15px;
            width: 100%;
            justify-content: center;
        }

        .profile-navigation {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .profile-navigation h4 {
            margin-bottom: 15px;
        }

        .modal-doctor-image,
        .modal-doctor-image-placeholder {
            width: 150px;
            height: 150px;
        }

        .doctor-info-grid {
            grid-template-columns: 1fr;
        }

        .clinic-location {
            margin-top: 15px;
        }

        .map-box iframe {
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .appointment-card {
            padding: 15px;
        }

        .doctor-info {
            flex-direction: column;
            align-items: flex-start;
        }

        .doctor-details {
            margin-top: 10px;
        }

        .appointment-status {
            font-size: 12px;
            padding: 6px 12px;
        }

        .btn-primary {
            width: 100%;
            text-align: center;
        }

        .profile-btn {
            font-size: 14px;
            padding: 6px 12px;
        }

        .modal-doctor-image,
        .modal-doctor-image-placeholder {
            width: 120px;
            height: 120px;
        }

        .doctor-profile-content {
            padding: 15px;
        }

        .doctor-name {
            font-size: 20px;
        }

        .specialization {
            font-size: 14px;
        }
    }

    /* Modal responsive styles */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 10px;
        }

        .modal-body {
            padding: 15px;
        }

        .doctor-profile-content .row {
            flex-direction: column;
        }

        .doctor-profile-content .col-md-4 {
            margin-bottom: 20px;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-buttons .profile-btn');
        const appointmentCards = document.querySelectorAll('.appointment-card');

        // Show/hide cards based on current filter
        const currentFilter = '{{ request('status') }}';
        
        // If we're using server-side filtering (status parameter is present), show all cards
        if (currentFilter) {
            appointmentCards.forEach(card => {
                card.style.display = 'block';
            });
        } else {
            // Only apply client-side filtering when no status parameter is present
            appointmentCards.forEach(card => {
                if (currentFilter === 'all' || !currentFilter || card.getAttribute('data-status') === currentFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Countdown timer functionality
        function updateCountdowns() {
            const timers = document.querySelectorAll('.countdown-timer');
            
            timers.forEach(timer => {
                const date = timer.dataset.date;
                const time = timer.dataset.time;
                
                // Create a proper date string in ISO format
                const appointmentDateTime = new Date(`${date}T${time}`);
                const now = new Date();
                
                // Check if the date is valid
                if (isNaN(appointmentDateTime.getTime())) {
                    timer.querySelector('.timer').textContent = 'Invalid date';
                    return;
                }
                
                const diff = appointmentDateTime - now;
                
                if (diff <= 0) {
                    timer.classList.add('timer-danger');
                    timer.querySelector('.timer').textContent = 'Appointment time has passed';
                    return;
                }
                
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                
                const timeString = `${hours}h ${minutes}m ${seconds}s`;
                timer.querySelector('.timer').textContent = timeString;
                
                // Add warning class if less than 1 hour remaining
                if (hours < 1) {
                    timer.classList.add('timer-warning');
                }
            });
        }

        // Update countdowns immediately and then every second
        updateCountdowns();
        setInterval(updateCountdowns, 1000);
    });
    </script>

    @foreach($appointments as $appointment)
    <!-- Doctor Profile Modal -->
    <div class="modal fade" id="doctorModal{{ $appointment->doctor->id }}" tabindex="-1" aria-labelledby="doctorModalLabel{{ $appointment->doctor->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="doctorModalLabel{{ $appointment->doctor->id }}">Doctor Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="doctor-profile-content">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if($appointment->doctor->profile_image)
                                    <img src="{{ asset('storage/' . $appointment->doctor->profile_image) }}" alt="Doctor Image" class="modal-doctor-image">
                                @else
                                    <div class="modal-doctor-image-placeholder">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h3 class="doctor-name">{{ $appointment->doctor->name }}</h3>
                                <p class="specialization">{{ $appointment->doctor->specialization }}</p>
                                @if($appointment->doctor->sub_specialization)
                                    <p class="sub-specialization">{{ $appointment->doctor->sub_specialization }}</p>
                                @endif
                                <div class="doctor-info-grid">
                                    <div class="info-item">
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>{{ $appointment->doctor->qualifications }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-briefcase"></i>
                                        <span>{{ $appointment->doctor->experience_years }} Years Experience</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $appointment->doctor->contact_number }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $appointment->doctor->email }}</span>
                                    </div>
                                    @if($appointment->doctor->clinic_address)
                                    <div class="info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $appointment->doctor->clinic_address }}</span>
                                    </div>
                                    @endif
                                    @if($appointment->doctor->consultation_fee)
                                    <div class="info-item">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <span>Consultation Fee: Rp {{ number_format($appointment->doctor->consultation_fee, 0, ',', '.') }}</span>
                                    </div>
                                    @endif
                                </div>
                                @if($appointment->doctor->bio)
                                <div class="doctor-bio">
                                    <h4>About</h4>
                                    <p>{{ $appointment->doctor->bio }}</p>
                                </div>
                                @endif
                                @if($appointment->doctor->clinic_address || $appointment->doctor->map)
                                <div class="clinic-location">
                                    <h4>Clinic Location</h4>
                                    @if($appointment->doctor->clinic_address)
                                    <div class="address-box">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p>{{ $appointment->doctor->clinic_address }}</p>
                                    </div>
                                    @endif
                                    @if($appointment->doctor->map)
                                    <div class="map-box">
                                        {!! $appointment->doctor->map !!}
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
<!-- Scripts at the bottom of the body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/aos.min.js') }}"></script>
<script src="{{ asset('js/active.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-buttons .profile-btn');
        const appointmentCards = document.querySelectorAll('.appointment-card');

        // Show/hide cards based on current filter
        const currentFilter = '{{ request('status') }}';
        
        // If we're using server-side filtering (status parameter is present), show all cards
        if (currentFilter) {
            appointmentCards.forEach(card => {
                card.style.display = 'block';
            });
        } else {
            // Only apply client-side filtering when no status parameter is present
            appointmentCards.forEach(card => {
                if (currentFilter === 'all' || !currentFilter || card.getAttribute('data-status') === currentFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Countdown timer functionality
        function updateCountdowns() {
            const timers = document.querySelectorAll('.countdown-timer');
            
            timers.forEach(timer => {
                const date = timer.dataset.date;
                const time = timer.dataset.time;
                
                // Create a proper date string in ISO format
                const appointmentDateTime = new Date(`${date}T${time}`);
                const now = new Date();
                
                // Check if the date is valid
                if (isNaN(appointmentDateTime.getTime())) {
                    timer.querySelector('.timer').textContent = 'Invalid date';
                    return;
                }
                
                const diff = appointmentDateTime - now;
                
                if (diff <= 0) {
                    timer.classList.add('timer-danger');
                    timer.querySelector('.timer').textContent = 'Appointment time has passed';
                    return;
                }
                
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                
                const timeString = `${hours}h ${minutes}m ${seconds}s`;
                timer.querySelector('.timer').textContent = timeString;
                
                // Add warning class if less than 1 hour remaining
                if (hours < 1) {
                    timer.classList.add('timer-warning');
                }
            });
        }

        // Update countdowns immediately and then every second
        updateCountdowns();
        setInterval(updateCountdowns, 1000);
    });
</script>
</html> 
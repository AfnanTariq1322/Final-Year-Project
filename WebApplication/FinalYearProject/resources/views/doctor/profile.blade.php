<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Doctor Profile</title>

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
                    <div class="col-lg-3">
                        <div class="inflanar-dashboard-sidebar">
                            <div class="inflanar-dashboard-sidebar__profile">
                                <div class="inflanar-dashboard-sidebar__profile-image">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/doctor-avatar.png') }}" alt="Profile">
                                    </button>
                                </div>
                                <div class="inflanar-dashboard-sidebar__profile-info">
                                    <h4>{{ $doctor->name }}</h4>
                                    <p>{{ $doctor->specialization }}</p>
                                </div>
                            </div>
                            <ul class="inflanar-dashboard-sidebar__menu">
                                <li>
                                    <a href="{{ route('doctor.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('doctor.appointments') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>Appointments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=" ">
                                        <i class="fas fa-users"></i>
                                        <span>Patients</span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{ route('doctor.profile') }}">
                                        <i class="fas fa-user-cog"></i>
                                        <span>Profile Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('doctor.logout') }}">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Profile Navigation -->
                        <div class="profile-navigation d-flex align-items-center mb-4">
                            <button id="viewProfileBtn" class="profile-btn active" onclick="showViewProfile()">
                                <i class="fas fa-user"></i> View Profile
                            </button>
                            <button id="editProfileBtn" class="profile-btn" onclick="showEditProfile()">
                                <i class="fas fa-edit"></i> Edit Profile
                            </button>

                            @if(session('success'))
                            <div class="alert alert-success mb-0 ms-3" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                            @endif
                        </div>

                        <!-- View Profile Section -->
                        <div id="viewProfile" class="profile-section">
                            <div class="profile-card">
                                <div class="profile-header text-center">
                                    <div class="profile-image-container">
                                        @if ($doctor->profile_image)
                                            <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="Profile Image" class="profile-image">
                                        @else
                                            <div class="profile-image-placeholder">
                                                <i class="fas fa-user-circle"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="profile-name">{{ $doctor->name }}</h4>
                                    <p class="profile-specialization">{{ $doctor->specialization }}</p>
                                </div>

                                <div class="profile-content">
                                    <div class="profile-info-grid">
                                        <div class="info-item">
                                            <i class="fas fa-envelope"></i>
                                            <div class="info-content">
                                                <label>Email</label>
                                                <p>{{ $doctor->email }}</p>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <i class="fas fa-phone"></i>
                                            <div class="info-content">
                                                <label>Contact Number</label>
                                                <p>{{ $doctor->contact_number }}</p>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div class="info-content">
                                                <label>Clinic Address</label>
                                                <p>{{ $doctor->clinic_address }}</p>
                                            </div>
                                        </div>

                                        @if($doctor->map)
                                        <div class="info-item">
                                            <i class="fas fa-map"></i>
                                            <div class="info-content">
                                                <label>Location</label>
                                                <div class="map-container mt-2">
                                                    {!! $doctor->map !!}
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="info-item">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <div class="info-content">
                                                <label>Consultation Fee</label>
                                                <p>{{ intval($doctor->consultation_fee) }}</p>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="profile-section-divider">
                                        <h5><i class="fas fa-graduation-cap"></i> Qualifications</h5>
                                        <p>{{ $doctor->qualifications }}</p>
                                    </div>

                                    <div class="profile-section-divider">
                                        <h5><i class="fas fa-user-md"></i> Experience</h5>
                                        <p>{{ $doctor->experience_years }} years of experience</p>
                                    </div>

                                    <div class="profile-section-divider">
                                        <h5><i class="fas fa-info-circle"></i> Bio</h5>
                                        <p>{{ $doctor->bio ?? 'No bio available' }}</p>
                                    </div>

                                    <div class="profile-section-divider">
                                        <h5><i class="fas fa-calendar-alt"></i> Availability</h5>
                                        <div class="availability-grid">
                                            @php
                                                $availability = $doctor->availability ? json_decode($doctor->availability, true) : [];
                                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                            @endphp
                                            @foreach($days as $day)
                                                <div class="availability-day">
                                                    <span class="day-name">{{ $day }}</span>
                                                    @if(isset($availability[strtolower($day)]) && $availability[strtolower($day)]['enabled'])
                                                        <span class="time-slot">
                                                            {{ $availability[strtolower($day)]['start'] }} - {{ $availability[strtolower($day)]['end'] }}
                                                        </span>
                                                    @else
                                                        <span class="time-slot unavailable">Unavailable</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="profile-section-divider">
                                        <h5><i class="fas fa-university"></i> Bank Details</h5>
                                        <div class="bank-details-grid">
                                            @php
                                                $bankDetails = $doctor->bankdetails ? json_decode($doctor->bankdetails, true) : [];
                                            @endphp
                                            @if(count($bankDetails) > 0)
                                                @foreach($bankDetails as $bank)
                                                    <div class="bank-detail-card">
                                                        <div class="bank-info">
                                                            <span class="bank-name">{{ $bank['bank_name'] }}</span>
                                                            <span class="account-name">{{ $bank['account_name'] }}</span>
                                                            <span class="account-number">{{ $bank['account_number'] }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No bank details added yet.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Profile Section -->
                        <div id="editProfile" class="profile-section" style="display:none;">
                            <div class="profile-card">
                                <form action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Profile Image Upload -->
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="form-group profile-image-upload">
                                                <label>Profile Image</label>
                                                <div class="image-upload-container">
                                                    <div id="imagePreview" class="image-preview">
                                                        @if ($doctor->profile_image)
                                                            <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="Current Profile Image">
                                                        @else
                                                            <div class="image-placeholder">
                                                                <i class="fas fa-user-circle"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <input type="file" name="profile_image" accept="image/*" id="imageUpload" class="image-input" onchange="previewImage(event)">
                                                    <label for="imageUpload" class="image-upload-label">
                                                        <i class="fas fa-camera"></i> Change Photo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Basic Information -->
                                        <div class="col-lg-8 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Name*</label>
                                                <input class="form-control" type="text" name="name" value="{{ $doctor->name }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Email*</label>
                                                <input class="form-control" type="email" value="{{ $doctor->email }}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label>Contact Number*</label>
                                                <input class="form-control" type="text" name="contact_number" value="{{ $doctor->contact_number }}" required>
                                            </div>
                                        </div>

                                        <!-- Professional Information -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Specialization*</label>
                                                <input class="form-control" type="text" name="specialization" value="{{ $doctor->specialization }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sub-specialization</label>
                                                <input class="form-control" type="text" name="sub_specialization" value="{{ $doctor->sub_specialization }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Years of Experience*</label>
                                                <input class="form-control" type="number" name="experience_years" value="{{ $doctor->experience_years }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Consultation Fee*</label>
                                                <input class="form-control" type="number" step="0.01" name="consultation_fee" value="{{ $doctor->consultation_fee }}" required>
                                            </div>
                                        </div>

                                        <!-- Location Information -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Clinic Address*</label>
                                                <input class="form-control" type="text" name="clinic_address" value="{{ $doctor->clinic_address }}" required>
                                            </div>
                                        </div>

                                        <!-- Qualifications -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Qualifications*</label>
                                                <textarea class="form-control" name="qualifications" rows="3" required>{{ $doctor->qualifications }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Bio -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Bio</label>
                                                <textarea class="form-control" name="bio" rows="4">{{ $doctor->bio }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Bank Details -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Bank Details</label>
                                                <div id="bankDetailsContainer">
                                                    @php
                                                        $bankDetails = $doctor->bankdetails ? json_decode($doctor->bankdetails, true) : [];
                                                    @endphp
                                                    @if(count($bankDetails) > 0)
                                                        @foreach($bankDetails as $index => $bank)
                                                            <div class="bank-detail-row mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="bankdetails[{{$index}}][bank_name]" placeholder="Bank Name" value="{{ $bank['bank_name'] ?? '' }}">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control" name="bankdetails[{{$index}}][account_name]" placeholder="Account Name" value="{{ $bank['account_name'] ?? '' }}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" name="bankdetails[{{$index}}][account_number]" placeholder="Account Number" value="{{ $bank['account_number'] ?? '' }}">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-danger remove-bank" onclick="removeBankDetail(this)">×</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="bank-detail-row mb-3">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="bankdetails[0][bank_name]" placeholder="Bank Name">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" name="bankdetails[0][account_name]" placeholder="Account Name">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="bankdetails[0][account_number]" placeholder="Account Number">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button type="button" class="btn btn-danger remove-bank" onclick="removeBankDetail(this)">×</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-secondary mt-2" onclick="addBankDetail()">
                                                    <i class="fas fa-plus"></i> Add Another Bank Account
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Availability -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Availability*</label>
                                                <div class="availability-edit-container">
                                                    @php
                                                        $availability = $doctor->availability ? json_decode($doctor->availability, true) : [];
                                                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                                    @endphp
                                                    @foreach($days as $day)
                                                        <div class="availability-edit-day">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input day-checkbox" 
                                                                       name="availability[{{ strtolower($day) }}][enabled]"
                                                                       {{ isset($availability[strtolower($day)]['enabled']) && $availability[strtolower($day)]['enabled'] ? 'checked' : '' }}>
                                                                <label class="form-check-label">{{ $day }}</label>
                                                            </div>
                                                            <div class="time-slots">
                                                                <input type="time" class="form-control form-control-sm" 
                                                                       name="availability[{{ strtolower($day) }}][start]"
                                                                       value="{{ $availability[strtolower($day)]['start'] ?? '09:00' }}">
                                                                <span class="mx-2">to</span>
                                                                <input type="time" class="form-control form-control-sm" 
                                                                       name="availability[{{ strtolower($day) }}][end]"
                                                                       value="{{ $availability[strtolower($day)]['end'] ?? '17:00' }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Update Profile
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

        /* Profile Styles */
        .profile-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .profile-header {
            margin-bottom: 30px;
        }

        .profile-image-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #604BB0;
            box-shadow: 0 0 15px rgba(96, 75, 176, 0.3);
        }

        .profile-image-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: #ccc;
            border: 4px solid #604BB0;
        }

        .profile-name {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }

        .profile-specialization {
            color: #604BB0;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .profile-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .info-item i {
            font-size: 20px;
            color: #604BB0;
            margin-right: 15px;
            margin-top: 3px;
        }

        .info-content label {
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
            display: block;
        }

        .info-content p {
            margin: 0;
            color: #333;
        }

        .profile-section-divider {
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .profile-section-divider h5 {
            color: #604BB0;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .profile-section-divider h5 i {
            margin-right: 10px;
        }

        /* Availability Styles */
        .availability-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .availability-day {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .day-name {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .time-slot {
            color: #604BB0;
            font-size: 14px;
        }

        .time-slot.unavailable {
            color: #dc3545;
        }

        /* Edit Mode Styles */
        .availability-edit-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }

        .availability-edit-day {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .time-slots {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .time-slots input {
            width: 120px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #604BB0;
            box-shadow: 0 0 0 0.2rem rgba(96, 75, 176, 0.25);
        }

        /* Button Styles */
        .profile-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background: #f0f0f0;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .profile-btn.active {
            background: #604BB0;
            color: white;
        }

        .btn-primary {
            background: #604BB0;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #4a3a8c;
            transform: translateY(-2px);
        }

        /* Image Upload Styles */
        .image-upload-container {
            text-align: center;
        }

        .image-preview {
            width: 150px;
            height: 150px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: #ccc;
        }

        .image-input {
            display: none;
        }

        .image-upload-label {
            display: inline-block;
            padding: 8px 20px;
            background: #604BB0;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-upload-label:hover {
            background: #4a3a8c;
        }

        .bank-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .bank-detail-card {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .bank-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .bank-name {
            font-weight: 600;
            color: #604BB0;
        }

        .account-name {
            color: #666;
        }

        .account-number {
            color: #333;
            font-family: monospace;
        }

        .map-container {
            width: 100%;
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .bank-detail-row {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .remove-bank {
            padding: 0;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
        }
    </style>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/active.js"></script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            }
        }

        function showViewProfile() {
            document.getElementById('viewProfile').style.display = 'block';
            document.getElementById('editProfile').style.display = 'none';
            document.getElementById('viewProfileBtn').classList.add('active');
            document.getElementById('editProfileBtn').classList.remove('active');
        }

        function showEditProfile() {
            document.getElementById('viewProfile').style.display = 'none';
            document.getElementById('editProfile').style.display = 'block';
            document.getElementById('viewProfileBtn').classList.remove('active');
            document.getElementById('editProfileBtn').classList.add('active');
        }

        // Initialize time slots visibility based on checkboxes
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.day-checkbox');
            checkboxes.forEach(checkbox => {
                const timeSlots = checkbox.closest('.availability-edit-day').querySelector('.time-slots');
                timeSlots.style.display = checkbox.checked ? 'flex' : 'none';
                
                checkbox.addEventListener('change', function() {
                    timeSlots.style.display = this.checked ? 'flex' : 'none';
                });
            });
        });

        function addBankDetail() {
            const container = document.getElementById('bankDetailsContainer');
            const rows = container.getElementsByClassName('bank-detail-row');
            const newIndex = rows.length;
            
            const newRow = document.createElement('div');
            newRow.className = 'bank-detail-row mb-3';
            newRow.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="bankdetails[${newIndex}][bank_name]" placeholder="Bank Name">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="bankdetails[${newIndex}][account_name]" placeholder="Account Name">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="bankdetails[${newIndex}][account_number]" placeholder="Account Number">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-bank" onclick="removeBankDetail(this)">×</button>
                    </div>
                </div>
            `;
            
            container.appendChild(newRow);
        }

        function removeBankDetail(button) {
            const row = button.closest('.bank-detail-row');
            row.remove();
        }
    </script>
</body>
</html>

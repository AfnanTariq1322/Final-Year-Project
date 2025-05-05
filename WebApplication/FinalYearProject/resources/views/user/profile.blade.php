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

    <link rel="stylesheet" href="../css/animate.min.css">

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


    
    <div class="inflanar-preview__modal modal fade" id="logout_modal" tabindex="-1" aria-labelledby="logoutmodal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered inflanar-preview__logout">
            <div class="modal-content">
                <div class="modal-header inflanar__modal__header">
                    <h4 class="modal-title inflanar-preview__modal-title" id="logoutmodal">Confirm</h4>
                    <button type="button" class="inflanar-preview__modal--close btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-remove"></i>
                    </button>
                </div>
                <div class="modal-body inflanar-modal__body">
                    <div class="inflanar-preview__close">
                        <div class="inflanar-preview__close-img">
                            <img src="../img/in-logout-icon.svg" alt="#">
                        </div>
                        <h2 class="inflanar-preview__close-title">Are you sure you want to Logout <span> </span>
                        </h2>

                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <div class="inflanar__item-button--group">
                            <button class="inflanar-btn" type="button"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Yes
                                Logout</button>
                            <button class="inflanar-btn inflanar-btn__cancel" data-bs-dismiss="modal">
                                <span class="ntfmax__btn-textgr">Cancel</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Style for profile buttons */
    .profile-navigation {
        text-align: left;
        /* Align buttons to the left */
        margin-bottom: 20px;
    }

    .profile-btn {
        padding: 10px 20px;
        border: 2px solid #604BB0;
        /* Button border */
        background-color: #fff;
        /* Inactive button background */
        color: #604BB0;
        /* Inactive button text color */
        cursor: pointer;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin-right: 10px;
        /* Space between buttons */
    }

    /* Hover effect for buttons */
    .profile-btn:hover {
        background-color: #604BB0;
        color: #fff;
    }

    /* Active button style */
    .profile-btn.active {
        background-color: #604BB0;
        /* Active button background */
        color: #fff;
        /* Active button text color */
    }

    /* Custom styles for form elements */

    .inflanar-form-input label {
        font-weight: bold;
    }

    /* Style submit button */


    /* Checkbox styling */
    .inflanar-signin__checkbox label {
        font-size: 0.9em;
    }
    </style>


    <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="inflanar-personals">
                <div class="row">

                    @include('user.includes.sidebar')

                    <div class="col-lg-9 col-md-8 col-12 inflanar-personals__content mg-top-30">
                   <!-- Profile Container -->
<div class="inflanar-supports">
    <!-- Navigation buttons -->
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
                    @if ($LoggedUserInfo->image)
                        <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}" alt="Profile Image" class="profile-image">
                    @else
                        <div class="profile-image-placeholder">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    @endif
                </div>
                <h4 class="profile-name">{{ $LoggedUserInfo->name }}</h4>
            </div>

            <div class="profile-content">
                <div class="profile-info-grid">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div class="info-content">
                            <label>Email</label>
                            <p>{{ $LoggedUserInfo->email }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div class="info-content">
                            <label>Phone</label>
                            <p>{{ $LoggedUserInfo->phone ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-globe"></i>
                        <div class="info-content">
                            <label>Location</label>
                            <p>{{ $LoggedUserInfo->city ?? 'Not provided' }}, {{ $LoggedUserInfo->country ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="info-content">
                            <label>Address</label>
                            <p>{{ $LoggedUserInfo->address ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>

                <div class="profile-section-divider">
                    <h5><i class="fas fa-history"></i> Medical History</h5>
                    <p>{{ $LoggedUserInfo->medical_history ?? 'Not provided' }}</p>
                </div>

                <div class="profile-section-divider">
                    <h5><i class="fas fa-clipboard-list"></i> Symptoms</h5>
                    <div class="symptoms-list">
                        @php
                            if (is_string($LoggedUserInfo->symptoms)) {
                                $symptomsArray = explode(',', $LoggedUserInfo->symptoms);
                            } elseif (is_array($LoggedUserInfo->symptoms)) {
                                $symptomsArray = $LoggedUserInfo->symptoms;
                            } else {
                                $symptomsArray = [];
                            }
                        @endphp
                        @forelse ($symptomsArray as $symptom)
                            <span class="symptom-tag">{{ trim($symptom) }}</span>
                        @empty
                            <span class="symptom-tag">No symptoms recorded</span>
                        @endforelse
                    </div>
                </div>

                <div class="profile-section-divider">
                    <h5><i class="fas fa-eye"></i> Eye Information</h5>
                    <div class="eye-info-grid">
                        <div class="info-item">
                            <label>Visual Acuity</label>
                            <p>{{ $LoggedUserInfo->visual_acuity ?? 'Not provided' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Eye Condition</label>
                            <p>{{ $LoggedUserInfo->eye_condition ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Section -->
    <div id="editProfile" class="profile-section" style="display:none;">
        <div class="profile-card">
            <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Profile Image Upload -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group profile-image-upload">
                            <label>Profile Image</label>
                            <div class="image-upload-container">
                                <div id="imagePreview" class="image-preview">
                                    @if ($LoggedUserInfo->image)
                                        <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}" alt="Current Profile Image">
                                    @else
                                        <div class="image-placeholder">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" name="image" accept="image/*" id="imageUpload" class="image-input" onchange="previewImage(event)">
                                <label for="imageUpload" class="image-upload-label">
                                    <i class="fas fa-camera"></i> Change Photo
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="col-lg-8 col-md-6 col-12">
                        <div class="form-group">
                            <label>First Name*</label>
                            <input class="form-control" type="text" name="name" value="{{ $LoggedUserInfo->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email*</label>
                            <input class="form-control" type="email" value="{{ $LoggedUserInfo->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone" value="{{ $LoggedUserInfo->phone }}">
                        </div>
                    </div>

                    <!-- Location Information -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label>Country</label>
                            <input class="form-control" type="text" name="country" value="{{ $LoggedUserInfo->country }}">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" value="{{ $LoggedUserInfo->city }}">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" name="address" value="{{ $LoggedUserInfo->address }}">
                        </div>
                    </div>

                    <!-- Medical Information -->
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Medical History</label>
                            <textarea class="form-control" name="medical_history" rows="4">{{ $LoggedUserInfo->medical_history }}</textarea>
                        </div>
                    </div>

                    <!-- Symptoms -->
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Symptoms</label>
                            <select class="form-control select2" name="symptoms[]" multiple="multiple">
                                @php
                                    if (is_string($LoggedUserInfo->symptoms)) {
                                        $selectedSymptoms = explode(',', $LoggedUserInfo->symptoms);
                                    } elseif (is_array($LoggedUserInfo->symptoms)) {
                                        $selectedSymptoms = $LoggedUserInfo->symptoms;
                                    } else {
                                        $selectedSymptoms = [];
                                    }
                                @endphp
                                <option value="Blurred Vision" {{ in_array('Blurred Vision', $selectedSymptoms) ? 'selected' : '' }}>Blurred Vision</option>
                                <option value="Eye Pain" {{ in_array('Eye Pain', $selectedSymptoms) ? 'selected' : '' }}>Eye Pain</option>
                                <option value="Redness" {{ in_array('Redness', $selectedSymptoms) ? 'selected' : '' }}>Redness</option>
                                <option value="Sensitivity to Light" {{ in_array('Sensitivity to Light', $selectedSymptoms) ? 'selected' : '' }}>Sensitivity to Light</option>
                                <option value="Dry Eyes" {{ in_array('Dry Eyes', $selectedSymptoms) ? 'selected' : '' }}>Dry Eyes</option>
                                <option value="Watery Eyes" {{ in_array('Watery Eyes', $selectedSymptoms) ? 'selected' : '' }}>Watery Eyes</option>
                                <option value="Eye Strain" {{ in_array('Eye Strain', $selectedSymptoms) ? 'selected' : '' }}>Eye Strain</option>
                                <option value="Double Vision" {{ in_array('Double Vision', $selectedSymptoms) ? 'selected' : '' }}>Double Vision</option>
                            </select>
                        </div>
                    </div>

                    <!-- Eye Information -->
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Visual Acuity</label>
                            <select class="form-control" name="visual_acuity">
                                <option value="">Select Visual Acuity Level</option>
                                <option value="20/20" {{ $LoggedUserInfo->visual_acuity == '20/20' ? 'selected' : '' }}>20/20 (Normal)</option>
                                <option value="20/40" {{ $LoggedUserInfo->visual_acuity == '20/40' ? 'selected' : '' }}>20/40 (Mild Vision Loss)</option>
                                <option value="20/60" {{ $LoggedUserInfo->visual_acuity == '20/60' ? 'selected' : '' }}>20/60 (Moderate Vision Loss)</option>
                                <option value="20/80" {{ $LoggedUserInfo->visual_acuity == '20/80' ? 'selected' : '' }}>20/80 (Severe Vision Loss)</option>
                                <option value="20/200" {{ $LoggedUserInfo->visual_acuity == '20/200' ? 'selected' : '' }}>20/200 (Legally Blind)</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Eye Condition</label>
                            <input class="form-control" type="text" name="eye_condition" value="{{ $LoggedUserInfo->eye_condition }}">
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

<style>
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
    box-shadow: 0 0 15px rgba(76, 175, 80, 0.3);
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
    color:#604BB0;
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

.symptoms-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.symptom-tag {
    background: #e8f5e9;
    color: #604BB0;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
}

.eye-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
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
    box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
}

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
    background:#604BB0;;
    color: white;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.image-upload-label:hover {
    background: #604BB0;
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
    background:#604BB0;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #604BB0;
    transform: translateY(-2px);
}

/* Select2 Customization */
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 5px;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #604BB0;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: #e8f5e9;
    border: none;
    border-radius: 15px;
    padding: 5px 10px;
 }

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #604BB0;
    
}

/* Alert Styles */
.alert {
    border-radius: 10px;
    padding: 10px 20px;
    margin-left: 15px;
}

 
</style>

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

// Initialize Select2
$(document).ready(function() {
    $('.select2').select2({
        theme: 'classic',
        width: '100%'
    });
});
</script>
                    </div>

                    <!-- JavaScript for toggling sections -->
                    <script>
                    function showViewProfile() {
                        document.getElementById('viewProfile').style.display = 'block';
                        document.getElementById('editProfile').style.display = 'none';
                        document.getElementById('viewProfileBtn').classList.add('active');
                        document.getElementById('editProfileBtn').classList.remove('active');
                    }

                    function showEditProfile() {
                        document.getElementById('viewProfile').style.display = 'none';
                        document.getElementById('editProfile').style.display = 'block';
                        document.getElementById('editProfileBtn').classList.add('active');
                        document.getElementById('viewProfileBtn').classList.remove('active');
                    }

                    // Initial state
                    showViewProfile(); // Show view profile by default
                    </script>

                </div>
            </div>
        </div>
    </section>


    <section class="footer-cta inflanar-bg-cover section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="footer-cta__inner inflanar-bg-cover  inflanar-section-shape3">
                        <div class="footer-cta__content">
                            <h3 class="footer-cta__title color-white">Let influencers do the heavy lifting for your
                                marketing
                                campaign</h3>
                            
                        </div>
                        <div class="footer-cta__img">
                            <img src="../img/homefooter.png" style=" float: right; margin-bottom:5px;max-width:60%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('user.includes.footer')



 

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>

    <script src="../js/aos.min.js"></script>

    <script src="../js/ckeditor.min.js"></script>

    <script src="../js/fullcalendar.min.js"></script>

    <script src="../js/select2-js.min.js"></script>

    <script src="../js/video-popup.min.js"></script>

    <script src="../js/swiper-slider.min.js"></script>

    <script src="../js/waypoints.min.js"></script>

    <script src="../js/jquery.counterup.min.js"></script>

    <script src="../js/active.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('inflanar-calender');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            defaultView: 'timeGridWeek',
            contentHeight: 'auto',
            height: '100%',
            fixedWeekCount: false,
            showNonCurrentDates: true,
            columnHeaderFormat: {
                week: 'ddd'
            }
        });
        calendar.render();
    });
    </script>
    <script>
    ClassicEditor
        .create(document.querySelector('#ckdesc1'))
        .catch(error => {
            console.error(error);
        });
    </script>
    <script>
    /* Testimonial Slider */
    var swiper = new Swiper(".inflanar-slider-testimonial", {
        autoplay: {
            delay: 3333500,
        },
        mousewheel: true,
        keyboard: true,
        loop: true,
        grabCursor: true,
        spaceBetween: 30,
        centeredSlides: false,
        pagination: {
            el: '.swiper-pagination__testimonial',
            type: 'bullets',
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: "1",
            },
            428: {
                slidesPerView: "1",
            },
            768: {
                slidesPerView: "1",
            },
            1024: {
                slidesPerView: "2",
            },
        },
    });
    </script>
</body>

</html>
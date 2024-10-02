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
                            <img src="{{ asset('path/to/default/image.png') }}" alt="Default Image" class="user-image"
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
                                                <li class="active"><a href="/home">Home</a>
                                                </li>
                                                <li><a href="/about">About</a></li>
                                                <li><a href="/blogs">Our Blogs</a></li>
                                                <li><a href="">Diseases</a></li>
                                                <li><a href="">Contact Us</a></li>
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


    <section class="inflanar-breadcrumb">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="inflanar-breadcrumb__inner">
                        <div class="inflanar-breadcrumb__content">
                            <h2 class="inflanar-breadcrumb__title m-0">User Dashboard</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="https://createrdirect.corammerswork.com/">Home</a></li>
                                <li class="active"><a href="dashboard.html">User Dashboard</a></li>
                            </ul>
                        </div>
                        <div class="inflanar-breadcrumb__img">
                            <div class="inflanar-breadcrumb__thumb">
                                <img src="img/in-bread-thumb.png">
                            </div>
                            <div class="inflanar-breadcrumb__group">
                                <img src="img/in-social-group.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                        <div class="inflanar-supports">
                            <!-- Navigation buttons -->

                            <div class="profile-navigation d-flex align-items-center">
                                <button id="viewProfileBtn" class="profile-btn active" onclick="showViewProfile()">View
                                    Profile</button>
                                <button id="editProfileBtn" class="profile-btn" onclick="showEditProfile()">Edit
                                    Profile</button>

                                @if(session('success'))
                                <div class="alert alert-success mb-0 ms-3" role="alert">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>




                            <!-- View Profile Section -->
                            <div id="viewProfile" class="profile-section">
                                <h4>User Profile</h4>

                                <div class="profile-image">
                                    @if ($LoggedUserInfo->image)
                                    <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}" alt="Profile Image"
                                        width="150"
                                        style="border-radius: 50%; border: 2px solid #ccc; margin-bottom: 20px;">
                                    @else
                                    <p>No image uploaded</p>
                                    @endif
                                </div>

                                <p><strong>First Name:</strong> {{ $LoggedUserInfo->name }}</p>
                                <p><strong>Email:</strong> {{ $LoggedUserInfo->email }}</p>
                                <p><strong>Phone:</strong> {{ $LoggedUserInfo->phone ?? 'Not provided' }}</p>
                                <p><strong>Country:</strong> {{ $LoggedUserInfo->country ?? 'Not provided' }}</p>
                                <p><strong>Town/City:</strong> {{ $LoggedUserInfo->city ?? 'Not provided' }}</p>
                                <p><strong>Address:</strong> {{ $LoggedUserInfo->address ?? 'Not provided' }}</p>
                                <p><strong>Blood Group:</strong> {{ $LoggedUserInfo->bloodgroup ?? 'Not provided' }}</p>
                                <p><strong>Blood Pressure:</strong>
                                    {{ $LoggedUserInfo->bloodpressure ?? 'Not provided' }}</p>
                            </div>



                            <!-- Edit Profile Section -->
                            <div id="editProfile" class="profile-section" style="display:none;">
                                <form action="{{ route('user.updateProfile') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- First Name -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>First Name*</label>
                                                <input class="ecom-wc__form-input" type="text" name="name"
                                                    value="{{ $LoggedUserInfo->name }}" placeholder="First Name"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Profile Image</label>
                                                <input class="ecom-wc__form-input" type="file" name="image"
                                                    accept="image/*" id="imageUpload" onchange="previewImage(event)">
                                                <div id="imagePreview" style="margin-top: 10px;">
                                                    @if ($LoggedUserInfo->image)
                                                    <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}"
                                                        alt="Current Profile Image" width="150"
                                                        style="border-radius: 50%; border: 2px solid #ccc;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email (Disabled) -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Email*</label>
                                                <input class="ecom-wc__form-input" type="email" name="email"
                                                    value="{{ $LoggedUserInfo->email }}" disabled>
                                            </div>
                                        </div>

                                        <!-- Blood Group -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Blood Group</label>
                                                <select class="ecom-wc__form-input" name="bloodgroup">
                                                    <option value="A+"
                                                        {{ $LoggedUserInfo->bloodgroup == 'A+' ? 'selected' : '' }}>A+
                                                    </option>
                                                    <option value="A-"
                                                        {{ $LoggedUserInfo->bloodgroup == 'A-' ? 'selected' : '' }}>A-
                                                    </option>
                                                    <option value="B+"
                                                        {{ $LoggedUserInfo->bloodgroup == 'B+' ? 'selected' : '' }}>B+
                                                    </option>
                                                    <option value="B-"
                                                        {{ $LoggedUserInfo->bloodgroup == 'B-' ? 'selected' : '' }}>B-
                                                    </option>
                                                    <option value="AB+"
                                                        {{ $LoggedUserInfo->bloodgroup == 'AB+' ? 'selected' : '' }}>AB+
                                                    </option>
                                                    <option value="AB-"
                                                        {{ $LoggedUserInfo->bloodgroup == 'AB-' ? 'selected' : '' }}>AB-
                                                    </option>
                                                    <option value="O+"
                                                        {{ $LoggedUserInfo->bloodgroup == 'O+' ? 'selected' : '' }}>O+
                                                    </option>
                                                    <option value="O-"
                                                        {{ $LoggedUserInfo->bloodgroup == 'O-' ? 'selected' : '' }}>O-
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Blood Pressure -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Blood Pressure</label>
                                                <select class="ecom-wc__form-input" name="bloodpressure">
                                                    <option value="normal"
                                                        {{ $LoggedUserInfo->bloodpressure == 'normal' ? 'selected' : '' }}>
                                                        Normal</option>
                                                    <option value="low"
                                                        {{ $LoggedUserInfo->bloodpressure == 'low' ? 'selected' : '' }}>
                                                        Low</option>
                                                    <option value="high"
                                                        {{ $LoggedUserInfo->bloodpressure == 'high' ? 'selected' : '' }}>
                                                        High</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Phone</label>
                                                <input class="ecom-wc__form-input" type="text" name="phone"
                                                    value="{{ $LoggedUserInfo->phone }}" placeholder="Phone">
                                            </div>
                                        </div>

                                        <!-- Country -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Country</label>
                                                <input class="ecom-wc__form-input" type="text" name="country"
                                                    value="{{ $LoggedUserInfo->country }}" placeholder="Country">
                                            </div>
                                        </div>

                                        <!-- City -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>City</label>
                                                <input class="ecom-wc__form-input" type="text" name="city"
                                                    value="{{ $LoggedUserInfo->city }}" placeholder="City">
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Address</label>
                                                <input class="ecom-wc__form-input" type="text" name="address"
                                                    value="{{ $LoggedUserInfo->address }}" placeholder="Address">
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12">
                                            <div class="form-group mg-top-40">
                                                <button type="submit" class="inflanar-btn"><span>Update
                                                        Profile</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <script>
                                function previewImage(event) {
                                    const imagePreview = document.getElementById('imagePreview');
                                    imagePreview.innerHTML = ''; // Clear previous image

                                    const file = event.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            const img = document.createElement('img');
                                            img.src = e.target.result;
                                            img.alt = 'Profile Image Preview';
                                            img.width = 150; // Set the width of the preview image
                                            img.style.borderRadius = '50%'; // Make it circular
                                            img.style.border = '2px solid #ccc'; // Add border
                                            img.style.marginTop = '10px'; // Add margin
                                            imagePreview.appendChild(img);
                                        }
                                        reader.readAsDataURL(file);
                                    }
                                }
                                </script>


                            </div>
                        </div>
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
                            <a href="contact.html" class="inflanar-btn inflanar-btn__big inflanar-btn-dark"><span>Signup
                                    Now!</span></a>
                        </div>
                        <div class="footer-cta__img">
                            <img src="img/in-footer-cta.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('user.includes.footer')



    <a href="#" class="scrollToTop"><img src="img/output-onlinepngtools (32).png"></a>


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
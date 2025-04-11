<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Dashboard</title>

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
                        @if (session('LoggedUserInfo'))
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
                    @if (session('LoggedUserInfo'))
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
                                @if (session('LoggedUserInfo'))
                                    <span class="user-name">
                                        <a href="{{ route('user.dashboard') }}">
                                            @if ($LoggedUserInfo->image)
                                                <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}"
                                                    alt="Profile Image" class="user-image"
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

                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                            style="display: none;">
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


    <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="inflanar-personals">
                <div class="row">

                    @include('user.includes.sidebar')
                    <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content">
                                           <!-- Stats Cards -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                            <div class="inflanar-pdbox">
                                <div class="inflanar-pdbox__icon">
                                    <i class="fas fa-camera-retro fa-2x"></i>
                                </div>
                                <div class="inflanar-pdbox__content">
                                    <h4 class="inflanar-pdbox__title">
                                        <span>Total Fundus Images</span>
                                        <strong>{{ $LoggedUserInfo->fundus_images_count ?? '0' }}</strong>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                            <div class="inflanar-pdbox inflanar-pdbox__2">
                                <div class="inflanar-pdbox__icon">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                </div>
                                <div class="inflanar-pdbox__content">
                                    <h4 class="inflanar-pdbox__title">
                                        <span>Acute Cases Detected</span>
                                        <strong>{{ $LoggedUserInfo->acute_cases_count ?? '0' }}</strong>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mg-top-30">
                            <div class="inflanar-pdbox inflanar-pdbox__3">
                                <div class="inflanar-pdbox__icon">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                                <div class="inflanar-pdbox__content">
                                    <h4 class="inflanar-pdbox__title">
                                        <span>Latest Classification</span>
                                        <strong>{{ $LoggedUserInfo->latest_classification ?? 'No Data' }}</strong>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

<style>
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
    color:black;
    margin-bottom: 5px;
}

.inflanar-pdbox__title strong {
    color: black;
    font-size: 18px;
}

/* Acute Cases Warning Style */
.inflanar-pdbox__2 .inflanar-pdbox__icon {
    background: rgba(255, 87, 87, 0.1);
}

.inflanar-pdbox__2 .inflanar-pdbox__icon i {
    color: #ff5757;
}

/* Latest Classification Style */
.inflanar-pdbox__3 .inflanar-pdbox__icon {
    background: rgba(46, 204, 113, 0.1);
}

.inflanar-pdbox__3 .inflanar-pdbox__icon i {
    color: #2ecc71;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .inflanar-pdbox {
        padding: 20px;
    }
    
    .inflanar-pdbox__icon {
        width: 50px;
        height: 50px;
    }
    
    .inflanar-pdbox__icon i {
        font-size: 20px;
    }
    
    .inflanar-pdbox__title strong {
        font-size: 16px;
    }
}
</style>

                        <!-- Profile Information Card -->
                        <div class="inflanar-profile-info mg-top-30">
                            <div class="inflanar-profile-info__head">
                                <h3 class="inflanar-profile-info__heading" style="color:white;">
                                    <i class="fas fa-user-circle"></i> Personal Information
                                </h3>
                            </div>
                            <div class="inflanar-profile-info__content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="info-section">
                                            <div class="info-item">
                                                <i class="fas fa-user"></i>
                                                <div class="info-content">
                                                    <label>First Name</label>
                                                    <p>{{ $LoggedUserInfo->name }}</p>
                                                </div>
                                            </div>
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
                                                    <p>{{ $LoggedUserInfo->city ?? 'Not provided' }},
                                                        {{ $LoggedUserInfo->country ?? 'Not provided' }}</p>
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
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="info-section">
                                            <div class="info-item">
                                                <i class="fas fa-eye"></i>
                                                <div class="info-content">
                                                    <label>Visual Acuity</label>
                                                    <p>{{ $LoggedUserInfo->visual_acuity ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-clipboard-list"></i>
                                                <div class="info-content">
                                                    <label>Eye Condition</label>
                                                    <p>{{ $LoggedUserInfo->eye_condition ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-history"></i>
                                                <div class="info-content">
                                                    <label>Medical History</label>
                                                    <p>{{ $LoggedUserInfo->medical_history ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-notes-medical"></i>
                                                <div class="info-content">
                                                    <label>Symptoms</label>
                                                    <div class="symptoms-list">
                                                        @php
                                                            $symptomsArray = explode(',', $LoggedUserInfo->symptoms);
                                                        @endphp
                                                        @foreach ($symptomsArray as $symptom)
                                                            <span class="symptom-tag">{{ trim($symptom) }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
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
                                position: relative;
                                overflow: hidden;
                            }

                            .inflanar-profile-info__head::before {
                                content: '';
                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                background: linear-gradient(45deg, rgba(96, 75, 176, 0.8), rgba(96, 75, 176, 0.6));
                                z-index: 1;
                            }

                            .inflanar-profile-info__heading {
                                margin: 0;
                                font-size: 20px;
                                display: flex;
                                align-items: center;
                                position: relative;
                                z-index: 2;
                            }

                            .inflanar-profile-info__heading i {
                                margin-right: 10px;
                                font-size: 24px;
                                color: white;
                            }

                            .inflanar-profile-info__content {
                                padding: 30px;
                                background: #fff;
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
                                border: 1px solid rgba(96, 75, 176, 0.1);
                            }

                            .info-item:hover {
                                background: rgba(96, 75, 176, 0.05);
                                transform: translateX(5px);
                                box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
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
                                transition: all 0.3s ease;
                            }

                            .info-item:hover i {
                                background: #604BB0;
                                color: #fff;
                            }

                            .info-content {
                                flex: 1;
                            }

                            .info-content label {
                                display: block;
                                font-size: 14px;
                                color: #666;
                                margin-bottom: 5px;
                                font-weight: 500;
                            }

                            .info-content p {
                                margin: 0;
                                font-size: 16px;
                                color: #333;
                                font-weight: 500;
                                line-height: 1.5;
                            }

                            /* Symptoms List */
                            .symptoms-list {
                                display: flex;
                                flex-wrap: wrap;
                                gap: 8px;
                                margin-top: 5px;
                            }

                            .symptom-tag {
                                background: rgba(96, 75, 176, 0.1);
                                color: #604BB0;
                                padding: 6px 12px;
                                border-radius: 15px;
                                font-size: 13px;
                                font-weight: 500;
                            }

                            /* Responsive Adjustments */
                            @media (max-width: 768px) {
                                .inflanar-profile-info__content {
                                    padding: 20px;
                                }

                                .info-item {
                                    padding: 15px;
                                    margin-bottom: 15px;
                                }

                                .info-item i {
                                    width: 40px;
                                    height: 40px;
                                    font-size: 18px;
                                }

                                .symptoms-list {
                                    gap: 6px;
                                }

                                .symptom-tag {
                                    padding: 4px 10px;
                                    font-size: 12px;
                                }
                            }
                        </style>


                    </div>
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

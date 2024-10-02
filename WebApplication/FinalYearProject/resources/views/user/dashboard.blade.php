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
                                            <li class="active"><a
                                                    href="/home">Home</a>
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
                <img src="{{ asset('storage/' . $LoggedUserInfo->image) }}" alt="Profile Image" class="user-image" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
            @else
                <img src="{{ asset('path/to/default/image.png') }}" alt="     " class="user-image" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; margin-right: 10px;">
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


    <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="inflanar-personals">
                <div class="row">

                    @include('user.includes.sidebar')
                    <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30">

                                <div class="inflanar-pdbox">
                                    <div class="inflanar-pdbox__icon">
                                        <img src="img/in-dicon.svg">
                                    </div>
                                    <div class="inflanar-pdbox__content">
                                        <h4 class="inflanar-pdbox__title">
                                            <span>Current Balance</span> $5000
                                        </h4>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30">

                                <div class="inflanar-pdbox inflanar-pdbox__2">
                                    <div class="inflanar-pdbox__icon">
                                        <img src="img/in-dicon3.svg">
                                    </div>
                                    <div class="inflanar-pdbox__content">
                                        <h4 class="inflanar-pdbox__title">
                                            <span>Completed Order</span> 50
                                        </h4>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30">

                                <div class="inflanar-pdbox inflanar-pdbox__3">
                                    <div class="inflanar-pdbox__icon">
                                        <img src="img/in-dicon2.svg">
                                    </div>
                                    <div class="inflanar-pdbox__content">
                                        <h4 class="inflanar-pdbox__title">
                                            <span>Total Order</span> 1025
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="inflanar-profile-info mg-top-30">
    <div class="inflanar-profile-info__head">
        <h3 class="inflanar-profile-info__heading">Personal Information</h3>
    </div>
    <ul class="inflanar-profile-info__list inflanar-dflex-column list-none">
        <li class="inflanar-dflex">
            <p><strong>First Name:</strong> {{ $LoggedUserInfo->name }}</p>
        </li>
        <li class="inflanar-dflex">
            <p><strong>Email:</strong> {{ $LoggedUserInfo->email }}</p>
        </li>
        <li class="inflanar-dflex">
            <p><strong>Phone:</strong> {{ $LoggedUserInfo->phone ?? 'Not provided' }}</p>
        </li>
        <li class="inflanar-dflex">
            <p><strong>Country:</strong> {{ $LoggedUserInfo->country ?? 'Not provided' }}</p>
        </li>
        <li class="inflanar-dflex">
            <p><strong>Town/City:</strong> {{ $LoggedUserInfo->city ?? 'Not provided' }}</p>
        </li>
        <li class="inflanar-dflex">
            <p><strong>Address:</strong> {{ $LoggedUserInfo->address ?? 'Not provided' }}</p>
        </li>
        <li class="inflanar-dflex">
            <p><strong>Blood Group:</strong> {{ $LoggedUserInfo->bloodgroup ?? 'Not provided' }}</p>
        </li>
        <li class="inflanar-dflex">
            <p><strong>Blood Pressure:</strong> {{ $LoggedUserInfo->bloodpressure ?? 'Not provided' }}</p>
        </li>
    </ul>
</div>


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
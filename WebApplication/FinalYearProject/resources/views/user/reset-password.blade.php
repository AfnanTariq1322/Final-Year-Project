<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Login</title>

    <link rel="icon" href="../img/newicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

<body class="body-color">
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


    <section class="inflanar-signin pd-top-60 pd-btm-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 mx-lg-auto">
                    <div class="inflanar-signin__body">
                        <div class="inflanar-signin__logins">

                            <!-- Header with Updated Heading -->
                            <div class="inflanar-signin__header mg-btm-10">
                                <div class="inflanar-signin__heading">
                                    <div class="form-logo">
                                        <a href="https://createrdirect.corammerswork.com/">
                                            <img src="../img/newicon.png" alt="Retina Fundus Analysis"
                                                style="width: 40px; height: auto; vertical-align: middle;">
                                            <span
                                                style="font-size: 18px; vertical-align: middle; margin-left: 4px;">Retina
                                                Fundus Analysis</span>
                                        </a>
                                    </div><br>
                                    <p class="inflanar-signin__tag">Welcome to</p>
                                    <h4 class="inflanar-signin__title3">Fundus Disease Analysis using Hybrid CNN</h4>
                                </div>
                            </div>

                            <div class="inflanar-signin__inner"> @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                @if (session('fail'))
                                <div class="alert alert-danger">
                                    {{ session('fail') }}
                                </div>
                                @endif

                                <form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden"  class="form-group inflanar-form-input mg-top-20"name="token" value="{{ request()->route('token') }}">
    <br>
    <input maxlength="12" type="password"class="form-group inflanar-form-input mg-top-20" name="password" placeholder="New Password" required>
    <br>
    <input maxlength="12" type="password" class="form-group inflanar-form-input mg-top-20" name="password_confirmation" placeholder="Confirm Password" required>
    <button class="form-group inflanar-form-input mg-top-20 inflanar-signin__bottom" type="submit">Reset Password</button>
</form>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


 
 
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
    
</body>

</html>


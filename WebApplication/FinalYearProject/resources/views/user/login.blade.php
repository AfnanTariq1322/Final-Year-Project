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
                                @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
                                @if (session('fail'))
                                <div class="alert alert-danger">
                                    {{ session('fail') }}
                                </div>
                                @endif

                                <form action="{{ route('user.check') }}" method="POST">
                                    @csrf
                                    <!-- This is necessary for CSRF protection -->
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Email Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Email*</label>
                                                <input class="ecom-wc__form-input" type="email" name="email"
                                                    placeholder="infoyour@gmail.com" required="required"
                                                    value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <!-- Password Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Password*</label>
                                                <input class="inflanar-signin__form-input"
                                                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"
                                                    id="password-field" type="password" name="password" maxlength="12"
                                                    required="required">
                                                @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                                <span class="text-danger" id="emailError"></span> <!-- ✅ Error Message -->

                                            </div>
                                            <p id="generalError" class="text-danger" style="display: none;"></p>

                                            <!-- Forgot Password Link -->
                                            <div class="form-group mg-top-15">
                                                <div class="inflanar-signin__check-inline">
                                                    <div class="inflanar-signin__forgot">
                                                    <a href="javascript:void(0);" class="forgot-pass" onclick="openForgotPasswordModal()">Forgot Password?</a>

                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Login Button -->
                                            <div class="form-group mg-top-20">
                                                <div class="login-register">
                                                    <button type="submit" class="inflanar-btn">
                                                        <span>Log In</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Register Link -->
                                            <div class="inflanar-signin__bottom">
                                                <p class="inflanar-signin__text mg-top-20">Don't have an account?
                                                    <a href="/user/register">Register here</a>
                                                </p>
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

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Enter your registered email address, and we will send you a password reset link.</p>
                
                <!-- Email Input -->
                <input type="email" id="forgot_password_email" class="form-control" placeholder="Enter your email">

                <!-- Error Message -->
                <span class="text-danger" id="forgotPasswordError"></span>

                <!-- Success Message (Initially Hidden) -->
                <span class="text-success" id="forgotPasswordSuccess" style="display: block; margin-top: 10px;"></span>

                <!-- Submit Button -->
                <button class="btn btn-primary mt-3" onclick="sendResetLink()">Send Reset Link</button>
            </div>
        </div>
    </div>
</div>


	<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verify Your Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="otpMessage" class="text-danger">Please verify your email before proceeding.</p>
                <input type="hidden" id="otp_email">
                <div class="form-group">
                    <input type="text" id="otp_input" class="form-control" placeholder="Enter OTP">
                </div>
                <button class="btn btn-primary mt-3" onclick="verifyOtp()">Verify OTP</button>
                <button class="btn btn-link mt-3" onclick="resendOtp()">Resend OTP</button>
            </div>
        </div>
    </div>
</div>

<script>function sendResetLink() {
    let email = document.getElementById("forgot_password_email").value;
    let errorMessage = document.getElementById("forgotPasswordError");
    let successMessage = document.getElementById("forgotPasswordSuccess");

    // Clear previous messages
    errorMessage.innerText = "";
    successMessage.innerText = "";

    if (!email) {
        errorMessage.innerText = "Email is required!";
        return;
    }

    fetch("/forgot-password", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            successMessage.innerText = "A password reset link has been sent to your email.";
            successMessage.classList.add("text-success"); // Add Bootstrap success style
        } else {
            errorMessage.innerText = data.error || "Failed to send reset link.";
        }
    })
    .catch(error => {
        errorMessage.innerText = "Something went wrong. Please try again.";
        console.error("Error:", error);
    });
}

function openForgotPasswordModal() {
    let forgotPasswordModal = new bootstrap.Modal(document.getElementById("forgotPasswordModal"));
    forgotPasswordModal.show();
}
document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from reloading

    let formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        body: formData,
        headers: {
            "Accept": "application/json"
        }
    })
    .then(response => response.json().then(data => ({ status: response.status, body: data })))
    .then(({ status, body }) => {
        if (!body.success) {
            if (body.otp_required) {
                // ✅ Open the OTP modal (but don't trigger "Resend OTP")
                document.getElementById("otp_email").value = body.email;
                document.getElementById("otpMessage").innerText = "Please verify your email before logging in.";

                let otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
                otpModal.show();

                // ❌ Removed automatic `resendOtp();`
            } else {
                let generalError = document.getElementById("generalError"); // Get error container
                generalError.innerText = body.error; // Set error message
                generalError.style.display = "block"; // Show the error
            }
        } else {
            window.location.href = body.redirect;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred. Please try again.");
    });
});
function verifyOtp() {
    let email = document.getElementById("otp_email").value;
    let otp_code = document.getElementById("otp_input").value;
    let otpMessage = document.getElementById("otpMessage");

    if (!otp_code) {
        otpMessage.classList.add("text-danger");
        otpMessage.innerText = "Please enter the OTP.";
        return;
    }

    fetch("/user/verify-otp", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ email, otp_code })
    })
    .then(response => response.json().then(data => ({ status: response.status, body: data })))
    .then(({ status, body }) => {
        if (status === 422 || !body.success) {
            otpMessage.classList.remove("text-success");
            otpMessage.classList.add("text-danger");
            otpMessage.innerText = body.error || "Invalid OTP. Please try again.";
        } else {
            otpMessage.classList.remove("text-danger");
            otpMessage.classList.add("text-success");
            otpMessage.innerText = "OTP verified successfully! Redirecting to login...";

            setTimeout(() => {
                let otpModal = bootstrap.Modal.getInstance(document.getElementById("otpModal"));
                otpModal.hide();
                window.location.reload();
            }, 2000);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        otpMessage.classList.add("text-danger");
        otpMessage.innerText = "An error occurred. Please try again.";
    });
}

function resendOtp() {
    let email = document.getElementById("otp_email").value;
    let otpMessage = document.getElementById("otpMessage");

    if (!email) {
        otpMessage.classList.add("text-danger");
        otpMessage.innerText = "Email not found. Please try logging in again.";
        return;
    }

    fetch("/user/resend-otp", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ email })
    })
    .then(response => response.json().then(data => ({ status: response.status, body: data })))
    .then(({ status, body }) => {
        if (status === 422 || !body.success) {
            otpMessage.classList.remove("text-success");
            otpMessage.classList.add("text-danger");
            otpMessage.innerText = body.error || "Failed to resend OTP.";
        } else {
            otpMessage.classList.remove("text-danger");
            otpMessage.classList.add("text-success");
            otpMessage.innerText = "A new OTP has been sent to your email.";
        }
    })
    .catch(error => {
        console.error("Error:", error);
        otpMessage.classList.add("text-danger");
        otpMessage.innerText = "An error occurred. Please try again.";
    });
}

</script>
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
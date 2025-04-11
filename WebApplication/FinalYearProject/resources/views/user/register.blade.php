<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Register</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

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

                            <div class="inflanar-signin__header mg-btm-10">
                                <div class="inflanar-signin__heading">
                                    <div class="form-logo">
                                        <a href="https://createrdirect.corammerswork.com/">
                                            <img src="../img/newicon.png" alt="Retina Fundus Analysis"
                                                style="width: 40px; height: auto; vertical-align: middle;">
                                            <span
                                                style="font-size: 18px;color:black; vertical-align: middle; margin-left: 4px;">Retina
                                                Fundus Analysis</span>
                                        </a>

                                    </div>
                                    <br>
                                    <p class="inflanar-signin__tag">Welcome to</p>
                                    <h4 class="inflanar-signin__title3">Fundus Disease Analysis using Hybrid CNN</h4>
                                </div>
                            </div>
                            <div id="successMessage" class="alert alert-success d-none"></div>

                            <!-- Error Message Container -->
                            <div id="errorContainer" class="d-none"></div>
                            
                            <!-- Laravel Flash Messages -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="inflanar-signin__inner">
                                <form action="{{ route('user.save') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Name Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Name*</label>
                                                <input class="ecom-wc__form-input" type="text" name="name"
                                                    placeholder="Your Full Name" required="required">
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Email Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Email*</label>
                                                <input class="ecom-wc__form-input" type="email" name="email"
                                                    placeholder="infoyour@gmail.com" required="required">
                                                @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Password Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Password*</label>
                                                <input class="inflanar-signin__form-input"
                                                    placeholder="Enter your password" id="password-field"
                                                    type="password" name="password" maxlength="8" required="required">
                                                @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!-- Confirm Password Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Confirm Password*</label>
                                                <input class="inflanar-signin__form-input"
                                                    placeholder="Confirm your password" id="confirm-password-field"
                                                    type="password" name="confirm_password" maxlength="8"
                                                    required="required">
                                                @error('confirm_password')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Register Button -->
                                            <div class="form-group mg-top-20">
                                                <div class="login-register">
                                                    <button type="submit" class="inflanar-btn">
                                                        <span>Register</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Already Have an Account -->
                                            <div class="inflanar-signin__bottom">
                                                <p class="inflanar-signin__text mg-top-20">Already have an account?
                                                    <a href="/user/login">Login here</a>
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
<!-- OTP Verification Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="otpModalLabel">Email Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>We have sent a 6-digit OTP to your email. Please enter it below to verify your account.</p>
        <input type="text" id="otp_code" class="form-control mb-2" placeholder="Enter OTP" required>
        <input type="hidden" id="otp_email">
        <p id="otpMessage" class="text-danger"></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="verifyOtp()">Verify OTP</button>
        <button class="btn btn-secondary" onclick="resendOtp()">Resend OTP</button>
      </div>
    </div>
  </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);
    let errorContainer = document.getElementById("errorContainer");
    let successMessage = document.getElementById("successMessage");

    // Clear previous messages
    errorContainer.innerHTML = "";
    errorContainer.classList.add("d-none"); // Hide error div initially
    successMessage.innerText = "";
    successMessage.classList.add("d-none");

    fetch(this.action, {
        method: "POST",
        body: formData,
        headers: { "Accept": "application/json" }
    })
    .then(response => response.json().then(data => ({ status: response.status, body: data })))
    .then(({ status, body }) => {
        if (status === 422) {  // Validation error
            errorContainer.classList.remove("d-none");
            errorContainer.innerHTML = `
                <div class="alert alert-danger">
                    <ul>${Object.values(body.errors).flat().map(error => `<li>${error}</li>`).join("")}</ul>
                </div>
            `;
        } else if (body.success) {
            successMessage.classList.remove("d-none");
            successMessage.innerText = "OTP sent successfully. Please check your email.";

            document.getElementById("otp_email").value = formData.get("email");

            let otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
            otpModal.show();
        } else {
            errorContainer.classList.remove("d-none");
            errorContainer.innerHTML = `<div class="alert alert-danger">${body.error || "Something went wrong."}</div>`;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        errorContainer.classList.remove("d-none");
        errorContainer.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
    });
});


function verifyOtp() {
    let email = document.getElementById("otp_email").value;
    let otp_code = document.getElementById("otp_code").value;
    let otpMessage = document.getElementById("otpMessage");

    if (!otp_code) {
        otpMessage.classList.add("text-danger");
        otpMessage.innerText = "Please enter the OTP.";
        return;
    }

    fetch("/verify-otp", {
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
        if (status === 400 || !body.success) {
            otpMessage.classList.remove("text-success");
            otpMessage.classList.add("text-danger");
            otpMessage.innerText = body.error || "Invalid OTP. Please try again.";
        } else {
            otpMessage.classList.remove("text-danger");
            otpMessage.classList.add("text-success");
            otpMessage.innerText = "OTP verified successfully! Redirecting to login page...";
            
            setTimeout(() => {
                let otpModal = bootstrap.Modal.getInstance(document.getElementById("otpModal"));
                otpModal.hide();
				window.location.href = "/user/login"; // Redirect to login page
            }, 2000);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        otpMessage.innerText = "An error occurred. Please try again.";
    });
}

function resendOtp() {
    let email = document.getElementById("otp_email").value;
    let otpMessage = document.getElementById("otpMessage");

    if (!email) {
        otpMessage.classList.add("text-danger");
        otpMessage.innerText = "Email not found. Please register first.";
        return;
    }

    fetch("/resend-otp", {
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
        if (status === 400 || status === 404 || !body.success) {
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
        otpMessage.innerText = "An error occurred. Please try again.";
    });
}
</script>


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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
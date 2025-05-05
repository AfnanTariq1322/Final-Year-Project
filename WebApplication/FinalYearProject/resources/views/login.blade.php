<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Doctor Login</title>

    <link rel="icon" href="../img/newicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href="../css/theme-default.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/modal-video.min.css">
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
                                        <a href="/">
                                            <img src="../img/newicon.png" alt="Retina Fundus Analysis" style="width: 40px; height: auto; vertical-align: middle;">
                                            <span style="font-size: 18px;color:black; vertical-align: middle; margin-left: 4px;">Retina Fundus Analysis</span>
                                        </a>
                                    </div>
                                    <br>
                                    <p class="inflanar-signin__tag">Doctor Login</p>
                                    <h4 class="inflanar-signin__title3">Welcome Back, Doctor</h4>
                                    <p class="inflanar-signin__subtitle">Access your dashboard to manage appointments and patient care</p>
                                </div>
                            </div>

                            <div class="inflanar-signin__inner">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if(session('fail'))
                                    <div class="alert alert-danger">
                                        {{ session('fail') }}
                                    </div>
                                @endif

                                <form id="doctorLoginForm" class="inflanar-signin__form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Email Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Email*</label>
                                                <input class="ecom-wc__form-input" type="email" name="email" placeholder="infoyour@gmail.com" required="required">
                                            </div>
                                            <!-- Password Field -->
                                            <div class="form-group inflanar-form-input mg-top-20">
                                                <label>Password*</label>
                                                <input class="inflanar-signin__form-input" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" type="password" name="password" maxlength="12" required="required">
                                            </div>
                                            <p id="generalError" class="text-danger" style="display: none;"></p>

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
                                                    <a href="{{ route('doctor.register') }}">Register here</a>
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

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/modal-video.min.js"></script>
    <script src="../js/active.js"></script>

    <script>
        document.querySelector("#doctorLoginForm").addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch('{{ route("doctor.check") }}', {
                method: "POST",
                body: formData,
                headers: {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    if (data.otp_required) {
                        document.getElementById("otp_email").value = data.email;
                        document.getElementById("otpMessage").innerText = "Please verify your email before logging in.";

                        let otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
                        otpModal.show();
                    } else {
                        let generalError = document.getElementById("generalError");
                        generalError.innerText = data.error;
                        generalError.style.display = "block";
                    }
                } else {
                    window.location.href = data.redirect;
                }
            })
            .catch(error => {
                console.error("Error:", error);
                let generalError = document.getElementById("generalError");
                generalError.innerText = "An error occurred. Please try again later.";
                generalError.style.display = "block";
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

            fetch("{{ route('doctor.verify.otp') }}", {
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
                    otpMessage.innerText = "OTP verified successfully!";

                    setTimeout(() => {
                        let otpModal = bootstrap.Modal.getInstance(document.getElementById("otpModal"));
                        otpModal.hide();
                        window.location.href = "{{ route('doctor.dashboard') }}";
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

            fetch("{{ route('doctor.resend.otp') }}", {
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
                    otpMessage.classList.remove("text-danger");
                    otpMessage.classList.add("text-success");
                    otpMessage.innerText = "A new OTP has been sent to your email.";
                } else {
                    otpMessage.classList.add("text-danger");
                    otpMessage.innerText = data.error || "Failed to resend OTP.";
                }
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>

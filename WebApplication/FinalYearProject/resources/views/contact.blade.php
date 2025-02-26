<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <link rel="stylesheet" href="{{ asset('css/theme-default.css') }}">
    <link rel="stylesheet" href="../style.css">

</head>

<body>


    @include('includes.header')


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

    <br><br><br>
    <section class="inflanar-breadcrumb">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="inflanar-breadcrumb__inner">
                        <div class="inflanar-breadcrumb__content">
                            <h2 class="inflanar-breadcrumb__title m-0">Contact Us</h2>
                            <ul class="inflanar-breadcrumb__menu list-none">
                                <li><a href="  ">Home</a></li>
                                <li class="active"><a href="about.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="inflanar-breadcrumb__img">
                            <div class="inflanar-breadcrumb__thumb">
                                <img src="../img/retina-scanning.png" style="width: 250px; height: auto; ">


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="inflanar-contact inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row align-items-center">
                <!-- Contact Us Form Section -->
                <div class="col-lg-12 col-12 mg-top-30">
                    <div class="inflanar-comments-form inflanar-comments-form--reviews">
                        <h3 class="inflanar-contact-form__title m-0">Feel Free to Get in Touch</h3>
                        <form action="/contact-us" method="POST">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>Name*</label>
                                        <input class="ecom-wc__form-input" type="text" name="name"
                                            placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>Phone*</label>
                                        <input class="ecom-wc__form-input" type="text" name="phone"
                                            placeholder="Your Phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>Email*</label>
                                        <input class="ecom-wc__form-input" type="email" name="email"
                                            placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>Subject*</label>
                                        <input class="ecom-wc__form-input" type="text" name="subject"
                                            placeholder="Your Subject" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group inflanar-form-input">
                                        <label>Message*</label>
                                        <textarea class="ecom-wc__form-input" name="message"
                                            placeholder="Write your message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mg-top-20">
                                    <button type="submit" class="inflanar-btn"><span>Send Message</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Newsletter Modal -->
    <div class="modal fade" id="newsletterModal" tabindex="-1" aria-labelledby="newsletterModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newsletterModalLabel">
                    <i class="fas fa-envelope fa-sm"></i> Subscribe to Our Newsletter
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Stay updated with our latest news, articles, and research. Enter your email below to subscribe.</p>
                <form id="newsletter-form" action="/subscribe-newsletter" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email Address*</label>
                        <input class="form-control" type="email" name="newsletter_email" placeholder="Enter your email" required>
                    </div>
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn  w-100" style="background-color:#604BB0 !important; color:white;"><span>Subscribe</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- JavaScript to Auto-Open Modal -->
    <script>
    setTimeout(function() {
        var myModal = new bootstrap.Modal(document.getElementById('newsletterModal'));
        myModal.show();
    }, 4000); // Opens after 3 seconds
    </script>
 <script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("newsletter-form").addEventListener("submit", function (e) {
        e.preventDefault();

        let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        let csrfToken = csrfTokenMeta ? csrfTokenMeta.content : '';
        let email = document.querySelector("input[name='newsletter_email']").value;
        let modalBody = document.querySelector(".modal-body");
        let modal = new bootstrap.Modal(document.getElementById('newsletterModal')); // Bootstrap Modal instance

        fetch("/subscribe-newsletter", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({ newsletter_email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modalBody.innerHTML = `
                    <div class="alert alert-success text-center">
                        <i class="fas fa-check-circle"></i> ${data.message}
                    </div>
                    <button class="btn btn-primary w-100 mt-3" data-bs-dismiss="modal">Close</button>
                `;
            } else {
                modalBody.innerHTML = `
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-circle"></i> ${data.message}
                    </div>
                    <button class="btn btn-danger w-100 mt-3" data-bs-dismiss="modal">Try Again</button>
                `;
            }

            // Close modal after 4 seconds
            setTimeout(() => {
                modal.hide();
            }, 4000);
        })
        .catch(error => {
            modalBody.innerHTML = `
                <div class="alert alert-danger text-center">
                    <i class="fas fa-times-circle"></i> Server Error! Please try again later.
                </div>
                <button class="btn btn-dark w-100 mt-3" data-bs-dismiss="modal">Close</button>
            `;

            // Close modal after 4 seconds
            setTimeout(() => {
                modal.hide();
            }, 4000);
        });
    });
});
</script>

 

    @include('includes.section')

    @include('includes.footer')


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


</body>

</html>
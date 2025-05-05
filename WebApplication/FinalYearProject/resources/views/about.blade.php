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
 
 
    <section class="inflanar-section-shape15 inflanar-bg-cover pd-top-90 pd-btm-120 inflanar-section-shape2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="inflanar-about__row inflanar-row-gap">
                        <div class="inflanar-about__img mg-top-30">
                            <div class="about-image-container">
                                <img src="{{ asset('../img/about-section.png') }}" alt="About Our Technology" class="about-image">
                                <div class="image-overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-microscope"></i>
                                        <span>AI-Powered Analysis</span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="inflanar-about__content mg-top-30 aos-init aos-animate" data-aos="fade-in" data-aos-delay="300">
                            <div class="inflanar-section__head mg-btm-20">
                                <span class="inflanar-section__badge inflanar-primary-color m-0 color-white">
                                    <i class="fas fa-brain"></i>
                                    <span>About Our Technology</span>
                                </span>
                                <h2 class="inflanar-section__title inflanar-section__title--medium mg-btm-20 color-white aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">
                                    Revolutionizing Eye Disease Detection with AI
                                </h2>
                                <p class="color-white">
                                    Our advanced **Fundus Image Analysis** system leverages cutting-edge AI and deep learning to detect 
                                    eye diseases with unprecedented precision. By analyzing retinal images, we can identify conditions 
                                    like **diabetic retinopathy, glaucoma, and macular degeneration** at an early stage, 
                                    helping in timely treatment and prevention.
                                </p>
                            </div>
                            <ul class="inflanar-list-style inflanar-list-style__row list-none mg-top-20">
                                <li class="color-white">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>AI-powered disease detection with 80% accuracy</span>
                                </li>
                                <li class="color-white">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Early diagnosis for better treatment outcomes</span>
                                </li>
                                <li class="color-white">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Fast & accurate fundus image analysis</span>
                                </li>
                                <li class="color-white">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Real-time results and detailed reports</span>
                                </li>
                            </ul>
                            <div class="button-group mg-top-40">
                                <a href="{{ route('diagnosis') }}" class="inflanar-btn inflanar-btn-outline">
                                    <i class="fas fa-camera-retro"></i>
                                    <span>Try Analysis Now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <style>
    /* About Section Styles */
    .inflanar-section-shape15 {
        background: linear-gradient(135deg, #604BB0 0%, #4a3a8c 100%);
        position: relative;
        overflow: hidden;
    }
    
    .inflanar-section-shape15::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="1" fill="rgba(255,255,255,0.05)"/></svg>');
        opacity: 0.1;
    }
    
    /* About Image Styles */
    .about-image-container {
        position: relative;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .about-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }
    
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(96, 75, 176, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .about-image-container:hover .image-overlay {
        opacity: 1;
    }
    
    .about-image-container:hover .about-image {
        transform: scale(1.05);
    }
    
    .overlay-content {
        text-align: center;
        color: #fff;
    }
    
    .overlay-content i {
        font-size: 48px;
        margin-bottom: 15px;
    }
    
    .overlay-content span {
        font-size: 18px;
        font-weight: 500;
    }
    
    /* Rest of your existing styles */
    .inflanar-section__badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 20px;
        background: rgba(255,255,255,0.1);
        border-radius: 25px;
        margin-bottom: 20px;
    }
    
    .inflanar-section__badge i {
        font-size: 18px;
    }
    
    .inflanar-list-style {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .inflanar-list-style li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
    }
    
    .inflanar-list-style li i {
        color: #2ecc71;
        font-size: 18px;
    }
    
    .button-group {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .inflanar-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .inflanar-btn-outline {
        background: transparent;
        color: #fff;
        border: 2px solid #fff;
    }
    
    .inflanar-btn-outline:hover {
        background: #fff;
        color: #604BB0;
        transform: translateY(-2px);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .inflanar-list-style {
            grid-template-columns: 1fr;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        .inflanar-btn {
            width: 100%;
            justify-content: center;
        }
    
        .about-image-container {
            max-width: 400px;
        }
    }
    
    @media (max-width: 768px) {
        .inflanar-section__title {
            font-size: 28px;
        }
        
        .about-image-container {
            max-width: 300px;
            margin-bottom: 30px;
        }
    }
    </style>

    <br>
 
</section>

<section class="pd-top-120 pd-btm-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
                    <span class="inflanar-section__badge inflanar-primary-color m-0 aos-init aos-animate" data-aos="fade-in" data-aos-delay="300">
                        <i class="fas fa-cogs"></i>
                        <span>Working Process</span>
                    </span>
                    <h2 class="inflanar-section__title aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">How It Works</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <div class="inflanar-hcard inflanar-hcard--one">
                    <div class="inflanar-hcard__img">
                        <img src="{{ asset('img/register.png') }}" alt="Register">
                    </div>
                    <div class="inflanar-hcard__content">
                        <div class="inflanar-hcard__line"> </div>
                        <h4 class="inflanar-hcard__label">
                            <span>Step</span>
                            <b>1</b>
                        </h4>
                        <h4 class="inflanar-hcard__title">Register Account</h4>
                        <p class="inflanar-hcard__text">Create your account to access our AI-powered eye disease detection platform. Get personalized care and track your health journey.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                <div class="inflanar-hcard inflanar-hcard--two">
                    <div class="inflanar-hcard__content inflanar-hcard__content__two">
                        <h4 class="inflanar-hcard__label">
                            <span>Step</span>
                            <b>2</b>
                        </h4>
                        <h4 class="inflanar-hcard__title">Upload Fundus Image</h4>
                        <p class="inflanar-hcard__text">Upload your fundus image through our diagnosis page. You can either choose an image from your device or use the camera to capture one.</p>
                        <div class="inflanar-hcard__line"> </div>
                    </div>
                    <div class="inflanar-hcard__img">
                        <img src="{{ asset('img/dia.png') }}" alt="Upload Image">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">
                <div class="inflanar-hcard inflanar-hcard--one">
                    <div class="inflanar-hcard__img">
                        <img src="{{ asset('img/analysis.png') }}" alt="Analysis">
                    </div>
                    <div class="inflanar-hcard__content">
                        <div class="inflanar-hcard__line inflanar-hcard__line--v2"> </div>
                        <h4 class="inflanar-hcard__label">
                            <span>Step</span>
                            <b>3</b>
                        </h4>
                        <h4 class="inflanar-hcard__title">AI Analysis</h4>
                        <p class="inflanar-hcard__text">Our advanced AI system analyzes your fundus image to detect potential eye conditions with high accuracy and precision.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="800">
                <div class="inflanar-hcard inflanar-hcard--two">
                    <div class="inflanar-hcard__content inflanar-hcard__content__two">
                        <h4 class="inflanar-hcard__label">
                            <span>Step</span>
                            <b>4</b>
                        </h4>
                        <h4 class="inflanar-hcard__title">Get Results & Learn</h4>
                        <p class="inflanar-hcard__text">Receive detailed analysis reports and explore our blog for educational content about eye health and disease prevention.</p>
                        <div class="inflanar-hcard__line inflanar-hcard__line--v3"> </div>
                    </div>
                    <div class="inflanar-hcard__img">
                        <img src="{{ asset('img/report2.png') }}" alt="Results">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="inflanar-section-shape15 inflanar-bg-cover pd-top-90 pd-btm-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="inflanar-section__head mg-btm-20">
                    <span class="inflanar-section__badge inflanar-primary-color m-0 color-white">
                        <i class="fas fa-user-md"></i>
                        <span>For Healthcare Professionals</span>
                    </span>
                    <h2 class="inflanar-section__title inflanar-section__title--medium mg-btm-20 color-white">
                        Join Our Network of Eye Care Specialists
                    </h2>
                    <p class="color-white">
                        Expand your practice and reach more patients through our innovative platform. 
                        Register as a doctor and connect with patients seeking expert eye care.
                    </p>
                    <ul class="inflanar-list-style inflanar-list-style__row list-none mg-top-20">
                        <li class="color-white">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Grow your patient base</span>
                        </li>
                        <li class="color-white">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Manage appointments efficiently</span>
                        </li>
                        <li class="color-white">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Access AI-powered diagnostic tools</span>
                        </li>
                        <li class="color-white">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Provide better patient care</span>
                        </li>
                    </ul>
                    <div class="button-group mg-top-40">
                        <a href="{{ route('doctor.register') }}" class="inflanar-btn inflanar-btn-outline">
                            <i class="fas fa-user-plus"></i>
                            <span>Register as Doctor</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="doctor-image-container">
                    <img src="{{ asset('img/doctor-img-removebg-preview.png') }}" alt="Doctor Registration" class="doctor-image">
                    <div class="image-overlay">
                        <div class="overlay-content">
                            <i class="fas fa-stethoscope"></i>
                            <span>Join Our Medical Network</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* About Section Styles */
.inflanar-section-shape15 {
    background: #ffffff;
    position: relative;
    overflow: hidden;
}

.inflanar-section-shape15::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="1" fill="rgba(96, 75, 176, 0.05)"/></svg>');
    opacity: 0.1;
}

/* About Image Styles */
.about-image-container {
    position: relative;
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

.about-image {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(96, 75, 176, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.about-image-container:hover .image-overlay {
    opacity: 1;
}

.about-image-container:hover .about-image {
    transform: scale(1.05);
}

.overlay-content {
    text-align: center;
    color: #fff;
}

.overlay-content i {
    font-size: 48px;
    margin-bottom: 15px;
}

.overlay-content span {
    font-size: 18px;
    font-weight: 500;
}

/* Rest of your existing styles */
.inflanar-section__title {
    color: #2C3E50;
}

.inflanar-section__badge {
    background: #604BB0;
    color: #fff;
}

.inflanar-section__badge i {
    color: #fff;
}

.inflanar-list-style {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.inflanar-list-style li {
    color: #2C3E50;
}

.inflanar-list-style li i {
    color: #604BB0;
}

.button-group {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.inflanar-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
}

.inflanar-btn-outline {
    background: transparent;
    color: #604BB0;
    border: 2px solid #604BB0;
}

.inflanar-btn-outline:hover {
    background: #604BB0;
    color: #fff;
    transform: translateY(-2px);
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .inflanar-list-style {
        grid-template-columns: 1fr;
    }
    
    .button-group {
        flex-direction: column;
    }
    
    .inflanar-btn {
        width: 100%;
        justify-content: center;
    }

    .about-image-container {
        max-width: 400px;
    }
}

@media (max-width: 768px) {
    .inflanar-section__title {
        font-size: 28px;
    }
    
    .about-image-container {
        max-width: 300px;
        margin-bottom: 30px;
    }
}

/* Working Process Section Styles */
.inflanar-hcard {
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    height: 100%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
}

.inflanar-hcard:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(96, 75, 176, 0.15);
}

.inflanar-hcard__img {
    margin-bottom: 20px;
    border-radius: 15px;
    overflow: hidden;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

.inflanar-hcard__img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
    padding: 10px;
}

.inflanar-hcard:hover .inflanar-hcard__img img {
    transform: scale(1.05);
}

.inflanar-hcard__label {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    color: #604BB0;
    font-size: 16px;
}

.inflanar-hcard__label b {
    background: #604BB0;
    color: #fff;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.inflanar-hcard__title {
    font-size: 20px;
    margin-bottom: 15px;
    color: #2C3E50;
}

.inflanar-hcard__text {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

.inflanar-hcard__line {
    position: absolute;
    right: -20px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.inflanar-hcard__line img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 0;
}

.inflanar-hcard--two .inflanar-hcard__content {
    order: 2;
}

.inflanar-hcard--two .inflanar-hcard__img {
    order: 1;
}

.inflanar-hcard--two .inflanar-hcard__line {
    right: auto;
    left: -20px;
}

@media (max-width: 991px) {
    .inflanar-hcard__line {
        display: none;
    }
    
    .inflanar-hcard {
        margin-bottom: 30px;
    }
}

/* Doctor Section Styles */
.doctor-image-container {
    position: relative;
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

.doctor-image {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

.doctor-image-container:hover .doctor-image {
    transform: scale(1.05);
}

.doctor-image-container:hover .image-overlay {
    opacity: 1;
}

/* Responsive Adjustments for Doctor Section */
@media (max-width: 991px) {
    .doctor-image-container {
        margin-top: 40px;
        max-width: 400px;
    }
}

@media (max-width: 768px) {
    .doctor-image-container {
        max-width: 300px;
    }
}
</style>
 

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
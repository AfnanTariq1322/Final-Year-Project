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
    <section class="inflanar-breadcrumb">
		<div class="container">
			<div class="row">

				<div class="col-12">
					<div class="inflanar-breadcrumb__inner">
						<div class="inflanar-breadcrumb__content">
							<h2 class="inflanar-breadcrumb__title m-0">About Us</h2>
							<ul class="inflanar-breadcrumb__menu list-none">
								<li><a href="https://createrdirect.corammerswork.com/">Home</a></li>
								<li class="active"><a href="about.html">About Us</a></li>
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
    <section class="section-editng-about">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inflanar-features-list inflanar-section-shape14 inflanar-bg-cover">
                        <div class="row">
                            <div class="col-12">

                                <div class="inflanar-section__head inflanar-section__center mg-btm-20">
                                    <span class="inflanar-section__badge inflanar-primary-color m-0 color-white aos-init aos-animate" data-aos="fade-in" data-aos-delay="300">
                                        <span>Best Feature</span>
                                    </span>
                                    <h2 class="inflanar-section__title color-white aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">Our
                                        Latest Features</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row inflanar-features-gap">
                            <div class="col-lg-3 col-md-6 col-sm-12 mg-top-30 aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">

                                <div class="inflanar-features-list__single">
                                    <div class="inflanar-features-list__head">
                                        <div class="inflanar-features-list__first">
                                            <div class="inflanar-features-list__icon ">
                                                <img src="img/st-feature-icon1.svg" alt="#">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inflanar-features-list__body">
                                        <h4 class="inflanar-features-list__title color-white">No upfront Cost</h4>
                                        <p class="inflanar-features-list__text color-white">Experience the advantage of
                                            zero upfront
                                            costs. Collaborate with our team for bespoke creator-led advertising
                                            strategies, tailored to elevate your brand.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mg-top-30 aos-init aos-animate" data-aos="fade-in" data-aos-delay="600">

                                <div class="inflanar-features-list__single">
                                    <div class="inflanar-features-list__head">
                                        <div class="inflanar-features-list__first">
                                            <div class="inflanar-features-list__icon inflanar-scolor-bg">
                                                <img src="img/st-feature-icon2.svg" alt="#">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inflanar-features-list__body">
                                        <h4 class="inflanar-features-list__title color-white">Verified Creators</h4>
                                        <p class="inflanar-features-list__text color-white">Engage with our network of
                                            verified
                                            creators for targeted, professional-grade advertising solutions that amplify
                                            your brand's message with credibility and authenticity.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mg-top-30 aos-init aos-animate" data-aos="fade-in" data-aos-delay="800">

                                <div class="inflanar-features-list__single">
                                    <div class="inflanar-features-list__head">
                                        <div class="inflanar-features-list__first">
                                            <div class="inflanar-features-list__icon inflanar-tcolor-bg">
                                                <img src="img/st-feature-icon3.svg" alt="#">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inflanar-features-list__body">
                                        <h4 class="inflanar-features-list__title color-white">Live Chat</h4>
                                        <p class="inflanar-features-list__text color-white">Interact instantly with our
                                            live chat
                                            feature, facilitating direct communication between creators and brands for
                                            seamless collaboration and real-time campaign optimization.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mg-top-30 aos-init aos-animate" data-aos="fade-in" data-aos-delay="1000">

                                <div class="inflanar-features-list__single">
                                    <div class="inflanar-features-list__head">
                                        <div class="inflanar-features-list__first">
                                            <div class="inflanar-features-list__icon inflanar-ylcolor-bg">
                                                <img src="img/st-feature-icon4.svg" alt="#">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inflanar-features-list__body">
                                        <h4 class="inflanar-features-list__title color-white">Safe Camping</h4>
                                        <p class="inflanar-features-list__text color-white">Ensure secure camping
                                            experiences with
                                            our comprehensive safety measures, providing peace of mind for outdoor
                                            enthusiasts seeking adventure with confidence.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="inflanar-section-shape15 inflanar-bg-cover pd-top-90 pd-btm-120 inflanar-section-shape2">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12">
					<div class="inflanar-about__row inflanar-row-gap">

						<div class="inflanar-about__img mg-top-30">
							<img src="img/in-about-img.jpg" alt="#">
						</div>

						<div class="inflanar-about__content mg-top-30 aos-init aos-animate" data-aos="fade-in" data-aos-delay="300">
							<div class="inflanar-section__head mg-btm-20">
								<span class="inflanar-section__badge inflanar-primary-color m-0 color-white">
									<span>About Creator</span>
								</span>
								<h2 class="inflanar-section__title inflanar-section__title--medium mg-btm-20 color-white aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">Creative and First Problems Solving</h2>
								<p class="color-white">Experience unparalleled professional problem-solving, where creativity meets
									expertise. Our solutions redefine industry standards, ensuring your challenges are
									met with precision and innovation. Trust us to elevate your brand through strategic
									professionalism.</p>
							</div>
							<ul class="inflanar-list-style inflanar-list-style__row list-none mg-top-20 ">
								<li class="color-white"><i class="fa-solid fa-circle-check"></i>Promote your business product</li>
								<li class="color-white"><i class="fa-solid fa-circle-check"></i>Best client satisfaction</li>
								<li class="color-white"><i class="fa-solid fa-circle-check"></i>Growing your business</li>
							</ul>
							<a href="contact.html" class="inflanar-btn mg-top-40 inflanar-btn-dark"><span>Contact Us</span></a>
							<div class="inflanar-ceo">
								<div class="inflanar-ceo__author">
									<img src="img/in-ceo.png">
									<h4 class="inflanar-ceo__title color-white">Sufankho Jhon <span class="color-white">CEO of Creator Direct</span>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <br>
    <section class="pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-primary-color m-0 aos-init aos-animate" data-aos="fade-in" data-aos-delay="300">
                            <span>Working Process</span>
                        </span>
                        <h2 class="inflanar-section__title aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">How Dose It Work?
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">

                    <div class="inflanar-hcard inflanar-hcard--one">
                        <div class="inflanar-hcard__img">
                            <img src="img/in-howcard1.jpg" alt="#">
                        </div>
                        <div class="inflanar-hcard__content">
                            <div class="inflanar-hcard__line"><img src="img/in-line-shape1.svg"></div>
                            <h4 class="inflanar-hcard__label">
                                <span>Step</span>
                                <b>1</b>
                            </h4>
                            <h4 class="inflanar-hcard__title">Create Camping</h4>
                            <p class="inflanar-hcard__text"> Our Creator Directory for expert camping enthusiasts who
                                share tips on gear, survival skills, and the best outdoor experiences, igniting your
                                passion for the great outdoors.</p>
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
                            <h4 class="inflanar-hcard__title">Choose Influencer</h4>
                            <p class="inflanar-hcard__text">Unlock a world of influence with our Creator Directory,
                                connecting you to top influencers who inspire and shape trends across various domains,
                                bringing unparalleled insights to your fingertips.</p>
                            <div class="inflanar-hcard__line"><img src="img/in-line-shape2.svg"></div>
                        </div>
                        <div class="inflanar-hcard__img">
                            <img src="img/in-howcard2.jpg" alt="#">
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">

                    <div class="inflanar-hcard inflanar-hcard--one">
                        <div class="inflanar-hcard__img">
                            <img src="img/in-howcard3.jpg" alt="#">
                        </div>
                        <div class="inflanar-hcard__content">
                            <div class="inflanar-hcard__line inflanar-hcard__line--v2"><img src="img/in-line-shape3.svg"></div>
                            <h4 class="inflanar-hcard__label">
                                <span>Step</span>
                                <b>3</b>
                            </h4>
                            <h4 class="inflanar-hcard__title">Monitor Your Campaign</h4>
                            <p class="inflanar-hcard__text">Navigate success with our Campaign Monitoring Creator
                                Directory, featuring skilled professionals adept at tracking, optimizing, and elevating
                                your campaigns for maximum impact in the dynamic business landscape.</p>
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
                            <h4 class="inflanar-hcard__title">Check Your Report</h4>
                            <p class="inflanar-hcard__text">Empower your insights with our Report Checking Creator
                                Directory, connecting you to experts who meticulously analyze and enhance your reports,
                                ensuring precision and strategic clarity in every detail.</p>
                            <div class="inflanar-hcard__line inflanar-hcard__line--v3"><img src="img/in-line-shape2.svg"></div>
                        </div>
                        <div class="inflanar-hcard__img">
                            <img src="img/in-howcard4.jpg" alt="#">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



 

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
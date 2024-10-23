<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
       
    <meta charset="utf-8">
       
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
       
    <meta name="keywords" content="Site keywords here">
       
    <meta name="description" content="#">
       
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Fundus Disease Analysis - Home</title>

       
    <link rel="icon" href="../img/newicon.png">
       
    <!-- Add Font Awesome for Icons (if not already included) -->
       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"        
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="    
            crossorigin="anonymous" referrerpolicy="no-referrer" />

       
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"        
        rel="stylesheet">
       
    <link rel="stylesheet" href="css/bootstrap.min.css">
       
    <link rel="stylesheet" href="css/jquery-ui.min.css">
       
    <link rel="stylesheet" href="css/animate.min.css">
       
    <link rel="stylesheet" href="css/aos.min.css">
       
    <link rel="stylesheet" href="css/swiper-slider.min.css">
       
    <link rel="stylesheet" href="css/select2-min.css">
       
    <link rel="stylesheet" href="css/datatables.min.css">
       
    <link rel="stylesheet" href="css/video-popup.min.css">
       
    <link rel="stylesheet" href="css/theme-default.css">
       
    <link rel="stylesheet" href="style.css">
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

                <div class="offcanvas-logo"></div>

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
                                Welcome, {{ $user->name }}
                                <!-- Use the user object for name -->
                            </a>
                        </span>
                        <br>
                        <nav id="offcanvas-menu" class="offcanvas-menu">
                            <ul class="nav-menu menu navigation list-none">
                                <br>
                                <li class="active"><a href="/home">Home</a></li>
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
                            Welcome, {{ $user->name }}
                            <!-- Use the user object for name -->
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


    @include('includes.header')


    <section id="hero" class="inflanar-hero inflanar-bg-cover p-relative inflanar-ohidden">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inflanar-hero__inside">
                        <div class="inflanar-hero__inner">

                            <div class="inflanar-hero__content" data-aos="fade-up" data-aos-delay="300">
                                <span class="inflanar-hero__sub inflanar-regular-font">WELCOME TO YOUR RETINAL HEALTH
                                    PLATFORM</span>
                                <h1 class="inflanar-hero__title">Understanding <span>Retinal Fundus Diseases</span> for
                                    Better Eye Care</h1>
                            </div>

                            <div class="inflanar-search-form inflanar-search-form__hero mg-top-10" data-aos="fade-up"
                                data-aos-delay="400">
                                <!-- Search form can be added here if needed -->
                            </div>

                            <div class="inflanar-ptags" data-aos="fade-up" data-aos-delay="500">
                                <span class="inflanar-ptags__title">Common Conditions</span>
                                <ul class="inflanar-ptags__list list-none">
                                    <li><a href="">Diabetic Retinopathy</a></li>
                                    <li><a href="">Age-related Macular Degeneration</a></li>
                                    <li><a href="">Retinal Detachment</a></li>
                                    <li><a href="">Central Serous Retinopathy</a></li>
                                    <li><a href="">Retinitis Pigmentosa</a></li>
                                    <li><a href="">Glaucoma</a></li>
                                    <li><a href="">Cataract</a></li>
                                    <li><a href="">Drusen</a></li>
                                    <li><a href="">Macular Degeneration</a></li>
                                    <li><a href="">Reticular Drusen</a></li>
                                    <li><a href="">Epiretinal Membrane</a></li>
                                </ul>


                            </div>

                            <div class="inflanar-sclient" data-aos="fade-up" data-aos-delay="600">
                                <ul class="inflanar-sclient__list list-none">
                                    @foreach ($users as $user)
                                    <li>
                                        <a href="">
                                            @if ($user->image)
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}">
                                            @else
                                            <img src="{{ asset('path/to/default/image.png') }}" alt="Default Image">
                                            <!-- Replace 'path/to/default/image.png' with the path to your default image -->
                                            @endif
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>

                                <h4 class="inflanar-sclient__title"><b class="in-counter">1000</b>+ <span>Patients
                                        Helped</span></h4>
                            </div>
                        </div>
                        <div class="inflanar-hero__img" data-aos="fade-left" data-aos-delay="700">
                                <img src="../img/homefronticon.jpg" alt="Retinal Health" class="small-image" />

                               
                            <!-- Buttons for Choose Image and Open Camera -->
                                <div class="image-actions">
                                <button class="btn choose-image" id="chooseImageBtn">
                                    <i class="fas fa-file-image"></i> Choose Image
                                </button>
                                <input type="file" id="fileInput" accept="image/*" style="display: none;" />


                                <!-- Modal for Image Preview -->
                                <!-- Open Camera Button -->
                                <button class="btn open-camera" id="openCameraBtn">
                                    <i class="fas fa-camera-retro"></i> Open Camera
                                </button>
                                <video id="cameraStream" autoplay
                                    style="display: none; width: 100%; height: auto;"></video>
                            </div>

                               
                            <!-- Modal for showing image selection -->

                            <div id="imageModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p id="imageModalText"></p>
                                    <img id="previewImage" style="max-width: 100%; height: auto;"
                                        alt="Selected Image" />
                                    <button class="btn" id="uploadButton" style="display: none;">Upload</button>
                                </div>
                            </div>
                               
                            <!-- Modal for camera preview -->
                                <div id="cameraModal" class="modal">
                                        <div class="modal-content">
                                                <video id="cameraStreamModal" autoplay style="width: 100%;"></video>
                                                <button class="btn" id="takePictureBtn">Take Picture</button>
                                                <button class="btn" id="uploadPictureBtn" style="display: none;">Upload
                                        Picture</button>
                                            </div>
                                    </div>

                                <div class="inflanar-hero-social inflanar-hero-social--1 inflanar-anim-shape1"></div>
                                <div class="inflanar-hero-social inflanar-hero-social--2 inflanar-anim-shape2"></div>
                                <div class="inflanar-hero-social inflanar-hero-social--3 inflanar-anim-shape3"></div>
                                <div class="inflanar-hero-social inflanar-hero-social--4 inflanar-anim-shape4"></div>
                        </div>


                        <!-- Styles -->
                        <style>
                        .inflanar-hero__img {
                            position: relative;
                            display: inline-block;
                            width: 100%;
                            /* Ensure the image and its container take up full width */
                        }

                        .small-image {
                            width: 100%;
                            height: auto;
                        }

                        .image-actions {
                            position: absolute;
                            top: 90%;
                            /* Center vertically */
                            left: 50%;
                            /* Center horizontally */
                            transform: translate(-80%, -70%);
                            /* Adjust the center position */
                            display: flex;
                            gap: 10px;
                            justify-content: center;
                            padding: 10px 0;
                            border-radius: 8px;
                            /* Optional: Round background edges */
                        }

                        .image-actions .btn {
                            font-size: 14px;
                            display: flex;
                            align-items: center;
                            padding: 8px 12px;
                            background-color: black;
                            color: white;
                            border: none;
                            cursor: pointer;
                            border-radius: 5px;
                        }

                        .image-actions .btn i {
                            margin-right: 5px;
                        }

                        .choose-image:hover,
                        .open-camera:hover {
                            background-color: #333;
                            /* Darker background on hover */
                        }

                        .modal {
                            display: none;
                            position: fixed;
                            z-index: 1;
                            padding-top: 100px;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            overflow: auto;
                            background-color: rgba(0, 0, 0, 0.4);
                        }

                        .modal-content {
                            background-color: #fff;
                            margin: auto;
                            padding: 20px;
                            border: 1px solid #888;
                            width: 80%;
                        }

                        .close {
                            color: #aaa;
                            float: right;
                            font-size: 28px;
                            font-weight: bold;
                        }

                        .close:hover,
                        .close:focus {
                            color: black;
                            text-decoration: none;
                            cursor: pointer;
                        }
                        </style>

                        <script>
                        // Handle Choose Image button click
                        document.getElementById('chooseImageBtn').addEventListener('click', function() {
                            document.getElementById('fileInput').click();
                        });

                        // Handle file input change
                        document.getElementById('fileInput').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    // Show the selected image in the modal
                                    document.getElementById('previewImage').src = e.target.result;
                                    showModal('imageModal', 'Image selected: ' + file.name);
                                    document.getElementById('uploadButton').style.display =
                                    'block'; // Show the upload button
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        // Handle Open Camera button click
                        document.getElementById('openCameraBtn').addEventListener('click', function() {
                            openCameraModal();
                        });

                        // Open camera modal and start stream
                        function openCameraModal() {
                            const video = document.getElementById('cameraStreamModal');
                            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                                navigator.mediaDevices.getUserMedia({
                                        video: true
                                    })
                                    .then(function(stream) {
                                        video.srcObject = stream;
                                        showModal('cameraModal');
                                    })
                                    .catch(function(error) {
                                        console.error('Error accessing camera:', error);
                                    });
                            } else {
                                alert('Camera not supported on this device or browser.');
                            }
                        }

                        // Handle Take Picture button click
                        document.getElementById('takePictureBtn').addEventListener('click', function() {
                            // Simulate taking picture and uploading
                            const uploadButton = document.getElementById('uploadPictureBtn');
                            uploadButton.style.display = 'block';
                            alert('Picture taken!');
                        });

                        // Handle Upload Picture button click
                        document.getElementById('uploadPictureBtn').addEventListener('click', function() {
                            alert('Image uploaded!');
                            closeModal('cameraModal');
                        });

                        // Show modal
                        function showModal(modalId, text = '') {
                            const modal = document.getElementById(modalId);
                            if (text) {
                                document.getElementById('imageModalText').textContent = text;
                            }
                            modal.style.display = 'block';
                        }

                        // Close modal
                        function closeModal(modalId) {
                            document.getElementById(modalId).style.display = 'none';
                        }

                        // Close modal on 'X' click
                        document.querySelectorAll('.close').forEach(btn => {
                            btn.onclick = function() {
                                closeModal(this.parentElement.parentElement.id);
                            }
                        });

                        // Close modal if user clicks outside of it
                        window.onclick = function(event) {
                            const modals = document.querySelectorAll('.modal');
                            modals.forEach(modal => {
                                if (event.target == modal) {
                                    modal.style.display = 'none';
                                }
                            });
                        };

                        // Handle Upload button click in image modal
                        document.getElementById('uploadButton').addEventListener('click', function() {
                            alert('Image uploaded successfully!');
                            closeModal('imageModal'); // Close the modal after upload
                        });
                        </script>



                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="inflanar-bg-cover pd-top-90 pd-btm-120 inflanar-section-shape2 inflanar-ohidden">
        <div class="container inflanar-container-medium">
            <div class="row inflanar-container-medium__row align-items-center">
                <div class="col-lg-5 col-12 mg-top-30">
                    <div class="inflanar-section__head mg-btm-50">
                        <span class="inflanar-section__badge inflanar-primary-color m-0 color-white" data-aos="fade-in"
                            data-aos-delay="300">
                            <span>Our FAQ’s</span>
                        </span>
                        <h2 class="inflanar-section__title mg-btm-20 color-white" data-aos="fade-in"
                            data-aos-delay="400">Frequently Asked Questions</h2>
                        <p class="color-white">Explore our comprehensive FAQ repository about retinal fundus diseases,
                            where clarity meets curiosity. Our Knowledge Hub is designed to empower you with essential
                            information regarding various retinal conditions.</p>
                    </div>

                    <div class="inflanar-support-img" data-aos="fade-up" data-aos-delay="200">
                        <img src="img/in-faq-img.png" alt="#">
                    </div>
                </div>
                <div class="col-lg-7 col-12 mg-top-30">
                    <div class="inflanar-accordion accordion accordion-flush" id="inflanar-accordion">

                        <div class="accordion-item inflanar-accordion__single mg-top-20">
                            <h2 class="accordion-header" id="inflanart-1">
                                <button class="accordion-button collapsed inflanar-accordion__heading" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#ac-collapse1">What are the common retinal
                                    fundus diseases?</button>
                            </h2>
                            <div id="ac-collapse1" class="accordion-collapse collapse"
                                data-bs-parent="#inflanar-accordion">
                                <div class="accordion-body inflanar-accordion__body">
                                    There are several retinal fundus diseases, including:<br>
                                    - Glaucoma<br>
                                    - Cataract<br>
                                    - Drusen<br>
                                    - Macular Degeneration<br>
                                    - Reticular Drusen<br>
                                    - Diabetic Retinopathy<br>
                                    - Age-Related Macular Degeneration<br>
                                    - Epiretinal Membrane
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item inflanar-accordion__single active mg-top-20">
                            <h2 class="accordion-header" id="inflanart-3">
                                <button class="accordion-button inflanar-accordion__heading" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#ac-collapse2">How are these diseases
                                    diagnosed?</button>
                            </h2>
                            <div id="ac-collapse2" class="accordion-collapse collapse show"
                                data-bs-parent="#inflanar-accordion">
                                <div class="accordion-body inflanar-accordion__body">Diagnosis typically involves a
                                    comprehensive eye examination, including visual acuity tests, dilated eye exams, and
                                    imaging techniques like optical coherence tomography (OCT) and fundus photography.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item inflanar-accordion__single mg-top-20">
                            <h2 class="accordion-header" id="inflanart-2">
                                <button class="accordion-button collapsed inflanar-accordion__heading" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#ac-collapse3" aria-expanded="false">What
                                    treatment options are available?</button>
                            </h2>
                            <div id="ac-collapse3" class="accordion-collapse collapse"
                                data-bs-parent="#inflanar-accordion">
                                <div class="accordion-body inflanar-accordion__body">Treatment varies based on the
                                    specific disease but may include medications, laser therapy, or surgical
                                    interventions. Regular follow-up is essential for managing these conditions
                                    effectively.</div>
                            </div>
                        </div>

                        <div class="accordion-item inflanar-accordion__single mg-top-20">
                            <h2 class="accordion-header" id="inflanart-4">
                                <button class="accordion-button collapsed inflanar-accordion__heading" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#ac-collapse4">Are there preventative
                                    measures for retinal diseases?</button>
                            </h2>
                            <div id="ac-collapse4" class="accordion-collapse collapse"
                                data-bs-parent="#inflanar-accordion">
                                <div class="accordion-body inflanar-accordion__body">Preventative measures include
                                    regular eye examinations, controlling diabetes, maintaining a healthy diet rich in
                                    antioxidants, and protecting your eyes from UV light.</div>
                            </div>
                        </div>

                        <div class="accordion-item inflanar-accordion__single mg-top-20">
                            <h2 class="accordion-header" id="inflanart-5">
                                <button class="accordion-button collapsed inflanar-accordion__heading" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#ac-collapse5">Can you provide
                                    documentation for implementation?</button>
                            </h2>
                            <div id="ac-collapse5" class="accordion-collapse collapse"
                                data-bs-parent="#inflanar-accordion">
                                <div class="accordion-body inflanar-accordion__body">Yes, we provide comprehensive
                                    documentation regarding our studies and findings related to retinal fundus diseases.
                                </div>
                            </div>
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
                            <a href="register.html"
                                class="inflanar-btn inflanar-btn__big inflanar-btn-dark"><span>Signup
                                    Now!</span></a>
                        </div>
                        <div class="footer-cta__img">
                            <img src="../img/homefooter.png" style=" float: right; margin-bottom:5px;max-width:60%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>@include('includes.footer')


    <a href="#" class="scrollToTop"><img src="img/output-onlinepngtools (32).png"></a>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate.js"></script>
    <script src="js/jquery-ui.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/aos.min.js"></script>

    <script src="js/ckeditor.min.js"></script>

    <script src="js/fullcalendar.min.js"></script>

    <script src="js/select2-js.min.js"></script>

    <script src="js/video-popup.min.js"></script>

    <script src="js/swiper-slider.min.js"></script>

    <script src="js/waypoints.min.js"></script>

    <script src="js/jquery.counterup.min.js"></script>

    <script src="js/active.js"></script>
    <!-- JavaScript to handle file input and camera -->

</body>

</html>
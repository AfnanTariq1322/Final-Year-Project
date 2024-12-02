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

    <section class="dropdown-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-primary-color m-0 aos-init aos-animate"
                            data-aos="fade-in" data-aos-delay="300">
                            <span>Explore Fundus Disease Insights</span>
                        </span>
                        <h2 class="inflanar-section__title aos-init aos-animate" data-aos="fade-in"
                            data-aos-delay="400">
                            Discover In-Depth Blogs on Fundus Disease Detection and Management
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
    <form class="d-flex flex-wrap" action="{{ route('blogs') }}" method="GET" style="width: 100%;">
        <div class="col-12 col-md-8 mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" class="form-select" id="category" aria-label="Select Category">
                <option value="">Select Category</option>
                <!-- Dynamically populate categories -->
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ (request('category_id') == $category->id || (isset($blog) && $blog->category_id == $category->id)) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4 d-flex align-items-end mb-3">
            <button type="submit" class="btn btn-lg w-50" style="background-color: #604BB0; border: none; color: white;">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('blogs') }}" class="btn btn-lg w-20 ms-2" style="background-color: #dc3545; border: none; color: white;">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

        </div>
    </section>


    <br>
    <section class="inflanar-section-shape inflanar-bg-cover pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20 color-white">
                        <span class="inflanar-section__badge inflanar-primary-color m-0 aos-init aos-animate"
                            data-aos="fade-in" data-aos-delay="300">
                            <span>Our Blogs</span>
                        </span>
                        <h2 class="inflanar-section__title color-white aos-init aos-animate" data-aos="fade-in"
                            data-aos-delay="400">
                            Recommended Blogs on Fundas Disease Detection
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-in"
                    data-aos-delay="400">
                    <div class="inflanar-service">
                        <div class="inflanar-service__head1" style="height: 200px; overflow: hidden;">
                            <!-- Set fixed height -->
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <div class="inflanar-service__body">
                            <div class="inflanar-service__top1">
                                @if($blog->category->name == 'Diabetic Retinopathy')
                                <div class="instagram-butt1">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Drusen')
                                <div class="instagram-butt1">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Age-related Macular Degeneration')
                                <div class="instagram-butt2">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Retinal Detachment')
                                <div class="instagram-butt3">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Central Serous Retinopathy')
                                <div class="instagram-butt4">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Retinitis Pigmentosa')
                                <div class="instagram-butt2">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Glaucoma')
                                <div class="instagram-butt4">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Cataract')
                                <div class="instagram-butt2">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Drusen')
                                <div class="instagram-butt7">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Macular Degeneration')
                                <div class="instagram-butt5">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Reticular Drusen')
                                <div class="instagram-butt1">{{ $blog->category->name }}</div>
                                @elseif($blog->category->name == 'Epiretinal Membrane')
                                <div class="instagram-butt">{{ $blog->category->name }}</div>
                                @else
                                <div class="instagram-butt">{{ $blog->category->name }}</div>
                                @endif
                            </div>
                            <h3 class="inflanar-service__title1">
                                <a href="{{ route('blogdetail', $blog->id) }}">{{ $blog->title }}</a>
                            </h3>
                            <div class="inflanar-service__author">
                                <div class="inflanar-service__author--info">
                                    <a href="influencer-profile.html">
                                        <!-- Display Admin's Image -->
                                        <img src="{{ asset('storage/' . ($blog->admin->picture ?? 'path_to_default_image.jpg')) }}"
                                            alt="Admin Image">
                                        <!-- Display Admin's Name -->
                                        {{ $blog->admin->name ?? 'Admin' }}
                                    </a>
                                </div>
                                <div class="inflanar-service__author--rating">
                                    <div class="inflanar-service__author--label1">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('F j, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <br><br>
            <div class="row">

                <div class="col-12 text-center">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                    <!-- This will generate the pagination links -->
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
    </section>


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
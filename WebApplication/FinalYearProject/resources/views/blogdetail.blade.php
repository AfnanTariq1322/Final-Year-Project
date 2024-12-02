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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-xyz" crossorigin="anonymous" />

</head>

<body>

    @include('includes.header')
 

  


    <br><br><br>
    <section id="blog_details">
        <div class="container">
            <div class="row">
                <br>
                <!-- Main Blog Content -->
                <div class="col-xl-8 col-lg-7  mb-4">
                    <br><br>
                    <div class="main_blog  mb-4">
                        <!-- Blog Image -->
                        <div class="main_blog_img ">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="blog" class="img-fluid w-100">
                        </div>
                        <!-- Blog Meta Information -->
                        <ul class="main_blog_header">
    <li><a href="#" class="blog-meta-item"><i class="fas fa-calendar-alt"></i> 
        {{ $blog->created_at->format('d-M-Y') }} <!-- Format the date -->
    </a></li>
    <li><a href="#" class="blog-meta-item"><i class="fas fa-comment-dots"></i> 
        {{ $blog->comments->count() }} Comment{{ $blog->comments->count() > 1 ? 's' : '' }}
    </a></li>
    <li><a href="#" class="blog-meta-item"><i class="fas fa-eye"></i> 
        {{ $blog->views }} Views <!-- Show the actual view count -->
    </a></li>
    <li><a href="#" class="blog-meta-item"><i class="fas fa-tags"></i> 
        {{ $blog->category ? $blog->category->name : 'Uncategorized' }} <!-- Display the category name -->
    </a></li>
</ul>


                        <!-- Blog Title and Content -->
                        <h4>{{  $blog->title}}</h4>
                        <p> 
                            <span>    {!! $blog->content !!}  
                            </span>
                        </p>
                        <!-- Comment Section -->
                        <div class="blog_comment_area">
    <h5 class="wsus__single_comment_heading">Total Comments: {{ $blog->comments->count() }}</h5>

    <!-- Loop through existing comments -->
    @foreach($blog->comments as $comment)
        <div class="wsus__single_comment">
            <div class="wsus__single_comment_img">


         
                <img src="{{ asset('storage/' . $comment->user->image) }}" alt="comment" class="img-fluid w-100">
            </div>
            <div class="wsus__single_comment_text">
                <h5>{{ $comment->user->name }}</h5> <!-- Assuming the user model has a name field -->
                <span>{{ $comment->created_at->format('d-M-Y') }}</span>
                <p>{{ $comment->comment }}</p>
            </div>
        </div>
    @endforeach

    <!-- Comment Form -->
    <form class="input_comment bg-gray" action="{{ route('comments.store', $blog->id) }}" method="POST">
        @csrf
        <h5>Post a Comment</h5>
        <div class="row">
            <div class="col-xl-12">
                <div class="blog_single_input">
                    <textarea name="comment" cols="3" rows="5" placeholder="Message" required></textarea>
                    <input hidden type="text" name="blog_id" value="{{  $blog->id}}">
                    <button type="submit" class="btn btn-primary" style="background-color: #503d94; border:none;">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
                </div>
                <!-- Sidebar -->
                <div class="col-xl-4 col-lg-5">
                    <br><br>


                    <div class="blog_sidebar">
    <!-- Categories Widget -->
    <div class="blog_category">
        <h4>Categories</h4>
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('blogs.filter', $category->id) }}">
                        {{ $category->name }} <span>{{ $category->blogs->count() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


<div class="blog_sidebar">
    <!-- Search Widget -->
    <div class="sidebar_blog">
        <h4>Popular Blogs</h4>

        @foreach($popularBlogs as $popularBlog)
        <a href="{{ route('blogdetail', $popularBlog->id) }}" class="sidebar_blog_single">
        <div class="sidebar_blog_img">
    <!-- Use the blog's image -->
    <img src="{{ asset('storage/' . $popularBlog->image) }}" alt="blog" class="img-fluid w-100" style="height: 45px; width: 45px; object-fit: cover;">
</div>
 

            <div class="sidebar_blog_text">
                <h5>{{ $popularBlog->title }}</h5>
                <p><span>{{ $popularBlog->created_at->format('M d, Y') }} </span> 
                {{ $popularBlog->comments->count() }} Comment(s)</p>
            </div>
        </a>
        @endforeach

    </div>
</div>

                </div>

            </div>
        </div>
        </div>
    </section>
    <style>
    .main_blog_header {
        list-style: none;
        /* Remove the default list style */
        padding: 0;
        display: flex;
        gap: 15px;
        /* Space between the items */
        flex-wrap: wrap;
        /* Allow items to wrap */
    }

    .blog-meta-item {
        display: inline-flex;
        /* Make the links inline-flex */
        align-items: center;
        /* Vertically center the icons and text */
        background-color: #604BB0;
        /* Set the badge background color */
        color: white;
        /* Set text color to white */
        padding: 5px 12px;
        /* Add some padding to the badge */
        border-radius: 5px;
        /* Make the badge rounded */
        font-size: 14px;
        /* Set font size */
        text-decoration: none;
        /* Remove the underline */
        transition: background-color 0.3s;
        /* Add a smooth transition */
    }

    .blog-meta-item:hover {
        background-color: white;
        /* Darker shade on hover */
    }

    .blog-meta-item i {
        margin-right: 5px;
        /* Add space between the icon and the text */
        font-size: 16px;
        /* Icon size */
    }


    /* Main Blog Section */
    .main_blog {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    /* Primary color */
    :root {
        --primary-color: #007bff;
    }

    /* Search Button */
    .blog_search button {
        width: 40px;
        background: #604BB0;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }



    /* Category Links */
    .blog_category li a {
        text-decoration: none;
        color: var(--primary-color);
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: color 0.3s;
    }

    .blog_category li a:hover {
        color: darken(var(--primary-color), 10%);
    }

    /* Category Count Span */
    .blog_category li a span {
        color: #fff;
        padding: 2px 8px;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .blog_category li a span:hover {
        background: darken(var(--primary-color), 10%);
    }

    .main_blog_img img {
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .main_blog_header {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .main_blog_header li a {
        text-decoration: none;

        font-size: 14px;
    }

    .main_blog_header li a i {
        margin-right: 5px;
    }

    h4 {
        margin-top: 15px;
        color: #333;
        font-size: 24px;
    }

    p {
        color: #555;
        font-size: 16px;
        margin: 15px 0;
        line-height: 1.6;
    }

    p span {
        display: block;
        margin-top: 10px;
    }

    .blog_comment_area {
        margin-top: 30px;
    }

    .wsus__single_comment {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .wsus__single_comment_img img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .wsus__single_comment_text h5 {
        margin: 0 0 5px;
        font-size: 16px;
        color: #333;
    }

    .wsus__single_comment_text span {
        font-size: 14px;
        color: #888;
    }

    .input_comment {
        margin-top: 30px;
    }

    .input_comment h5 {
        font-size: 20px;
        color: #333;
        margin-bottom: 15px;
    }

    .blog_single_input {
        margin-bottom: 15px;
    }

    .blog_single_input input,
    .blog_single_input textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .blog_single_input textarea {
        resize: vertical;
    }

    .read_btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .read_btn:hover {
        background-color: #0056b3;
    }

    /* Sidebar Styles */
    .blog_sidebar {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .blog_sidebar h4 {
        font-size: 20px;
        color: #333;
        margin-bottom: 15px;
    }

    .blog_search form {
        display: flex;
        gap: 10px;
    }

    .blog_search input {
        width: calc(100% - 40px);
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .blog_search button {
        width: 40px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .blog_category ul {
        list-style: none;
        padding: 0;
    }

    .blog_category li {
        margin-bottom: 10px;
    }

    .blog_category li a {
        text-decoration: none;
        color: #333;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .blog_category li a span {
        background: #604BB0;
        ;
        color: #fff;
        padding: 2px 8px;
        border-radius: 5px;
    }

    .sidebar_blog a {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        text-decoration: none;
        color: #333;
    }

    .sidebar_blog_img img {
        border-radius: 5px;
        width: 60px;
        height: 60px;
        object-fit: cover;
    }

    .sidebar_blog_text h5 {
        font-size: 16px;
        margin: 0;
    }

    .sidebar_blog_text p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #888;
    }
    </style>


    <br>






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

<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>

<!-- Check if there's a success message in session -->
@if(session('success'))
    <script>
        // Display SweetAlert2 success popup
        Swal.fire({
            icon: 'success', // Success icon
            title: 'Success!', // Title
            text: '{{ session('success') }}', // The success message
            timer: 8000, // The alert will auto-close after 8 seconds
        });
    </script>
@endif

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>

    <script src="../js/aos.min.js"></script>

    <script src="../js/ckeditor.min.js"></script>

    <script src="../js/fullcalendar.min.js"></script>

 
    <script src="../js/video-popup.min.js"></script>

    <script src="../js/swiper-slider.min.js"></script>

    <script src="../js/waypoints.min.js"></script>

    <script src="../js/jquery.counterup.min.js"></script>

    <script src="../js/active.js"></script>

</body>
</html>

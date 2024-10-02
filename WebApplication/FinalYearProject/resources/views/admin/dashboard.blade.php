<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:title" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:description" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <head>
        <title>Admin Dashboard</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" href="{{ asset('storage/downloads/appicon.png') }}">
    </head>

    <link rel="stylesheet" href="../AdminTemplate/vendor/chartist/css/chartist.min.css">
    <link href="../AdminTemplate/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../AdminTemplate/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="../AdminTemplate/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('admin/includes/header')

        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->

        <!--**********************************
            Chat box End
        ***********************************-->


        @include('admin/includes/navbar')

        @include('admin/includes/sidebar')
        <!--**********************************
            Content body start
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- <div class="form-head" style="background-image:url('images/background/bg3.jpg');background-position: bottom; ">
				<div class="container max d-flex align-items-center mt-0">
					<h2 class="font-w600 title text-white mb-2 mr-auto ">Dashboard</h2>
					<div class="weather-btn mb-2">
						<span class="mr-3 font-w600 text-black"><i class="fa fa-cloud mr-2"></i>21</span>
						<select class="form-control style-1 default-select  mr-3 ">
							<option>Medan, IDN</option>
							<option>Jakarta, IDN</option>
							<option>Surabaya, IDN</option>
						</select>
					</div>
					<a href="javascript:void(0);" class="btn white-transparent mb-2"><i class="las la-calendar scale5 mr-3"></i>Filter Periode</a>
				</div>
			</div> -->
            <div class="container-fluid">
                <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                    <h2 class="font-w600 title mb-2 mr-auto ">Dashboard</h2>

                </div>
                <div class="row">
                    <div class="col-xl-3 col-sm-6 m-t35">
                        <div class="widget-stat card bg-danger">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-calendar-1"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                    <p class="mb-1">Total Users</p>
                            <h3 class="text-white">{{ $totalUserCount }}</h3> <!-- Display total user count -->
                      </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 m-t35">
                        <!-- Remove the nested column -->
                        <div class="widget-stat card bg-success">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-document-2"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">Total Blogs</p>
                                        <h3 class="text-white">{{ $totalblogsCount }}</h3>
                                        <!-- Display total blogs count -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 
                <div class="col-xl-3 col-sm-6 m-t35">

                </div>
                <div class="col-xl-3 col-sm-6 m-t35">

                </div>









                <div class="row">































                </div>
            </div>
            <div class="row">






                <div class="row">




                    <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">

                    </div>
                    <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">

                    </div>
                    <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">

                    </div>



























                </div>
            </div>
        </div>



        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-3 mt-3 justify-content-between align-items-center">
                        <h4 class="text-black fs-20 mb-0">Recent Users</h4>
                        <a href="/admin/user" class="btn-link">View more</a>
                    </div>
                    <div class="testimonial-one px-4 owl-right-nav owl-carousel owl-loaded owl-drag">
                        @foreach($recentUsers as $user)
                        <div class="items">
                            <div class="text-center">
                                @if($user['image'])
                                <img src="{{ asset('storage/' . $user['image']) }}" alt="Profile Picture"
                                    class="mb-3 rounded" style="width: 100px; height: 100px;">
                                @else
                                <img src="{{ asset('path_to_default_image.jpg') }}" alt="Default Picture"
                                    style="width: 100px; height: 100px;">
                                @endif
                                <h5 class="mb-0"><a class="text-black" href="javascript:void(0);">{{ $user->name }}</a>
                                </h5>
                                <span class="badge-sm badge-secondary rounded">{{ $user->bloodgroup }}</span>
                                @if($user->bloodpressure == 'High')
                                <span class="badge-sm badge-danger rounded">{{ $user->bloodpressure }}</span>
                                <!-- Red for high -->
                                @elseif($user->bloodpressure == 'Normal')
                                <span class="badge-sm badge-warning rounded">{{ $user->bloodpressure }}</span>
                                <!-- Yellow for normal -->
                                @elseif($user->bloodpressure == 'Low')
                                <span class="badge-sm badge-success rounded">{{ $user->bloodpressure }}</span>
                                <!-- Green for low -->
                                @else
                                <span class="badge-sm badge-secondary rounded">Unknown</span>
                                <!-- Fallback for unknown values -->
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-12 ">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex mb-3 mt-3 justify-content-between align-items-center">
                        <h4 class="text-black fs-20 mb-0">Recent Blogs</h4>
                        <a href="/admin/blog" class="btn-link">View more</a>
                    </div>
                    <div class="testimonial-one px-4 owl-right-nav owl-carousel owl-loaded owl-drag">
                        @foreach($recentBlogs as $blog)
                        <div class="items">
                            <div class="text-center">
                                @if($blog->image_url)
                                <img src="{{ asset('storage/' . $blog->image_url) }}" alt="Blog Image"
                                    class="mb-3 rounded" style="width: 100px; height: 100px;">
                                @else
                                <img src="{{ asset('path_to_default_image.jpg') }}" alt="Default Image"
                                    style="width: 100px; height: 100px;">
                                @endif
                                <h5 class="mb-0"><a class="text-black"
                                        href="{{ route('pet.history', $blog->id) }}">{{ $blog->title }}</a></h5>
                                <span
                                    class="badge-sm badge-secondary rounded">{{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>


    </div>
    </div>
    </div>
    </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->

    <!--**********************************
            Footer start
        ***********************************-->
    @include('admin/includes/footer')

    <!--**********************************
            Footer end
        ***********************************-->





    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../AdminTemplate/vendor/global/global.min.js"></script>
    <script src="../AdminTemplate/vendor/bootstrap-select/dist/js/bootstrap-select.min.js">
    </script>
    <script src="../AdminTemplate/vendor/chart.js/Chart.bundle.min.js"></script>

    <!-- Chart piety plugin files -->
    <script src="../AdminTemplate/vendor/peity/jquery.peity.min.js"></script>

    <!-- Apex Chart -->
    <script src="../AdminTemplate/vendor/apexchart/apexchart.js"></script>

    <!-- Dashboard 1 -->
    <script src="../AdminTemplate/js/dashboard/dashboard-1.js"></script>

    <script src="../AdminTemplate/vendor/owl-carousel/owl.carousel.js"></script>
    <script src="../AdminTemplate/js/custom.min.js"></script>
    <script src="../AdminTemplate/js/deznav-init.js"></script>
    <script src="../AdminTemplate/js/demo.js"></script>

</body>

</html>
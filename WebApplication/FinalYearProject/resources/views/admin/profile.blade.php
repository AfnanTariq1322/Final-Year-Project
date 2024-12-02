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
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                toastr.success("{{ session('success') }}", "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "10000",  // Set timeOut to 10 seconds
                    extendedTimeOut: "2000",  // Set extendedTimeOut to 2 seconds
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}", "Error", {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: "10000",  // Set timeOut to 10 seconds
                        extendedTimeOut: "2000",  // Set extendedTimeOut to 2 seconds
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    });
                @endforeach
            });
        </script>
    @endif

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('admin/includes/header')

        <!--**********************************
            Nav header end
        ***********************************-->

        

        @include('admin/includes/navbar')

        @include('admin/includes/sidebar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <!-- Add Project -->
                <div class="modal fade" id="addProjectSidebar">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Project</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Project Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Deadline</label>
                                        <input type="date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Client Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary">CREATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">

                                        <li class="nav-item active"><a href="#about-me" data-toggle="tab"
                                                class="nav-link">About Me</a>
                                        </li>
                                        <li class="nav-item"><a href="#profile-settings" data-toggle="tab"
                                                class="nav-link">Update Profile</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="my-posts" class="tab-pane fade    ">
                                            <div class="my-post-content pt-3">
                                                <div class="post-input">
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="linkModal">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Social Links</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"><span>×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <a class="btn-social facebook"
                                                                        href="javascript:void(0)"><i
                                                                            class="fa fa-facebook"></i></a>
                                                                    <a class="btn-social google-plus"
                                                                        href="javascript:void(0)"><i
                                                                            class="fa fa-google-plus"></i></a>
                                                                    <a class="btn-social linkedin"
                                                                        href="javascript:void(0)"><i
                                                                            class="fa fa-linkedin"></i></a>
                                                                    <a class="btn-social instagram"
                                                                        href="javascript:void(0)"><i
                                                                            class="fa fa-instagram"></i></a>
                                                                    <a class="btn-social twitter"
                                                                        href="javascript:void(0)"><i
                                                                            class="fa fa-twitter"></i></a>
                                                                    <a class="btn-social youtube"
                                                                        href="javascript:void(0)"><i
                                                                            class="fa fa-youtube"></i></a>
                                                                    <a class="btn-social whatsapp"
                                                                        href="javascript:void(0)"><i
                                                                            class="fa fa-whatsapp"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal -->

                                                </div>



                                            </div>
                                        </div>
                                        <div id="about-me" class="tab-pane fade  active show">
                                            <div class="profile-about-me">
                                                <div class="pt-4 border-bottom-1 pb-3">
                                                    <h4 class="text-primary">About Me</h4>
                                                    <p class="mb-2">{{ $LoggedAdminInfo['bio'] }}</p>
                                                </div>
                                            </div>
                                            <div class="profile-personal-info">
                                                <h4 class="text-primary mb-4">Personal Information</h4>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h5 class="f-w-500">Name <span class="pull-right">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-9 col-7">
                                                        <span>{{ $LoggedAdminInfo['name'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h5 class="f-w-500">Email <span class="pull-right">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-9 col-7">
                                                        <span>{{ $LoggedAdminInfo['email'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h5 class="f-w-500">Username <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-9 col-7">
                                                        <span>{{ $LoggedAdminInfo['username'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h5 class="f-w-500">Picture <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-9 col-7">
                                                        @if($LoggedAdminInfo['picture'])
                                                        <img src="{{ asset('storage/' . $LoggedAdminInfo['picture']) }}"
                                                            alt="Profile Picture" width="100" height="100">
                                                        @else
                                                        <span>No picture available</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-3 col-5">
                                                        <h5 class="f-w-500">Phone Number <span
                                                                class="pull-right">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-9 col-7">
                                                        <span>{{ $LoggedAdminInfo['phone_number'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="profile-settings" class="tab-pane fade">
                                            <div class="pt-3">
                                                <div class="settings-form">
                                                    <h4 class="text-primary">Profile Setting</h4>
                                                    <form action="{{ route('admin.profile.update') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" name="username"
                                                                        value="{{ $LoggedAdminInfo['username'] }}"
                                                                        class="form-control" placeholder="Username">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" name="name"
                                                                        value="{{ $LoggedAdminInfo['name'] }}"
                                                                        class="form-control" placeholder="Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <div class="input-group">
                                                                        <input name="bio"
                                                                            value="{{ $LoggedAdminInfo['email'] }}"
                                                                            disabled class="form-control"
                                                                            placeholder="Bio">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-info-circle"
                                                                                    id="emailInfo"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                document.addEventListener('DOMContentLoaded',
                                                                function() {
                                                                    var emailInput = document.querySelector(
                                                                        'input[name="bio"]');
                                                                    var emailInfo = document.getElementById(
                                                                        'emailInfo');

                                                                    emailInput.addEventListener('click',
                                                                        function() {
                                                                            alert(
                                                                                "Email cannot be modified");
                                                                        });

                                                                    emailInfo.addEventListener('click',
                                                                        function() {
                                                                            alert(
                                                                                "Email cannot be modified");
                                                                        });
                                                                });
                                                                </script>

                                                            </div>
                                                            <div class="col-md-6">

                                                                <div class="form-group">
                                                                    <label>Phone Number</label>
                                                                    <input type="text" name="phone_number"
                                                                        value="{{ $LoggedAdminInfo['phone_number'] }}"
                                                                        class="form-control" placeholder="Phone Number">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Bio</label>
                                                            <input type="bio" name="bio"
                                                                value="{{ $LoggedAdminInfo['bio'] }}"
                                                                class="form-control" placeholder="Bio">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="newPicture">New Picture</label>
                                                            <input type="file" name="picture" id="newPicture"
                                                                class="form-control-file"
                                                                onchange="previewImage(event)">
                                                        </div>

                                                        <div class="form-group" id="imagePreviewContainer"
                                                            style="display: none;">
                                                            <label>Preview</label><br>
                                                            <img id="imagePreview" src="#" alt="New Profile Picture"
                                                                width="100" height="100">
                                                        </div>

                                                        <script>
                                                        function previewImage(event) {
                                                            var imagePreview = document.getElementById('imagePreview');
                                                            var imagePreviewContainer = document.getElementById(
                                                                'imagePreviewContainer');

                                                            // Display the image preview container
                                                            imagePreviewContainer.style.display = 'block';

                                                            // Set the source of the preview image to the selected file
                                                            imagePreview.src = URL.createObjectURL(event.target.files[
                                                                0]);
                                                        }
                                                        </script>

                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary">Save</button>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="replyModal">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Post Reply</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <textarea class="form-control" rows="4">Message</textarea>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Reply</button>
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
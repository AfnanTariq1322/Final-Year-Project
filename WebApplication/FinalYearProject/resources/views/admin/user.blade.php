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
    <style>
        .toast-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }
    </style>

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
        <div class="chatbox">
            <div class="chatbox-close"></div>
            <div class="custom-tab-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#notes">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#alerts">Alerts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#chat">Chat</a>
                    </li>
                </ul>

            </div>
        </div>
        <!--**********************************
            Chat box End
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Users</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="card">
                    @if (session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                toastr.success("{{ session('success') }}", "Success", {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-top-right",
                                    showDuration: "300",
                                    hideDuration: "1000",
                                    timeOut: "10000", // Set timeOut to 10 seconds
                                    extendedTimeOut: "2000", // Set extendedTimeOut to 2 seconds
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
                                        timeOut: "10000", // Set timeOut to 10 seconds
                                        extendedTimeOut: "2000", // Set extendedTimeOut to 2 seconds
                                        showEasing: "swing",
                                        hideEasing: "linear",
                                        showMethod: "fadeIn",
                                        hideMethod: "fadeOut"
                                    });
                                @endforeach
                            });
                        </script>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success mb-0 ms-3" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="col-lg-12">
                   

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;"><strong>#</strong></th>
                                            <th><strong>Image</strong></th>
                                            <th><strong>Name</strong></th>
                                            <th><strong>Email</strong></th>
                                            <th><strong>Phone Number</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        @foreach ($users as $user)
                                            <tr id="userRow{{ $user->id }}">
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $user->image) }}" 
                                                         alt="Profile Picture" width="40" height="40">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->status }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                       

                                                        &nbsp;&nbsp;&nbsp;
                                                        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

                                                        <div id="status-{{ $user->id }}">
                                                            @if ($user->status == 'active')
                                                                <form
                                                                    action="{{ route('user.inactive', ['id' => $user->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-xs">Deactivate</button>
                                                                </form>
                                                            @else
                                                                <form
                                                                    action="{{ route('user.active', ['id' => $user->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-xs">Activate</button>
                                                                </form>
                                                            @endif
                                                        </div>

                                                </td>

                            </div>
                            </td>
                            </tr>



                            </tr>
                            @endforeach
                            </tbody>
                            </table>

                            <!-- Update Modal -->

                            <style>
                                .page-link,
                                span .page-link {
                                    color: #90a955;
                                }

                                .page-item {
                                    color: #90a955;
                                }

                                .active {
                                    color: #90a955;
                                }

                                .page-item.active .page-link {
                                    z-index: 1;
                                    color: white;
                                    background-color: #90a955;
                                    border-color: #90a955;
                                }
                            </style>
                            <div class="d-flex ">
                                {{ $users->links('pagination::bootstrap-5') }}
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
        <script src="../AdminTemplate/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
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

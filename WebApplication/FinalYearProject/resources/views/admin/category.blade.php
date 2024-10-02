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
        <div class="content-body">
            <div class="container-fluid">
                <!-- Add Project -->

                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="card"> @if(session('success'))
                    <div class="alert alert-success mb-0 ms-3" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif


                    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog"
                        aria-labelledby="addProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductModalLabel">Add Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="addCategoryForm" action="{{ route('category.add') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Category Name:</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm mb-2">Add Category</button>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="card-header">

                            <h4 class="card-title">Category </h4>
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                                data-target="#addProductModal">Add Category</button>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        @foreach($categories as $category)
                                        <tr>
                                            <td><span class="badge badge-info">{{ $category->name }}</span></td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- Edit Button Triggering the Update Modal -->
                                                    <a href="#"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1 edit-user"
                                                        data-toggle="modal"
                                                        data-target="#updateModal{{ $category->id }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <!-- Delete Category Form -->
                                                    <form action="{{ route('category.delete', $category->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger shadow btn-xs sharp">
                                                            <i class="fa fa-trash"></i> <!-- Trash icon for delete -->
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>

                                        <!-- Update Modal -->
                                        <div class="modal fade" id="updateModal{{ $category->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="updateModalLabel{{ $category->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="updateModalLabel{{ $category->id }}">Update Category
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Update Category Form -->
                                                        <form action="{{ route('category.update', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="name">Category Name:</label>
                                                                <input type="text" name="name"
                                                                    value="{{ $category->name }}" class="form-control"
                                                                    required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Category</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
               

<div class="d-flex ">
{{ $categories->links('pagination::bootstrap-5') }}
    </div>
                            </div>
                        </div>

                    </div>



                    @foreach($categories as $product)

                    <!-- Update Modal -->
                    <div class="modal fade" id="updateModal{{  $product->CategoryID  }}" tabindex="-1" role="dialog"
                        aria-labelledby="updateModalLabel{{  $product->CategoryID  }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel{{ $product->CategoryID  }}">
                                        Update
                                        Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <!-- Use the PUT method for updating -->

                                        <div class="form-group">
                                            <label for="name">Category Name:</label>
                                            <input type="text" name="name" value="{{ $category->name }}"
                                                class="form-control" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Category</button>
                                    </form>




                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach

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
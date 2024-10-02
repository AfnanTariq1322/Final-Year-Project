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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Blogs</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="card"> @if (session('success'))
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


                    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog"
    aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addBlogForm" action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="blogTitle">Title:</label>
                        <input type="text" class="form-control" id="blogTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="blogContent">Content:</label>
                        <textarea class="form-control" id="blogContent" name="content" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control" id="category" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="imageInput" name="image" required>
                        <span id="imageError" class="text-danger"></span>
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addBlogBtn">Add Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Image preview and validation
    document.getElementById('imageInput').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var imagePreview = document.getElementById('imagePreview');
        var imageError = document.getElementById('imageError');

        var validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validImageTypes.includes(file.type)) {
            imageError.textContent = 'Please select a valid image file (JPEG, PNG, GIF)';
            imagePreview.style.display = 'none';
            return;
        } else {
            imageError.textContent = '';
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    });

    // Initialize CKEditor with basic formatting options and lists
    CKEDITOR.replace('blogContent', {
        height: 300,
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] }
        ]
    });
</script>

                    <div class="col-lg-12">
                        <div class="card-header">
                            <h4 class="card-title">Blogs</h4>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-secondary btn-sm mb-2 mr-2" data-toggle="modal"
                                    data-target="#addProductModal">Add Blog</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>

                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blogs as $blog)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $blog['image']) }}" alt="Blog Image"
                                                    width="40" height="40">
                                            </td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->category->name }}</td>

                                            <td>
                                                {!! Str::words(strip_tags($blog->content), 3) !!}...
                                                <!-- Button trigger modal -->
                                                <a href="#" data-toggle="modal"
                                                    data-target="#blogModal{{ $blog->id }}">Read More</a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="blogModalLabel{{ $blog->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="blogModalLabel{{ $blog->id }}">
                                                                    {{ $blog->title }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $blog->content !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1 edit-blog"
                                                        data-toggle="modal" data-target="#updateModal{{ $blog->id }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger shadow btn-xs sharp">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>



                                        <!-- Update Modal -->
                                        <div class="modal fade" id="updateModal{{ $blog->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="updateModalLabel{{ $blog->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.blog.update', $blog->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="title">Title:</label>
                                                            <input type="text" class="form-control" id="title"
                                                                name="title" value="{{ $blog->title }}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="content">Content:</label>
                                                            <textarea class="form-control" id="content" name="content"
                                                                required>{{ $blog->content }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="category">Category:</label>
                                                            <select class="form-control" id="category"
                                                                name="category_id" required>
                                                                @foreach($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Image (optional):</label>
                                                            <input type="file" class="form-control-file" id="image"
                                                                name="image">
                                                            <img src="{{ asset('storage/' . $blog->image) }}"
                                                                alt="Current Image"
                                                                style="max-width: 100%; margin-top: 10px;">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update
                                                            Blog</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </tbody>
                                </table>
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
                                    {{ $blogs->links('pagination::bootstrap-5') }}
                                </div>

                            </div>
                        </div>

                    </div>



                    @foreach($blogs as $product)

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
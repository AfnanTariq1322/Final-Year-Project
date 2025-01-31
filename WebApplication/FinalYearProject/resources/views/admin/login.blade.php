<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
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
    <title>Zenix - Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="../AdminTemplate/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../AdminTemplate/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="images/logo-full.png" alt="">
                                    </div>

                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="{{ route('admin.check') }}" method="POST">
                                        @if(session('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                        @endif
                                         
                                        @if(session('fail'))
                                        <div class="alert alert-danger">{{ session('fail') }}</div>
                                        @endif

                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Enter your email" value="{{ old('email') }}" required>
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Enter your password" required>
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>



                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="/admin/register">Sign
                                                up</a></p>
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
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../AdminTemplate/vendor/global/global.min.js"></script>
    <script src="../AdminTemplate/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../AdminTemplate/js/custom.min.js"></script>
    <script src="../AdminTemplate/js/deznav-init.js"></script>
    <script src="../AdminTemplate/js/demo.js"></script>
    <script src="../AdminTemplate/js/styleSwitcher.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Admin Dashboard">
    <meta property="og:title" content="Admin Dashboard">
    <meta property="og:description" content="Admin Dashboard">
    <meta name="format-detection" content="telephone=no">
    <title>Admin Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/downloads/appicon.png') }}">
    <link href="../AdminTemplate/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../AdminTemplate/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #604BB0 0%, #8A7BC8 100%);
        }
        .btn-primary {
            background-color: #604BB0 !important;
            border-color: #604BB0 !important;
            padding: 12px 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #4f3d8c !important;
            border-color: #4f3d8c !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.3);
        }
        .text-primary {
            color: #604BB0 !important;
        }
        .authincation-content {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 35px rgba(96, 75, 176, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #604BB0;
            box-shadow: 0 0 0 0.2rem rgba(96, 75, 176, 0.15);
        }
        .auth-form h4 {
            color: #604BB0;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .auth-form {
            padding: 40px;
        }
        .form-group label {
            color: #604BB0;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .alert {
            border-radius: 10px;
            padding: 15px 20px;
        }
        .text-center.mb-3 img {
            max-width: 180px;
            margin-bottom: 20px;
        }
        .input-group-text {
            background: transparent;
            border: 2px solid #e0e0e0;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .form-control::placeholder {
            color: #999;
        }
        .authincation {
            position: relative;
            overflow: hidden;
        }
        .authincation::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(96, 75, 176, 0.1) 0%, rgba(96, 75, 176, 0) 70%);
            animation: rotate 20s linear infinite;
        }
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    </style>
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
 
                                    <h4 class="text-center mb-4">Welcome Back Admin!</h4>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter your email" value="{{ old('email') }}" required>
                                            </div>
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Enter your password" required>
                                            </div>
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign In <i class="fas fa-arrow-right ml-2"></i></button>
                                        </div>
                                    </form>
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
</body>

</html>
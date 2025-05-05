<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fundus Disease Analysis - Image Analysis</title>

    <link rel="icon" href="../img/newicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
    <header class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-6">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/newicon.png') }}" alt="Logo">
                            <span>Fundus Disease Analysis</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-6">
                    <div class="header-right">
                        <div class="header-right__profile">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/doctor-avatar.png') }}" alt="Profile">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('doctor.profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('doctor.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="inflaner-inner-page pd-top-90 pd-btm-120">
        <div class="container">
            <div class="inflanar-personals">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="inflanar-dashboard-sidebar">
                            <div class="inflanar-dashboard-sidebar__profile">
                                <div class="inflanar-dashboard-sidebar__profile-image">
                                    <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/doctor-avatar.png') }}" alt="Doctor Profile">
                                </div>
                                <div class="inflanar-dashboard-sidebar__profile-info">
                                    <h4>{{ $doctor->name }}</h4>
                                    <p>{{ $doctor->specialization }}</p>
                                </div>
                            </div>
                         @include('includes.doctor_sidebar')
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="inflanar-profile-info">
                            <div class="inflanar-profile-info__head">
                                <h3 class="inflanar-profile-info__heading">
                                    <i class="fas fa-microscope"></i> Fundus Image Analysis
                                </h3>
                            </div>
                            <div class="inflanar-profile-info__content">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form action="{{ route('doctor.analyze.fundus') }}" method="POST" enctype="multipart/form-data" class="analysis-form" id="analysisForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="upload-area" id="uploadArea">
                                                <input type="file" name="fundus_image" id="fundusImage" class="d-none" accept="image/*" required>
                                                <div class="upload-content">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <h4>Upload Fundus Image</h4>
                                                    <p>Drag and drop your image here or click to browse</p>
                                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('fundusImage').click()">
                                                        Choose File
                                                    </button>
                                                </div>
                                                <div class="preview-area d-none" id="previewArea">
                                                    <img id="imagePreview" src="" alt="Preview">
                                                    <button type="button" class="btn btn-danger btn-sm remove-image" onclick="removeImage()">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg w-100" id="analyzeBtn">
                                                <i class="fas fa-microscope me-2"></i> Analyze Image
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Processing Animation -->
                                <div class="processing-animation d-none" id="processingAnimation">
                                    <div class="processing-content">
                                        <div class="processing-icon">
                                            <div class="pulse-ring"></div>
                                            <i class="fas fa-microscope"></i>
                                        </div>
                                        <h3>Analyzing Fundus Image</h3>
                                        <div class="processing-steps">
                                            <div class="step">
                                                <div class="step-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <div class="step-content">
                                                    <span class="step-title">Image Uploaded</span>
                                                    <div class="step-progress"></div>
                                                </div>
                                            </div>
                                            <div class="step">
                                                <div class="step-icon">
                                                    <i class="fas fa-cogs"></i>
                                                </div>
                                                <div class="step-content">
                                                    <span class="step-title">Processing Image</span>
                                                    <div class="step-progress"></div>
                                                </div>
                                            </div>
                                            <div class="step">
                                                <div class="step-icon">
                                                    <i class="fas fa-brain"></i>
                                                </div>
                                                <div class="step-content">
                                                    <span class="step-title">AI Analysis</span>
                                                    <div class="step-progress"></div>
                                                </div>
                                            </div>
                                            <div class="step">
                                                <div class="step-icon">
                                                    <i class="fas fa-file-medical"></i>
                                                </div>
                                                <div class="step-content">
                                                    <span class="step-title">Generating Report</span>
                                                    <div class="step-progress"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(isset($analysisResults))
                                <div class="analysis-results mt-5">
                                    <div class="disclaimer alert alert-info mb-4">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>AI-Assisted Analysis Disclaimer:</strong> The following analysis is generated by our AI system and should be used as a supplementary tool for your clinical assessment. Please review and validate these findings with your professional expertise.
                                    </div>

                                    <!-- Predicted Class Section -->
                                    <div class="predicted-class-section mb-4">
                                        <div class="card border-primary">
                                            <div class="card-body text-center">
                                                <h3 class="card-title mb-3">
                                                    <i class="fas fa-microscope me-2"></i>
                                                    Primary Detection
                                                </h3>
                                                <div class="predicted-class">
                                                    <h2 class="text-primary mb-2">{{ $analysisResults['predicted_class'] }}</h2>
                                                    <div class="confidence-badge">
                                                        <span class="badge bg-success">
                                                            Confidence: {{ number_format($analysisResults['confidence'] * 100, 1) }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mb-4">AI Analysis Results</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>AI-Detected Conditions</h5>
                                                    <ul class="list-group">
                                                        @foreach($analysisResults['conditions'] as $condition)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $condition['name'] }}
                                                            <span class="badge bg-primary rounded-pill">
                                                                {{ number_format($condition['confidence'] * 100, 1) }}%
                                                            </span>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Suggested Follow-up Actions</h5>
                                                    <div class="recommendations">
                                                        @foreach($analysisResults['recommendations'] as $recommendation)
                                                        <div class="alert alert-info">
                                                            <i class="fas fa-clipboard-list me-2"></i>
                                                            {{ $recommendation }}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <div class="card bg-light">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <i class="fas fa-user-md me-2"></i>
                                                            Clinical Notes
                                                        </h5>
                                                        <p class="card-text">
                                                            <small class="text-muted">
                                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                                Please use your clinical judgment to:
                                                            </small>
                                                        </p>
                                                        <ul class="list-unstyled">
                                                            @if(isset($analysisResults['clinical_notes']))
                                                                @foreach($analysisResults['clinical_notes'] as $note)
                                                                    <li><i class="fas fa-check-circle text-success me-2"></i>{{ $note }}</li>
                                                                @endforeach
                                                            @else
                                                                <li><i class="fas fa-check-circle text-success me-2"></i>Verify AI-detected conditions through clinical examination</li>
                                                                <li><i class="fas fa-check-circle text-success me-2"></i>Consider patient's medical history and symptoms</li>
                                                                <li><i class="fas fa-check-circle text-success me-2"></i>Order additional tests if necessary</li>
                                                                <li><i class="fas fa-check-circle text-success me-2"></i>Make final diagnosis based on comprehensive assessment</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Header Styles */
        .header-area {
            background: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo a {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .logo span {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .header-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 20px;
        }

        .header-right__profile .dropdown-toggle {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .header-right__profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-item i {
            margin-right: 10px;
            color: #604BB0;
            width: 20px;
            text-align: center;
        }

        .dropdown-item:hover {
            background: rgba(96, 75, 176, 0.1);
            color: #604BB0;
        }

        /* Sidebar Styles */
        .inflanar-dashboard-sidebar {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            position: sticky;
            top: 30px;
        }

        .inflanar-dashboard-sidebar__profile {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(96, 75, 176, 0.1);
        }

        .inflanar-dashboard-sidebar__profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid #604BB0;
            padding: 3px;
        }

        .inflanar-dashboard-sidebar__profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .inflanar-dashboard-sidebar__profile-info h4 {
            color: #333;
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .inflanar-dashboard-sidebar__profile-info p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .inflanar-dashboard-sidebar__menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .inflanar-dashboard-sidebar__menu li {
            margin-bottom: 10px;
        }

        .inflanar-dashboard-sidebar__menu li a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #666;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .inflanar-dashboard-sidebar__menu li a i {
            width: 24px;
            text-align: center;
            margin-right: 15px;
            font-size: 18px;
            color: #604BB0;
            transition: all 0.3s ease;
        }

        .inflanar-dashboard-sidebar__menu li.active a,
        .inflanar-dashboard-sidebar__menu li a:hover {
            background: rgba(96, 75, 176, 0.1);
            color: #604BB0;
        }

        .inflanar-dashboard-sidebar__menu li.active a i,
        .inflanar-dashboard-sidebar__menu li a:hover i {
            color: #604BB0;
        }

        /* Profile Info Card Styles */
        .inflanar-profile-info {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
            overflow: hidden;
        }

        .inflanar-profile-info__head {
            background: #604BB0;
            padding: 20px 30px;
            color: white;
        }

        .inflanar-profile-info__heading {
            margin: 0;
            font-size: 20px;
            display: flex;
            align-items: center;
        }

        .inflanar-profile-info__heading i {
            margin-right: 10px;
            font-size: 24px;
        }

        .inflanar-profile-info__content {
            padding: 30px;
        }

        /* Processing Animation Styles */
        .processing-animation {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.98);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(10px);
        }

        .processing-content {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(96, 75, 176, 0.2);
            max-width: 500px;
            width: 90%;
            animation: slideUp 0.5s ease;
        }

        .processing-icon {
            width: 120px;
            height: 120px;
            background: rgba(96, 75, 176, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
        }

        .pulse-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid #604BB0;
            animation: pulse 2s infinite;
        }

        .processing-icon i {
            font-size: 40px;
            color: #604BB0;
            animation: float 3s ease-in-out infinite;
        }

        .processing-content h3 {
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 24px;
            background: linear-gradient(45deg, #604BB0, #7B68EE);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .processing-steps {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .step {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 15px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(96, 75, 176, 0.1);
            transition: all 0.3s ease;
        }

        .step-icon i {
            font-size: 20px;
            color: #604BB0;
            transition: all 0.3s ease;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .step-progress {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .step-progress::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(45deg, #604BB0, #7B68EE);
            transition: width 1.5s ease;
        }

        .step.active .step-icon {
            background: #604BB0;
            transform: scale(1.1);
        }

        .step.active .step-icon i {
            color: white;
        }

        .step.active .step-progress::after {
            width: 100%;
        }

        .step.completed .step-icon {
            background: #28a745;
        }

        .step.completed .step-icon i {
            color: white;
        }

        .step.completed .step-progress::after {
            width: 100%;
            background: #28a745;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.5;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced Upload Area Styles */
        .upload-area {
            border: 2px dashed #604BB0;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .upload-area:hover {
            background: rgba(96, 75, 176, 0.05);
            transform: translateY(-2px);
        }

        .upload-content i {
            font-size: 60px;
            color: #604BB0;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .upload-area:hover .upload-content i {
            transform: scale(1.1);
        }

        .upload-content h4 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .upload-content p {
            color: #666;
            margin-bottom: 25px;
        }

        .preview-area {
            position: relative;
            margin-top: 20px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .preview-area img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .remove-image {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            color: #dc3545;
        }

        .remove-image:hover {
            background: #dc3545;
            color: white;
            transform: rotate(90deg);
        }

        /* Enhanced Button Styles */
        .btn-primary {
            background: linear-gradient(45deg, #604BB0, #7B68EE);
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(96, 75, 176, 0.3);
            background: linear-gradient(45deg, #7B68EE, #604BB0);
        }

        /* Enhanced Results Styles */
        .analysis-results {
            margin-top: 40px;
            animation: fadeIn 0.5s ease;
        }

        .analysis-results h4 {
            color: #604BB0;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .analysis-results h4:before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 24px;
            background: #604BB0;
            margin-right: 10px;
            border-radius: 2px;
        }

        .list-group-item {
            border-radius: 10px;
            margin-bottom: 10px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            transform: translateX(5px);
            background: rgba(96, 75, 176, 0.05);
        }

        .badge {
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 15px;
            border: none;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Predicted Class Section Styles */
        .predicted-class-section .card {
            border-width: 2px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(96, 75, 176, 0.1);
            transition: all 0.3s ease;
        }

        .predicted-class-section .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(96, 75, 176, 0.2);
        }

        .predicted-class-section .card-title {
            color: #604BB0;
            font-weight: 600;
        }

        .predicted-class-section .predicted-class h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #604BB0;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .predicted-class-section .confidence-badge {
            margin-top: 1rem;
        }

        .predicted-class-section .confidence-badge .badge {
            font-size: 1.1rem;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            background: linear-gradient(45deg, #28a745, #20c997);
            box-shadow: 0 3px 10px rgba(40, 167, 69, 0.2);
        }
    </style>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/active.js"></script>
    <script>
        // Handle file upload and preview
        document.getElementById('fundusImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('previewArea').classList.remove('d-none');
                    document.querySelector('.upload-content').classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        });

        // Handle drag and drop
        const uploadArea = document.getElementById('uploadArea');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadArea.classList.add('highlight');
        }

        function unhighlight(e) {
            uploadArea.classList.remove('highlight');
        }

        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];
            
            if (file) {
                document.getElementById('fundusImage').files = dt.files;
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('previewArea').classList.remove('d-none');
                    document.querySelector('.upload-content').classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('fundusImage').value = '';
            document.getElementById('previewArea').classList.add('d-none');
            document.querySelector('.upload-content').classList.remove('d-none');
        }

        // Add form submission handler
        document.getElementById('analysisForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show processing animation
            document.getElementById('processingAnimation').classList.remove('d-none');
            
            // Simulate processing steps
            const steps = document.querySelectorAll('.step');
            let currentStep = 0;
            
            const processStep = () => {
                if (currentStep < steps.length) {
                    steps[currentStep].classList.add('active');
                    if (currentStep > 0) {
                        steps[currentStep - 1].classList.add('completed');
                        steps[currentStep - 1].classList.remove('active');
                    }
                    currentStep++;
                    setTimeout(processStep, 1500);
                } else {
                    // Submit the form after animation
                    this.submit();
                }
            };
            
            processStep();
        });
    </script>
</body>
</html> 
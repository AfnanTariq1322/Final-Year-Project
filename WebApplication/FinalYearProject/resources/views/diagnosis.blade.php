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
     
    <div class="diagnosis-wrapper">
        <section class="diagnosis-section pd-top-90 pd-btm-120">
            <div class="container">
                @if(isset($LoggedUserInfo))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="diagnosis-header text-center mb-5">
                                <h2 class="section-title">Fundus Image Analysis</h2>
                                <p class="section-subtitle">Upload your fundus image for AI-powered analysis</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="diagnosis-content">
                        <!-- Upload Section -->
                        <div class="diagnosis-section-content" id="uploadContainer">
                            <div class="upload-container">
                                <div class="upload-area" id="dropZone">
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <h3>Drag & Drop Your Image</h3>
                                        <p>or</p>
                                        <label class="upload-btn">
                                            Choose File
                                            <input type="file" id="fileInput" accept="image/*" hidden>
                                        </label>
                                        <p class="upload-hint">Supported formats: JPG, PNG</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Analysis Section -->
                        <div class="diagnosis-section-content" id="analysisSection" style="display: none;">
                            <div class="analysis-container">
                                <div class="analysis-header">
                                    <h3>Analyzing Your Image</h3>
                                    <div class="progress-bar">
                                        <div class="progress" id="analysisProgress"></div>
                                    </div>
                                </div>
                                <div class="analysis-content">
                                    <div class="analysis-steps">
                                        <div class="step active">
                                            <i class="fas fa-image"></i>
                                            <span>Image Processing</span>
                                        </div>
                                        <div class="step">
                                            <i class="fas fa-microscope"></i>
                                            <span>Feature Extraction</span>
                                        </div>
                                        <div class="step">
                                            <i class="fas fa-brain"></i>
                                            <span>AI Analysis</span>
                                        </div>
                                        <div class="step">
                                            <i class="fas fa-file-medical"></i>
                                            <span>Report Generation</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Results Section -->
                        <div class="diagnosis-section-content" id="resultsSection" style="display: none;">
                            <div class="results-container">
                                <div class="results-header">
                                    <h3>Analysis Results</h3>
                                    <div class="severity-indicator">
                                        <span class="severity-label">Confidence Level:</span>
                                        <span class="severity-value" id="severityValue">N/A</span>
                                    </div>
                                </div>
                                
                                <div class="results-content">
                                    <div class="diagnosis-card">
                                        <h4>Detected Condition</h4>
                                        <p id="detectedCondition">N/A</p>
                                    </div>
                                    
                                    <div class="details-grid">
                                        <div class="detail-item">
                                            <i class="fas fa-percentage"></i>
                                            <h5>Confidence Level</h5>
                                            <p id="confidenceLevel">N/A</p>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-clock"></i>
                                            <h5>Analysis Time</h5>
                                            <p id="analysisTime">N/A</p>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-calendar-check"></i>
                                            <h5>Date</h5>
                                            <p id="analysisDate">N/A</p>
                                        </div>
                                    </div>
    
                                    <div class="recommendations">
                                        <h4>Recommendations</h4>
                                        <ul id="recommendationsList"></ul>
                                    </div>

                                    <div class="clinical-notes">
                                        <h4>Clinical Notes</h4>
                                        <ul id="clinicalNotesList"></ul>
                                    </div>

                                    <div class="conditions-list">
                                        <h4>Detected Conditions</h4>
                                        <ul id="conditionsList"></ul>
                                    </div>

                                    <div class="tips-and-relief">
                                        <h4>Tips & Relief Suggestions</h4>
                                        <div id="tipsAndRelief" class="tips-content"></div>
                                    </div>
    
                                    <div class="disclaimer">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <p>This is an AI-generated report. Please consult with a medical professional for accurate diagnosis and treatment.</p>
                                    </div>
    
                                    <div class="action-buttons">
                                        <button class="btn btn-primary" id="downloadPDF">
                                            <i class="fas fa-download"></i> Download PDF Report
                                        </button>
                                        <button class="btn btn-secondary" id="tryAgain">
                                            <i class="fas fa-redo"></i> Try Analysis Again
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="auth-error-container">
                        <div class="auth-error-content">
                            <i class="fas fa-lock"></i>
                            <h2>Authentication Required</h2>
                            <p>Please log in to access the fundus image analysis feature.</p>
                            <a href="{{ route('user.login') }}" class="btn btn-primary login-btn">
                               
                                <span>Login Now</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
    
    <style>
    /* Diagnosis Wrapper */
    .diagnosis-wrapper {
        width: 100%;
        min-height: 100vh;
        background: #f8f9fa;
    }
    
    /* Diagnosis Section Styles */
    .diagnosis-section {
        padding: 60px 0;
        width: 100%;
    }
    
    .diagnosis-section .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .diagnosis-content {
        max-width: 800px;
        margin: 0 auto;
        width: 100%;
    }
    
    .diagnosis-section-content {
        width: 100%;
        margin: 0 auto;
    }
    
    /* Diagnosis Section Styles */
    .diagnosis-header {
        margin-bottom: 50px;
    }
    
    .section-title {
        color: #604BB0;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .section-subtitle {
        color: #666;
        font-size: 18px;
    }
    
    /* Upload Container Styles */
    .upload-container {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(96, 75, 176, 0.1);
        overflow: hidden;
    }
    
    .upload-area {
        border: 2px dashed #604BB0;
        border-radius: 20px;
        padding: 50px 20px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .upload-area:hover {
        background: rgba(96, 75, 176, 0.05);
    }
    
    .upload-area.dragover {
        background: rgba(96, 75, 176, 0.1);
        border-style: solid;
    }
    
    .upload-content i {
        font-size: 48px;
        color: #604BB0;
        margin-bottom: 20px;
    }
    
    .upload-content h3 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
    }
    
    .upload-content p {
        color: #666;
        margin-bottom: 20px;
    }
    
    .upload-btn {
        display: inline-block;
        padding: 12px 30px;
        background: #604BB0;
        color: #fff;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .upload-btn:hover {
        background: #4a3a8c;
        transform: translateY(-2px);
    }
    
    .upload-hint {
        font-size: 14px;
        color: #999;
    }
    
    /* Analysis Section Styles */
    .analysis-container {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(96, 75, 176, 0.1);
    }
    
    .analysis-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .progress-bar {
        height: 6px;
        background: #eee;
        border-radius: 3px;
        margin-top: 20px;
        overflow: hidden;
    }
    
    .progress {
        height: 100%;
        background: #604BB0;
        width: 0;
        transition: width 0.3s ease;
    }
    
    .analysis-steps {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
    }
    
    .step {
        text-align: center;
        flex: 1;
        position: relative;
        padding: 0 15px;
    }
    
    .step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 25px;
        right: 0;
        width: 100%;
        height: 2px;
        background: #eee;
        z-index: 1;
    }
    
    .step i {
        width: 50px;
        height: 50px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        color: #999;
        position: relative;
        z-index: 2;
    }
    
    .step.active i {
        background: #604BB0;
        color: #fff;
    }
    
    .step span {
        display: block;
        font-size: 14px;
        color: #666;
    }
    
    /* Results Section Styles */
    .results-container {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(96, 75, 176, 0.1);
    }
    
    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .severity-indicator {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .severity-value {
        padding: 5px 15px;
        border-radius: 15px;
        font-weight: 500;
        background: rgba(96, 75, 176, 0.1);
        color: #604BB0;
    }
    
    .diagnosis-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .diagnosis-card h4 {
        color: #666;
        margin-bottom: 10px;
    }
    
    .diagnosis-card p {
        color: #604BB0;
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .detail-item {
        text-align: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 15px;
    }
    
    .detail-item i {
        font-size: 24px;
        color: #604BB0;
        margin-bottom: 10px;
    }
    
    .detail-item h5 {
        color: #666;
        margin-bottom: 5px;
    }
    
    .detail-item p {
        color: #604BB0;
        font-weight: 600;
        margin: 0;
    }
    
    .recommendations {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .recommendations h4 {
        color: #333;
        margin-bottom: 15px;
    }
    
    .recommendations ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .recommendations li {
        color: #666;
        margin-bottom: 10px;
        padding-left: 25px;
        position: relative;
    }
    
    .recommendations li::before {
        content: '•';
        color: #604BB0;
        position: absolute;
        left: 0;
    }
    
    .disclaimer {
        background: #fff3cd;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .disclaimer i {
        color: #856404;
        font-size: 24px;
    }
    
    .disclaimer p {
        color: #856404;
        margin: 0;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    
    .btn {
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: #604BB0;
        color: #fff;
        border: none;
    }
    
    .btn-primary:hover {
        background: #4a3a8c;
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background: #f8f9fa;
        color: #604BB0;
        border: 1px solid #604BB0;
    }
    
    .btn-secondary:hover {
        background: #604BB0;
        color: #fff;
        transform: translateY(-2px);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .section-title {
            font-size: 28px;
        }
    
        .section-subtitle {
            font-size: 16px;
        }
    
        .upload-area {
            padding: 30px 15px;
        }
    
        .upload-content i {
            font-size: 36px;
        }
    
        .upload-content h3 {
            font-size: 20px;
        }
    
        .analysis-steps {
            flex-direction: column;
            gap: 20px;
        }
    
        .step:not(:last-child)::after {
            display: none;
        }
    
        .details-grid {
            grid-template-columns: 1fr;
        }
    
        .action-buttons {
            flex-direction: column;
        }
    
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Add these new styles for the authentication error */
    .auth-error-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 60vh;
        padding: 20px;
    }
    
    .auth-error-content {
        text-align: center;
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(96, 75, 176, 0.1);
        max-width: 500px;
        width: 100%;
    }
    
    .auth-error-content i {
        font-size: 48px;
        color: #604BB0;
        margin-bottom: 20px;
    }
    
    .auth-error-content h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .auth-error-content p {
        color: #666;
        margin-bottom: 30px;
    }
    
    .auth-error-content .btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 30px;
        background: #604BB0;
        color: #fff;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .auth-error-content .btn:hover {
        background: #4a3a8c;
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
    }
    
    /* Update the login button styles */
    .login-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 30px;
        background: #604BB0;
        color: #fff;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .login-btn i {
        color: #fff;
        font-size: 18px;
    }
    
    .login-btn span {
        color: #fff;
        font-weight: 500;
    }
    
    .login-btn:hover {
        background: #4a3a8c;
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
    }
    
    .login-btn:hover i,
    .login-btn:hover span {
        color: #fff;
    }

    /* Add these new styles */
    .clinical-notes {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .clinical-notes h4 {
        color: #333;
        margin-bottom: 15px;
    }

    .clinical-notes ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .clinical-notes li {
        color: #666;
        margin-bottom: 10px;
        padding-left: 25px;
        position: relative;
    }

    .clinical-notes li::before {
        content: '•';
        color: #604BB0;
        position: absolute;
        left: 0;
    }

    .conditions-list {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .conditions-list h4 {
        color: #333;
        margin-bottom: 15px;
    }

    .conditions-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .conditions-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background: white;
        border-radius: 10px;
        margin-bottom: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .conditions-list li:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .confidence-badge {
        background: rgba(96, 75, 176, 0.1);
        color: #604BB0;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Update tips and relief styles */
    .tips-and-relief {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .tips-and-relief h4 {
        color: #333;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    .tips-content {
        color: #666;
        line-height: 1.6;
    }

    .tips-content h5 {
        color: #604BB0;
        margin: 20px 0 10px;
        font-size: 1.1rem;
    }

    .tips-content ul {
        list-style: none;
        padding-left: 20px;
        margin: 10px 0;
    }

    .tips-content ul li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 8px;
    }

    .tips-content ul li::before {
        content: '•';
        color: #604BB0;
        position: absolute;
        left: 0;
    }

    .tips-content p {
        margin: 10px 0;
    }

    /* Update animation styles */
    .analysis-steps {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        position: relative;
    }

    .step {
        text-align: center;
        flex: 1;
        position: relative;
        padding: 0 15px;
        opacity: 0.5;
        transition: all 0.5s ease;
    }

    .step.active {
        opacity: 1;
        transform: translateY(-5px);
    }

    .step i {
        width: 50px;
        height: 50px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        color: #999;
        position: relative;
        z-index: 2;
        transition: all 0.5s ease;
    }

    .step.active i {
        background: #604BB0;
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(96, 75, 176, 0.3);
    }

    .step span {
        display: block;
        font-size: 14px;
        color: #666;
        transition: all 0.5s ease;
    }

    .step.active span {
        color: #604BB0;
        font-weight: 500;
    }

    .progress-bar {
        height: 6px;
        background: #eee;
        border-radius: 3px;
        margin-top: 20px;
        overflow: hidden;
        position: relative;
    }

    .progress {
        height: 100%;
        background: #604BB0;
        width: 0;
        transition: width 0.5s ease;
        position: relative;
    }

    .progress::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmer 1.5s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    </style>
    
    @if(isset($LoggedUserInfo))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const uploadContainer = document.getElementById('uploadContainer');
        const analysisSection = document.getElementById('analysisSection');
        const resultsSection = document.getElementById('resultsSection');
        const analysisProgress = document.getElementById('analysisProgress');
        const steps = document.querySelectorAll('.step');
    
        // Create form element
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("user.analyze.fundus") }}';
        form.enctype = 'multipart/form-data';
        form.style.display = 'none';
        document.body.appendChild(form);
    
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
    
        // Add file input
        const formFileInput = document.createElement('input');
        formFileInput.type = 'file';
        formFileInput.name = 'fundus_image';
        formFileInput.id = 'formFileInput';
        formFileInput.accept = 'image/*';
        form.appendChild(formFileInput);
    
        // Drag and Drop handlers
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });
    
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });
    
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length) handleFile(files[0]);
        });
    
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) handleFile(e.target.files[0]);
        });
    
        function handleFile(file) {
            if (!file.type.startsWith('image/')) {
                alert('Please upload an image file');
                return;
            }
    
            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                // Start analysis
                startAnalysis(file);
            };
            reader.readAsDataURL(file);
        }
    
        function startAnalysis(file) {
            uploadContainer.style.display = 'none';
            analysisSection.style.display = 'block';
            resultsSection.style.display = 'none';
    
            // Reset steps
            document.querySelectorAll('.step').forEach(step => step.classList.remove('active'));
            document.querySelector('.step').classList.add('active');

            // Create FormData object
            const formData = new FormData();
            formData.append('fundus_image', file);
            formData.append('_token', csrfToken.value);

            // Show loading animation
            let progress = 0;
            let currentStep = 0;
            const steps = document.querySelectorAll('.step');
            const totalSteps = steps.length;
            const stepDuration = 2000; // 2 seconds per step
    
            const progressInterval = setInterval(() => {
                progress += 1;
                if (progress > 100) {
                    clearInterval(progressInterval);
                    return;
                }
                analysisProgress.style.width = `${progress}%`;
    
                // Update steps
                if (progress % (100 / totalSteps) === 0) {
                    steps[currentStep].classList.remove('active');
                    currentStep = (currentStep + 1) % totalSteps;
                    steps[currentStep].classList.add('active');
                }
            }, 50);

            // Send AJAX request
            fetch('{{ route("user.analyze.fundus") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Analysis failed');
                }

                const results = data.data;
                
                // Helper function to safely update element content
                const updateElement = (id, content) => {
                    const element = document.getElementById(id);
                    if (element) {
                        element.textContent = content;
                    }
                };

                // Helper function to safely update list content
                const updateList = (id, items) => {
                    const list = document.getElementById(id);
                    if (list) {
                        list.innerHTML = items.map(item => `<li>${item}</li>`).join('');
                    }
                };

                // Helper function to format tips content
                const formatTipsContent = (content) => {
                    if (!content) return '';
                    
                    // Split content into sections
                    const sections = content.split('\n\n');
                    let formattedHtml = '';
                    
                    sections.forEach(section => {
                        if (section.startsWith('**')) {
                            // This is a header
                            formattedHtml += `<h5>${section.replace(/\*\*/g, '')}</h5>`;
                        } else if (section.includes('*')) {
                            // This is a list
                            const items = section.split('\n').filter(item => item.trim().startsWith('*'));
                            formattedHtml += '<ul>';
                            items.forEach(item => {
                                formattedHtml += `<li>${item.replace(/^\*\s*/, '').replace(/\*/g, '')}</li>`;
                            });
                            formattedHtml += '</ul>';
                        } else {
                            // This is regular text
                            formattedHtml += `<p>${section}</p>`;
                        }
                    });
                    
                    return formattedHtml;
                };

                // Update basic information
                updateElement('severityValue', `${(results.confidence * 100).toFixed(1)}%`);
                updateElement('detectedCondition', results.predicted_class);
                updateElement('confidenceLevel', `${(results.confidence * 100).toFixed(1)}%`);
                updateElement('analysisTime', new Date().toLocaleTimeString());
                updateElement('analysisDate', new Date().toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }));

                // Update recommendations
                updateList('recommendationsList', results.recommendations);

                // Update clinical notes
                updateList('clinicalNotesList', results.clinical_notes);

                // Update conditions list
                const conditionsList = document.getElementById('conditionsList');
                if (conditionsList) {
                    conditionsList.innerHTML = results.conditions.map(condition => `
                        <li>
                            ${condition.name}
                            <span class="confidence-badge">${(condition.confidence * 100).toFixed(1)}%</span>
                        </li>
                    `).join('');
                }

                // Update tips and relief
                const tipsAndRelief = document.getElementById('tipsAndRelief');
                if (tipsAndRelief && results.tips_and_relief) {
                    tipsAndRelief.innerHTML = formatTipsContent(results.tips_and_relief);
                }

                // Show results section
            analysisSection.style.display = 'none';
            resultsSection.style.display = 'block';

                // Clear progress interval
                clearInterval(progressInterval);
                analysisProgress.style.width = '100%';
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'An error occurred while analyzing the image. Please try again.');
                uploadContainer.style.display = 'block';
                analysisSection.style.display = 'none';
                resultsSection.style.display = 'none';
            });
        }
    
        // Download PDF handler
        document.getElementById('downloadPDF').addEventListener('click', () => {
            const resultsSection = document.getElementById('resultsSection');
            
            // Create a new window for printing
            const printWindow = window.open('', '_blank');
            
            // Get the current date and time
            const now = new Date();
            const dateStr = now.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const timeStr = now.toLocaleTimeString();

            // Create the PDF content
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Fundus Analysis Report</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                            max-width: 800px;
                            margin: 0 auto;
                            padding: 20px;
                        }
                        .header {
                            text-align: center;
                            margin-bottom: 30px;
                            border-bottom: 2px solid #604BB0;
                            padding-bottom: 20px;
                        }
                        .header h1 {
                            color: #604BB0;
                            margin: 0;
                        }
                        .header p {
                            color: #666;
                            margin: 10px 0 0;
                        }
                        .section {
                            margin-bottom: 30px;
                        }
                        .section h2 {
                            color: #604BB0;
                            border-bottom: 1px solid #eee;
                            padding-bottom: 10px;
                        }
                        .detail-grid {
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            gap: 20px;
                            margin: 20px 0;
                        }
                        .detail-item {
                            background: #f8f9fa;
                            padding: 15px;
                            border-radius: 8px;
                        }
                        .detail-item h3 {
                            margin: 0 0 10px;
                            color: #604BB0;
                            font-size: 16px;
                        }
                        .detail-item p {
                            margin: 0;
                            font-weight: bold;
                        }
                        .list {
                            list-style: none;
                            padding: 0;
                        }
                        .list li {
                            margin-bottom: 10px;
                            padding-left: 20px;
                            position: relative;
                        }
                        .list li::before {
                            content: '•';
                            color: #604BB0;
                            position: absolute;
                            left: 0;
                        }
                        .disclaimer {
                            background: #fff3cd;
                            padding: 15px;
                            border-radius: 8px;
                            margin-top: 30px;
                        }
                        .disclaimer p {
                            margin: 0;
                            color: #856404;
                        }
                        @media print {
                            body {
                                padding: 0;
                            }
                            .header {
                                margin-bottom: 20px;
                            }
                            .section {
                                page-break-inside: avoid;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>Fundus Analysis Report</h1>
                        <p>Generated on ${dateStr} at ${timeStr}</p>
                    </div>

                    <div class="section">
                        <h2>Analysis Results</h2>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <h3>Detected Condition</h3>
                                <p>${document.getElementById('detectedCondition').textContent}</p>
                            </div>
                            <div class="detail-item">
                                <h3>Confidence Level</h3>
                                <p>${document.getElementById('confidenceLevel').textContent}</p>
                            </div>
                            <div class="detail-item">
                                <h3>Analysis Date</h3>
                                <p>${document.getElementById('analysisDate').textContent}</p>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <h2>Recommendations</h2>
                        <ul class="list">
                            ${Array.from(document.getElementById('recommendationsList').children)
                                .map(li => `<li>${li.textContent}</li>`).join('')}
                        </ul>
                    </div>

                    <div class="section">
                        <h2>Clinical Notes</h2>
                        <ul class="list">
                            ${Array.from(document.getElementById('clinicalNotesList').children)
                                .map(li => `<li>${li.textContent}</li>`).join('')}
                        </ul>
                    </div>

                    <div class="section">
                        <h2>Tips & Relief Suggestions</h2>
                        <div class="tips-content">
                            ${document.getElementById('tipsAndRelief').innerHTML}
                        </div>
                    </div>

                    <div class="disclaimer">
                        <p><strong>Disclaimer:</strong> This is an AI-generated report. Please consult with a medical professional for accurate diagnosis and treatment.</p>
                    </div>
                </body>
                </html>
            `);

            // Wait for content to load
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.print();
                // Close the window after printing
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        });

        // Try Again handler
        document.getElementById('tryAgain').addEventListener('click', () => {
            // Reset the form
            document.getElementById('formFileInput').value = '';
            
            // Show upload section and hide results
            document.getElementById('uploadContainer').style.display = 'block';
            document.getElementById('resultsSection').style.display = 'none';
            
            // Reset all result fields
            document.getElementById('severityValue').textContent = 'N/A';
            document.getElementById('detectedCondition').textContent = 'N/A';
            document.getElementById('confidenceLevel').textContent = 'N/A';
            document.getElementById('analysisTime').textContent = 'N/A';
            document.getElementById('analysisDate').textContent = 'N/A';
            document.getElementById('recommendationsList').innerHTML = '';
            document.getElementById('clinicalNotesList').innerHTML = '';
            document.getElementById('conditionsList').innerHTML = '';
            document.getElementById('tipsAndRelief').innerHTML = '';
        });
    });
    </script>
@endif 

    @include('includes.section')

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
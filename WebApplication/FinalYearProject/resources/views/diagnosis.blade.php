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
                                        <span class="severity-label">Severity Level:</span>
                                        <span class="severity-value" id="severityValue">Moderate</span>
                                    </div>
                                </div>
                                
                                <div class="results-content">
                                    <div class="diagnosis-card">
                                        <h4>Detected Condition</h4>
                                        <p id="detectedCondition">Diabetic Retinopathy</p>
                                    </div>
                                    
                                    <div class="details-grid">
                                        <div class="detail-item">
                                            <i class="fas fa-percentage"></i>
                                            <h5>Confidence Level</h5>
                                            <p id="confidenceLevel">95%</p>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-clock"></i>
                                            <h5>Analysis Time</h5>
                                            <p id="analysisTime">2.5 seconds</p>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-calendar-check"></i>
                                            <h5>Date</h5>
                                            <p id="analysisDate">March 15, 2024</p>
                                        </div>
                                    </div>
    
                                    <div class="recommendations">
                                        <h4>Recommendations</h4>
                                        <ul id="recommendationsList">
                                            <li>Schedule an appointment with an ophthalmologist</li>
                                            <li>Monitor blood sugar levels regularly</li>
                                            <li>Maintain a healthy diet and exercise routine</li>
                                        </ul>
                                    </div>
    
                                    <div class="disclaimer">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <p>This is an AI-generated report. Please consult with a medical professional for accurate diagnosis and treatment.</p>
                                    </div>
    
                                    <div class="action-buttons">
                                        <button class="btn btn-primary" id="downloadPDF">
                                            <i class="fas fa-download"></i> Download PDF Report
                                        </button>
                                        <button class="btn btn-secondary" id="shareReport">
                                            <i class="fas fa-share-alt"></i> Share Report
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
        background: rgba(255, 87, 87, 0.1);
        color: #ff5757;
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
        color: #333;
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
        color: #333;
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
                // Start analysis animation
                startAnalysis();
            };
            reader.readAsDataURL(file);
        }
    
        function startAnalysis() {
            uploadContainer.style.display = 'none';
            analysisSection.style.display = 'block';
            resultsSection.style.display = 'none';
    
            let progress = 0;
            let currentStep = 0;
    
            const interval = setInterval(() => {
                progress += 1;
                analysisProgress.style.width = `${progress}%`;
    
                if (progress >= 100) {
                    clearInterval(interval);
                    showResults();
                }
    
                // Update steps
                if (progress >= 25 && currentStep === 0) {
                    steps[0].classList.remove('active');
                    steps[1].classList.add('active');
                    currentStep = 1;
                } else if (progress >= 50 && currentStep === 1) {
                    steps[1].classList.remove('active');
                    steps[2].classList.add('active');
                    currentStep = 2;
                } else if (progress >= 75 && currentStep === 2) {
                    steps[2].classList.remove('active');
                    steps[3].classList.add('active');
                    currentStep = 3;
                }
            }, 50);
        }
    
        function showResults() {
            analysisSection.style.display = 'none';
            resultsSection.style.display = 'block';
        }
    
        // Download PDF handler
        document.getElementById('downloadPDF').addEventListener('click', () => {
            // Implement PDF generation and download
            alert('PDF report will be downloaded');
        });
    
        // Share Report handler
        document.getElementById('shareReport').addEventListener('click', () => {
            // Implement sharing functionality
            alert('Share functionality will be implemented');
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
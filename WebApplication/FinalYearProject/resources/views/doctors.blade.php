<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="#">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Fundus Disease Analysis - Find Doctors</title>

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

    <section class="dropdown-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
                        <span class="inflanar-section__badge inflanar-primary-color m-0 aos-init aos-animate" data-aos="fade-in" data-aos-delay="300">
                            <span>Find Your Specialist</span>
                        </span>
                        <h2 class="inflanar-section__title aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">
                            Connect with Expert Ophthalmologists
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <form class="d-flex flex-wrap" action="{{ route('doctors') }}" method="GET" style="width: 100%;">
                    <div class="col-12 col-md-3 mb-3">
                        <label for="day" class="form-label">Day</label>
                        <select name="day" class="form-select" id="day">
                            <option value="">Select Day</option>
                            <option value="Monday" {{ request('day') == 'Monday' ? 'selected' : '' }}>Monday</option>
                            <option value="Tuesday" {{ request('day') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                            <option value="Wednesday" {{ request('day') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                            <option value="Thursday" {{ request('day') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                            <option value="Friday" {{ request('day') == 'Friday' ? 'selected' : '' }}>Friday</option>
                            <option value="Saturday" {{ request('day') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                            <option value="Sunday" {{ request('day') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-3 mb-3">
                        <label for="time" class="form-label">Time</label>
                        <select name="time" class="form-select" id="time">
                            <option value="">Select Time</option>
                            <option value="Morning" {{ request('time') == 'Morning' ? 'selected' : '' }}>Morning (9:00 AM - 12:00 PM)</option>
                            <option value="Afternoon" {{ request('time') == 'Afternoon' ? 'selected' : '' }}>Afternoon (1:00 PM - 5:00 PM)</option>
                            <option value="Evening" {{ request('time') == 'Evening' ? 'selected' : '' }}>Evening (6:00 PM - 9:00 PM)</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-3 mb-3">
                        <label for="sub_specialization" class="form-label">Sub-Specialization</label>
                        <select name="sub_specialization" class="form-select" id="sub_specialization">
                            <option value="">Select Sub-Specialization</option>
                            @foreach($subSpecializations as $subSpecialization)
                                <option value="{{ $subSpecialization }}" {{ request('sub_specialization') == $subSpecialization ? 'selected' : '' }}>
                                    {{ $subSpecialization }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3 mb-3 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <button type="submit" class="btn btn-lg flex-grow-1" style="background-color: #604BB0; border: none; color: white;">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <a href="{{ route('doctors') }}" class="btn btn-lg flex-grow-1" style="background-color: #dc3545; border: none; color: white;">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <br>
    <section class="inflanar-section-shape inflanar-bg-cover pd-top-120 pd-btm-120">
        <div class="container">
            <div class="row">
                @foreach($doctors as $doctor)
                <div class="col-lg-4 col-md-6 col-12 mg-top-30 aos-init aos-animate" data-aos="fade-in" data-aos-delay="400">
                    <div class="inflanar-service">
                        <div class="inflanar-service__head1">
                            <img src="{{ asset('storage/' . ($doctor->profile_image ?? 'default-doctor.jpg')) }}" 
                                 alt="{{ $doctor->name }}" 
                                 class="doctor-image">
                        </div>

                        <div class="inflanar-service__body">
                            <div class="inflanar-service__top1">
                                <div class="instagram-butt">
                                    <i class="fas fa-stethoscope me-2"></i>
                                    {{ $doctor->specialization }}
                                </div>
                            </div>
                            <h3 class="inflanar-service__title1">
                                <a href="{{ route('doctor.public.profile', ['id' => $doctor->id]) }}">{{ $doctor->name }}</a>
                            </h3>
                            <div class="inflanar-service__author">
                                <div class="inflanar-service__author--info">
                                    <p><i class="fas fa-graduation-cap"></i> {{ $doctor->qualifications }}</p>
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $doctor->clinic_address }}</p>
                                    <p><i class="fas fa-phone"></i> {{ $doctor->contact_number }}</p>
                                    <p><i class="fas fa-money-bill-wave"></i> Consultation Fee: ${{ number_format($doctor->consultation_fee, 0) }}</p>
                                </div>
                            </div>
                            <div class="availability-section">
                                <h5><i class="fas fa-calendar-alt me-2"></i> Availability</h5>
                                <div class="row">
                                    @php
                                        $availability = json_decode($doctor->availability, true);
                                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                    @endphp
                                    @foreach($days as $day)
                                        @if($availability[$day]['enabled'])
                                            <div class="col-12 mb-2">
                                                <div class="availability-day">
                                                    <strong>{{ ucfirst($day) }}:</strong>
                                                    {{ date('h:i A', strtotime($availability[$day]['start'])) }} - 
                                                    {{ date('h:i A', strtotime($availability[$day]['end'])) }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('doctor.public.profile', ['id' => $doctor->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-calendar-check me-2"></i> Book Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <br><br>
            <div class="row">
                <div class="col-12 text-center">
                    {{ $doctors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    @include('includes.section')
    @include('includes.footer')

    <a href="#" class="scrollToTop"><img src="img/output-onlinepngtools (32).png"></a>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/aos.min.js"></script>
    
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/aos.min.js"></script>
    <script src="../js/ckeditor.min.js"></script>
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/select2-min.js"></script>
    <script src="../js/video-popup.min.js"></script>
    <script src="../js/swiper-slider.min.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/jquery.counterup.min.js"></script>
    <script src="../js/active.js"></script>
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/aos.min.js"></script>
    <script src="../js/ckeditor.min.js"></script>
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/select2-min.js"></script>
    <script src="../js/video-popup.min.js"></script>
    <script src="../js/swiper-slider.min.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/jquery.counterup.min.js"></script>
    <script src="../js/active.js"></script>
</body>
</html>

<style>
    .inflanar-service {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .inflanar-service:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .inflanar-service__head1 {
        height: 200px;
        overflow: hidden;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .inflanar-service__head1 img {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .inflanar-service:hover .inflanar-service__head1 img {
        transform: scale(1.05);
    }

    .inflanar-service__body {
        padding: 15px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .inflanar-service__top1 {
        margin-bottom: 10px;
    }

    .instagram-butt {
        display: inline-block;
        padding: 6px 12px;
        background: #604BB0;
        color: white;
        border-radius: 15px;
        font-size: 13px;
        font-weight: 500;
    }

    .inflanar-service__title1 {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .inflanar-service__author {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 12px;
    }

    .inflanar-service__author--info p {
        margin-bottom: 6px;
        color: #666;
        font-size: 13px;
    }

    .inflanar-service__author--info i {
        color: #604BB0;
        margin-right: 6px;
        width: 14px;
        font-size: 13px;
    }

    .availability-section {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        margin-top: 12px;
        flex: 1;
    }

    .availability-section h5 {
        color: #604BB0;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .availability-day {
        background: white;
        padding: 6px 10px;
        border-radius: 6px;
        margin-bottom: 6px;
        font-size: 13px;
    }

    .availability-day strong {
        color: #604BB0;
        font-weight: 600;
    }

    .btn-primary {
        background: #604BB0;
        border: none;
        padding: 8px 20px;
        border-radius: 15px;
        font-weight: 500;
        font-size: 13px;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background: #4a3a8c;
        transform: translateY(-2px);
    }

    .col-lg-4 {
        margin-bottom: 20px;
    }

    .dropdown-section {
        background: #f8f9fa;
        padding: 50px 0;
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .form-control, .form-select {
        border-radius: 15px;
        padding: 12px 20px;
        border: 1px solid #ddd;
        font-size: 15px;
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
        border-color: #604BB0;
        box-shadow: 0 0 0 0.2rem rgba(96, 75, 176, 0.25);
    }

    .inflanar-section__badge {
        background: #604BB0;
        color: white;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 20px;
    }

    .inflanar-section__title {
        font-size: 36px;
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
    }

    .search-btn {
        background: #604BB0;
        color: white;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: #4a3a8c;
        transform: translateY(-3px);
    }

    .reset-btn {
        background: #dc3545;
        color: white;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .reset-btn:hover {
        background: #c82333;
        transform: translateY(-3px);
    }

    /* Add these new styles to ensure consistent input widths */
    .col-12.col-md-4 {
        padding-right: 15px;
        padding-left: 15px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }
</style> 
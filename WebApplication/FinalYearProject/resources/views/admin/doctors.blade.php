<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Admin Dashboard">
    <title>Doctors Management</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/downloads/appicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../AdminTemplate/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link href="../AdminTemplate/css/style.css" rel="stylesheet">
</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        @include('admin/includes/header')
        @include('admin/includes/navbar')
        @include('admin/includes/sidebar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="form-head d-flex flex-wrap align-items-center">
                    <h2 class="font-w600 title mr-auto">Doctors Management</h2>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Doctor</th>
                                                <th>Specialization</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($doctors as $doctor)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/doctor-avatar.png') }}" 
                                                             alt="Doctor" class="rounded-circle mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0">{{ $doctor->name }}</h6>
                                                            <small class="text-muted">{{ $doctor->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $doctor->specialization }}</span>
                                                    @if($doctor->sub_specialization)
                                                    <span class="badge badge-info">{{ $doctor->sub_specialization }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($doctor->status === 'active')
                                                    <span class="badge badge-success">Active</span>
                                                    @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button type="button" class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#viewModal{{ $doctor->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        @if($doctor->status === 'active')
                                                        <form action="{{ route('admin.doctor.deactivate', $doctor->id) }}" method="POST" class="mr-2">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-ban"></i>
                                                            </button>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('admin.doctor.activate', $doctor->id) }}" method="POST" class="mr-2">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModal{{ $doctor->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Doctor Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-4 text-center mb-4">
                                                                    <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('img/doctor-avatar.png') }}" 
                                                                         alt="Doctor" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                                                    <h5>{{ $doctor->name }}</h5>
                                                                    <p class="text-muted">{{ $doctor->email }}</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <strong>Specialization:</strong>
                                                                            <p>{{ $doctor->specialization }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <strong>Sub-specialization:</strong>
                                                                            <p>{{ $doctor->sub_specialization ?? 'N/A' }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <strong>Experience:</strong>
                                                                            <p>{{ $doctor->experience_years }} Years</p>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <strong>Consultation Fee:</strong>
                                                                            <p>${{ $doctor->consultation_fee }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <strong>Contact:</strong>
                                                                            <p>{{ $doctor->contact_number }}</p>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <strong>Status:</strong>
                                                                            <p>
                                                                                @if($doctor->status === 'active')
                                                                                <span class="badge badge-success">Active</span>
                                                                                @else
                                                                                <span class="badge badge-danger">Inactive</span>
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-12 mb-3">
                                                                            <strong>Qualifications:</strong>
                                                                            <p>{{ $doctor->qualifications }}</p>
                                                                        </div>
                                                                        <div class="col-12 mb-3">
                                                                            <strong>Clinic Address:</strong>
                                                                            <p>{{ $doctor->clinic_address }}</p>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <strong>Bio:</strong>
                                                                            <p>{{ $doctor->bio }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>   
                                <div class="mt-4">
                                    {{ $doctors->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin/includes/footer')
    </div>

    <script src="../AdminTemplate/vendor/global/global.min.js"></script>
    <script src="../AdminTemplate/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../AdminTemplate/js/custom.min.js"></script>
    <script src="../AdminTemplate/js/deznav-init.js"></script>
</body>
</html> 
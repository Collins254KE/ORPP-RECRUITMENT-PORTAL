@extends('layout.main')
@section('content')
    <div class="container">
        <h1>Welcome to Your Dashboard</h1>
        <p>Hello, {{ Auth::user()->name }}! Here you can manage your profile, view job applications, and more.</p>
        
        @if(!auth()->user()->is_staff)
            @if(!auth()->user()->isProfileComplete())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h5 class="alert-heading">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Complete Your Profile
                            </h5>
                            <p class="mb-2">Your profile is incomplete. Please complete all required information to apply for jobs.</p>
                            
                            <!-- Progress Bar -->
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar bg-warning" role="progressbar" 
                                     style="width: {{ auth()->user()->profileCompleteness() }}%"
                                     aria-valuenow="{{ auth()->user()->profileCompleteness() }}" 
                                     aria-valuemin="0" aria-valuemax="100">
                                    {{ auth()->user()->profileCompleteness() }}% Complete
                                </div>
                            </div>
                            
                            <!-- Missing Items -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">Missing Information:</h6>
                                    <ul class="list-unstyled small">
                                        @if(empty(auth()->user()->name))
                                            <li><i class="fas fa-times text-danger me-1"></i>Full Name</li>
                                        @endif
                                        @if(empty(auth()->user()->dob))
                                            <li><i class="fas fa-times text-danger me-1"></i>Date of Birth</li>
                                        @endif
                                        @if(empty(auth()->user()->phone))
                                            <li><i class="fas fa-times text-danger me-1"></i>Phone Number</li>
                                        @endif
                                        @if(empty(auth()->user()->county))
                                            <li><i class="fas fa-times text-danger me-1"></i>County</li>
                                        @endif
                                        @if(empty(auth()->user()->sub_county))
                                            <li><i class="fas fa-times text-danger me-1"></i>Sub County</li>
                                        @endif
                                        @if(empty(auth()->user()->id_passport))
                                            <li><i class="fas fa-times text-danger me-1"></i>ID/Passport Number</li>
                                        @endif
                                        @if(empty(auth()->user()->kra_pin))
                                            <li><i class="fas fa-times text-danger me-1"></i>KRA PIN</li>
                                        @endif
                                        @if(empty(auth()->user()->disability_status))
                                            <li><i class="fas fa-times text-danger me-1"></i>Disability Status</li>
                                        @endif
                                        @if(auth()->user()->disability_status === 'yes' && empty(auth()->user()->disability_certificate_number))
                                            <li><i class="fas fa-times text-danger me-1"></i>Disability Certificate Number</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">Missing Records:</h6>
                                    <ul class="list-unstyled small">
                                        @if(auth()->user()->academicRecords->isEmpty())
                                            <li><i class="fas fa-times text-danger me-1"></i>Academic Records</li>
                                        @endif
                                        @if(auth()->user()->professionalQualifications->isEmpty())
                                            <li><i class="fas fa-times text-danger me-1"></i>Professional Qualifications</li>
                                        @endif
                                        @if(auth()->user()->employmentHistory->isEmpty())
                                            <li><i class="fas fa-times text-danger me-1"></i>Employment History</li>
                                        @endif
                                        @if(auth()->user()->referees->isEmpty())
                                            <li><i class="fas fa-times text-danger me-1"></i>Referees</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            
                            <a href="/profile" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Complete Profile Now
                            </a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @else
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Great!</strong> Your profile is complete and you can apply for jobs.
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        @endif
        
        @if(auth()->user()->is_staff)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Job Vacancies</h5>
                        <p class="card-text">Check the status of job applications.</p>
                        <a href="admin/job-listings" class="btn btn-primary">View Jobs</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile</h5>
                            <p class="card-text">View and edit your profile information.</p>
                            <a href="/profile" class="btn btn-primary">Go to Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Job Applications</h5>
                            <p class="card-text">Check the status of your job applications.</p>
                            <a href="/applications" class="btn btn-primary">View Applications</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">My Applications</h5>
                            <p class="card-text">See the jobs you have applied for.</p>
                            <a href="/my-applications" class="btn btn-primary">View My Applications</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
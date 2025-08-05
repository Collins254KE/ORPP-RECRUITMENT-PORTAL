@extends('layout.main')

@section('content')
    <div class="container small" style="font-size: 0.875rem;">
        <h1>Available Job Listings</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (!auth()->user()->is_staff)
            @if (!auth()->user()->isProfileComplete())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h5 class="alert-heading">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Complete Your Profile
                            </h5>
                            <p class="mb-2">Your profile is incomplete. Please complete all required information to apply
                                for jobs.</p>

                            <!-- Progress Bar -->
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ auth()->user()->profileCompleteness() }}%"
                                    aria-valuenow="{{ auth()->user()->profileCompleteness() }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ auth()->user()->profileCompleteness() }}% Complete
                                </div>
                            </div>

                            <!-- Missing Items -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">Missing Information:</h6>
                                    <ul class="list-unstyled small">
                                        @if (empty(auth()->user()->name))
                                            <li><i class="fas fa-times text-danger me-1"></i>Full Name</li>
                                        @endif
                                        @if (empty(auth()->user()->dob))
                                            <li><i class="fas fa-times text-danger me-1"></i>Date of Birth</li>
                                        @endif
                                        @if (empty(auth()->user()->phone))
                                            <li><i class="fas fa-times text-danger me-1"></i>Phone Number</li>
                                        @endif
                                        @if (empty(auth()->user()->county))
                                            <li><i class="fas fa-times text-danger me-1"></i>County</li>
                                        @endif
                                        @if (empty(auth()->user()->sub_county))
                                            <li><i class="fas fa-times text-danger me-1"></i>Sub County</li>
                                        @endif
                                        @if (empty(auth()->user()->id_passport))
                                            <li><i class="fas fa-times text-danger me-1"></i>ID/Passport Number</li>
                                        @endif
                                        @if (empty(auth()->user()->kra_pin))
                                            <li><i class="fas fa-times text-danger me-1"></i>KRA PIN</li>
                                        @endif
                                        @if (empty(auth()->user()->disability_status))
                                            <li><i class="fas fa-times text-danger me-1"></i>Disability Status</li>
                                        @endif
                                        @if (auth()->user()->disability_status === 'yes' && empty(auth()->user()->disability_certificate_number))
                                            <li><i class="fas fa-times text-danger me-1"></i>Disability Certificate Number
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">Missing Records:</h6>
                                    <ul class="list-unstyled small">
                                        @if (auth()->user()->academicRecords->isEmpty())
                                            <li><i class="fas fa-times text-danger me-1"></i>Academic Records</li>
                                        @endif
                                        @if (auth()->user()->professionalQualifications->isEmpty())
                                            <li><i class="fas fa-times text-danger me-1"></i>Professional Qualifications
                                            </li>
                                        @endif
                                        @if (auth()->user()->employmentHistory->isEmpty())
                                            <li><i class="fas fa-times text-danger me-1"></i>Employment History</li>
                                        @endif
                                        @if (auth()->user()->referees->isEmpty())
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
        @if ($jobListings->count())
           <table class="table table-bordered border-dark">
    <thead style="background-color: #0033; color: white;" class="text-center">
        <tr>
            <th style="background-color: #0033;">Title</th>
            <th style="background-color: #0033;">Posts</th>
            <th style="background-color: #0033;">Job Description</th>
            <th style="background-color: #0033;">Location</th>
            <th style="background-color: #0033;">Status</th>
            <th style="background-color: #0033;">Actions</th>
        </tr>
    </thead>


                <tbody>
                    @foreach ($jobListings as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->posts ?? 'N/A' }}</td>
                            <td>
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                    data-bs-target="#jobModal{{ $job->id }}">
                                    View Job Description
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="jobModal{{ $job->id }}" tabindex="-1"
                                    aria-labelledby="jobModalLabel{{ $job->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <div>
                                                    <h5 class="modal-title mb-0" id="jobModalLabel{{ $job->id }}">
                                                        <strong>{{ $job->title }}</strong>
                                                    </h5>
                                                    <small>REF NO: <span
                                                            class="text-warning fw-bold">{{ $job->code }}</span></small>
                                                </div>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="card border-primary">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0"><i
                                                                        class="fas fa-map-marker-alt text-primary"></i>
                                                                    Location</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="mb-0">{{ $job->location }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card border-warning">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0"><i
                                                                        class="fas fa-calendar-alt text-warning"></i>
                                                                    Application Deadline</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="mb-0">
                                                                    {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'Not specified' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($job->duties_and_responsibilities)
                                                    <div class="card mb-3 border-info">
                                                        <div class="card-header bg-info text-white">
                                                            <h6 class="mb-0"><i class="fas fa-tasks"></i> Duties and
                                                                Responsibilities</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            {!! nl2br(e($job->duties_and_responsibilities)) !!}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (
                                                    $job->requirements ||
                                                        $job->min_experience ||
                                                        $job->min_qualification ||
                                                        $job->min_level ||
                                                        $job->min_years_of_experience)
                                                    <div class="table-responsive mb-3">

                                                        <table class="table table-bordered border-success">
                                                            <thead>
                                                                <tr class="bg-info text-white">
                                                                    <th colspan="2">
                                                                        <i class="fas fa-graduation-cap me-1"></i>
                                                                        Requirements
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                {{-- Minimum Qualification --}}
                                                                @if ($job->min_qualification)
                                                                    <tr>
                                                                        <th style="width: 35%;">Minimum Qualification</th>
                                                                        <td>{{ $job->min_qualification }}</td>
                                                                    </tr>
                                                                @endif

                                                                {{-- Minimum Years of Experience --}}
                                                                @if ($job->min_experience)
                                                                    <tr>
                                                                        <th>Minimum Years of Experience</th>
                                                                        <td>{{ $job->min_experience }}
                                                                            year{{ $job->min_experience > 1 ? 's' : '' }}
                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                {{-- Requirements --}}
                                                                @if ($job->requirements)
                                                                    <tr>
                                                                        <th>Requirements</th>
                                                                        <td>{!! nl2br(e($job->requirements)) !!}</td>
                                                                    </tr>
                                                                @endif

                                                                {{-- Minimum Qualification Level (with badge) --}}
                                                                @if ($job->min_level)
                                                                    <tr>
                                                                        <th>Minimum Qualification Level</th>
                                                                        <td>
                                                                            <span class="badge bg-warning text-dark">
                                                                                @switch($job->min_level)
                                                                                    @case(1)
                                                                                        Certificate
                                                                                    @break

                                                                                    @case(2)
                                                                                        Diploma
                                                                                    @break

                                                                                    @case(3)
                                                                                        Degree
                                                                                    @break

                                                                                    @case(4)
                                                                                        Masters
                                                                                    @break

                                                                                    @case(5)
                                                                                        PhD
                                                                                    @break

                                                                                    @default
                                                                                        Unknown
                                                                                @endswitch
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                {{-- Min Years of Experience (with badge) --}}
                                                                @if ($job->min_years_of_experience)
                                                                    <tr>
                                                                        <th>Min Years of Experience</th>
                                                                        <td>
                                                                            <span class="badge bg-info text-dark">
                                                                                {{ $job->min_years_of_experience }}
                                                                                year{{ $job->min_years_of_experience > 1 ? 's' : '' }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif




                                                <div class="modal-footer small">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    @if (!in_array($job->id, $userApplications))
                                                        @php
                                                            $requirements = auth()->user()->meetsJobRequirements($job);
                                                        @endphp

                                                        @if ($requirements['eligible'])
@php
    $isExpired = $job->deadline && \Carbon\Carbon::parse($job->deadline)->isPast();
@endphp

@if ($isExpired)
    <div class="alert alert-danger mb-2">
        <i class="fas fa-exclamation-circle me-1"></i>
        This job is no longer open for application.
    </div>

    <a href="javascript:void(0);"
       class="btn btn-danger btn-sm"
       onclick="alert('Application closed for this job.')">
        <i class="fas fa-times-circle me-1"></i> Apply Now
    </a>
@else
    <a href="{{ route('applications.apply', $job->id) }}"
       class="btn btn-primary btn-sm">
        <i class="fas fa-paper-plane me-1"></i> Apply Now
    </a>
@endif


                                                        @else
                                                            <div class="text-center text-muted small">
                                                                <i class="fas fa-ban text-danger mb-1"
                                                                    style="font-size: 1em;"></i>
                                                                <div class="small">
                                                                    @foreach ($requirements['reasons'] as $reason)
                                                                        <div>{{ $reason }}</div>
                                                                    @endforeach
                                                                </div>
                                                                @if (in_array('Profile is incomplete', $requirements['reasons']))
                                                                    <a href="/profile"
                                                                        class="btn btn-warning btn-sm mt-1">
                                                                        <i class="fas fa-edit me-1"></i>Complete Profile
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('applications.show', $job->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye me-1"></i>View Application
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                            </td>
                            <td>{{ $job->location }}</td>
                            <td>
                                @if (in_array($job->id, $userApplications))
                                    <span class="badge bg-success">Applied</span>
                                @else
                                    <span class="badge bg-secondary">Not Applied</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $requirements = auth()->user()->meetsJobRequirements($job);
                                @endphp

                                @if (!in_array($job->id, $userApplications))
                                    @if ($requirements['eligible'])
                                        <a href="{{ route('applications.apply', $job->id) }}" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-1"></i>Apply
                                        </a>
                                    @else
                                        <div class="text-center">
                                            <i class="fas fa-ban text-danger mb-1" style="font-size: 1.2em;"></i>
                                            <div class="small text-muted">
                                                @foreach ($requirements['reasons'] as $reason)
                                                    <div>{{ $reason }}</div>
                                                @endforeach
                                            </div>
                                            @if (in_array('Profile is incomplete', $requirements['reasons']))
                                                <a href="/profile" class="btn btn-warning btn-sm mt-1">
                                                    <i class="fas fa-edit me-1"></i>Complete Profile
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    <a href="{{ route('applications.show', $job->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye me-1"></i>View Application
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No job listings available.</p>
        @endif
    </div>
@endsection

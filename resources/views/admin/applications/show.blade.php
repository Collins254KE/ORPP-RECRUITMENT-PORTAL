@extends('layout.main')

@section('content')
<h1>Application Details</h1>
<h2>Job Title: {{ optional($application->jobListing)->title ?: 'N/A' }}</h2>


<h3>Applicant: {{ $application->user->name }}</h3>
@if(auth()->user()->is_staff)
<p>
<form action="{{ route('admin.applications.update', $application->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('PUT')
    Status:
    <select name="status" onchange="this.form.submit()">
        <option value="Processing" {{ $application->status == 'Processing' ? 'selected' : '' }}>Processing</option>
        <option value="Interviews" {{ $application->status == 'Interviews' ? 'selected' : '' }}>Interviews</option>
        <option value="Shortlisted" {{ $application->status == 'Shortlisted' ? 'selected' : '' }}>Shortlisted</option>
        <option value="Closed" {{ $application->status == 'Closed' ? 'selected' : '' }}>Closed</option>
    </select>
</form>
</p>
<p>Updated By: {{ optional($application->updatedBy)->name ?? 'N/A' }}</p>
@endif

<p>Application Date: {{ $application->created_at->format('Y-m-d H:i') }}</p>
<h6>Candidate Profile</h6>
<div class="card mb-4">
    <div class="card-body">
        <p><strong>Name:</strong> {{ $application->user->name }}</p>
        <p><strong>Title:</strong> {{ $application->user->title }}</p>
        <p><strong>Email:</strong> {{ $application->user->email }}</p>
        <p><strong>Phone:</strong> {{ $application->user->phone }}</p>
        <p><strong>ID/Passport:</strong> {{ $application->user->id_passport }}</p>
        <p><strong>KRA PIN:</strong> {{ $application->user->kra_pin }}</p>
        <p><strong>County:</strong> {{ $application->user->county }}</p>
        <p><strong>Sub-County:</strong> {{ $application->user->sub_county }}</p>
        <p><strong>Ethnicity:</strong> {{ $application->user->ethnicity }}</p>
        <p><strong>Gender:</strong> {{ $application->user->gender}}</p>
        <p><strong>Nationality:</strong> {{ $application->user->nationality }}</p>
        <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($application->user->dob)->format('F d, Y') }}</p>

    </div>
</div>
<!-- add profile academic information -->
<h6>Academic Qualifications</h6>
<div class="card mb-4">
    <div class="card-body">
        @if($application->user->academicRecords->isEmpty())
        <p>No academic records found.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Qualification </th>
                    <th>Course Name</th>
                    <th>Graduation Date</th>
                    <th>Institution Name</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($application->user->academicRecords as $record)
                <tr>
                    <td>{{ $record->qualification_code }}</td>
                    <td>{{ $record->qualification_name }}</td>
                    <td>
                        {{ $record->graduation_date ? \Carbon\Carbon::parse($record->graduation_date)->format('d M Y') : 'N/A' }}
                    </td>

                    <td>{{ $record->institution_name }}</td>
                    <td><a href="{{ route('files.academic_record.view', $record->id) }}" target="_blank">View Document</a></td>
                    <td>
                        <a href="{{ route('academic_records.edit', $record->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('academic_records.destroy', $record->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
<!-- add profile work experience information -->
<h6>Employment History</h6>
<div class="card mb-4">
    <div class="card-body">

        @if($application->user->employmentHistory->isEmpty())
        <p>No employment history found.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Employer Name</th>
                    <th>Job Position</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Roles & Responsibilities</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($application->user->employmentHistory as $history)
                <tr>
                    <td>{{ $history->employer_name }}</td>
                    <td>{{ $history->job_position }}</td>
                    <td>{{ $history->date_joined ? \Carbon\Carbon::parse($history->date_joined)->format('d M Y') : 'N/A' }}</td>
                    <td>{{ $history->date_left ? \Carbon\Carbon::parse($history->date_left)->format('d M Y') : 'Current' }}</td>
                    <td>{{ strip_tags($history->roles_responsibilities) }}</td>

                    <td>
                        <a href="{{ route('employment_history.edit', $history->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('employment_history.destroy', $history->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
<!-- memberships -->
<h6>Professional Memberships</h6>
<div class="card mb-4">
    <div class="card-body">
        @if($application->user->professionalMemberships->isEmpty())
        <p>No professional membership found.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @foreach($application->user->professionalMemberships as $membership)
                <tr>
                    <td>{{ $membership->description ?? 'N/A' }}</td>
                    <td>
                        @if ($membership->file_path)
                        <a href="{{ route('files.professional_membership.view', $membership->id) }}" target="_blank">View Document</a>
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
<!-- qualifications -->
<h6>Professional Qualifications</h6>
<div class="card mb-4">
    <div class="card-body">

        @if($application->user->professionalQualifications->isEmpty())
        <p>No professional qualifications found.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Description</th>
                    <th>File</th>
                </tr>
            </thead>
            


            <tbody>
                @foreach($application->user->professionalQualifications as $qualification)
                <tr>
                    <td>{{ $qualification->level }}</td>
                    <td>{{ $qualification->description }}</td>
                    <td>
                        <a href="{{ route('files.professional_qualification.view', $qualification->id) }}" target="_blank">View Document</a>
                    </td>

                </tr>
                @endforeach
            </tbody>


        </table>
        @endif
    </div>
</div>
<!-- add profile referees information -->
<h6>Referees</h6>
<div class="card mb-4">
    <div class="card-body">
        @if($application->user->referees->isEmpty())
        <p>No referees found.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Other Name</th>
                    <th>Organization</th>
                    <th>Designation</th>
                    <th>Referee Type</th>
                    <th>Email</th>
                    <th>Mobile Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($application->user->referees as $referee)
                <tr>
                    <td>{{ $referee->first_name }}</td>
                    <td>{{ $referee->middle_name }}</td>
                    <td>{{ $referee->other_name }}</td>
                    <td>{{ $referee->organization }}</td>
                    <td>{{ $referee->designation }}</td>
                    <td>{{ ucfirst($referee->referee_type) }}</td>
                    <td>{{ $referee->professional_referee_email }}</td>
                    <td>{{ $referee->mobile_phone }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@if(auth()->user()->is_staff)
<a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">Back to Applications</a>
@else
<a href="{{ route('user.applications') }}" class="btn btn-secondary">Back to Applications</a>
@endif

@endsection
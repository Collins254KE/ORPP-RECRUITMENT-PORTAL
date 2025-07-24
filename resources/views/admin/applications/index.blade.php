@extends('layout.main')

@section('content')
    <h1>Applications</h1>



    <form action="{{ route('admin.applicants.filter') }}" method="GET" style="margin-bottom: 1rem;">
        <label for="min_qualification">Minimum Qualification:</label>
        <select name="min_qualification" id="min_qualification">
            <option value="" {{ request('min_qualification') == '' ? 'selected' : '' }}>Any</option>
            <option value="Certificate" {{ request('min_qualification') == 'Certificate' ? 'selected' : '' }}>Certificate</option>
            <option value="Diploma" {{ request('min_qualification') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
            <option value="Degree" {{ request('min_qualification') == 'Degree' ? 'selected' : '' }}>Degree</option>
            <option value="Master" {{ request('min_qualification') == 'Master' ? 'selected' : '' }}>Master</option>
            <option value="PhD" {{ request('min_qualification') == 'PhD' ? 'selected' : '' }}>PhD</option>
        </select>

        <label for="min_experience_years">Minimum Years of Experience:</label>
        <input
            type="number"
            name="min_experience_years"
            id="min_experience_years"
            min="0"
            step="1"
            value="{{ request('min_experience_years') }}"
        />

        <button type="submit">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Applicant</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>{{ $application->jobListing->title ?? 'N/A' }}
</td>
                    
                    <td>{{ $application->user->name }}</td>
                    <td>{{ $application->status }}</td>
                    <td>
                        <a href="{{ route('admin.applications.show', $application->id) }}" class="btn btn-info">View</a>

                        <form action="{{ route('admin.applications.update', $application->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                <option value="Processing" {{ $application->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Interviews" {{ $application->status == 'Interviews' ? 'selected' : '' }}>Interviews</option>
                                <option value="Shortlisted" {{ $application->status == 'Shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="Closed" {{ $application->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

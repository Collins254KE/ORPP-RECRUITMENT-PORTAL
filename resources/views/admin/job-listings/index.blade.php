@extends('layout.main')

@section('content')
    <h1 class="mb-4">Job Listings</h1>

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filter Job Listings</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.job-listings.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="min_level" class="form-label">Minimum Qualification Level</label>
                    <select name="min_level" id="min_level" class="form-select">
                        <option value="">All Levels</option>
                        <option value="1" {{ $filters['min_level'] == '1' ? 'selected' : '' }}>Certificate</option>
                        <option value="2" {{ $filters['min_level'] == '2' ? 'selected' : '' }}>Diploma</option>
                        <option value="3" {{ $filters['min_level'] == '3' ? 'selected' : '' }}>Degree</option>
                        <option value="4" {{ $filters['min_level'] == '4' ? 'selected' : '' }}>Master</option>
                        <option value="5" {{ $filters['min_level'] == '5' ? 'selected' : '' }}>PhD</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="min_years_of_experience" class="form-label">Min Years Experience</label>
                    <input type="number" name="min_years_of_experience" id="min_years_of_experience" 
                           class="form-control" min="0" max="50" 
                           value="{{ $filters['min_years_of_experience'] ?? '' }}" 
                           placeholder="Any">
                </div>
                <div class="col-md-3">
                    <label for="is_published" class="form-label">Published Status</label>
                    <select name="is_published" id="is_published" class="form-select">
                        <option value="">All</option>
                        <option value="1" {{ $filters['is_published'] == '1' ? 'selected' : '' }}>Published</option>
                        <option value="0" {{ $filters['is_published'] == '0' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.job-listings.index') }}" class="btn btn-secondary">Clear</a>
                    <a href="{{ route('admin.applications.analytics') }}" class="btn btn-info">Report</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Add New Button -->
    <div class="mb-3">
        <a href="{{ route('admin.job-listings.create') }}" class="btn btn-success">+ Add New Job Listing</a>
    </div>

    <!-- Job Listings Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
           <thead class="text-white text-center">
    <tr class="bg-primary">
        <th class="bg-primary">Title</th>
        <th class="bg-primary">Location</th>
        <th class="bg-primary">Deadline</th>
        <th class="bg-primary">Posts</th>
        <th class="bg-primary">Min Level</th>
        <th class="bg-primary">Min Experience</th>
        <th class="bg-primary">Applicants</th>
        <th class="bg-primary">Published</th>
        <th class="bg-primary">Actions</th>
    </tr>
</thead>

            <tbody>
                @foreach($jobListings as $jobListing)
                    <tr>
                        <td>{{ $jobListing->title }}</td>
                        <td>{{ $jobListing->location }}</td>
<td>
    {{ \Carbon\Carbon::parse($jobListing->deadline)->format('Y-m-d') }}
    @if(\Carbon\Carbon::parse($jobListing->deadline)->isPast())
        <span class="badge bg-danger ms-1">Expired</span>
    @else
        <span class="badge bg-success ms-1">Active</span>
    @endif
</td>
                        <td>{{ $jobListing->posts ?? '—' }}</td>
                        <td>
                            @if($jobListing->min_level)
                                @switch($jobListing->min_level)
                                    @case(1) Certificate @break
                                    @case(2) Diploma @break
                                    @case(3) Degree @break
                                    @case(4) Master @break
                                    @case(5) PhD @break
                                    @default Unknown
                                @endswitch
                            @else
                                <span class="text-muted">Any</span>
                            @endif
                        </td>
                        <td>
                            @if($jobListing->min_years_of_experience)
                                {{ $jobListing->min_years_of_experience }} years
                            @else
                                <span class="text-muted">Any</span>
                            @endif
                        </td>
                        <td>{{ $jobListing->applications?->count() ?? 0 }}</td>
                        <td>{{ $jobListing->is_published ? 'Yes' : 'No' }}</td>
                      <td>
    <div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
        <a href="{{ route('admin.job-listings.edit', $jobListing->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ route('admin.applications.index', ['job_id' => $jobListing->id]) }}" class="btn btn-info btn-sm">View</a>
        <a href="{{ route('admin.applications.export', ['job_id' => $jobListing->id]) }}" class="btn btn-success btn-sm">Export</a>
        <form action="{{ route('admin.job-listings.destroy', $jobListing->id) }}" method="POST" onsubmit="return confirm('Delete this job listing?')" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

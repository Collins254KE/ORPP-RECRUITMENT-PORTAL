@extends('layout.main')

@section('content')
<div class="container">
    <h1>Application Details</h1>

    <h3>Job Title: {{ $application->jobListing->title }}</h3>
    <p><strong>Location:</strong> {{ $application->jobListing->location }}</p>
    <p><strong>Status:</strong> {{ $application->status }}</p>
    <p><strong>Applied On:</strong> {{ $application->created_at->format('d M Y') }}</p>

    @if ($application->document_filename)
        <p>
            <a href="{{ route('application.viewDocument', $application->id) }}" target="_blank" class="btn btn-primary">
                View Document
            </a>
        </p>
    @else
        <p>No document uploaded.</p>
    @endif

    <a href="{{ route('user.applications') }}" class="btn btn-secondary">Back to Applications</a>
</div>
@endsection

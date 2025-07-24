@extends('layout.main')

@section('content')
<div class="container">
    <h1>{{ $job_detail->title }}</h1>
    <p><strong>Code:</strong> {{ $job_detail->code }}</p>
    <p><strong>Location:</strong> {{ $job_detail->location }}</p>
    <p><strong>Deadline:</strong> 
  {{ $job_detail->deadline ? $job_detail->deadline->format('d M Y') : 'Not specified' }}
</p>

    <p><strong>Description:</strong></p>
    <p>{{ $job_detail->description }}</p>

    {{-- Display error message --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Display success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($hasApplied)
        <div class="alert alert-info">You have already applied for this job.</div>
    @else
        <a href="{{ route('applications.apply', $job_detail->id) }}" class="btn btn-primary">Apply for this Job</a>
    @endif

    <a href="{{ route('user.applications') }}" class="btn btn-secondary">Back to Applications</a>
</div>
@endsection

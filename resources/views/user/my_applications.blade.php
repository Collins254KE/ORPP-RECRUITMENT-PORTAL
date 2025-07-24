@extends('layout.main')

@section('content')
<div class="container">
    <h1>Job Applications</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($applications->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->jobListing->title }}</td>
                        <td>{{ $application->location }}</td>
                        <td>{{ $application->status }}</td>
                        <td><a href="{{ route('applications.show', $application->id) }}" class="btn btn-info">View</a></td>


                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $applications->links() }}
    @else
        <p>No applications found.</p>
    @endif
</div>
@endsection
@extends('layout.main')

@section('content')
<div class="container">
    <h1>User Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Biodata</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('academic_records.index') ? 'active' : '' }}" href="{{ route('academic_records.index') }}">Academic Records</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('professional_qualifications.index') ? 'active' : '' }}" href="{{ route('professional_qualifications.index') }}">Professional Qualifications</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('professional_memberships.index') ? 'active' : '' }}" href="{{ route('professional_memberships.index') }}">Professional Bodies</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('employment_history.index') ? 'active' : '' }}" href="{{ route('employment_history.index') }}">Work Experience</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('referees.index') ? 'active' : '' }}" href="{{ route('referees.index') }}">Referees</a>
        </li>
    </ul>

    <div class="card mb-4">
        <div class="card-body">
            <a href="{{ route('employment_history.create') }}" class="btn btn-primary mb-3">Add New</a>

            @if($employmentHistories->isEmpty())
                <p>No employment history found.</p>
            @else
                <table class="table" style="border: 2px solid #007bff;">
                    <thead>
                        <tr style="background-color: #e6f0ff;">
                            <th colspan="6" style="text-align: left; padding: 12px; border-bottom: 2px solid #007bff; color: #004085; font-size: 18px;">
                                Employment History
                            </th>
                        </tr>
                        <tr>
                            <th style="border-left: 1px solid #007bff;">Employer Name</th>
                            <th style="border-left: 1px solid #007bff;">Job Position</th>
                            <th style="border-left: 1px solid #007bff;">From</th>
                            <th style="border-left: 1px solid #007bff;">To</th>
                            <th style="border-left: 1px solid #007bff;">Roles & Responsibilities</th>
                            <th style="border-left: 1px solid #007bff;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employmentHistories as $history)
                            <tr>
                                <td style="border-left: 1px solid #007bff;">{{ $history->employer_name }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ $history->job_position }}</td>
                                <td style="border-left: 1px solid #007bff;">
                                    {{ $history->date_joined ? \Carbon\Carbon::parse($history->date_joined)->format('d M Y') : 'N/A' }}
                                </td>
                                <td style="border-left: 1px solid #007bff;">
                                    {{ $history->date_left ? \Carbon\Carbon::parse($history->date_left)->format('d M Y') : 'Current' }}
                                </td>
                                <td style="border-left: 1px solid #007bff;">{{ strip_tags($history->roles_responsibilities) }}</td>
                                <td style="border-left: 1px solid #007bff;">
                                    <a href="{{ route('employment_history.edit', $history->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('employment_history.destroy', $history->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layout.main')

@section('content')
<div class="container">
    <h1>User Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Biodata</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('academic_records.index') ? 'active' : '' }}" href="{{ route('academic_records.index') }}">Academic Records</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('professional_qualifications.index') ? 'active' : '' }}" href="{{ route('professional_qualifications.index') }}">Professional Qualifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('professional_memberships.index') ? 'active' : '' }}" href="{{ route('professional_memberships.index') }}">Professional Bodies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('employment_history.index') ? 'active' : '' }}" href="{{ route('employment_history.index') }}">Employment History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('referees.index') ? 'active' : '' }}" href="{{ route('referees.index') }}">Referees</a>
        </li>
    </ul>

    <div class="card mb-4">
        <div class="card-body">
            <a href="{{ route('referees.create') }}" class="btn btn-primary mb-3">Add New</a>

            @if($referees->isEmpty())
                <p>No referees found.</p>
            @else
                <table class="table" style="border: 2px solid #007bff;">
                    <thead>
                        <tr style="background-color: #e6f0ff;">
                            <th colspan="9" style="text-align: left; padding: 12px; border-bottom: 2px solid #007bff; color: #004085; font-size: 18px;">
                                Referee Details
                            </th>
                        </tr>
                        <tr>
                            <th style="border-left: 1px solid #007bff;">First Name</th>
                            <th style="border-left: 1px solid #007bff;">Middle Name</th>
                            <th style="border-left: 1px solid #007bff;">Other Name</th>
                            <th style="border-left: 1px solid #007bff;">Organization</th>
                            <th style="border-left: 1px solid #007bff;">Designation</th>
                            <th style="border-left: 1px solid #007bff;">Referee Type</th>
                            <th style="border-left: 1px solid #007bff;">Email</th>
                            <th style="border-left: 1px solid #007bff;">Mobile Phone</th>
                            <th style="border-left: 1px solid #007bff;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referees as $referee)
                            <tr>
                                <td style="border-left: 1px solid #007bff;">{{ $referee->first_name }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ $referee->middle_name }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ $referee->other_name }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ $referee->organization }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ $referee->designation }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ ucfirst($referee->referee_type) }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ $referee->email }}</td>
                                <td style="border-left: 1px solid #007bff;">{{ $referee->mobile_phone }}</td>
                                <td style="border-left: 1px solid #007bff;">
                                    <a href="{{ route('referees.edit', $referee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('referees.destroy', $referee->id) }}" method="POST" style="display:inline;">
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

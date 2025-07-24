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
            <a class="nav-link {{ request()->routeIs('employment_history.index') ? 'active' : '' }}" href="{{ route('employment_history.index') }}">Employment History</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('referees.index') ? 'active' : '' }}" href="{{ route('referees.index') }}">Referees</a>
        </li>
    </ul>

    <div class="card mb-4">
        <div class="card-body">
            <a href="{{ route('professional_memberships.create') }}" class="btn btn-primary mb-3">Add New</a>

            @if($professional_memberships->isEmpty())
                <p>No professional membership found.</p>
            @else
                <table class="table" style="border: 2px solid #007bff; margin-bottom: 20px;">
                    <thead>
                        <tr style="background-color: #e6f0ff;">
                            <th colspan="3" style="text-align: left; padding: 12px; border-bottom: 2px solid #007bff; color: #004085; font-size: 18px;">
                                Professional Memberships
                            </th>
                        </tr>
                        <tr>
                            <th style="border-left: 1px solid #007bff;"><div>Description</div></th>
                            <th style="border-left: 1px solid #007bff;"><div>File</div></th>
                            <th style="border-left: 1px solid #007bff;"><div>Actions</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($professional_memberships as $membership)
                            <tr>
                                <td style="border-left: 1px solid #007bff;">{{ $membership->description ?? 'N/A' }}</td>
                                <td style="border-left: 1px solid #007bff;">
                                    @if ($membership->file_path)
                                        <a href="{{ route('files.professional_membership.view', $membership->id) }}" target="_blank" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('files.professional_membership.download', $membership->id) }}" class="btn btn-success btn-sm">Download</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td style="border-left: 1px solid #007bff;">
                                    <a href="{{ route('professional_memberships.edit', $membership->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('professional_memberships.destroy', $membership->id) }}" method="POST" style="display:inline;">
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

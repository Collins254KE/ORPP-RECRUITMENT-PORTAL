@extends('layout.main')


@section('content')
<div class="container">
    <h1>User Profile</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" id="biodata-tab"
                href="{{ route('profile') }}" role="tab">Biodata</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('academic_records.index') ? 'active' : '' }}" id="academic-tab"
                href="{{ route('academic_records.index') }}" role="tab">Academic Qualifications</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('professional_qualifications.index') ? 'active' : '' }}"
                id="qualifications-tab" href="{{ route('professional_qualifications.index') }}" role="tab">Professional Qualifications</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('professional_memberships.index') ? 'active' : '' }}"
                id="bodies-tab" href="{{ route('professional_memberships.index') }}" role="tab">Professional Bodies</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('employment_history.index') ? 'active' : '' }}" id="employment-tab"
                href="{{ route('employment_history.index') }}" role="tab">Work Experience</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->routeIs('referees.index') ? 'active' : '' }}" id="referees-tab"
                href="{{ route('referees.index') }}" role="tab">Referees</a>
        </li>
    </ul>
<div class="card mb-4">
    <div class="card-body">
        <a href="{{ route('academic_records.create') }}" class="btn btn-primary mb-3">Add New</a>

        @if($records->isEmpty())
            <p>No academic records found.</p>
        @else
        <table class="table" style="border: 2px solid #007bff; margin-bottom: 20px;">
    <thead>
        <tr style="background-color: #e6f0ff;">
            <th colspan="6" style="text-align: left; padding: 12px; border-bottom: 2px solid #007bff; color: #004085; font-size: 18px;">
                Academic Qualifications
            </th>
        </tr>
        <tr>
            <th style="border-left: 1px solid #007bff;"><div>Qualification</div></th>
            <th style="border-left: 1px solid #007bff;"><div>Course Name</div></th>
            <th style="border-left: 1px solid #007bff;"><div>Graduation Date</div></th>
            <th style="border-left: 1px solid #007bff;"><div>Institution Name</div></th>
            <th style="border-left: 1px solid #007bff;"><div>File</div></th>
            <th style="border-left: 1px solid #007bff;"><div>Actions</div></th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
               <td style="border-left: 1px solid #007bff;">{{ $record->levelDescription() }}</td>
<td style="border-left: 1px solid #007bff;">{{ $record->qualification_name }}</td>
<td style="border-left: 1px solid #007bff;">
    {{ $record->graduation_date ? \Carbon\Carbon::parse($record->graduation_date)->format('d M Y') : 'N/A' }}
</td>
<td style="border-left: 1px solid #007bff;">{{ $record->institution_name }}</td>

<td style="border-left: 1px solid #007bff;">
    <div class="d-flex gap-2">
        <a href="{{ route('files.academic_record.view', $record->id) }}" target="_blank" class="btn btn-info btn-sm">View</a>
        <a href="{{ route('files.academic_record.download', $record->id) }}" class="btn btn-success btn-sm">Download</a>
    </div>
</td>

<td style="border-left: 1px solid #007bff;">
    <div class="d-flex gap-2">
        <a href="{{ route('academic_records.edit', $record->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('academic_records.destroy', $record->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
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

        @endif
    </div>
</div>

</div>
@endsection

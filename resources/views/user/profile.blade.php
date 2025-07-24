@extends('layout.main')

@section('content')
    <div class="container">
        <h1>User Profile</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('profile')?'active': '' }}" id="biodata-tab" href="{{ route('profile') }}" role="tab">Biodata</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('academic_records.index')?'active': '' }}" id="academic-tab" href="{{ route('academic_records.index') }}" role="tab">Academic
                    Records</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('professional_qualifications.index')?'active': '' }}" id="qualifications-tab" href="{{ route('professional_qualifications.index') }}"
                    role="tab">Professional Qualifications</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('professional_memberships.index')?'active': '' }}" id="bodies-tab" href="{{ route('professional_memberships.index') }}"
                    role="tab">Professional Bodies</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('employment_history.index')?'active': '' }}" id="employment-tab" href="{{ route('employment_history.index') }}" role="tab">Employment
                    History</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('referees.index')?'active': '' }}" id="referees-tab" href="{{ route('referees.index') }}" role="tab">Referees</a>
            </li>
        </ul>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Title:</strong> {{ $user->title }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>ID/Passport:</strong> {{ $user->id_passport }}</p>
                <p><strong>KRA PIN:</strong> {{ $user->kra_pin }}</p>
                <p><strong>County:</strong> {{ $user->county }}</p>
    <p><strong>Sub-County:</strong> {{ $user->sub_county }}</p>
     <p><strong>Ward:</strong> {{ $user->ward }}</p>
    <p><strong>Ethnicity:</strong> {{ $user->ethnicity }}</p>
                <p><strong>Gender:</strong> {{ $user->gender}}</p>
                <p><strong>Nationality:</strong> {{ $user->nationality }}</p>
                <p><strong>Disability Certificate Number:</strong> {{ $user->disability_certificate_number }}</p>

    <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($user->dob)->format('F d, Y') }}</p>

<a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Update biodata</a>

            </div>
        </div>
    </div>
@endsection
@extends('layout.main')

@section('content')
    <div class="container">
        <h1>Edit Employment History</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('employment_history.update', $employmentHistory->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Specify the PUT method for updating -->

                    <div class="mb-3">
                        <label for="employer_name" class="form-label">Employer Name</label>
                        <input type="text" class="form-control" name="employer_name"
                            value="{{ $employmentHistory->employer_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="job_position" class="form-label">Job Position Held</label>
                        <input type="text" class="form-control" name="job_position"
                            value="{{ $employmentHistory->job_position }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_joined" class="form-label">From</label>
                        <input type="date" class="form-control" name="date_joined"
                          value="{{ \Carbon\Carbon::parse($employmentHistory->date_joined)->format('Y-m-d') }}" required>

                    </div>
                    <div class="mb-3">
                        <label for="date_left" class="form-label">To</label>
                        <input type="date" class="form-control" name="date_left"
value="{{ $employmentHistory->date_left ? \Carbon\Carbon::parse($employmentHistory->date_left)->format('Y-m-d') : '' }}"
>
                    </div>
                    <div class="mb-3">
                        <label for="roles_responsibilities" class="form-label">Summary of Roles & Responsibilities (Max 250
                            Characters)</label>
                        <textarea class="form-control" name="roles_responsibilities" maxlength="250"
                            required>{{ $employmentHistory->roles_responsibilities }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('employment_history.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
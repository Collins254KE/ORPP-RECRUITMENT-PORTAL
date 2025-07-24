@extends('layout.main')

@section('content')
    <div class="container">
        <h1>Add Employment History</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('employment_history.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employer_name" class="form-label">Employer Name</label>
                        <input type="text" class="form-control" name="employer_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="job_position" class="form-label">Job Position Held</label>
                        <input type="text" class="form-control" name="job_position" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_joined" class="form-label">From</label>
                        <input type="date" class="form-control" name="date_joined" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_left" class="form-label">To</label>
                        <input type="date" class="form-control" name="date_left">
                    </div>
                    <div class="mb-3">
                        <label for="roles_responsibilities" class="form-label">Summary of Roles & Responsibilities (Max 250
                            Characters)</label>
                        <textarea class="form-control" name="roles_responsibilities" maxlength="250" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('employment_history.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
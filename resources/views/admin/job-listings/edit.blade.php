@extends('layout.main')

@section('content')
    <h1>Edit Job Listing</h1>
    <form action="{{ route('admin.job-listings.update', $jobListing->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $jobListing->title }}" required>
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" class="form-control" value="{{ $jobListing->code }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $jobListing->location }}" required>
        </div>

        <div class="form-group">
            <label for="posts">Posts</label>
            <input type="number" name="posts" id="posts" class="form-control"
                value="{{ old('posts', $jobListing->posts ?? '') }}" min="1">
        </div>

        <div class="form-group">
            <label for="duties_and_responsibilities">Duties & Responsibilities</label>
            <textarea name="duties_and_responsibilities" class="form-control" rows="4" required>{{ $jobListing->duties_and_responsibilities }}</textarea>
        </div>

        <div class="form-group">
            <label for="requirements">Requirements</label>
            <textarea name="requirements" class="form-control" rows="4" required>{{ $jobListing->requirements }}</textarea>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" name="deadline" class="form-control"
                value="{{ $jobListing->deadline ? $jobListing->deadline->format('Y-m-d\TH:i') : '' }}" required>
        </div>

        <div class="form-group">
            <label for="min_years_of_experience">Minimum Years of Experience</label>
            <input type="number" id="min_years_of_experience" name="min_years_of_experience" class="form-control"
                min="0" max="50"
                value="{{ old('min_years_of_experience', $jobListing->min_years_of_experience ?? 0) }}">
        </div>

        <div class="form-group">
            <label for="min_level">Minimum Qualification Level</label>
            <select id="min_level" name="min_level" class="form-control">
                <option value="">No Minimum Requirement</option>
                <option value="1" {{ old('min_level', $jobListing->min_level) == '1' ? 'selected' : '' }}>Certificate
                </option>
                <option value="2" {{ old('min_level', $jobListing->min_level) == '2' ? 'selected' : '' }}>Diploma
                </option>
                <option value="3" {{ old('min_level', $jobListing->min_level) == '3' ? 'selected' : '' }}>Degree
                </option>
                <option value="4" {{ old('min_level', $jobListing->min_level) == '4' ? 'selected' : '' }}>Master
                </option>
                <option value="5" {{ old('min_level', $jobListing->min_level) == '5' ? 'selected' : '' }}>PhD</option>
            </select>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_published" value="1"
                    {{ old('is_published', $jobListing->is_published ?? false) ? 'checked' : '' }}>
                Publish this job
            </label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection

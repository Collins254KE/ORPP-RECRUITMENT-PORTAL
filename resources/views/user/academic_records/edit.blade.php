@extends('layout.main')

@section('content')
    <div class="container">
        <h1>Edit Academic Record</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('academic_records.update', $academicRecord->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the PUT method for updating -->

                    <div class="mb-3">
                        <label for="qualification_code" class="form-label">Qualification Level</label>
                        <select class="form-control @error('qualification_code') is-invalid @enderror" name="qualification_code" required>
                            <option value="">Select Qualification Level</option>
                            <option value="1" {{ old('qualification_code', $academicRecord->qualification_code) == 1 ? 'selected' : '' }}>Certificate</option>
                            <option value="2" {{ old('qualification_code', $academicRecord->qualification_code) == 2 ? 'selected' : '' }}>Diploma</option>
                            <option value="3" {{ old('qualification_code', $academicRecord->qualification_code) == 3 ? 'selected' : '' }}>Degree</option>
                            <option value="4" {{ old('qualification_code', $academicRecord->qualification_code) == 4 ? 'selected' : '' }}>Master</option>
                            <option value="5" {{ old('qualification_code', $academicRecord->qualification_code) == 5 ? 'selected' : '' }}>PhD</option>
                        </select>
                        @error('qualification_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="qualification_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control @error('qualification_name') is-invalid @enderror" 
                               name="qualification_name"
                               value="{{ old('qualification_name', $academicRecord->qualification_name) }}" required>
                        @error('qualification_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="qualification_cadre" class="form-label">Grade </label>
                        <input type="text" class="form-control @error('qualification_cadre') is-invalid @enderror" 
                               name="qualification_cadre"
                               value="{{ old('qualification_cadre', $academicRecord->qualification_cadre) }}" required>
                        @error('qualification_cadre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
    <label for="graduation_date" class="form-label">Graduation Date</label>
    <input type="date"
           class="form-control @error('graduation_date') is-invalid @enderror" 
           name="graduation_date"
           max="2025-01-01"
           value="{{ old('graduation_date', $academicRecord->graduation_date ? \Carbon\Carbon::parse($academicRecord->graduation_date)->format('Y-m-d') : '') }}"
           required>
    @error('graduation_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                    <div class="mb-3">
                        <label for="institution_name" class="form-label">Institution Name</label>
                        <input type="text" class="form-control @error('institution_name') is-invalid @enderror" 
                               name="institution_name"
                               value="{{ old('institution_name', $academicRecord->institution_name) }}" required>
                        @error('institution_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Attach PDF Document (optional)</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               name="file" accept=".pdf">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('academic_records.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
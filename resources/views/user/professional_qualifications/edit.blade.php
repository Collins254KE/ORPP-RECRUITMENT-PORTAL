@extends('layout.main')

@section('content')
    <div class="container">
        <h1>Edit Professional Qualification</h1>

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
                <form action="{{ route('professional_qualifications.update', $qualification->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the PUT method for updating -->

                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-control @error('level') is-invalid @enderror" name="level" required>
                            <option value="">Select Level</option>
                            <option value="1" {{ old('level', $qualification->level) == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                            <option value="2" {{ old('level', $qualification->level) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                            <option value="3" {{ old('level', $qualification->level) == 'Degree' ? 'selected' : '' }}>Degree</option>
                            <option value="4" {{ old('level', $qualification->level) == 'Master' ? 'selected' : '' }}>Master</option>
                            <option value="5" {{ old('level', $qualification->level) == 'PhD' ? 'selected' : '' }}>PhD</option>
                        </select>
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" required>{{ old('description', $qualification->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Attach New PDF Document (optional)</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               name="file" accept=".pdf">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('professional_qualifications.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('layout.main')

@section('content')
    <div class="container">
        <h1>Edit Professional Membership</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('professional_memberships.update', $membership->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the PUT method for updating -->

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" required>{{ $membership->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Attach New PDF Document (optional)</label>
                        <input type="file" class="form-control" name="file" accept=".pdf">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('professional_memberships.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
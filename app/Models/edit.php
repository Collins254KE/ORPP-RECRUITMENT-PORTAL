@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Biodata</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the errors below:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="county" class="form-label">County</label>
            <input type="text" name="county" class="form-control" value="{{ old('county', $user->county) }}">
        </div>

        <div class="mb-3">
            <label for="sub_county" class="form-label">Sub-County</label>
            <input type="text" name="sub_county" class="form-control" value="{{ old('sub_county', $user->sub_county) }}">
        </div>

        <div class="mb-3">
            <label for="ethnicity" class="form-label">Ethnicity</label>
            <input type="text" name="ethnicity" class="form-control" value="{{ old('ethnicity', $user->ethnicity) }}">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-control">
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $user->nationality) }}">
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->dob) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Biodata</button>
    </form>
</div>
@endsection

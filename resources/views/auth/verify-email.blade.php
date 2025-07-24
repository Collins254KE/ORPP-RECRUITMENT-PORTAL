@extends('layout.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg" style="max-width: 500px; width: 100%;">
        <div class="card-header bg-primary text-white text-center">
            <h4>Email Verification Required</h4>
        </div>
        <div class="card-body p-4">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <p class="text-center">
                Thanks for signing up! Before proceeding, please check your email for a verification link.
            </p>
            <p class="text-center">
                If you did not receive the email, we will gladly send you another.
            </p>

            <div class="d-grid gap-2">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">
                        Resend Verification Email
                    </button>
                </form>
            </div>
        </div>
        {{-- Add this section --}}
            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="text-decoration-none">
                    ← Back to Registration
                </a>
            </div>
        </div>
        <div class="card-footer text-center text-muted">
            <small>ORPP © {{ date('Y') }}</small>
        </div>
    </div>
</div>
@endsection 
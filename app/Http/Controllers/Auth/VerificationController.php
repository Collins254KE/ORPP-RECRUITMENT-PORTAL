<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Requires the user to be authenticated
        $this->middleware('auth');

        // Requires the URL to be signed for the 'verify' route
        $this->middleware('signed')->only('verify');

        // Limits resend and verify attempts to 6 per minute
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Redirect after email verification.
     */
    protected function redirectTo()
    {
        return '/login?verified=1';
    }
}

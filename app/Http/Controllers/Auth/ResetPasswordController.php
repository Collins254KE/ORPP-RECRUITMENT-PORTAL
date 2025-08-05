<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Log the user in after resetting the password.
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();

        Auth::login($user);
    }

    /**
     * Show custom reset password form.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.custom-reset-password-form')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }
}

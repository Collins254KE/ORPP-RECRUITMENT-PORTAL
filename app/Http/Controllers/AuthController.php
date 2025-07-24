<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function userLogin()
    {
        return view('auth.login');  // Use dot notation in Laravel views
    }

    public function userRegistration()
    {
        return view('auth.register');
    }

   public function signin(Request $request)
{
    // Validate input fields matching your form's names
    $validator = \Validator::make($request->all(), [
        'login' => 'required',
        'psw' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }

    $login = $request->input('login');
    $password = $request->input('psw');

    // Check if login input is email or id_passport
    $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'id_passport';

    $user = User::where($field, $login)->first();

    if ($user && Hash::check($password, $user->password)) {
        Auth::login($user);

        //  Admin bypasses email verification
        if ($user->email === 'collinskiprotich2018@gmail.com') {
            return response()->json([
                'status' => 'success',
                'redirect' => url('/admin/dashboard')
            ]);
        }

        // Normal users must verify email
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'success',
                'redirect' => url('/dashboard')
            ]);
        } else {
            return response()->json([
                'status' => 'verify',
                'redirect' => url('/email/verify')
            ]);
        }
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Invalid credentials'
    ], 401);
}


    public function signup(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'title' => 'required|string|max:50',
            'phone' => 'required|string|max:15|unique:users',
            // 'id_passport' => 'required|string|max:20|unique:users',
            // 'kra_pin' => 'required|string|max:20|unique:users',
            // 'county' => 'required|string',
            // 'sub_county' => 'required|string',
            // 'ethnicity' => 'required|string',
            // 'dob' => 'required|date',
            // 'gender' => 'required|string',
            // 'nationality' => 'required|string',
            // 'disability_status' => 'required|in:yes,no',
            // 'disability_certificate_number' => 'nullable|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'psw' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->input('name'),
            // 'title' => $request->input('title'),
            'phone' => $request->input('phone'),
            // 'id_passport' => $request->input('id_passport'),
            // 'kra_pin' => $request->input('kra_pin'),
            // 'county' => $request->input('county'),
            // 'sub_county' => $request->input('sub_county'),
            // 'ethnicity' => $request->input('ethnicity'),
            // 'dob' => $request->input('dob'),
            // 'gender' => $request->input('gender'),
            // 'nationality' => $request->input('nationality'),
            'disability_status' => 'no',
            // 'disability_certificate_number' => $request->input('disability_certificate_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('psw')),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return response()->json(['status' => 'success', 'redirect' => url("/email/verify?email=$request->input('email')")]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['status' => 'success'])
            : response()->json(['status' => 'error', 'message' => __($status)]);
    }

    public function showResetForm()
    {
        return view('auth.reset-password');
    }
}

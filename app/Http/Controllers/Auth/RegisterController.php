<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
protected function redirectTo()
{
    return '/dashboard';
}

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'title' => ['nullable', 'string'],
            // 'county' => ['nullable', 'string'],
            // 'subcounty' => ['nullable', 'string'],
            // 'ethnicity' => ['nullable', 'string'],
            // 'dob' => ['nullable', 'date'],
            'phone' => ['required', 'string', 'max:10'],
            // 'id_passport' => ['nullable', 'string', 'max:10'],
            // 'gender' => ['nullable', 'string'],
            // 'nationality' => ['nullable', 'string'],
            // 'kra_pin' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            // 'title' => $data['title'],
            // 'county' => $data['county'],
            // 'sub_county' => $data['subcounty'],
            // 'ethnicity' => $data['ethnicity'],
            // 'dob' => $data['dob'],
            'phone' => $data['phone'],
            // 'id_passport' => $data['id_passport'],
            // 'gender' => $data['gender'],
            // 'nationality' => $data['nationality'],
            // 'kra_pin' => $data['kra_pin'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Override default register method to trigger email verification.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user)); //  Send verification email

        Auth::login($user);

        return redirect()->route('verification.notice'); // redirect to built-in verification notice
    }
}

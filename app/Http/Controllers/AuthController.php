<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginSave(Request $request)
{
    // Validate the form inputs
    $request->validate([
        'email-username' => 'required',
        'password' => 'required',
    ]);

    // Determine if it's an email or username
    $loginType = filter_var($request->input('email-username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Attempt to authenticate the user
    $credentials = [
        $loginType => $request->input('email-username'),
        'password' => $request->input('password')
    ];

    if (Auth::attempt($credentials, $request->has('remember'))) {
        // After successful authentication, check if remember_token is 'inactive' or null
        $user = Auth::user();

        // Check if remember_token is NULL or 'inactive'
        if (is_null($user->remember_token) || $user->remember_token === 'inactive') {
            // If remember_token is null or 'inactive', log out the user
            Auth::logout(); // Log out the user
            return Redirect::back()->withErrors([
                'email-username' => 'Your account is inactive. Please contact the administrator to activate your account.'
            ])->withInput();
        }

        // Authentication passed and remember_token is not 'inactive' or null, redirect to dashboard
        return redirect()->intended('dashboard')->with('success', 'Login successful!');
    }

    // If authentication fails, redirect back with error
    return Redirect::back()->withErrors([
        'email-username' => 'Invalid credentials provided.'
    ])->withInput();
}



public function register()
{
    return view('auth.register');
}

public function registerSave(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required',
    ]);

    // return $request->all();

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Create the user
    User::create([
        'username' => $request->username,
        'email' => $request->email,
        'roll' => $request->roll,
        'password' => Hash::make($request->password),
        'remember_token' => 'inactive',
    ]);

    return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
}
public function forgotPassword()
{
    return view('auth.forgotPassword');
}

public function logout()
{
    Auth::logout();
    return redirect('/login')->with('success', 'Logged out successfully.');
}


public function passwordchange()
{
    return view('user.changepassword');
}


    public function changePassword(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'new_password' => 'required|string|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = Auth::user();
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Password changed successfully.']);
    }

}

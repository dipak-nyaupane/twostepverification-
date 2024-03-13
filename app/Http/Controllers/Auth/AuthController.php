<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validate the user's login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($credentials, $request->remember)) {
            // Authentication successful, redirect the user to the dashboard
            return redirect('/dashboard');
        }

        // Authentication failed, redirect back with error message
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Invalid login credentials']);
    }

    public function showTwoStepVerificationForm()
    {
        return view('admin.two_step_verification');
    }

    public function verifyTwoStepVerification(Request $request)
    {
        // Verify the two-step verification code here

        // If verification successful, redirect the user to the dashboard
        return redirect('/dashboard');
    }
}

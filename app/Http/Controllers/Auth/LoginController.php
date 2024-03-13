<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if two-factor authentication is enabled for the user
            if ($user->two_factor_secret) {
                $otp = mt_rand(100000, 999999); // Generate OTP

             // Inside your login function


                //     // Store OTP and expiry time in session

                 // Store OTP in the database
            DB::table('sessions')->insert([
                'user_id' => $user->id,
                'otp' => $otp,
                'otp_verified_at' => null,
                'expiry_time' => Carbon::now()->addMinutes(2)->toDateTimeString(), // Convert to timestamp
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'payload' => '',
                'last_activity' => now()->now()->toDateTimeString(), // Convert to timestamp
            ]);
                // $request->session()->put('otp', $otp);
                // $request->session()->put('otp_expiry', Carbon::now()->addMinutes(5));


                Mail::to($user->email)->send(new OTPMail($otp, 'two_factor'));


                return redirect()->intended('/two-step-verification');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

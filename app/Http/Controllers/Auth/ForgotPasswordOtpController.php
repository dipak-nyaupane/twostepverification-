<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ForgotPasswordOtpController extends Controller
{
    /**
     * Show the form for entering OTP.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgotPasswordVerificationForm()
    {
        $email = session('email');
        return view('admin.forgot-password_otp', compact('email'));
    }

    /**
     * Verify the OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyForgotPasswordOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|numeric'
        ]);

        $email = $request->input('email');
    $otp = $request->input('verification_code');

        // Verify OTP
        $token = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $otp)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5))
            ->first();

        if (!$token) {
            return back()->withErrors(['otp' => 'Invalid OTP or OTP expired.']);
        }

        // OTP is valid, redirect to reset password form
        return redirect()->route('password.reset', ['email' => $email]);
    }

    /**
     * Resend OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resendForgotPasswordOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $otp = mt_rand(100000, 999999); // Generate OTP

        DB::table('password_reset_tokens')
            ->updateOrInsert(
                ['email' => $email],
                ['token' => $otp, 'created_at' => now()]
            );

        // Send OTP to the user's email
        Mail::to($email)->send(new OTPMail($otp, 'forgot_password'));

        return back()->with('message', 'OTP resent successfully.');
    }
}

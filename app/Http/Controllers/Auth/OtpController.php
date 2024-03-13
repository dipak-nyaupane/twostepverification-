<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Session;
class OtpController extends Controller
{
    // Middleware to ensure user is authenticated before accessing OTP verification
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show OTP verification form
    public function showVerificationForm()
    {
        return view('admin.two_step_verification'); // Assuming you have a blade view named 'two_step_verification'
    }
//erify OTP
    public function verifyOTP(Request $request)
    {
        // Retrieve user from authentication
        $user = Auth::user();

        // Retrieve OTP and expiry time from the database
        $otpData = DB::table('sessions')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->first();

        if (!$otpData) {
            return back()->withErrors(['otp' => 'OTP not found.']);
        }

        $otp = $otpData->otp;

        // Verify if OTP has expired
        if (Carbon::parse($otpData->expiry_time)->isPast()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        $enteredOTP = $request->verification_code;

        // Verify entered OTP against stored OTP
        if ($enteredOTP == $otp) {
            // Mark OTP as verified
            DB::table('sessions')
                ->where('id', $otpData->id)
                ->update(['otp_verified_at' => now()]);

            // Redirect authenticated user to dashboard
            return redirect('/dashboard');
        } else {
            // Invalid OTP, redirect back with error message
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }
    }

    // Resend OTP
    public function resendOTP(Request $request)
    {
        // Retrieve user from authentication
        $user = Auth::user();

        // Generate new OTP and expiry time
        $otp = mt_rand(100000, 999999);
        $expiryTime = Carbon::now()->addMinutes(5);

        // Update OTP and expiry time in the database
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->update([
                'otp' => $otp,
                'otp_verified_at' => null,
                'expiry_time' => $expiryTime,
            ]);

        // Determine the purpose for the OTP
        $purpose = 'two-step-verification'; // Modify this as needed

        // Send OTP email
        Mail::to($user->email)->send(new OTPMail($otp, $purpose));

        // Redirect back to OTP verification form
        return redirect()->intended('/two-step-verification');
    }

}

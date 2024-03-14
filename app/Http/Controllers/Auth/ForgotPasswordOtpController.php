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

class ForgotPasswordOtpController extends Controller
{
    public function showForgotPasswordVerificationForm()
    {
        $email = session('email');
        return view('admin.login.forgot-password_otp', compact('email'));
    }

    public function verifyForgotPasswordOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|numeric'
        ], [
            'verification_code.required' => 'The verification code field is required.',
            'verification_code.numeric' => 'The verification code must be a number.',
        ]);

        $email = $request->input('email');
        $otp = $request->input('verification_code');

        $token = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $otp)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5))
            ->first();

        if (!$token) {
            $request->session()->put('email', $email);
            return back()->withErrors(['verification_code' => 'Invalid-OTP or OTP has been expired.'])->withInput();
        }

        $request->session()->put('email', $email);
        $request->session()->put('token', $token->token);

        return redirect()->route('password.update.form');
    }

    public function resendForgotPasswordOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $otp = mt_rand(100000, 999999);

        DB::table('password_reset_tokens')
            ->updateOrInsert(
                ['email' => $email],
                ['token' => $otp, 'created_at' => now()]
            );

        Mail::to($email)->send(new OTPMail($otp, 'forgot_password'));

        return back()->with('message', 'OTP resent successfully.');
    }

    public function showUpdatePasswordForm(Request $request)
    {
        $email = $request->session()->get('email');
        $token = $request->session()->get('token');
        return view('admin.login.update-password', compact('email', 'token'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('login')->with('status', 'Password updated successfully!');
    }
}

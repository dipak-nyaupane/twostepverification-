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


class ForgotPasswordController extends Controller
{
    //
    public function showLinkRequestForm()
    {
        return view('admin.forgot-password');
    }


    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'The provided email address is not registered.']);
        }

        // Check if there is an existing record for the email address
        $existingRecord = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if ($existingRecord) {
            // If there is an existing record, update the token and timestamp
            $otp = mt_rand(100000, 999999); // Generate OTP

            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'token' => $otp,
                    'created_at' => now(),
                ]);
        } else {
            // If there is no existing record, insert a new record
            $otp = mt_rand(100000, 999999); // Generate OTP

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $otp,
                'created_at' => now(),
            ]);
        }

        // Send OTP to the user's email
        Mail::to($user->email)->send(new OTPMail($otp, 'forgot_password'));
         // Redirect to forget password verification with the email
        //  return Redirect::intended('/forget_password_verification')
        //  ->with('email', $user->email);

        //  return redirect()->intended('//forget_password_verification');

        // return redirect()->route('forget_password_verification');
        return redirect()->route('password.verification.form')->with('email', $user->email);



    }
}



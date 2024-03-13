<?php

use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordOtpController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

    // routes/web.php

    // Login Route

});
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/two-step-verification', [OtpController::class, 'showVerificationForm'])->name('otp.verify.form');

// Define routes for showing the verification form, verifying the code, and resending the code
Route::get('/two-step-verification', [OtpController::class, 'showVerificationForm'])->name('two-step.verification.form');
Route::post('/two-step-verification', [OtpController::class, 'verifyOTP'])->name('two-step.verify');
Route::post('/two-step-verification/resend', [OtpController::class, 'resendOTP'])->name('two-step.resend');

// routes/web.php

use App\Http\Controllers\Auth\ForgotPasswordController;
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Routes for forgot password OTP functionality
Route::get('/forget_password_verification', [ForgotPasswordOtpController::class, 'showForgotPasswordVerificationForm'])->name('password.verification.form');
Route::post('/forget_password_verification', [ForgotPasswordOtpController::class, 'verifyForgotPasswordOTP'])->name('password.verify');
Route::post('/forget_password_verification/resend', [ForgotPasswordOtpController::class, 'resendForgotPasswordOTP'])->name('forgot_password_otp.resend');

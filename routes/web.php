<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordOtpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;

//backend controllers
use App\Http\Controllers\backend\PurchaseController;
use App\Http\Controllers\backend\InventoryController;
use App\Http\Controllers\backend\CommentController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\UserController;

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
    return view('admin.login.login');

    // routes/web.php

    // Login Route

});


// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

// Logout route
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// two step verification
Route::get('/two-step-verification', [OtpController::class, 'showVerificationForm'])->name('two-step.verification.form');
Route::post('/two-step-verification', [OtpController::class, 'verifyOTP'])->name('two-step.verify');
Route::post('/two-step-verification/resend', [OtpController::class, 'resendOTP'])->name('two-step.resend');

// routes/forget password

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Routes for forgot password OTP functionality
Route::get('/forget_password_verification', [ForgotPasswordOtpController::class, 'showForgotPasswordVerificationForm'])->name('password.verification.form');
 Route::post('/forget_password_verification', [ForgotPasswordOtpController::class, 'verifyForgotPasswordOTP'])->name('password.verify');
 Route::post('/forget_password_verification/resend', [ForgotPasswordOtpController::class, 'resendForgotPasswordOTP'])->name('forgot_password_otp.resend');
// //Update Password
Route::get('/reset-password', [ForgotPasswordOtpController::class, 'showUpdatePasswordForm'])->name('password.update.form');
Route::post('/reset-password', [ForgotPasswordOtpController::class, 'verifyForgotPasswordOTP'])->name('password.verify.otp');
Route::post('/resend-otp', [ForgotPasswordOtpController::class, 'resendForgotPasswordOTP'])->name('password.resend.otp');
Route::post('/update-password', [ForgotPasswordOtpController::class, 'updatePassword'])->name('password.update');

// main path from dasboard Backend Folder

Route::prefix('purchase')->group(function () {
Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.view');

});

Route::prefix('inventory')->group(function () {
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.view');

});

Route::prefix('reports')->group(function () {
Route::get('/reports', [ReportController::class, 'index'])->name('reports.view');

});

Route::prefix('users')->group(function () {
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/create.users', [UserController::class, 'create'])->name('create.users');
});

Route::prefix('comment')->group(function () {
Route::get('/comment', [CommentController::class, 'index'])->name('comment');

});


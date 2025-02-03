<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Middleware\CheckAuth;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\isEmployer;

Route::get('/', function () {
    return view('welcome');
});

// Email verification
// Route::get('/email/verify', function () {
//     redirect('/login');
// })->middleware(['auth', 'signed'])->name('verification.verify');


# Handler email verification
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/register/seeker', [UserController::class, 'createSeeker'])->name('create.seeker');
Route::post('/register/seeker', [UserController::class, 'storeSeeker'])->name('store.seeker');
Route::get('/register/employer', [UserController::class, 'createEmployer'])->name('create.employer');
Route::post('/register/employer', [UserController::class, 'storeEmployer'])->name('store.employer');

// AUTHENTIFICATION
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
// Route::post('user/profile', [UserController::class, 'update'])->name('user.update.profile')->middleware('auth');
// Route::get('user/profile/seeker', [UserController::class, 'seekerProfile'])->name('seeker.profile')
// ->middleware(['auth','verified']);

// Route::get('user/job/applied', [UserController::class, 'jobApplied'])->name('job.applied')
// ->middleware(['auth','verified']);


// Route::post('user/password', [UserController::class, 'changePassword'])->name('user.password')->middleware('auth');
// Route::post('upload/resume', [UserController::class, 'uploadResume'])->name('upload.resume')->middleware('auth');

Route::get('register/resend-verification', [DashboardController::class,'resendVerification'])
->name('register.resend-verification');


# DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware('verified')
->name('dashboard');

Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');
Route::get('/resend/verification/email',[DashboardController::class, 'resend'])->name('resend.email');


# SUBSCRIPTION AND PAYMENT
Route::get('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('pay/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.weekly');
Route::get('pay/monthly', [SubscriptionController::class, 'initiatePayment'])->name('pay.monthly');
Route::get('pay/yearly', [SubscriptionController::class, 'initiatePayment'])->name('pay.yearly');
Route::get('payment/success', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment/cancel', [SubscriptionController::class, 'cancel'])->name('payment.cancel');

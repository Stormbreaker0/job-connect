<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JoblistingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Middleware\CheckAuth;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PostJobController;
use App\Http\Middleware\isPremiumUser;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\InfoPageController;
use App\Http\Middleware\SetUserCookie;

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


# Route::get('/home', function () {
#     return view('home');
# });


# Email verification
# Route::get('/email/verify', function () {
#     redirect('/login');
# })->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/welcome', [UserController::class, 'welcome'])->name('welcome');


Route::get('/', [JoblistingController::class, 'index'])->name('listing.index');
Route::get('/company/{id}', [JoblistingController::class, 'company'])->name('company');

# HANDLE EMAIL VERIFICATION
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

# EMAIL VERIFICATION NOTICE
Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');


# RESEND EMAIL VERIFICATION
Route::get('/register/resend-verification', [DashboardController::class, 'resendVerification'])
    ->name('/register.resend-verification');
Route::get('/resend/verification/email', [DashboardController::class, 'resend'])->name('resend.email');


# ABOUT-US & CONTACT-US ROUTES
Route::get('/about', [InfoPageController::class, 'aboutUs'])->name('about');


# PRIVACY POLICY ROUTES
Route::get('/privacy', [InfoPageController::class, 'privacy'])->name('privacy');


# TERMS OF SERVICE ROUTES
Route::get('/terms', [InfoPageController::class, 'terms'])->name('terms');


# REGISTER ROUTES
Route::get('/register/seeker', [UserController::class, 'createSeeker'])->name('create.seeker')->middleware(CheckAuth::class);
Route::post('/register/seeker', [UserController::class, 'storeSeeker'])->name('store.seeker');
Route::get('/register/employer', [UserController::class, 'createEmployer'])->name('create.employer')->middleware(CheckAuth::class);
Route::post('/register/employer', [UserController::class, 'storeEmployer'])->name('store.employer');


# AUTHENTIFICATION ROUTES
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware(CheckAuth::class);
Route::post('/login', [UserController::class, 'postLogin'])->name('login.post')->middleware(SetUserCookie::class);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


# PASSWORD ROUTES
Route::post('user/password', [UserController::class, 'changePassword'])->name('user.password')->middleware('auth');


# PROFILE ROUTES
Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('user/profile', [UserController::class, 'update'])->name('user.update.profile')->middleware('auth');
Route::get('user/profile/seeker', [UserController::class, 'seekerProfile'])->name('seeker.profile')->middleware(['auth', 'verified']);


# UPLOAD RESUME ROUTES
Route::post('upload/resume', [UserController::class, 'uploadResume'])->name('upload.resume')->middleware('auth');
Route::post('/resume/upload',[FileUploadController::class, 'store'])->middleware('auth');


# DASHBOARD ROUTES
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['verified', isPremiumUser::class])
    ->name('dashboard');


# SUBSCRIPTION AND PAYMENT
Route::get('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/pay/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.weekly');
Route::get('/pay/monthly', [SubscriptionController::class, 'initiatePayment'])->name('pay.monthly');
Route::get('/pay/yearly', [SubscriptionController::class, 'initiatePayment'])->name('pay.yearly');
Route::get('/payment/success', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [SubscriptionController::class, 'cancel'])->name('payment.cancel');


# JOB ROUTES CRUD ENTITY
Route::get('job/create', [PostJobController::class, 'create'])->name('job.create');
Route::post('job/create', [PostJobController::class, 'store'])->name('job.store');
Route::get('job/{listing}/edit', [PostJobController::class, 'edit'])->name('job.edit');
Route::put('job/{id}/edit', [PostJobController::class, 'update'])->name('job.update');
Route::get('job', [PostJobController::class, 'index'])->name('job.index');
Route::delete('job/{id}/delete', [PostJobController::class, 'destroy'])->name('job.delete');
Route::get('/jobs/{listing:slug}', [JoblistingController::class, 'show'])->name('job.show');


# JOB APPLICATION ROUTES
Route::get('user/job/applied', [UserController::class, 'jobApplied'])->name('job.applied')
    ->middleware(['auth', 'verified']);


# APPLY ROUTES
Route::get('applicants', [ApplicantController::class, 'index'])->name('applicants.index');
Route::get('applicants/{listing:slug}', [ApplicantController::class, 'show'])->name('applicants.show');
Route::post('shortlist/{listingId}/{userId}', [ApplicantController::class, 'shortlist'])
    ->name('applicants.shortlist');
Route::post('/applicantion/{listingId}/submit', [ApplicantController::class, 'apply'])->name('applicantion.submit');

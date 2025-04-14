<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostjopController;
use App\Http\Middleware\isamember;
use App\Http\Middleware\isPremiumUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/register/seeker', [UserController::class, 'createSeeker'])->name('create.seeker');
Route::post('/register/seeker', [UserController::class, 'storeSeeker'])->name('store.seeker');

Route::get('/register/employer', [UserController::class, 'createEmployer'])->name('create.employer');
Route::post('/register/employer', [UserController::class, 'storeEmployer'])->name('store.employer');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postlogin'])->name('postlogin');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('verified')
    ->name('dashboard');
Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');
Route::get('/resend/verification/Email', [DashboardController::class, 'resend'])->name('resend.email');

Route::get('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('pay/weekly', [SubscriptionController::class, 'initiatepayment'])->name('pay.weekly');
Route::get('pay/monthly', [SubscriptionController::class, 'initiatepayment'])->name('pay.monthly');
Route::get('pay/yearly', [SubscriptionController::class, 'initiatepayment'])->name('pay.yearly');
Route::get('payment/success', [SubscriptionController::class, 'paymentsuccess'])->name('payment.success');
Route::get('payment/cancel', [SubscriptionController::class, 'cancel'])->name('payment.cancel');

Route::get('jop/create',[PostjopController::class,'create'])->name('jop.create')->middleware(isPremiumUser::class);
Route::post('jop/store',[PostjopController::class,'store'])->name('jop.store')->middleware(isPremiumUser::class);
Route::get('jop/{listing}/edit',[PostjopController::class,'edit'])->name('jop.edit')->middleware(isPremiumUser::class);
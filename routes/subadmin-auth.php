<?php

use App\Http\Controllers\SubAdmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SubAdmin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\SubAdmin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\SubAdmin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\SubAdmin\Auth\NewPasswordController;
use App\Http\Controllers\SubAdmin\Auth\PasswordController;
use App\Http\Controllers\SubAdmin\Auth\PasswordResetLinkController;
use App\Http\Controllers\SubAdmin\Auth\VerifyEmailController;
use App\Http\Controllers\SubAdmin\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:subadmin')->prefix('sub_admins')->name('sub_admins.')->group(function () {


    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:subadmin')->prefix('sub_admins')->name('sub_admins.')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');


    //apatoto//

    Route::get('/dashboard', function () {
        return view('subadmin.dashboard');
    })->middleware([ 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Route::get('/sub_admins/{id}/edit', [ProfileController::class, 'edit'])->name('sub_admins.edit');





    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

<?php

use App\Http\Livewire\Admin\Auth\LoginController;
use App\Http\Livewire\Admin\Auth\LogoutController;
use App\Http\Livewire\Admin\Auth\PasswordResetController;
use App\Http\Livewire\Admin\Auth\RegisterController;
use App\Http\Livewire\Frontend\Auth\ForgotPasswordController;
use App\Http\Livewire\Frontend\Auth\RegisterController as FrontendRegisterController;
use App\Http\Livewire\Frontend\Auth\LoginController as FrontendLoginController;
use App\Http\Livewire\Frontend\Auth\LogoutController as FrontendLogoutController;
use App\Http\Livewire\Frontend\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

//admin auth Routes
Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('guest.admin:admin')->group(function () {
        Route::get('login', LoginController::class)->name('login');
        Route::get('password-reset', PasswordResetController::class)->name('password-reset');
    });
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});

//user auth routes
Route::middleware('guest')->group(function () {
    Route::get('register/{token}', FrontendRegisterController::class)->name('register')->middleware('signed', 'verifiedInviteToken');
    Route::get('login', FrontendLoginController::class)->name('login');


    Route::get('forgot-password', ForgotPasswordController::class)->name('password.request');

    Route::get('reset-password/{token}', ResetPasswordController::class)->name('password.reset');
});
Route::post('logout', [FrontendLogoutController::class, 'logout'])->name('logout');

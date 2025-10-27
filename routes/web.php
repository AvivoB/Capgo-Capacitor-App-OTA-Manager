<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;

// Language switcher route
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Routes d'onboarding (première installation)
Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding');
Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');

Route::get('/', function () {
    return redirect('/admin/login');
});

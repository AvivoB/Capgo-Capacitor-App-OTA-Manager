<?php

use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;

// Routes d'onboarding (première installation)
Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding');
Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');

Route::get('/', function () {
    return redirect('/admin/login');
});

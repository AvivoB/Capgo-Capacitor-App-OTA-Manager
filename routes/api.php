<?php

use App\Http\Controllers\OtaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Routes pour les mises à jour OTA (protégées par token API)
Route::prefix('ota')->middleware('api.token')->group(function () {
    // Récupère la dernière version disponible
    Route::get('/lastversion', [OtaController::class, 'lastversion'])->name('ota.lastversion');

    // Vérifie si une mise à jour est disponible
    Route::get('/check-update', [OtaController::class, 'checkUpdate'])->name('ota.check');

    // Télécharge une version spécifique
    Route::get('/download/{identifier}/{version}', [OtaController::class, 'download'])->name('ota.download');
});

// Routes protégées pour l'administration (à protéger avec authentication)
Route::prefix('admin/ota')->group(function () {
    // Upload une nouvelle version
    Route::post('/upload', [OtaController::class, 'upload'])->name('ota.upload');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgencyController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Routes protégées (connexion obligatoire)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('customers', CustomerController::class);

    Route::resource('packages', PackageController::class);

    Route::resource('agencies', AgencyController::class);

    Route::get('/agencies/{agency}/select', [AgencyController::class, 'select'])
        ->name('agencies.select');

    Route::get('/packages/{package}/receipt', [PackageController::class, 'receipt'])
        ->name('packages.receipt');

});

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/{agency:slug}/track', [PackageController::class, 'trackForm'])
    ->name('packages.track.form');

Route::post('/{agency:slug}/track', [PackageController::class, 'trackSearch'])
    ->name('packages.track.search');

Route::get('/{agency:slug}/track/{tracking_number}', [PackageController::class, 'track'])
    ->name('packages.track');

require __DIR__.'/settings.php';
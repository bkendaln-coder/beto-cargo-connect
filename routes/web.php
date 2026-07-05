<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('customers.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('customers', CustomerController::class);

Route::resource('packages', PackageController::class);

Route::get('/packages/{package}/receipt', [PackageController::class, 'receipt'])
    ->name('packages.receipt');

Route::get('/track/{tracking_number}', [PackageController::class, 'track'])
    ->name('packages.track');

Route::get('/track', [PackageController::class, 'trackForm'])
    ->name('packages.track.form');

Route::post('/track', [PackageController::class, 'trackSearch'])
    ->name('packages.track.search');
    
require __DIR__.'/settings.php';

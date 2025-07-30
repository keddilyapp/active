
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Central\TenantController;
use App\Http\Controllers\Central\DashboardController;

Route::group(['prefix' => 'central', 'as' => 'central.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/register', [TenantController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [TenantController::class, 'register'])->name('register.store');
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/{tenant}', [TenantController::class, 'show'])->name('tenants.show');
    Route::put('/tenants/{tenant}/status', [TenantController::class, 'updateStatus'])->name('tenants.status');
    Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');
});

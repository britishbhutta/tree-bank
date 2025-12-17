<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

//Admin
Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__.'/admin_auth.php';
});

// Frontend homepage
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

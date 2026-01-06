<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontEnd\ContactUsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Admin
Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__.'/admin_auth.php';
});

// Frontend homepage
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/react', [DashboardController::class, 'react'])->name('react');
Route::post('/storeContactUs',[ContactUsController::class,'store'])->name('storeContactUs');


Route::view('/{any}', 'app')->where('any', '.*');
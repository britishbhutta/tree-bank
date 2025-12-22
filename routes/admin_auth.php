<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\WorkshopController;
use App\Http\Controllers\Admin\DonationController;
use Illuminate\Support\Facades\Route;

// Guest admin routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'store']);
});

// Authenticated admin routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // projects
    Route::get('projects/create',[ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects',[ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/{project}/edit',[ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/{project}',[ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}',[ProjectController::class, 'destroy'])->name('projects.destroy');

    // Workshop
    Route::get('workshop', [WorkshopController::class, 'index'])->name('workshop.index');
    Route::get('workshop/create', [WorkshopController::class, 'create'])->name('workshop.create');
    Route::post('workshop/store', [WorkshopController::class, 'store'])->name('workshop.store');
    Route::get('workshop/{workshop}/edit', [WorkshopController::class, 'edit'])->name('workshop.edit');
    Route::put('workshop/{workshop}', [WorkshopController::class, 'update'])->name('workshop.update');
    Route::delete('workshop/{workshop}', [WorkshopController::class, 'destroy'])->name('workshop.destroy');

    // Donation
    Route::get('donation', [DonationController::class,'index'])->name('donation.index');
    Route::get('donation/create', [DonationController::class,'create'])->name('donation.create');
    Route::post('donation/store', [DonationController::class,'store'])->name('donation.store');
    Route::get('donation/{donation}/edit', [DonationController::class,'edit'])->name('donation.edit');
    Route::put('donation/{donation}', [DonationController::class,'update'])->name('donation.update');
    Route::delete('donation/{donation}', [DonationController::class,'destroy'])->name('donation.destroy');

    Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
});

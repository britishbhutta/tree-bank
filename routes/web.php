<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontEnd\ContactUsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Frontend homepage

Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__.'/admin_auth.php';
});

require __DIR__.'/auth.php';

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/react', [DashboardController::class, 'react'])->name('react');
Route::post('/storeContactUs',[ContactUsController::class,'store'])->name('storeContactUs');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/', fn () => Inertia::render('Home'))->name('home');
// Route::get('/about', fn () => Inertia::render('About'))->name('about');
// Route::get('/projects', fn () => Inertia::render('Projects'))->name('projects');
// Route::get('/register', fn () => Inertia::render('Auth/Register'))->name('register');
// Route::get('/login', fn () => Inertia::render('Auth/Login'))->name('login');

Route::view('/{any}', 'app')->where('any', '.*');
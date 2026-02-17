<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontEnd\ContactUsController;
use App\Http\Controllers\FrontEnd\FrontEndCountController;
use App\Http\Controllers\FrontEnd\FrontEndTreeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\TreeController;
use App\Http\Controllers\Admin\TreeNameController;




use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Admin Routes

$currentPrefix = request()->segment(1);
if($currentPrefix == 'admin'){
    // Route::get('tree/create', [TreeController::class,'create'])->name('trees.create');
    
    Route::prefix('admin')->group(function () {
        
        require __DIR__.'/admin_auth.php';
    });
}

require __DIR__.'/auth.php';

// Front End Manage Donations and Trees
if($currentPrefix == 'my'){
    Route::prefix('my')->middleware('frontEndAuth')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        // Donation
        Route::get('donation', [DonationController::class,'index'])->name('donation.index');
        Route::get('donation/create', [DonationController::class,'create'])->name('donation.create');
        Route::post('donation/store', [DonationController::class,'store'])->name('donation.store');
        Route::get('donation/{donation}/edit', [DonationController::class,'edit'])->name('donation.edit');
        Route::put('donation/{donation}', [DonationController::class,'update'])->name('donation.update');
        Route::delete('donation/{donation}', [DonationController::class,'destroy'])->name('donation.destroy');

        // Tree Name
        Route::get('tree-names/{type_id}', [TreeNameController::class, 'availableTreeNames']);

        // Tree
        Route::get('tree/create', [TreeController::class,'create'])->name('trees.create');
        Route::post('tree/store', [TreeController::class,'store'])->name('trees.store');
        Route::get('/trees', [TreeController::class, 'index'])->name('trees.index');
        Route::get('trees/{tree}', [TreeController::class, 'show'])->name('trees.show');
        Route::put('trees/{tree}', [TreeController::class, 'update'])->name('trees.update');
        Route::get('/reverse-geocode', [TreeController::class, 'reverseGeocode']);

        // update photos
        Route::delete('photos/{id}', [TreeController::class,'deletePhoto'])->name('photos.delete');
        Route::post('admin/trees/{tree}/photos', [TreeController::class, 'uploadPhotos'])->name('trees.uploadPhotos');

    });
}

//Front End React Routes
// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [DashboardController::class, 'react'])->name('react');
Route::post('/storeContactUs',[ContactUsController::class,'store'])->name('storeContactUs');

//Count
Route::middleware('frontEndAuth')->group(function(){
    Route::get('myTreesCount', [FrontEndCountController::class, 'myTreesCount']);
});
Route::get('counts', [FrontEndCountController::class, 'Counts']);


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
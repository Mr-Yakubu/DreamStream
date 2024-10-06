<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringLogController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ParentalControlController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RoleSelectionController;

/*
|-------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
| 
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/choose-role', [RegisterController::class, 'chooseRoleForm'])->name('choose.role');
Route::post('/choose-role', [RegisterController::class, 'chooseRoleSubmit'])->name('choose.role.submit');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('home', [HomeController::class, 'index'])->name('home'); // Your home controller
Route::get('/choose-role', [RoleSelectionController::class, 'showRoleSelectionForm'])->name('choose.role');
Route::post('/choose-role', [RoleSelectionController::class, 'chooseRole'])->name('choose.role.submit');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    
    Route::resource('media', MediaController::class); // Automatically generates routes for index, create, store, show, edit, update, and destroy
    
    // Comments, Recommendations, and Parental Controls
    Route::resource('comments', CommentController::class);
    Route::resource('recommendations', RecommendationController::class);
    Route::resource('parental-controls', ParentalControlController::class);
    
    Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.player');
});

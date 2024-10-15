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
use App\Http\Controllers\FavoritesController;



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


// Media Routes
Route::get('/media', [MediaController::class, 'index'])->name('media.index'); // For displaying media
Route::get('/media/create', [MediaController::class, 'create'])->name('media.create'); // For uploading media

// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Admin dashboard


// Video routes
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.player');
Route::post('/video/upload', [VideoController::class, 'store'])->name('videos.store');
Route::put('/video/{id}', [VideoController::class, 'update'])->name('videos.update');
Route::delete('/video/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');
Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('videos.edit');
Route::get('/edit_upload', [VideoController::class, 'editUpload'])->name('edit_upload');
Route::post('/favorites/add/{videoId}', [FavoritesController::class, 'add'])->name('favorites.add');



// Comments, Recommendations, and Parental Controls
Route::resource('comments', CommentController::class);
Route::resource('recommendations', RecommendationController::class);
Route::resource('parental-controls', ParentalControlController::class);
    
Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.player');
});

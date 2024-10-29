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
use App\Http\Controllers\VideoFilterController;

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

// home controller
Route::get('home', [HomeController::class, 'index'])->name('home'); 
Route::get('/choose-role', [RoleSelectionController::class, 'showRoleSelectionForm'])->name('choose.role');
Route::post('/choose-role', [RoleSelectionController::class, 'chooseRole'])->name('choose.role.submit');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


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
Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
Route::delete('/favorites/remove/{videoId}', [FavoritesController::class, 'remove'])->name('favorites.remove');
Route::post('/video/{video}/like', [VideoController::class, 'likeVideo']);
Route::post('/video/{video}/dislike', [VideoController::class, 'dislikeVideo']);
Route::post('/video/{id}/view', [VideoController::class, 'incrementViewCount']);
Route::delete('/favorites/remove/{id}', [FavoritesController::class, 'remove'])->name('favorites.remove');
Route::post('/videos/store', [VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/store', [VideoController::class, 'store'])->name('video.store');

// AI Filter
Route::get('/filter-videos', [VideoController::class, 'filterVideos']);




// Comments, Recommendations, and Parental Controls
Route::resource('comments', CommentController::class);
Route::post('/video/{video}/comment', [CommentController::class, 'store']);


Route::resource('recommendations', RecommendationController::class);
Route::resource('parental-controls', ParentalControlController::class);
    
Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.player');
});

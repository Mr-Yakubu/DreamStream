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
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ChannelController;



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
Route::get('/parental-controls', [ParentalControlController::class, 'index'])->name('parental_controls.index');

// Search Results
Route::get('/search', [VideoController::class, 'search'])->name('search');
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');


// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Admin dashboard

// Settings Routes
Route::get('/user/account/info', [UserController::class, 'getAccountInfo'])->name('user.account.info');
Route::post('/user/update/username', [UserController::class, 'updateUsername'])->name('user.update.username');

// Upload History

Route::get('/user/upload/history', [UserController::class, 'getUploadHistory'])->name('user.upload.history');

// Video routes
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.player');

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

// Videos - Store
Route::post('/videos', [VideoController::class, 'store'])->name('video.store');


// Videos Popular
Route::get('/popular', [VideoController::class, 'popular'])->name('popular');

// Channels
Route::get('/channels', [ChannelController::class, 'showChannels'])->name('channels');
Route::get('/channels/{id}', [ChannelController::class, 'show'])->name('channel.show');

// AI Filter
Route::get('/filter-videos', [VideoController::class, 'filterVideos']);

// Parental Controls


Route::get('parental-controls/{childUserId}', [ParentalControlController::class, 'show'])->name('parental_controls.show');


Route::put('/parental-controls/{childUserId}/update', [ParentalControlController::class, 'update'])->name('parental_controls.update');
Route::get('/parent-dashboard', [ParentalControlController::class, 'index'])->name('parent_dashboard');


// Route to show parent dashboard with child accounts
Route::get('/parent-dashboard', [ParentalControlController::class, 'parentDashboard'])
    ->middleware('auth')
    ->name('parent_dashboard');

// Route to show parental controls for a specific child
Route::get('/parental-controls/{childUserId}', [ParentalControlController::class, 'show'])
    ->name('parental_controls.show');

// Route to update parental controls for a specific child
Route::put('/parental-controls/{childUserId}', [ParentalControlController::class, 'update'])
    ->name('parental_controls.update');


// Route to show the list of children accounts (for a parent) to select which one to manage
Route::get('/parental-controls', [ParentalControlController::class, 'index'])
    ->middleware('ensureUserIsParent') // Ensure the user is a parent before accessing this page
    ->name('parental_controls.index');

    Route::get('/parental-controls/{childUserId}', [ParentalControlController::class, 'show'])
    ->middleware('ensureUserIsParent')
    ->name('parental_controls.show');


// Comments, Recommendations, and Parental Controls
Route::resource('comments', CommentController::class);
Route::post('/video/{video}/comment', [CommentController::class, 'store']);

// Settings

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

Route::resource('recommendations', RecommendationController::class);
Route::resource('parental-controls', ParentalControlController::class);
    
Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.player');
});

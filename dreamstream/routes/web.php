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


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('media', MediaController::class); // Automatically generates routes for index, create, store, show, edit, update, and destroy

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/video-player', [VideoController::class, 'show'])->name('video.player');





// Comments, Recommendations, and Parental Controls
Route::resource('comments', CommentController::class);
Route::resource('recommendations', RecommendationController::class);
Route::resource('parental-controls', ParentalControlController::class);

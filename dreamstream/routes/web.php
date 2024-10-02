<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MonitoringLogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ParentalControlController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});
Route::resource('users', UserController::class);
Route::resource('media', MediaController::class);
Route::resource('logs', MonitoringLogController::class);
Route::resource('comments', CommentController::class);
Route::resource('recommendations', RecommendationController::class);
Route::resource('parental-controls', ParentalControlController::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringLogController;
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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;



/*
|-------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
| 
*/

// Redirect root URL to the login page
Route::get('/', function () {
    return redirect()->route('home');
})->name('landing');

// Public Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/landing-page', function () {
    return view('landing-page');
})->name('landing-page');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Mail
Route::post('/send-welcome-email', [EmailController::class, 'sendWelcomeEmail'])->name('send.welcome.email');

// Password Reset routes 

// Show Forgot Password Form
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');

// Handle Forgot Password Submission
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot-password.submit');

// Show Reset Password Form
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');

// Handle Reset Password Submission
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.submit');





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
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
Route::get('/admin/edit-video/{id}', [AdminController::class, 'editVideo'])->name('admin.editVideo');
Route::delete('/videos/{id}', [AdminController::class, 'deleteVideo'])->name('admin.deleteVideo');
Route::put('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.updateUser');



// Settings Routes
Route::get('/user/account/info', [UserController::class, 'getAccountInfo'])->name('user.account.info');
Route::post('/user/update/username', [UserController::class, 'updateUsername'])->name('user.update.username');
Route::get('/user/{userId}/settings', [SettingsController::class, 'showUserChannelInfo']);


// Route to display the user activity logs
Route::get('/user-activity', [MonitoringLogController::class, 'showUserActivity'])->name('user.activity');

// Route to log a new user activity (for example, after uploading a video)
Route::post('/log-activity', [MonitoringLogController::class, 'logActivity'])->name('log.activity');
Route::get('/user-activity', [MonitoringLogController::class, 'showUserActivity'])->name('user.activity');



// Route for the settings page
Route::get('/settings', [UserController::class, 'settingsPage'])->name('settings');

// Route for fetching uploaded videos of the authenticated user
Route::get('/user/uploaded/videos', [UserController::class, 'getUploadedVideos'])->name('user.uploaded.videos');

// Route for deleting a video
Route::delete('/user/delete/video/{videoId}', [UserController::class, 'deleteVideo'])->name('user.delete.video');

// Parental controls report 
Route::get('/parent/dashboard', [ParentalControlController::class, 'index'])->name('parent_dashboard');
Route::get('/parent/child/{childUserId}/activity-report', [ParentalControlController::class, 'childActivityReport'])->name('child_activity_report');
Route::get('/parent/child/{childUserId}/performance-report', [ParentalControlController::class, 'childPerformanceReport'])->name('child_performance_report');





// Upload History

Route::get('/user/upload/history', [UserController::class, 'getUploadHistory'])->name('user.upload.history');
Route::get('/user/upload-history', [UserController::class, 'getUploadHistory'])->name('upload.history');


// Fix video upload!!!!! 

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
Route::post('/videos/videos', [VideoController::class, 'store'])->name('video.store');
// Route for handling video uploads
Route::post('/videos/store', [VideoController::class, 'store'])->name('videos.store');






// Videos Popular
Route::get('/popular', [VideoController::class, 'popular'])->name('popular');

// Channels
Route::get('/channels', [ChannelController::class, 'showChannels'])->name('channels');
Route::get('/channels/{id}', [ChannelController::class, 'show'])->name('channel.show');

// AI Filter
Route::get('/filter-videos', [VideoController::class, 'filterVideos']);

// Parental Controls


Route::get('parental-controls/{childUserId}', [ParentalControlController::class, 'show'])->name('parental_controls.show');
Route::get('parental-controls/{childUserId}', [ParentalControlController::class, 'showParentalControls'])->name('parental_controls.show');
Route::delete('/parent/delete-child/{id}', [ParentalControlController::class, 'deleteChildAccount'])->name('deleteChildAccount');
 


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



Route::get('/settings/manage-videos', [SettingsController::class, 'showManageVideos'])->name('settings.manage-videos');





// Comments, Recommendations, and Parental Controls
Route::resource('comments', CommentController::class);
Route::post('/video/{video}/comment', [CommentController::class, 'store']);
Route::post('/video/{video}/comments', [CommentController::class, 'store'])->name('comments.store');

// Settings

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Profile Picture
Route::get('/profile/update-picture', [ProfileController::class, 'showUpdatePictureForm'])->name('profile.picture.form');
Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');

Route::resource('recommendations', RecommendationController::class);
Route::resource('parental-controls', ParentalControlController::class);
    
Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.player');
});

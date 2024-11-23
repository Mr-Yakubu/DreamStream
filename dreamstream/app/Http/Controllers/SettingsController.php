<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function settings()
{
    $userId = auth()->id();

     $videos = Video::where('uploaded_by', $userId)->get();
     
    return view('settings', compact('videos')); 
}
    // Display the Settings Page
    public function index()
    {
        return view('settings');
    }

    public function showManageVideos()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to manage videos.');
        }

        // Fetch videos uploaded by the authenticated user
        $userVideos = Video::where('uploaded_by', auth()->id())->get();

        // Handle case where no videos are found
        if ($userVideos->isEmpty()) {
            return view('manage-videos', ['message' => 'You have not uploaded any videos yet.']);
        }

        // Pass the videos to the view
        return view('manage-videos', compact('userVideos'));
    }


    public function showUserChannelInfo($userId)
{
    // Retrieve the user based on their ID
    $user = User::findOrFail($userId); 

    // Get the number of videos uploaded by the user using query builder
    $statistics = DB::table('videos')
        ->select(DB::raw('COUNT(*) as num_of_videos, SUM(views) as total_views, SUM(likes) as total_likes'))
        ->where('uploaded_by', $userId)
        ->first();

    // Handle the case where no videos exist for the user
    $numOfVideos = $statistics ? $statistics->num_of_videos : 0;
    $totalViews = $statistics ? $statistics->total_views : 0;
    $totalLikes = $statistics ? $statistics->total_likes : 0;

    // Debugging output
    dd($numOfVideos, $totalViews, $totalLikes);

    // Explicitly pass variables to the view
    return view('settings')->with([
        'user' => $user,
        'numOfVideos' => $numOfVideos,
        'totalViews' => $totalViews,
        'totalLikes' => $totalLikes,
    ]);
}


    public function showDashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }

        // Eager load uploads while fetching user
        $user = User::with('uploads')->find($user->id);

        // Get the number of videos uploaded by the user
        $videosUploaded = Video::where('uploaded_by', $user->id)->get();
        $numOfVideos = $videosUploaded->count();

        // If no videos uploaded, set a default value for videosUploaded
        if ($numOfVideos === 0) {
            $videosUploaded = 'No videos uploaded yet';  // Default message if no videos
        }

        // Pass user and videos data to the dashboard view
        return view('dashboard', compact('user', 'numOfVideos', 'videosUploaded'));
    }
}
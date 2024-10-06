<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($id)
    {
        // Retrieve the video by its ID along with the user who uploaded it
        $video = Video::with('user')->findOrFail($id);

        // Fetch upcoming videos (excluding the current video)
        $upcomingVideos = Video::where('id', '!=', $video->id)
                                ->orderBy('created_at', 'desc')
                                ->take(5) // Get the top 5 upcoming videos
                                ->get();

        // Return the view with both the video and upcoming videos
        return view('videoplayer', compact('video', 'upcomingVideos')); 
    }
}


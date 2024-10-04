<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show(Request $request)
    {
        $video_id = $request->query('video_id');
        
        // Fetch video details based on the $video_id
        // For example:
        // $video = Video::find($video_id); // Assuming you have a Video model

        return view('videoplayer', compact('video_id')); // Pass video ID to the view
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Video; 

class HomeController extends Controller
{
    public function index()
    {
        $videos = Video::all();  // Fetch all video records from the database
        return view('home', compact('videos'));
    }
    public function getHomePageVideos($userId)
{
    // Fetch videos based on the parental control of the child user
    $videos = Video::filterVideosByParentalControl($userId)->get();

    return view('home', compact('videos'));
}

    public function getRestrictedKeywordsAttribute($value)
    {
        return json_decode($value, true); // Decode the JSON stored in the database into an array
    }

}


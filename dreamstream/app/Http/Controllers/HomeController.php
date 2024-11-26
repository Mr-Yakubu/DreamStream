<?php

namespace App\Http\Controllers;
use App\Models\ParentalControl;
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

    public function showVideos()
{
    // Fetch all videos from the database
    $videos = Video::all();

    // Filter videos using the function
    $filteredVideos = $this->filterVideosWithRestrictedKeywords($videos);

    // Pass filtered videos to the view
    return view('home', ['videos' => $filteredVideos]);
}

    private function filterVideosWithRestrictedKeywords($videos)
    {
        $restrictedKeywords = ParentalControl::first()->restricted_keywords;
        $keywords = explode(',', $restrictedKeywords);

        if (auth()->user()->user_type == 'child') {
            // Filter out videos based on restricted keywords
            $filteredVideos = $videos->filter(function ($video) use ($keywords) {
                foreach ($keywords as $keyword) {
                    if (strpos($video->tags, trim($keyword)) !== false) {
                        return false; // Exclude this video if any of the restricted keywords match
                    }
                }
                return true; // Include video if no match found
            });

            return $filteredVideos;
        }

        return $videos; // Return all videos if the user is not a child
    }

}


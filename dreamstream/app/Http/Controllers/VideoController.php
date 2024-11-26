<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentalControl;
use App\Models\User;
use App\Models\Comment;
use App\Models\MonitoringLog;
use FFMpeg\FFMpeg;

class VideoController extends Controller
{

    public function showUserChannelInfo($userId)
{
    // Retrieve the user based on their ID
    $user = User::findOrFail($userId);

    // Get all videos uploaded by the user (adjust according to your relationships and table structure)
    $videosUploaded = Video::where('uploaded_by', $userId)->get();

    // Define the variables you need to pass to the view
    $numOfVideos = $videosUploaded->count(); // Count of uploaded videos
    $totalViews = $videosUploaded->sum('views'); // Sum of the 'views' column from videos
    $totalLikes = $videosUploaded->sum('likes'); // Sum of the 'likes' column from videos

    // Pass these variables to the Blade view
    return view('settings', compact('numOfVideos', 'totalViews', 'totalLikes'));

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


// Restricted Keywords 

public function getRestrictedKeywordsAttribute($value)
{
    return json_decode($value, true); // Decode the JSON stored in the database into an array
}



    // Show the list of all videos
    public function index()
    {
        // Check if the logged-in user is a child
        if (auth()->user()->user_type == 'child') {
            // Retrieve parental control settings for this user
            $parentRestrictedSettings = ParentalControl::where('user_id', auth()->id())->first();
    
            // Check if parental controls exist for the child user
            if (!$parentRestrictedSettings) {
                // No parental control settings, return all videos (or handle as needed)
                $videos = Video::all();
            } else {
                // Get the age limit set by the parent for this user
                $ageLimit = $parentRestrictedSettings->age_limit;
    
                // Filter videos based on the age suitability and the user's age limit
                $videos = Video::where('age_suitability', '<=', $ageLimit)->get();
            }
        } else {
            // If the user is not a child, return all videos
            $videos = Video::all();
        }
    
        // Return the homepage view with the filtered list of videos
        return view('home', compact('videos'));
    }
    
    
    




    public function getUploadHistory()
{
    $userId = Auth::id();
    $latestVideos = Video::where('uploaded_by', $userId)
        ->latest()
        ->take(2)
        ->get();

    return response()->json($latestVideos);
}


    // Show the videos uploaded by the logged-in user
    public function showMyVideos($userId)
    {
        $user = User::findOrFail($userId);
        $user = User::findOrFail($userId);
        $myVideos = $user->videos;
        $userId = auth()->id();

        return view('video.edit', compact('myVideos')); 
    }




    public function showManageVideos()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to manage videos.');
        }

        // Fetch videos uploaded by the authenticated user
        $userVideos = Video::where('uploaded_by', auth()->id())->get();
        dd($userVideos);

        // Handle case where no videos are found
        if ($userVideos->isEmpty()) {
            return view('manage-videos', ['message' => 'You have not uploaded any videos yet.']);
        }

        // Pass the videos to the view
        return view('manage-videos', compact('userVideos'));
    }





    // Show the video player and upcoming videos
    public function show($id)
    {
        // Retrieve the video by its ID along with the user who uploaded it
        $video = Video::with('user')->find($id);

        // Fetch upcoming videos (excluding the current video)
        $upcomingVideos = Video::where('id', '!=', $video->id)
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        return view('videoplayer', compact('video', 'upcomingVideos')); 

        $video = Video::findOrFail($id);  // Get the video by its ID
    
        // Fetch comments or set to empty collection if none are found
        $comments = Comment::where('video_id', $id)->get(); 
    
        return view('video-player', compact('video', 'comments'));  // Pass comments (even empty)
    
    }






    // Search for videos by title
    public function search(Request $request)
{
    // Validate the search query
    $query = $request->input('query');

    // Build the query, searching by both title and tags
    $videos = Video::where('title', 'LIKE', '%' . $query . '%')
        ->orWhere('tags', 'LIKE', '%' . $query . '%')
        ->get();

    return view('search_results', compact('videos', 'query'));
}

    

    // Show the settings page for videos
    public function settings()
    {
        // Fetch the videos for the logged-in user
        $videos = Video::where('user_id', auth()->id())->get(); 

        return view('settings', compact('videos'));
    }



    // Show the popular videos page
    public function popular()
    {
        // Fetch popular videos ordered by views in descending order
        $popularVideos = Video::orderBy('views', 'desc')->get();

        return view('popular', compact('popularVideos'));
    }







    // Show the edit/upload video page
    public function editUpload()
    {
        return view('videos');
    }




    // Like a video
    public function likeVideo($id)
{
    // Find the video
    $video = Video::findOrFail($id); 

    // Increment the likes count for the video
    $video->likes++;
    $video->save(); 

    // Return the updated likes count as a response
    return response()->json(['likes' => $video->likes]);
    }





    // Dislike a video
    public function dislikeVideo($id)
    {
        $video = Video::findOrFail($id); 
        $video->dislikes++; 
        $video->save();

        return response()->json(['dislikes' => $video->dislikes]); 
    }




    // Increment view count for a video
    public function incrementViewCount($id)
    {
        $userId = auth()->user()->id;

        // Initialize a 'viewed_videos' session array if it doesn't exist
        if (!session()->has("viewed_videos.{$userId}")) {
            session(["viewed_videos.{$userId}" => []]);
        }

        $viewedVideos = session("viewed_videos.{$userId}");
        
        if (!in_array($id, $viewedVideos)) {
            $video = Video::find($id);
            $video->increment('views');
            session()->push("viewed_videos.{$userId}", $id);
        }

        return response()->json(['success' => true]);
    }

    // Store a new video
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'video_file' => 'required|mimes:mp4,avi,mov|max:20480',
        'tags' => 'nullable|string|max:500',
        'suited_age' => 'required|integer|min:0', // Validation for the new age suitability field
    ]);

    try {
        if ($request->hasFile('video_file')) {
            // Store the video file
            $filePath = $request->file('video_file')->store('videos/videos', 'public');

            // Retrieve the user information
            $user = auth()->user();
            
            // Create the video entry
            $video = Video::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file_path' => $filePath,
                'user_id' => $user->id,
                'tags' => $request->input('tags'),  // string 
                'uploaded_by' => $user->id, // Use username if it's available
                'age_suitability' => $request->input('suited_age'), // Save the age suitability to the database
                'url' => null, // Set URL to null initially, will be generated later.
            ]);

            // Generate the URL for the video after upload
            $video->url = $this->generateVideoUrl($filePath);

            // Generate the thumbnail for the uploaded video
            try {
                $thumbnailPath = $video->generateThumbnail($filePath);  // Generate thumbnail
                $video->thumbnail = $thumbnailPath;  // Save thumbnail path in the database (use 'thumbnail' instead of 'thumbnail_path')
            } catch (\Exception $e) {
                logger()->error('Thumbnail generation failed', ['error' => $e->getMessage()]);
                // Optionally, set a default thumbnail if generation fails
                $video->thumbnail = 'default-thumbnail.jpg';
            }

            // Save the video with the generated URL and thumbnail
            $video->save();

            return redirect()->route('edit_upload')->with('success', 'Video uploaded successfully!');
        }

        return redirect()->back()->with('error', 'Video upload failed. No file received.');
    } catch (\Exception $e) {
        // Log the error and debug the issue
        logger()->error('Video upload failed', ['error' => $e->getMessage()]);
        dd('Exception caught:', $e->getMessage(), $e->getTrace());
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}

    protected function generateVideoUrl($filePath)
    {
        // Assuming the URL is based on the file path, e.g., generate a URL from the file's public location
        return asset('storage/' . $filePath); // or any custom URL generation logic
    }


    // Fetch videos that are marked as favorites by the user
    public function fetchChildWatchedVideos()
    {
        $videos = Video::whereIn('id', function ($query) {
            $query->select('video_id')
                  ->from('watch_history')
                  ->where('user_id', Auth::id());
        })
        ->get();

        return view('child_watched_videos', compact('videos'));
    }
}

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






    // Show the list of all videos
    public function index()
    {
        // Fetch all videos from the database
        $videos = Video::all();
    
        // Check if the logged-in user is a child
        if (auth()->user()->user_type == 'child') {
            // Retrieve parental control settings for this user
            $parentRestrictedKeywords = ParentalControl::where('user_id', auth()->id())->first();
    
            if ($parentRestrictedKeywords) {
                // Decode the restricted keywords (ensure it is a valid JSON format)
                $restrictedKeywords = json_decode($parentRestrictedKeywords->restricted_keywords, true);
    
                if (is_array($restrictedKeywords)) {
                    // Filter out videos with any of the restricted keywords in the tags
                    $videos = $videos->filter(function ($video) use ($restrictedKeywords) {
                        // Loop through each restricted keyword
                        foreach ($restrictedKeywords as $keyword) {
                            // Check if the keyword exists in the video's tags
                            if (stripos($video->tags, $keyword) !== false) {
                                return false; // Exclude this video if the keyword is found
                            }
                        }
                        return true; // Include the video if no keyword matches
                    });
                }
            }
        }
    
        // Return the homepage view with the filtered list of videos
        return view('home', compact('videos'));
    }






    // Show the videos uploaded by the logged-in user
    public function showMyVideos()
    {

        $userId = auth()->id();

        // Fetch videos where the uploaded_by field matches the current authenticated user's ID
        
        $myVideos = Video::where('uploaded_by', $userId)->get();

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
        $videos = Video::where('title', 'LIKE', '%' . $query . '%')->get();

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



    // Generate a thumbnail for a video
    private function generateThumbnail($videoPath)
    {
        $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';

        // Execute FFmpeg command to create a thumbnail
        $ffmpegCommand = "ffmpeg -i " . storage_path('app/' . $videoPath) . " -ss 00:00:01.000 -vframes 1 " . storage_path('app/' . $thumbnailPath);
        exec($ffmpegCommand);

        return $thumbnailPath;
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

    // Log the activity in the monitoring_logs table
    $child = auth()->user(); // Get the currently logged-in child user
    MonitoringLog::create([
        'action' => 'Liked Video', // Action the user took
        'details' => 'Liked video with ID: ' . $video->id, // Details about the action
        'user_id' => $child->id, // The child user who performed the action
        'timestamp' => now(), // The current timestamp when the action occurred
    ]);

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
        ]);
    
        try {
            if ($request->hasFile('video_file')) {
                // Store the video file
                $filePath = $request->file('video_file')->store('videos/videos', 'public');
    
                // Retrieve the user information
                $user = auth()->user();
                $uploadedBy = $user->username ?? null;  // Set username if available, otherwise null

    
                // Create the video entry, including the 'uploaded_by' field if it's available
                $video = Video::create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'file_path' => $filePath,
                    'user_id' => $user->id,
                    'tags' => $request->input('tags'),  // string 
                    'uploaded_by' => $uploadedBy, // Use username if it's available
                    'url' => null, // Set URL to null initially, will be generated later.
                ]);
    
                // Generate the URL for the video after upload
                $video->url = $this->generateVideoUrl($filePath);
    
                // Save the video with the generated URL
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

    // Filter videos based on restricted keywords for child users
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

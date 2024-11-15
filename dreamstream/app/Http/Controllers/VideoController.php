<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentalControl;
use App\Models\User;
use FFMpeg\FFMpeg;

class VideoController extends Controller
{
    // Show the list of all videos
    public function index()
{
    $videos = Video::all();

    if (auth()->user()->user_type == 'child') {
        $parentRestrictedKeywords = ParentalControl::where('user_id', auth()->id())->first();
        
        if ($parentRestrictedKeywords) {
            $restrictedKeywords = json_decode($parentRestrictedKeywords->restricted_keywords);

            $videos = $videos->filter(function ($video) use ($restrictedKeywords) {
                foreach ($restrictedKeywords as $keyword) {
                    if (stripos($video->tags, $keyword) !== false) {
                        return false; // Exclude this video if any keyword is found
                    }
                }
                return true; // Include this video if no restricted keyword is found
            });
        }
    }

    return view('videos.index', compact('videos'));
}

    // Show the videos uploaded by the logged-in user
    public function showMyVideos()
    {
        // Fetch videos where the uploaded_by field matches the current authenticated user's ID
        $myVideos = Video::where('uploaded_by', auth()->id())->get();

        return view('video.edit', compact('myVideos')); 
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
        $video = Video::findOrFail($id); 
        $video->likes++;
        $video->save(); 

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
                'tags' => $request->input('tags'),
                'uploaded_by' => $uploadedBy, // Use username if it's available
                'url' => null, // Set URL to null initially
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

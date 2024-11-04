<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use FFMpeg\FFMpeg;

class VideoController extends Controller
{
    // Show the video player and upcoming videos
    public function show($id)
    {
        // Retrieve the video by its ID along with the user who uploaded it
        $video = Video::with('user')->find($id);

        // Fetch upcoming videos (excluding the current video)
        $upcomingVideos = Video::where('id', '!=', $video->id)
                                ->orderBy('created_at', 'desc')
                                ->take(5) // Get the top 5 upcoming videos
                                ->get();

        // Return the view with both the video and upcoming videos
        return view('videoplayer', compact('video', 'upcomingVideos')); 
    }

    public function search(Request $request)
{
    // Validate the search query to ensure it’s not empty or malicious
    $query = $request->input('query');

    // Search for videos where the title contains the query
    $videos = Video::where('title', 'LIKE', '%' . $query . '%')->get();

    // Pass the search results to the view
    return view('search_results', compact('videos', 'query'));
}

    public function settings()
{
    // Fetch the videos for the logged-in user or all videos as needed
    $videos = Video::where('user_id', auth()->id())->get(); // Adjust according to your model and relationship

    return view('settings', compact('videos'));
}
    public function popular()
{
    // Fetch videos ordered by views in descending order
    $popularVideos = Video::orderBy('views', 'desc')->get();

    // Pass the videos to the view
    return view('popular', compact('popularVideos'));
}


private function generateThumbnail($videoPath)
{
    $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg'; // Define the thumbnail path

    // Execute FFmpeg command to create a thumbnail
    $ffmpegCommand = "ffmpeg -i " . storage_path('app/' . $videoPath) . " -ss 00:00:01.000 -vframes 1 " . storage_path('app/' . $thumbnailPath);
    exec($ffmpegCommand);

    return $thumbnailPath; // Return the path to the generated thumbnail
}

    // Show the edit/upload video page
    public function editUpload()
    {
        return view('videos'); 
    }

    public function likeVideo($id)
    {
        $video = Video::findOrFail($id); 
        $video->likes++;
        $video->save(); 

        return response()->json(['likes' => $video->likes]); 
    }

    public function dislikeVideo($id)
    {
        $video = Video::findOrFail($id); 
        $video->dislikes++; 
        $video->save();

        return response()->json(['dislikes' => $video->dislikes]); 
    }

    public function incrementViewCount($id)
{
    $userId = auth()->user()->id;

    // Initialize a 'viewed_videos' session array if it doesn't exist
    if (!session()->has("viewed_videos.{$userId}")) {
        session(["viewed_videos.{$userId}" => []]);
    }
    // Retrieve the array of videos the user has viewed in this session
    $viewedVideos = session("viewed_videos.{$userId}");
    // Only increment if the video ID is not in the user's viewed session array
    if (!in_array($id, $viewedVideos)) {
        $video = Video::find($id);
        $video->increment('views');

        session()->push("viewed_videos.{$userId}", $id);
    }
    return response()->json(['success' => true]);
}


    public function store(Request $request)
    {
        // Validate the video details
        $request->validate([
            'channel_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_file' => 'required|mimes:mp4,mov,ogg,qt|max:20000', 
        ]);
    
        // Handle file upload
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $path = $file->store('Videos', 'public'); // Store video in 'Videos' directory in 'public' disk
    
            // Check if path is not empty
            if (!$path) {
                return redirect()->back()->withErrors(['video_file' => 'Video upload failed.']);
            }
    
            // Extract the video duration using FFmpeg
            $ffmpeg = FFMpeg::create();
            $videoFile = $ffmpeg->open(storage_path('app/public/' . $path)); 
            $durationInSeconds = $videoFile->getFormat()->get('duration'); // Extract duration in seconds
    
            // Convert duration to a human-readable format (optional)
            $durationFormatted = gmdate('H:i:s', $durationInSeconds);
    
            // Create new video record in the database
            $video = new Video();
            $video->channel_name = $request->channel_name;
            $video->title = $request->title;
            $video->description = $request->description;
            $video->url = $path;
            $video->user_id = auth()->id(); 
            $video->uploaded_by = auth()->id(); 
            $video->duration = $durationFormatted; 
            $video->save();
    
            // Save the video and check if it was successful
            if ($video->save()) {
                return redirect()->route('home')->with('success', 'Video uploaded successfully!');
            } else {
                return redirect()->back()->withErrors(['db' => 'Video could not be saved to the database.']);
            }
        }
    
        return redirect()->back()->withErrors(['video_file' => 'No video file found.']);
    }

    // Edit an existing video
    public function update(Request $request, $id)
    {
        // Validate the video details
        $request->validate([
            'channel_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000', 
        ]);

        // Find the video to update
        $video = Video::findOrFail($id);

        // Update video details
        $video->channel_name = $request->channel_name;
        $video->title = $request->title;
        $video->description = $request->description;

        // Handle file upload if there's a new video file
        if ($request->hasFile('video_file')) {
            // Delete the old file if it exists
            if (Storage::disk('public')->exists($video->file_path)) {
                Storage::disk('public')->delete($video->file_path);
            }

            // Upload the new file
            $file = $request->file('video_file');
            $path = $file->store('Videos', 'public'); // Store video in 'Videos' directory

            // Extract the video duration using FFmpeg for the new file
            $ffmpeg = FFMpeg::create();
            $videoFile = $ffmpeg->open(storage_path('app/public/' . $path));
            $durationInSeconds = $videoFile->getFormat()->get('duration');
            $durationFormatted = gmdate('H:i:s', $durationInSeconds); // Format duration

            // Set the new file path and duration
            $video->file_path = $path;
            $video->duration = $durationFormatted;
        }

        // Save changes
        if ($video->save()) {
            return redirect()->route('home')->with('success', 'Video updated successfully!');
        } else {
            return redirect()->back()->withErrors(['db' => 'Video could not be saved to the database.']);
        }
    }

    // When editing a video
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('edit_upload', compact('video')); // Pass the video data to the edit_upload view
    }

    // Delete a video
    public function destroy($id)
    {
        // Find the video to delete
        $video = Video::findOrFail($id);

        // Delete the video file from storage
        if (Storage::disk('public')->exists($video->file_path)) {
            Storage::disk('public')->delete($video->file_path);
        }

        // Delete the video from the database
        $video->delete();

        return redirect()->route('home')->with('success', 'Video deleted successfully!');
    }

    // Filter videos with OpenCV
    public function filterVideos()
    {
        // Fetch all uploaded videos
        $videos = Video::all();
        $filteredVideos = [];

        foreach ($videos as $video) {
            $inputPath = storage_path("app/public/{$video->file_path}");
            $outputPath = storage_path("app/public/filtered/{$video->title}_filtered.mp4"); // Adjust the output filename and extension

            // Call the OpenCV script to filter the video
            if ($this->processVideoWithOpenCV($inputPath, $outputPath)) {
                $filteredVideos[] = $outputPath; // Store the output path for later use
            }
        }

        // Return the view with filtered videos
        return view('videos.filtered', compact('filteredVideos'));
    }

    private function processVideoWithOpenCV($inputPath, $outputPath)
    {
        $command = "python3 " . base_path('opencv_scripts/filter_video.py') . " $inputPath $outputPath";

        // Execute the command
        exec($command, $output, $return_var);

        if ($return_var !== 0) {
            // Handle error if needed
            return false;
        }

        return true;
    }
}

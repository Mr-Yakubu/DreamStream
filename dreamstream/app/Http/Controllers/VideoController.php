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
        $video = Video::with('user')->findOrFail($id);

        // Fetch upcoming videos (excluding the current video)
        $upcomingVideos = Video::where('id', '!=', $video->id)
                                ->orderBy('created_at', 'desc')
                                ->take(5) // Get the top 5 upcoming videos
                                ->get();

        // Return the view with both the video and upcoming videos
        return view('videoplayer', compact('video', 'upcomingVideos')); 
    }

    // Show the edit/upload video page
    public function editUpload()
    {
        return view('edit_upload'); // Returns the edit_upload.blade.php view
    }

    public function store(Request $request)
    {
        // Validate the video details
        $request->validate([
            'channel_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_file' => 'required|mimes:mp4,mov,ogg,qt|max:20000', // Add file size and format restrictions
        ]);
    
        // Handle file upload
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $path = $file->store('videos', 'public'); // Store video in 'videos' directory in 'public' disk
    
            // Check if path is not empty
            if (!$path) {
                return redirect()->back()->withErrors(['video_file' => 'Video upload failed.']);
            }
    
            // Extract the video duration using FFmpeg
            $ffmpeg = FFMpeg::create();
            $videoFile = $ffmpeg->open(storage_path('app/public/' . $path)); // Use storage_path() to get the full path
            $durationInSeconds = $videoFile->getFormat()->get('duration'); // Extract duration in seconds
    
            // Convert duration to a human-readable format (optional)
            $durationFormatted = gmdate('H:i:s', $durationInSeconds);
    
            // Create new video record in the database
            $video = new Video();
            $video->channel_name = $request->channel_name;
            $video->title = $request->title;
            $video->description = $request->description;
            $video->file_path = $path;
            $video->user_id = auth()->id(); // Assign current logged-in user as the uploader
            $video->uploaded_by = auth()->id(); // Also assign to 'uploaded_by' column
            $video->duration = $durationFormatted; // Set the duration from FFmpeg
    
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
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000', // File is optional on edit
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
            $path = $file->store('videos', 'public');

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
        $video->save();

        return redirect()->route('home')->with('success', 'Video updated successfully!');
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
}

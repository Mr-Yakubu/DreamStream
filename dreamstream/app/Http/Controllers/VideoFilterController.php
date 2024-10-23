<?php

namespace App\Http\Controllers;

use App\Models\Video; // Assuming you have a Video model
use Illuminate\Http\Request;

class VideoFilterController extends Controller
{
    public function filterVideos()
    {
        // Fetch all uploaded videos
        $videos = Video::all();

        // Loop through each video and process it with OpenCV
        foreach ($videos as $video) {
            $inputPath = storage_path("app/{$video->video_path}");
            $outputPath = storage_path("app/filtered/{$video->video_name}"); // Change extension if needed

            // Call the OpenCV script to filter the video
            $this->processVideoWithOpenCV($inputPath, $outputPath);
        }

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


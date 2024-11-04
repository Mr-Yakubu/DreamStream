<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Exception\FFMpegException; // Import the FFMpegException class
use Exception;

class GenerateThumbnails extends Command
{
    protected $signature = 'thumbnails:generate';
    protected $description = 'Generate thumbnails for all uploaded videos';

    public function handle()
    {
        // Fetch all videos from the database
        $videos = DB::table('videos')->get();

        foreach ($videos as $video) {
            // Debugging: output the video object to see its properties
            $this->info(print_r($video, true)); // Print the video object properties

            // Check if 'file_path' exists before accessing it
            if (!isset($video->file_path)) {
                $this->error("Video ID {$video->id} does not have a 'file_path' property.");
                continue; // Skip this video if 'file_path' doesn't exist
            }

            // Generate the thumbnail
            $thumbnailPath = $this->generateThumbnail($video->file_path);

            // Update the thumbnail path in the database
            if ($thumbnailPath) {
                DB::table('videos')
                    ->where('id', $video->id)
                    ->update(['thumbnail' => $thumbnailPath]);

                $this->info("Thumbnail generated for video ID: {$video->id}");
            } else {
                $this->error("Failed to generate thumbnail for video ID: {$video->id}");
            }
        }

        $this->info('Thumbnail generation completed for all videos.');
    }

    private function generateThumbnail($videoPath)
    {
        // Define the thumbnail path based on the video filename
        $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';

        // Check if the thumbnail already exists
        if (Storage::exists($thumbnailPath)) {
            return $thumbnailPath; // Return existing thumbnail path if it already exists
        }

        try {
            // Create an FFMpeg instance and open the video file
            $ffmpeg = FFMpeg::create();
            $video = $ffmpeg->open(storage_path('app/' . $videoPath));

            // Generate the thumbnail and save it
            $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(1))->save(storage_path('app/' . $thumbnailPath));

            return $thumbnailPath; // Return the path to the generated thumbnail
        } catch (Exception $e) {
            $this->error("FFmpeg error: " . $e->getMessage());
            return null; // Return null if an error occurs
        } catch (\Exception $e) {
            $this->error("General error: " . $e->getMessage());
            return null; // Return null if an unexpected error occurs
        }
    }
}

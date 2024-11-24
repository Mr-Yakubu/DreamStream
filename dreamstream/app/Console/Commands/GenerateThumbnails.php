<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Exception;

class GenerateThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thumbnails:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate thumbnails for all uploaded videos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting thumbnail generation...');

        try {
            // Fetch all videos from the database
            $videos = DB::table('videos')->get();

            foreach ($videos as $video) {
                // Debugging: output video object
                $this->info("Processing Video ID: {$video->id}");

                // Check if 'file_path' exists
                if (!isset($video->file_path)) {
                    $this->error("Video ID {$video->id} does not have a 'file_path' property.");
                    continue;
                }

                // Generate the thumbnail
                $thumbnailPath = $this->generateThumbnail($video->file_path);

                if ($thumbnailPath) {
                    // Update the thumbnail path in the database
                    DB::table('videos')
                        ->where('id', $video->id)
                        ->update(['thumbnail' => $thumbnailPath]);

                    $this->info("Thumbnail generated for Video ID: {$video->id}");
                } else {
                    $this->error("Failed to generate thumbnail for Video ID: {$video->id}");
                }
            }

            $this->info('Thumbnail generation completed for all videos.');
        } catch (Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }

    /**
     * Generate a thumbnail for the given video path.
     */
    private function generateThumbnail($videoPath)
    {
        // Ensure the video path is consistent with the public directory
        $fullVideoPath = 'videos/videos/' . basename($videoPath);
        $this->info("Full video path: " . $fullVideoPath); // Debugging line to check the path

        // Define the thumbnail path based on the video filename
        $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';

        // Check if the thumbnail already exists
        if (Storage::exists($thumbnailPath)) {
            return $thumbnailPath; // Return existing thumbnail path if it already exists
        }

        try {
            // Use ProtoneMedia's FFMpeg package to open the video
            $media = FFMpeg::fromDisk('public') // Use the 'public' disk for accessing files in public/videos
                ->open($fullVideoPath);

            // Generate the thumbnail and save it in the public/thumbnails folder
            $media->getFrameFromSeconds(1) // Get a frame at the 1-second mark
                ->export()
                ->toDisk('public') // Save the thumbnail in the 'public' disk
                ->save($thumbnailPath); // Save as defined in $thumbnailPath

            return $thumbnailPath; // Return the relative path to the generated thumbnail
        } catch (\Exception $e) {
            $this->error("Error generating thumbnail: " . $e->getMessage());
            return null; // Return null if an error occurs
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        // Insert the videos for users with IDs 1 and 21
        Video::insert([
            [
                'title' => 'Dummy Video',
                'description' => 'This is a description for the dummy video.',
                'file_path' => 'Videos/dummy-video.mp4', // Correct path to the actual dummy video
                'thumbnail' => 'path/to/your/dummy_thumbnail.jpg', // Path to the dummy video thumbnail
                'user_id' => 1, // Use the first existing user ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Night Life',
                'description' => 'This is a description for the video.',
                'file_path' => 'Videos/night-life.mp4', // Correct path to the actual night-life video
                'thumbnail' => 'path/to/your/thumbnail.jpg', 
                'user_id' => 2, // Use the second existing user ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

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
                'file_path' => 'Videos/dummy-video.mp4',
                'thumbnail' => 'path/to/your/dummy_thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/dummy-video',
                'uploaded_by' => 1, // User with ID 1
                'duration' => '00:01:01', // Example video duration (3 minutes 30 seconds)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Night Life',
                'description' => 'This is a description for the video.',
                'file_path' => 'Videos/night-life.mp4',
                'thumbnail' => 'path/to/your/thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/night-life',
                'uploaded_by' => 2, // User with ID 2
                'duration' => '00:00:15', // Example video duration (4 minutes 15 seconds)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Day In The Office',
                'description' => 'Skill over luck! ',
                'file_path' => 'Videos/DayInTheOffice.mov',
                'thumbnail' => 'path/to/your/thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/DayInTheOffice.mov',
                'uploaded_by' => 2, // User with ID 2
                'duration' => '00:00:15', // Example video duration (4 minutes 15 seconds)
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

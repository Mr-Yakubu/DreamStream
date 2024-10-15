<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        // Insert only the third video
        Video::insert([
            [
                'title' => 'Day In The Office',
                'description' => 'Skill over luck!',
                'file_path' => 'Videos/DayInTheOffice.mov',
                'thumbnail' => 'path/to/your/thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/DayInTheOffice.mov',
                'uploaded_by' => 2, // User with ID 2
                'duration' => '00:00:15', // Example video duration (15 seconds)
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
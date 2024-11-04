<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        
        Video::insert([
            [
                'title' => 'Santa Sketch',
                'description' => 'That Time Of The Year',
                'file_path' => 'Videos/SantaSketch.mp4',
                'thumbnail' => 'Images/thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/SantaSketch.mp4',
                'uploaded_by' => 1,
                'duration' => '00:00:08',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
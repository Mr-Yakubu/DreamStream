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
                'title' => 'HEHE NOT HEHE',
                'description' => 'This is what I mean!',
                'file_path' => 'Videos/dummy-video.mov',
                'thumbnail' => 'Images/HEHE.jpg',
                'url' => 'http://127.0.0.1:8000/videos/dummy-video.mov',
                'uploaded_by' => 1,
                'duration' => '00:00:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
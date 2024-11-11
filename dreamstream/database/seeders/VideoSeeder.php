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
                'thumbnail' => 'Images/SantaSketch.png',
                'url' => 'http://127.0.0.1:8000/videos/SantaSketch.mp4',
                'uploaded_by' => 1,
                'duration' => '00:00:08',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Video::insert([
            [
                'title' => 'Normal Day In The Office',
                'description' => 'Goretzka!',
                'file_path' => 'Videos/DayInTheOffice.mov',
                'thumbnail' => 'Images/thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/DayInTheOffice.mov',
                'uploaded_by' => 2,
                'duration' => '00:00:27',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Video::insert([
            [
                'title' => 'Night Life',
                'description' => 'Aliens and UFOS!?',
                'file_path' => 'Videos/night-life.mp4',
                'thumbnail' => 'Images/thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/night-life.mp4',
                'uploaded_by' => 3,
                'duration' => '00:00:15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Video::insert([
            [
                'title' => 'Hehe',
                'description' => 'This Is What I Mean!',
                'file_path' => 'Videos/dummy-video.mp4',
                'thumbnail' => 'Images/thumbnail.jpg',
                'url' => 'http://127.0.0.1:8000/videos/dummy-video.mp4',
                'uploaded_by' => 1,
                'duration' => '00:00:11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
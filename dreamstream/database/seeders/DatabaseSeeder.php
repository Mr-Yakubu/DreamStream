<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call the VideoSeeder to insert sample videos
        $this->call(VideoSeeder::class);
        // Call to insert users 
        $this->call(UserSeeder::class);
    }
    
}

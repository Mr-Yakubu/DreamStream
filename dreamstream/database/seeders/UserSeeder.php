<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Jacob Gakere',
            'email' => '1234@example.com',
            'password' => bcrypt('password'), // Use a secure password
        ]);
        
    }
}

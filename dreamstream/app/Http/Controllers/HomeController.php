<?php

namespace App\Http\Controllers;
use App\Models\Video;  // Update this to use Video instead of Media

class HomeController extends Controller
{
    public function index()
    {
        $videos = Video::all();  // Fetch all video records from the database
        return view('home', compact('videos'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Media;

class HomeController extends Controller
{
    public function index()
    {
        $videos = Media::all();  // Fetch all video records from the database
        return view('home', compact('videos'));
    }
}
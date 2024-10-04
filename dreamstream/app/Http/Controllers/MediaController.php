<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all(); // Fetch all media from the database
        return view('media.index', compact('media'));
    }

    public function show($id)
    {
        $media = Media::findOrFail($id); // Fetch specific media by id
        return view('media.show', compact('media'));
    }
}

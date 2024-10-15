<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite; // Import your Favorite model
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function add(Request $request, $videoId)
    {
        // Validate the request
        $request->validate([
            'userId' => 'required|exists:users,id',
        ]);

        // Create a new favorite entry
        Favorite::create([
            'user_id' => $request->userId,
            'video_id' => $videoId,
        ]);

        return response()->json(['success' => true]);
    }
}

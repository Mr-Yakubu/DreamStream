<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // Add a video to favorites
    public function add(Request $request, $videoId)
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 403);
        }

        // Check if the video is already in favorites
        $existingFavorite = Favorite::where('user_id', $user->id)
                                    ->where('video_id', $videoId)
                                    ->first();

        if ($existingFavorite) {
            return response()->json(['message' => 'Video is already in favorites'], 200);
        }

        // Add the video to favorites
        Favorite::create([
            'user_id' => $user->id,
            'video_id' => $videoId,
        ]);

        return response()->json(['success' => true, 'message' => 'Video added to favorites']);
    }

    // Remove a video from favorites
    public function remove(Request $request, $videoId)
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 403);
        }

        // Find the favorite entry
        $favorite = Favorite::where('user_id', $user->id)
                            ->where('video_id', $videoId)
                            ->first();

        if ($favorite) { 
        $favorite->delete();
        return redirect()->back()->with('success', 'Video removed from favorites.');
    } else {
        return redirect()->back()->with('error', 'Video not found in favorites.');
    }

        // Remove the video from favorites
        $favorite->delete();

        return response()->json(['success' => true, 'message' => 'Video removed from favorites']);
    }

    // View favorite videos
    public function index()
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your favorites.');
        }

        // Fetch the user's favorite videos
        $favorites = Video::whereHas('favorites', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        // Return the view with the favorites
        return view('favorites', ['favorites' => $favorites]);
    }
}

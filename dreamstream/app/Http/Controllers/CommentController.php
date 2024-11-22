<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request, $videoId)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    Comment::create([
        'video_id' => $videoId,
        'user_id' => auth()->user()->id,
        'content' => $request->content,
    ]);

    return back()->with('success', 'Comment added successfully');
}
}

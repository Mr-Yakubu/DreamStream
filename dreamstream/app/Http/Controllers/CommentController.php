<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request, $videoId)
{
    $request->validate([
        'comment' => 'required|string|max:255',
        'userId' => 'required|integer'
    ]);

    $comment = new Comment();
    $comment->text = $request->comment;
    $comment->user_id = $request->userId;
    $comment->video_id = $videoId;
    $comment->save();

    return response()->json(['comment' => $comment->text]);
}
}

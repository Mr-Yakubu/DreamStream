<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // CRUD methods implemented here

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'media_id' => 'required|exists:media,id'
        ]);

        Comment::create($request->all());
        return redirect()->back();
    }
}

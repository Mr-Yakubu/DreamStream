<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ChannelController extends Controller {



public function showChannels()
{
    // Get distinct users with uploaded videos
    $channels = User::whereHas('videos')->get(); 

    return view('channels', compact('channels'));
}

}
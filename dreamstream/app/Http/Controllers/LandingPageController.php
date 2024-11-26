<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LandingPageController extends Controller
{
    public function showRoleSelectionForm()
    {
        // Check if the user has registered
        if (!Session::has('registered')) {
            return redirect()->route('login')->with('error', 'You must register first.'); // Redirect to login if not registered
        }

        // Clear the session variable after checking
        Session::forget('registered');

        return view('landing-page');
    }
    
}

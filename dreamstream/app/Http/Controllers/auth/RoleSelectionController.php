<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleSelectionController extends Controller
{
    public function showRoleSelectionForm()
    {
        // Check if the user has registered
        if (!Session::has('registered')) {
            return redirect()->route('login')->with('error', 'You must register first.'); // Redirect to login if not registered
        }

        // Clear the session variable after checking
        Session::forget('registered');

        return view('auth.choose-role'); // Show the choose role view
    }

    public function chooseRole(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'role' => 'required|string|in:parent,child', // Validate selected role
            'dob' => 'required|date', // Validate date of birth
        ]);

        // Store the selected role and date of birth in the session or database as needed
        $role = $request->input('role');
        $dob = $request->input('dob');

    
        // Redirect based on the role selected
        if ($role === 'parent') {
            return redirect()->route('parent.dashboard'); // Adjust to your parent dashboard route
        } else {
             // Redirect to the main home page
        return redirect()->route('home')->with('success', 'Role selection successful!');
        }
    }
}

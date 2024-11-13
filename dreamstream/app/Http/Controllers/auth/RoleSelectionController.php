<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

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
    
    public function chooseRoleSubmit(Request $request)
{
    // Validate the selected role
    $request->validate([
        'user_type' => 'required|in:parent,child,content creator',
    ]);

    // Retrieve the authenticated user
    $user = User::find(auth()->id());

    if ($user) {
        $user->user_type = $request->user_type;
        $user->save(); // This should now work correctly
        
        return redirect()->route('home')->with('success', 'Role selected successfully!');
    } else {
        return redirect()->back()->withErrors(['user' => 'Unable to retrieve authenticated user.']);
    }
}

    public function chooseRole(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'role' => 'required|string|in:parent,child,content creator', // Validate selected role
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

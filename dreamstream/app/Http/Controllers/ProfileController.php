<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the profile picture update form.
     */
    public function showUpdatePictureForm()
    {
        return view('update-profile');
    }

    /**
     * Handle the profile picture upload and update.
     */
    public function updateProfilePicture(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $file = $request->file('profile_picture');
        $fileName = 'user_' . auth()->id() . '.' . $file->getClientOriginalExtension();

        // Save file to public/images/profiles
        $file->move(public_path('Images/profiles'), $fileName);

        // Store filename in session for dynamic retrieval
        session(['profile_picture' => $fileName]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }
}
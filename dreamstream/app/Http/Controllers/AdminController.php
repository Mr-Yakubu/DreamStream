<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\Video;




class AdminController extends Controller
{
    // Display the admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard'); // admin view
    }

    public function index()
{
    $users = User::where('user_type', '!=', 'administrator')->get();
    $videos = Video::all();

    return view('admin.dashboard', compact('users', 'videos'));
}

public function deleteUser($id)
{
    User::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
}

public function deleteVideo($id)
{
    Video::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard')->with('success', 'Video deleted successfully!');
}

public function editUser($id)
{
    $user = User::findOrFail($id);
    return view('admin.editUser', compact('user'));

}

public function updateUser(Request $request, $id)
{

    $user = User::findOrFail($id);
    $user->email = $request->input('email');
    $user->user_type = $request->input('user_type');
    $user->date_of_birth = $request->input('date_of_birth');
    $user->save();

    // Validate input
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'user_type' => 'required|in:parent,child',
        'date_of_birth' => 'required|date',
    ]);

    // Update user data
    $user->update($validated);

    // Redirect to admin dashboard with success message
    return redirect()->route('admin.dashboard')->with('success', 'User updated successfully!');
}

public function editVideo($id)
{
    $video = Video::findOrFail($id);
    return view('admin.editVideo', compact('video'));
}
}
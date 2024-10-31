<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getAccountInfo(Request $request)
{
    $user = $request->user(); // Get the authenticated user
    return response()->json([
        'username' => $user->username,
        'email' => $user->email,
        'date_of_birth' => $user->date_of_birth,
    ]);
}
public function getUploadHistory(Request $request) {
    // Fetch the user's upload history
    $uploads = Video::where('id', $request->user()->id)->get(['title', 'description', 'created_at']);
    return response()->json($uploads);
}

public function updateUsername(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $request->user()->id,
    ]);

    $user = $request->user();
    $user->username = $request->username;
    $user->save();

    return response()->json(['success' => true]);
}
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}


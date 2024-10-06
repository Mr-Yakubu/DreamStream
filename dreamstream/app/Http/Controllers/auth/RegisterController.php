<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Show the registration form
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $this->validator($request->all())->validate();

        // Generate a default username based on the email
        $defaultUsername = $this->generateDefaultUsername($request->email);

        // Create a new user
        $user = $this->create($request->all(), $defaultUsername);

        // Log the user in
        auth()->login($user);

        // Set session variable for role selection
        session(['registered' => true]);

        // Redirect to the choose role page
        return redirect()->route('choose.role'); // Adjust to the route for choosing a role
    }

    protected function validator(array $data)
    {
        // Validate input fields
        return Validator::make($data, [
            'username' => ['nullable', 'string', 'max:255', 'unique:users'], // Validate username
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Validate email
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Validate password
            'user_type' => ['required', 'string', 'in:parent,child'], // Validate user type
            'date_of_birth' => ['nullable', 'date'], // Validate date of birth
        ]);
    }

    protected function create(array $data, $defaultUsername)
    {
        // Create a new user and hash the password
        return User::create([
            'username' => $data['username'] ?: $defaultUsername, // Use the provided username or the default
            'email' => $data['email'], // Save email
            'password' => Hash::make($data['password']), // Hash the password
            'user_type' => $data['user_type'], // Save user type
            'date_of_birth' => $data['date_of_birth'], // Save date of birth
        ]);
    }

    private function generateDefaultUsername($email)
    {
        // Extract part of the email as the base username
        $baseUsername = explode('@', $email)[0];

        // Check for existing usernames to ensure uniqueness
        $existingUsernames = User::where('username', 'LIKE', "$baseUsername%")->pluck('username');

        // If the username already exists, append a number
        $newUsername = $baseUsername;
        $counter = 1;

        while ($existingUsernames->contains($newUsername)) {
            $newUsername = $baseUsername . $counter;
            $counter++;
        }

        return $newUsername;
    }
}

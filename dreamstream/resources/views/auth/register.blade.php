<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DreamStream</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Prevent horizontal scrolling */
        html, body {
            font-family: 'Pacifico', cursive;
            margin: 0;
            padding: 0;
            height: 100vh; /* Full height */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            overflow-x: hidden; /* Disable horizontal scrolling */
        }

        .collage-layout {
            display: flex;
            align-items: center; /* Align items vertically */
            padding: 20px;
            width: 100%; /* Ensure full width */
        }

        .logo {
            margin-right: 800px; /* Add space between logo and registration form */
        }

        .login-form {
            text-align: center; /* Center text within the form */
        }

        .login-form h1 {
            margin-bottom: 20px; /* Add space below the heading */
            text-align: center; /* Center the heading text */
        }

        .login-form form {
            display: inline-block; /* Center the form */
            text-align: left; /* Align text to the left for labels and inputs */
        }

        .login-form div {
            margin: 15px 0; /* Add space between each field */
        }

        .login-form label {
            display: block; /* Ensure labels are block elements */
            margin-bottom: 5px; /* Add space below labels */
        }

        .login-form input, .login-form select { /* Include select in input styling */
            padding: 10px;
            width: 250px; /* Set a fixed width for inputs and selects */
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-form button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            cursor: pointer;
            margin-right: 10px; /* Adjusted space between buttons */
        }

        .login-form button:hover {
            background-color: #444; /* Slightly change color on hover for better visibility */
        }

        .social-login {
            margin-top: 20px; /* Space above social login section */
        }

        .social-login a {
            margin: 0 10px; /* Space between icons */
            text-decoration: none; /* Remove underline */
            color: #333; /* Default color for icons */
            font-size: 24px; /* Adjust icon size */
        }

        .forgot-password {
            margin-top: 15px; /* Space above forgot password link */
            display: block; /* Make it block to occupy full width */
            text-align: center; /* Center the link */
            color: black; /* Change link color to black */
            text-decoration: none; /* Remove underline */
        }

        .forgot-password:hover {
            text-decoration: underline; /* Underline on hover */
        }

        .error-message {
            margin-top: 10px; /* Space above the error message */
            color: rgb(255, 12, 12); /* Color for error message */
            text-align: center; /* Align error message to center */
        }

        .username-info {
            font-size: 0.9em; /* Smaller font for username info */
            color: #555; /* Gray color for the info text */
            text-align: center; /* Center the info text */
            margin-top: 5px; /* Space above the info */
        }
    </style>
</head>
<body>
    <div class="collage-layout">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="DreamStream Logo" style="width: 550px;">
        </div>
        <div class="login-form">
            <h1>Register</h1> <!-- Centered heading -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username"> <!-- Username Input -->
                    <div class="username-info">
                        *Leave blank for a username based on your email.
                    </div>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email"> <!-- Email Input -->
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Choose a password"> <!-- Password Input -->
                </div>
                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Re-enter your password"> <!-- Confirm Password Input -->
                </div>
                <div>
                    <label for="user_type">User Type</label>
                    <select name="user_type" id="user_type">
                        <option value="parent">Parent</option>
                        <option value="child" selected>Child</option> <!-- Set Child as default -->
                    </select> <!-- User Type Select -->
                </div>
                <div>
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"> <!-- Date of Birth Input -->
                </div>
                <div>
                    <button type="submit">Register</button>
                    <button type="button" onclick="window.location.href='{{ route('login') }}'">Log In</button> <!-- Log In Button -->
                </div>
            </form>
            @if ($errors->any())
                <div class="error-message">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif

            <!-- Social Login Section -->
            <div class="social-login">
                <a href="#"><i class="fab fa-google"></i></a> <!-- Google Login Icon -->
                <a href="#"><i class="fab fa-facebook-f"></i></a> <!-- Facebook Login Icon -->
            </div>

            <!-- Forgot Password Link -->
            <a href="#" class="forgot-password">Forgot Password?</a>
        </div>
    </div>
</body>
</html>
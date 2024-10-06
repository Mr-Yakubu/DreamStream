<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Role - DreamStream</title>
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
            text-align: center; /* Center text */
        }

        .logo {
            margin-right: 100px; /* Adjust space between logo and form */
        }

        .role-form {
            text-align: center; /* Center text within the form */
            width: 300px; /* Set a fixed width for the form */
        }

        .role-form h1 {
            margin-bottom: 20px; /* Add space below the heading */
        }

        .role-form label {
            display: block; /* Ensure labels are block elements */
            margin-bottom: 5px; /* Add space below labels */
        }

        .role-form select,
        .role-form input {
            padding: 10px;
            width: 100%; /* Set to 100% for responsive design */
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px; /* Space between fields */
        }

        .role-form button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            cursor: pointer;
        }

        .role-form button:hover {
            background-color: #444444; /* Slightly lighter on hover */
        }

        .error-message {
            margin-top: 10px; /* Space above the error message */
            color: red; /* Color for error message */
            text-align: center; /* Align error message to center */
        }
    </style>
</head>
<body>
    <div class="collage-layout">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="DreamStream Logo" style="width: 550px;">
        </div>
        <div class="role-form">
            <h1>Choose Your Role</h1>
            <form method="POST" action="{{ route('choose.role.submit') }}">
                @csrf
                <div>
                    <label for="role">Select Role:</label>
                    <select name="role" id="role" required>
                        <option value="parent">Parent</option>
                        <option value="child">Child</option>
                    </select>
                </div>
                <button type="submit">Continue</button>
            </form>
            @if ($errors->any())
                <div class="error-message">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

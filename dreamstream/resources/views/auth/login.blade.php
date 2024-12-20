<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DreamStream</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
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
            margin-right: 800px; /* Add space between logo and login form */
        }

        .login-form {
            text-align: center; /* Center text within the login form */
        }

        .login-form h1 {
            margin-bottom: 20px; /* Add space below the heading */
            font-family: 'Pacifico', cursive;
        }

        .login-form form {
            display: inline-block; /* Center the form */
            text-align: left; /* Align text to the left for labels and inputs */
            font-family: 'Nunito', sans-serif;
        }

        .login-form div {
            margin: 15px 0; /* Add space between each field */
        }

        .login-form label {
            display: block; /* Ensure labels are block elements */
            margin-bottom: 5px; /* Add space below labels */
            font-weight: 700;
        }

        .login-form input {
            font-family: 'Nunito', sans-serif;
            padding: 10px;
            width: 250px; /* Set a fixed width for inputs */
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-form button {
            font-family: 'Nunito', sans-serif;
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            cursor: pointer;
            margin-right: 10px; /* Adjust space between buttons */
        }

        .login-form button:hover {
            background-color: #444;
        }

        .forgot-password {
            margin-top: 15px; /* Space above forgot password link */
            display: block; /* Make it block to occupy full width */
            text-align: center; /* Center the link */
            color: black; /* Change link color to black */
            text-decoration: none; /* Remove underline */
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
        }

        .forgot-password:hover {
            text-decoration: underline; /* Underline on hover */
        }

        .error-message {
            font-family: 'Nunito', sans-serif;
            margin-top: 10px; /* Space above the error message */
            color: red; /* Color for error message */
            text-align: center; /* Align error message to center */
        }

        #success-popup {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>
<body>


    @if(session('success'))
    <div id="popup" class="popup">
        <p>{{ session('success') }}</p>
    </div>
    <script>
        // Show the popup for a limited time
        setTimeout(() => {
            const popup = document.getElementById('popup');
            if (popup) {
                popup.style.display = 'none';
            }
        }, 3000); // 3 seconds
    </script>
    <style>
        .popup {
            position: fixed;
            top: 20px;
            left: 50%; /* Center horizontally */
            transform: translateX(-50%); /* Adjust for true centering */
            background-color: #4CAF50; /* Success green */
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
            z-index: 1000;
            text-align: center; /* Center the text inside */
            max-width: 90%; /* Ensure it doesn't overflow on small screens */
            box-sizing: border-box; /* Include padding in width calculation */
            font-family: 'Nunito', sans-serif;
        }
    </style>
    @endif
    

    <div class="collage-layout">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="DreamStream Logo" style="width: 550px;">
        </div>
        <div class="login-form">
            <h1>Login</h1> <!-- Centered heading -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label>Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <button type="submit">Login</button>
                    <button type="button" onclick="window.location.href='{{ route('register') }}'">Register</button> <!-- Register Button -->
                </div>
            </form>
            @if ($errors->any())
                <div class="error-message">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif

            <!-- Forgot Password Link -->
            <a href="{{ route('forgot-password') }}" class="forgot-password">Forgot Password?</a>
        </div>
    </div>

</body>
</html>

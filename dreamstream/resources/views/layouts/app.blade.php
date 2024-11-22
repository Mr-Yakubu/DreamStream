<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General body and font settings */
        body {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            margin: 0;
            padding: 0;
            color: black;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        /* Header styling */
        header {
            background-color: #f0f0f0;
            padding: 10px; /* Reduced padding */
            text-align: center;
        }

        /* Header title styling */
        header h1 {
            font-family: 'Pacifico', cursive;
            font-size: 2.5em;
            font-weight: 700;
            color: #b8b8b8; /* Green gradient color */
            background: linear-gradient(45deg, #000000, #000000); /* Gradient effect */
            -webkit-background-clip: text;
            color: transparent;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3); /* Slight shadow for depth */
            animation: slideInLogo 2s ease-out;
        }

        /* Slide-in animation for header logo */
            @keyframes slideInLogo {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Navbar for Home */
        .navbar {
            display: flex;
            justify-content: space-between; /* Spread out the elements */
            align-items: center; /* Center vertically */
            background-color: #f0f0f0;
            padding: 10px; /* Reduced padding */
            margin: 0; /* Remove margin to eliminate space */
        }

        .navbar .search-bar img {
            width: 50px; /* Set the desired initial size */
            height: auto; /* Maintain aspect ratio */
            max-width: 100%; /* Prevent image from exceeding container width */
            border-radius: 50%; /* Make it a circle if it's a square image */
        }   

        .navbar-links {
            display: flex;
            justify-content: space-between; /* Evenly distribute links */
            flex-grow: 1; /* Allow links to occupy available space */
        }

        .navbar a {
            margin: 0 100px; /* Further reduced margin to bring links closer together */
            font-family: 'Nunito', sans-serif;
            color: black;
            text-decoration: none;
            transition: color 0.3s, transform 0.3s;
        }

        .navbar a:hover {
            color: #3f4244;
            transform: scale(1.1);
        }

        .search-bar {
            display: flex;
            align-items: auto;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            font-size: 14px;
        }

        .search-bar button {
            padding: 8px;
            border: 1px solid #ccc;
            border-left: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            background-color: white;
        }

        .search-bar button i {
            font-size: 16px;
            color: #333;
        }

        @keyframes slideIn {
         from { transform: translateX(-100%); }
        to { transform: translateX(0); }
        }

        .profile-icon {
            margin-left: 10px;
            cursor: pointer;
        }

/* Sidebar styling with slide-in animation */
        nav.bg-light {
            width: 200px;
            background-color: #f8f8f8;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
            animation: slideIn 0.5s ease-out; /* Apply the sliding animation */
        }

        nav.bg-light ul {
            padding: 0; /* Remove default padding */
            list-style: none; /* Remove dots */
        }

        nav.bg-light a {
            display: flex;
            align-items: center;
            padding: 15px 10px;
            color: black;
            text-decoration: none;
            margin: 15px 0;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        nav.bg-light a:hover {
            background-color: #e0e0e0;
            transform: scale(1.05);
        }

        nav.bg-light a i {
            margin-right: 10px;
        }


        /* Main content area */
        .main-content {
            display: flex; /* Use flex to allow side-by-side layout */
            flex-grow: 1;
            padding: 20px;
        }

        .video-details{
            font-family: 'Nunito', sans-serif; 
        }

        /* Video grid styling */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 20px;
            max-width: 1200px; /* Set max width for centering */
            width: 100%; /* Full width for responsiveness */
        }

        /* Footer styling */
        footer {
            font-family: 'Pacifico', cursive;
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <header>
        <h1>DreamStream</h1>
    </header>

    <nav class="navbar">
        <div class="navbar-links">
            <a href="{{ url('/') }}">HOME</a>
            <a href="{{ route('popular') }}">POPULAR</a>
            <a href="#">CATEGORIES</a>
        </div>
        <div class="search-bar">
            <form action="{{ route('search') }}" method="GET" style="display: flex; align-items: center;">
                <input type="text" name="query" placeholder="Search..." required>
                <button type="submit" style="background: none; border: none;">
                    <i class="fas fa-search" style="color: black;"></i>
                </button>
            </form>
            
            <a href="{{ route('settings') }}" class="profile-icon">
                <img src="{{ asset('images/profiles/' . (session('profile_picture') ?? 'default.png')) }}">
            </a>
        </div>
    </nav>

    <div class="main-content">
        <!-- Sidebar -->
        <nav class="bg-light">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('channels') }}"><i class="fas fa-th-list"></i> Channels</a>
                    <a href="{{ url('/') }}"><i class="fas fa-clock"></i> Latest</a>
                    <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
                </li>
            </ul>
        </nav>
    
        <!-- Video Grid Section -->
        <div class="video-grid">
            @yield('content')
        </div>
    </div>

    <footer>
        <p>Copyright &copy; 2024 DreamStream</p>
    </footer>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

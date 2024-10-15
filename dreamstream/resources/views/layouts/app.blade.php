<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General body and font settings */
        body {
            font-family: 'Pacifico', cursive;
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

        /* Navbar for Home */
        .navbar {
            display: flex;
            justify-content: space-between; /* Spread out the elements */
            align-items: center; /* Center vertically */
            background-color: #f0f0f0;
            padding: 10px; /* Reduced padding */
            margin: 0; /* Remove margin to eliminate space */
        }

        .navbar-links {
            display: flex;
            justify-content: space-between; /* Evenly distribute links */
            flex-grow: 1; /* Allow links to occupy available space */
        }

        .navbar a {
            margin: 0 100px; /* Further reduced margin to bring links closer together */
            font-family: 'Pacifico', cursive;
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
            align-items: center;
            margin-left: 300px; /* Adjust as needed */
            flex-grow: 0; /* Prevent the search bar from growing */
        }

        .search-bar input {
            padding: 6px; /* Reduced padding */
            border-radius: 5px;
            border: 1px solid #ccc;
            flex-grow: 1; /* Allow the input to grow */
            margin-right: -80px; /* Reduced space between input and icon */
            width: 350px; /* Increased width for better aesthetics */
        }

        /* Sidebar styling */
        nav.bg-light {
            width: 200px;
            background-color: #f8f8f8;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%; /* Full height */
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
            <a href="#">POPULAR</a>
            <a href="#">CATEGORIES</a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <a href="#"><img src="profile-icon.png" alt="Profile" class="profile-icon" width="30"></a>
        </div>
    </nav>

    <div class="main-content">
        <!-- Sidebar -->
        <nav class="bg-light">
            <ul class="nav flex-column">
                <li class="nav-item">
                <a href="#"><i class="fas fa-th-list"></i> Channels</a>
                <a href="{{ url('/') }}"><i class="fas fa-clock"></i> Latest</a>
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
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

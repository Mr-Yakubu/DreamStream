<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites - DreamStream</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Prevent horizontal scrolling */
        html, body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-x: hidden; /* Disable horizontal scrolling */
        }
        nav {
            width: 100%;
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }

        /* Logo Styling */
        nav h1 {
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

        @keyframes slideInLogo {
        from { transform: translateY(-100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
        }   

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .navbar div {
            display: flex;
            align-items: center;
            flex-grow: 1;
            justify-content: center;
        }

        .navbar a {
            margin: 0 20px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            color: black;
            text-decoration: none;
            transition: color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
        }

        .navbar a i {
            margin-right: 8px; /* Space between icon and text */
        }

        .navbar a:hover {
            color: #3f4244;
            transform: scale(1.1);
        }

        .search-bar {
            display: flex;
            align-items: center;
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

        .profile-icon {
            margin-left: 10px;
            cursor: pointer;
        }

        .main-content {
            display: flex;
            flex-direction: row;
            margin-top: 20px;
            flex-grow: 1;
        }

        @keyframes slideIn {
        from { transform: translateX(-100%); }
        to { transform: translateX(0); }
        }
        

        .sidebar {
            font-weight: 700;
            width: 200px;
            background-color: #f8f8f8;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
            animation: slideIn 0.5s ease-out;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px 10px;
            color: black;
            text-decoration: none;
            margin: 15px 0;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .sidebar a:hover {
            background-color: #e0e0e0;
            transform: scale(1.05);
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-left: 20px;
            padding: 20px;
            flex-grow: 1;
            overflow-y: auto; /* Allow vertical scrolling */
        }
        .video-card {
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 20px; /* Adjust border-radius */
            max-width: 385px;
            max-height: 250px;
            position: relative; /* Position for overlay */
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content */
            align-items: center;
            text-align: center; /* Center titles */
            transition: transform 0.5s, background-color 0.5s, box-shadow 0.5s;
        }
        .video-card:hover {
            background-color: #f0f0f0;
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .video-card img {
            width: 100%; /* Fill the entire width */
            height: 500px; /* Fixed height for thumbnails */
            object-fit: cover; /* Cover the area */
            border-radius: 10px 10px 0 0; /* Rounded top corners */
        }
        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none; /* Hidden by default */
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            border-radius: 50%;
            font-size: 24px;
            transition: background-color 0.3s;
        }
        .video-card:hover .play-overlay {
            display: block; /* Show overlay on hover */
        }
        .video-card p {
            margin: 10px 0 0; /* Adjust margin for video title */
        }
        .video-card a {
            text-decoration: none;
            color: black;
            display: block;
        }
        .remove-btn {
            background-color: black; /* Black button */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 100px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .remove-btn:hover {
            background-color: #333333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav>
        <h1>DreamStream</h1>
        <div class="navbar">
            <div><a href="{{ route('home') }}">HOME</a></div>
            <div><a href="{{ route('popular') }}">POPULAR</a></div>
            <div><a href="#">CATEGORIES</a></div>
            <div class="search-bar">
                <form action="{{ route('search') }}" method="GET" style="display: flex; align-items: center;">
                    <input type="text" name="query" placeholder="Search..." required>
                    <button type="submit" style="background: none; border: none;">
                        <i class="fas fa-search" style="color: black;"></i>
                    </button>
                </form>
                <a href="{{ route('settings') }}">
                    <img src="profile-icon.png" alt="Profile" class="profile-icon" width="30">
                </a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="sidebar">
            <a href="{{ route('channels') }}"><i class="fas fa-th-list"></i> Channels</a>
            <a href="{{ route('home') }}"><i class="fas fa-clock"></i> Latest</a>
            <a href="{{ route('edit_upload') }}"><i class="fas fa-video"></i> Videos</a> 
            <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="video-grid">
            @foreach($favorites as $video)
                <div class="video-card">
                    <a href="{{ route('video.player', ['video_id' => $video->id]) }}">
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }} Thumbnail">
                        <div class="play-overlay"><i class="fas fa-play"></i></div>
                    </a>
                    <p>{{ $video->title }}</p>

                    <!-- Remove button -->
                    <form action="{{ route('favorites.remove', ['id' => $video->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove from Favorites</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

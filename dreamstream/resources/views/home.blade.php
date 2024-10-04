<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - DreamStream</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Pacifico', cursive;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        nav {
            width: 100%;
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
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
            justify-content: flex-start;
            flex-grow: 1;
            margin-right: 20px;
        }
        .search-bar input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            flex-grow: 1;
        }
        .profile-icon {
            margin-left: 10px;
            cursor: pointer;
        }
        .main-content {
            display: flex;
            flex-direction: row;
            margin-top: 20px;
            height: 100vh;
        }
        .sidebar {
            width: 200px;
            background-color: #f8f8f8;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
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
            gap: 10px; /* Reduced gap between cards */
            margin-left: 20px;
            padding: 20px;
            flex-grow: 1;
            height: 100%;
            overflow-y: auto;
        }
        .video-card {
            border: 1px solid #ccc;
            padding: 100px;
            background-color: white;
            border-radius: 5px;
            text-align: center;
            max-width: 200px;
            transition: transform 0.5s, background-color 0.5s, box-shadow 0.5s;
        }
        .video-card:hover {
            background-color: #f0f0f0; /* Grey hover color */
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .video-card img {
            width: 100px; /* Reduced width */
            height: 75px;
            border-radius: 5px;
            margin-bottom: 10px;
            object-fit: cover;
        }
        .video-card a {
            text-decoration: none;
            color: black;
            display: block; /* Make the whole card clickable */
        }
    </style>
</head>
<body>
    <nav>
        <h1>DreamStream</h1>
        <div class="navbar">
            <div><a href="#">PROFILE</a></div>
            <div><a href="#">POPULAR</a></div>
            <div><a href="#">CATEGORIES</a></div>
            <div><a href="#">FAVORITES</a></div>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <a href="#"><img src="profile-icon.png" alt="Profile" class="profile-icon" width="30"></a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="sidebar">
            <a href="#"><i class="fas fa-th-list"></i> Channels</a>
            <a href="#"><i class="fas fa-clock"></i> Latest</a>
            <a href="#"><i class="fas fa-cog"></i> Settings</a>
            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <div class="video-grid">
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 1]) }}"> <!-- Updated to include route and video ID -->
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 1</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 2]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 2</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 3]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 3</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 4]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 4</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 5]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 5</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 6]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 6</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 7]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 7</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 8]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 8</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 9]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 9</p>
                </a>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 10]) }}">
                    <img src="https://via.placeholder.com/100" alt="Video Thumbnail">
                    <p>Video 10</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

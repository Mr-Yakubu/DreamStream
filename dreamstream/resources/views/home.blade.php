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
        /* Prevent horizontal scrolling */
        html, body {
            font-family: 'Pacifico', cursive;
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
            flex-grow: 1;
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
            gap: 10px;
            margin-left: 20px;
            padding: 20px;
            flex-grow: 1;
            overflow-y: auto; /
        }
        .video-card {
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 10px; 
            max-width: 385px;
            max-height: 250px;
            position: relative; 
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
    </style>
</head>
<body>
    <nav>
        <h1>DreamStream</h1>
        <div class="navbar">
            <div><a href="#">PROFILE</a></div>
            <div><a href="#">POPULAR</a></div>
            <div><a href="#">CATEGORIES</a></div>
            <div><a href="{{ route('favorites.index') }}">FAVORITES</a></div>
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
            <a href="{{ route('edit_upload') }}"><i class="fas fa-video"></i> Videos</a> 
            <a href="#"><i class="fas fa-cog"></i> Settings</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="video-grid">
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 1]) }}">
                    <img src="{{ asset('Images/HEHE.jpg') }}" alt="Dummy Video Thumbnail">
                    <div class="play-overlay"><i class="fas fa-play"></i></div>
                </a>
                <p>HEHE</p>
            </div>
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 2]) }}">
                    <img src="{{ asset('Images/Night-Life.jpg') }}" alt="Night-Life Video Thumbnail">
                    <div class="play-overlay"><i class="fas fa-play"></i></div>
                </a>
                <p>Night-Life</p>
            </div>

            
            <!-- Manually specify more video cards as needed -->
            <div class="video-card">
                <a href="{{ route('video.player', ['video_id' => 3]) }}">
                    <img src="{{ asset('Images/goretzka.jpg') }}" alt="Video Thumbnail">
                    <div class="play-overlay"><i class="fas fa-play"></i></div>
                </a>
                <p>GORETZKA!</p>
            </div>
        </div>
    </div>
</body>
</html>

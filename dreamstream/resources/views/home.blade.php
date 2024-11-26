<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - DreamStream</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-x: hidden;
        }

        nav {
            width: 100%;
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }

        nav h1 {
            font-family: 'Pacifico', cursive;
            font-size: 2.5em;
            font-weight: 700;
            color: #b8b8b8; 
            background: linear-gradient(45deg, #000000, #000000);
            -webkit-background-clip: text;
            color: transparent;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3);
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
            flex-wrap: wrap; /* Make navbar items wrap on smaller screens */
        }

        .navbar div {
            display: flex;
            align-items: center;
            flex-grow: 1;
            justify-content: center;
        }

        .navbar a {
            margin: 0 10px; /* Reduced margin for better responsiveness */
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            color: black;
            text-decoration: none;
            transition: color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
        }

        .navbar a i {
            margin-right: 8px;
        }

        .navbar a:hover {
            color: #3f4244;
            transform: scale(1.1);
        }

        .search-bar {
            display: flex;
            align-items: center;
            margin: 10px 0; /* Add margin for smaller screens */
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

        .main-content {
            display: flex;
            flex-direction: row;
            margin-top: 20px;
            flex-grow: 1;
        }

        .sidebar {
            font-weight: 700;
            width: 200px;
            background-color: #f8f8f8;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: auto; /* Allow sidebar height to adjust automatically */
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
            gap: 16px;
            margin-left: 45px;
            padding: 50px;
            flex-grow: 1;
            overflow-y: auto;
        }

        @media (max-width: 1200px) {
            .video-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 800px) {
            .video-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .sidebar {
                width: 150px; /* Adjust sidebar width */
                font-size: 14px; /* Adjust text size */
            }
        }

        @media (max-width: 500px) {
            .video-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column; /* Stack navbar items */
            }

            .navbar div {
                justify-content: center; /* Center items */
            }

            @media (max-width: 800px) {

            .search-bar {
                flex-direction: column; /* Stack search bar and profile picture vertically */
                align-items: center;
                margin: 10px 0;
            }

            .search-bar form {
                width: 100%; /* Full width for smaller screens */
            }

            .search-bar input[type="text"] {
                width: 100%; /* Full width input box */
            }

            .search-bar a img {
                width: 35px; /* Slightly smaller profile picture for narrow screens */
                height: 35px;
            }
        }

            @media (max-width: 500px) {
            .search-bar a img {
                width: 30px; /* Further reduce size for very small screens */
                height: 30px;
            }
        }
            }

            .video-card {
                width: 100%;
                aspect-ratio: 16/9;
                background-color: white;
                border: 1px solid #ccc;
                border-radius: 15px;
                overflow: hidden;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: transform 0.5s, background-color 0.5s, box-shadow 0.5s;
            }

        .video-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .video-card:hover {
            background-color: #f0f0f0;
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .video-title {
            margin: 10px 0 0;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <nav>
        <h1>DreamStream</h1>
        <div class="navbar">
            <div><a href="{{ route('home') }}">HOME</a></div>
            <div><a href="{{ route('popular') }}">POPULAR</a></div>
            <div><a href="{{ route ('favorites.index') }}">FAVORITES</a></div>
            <div><a href="#">CATEGORIES</a></div>
            <div style="display: flex; justify-content: flex-start;">
                <div class="search-bar" style="display: flex; align-items: center; max-width: 300px;">
                    <form action="{{ route('search') }}" method="GET" style="display: flex; align-items: center; flex-grow: 1;">
                        <input type="text" name="query" placeholder="Search..." required 
                               style="flex: 1; padding: 2px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px 0 0 4px; height: 25px;">
                        <button type="submit" 
                                style="background: none; border: none; padding: 4px; font-size: 14px; border-radius: 0 4px 4px 0; cursor: pointer; height: 30px;">
                            <i class="fas fa-search" style="color: black;"></i>
                        </button>
                    </form>
                    <a href="{{ route('profile.picture.form') }}" style="margin-left: 8px; display: flex; align-items: center;">
                        <img src="{{ asset('images/profiles/' . (session('profile_picture') ?? 'default.png')) }}" 
                             alt="Profile Picture" 
                             style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid #ccc; object-fit: cover;">
                    </a>
                </div>
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
            @foreach ($videos as $video)
                <div class="video-wrapper">
                    <div class="video-card">
                        <a href="{{ route('video.player', ['video_id' => $video->id]) }}">
                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }} Thumbnail">
                        </a>
                    </div>
                    <p class="video-title">{{ $video->title }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

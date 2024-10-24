<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player - DreamStream</title>
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
            overflow-x: hidden; /* Prevent horizontal scrolling */
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
        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-toggle {
            text-decoration: none;
            color: black;
            padding: 10px;
            font-family: 'Pacifico', cursive;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            min-width: 160px;
            z-index: 1;
        }
        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .main-content {
            display: flex;
            flex-direction: row;
            height: 100vh;
            width: 100%; 
            box-sizing: border-box; 
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
        .video-player {
            flex-grow: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start; 
            margin-right: 10px; 
        }
        .video-player video {
            width: 900px; 
            height: 506px; 
            border-radius: 5px; /* Rounded corners */
        }
        .video-details {
            text-align: left; 
            margin-top: 15px; /* Space between video and details */
        }
        .favorite-button {
            margin-top: 10px; /* Space between video details and button */
            background-color: #f0f0f0;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .favorite-button:hover {
            background-color: #e0e0e0;
        }
        .upcoming-section {
            width: 300px; 
            margin: 0 auto; 
        }
        .upcoming-section h3 {
            margin: 0 0 10px; /* Space below the title */
        }
        .video-card {
            border: 1px solid #ccc;
            padding: 10px; 
            background-color: white;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px; 
            transition: transform 0.5s, background-color 0.5s;
            width: 100%; 
        }
        .video-card:hover {
            background-color: #f0f0f0; /* Grey hover color */
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .video-card img {
            width: 100%; /
            height: 150px; /* Adjust height as necessary */
            border-radius: 5px;
            margin-bottom: 10px;
            object-fit: cover; 
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column; /* Stack the sidebar and video player */
            }
            .sidebar {
                width: 100%; 
                margin-bottom: 20px; /* Space between sidebar and video player */
            }
            .upcoming-section {
                width: 100%; 
                margin-left: 0; 
            }
        }
    </style>
    <script>
        function addToFavorites(videoId) {
            fetch(`/favorites/add/${videoId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                },
                body: JSON.stringify({ userId: {{ auth()->user()->id }} }) 
            })
            .then(response => {
                if (response.ok) {
                    alert('Video added to favorites!');
                } else {
                    alert('Failed to add to favorites.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body>
    <nav>
        <h1>DreamStream</h1>
        <div class="navbar">
            <div><a href="{{ route('home') }}">HOME</a></div> <!-- Updated link to home -->
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
            <a href="{{ url('/') }}"><i class="fas fa-clock"></i> Latest</a>
            <a href="#"><i class="fas fa-cog"></i> Settings</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="video-player">
            <video controls>
                <source src="{{ asset($video->file_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="video-details">
                <h2>{{ $video->title }}</h2>
                <p>Uploaded on: {{ $video->created_at->format('F j, Y') }}</p>
                <p>Uploaded by: {{ optional($video->user)->name ?? 'Unknown User' }}</p>
                <p>{{ $video->description }}</p> <!-- Video description -->
                <button class="favorite-button" onclick="addToFavorites({{ $video->id }})">Add to Favorites</button>
                <i class="fas fa-heart"></i>
            </div>
        </div>

        <div class="upcoming-section">
            <h3>Upcoming Videos</h3>
            @foreach($upcomingVideos as $upcomingVideo)
                <div class="video-card">
                    <img src="{{ asset('images/' . $upcomingVideo->thumbnail) }}" alt="{{ $upcomingVideo->title }}">
                    <a href="{{ route('video.player', $upcomingVideo->id) }}">
                        <h4>{{ $upcomingVideo->title }}</h4>
                        <p>{{ $upcomingVideo->created_at->format('F j, Y') }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
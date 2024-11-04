<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - DreamStream</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styling */
        html, body {
            font-family: 'Pacifico', cursive;
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
        /* Sidebar Styling */
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
        /* Settings Page Content */
        .settings-container {
            flex-grow: 1;
            padding: 20px;
        }
        .settings-header {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 2px solid #ccc;
        }
        .settings-header a {
            font-size: 20px;
            color: black;
            text-decoration: none;
            padding: 10px;
            transition: color 0.3s, border-bottom 0.3s;
        }
        .settings-header a:hover, .settings-header a.active {
            color: #3f4244;
            border-bottom: 2px solid #3f4244;
        }
        .settings-sections {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .settings-card {
            padding: 30px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 10px;
            transition: box-shadow 0.3s, transform 0.3s;
            cursor: pointer;
        }
        .settings-card:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }
        /* Account Info Section Styling */
        .account-info, .upload-history {
            display: none; /* Initially hidden */
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .account-info input, .upload-history div {
            margin-top: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: calc(100% - 16px);
        }
        #saveButton {
            background-color: #3f4244; /* Match the theme */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 9px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        #saveButton:hover {
            background-color: #2e3031; /* Darker shade on hover */
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <h1>DreamStream</h1>
        <div class="navbar">
            <div><a href="{{ route('home') }}">HOME</a></div>
            <div><a href="{{ route('popular') }}">POPULAR</a></div>
            <div><a href="#">CATEGORIES</a></div>
            <div><a href="{{ route('favorites.index') }}">FAVORITES</a></div>
            <div class="search-bar">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="query" placeholder="Search..." required>
                    <button type="submit" style="display: none;"></button>
                </form>
                <a href="{{ route('settings') }}"><img src="profile-icon.png" alt="Profile" class="profile-icon" width="30"></a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="{{ route('channels') }}"><i class="fas fa-th-list"></i> Channels</a>
            <a href="{{ route('home') }}"><i class="fas fa-clock"></i> Latest</a>
            <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Settings Page Content -->
        <div class="settings-container">
            <div class="settings-header">
                <a href="#" class="active">Dashboard</a>
                <a href="#">Manage Videos</a>
                <a href="#">User Activity</a>
            </div>
            <div class="settings-sections">
                <div class="settings-card" id="accountInfoCard">Account Information</div>
                <div class="settings-card">User Channel Information</div>
                <div class="settings-card" id="uploadHistoryCard">Upload History</div>
                <div class="settings-card">Deactivate Account</div>
            </div>

            <div class="account-info" id="accountInfo">
                <h2>Account Information</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" value="" placeholder="Your Username">
                <label for="email">Email:</label>
                <input type="text" id="email" value="" disabled>
                <label for="date_of_birth">Date of Birth:</label>
                <input type="text" id="date_of_birth" value="" disabled>
                <button id="saveButton">Save Changes</button>
            </div>

            <div class="upload-history" id="uploadHistory">
                <h2>Upload History</h2>
                <div id="uploadList"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('accountInfoCard').addEventListener('click', function() {
            // Fetch user data from the database via AJAX
            fetch('{{ route('user.account.info') }}')
                .then(response => response.json())
                .then(data => {
                    // Update input fields with user data
                    document.getElementById('username').value = data.username;
                    document.getElementById('email').value = data.email;
                    document.getElementById('date_of_birth').value = data.date_of_birth;
                });
    
            // Toggle visibility of sections
            document.getElementById('accountInfo').style.display = 'block';
            document.getElementById('uploadHistory').style.display = 'none';
        });
    
        document.getElementById('uploadHistoryCard').addEventListener('click', function() {
            // Fetch upload history from the database via AJAX
            fetch('{{ route('user.upload.history') }}')
                .then(response => response.json())
                .then(data => {
                    // Populate upload history
                    const uploadList = document.getElementById('uploadList');
                    uploadList.innerHTML = '';
                    data.forEach(video => {
                        const videoDiv = document.createElement('div');
                        videoDiv.innerHTML = `<strong>Title:</strong> ${video.title} <br>
                                              <strong>Description:</strong> ${video.description} <br>
                                              <strong>Uploaded on:</strong> ${new Date(video.created_at).toLocaleDateString()}`;
                        uploadList.appendChild(videoDiv);
                    });
                });
    
            // Toggle visibility of sections
            document.getElementById('accountInfo').style.display = 'none';
            document.getElementById('uploadHistory').style.display = 'block';
        });
    
        // Add saveButton event listener to update the username
        document.getElementById('saveButton').addEventListener('click', function() {
            const username = document.getElementById('username').value;
    
            // Send updated username to the server
            fetch('{{ route('user.update.username') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ username })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Username updated successfully!');
                } else {
                    alert('Failed to update username.');
                }
            });
        });
    </script>    
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - DreamStream</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styling */
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

        .navbar .search-bar img {
            width: 50px; 
            height: auto; 
            max-width: 100%; 
            border-radius: 50%; 
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
            display: none;
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
            background-color: #3f4244; 
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 9px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        #saveButton:hover {
            background-color: #2e3031; 
            transform: scale(1.05);
        }

        /* Keyframes for right to left animation */
        @keyframes slideFromRight {
        0% {
        transform: translateX(100%); /
        opacity: 0; 
        }
        100% {
        transform: translateX(0); 
        opacity: 1; 
        }
        }

                /* Apply animation to elements you want to animate */
        .animate-right-to-left {
            animation: slideFromRight 1s ease-out; 
        }

            /* Optional: Styling for the container or sections */
        .animated-section {
        display: block;
        padding: 20px;
        background-color: #f0f0f0; 
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
        margin: 15px 0; /* Spacing between sections */
        }

        .manage-videos, .user-activity {
        display: none; /* Hidden by default */
        }

        .upload-history {
            padding: 10px;
        }

        .video-item {
             display: flex;
             align-items: center;
             margin-bottom: 15px;
        }

        .video-item img {
             border-radius: 5px;
             box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
    </nav>

    <div class="main-content">

      <!-- Sidebar -->
    <div class="sidebar">
            <a href="{{ route('channels') }}"><i class="fas fa-th-list"></i> Channels</a>
            <a href="{{ route('home') }}"><i class="fas fa-clock"></i> Latest</a>
            <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>

         @if(Auth::user()->user_type == 'parent')
            <a href="{{ route('parent_dashboard', ['childUserId' => Auth::user()->id]) }}">
            <i class="fas fa-shield-alt"></i> Parental Controls
            </a>
        @endif

        @if(Auth::user()->user_type == 'administrator')
            <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
            </a>
        @endif

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
    </form>
</div>


        <!-- Settings Page Content -->
        <div class="settings-container">
            <!-- Settings Header -->
            <div class="settings-header">
                <a href="#" class="active">User Dashboard</a>
                <a href="#">Manage Videos</a>
                <a href="#">User Activity</a>
            </div>
        
            <!-- Dashboard Section with Animation -->
            <div class="dashboard animated-section animate-right-to-left">
                <h1>Welcome to the Dashboard</h1>
                <p>Dashboard Overview.</p>
        
                <!-- Settings Sections inside Dashboard -->
                <div class="settings-sections">
                    <!-- Individual Cards with Animation -->
                    <div class="settings-card animated-section animate-right-to-left" id="accountInfoCard">
                        Account Information
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
                    </div>
                    <div class="settings-card animated-section animate-right-to-left">
                        User Channel Information
                    </div>
                    <div class="settings-card animated-section animate-right-to-left" id="uploadHistoryCard">
                        Upload History
                        <div class="upload-history" id="uploadHistory">
                            <div id="uploadList">
                                <p>Loading your latest uploads...</p>
                            </div>
                        </div>
                    </div>
                    <div class="settings-card animated-section animate-right-to-left">
                        Deactivate Account
                    </div>
                </div>
            </div>

    <script>
                document.addEventListener('DOMContentLoaded', () => {
    const uploadList = document.getElementById('uploadList');

    fetch('{{ route('upload.history') }}')
        .then(response => response.json())
        .then(videos => {
            if (videos.length === 0) {
                uploadList.innerHTML = '<p>No videos uploaded yet.</p>';
                return;
            }

            // Clear loading message
            uploadList.innerHTML = '';

            // Populate with latest videos
            videos.forEach(video => {
                const videoItem = document.createElement('div');
                videoItem.classList.add('video-item');
                videoItem.innerHTML = `
                    <div>
                        <img src="${video.thumbnail}" alt="${video.title}" style="width: 150px; height: auto; margin-right: 10px;">
                        <p><strong>${video.title}</strong></p>
                    </div>
                `;
                uploadList.appendChild(videoItem);
            });
        })
        .catch(error => {
            console.error('Error fetching upload history:', error);
            uploadList.innerHTML = '<p>Failed to load videos. Please try again later.</p>';
        });
});
</script>


<!------- Fix the Manage Videos Section ------>

        
            <!-- Manage Videos Section -->
            <div class="manage-videos animated-section animate-right-to-left" id="manageVideosSection">
                <h3>Manage Your Videos</h3>
                <p>Content to manage videos will be displayed here.</p>
            </div>
            
        
<!------- Fix the User Activity ------>


             
<div class="user-activity animated-section animate-right-to-left" id="userActivitySection">
    <h2>User Activity</h2>
    <p>Content for User Activites will be displayed here.</p>

    <!--
    {{-- @if($activities->isEmpty()) --}}
        <p>No recent activity found.</p>
    {{-- @else --}}
        <ul class="activity-list">
            {{-- @foreach($activities as $activity) --}}
                <li>
                    <strong><{ $activity->action }}</strong>
                    <p>{ $activity->details }}</p>
                    <small>On: { $activity->created_at->format('M d, Y h:i A') }}</small>
                </li>
            {{-- @endforeach --}}
        </ul>
    {{-- @endif --}}
</div>
-->


        </div>
    </div>



    <script>
        function fetchUserActivity() {
            fetch('{{ route('user.activity') }}')
                .then(response => response.json())
                .then(data => {
                    const activitySection = document.getElementById('userActivitySection');
                    let activityHtml = '';
                    
                    if (data.activities.length === 0) {
                        activityHtml = '<p>No recent activity found.</p>';
                    } else {
                        activityHtml = '<ul class="activity-list">';
                        data.activities.forEach(activity => {
                            activityHtml += `
                                <li>
                                    <strong>${activity.action}</strong>
                                    <p>${activity.details}</p>
                                    <small>On: ${new Date(activity.created_at).toLocaleString()}</small>
                                </li>
                            `;
                        });
                        activityHtml += '</ul>';
                    }
                    
                    activitySection.innerHTML = activityHtml;
                })
                .catch(error => console.error('Error fetching user activity:', error));
        }
    
        // Call the function to load the user activity initially
        fetchUserActivity();
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all the links in the settings header
            const links = document.querySelectorAll('.settings-header a');
            
            // Get all the sections
            const dashboard = document.querySelector('.dashboard');
            const manageVideos = document.querySelector('.manage-videos');
            const userActivity = document.querySelector('.user-activity');
            
            // Function to show the active section and hide others
            function switchView(activeSection) {
                dashboard.style.display = 'none';
                manageVideos.style.display = 'none';
                userActivity.style.display = 'none';
                
                activeSection.style.display = 'block';
            }
            
            // Set initial view (show dashboard by default)
            switchView(dashboard);
            
            // Event listener for each link in the header
            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    // Prevent the default link behavior
                    event.preventDefault();
                    
                    // Remove active class from all links
                    links.forEach(link => link.classList.remove('active'));
                    
                    // Add active class to clicked link
                    link.classList.add('active');
                    
                    // Switch to the corresponding section
                    if (link.textContent === 'User Dashboard') {
                        switchView(dashboard);
                    } else if (link.textContent === 'Manage Videos') {
                        switchView(manageVideos);
                    } else if (link.textContent === 'User Activity') {
                        switchView(userActivity);
                    }
                });
            });
        });
    </script>

    <script>
        // Function to display the correct section based on clicked link
        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.settings-container > div').forEach(div => {
                div.classList.remove('active-section');
            });

            // Remove active class from all links
            document.querySelectorAll('.settings-header a').forEach(link => {
                link.classList.remove('active');
            });

            // Show the clicked section and add active class to the respective link
            document.getElementById(section + 'Section').classList.add('active-section');
            document.querySelector('.settings-header a[href="#' + section + 'Section"]').classList.add('active');
        }
    </script>

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
                    const uploadList = document.getElementById('user.upload.history');
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

<script>
    // Select the navigation links
    const manageVideosLink = document.querySelector('.settings-header a:nth-child(2)');
    const userActivityLink = document.querySelector('.settings-header a:nth-child(3)');

    // Select the sections that need to be shown/hidden
    const manageVideosSection = document.getElementById('manageVideosSection');
    const userActivitySection = document.getElementById('userActivitySection');
    const dashboardSection = document.querySelector('.dashboard');

    // Function to hide all sections
    function hideSections() {
        manageVideosSection.style.display = 'none';
        userActivitySection.style.display = 'none';
    }

    // Initially hide the sections
    hideSections();

    // Show the Manage Videos section when the link is clicked
    manageVideosLink.addEventListener('click', function(e) {
        e.preventDefault();
        hideSections(); // Hide all other sections
        manageVideosSection.style.display = 'block'; // Show the clicked section
    });

    // Show the User Activity section when the link is clicked
    userActivityLink.addEventListener('click', function(e) {
        e.preventDefault();
        hideSections(); // Hide all other sections
        userActivitySection.style.display = 'block'; // Show the clicked section
    });

    // Show the Dashboard section by default
    dashboardSection.style.display = 'block'; // Make sure dashboard is visible initially
</script>
</body>
</html>
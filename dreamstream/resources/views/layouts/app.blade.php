<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        
        body {
            font-family: 'Poppins', sans-serif; /* Apply Poppins font to all body text */
            color: black; /* Set all text to black */
        }
        .funky-title {
            font-size: 2.5rem; /* Adjust size of the title */
            color: black; /* Ensure the title is black */
        }
        .nav-link {
            font-family: 'Poppins', sans-serif; /* Apply font to sidebar links */
            color: black; /* Set link color to black */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }
        .nav-link:hover {
            background-color: #020202; /* Background color on hover */
            color: white; /* Text color on hover */
        }
        .nav-link.active {
            background-color: #050505; /* Active link background color */
            color: white; /* Active link text color */
        }
        nav {
            padding: 20px; /* Add padding around sidebar */
        }
        main {
            padding: 20px; /* Add padding for main content */
            background-color: #f8f9fa; /* Light background for main content */
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-3">
        <h1 class="funky-title">DreamStream</h1>
    </header>

    <!-- Navbar for Home -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Home</a>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-light" style="min-width: 200px;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('media.index') }}">Media</a>
                    <li><a href="{{ route('media.create') }}">Upload Video</a></li>
                    <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recommendations.index') }}">Recommendations</a>
                </li>
            </ul>
        </nav>

        <main class="container mt-4" style="flex-grow: 1;">
            @yield('content')
        </main>
    </div>

    <footer class="text-center py-3">
        <p>Copyright &copy; 2024 DreamStream</p>
    </footer>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

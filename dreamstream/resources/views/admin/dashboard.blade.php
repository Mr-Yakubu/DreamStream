<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DreamStream</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Same styles as in your original code */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-family: 'Pacifico', sans-serif;
            color: #000;
            margin-bottom: 20px;
        }

        .dashboard-section {
            width: 100%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: bold;
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .item-controls {
            display: flex;
            gap: 10px;
        }

        .action-button {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            color: #fff;
            background-color: #333;
            text-align: center;
            transition: background-color 0.3s;
        }

        .action-button.delete {
            background-color: #e74c3c;
        }

        .action-button:hover {
            background-color: #555;
        }

        .action-button.delete:hover {
            background-color: #c9302c;
        }

        .home-button {
           display: inline-block;
           margin-bottom: 20px; 
           text-decoration: none;
           padding: 10px 20px;
           border-radius: 5px;
           background-color: #333;
           color: #fff;
           font-weight: bold;
           transition: background-color 0.3s;
        }

        .home-button i {
            margin-right: 5px;
        }

        .home-button:hover {
           background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <!-- Home Button -->
    <a href="{{ route('home') }}" class="home-button">
        <i class="fas fa-home"></i> Home
    </a>

    <!-- Manage Users Section -->
    <div class="dashboard-section">
        <h2 class="section-title">Manage Users</h2>
        @foreach ($users as $user)
            <div class="item">
                <span class="item-name">{{ $user->name }} ({{ $user->username }})</span>
                <div class="item-controls">
                    <a href="{{ route('admin.editUser', ['id' => $user->id]) }}" class="action-button">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button class="action-button delete" onclick="openDeleteModal('{{ $user->id }}', 'users')">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Manage Videos Section -->
    <div class="dashboard-section">
        <h2 class="section-title">Manage Videos</h2>
        @foreach ($videos as $video)
            <div class="item">
                <span class="item-name">{{ $video->title }}</span>
                <div class="item-controls">
                    <a href="{{ route('video.player', ['video_id' => $video->id]) }}" class="action-button">
                        <i class="fas fa-play"></i> View
                    </a>
                    <button class="action-button delete" onclick="openDeleteModal('{{ $video->id }}', 'videos')">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Delete Confirmation</h3>
            <p>Are you sure you want to delete this item?</p>
            <div class="modal-buttons">
                <button class="action-button" onclick="closeModal()">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-button delete">Confirm</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Modal Overlay */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        /* Modal Content */
        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Modal Buttons */
        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .action-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .action-button.delete {
            background-color: #e74c3c;
            color: #fff;
        }

        .action-button:hover {
            opacity: 0.9;
        }
    </style>

    <script>
        // Function to open the modal
        function openDeleteModal(id, type) {
            const form = document.getElementById('deleteForm');
            form.action = `/${type}/${id}`; // Update form action dynamically
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'flex'; // Center modal using flex display
        }

        // Function to close the modal
        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'none'; // Hide the modal
        }
    </script>
</body>
</html>

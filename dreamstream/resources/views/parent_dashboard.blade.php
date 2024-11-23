<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - DreamStream</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            font-family: 'Pacifico', sans-serif;
            color: #000000;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .child-list {
            width: 100%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgb(0, 0, 0);
            margin-bottom: 20px;
        }

        .child-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .child-item:last-child {
            border-bottom: none;
        }

        .child-name {
            font-weight: bold;
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .child-username {
            margin-left: 10px;
            margin-right: 300px;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .child-controls {
            display: flex;
            gap: 10px;
        }

        .parental-controls-link, .delete-account-button {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            color: #fff;
            background-color: #333;
            white-space: nowrap;
            text-align: center;
            transition: background-color 0.3s;
            min-width: 120px;
        }

        .delete-account-button {
            background-color: #e74c3c;
        }

        .parental-controls-link:hover {
            background-color: #555;
        }

        .delete-account-button:hover {
            background-color: #c9302c;
        }

        .reports-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1500px;
            margin-top: 20px;
        }

        .reports-section {
            margin-right: 2%;
            width: 48%;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgb(0, 0, 0);
        }

        .reports-section h2 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .report-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .report-item:last-child {
            border-bottom: none;
        }

        .view-report-link {
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .view-report-link:hover {
            background-color: #555;
        }

        /* For Performance Reports button */
        .performance-report-button {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        /* For Child Activity Reports button */
        .child-activity-report-button {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .home-button {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .home-button:hover {
            background-color: #555;
        }

        /* Custom Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .modal-header {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .modal-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .modal-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            color: #fff;
            transition: background-color 0.3s;
        }

        .modal-button.cancel {
            background-color: #333;
        }

        .modal-button.confirm {
            background-color: #e74c3c;
        }

        .modal-button.cancel:hover {
            background-color: #555;
        }

        .modal-button.confirm:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="home-button">
        <i class="fas fa-home"></i> Home
    </a>

    <h1>Parent Dashboard</h1>

    <div class="child-list">
        <h2>Manage Children</h2>
        @foreach ($children as $child)
            <div class="child-item">
                <span class="child-name">{{ $child->name }}</span>
                <span class="child-username">({{ $child->username }})</span>
                <div class="child-controls">
                    <a href="{{ route('parental_controls.show', ['childUserId' => $child->id]) }}" class="parental-controls-link">
                        <i class="fas fa-user-shield"></i> Manage Controls
                    </a>
                    <button class="delete-account-button" onclick="openModal(this)" data-child-id="{{ $child->id }}">
                        <i class="fas fa-trash-alt"></i> Delete Account
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="reports-container">
        <div class="reports-section">
            <h2>Child Activity Reports</h2>
            @foreach ($children as $child)
                <div class="report-item">
                    <p>Username: {{ $child->username }}</p>
                    <p class="report-title">{{ $child->name }} Activities</p>
                    <ul>
                        <li>Videos Watched: {{ $child->videos_watched }}</li>
                        <li>Likes Given: {{ $child->likes }}</li>
                        <li>Dislikes Given: {{ $child->dislikes }}</li>
                        <li>Favorites Added: {{ $child->favorites }}</li>
                    </ul>
                    <a href="{{ route('child_activity_report', ['childUserId' => $child->id]) }}" class="view-report-link child-activity-report-button">
                        View Detailed Report
                    </a>
                </div>
            @endforeach
        </div>

        <div class="reports-section">
            <h2>Performance Reports</h2>
            @foreach ($children as $child)
                <div class="report-item">
                    <p>Username: {{ $child->username }}</p>
                    <p class="report-title">{{ $child->name }} Performance</p>
                    <ul>
                        <li>Most Watched Genre: {{ $child->most_watched_genre }}</li>
                        <li>Average Watch Time: {{ $child->average_watch_time }} mins</li>
                    </ul>
                    <a href="{{ route('child_performance_report', ['childUserId' => $child->id]) }}" class="view-report-link performance-report-button">
                        View Performance Details
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Delete Confirmation</div>
            <p>Are you sure you want to delete this account?</p>
            <div class="modal-buttons">
                <button class="modal-button cancel" onclick="closeModal()">Cancel</button>
                <form id="deleteForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-button confirm">Confirm</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(button) {
            const childId = button.dataset.childId;
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/children/${childId}`;
            modal.style.display = 'block';
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'none';
        }
    </script>
</body>
</html>

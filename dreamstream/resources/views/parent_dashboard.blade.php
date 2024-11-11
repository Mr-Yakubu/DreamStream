<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - DreamStream</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Pacifico', cursive;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .child-list {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .child-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .child-item:last-child {
            border-bottom: none;
        }
        .child-name {
            font-weight: bold;
        }
        .parental-controls-link {
            color: #333;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            transition: background-color 0.3s;
        }
        .parental-controls-link:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Parent Dashboard</h1>
    
    <div class="child-list">
        @foreach ($children as $child)
            <div class="child-item">
                <span class="child-name">{{ $child->name }}</span>
                <span class="child-username">({{ $child->username }})</span> <!-- This will display the username -->
                <a href="{{ route('parental_controls.show', ['childUserId' => $child->id]) }}" class="parental-controls-link">
                    <i class="fas fa-user-shield"></i> Manage Controls
                </a>
            </div>
        @endforeach
    </div>
</body>
</html>

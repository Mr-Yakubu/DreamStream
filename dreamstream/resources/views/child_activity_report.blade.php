<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $child->name }} - Activity Report</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            font-family: 'Pacifico', sans-serif;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 1.5rem;
            color: #333;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .activity-report {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }
        .child-info {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .child-info p {
            margin: 0;
            font-size: 1.1rem;
        }
        .activity-log {
            list-style: none;
            padding: 0;
        }
        .activity-log li {
            background-color: #fafafa;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .activity-log li strong {
            color: #333;
            font-weight: bold;
        }
        .back-button {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <!-- Back Button -->
    <a href="{{ route('parent_dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

    <div class="activity-report">
        <h1>{{ $child->name }} Activity Report</h1>

        <div class="child-info">
            <p><strong>Username:</strong> {{ $child->username }}</p>
        </div>

        <h2>Activity Logs</h2>
        <ul class="activity-log">
            @foreach ($activityLogs as $log)
                <li>
                    <strong>Action:</strong> {{ $log->action }}
                    <br>
                    <strong>Details:</strong> {{ $log->details }}
                    <br>
                    <strong>Timestamp:</strong> {{ $log->timestamp }}
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>

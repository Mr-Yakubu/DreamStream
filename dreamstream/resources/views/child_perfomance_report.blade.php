<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Child Performance Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>{{ $child->name }} Performance Report</h1>
    <ul>
        <li><strong>Most Watched Genre:</strong> {{ $performanceData['most_watched_genre'] }}</li>
        <li><strong>Average Watch Time:</strong> {{ $performanceData['average_watch_time'] }} minutes</li>
    </ul>
</body>
</html>

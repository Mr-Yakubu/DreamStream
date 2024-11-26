<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parental Controls - DreamStream</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Add your custom styling here for consistency with DreamStream's theme */
        body {
            font-family: 'Nunito', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h1 {
            font-family: 'Pacifico', sans-serif;
            color: #000000;
            font-weight: 700;
        }
        form {
            width: 100%;
            max-width: 600px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgb(0, 0, 0);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            font-family: 'Nunito', sans-serif;
            width: 100%; 
            max-width: 500px; 
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px; 
            display: block; 
        }
        button {
            font-family: 'Nunito', sans-serif;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #555;
        }
        .alert {
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h1>Parental Controls</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('parental_controls.update', ['childUserId' => $childUserId]) }}" method="POST">
        @csrf
        @method('PUT')
    
        <!-- Age Limit -->
        <div class="form-group">
            <label for="age_limit">Age Limit For Videos:</label>
            <input type="number" id="age_limit" name="age_limit" min="0" max="18" value="{{ old('age_limit', $parentalControl->age_limit ?? '') }}" required>
        </div>
    
        <!-- Restricted Keywords -->
        <div class="form-group">
            <label for="restricted_keywords">Restricted Keywords For Videos:</label>
            <textarea id="restricted_keywords" name="restricted_keywords" rows="3">{{ old('restricted_keywords', $parentalControl->restricted_keywords ?? '') }}</textarea>
            <small>Enter keywords separated by commas, e.g. violence, horror.</small>
        </div>
    
        <!-- Time Limits -->
        <div class="form-group">
            <label for="time_limits">Time Limits (in hours):</label>
            <input type="number" id="time_limits" name="time_limits" min="0" max="24" value="{{ old('time_limits', $parentalControl->time_limits ?? '') }}" required>
        </div>

        <!-- Button Container for "Update" and "Done" buttons -->
        <div class="button-container">
            <button type="submit">Update Parental Controls</button>
            <a href="{{ route('home') }}">
                <button type="button">Done</button> 
            </a>
        </div>
    </form>    
</body>
</html>

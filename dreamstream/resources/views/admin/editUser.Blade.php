<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - {{ $user->username }}</title>
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
            font-family: 'Nunito', sans-serif;
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
        .edit-user-form {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            max-width: 900px; /* Limit input width to 400px */
            padding: 12px; /* Add padding to the input fields */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box; /* Ensures padding is included in the width */
        }
        .form-group input[type="submit"] {
            background-color: #333;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group input[type="submit"]:hover {
            background-color: #555;
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
    <a href="{{ route('admin.dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

    <div class="edit-user-form">
        <h1>Edit User - {{ $user->username }}</h1>

        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
            @csrf
            @method('PUT')


            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- User Type -->
            <div class="form-group">
                <label for="user_type">User Type</label>
                <select name="user_type" id="user_type" required>
                    <option value="parent" {{ $user->user_type == 'parent' ? 'selected' : '' }}>Parent</option>
                    <option value="child" {{ $user->user_type == 'child' ? 'selected' : '' }}>Child</option>
                </select>
            </div>

            <!-- Age -->
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <input type="submit" value="Update User">
            </div>
        </form>
    </div>

</body>
</html>

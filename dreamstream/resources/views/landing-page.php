<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to DreamStream</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        html,
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffff;
            color: #000000;
            text-align: center;
        }

        .logo img {
            width: 600px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.5rem;
            line-height: 1.8;
            margin-bottom: 30px;
            font-family: 'Nunito', sans-serif;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1rem;
            border: 2px solid #000000;
            border-radius: 30px;
            text-decoration: none;
            color: #000000;
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
        }

        .btn:hover {
            background-color: #000000;
            color: #ffffff;
            transform: scale(1.05);
        }

        .btn:first-child {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div>

        <h1>Welcome to DreamStream</h1>
        <p>
            DreamStream is your secure and educational video streaming platform tailored for children and families.
        </p>
        <p>
            With curated content and robust parental controls, we ensure a safe and enjoyable experience for everyone.
        </p>
        <p>
            Dive into an innovative world of learning and entertainment today!
        </p>
        <div class="btn-container">
            <a href="{{ route('login') }}" class="btn">Get Started</a>
        </div>
    </div>
</body>

</html>

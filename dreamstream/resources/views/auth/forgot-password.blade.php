<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            text-align: left;
            font-size: 14px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Forgot Password</h2>
    <form action="{{ route('forgot-password.submit') }}" method="POST">
        @csrf
        <label for="email">Enter Your Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Send Reset Link</button>

        <!-- Success or error message -->
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @elseif($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
    </form>
</div>

</body>
</html>

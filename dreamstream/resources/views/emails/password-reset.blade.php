<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset Request</h2>
    <p>Hello,</p>
    <p>We received a request to reset your password. You can reset it by clicking the link below:</p>
    <a href="{{ $resetLink }}">Reset Password</a>
    <p>If you didn't request a password reset, please ignore this email.</p>
</body>
</html>

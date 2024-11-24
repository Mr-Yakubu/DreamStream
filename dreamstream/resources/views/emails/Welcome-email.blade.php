<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Welcome to DreamStream, {{ $username }}!</h2>
    <p>{{ $messageBody }}</p>
    <p>Thank you for joining us!</p>
    <p>- The DreamStream Team</p>
</body>
</html>

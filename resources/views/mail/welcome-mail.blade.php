<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>{{ $subject }}</h1>
    <p>{{$mailMessage}}</p>
    <p>Your one-time OTP code is: <strong>{{ $otp }}</strong></p>
</body>
</html>
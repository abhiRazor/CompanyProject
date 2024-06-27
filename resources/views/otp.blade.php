<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send OTP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Verification OTP </h2>
        <form action="{{ url('otp/password') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">OTP:</label>
                <input type="number" name="otp" id="otp" class="form-control" required min="100000" max="999999">
                @error('otp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Enter OTP</button>
        </form>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-success mt-3">
                {{ session('error') }}
            </div>
        @endif
    </div>
</body>
</html>

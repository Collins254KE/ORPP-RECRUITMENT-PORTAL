<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - ORPP e-Recruitment Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
        }
        .header-logo {
            display: block;
            margin: 20px auto;
            height: 150px;
        }
        .header-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .form-container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="text-center py-3 bg-white shadow-sm">
        <img src="/assets/img/images.png" alt="ORPP Logo" class="header-logo">
        <div class="header-title">ORPP e-Recruitment Portal</div>
    </div>

    <div class="container form-container">
        <h4 class="mb-4 text-center">Reset Your Password</h4>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input id="password" type="password" name="password" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm New Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

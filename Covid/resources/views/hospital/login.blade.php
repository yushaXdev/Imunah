<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Login - COVIDCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    @if(session('success'))
    <div class="toast-container"><div class="toast toast-success">{{ session('success') }}</div></div>
    @endif
    @if(session('error'))
    <div class="toast-container"><div class="toast toast-error">{{ session('error') }}</div></div>
    @endif

    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-logo">
               <img src="{{ asset('hospital-logo-design.avif') }}" alt="COVIDCare" style="display: block; margin: 0 auto; width: 56px; height: 56px; border-radius: 50%; object-fit: contain;">
                <h2>Hospital Login</h2>
                <p class="auth-subtitle">Sign in to manage patient appointments</p>
            </div>
            <form method="POST" action="{{ route('hospital.login') }}">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="hospital@example.com" required value="{{ old('email') }}">
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">Sign In</button>
            </form>
            <div class="auth-links">
                <a href="{{ route('hospital.register') }}">Register new hospital</a>
                <a href="/">Back to Home</a>
            </div>
        </div>
    </div>

</body>
</html>
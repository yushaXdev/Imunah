<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Register - COVIDCare</title>
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
        <div class="auth-card" style="max-width:500px;">
            <div class="auth-logo">
        <img src="{{ asset('hospital-logo-design.avif') }}" alt="COVIDCare" style="width:56px;height:56px;border-radius:50%;object-fit:contain;">
                <h2>Patient Registration</h2>
                <p class="auth-subtitle">Create your account to get started</p>
            </div>
            <form method="POST" action="{{ route('patient.register') }}">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Ali Ahmed" required value="{{ old('name') }}">
                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="ali@example.com" required value="{{ old('email') }}">
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="+92 300 1234567" required value="{{ old('phone') }}">
                    @error('phone')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" placeholder="Lahore" required value="{{ old('city') }}">
                    @error('city')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" placeholder="Your full address" required>{{ old('address') }}</textarea>
                    @error('address')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">Create Account</button>
            </form>
            <div class="auth-links">
                <a href="{{ route('patient.login') }}">Already have an account? Login</a>
                <a href="/">Back to Home</a>
            </div>
        </div>
    </div>

</body>
</html>
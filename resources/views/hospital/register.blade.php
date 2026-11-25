<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Register - Imunah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-primary: #0B1120;
            --bg-card: rgba(17, 24, 39, 0.7);
            --accent: #14B8A6;
            --accent-hover: #0D9488;
            --text-primary: #F9FAFB;
            --text-secondary: #9CA3AF;
            --border: rgba(255, 255, 255, 0.1);
            --input-bg: rgba(31, 41, 55, 0.8);
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(-45deg, #0B1120, #111827, #064E3B, #0F766E);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: var(--text-primary);
            position: relative;
            overflow-x: hidden;
            padding: 40px 20px;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: 1;
            opacity: 0.15;
            position: fixed;
        }

        .auth-page {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
        }

        .auth-card {
            width: 100%;
            max-width: 800px;
            background: var(--bg-card);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 48px 40px;
            box-shadow: var(--shadow-lg);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.1) 0%, transparent 60%);
            pointer-events: none;
            z-index: -1;
        }

        .auth-logo img {
            height: 75px;
            width: auto;
            margin: 0 auto 20px;
            filter: brightness(0) invert(1);
        }

        .auth-logo h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 32px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 4px;
            position: relative;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            color: var(--text-secondary);
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 16px 16px 16px 48px;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            color: var(--text-primary);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        textarea.form-control {
            padding-top: 16px;
            resize: vertical;
            min-height: 80px;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: rgba(31, 41, 55, 0.9);
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.15);
        }

        .input-wrapper:focus-within i {
            color: var(--accent);
        }

        .form-control::placeholder {
            color: #6B7280;
        }

        .form-error {
            color: #EF4444;
            font-size: 0.8rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.3);
            margin-top: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(20, 184, 166, 0.5);
        }

        .auth-links {
            display: flex;
            justify-content: space-between;
            margin-top: 28px;
            font-size: 0.9rem;
        }

        .auth-links a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .auth-links a:hover {
            color: var(--accent);
        }

        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
        }

        .toast {
            padding: 16px 24px;
            border-radius: 12px;
            color: #fff;
            font-weight: 600;
            margin-bottom: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toast-success { background: #10B981; }
        .toast-error { background: #EF4444; }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full-width {
                grid-column: span 1;
            }
            .auth-card {
                padding: 32px 24px;
            }
            .auth-links {
                flex-direction: column;
                gap: 16px;
                align-items: center;
            }
        }
    </style>
</head>
<body>

    <video autoplay loop muted playsinline class="bg-video">
        <source src="{{ asset('videos/login-bg.mp4') }}" type="video/mp4">
    </video>

    @if(session('success'))
    <div class="toast-container"><div class="toast toast-success"><i class="fa-solid fa-check-circle"></i> {{ session('success') }}</div></div>
    @endif
    @if(session('error'))
    <div class="toast-container"><div class="toast toast-error"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div></div>
    @endif

    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-logo">
                <img src="{{ asset('logo.png') }}" alt="Imunah Logo">
                <h2>Register Hospital</h2>
                <p class="auth-subtitle">Join the platform to manage your patients</p>
            </div>
            
            <form method="POST" action="{{ route('hospital.register') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Hospital Name</label>
                        <div class="input-wrapper">
                            <input type="text" name="name" class="form-control" placeholder="City Medical Center" required value="{{ old('name') }}">
                            <i class="fa-solid fa-hospital"></i>
                        </div>
                        @error('name')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" class="form-control" placeholder="hospital@example.com" required value="{{ old('email') }}">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        @error('email')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <div class="input-wrapper">
                            <input type="text" name="phone" class="form-control" placeholder="+92 300 1234567" required value="{{ old('phone') }}">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        @error('phone')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <div class="input-wrapper">
                            <input type="text" name="city" class="form-control" placeholder="Lahore" required value="{{ old('city') }}">
                            <i class="fa-solid fa-city"></i>
                        </div>
                        @error('city')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group full-width">
                        <label>Full Address</label>
                        <div class="input-wrapper">
                            <textarea name="address" class="form-control" placeholder="Full hospital address" required>{{ old('address') }}</textarea>
                            <i class="fa-solid fa-location-dot" style="top: 18px;"></i>
                        </div>
                        @error('address')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        @error('password')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    Register Hospital <i class="fa-solid fa-hospital-user"></i>
                </button>
            </form>
            
            <div class="auth-links">
                <a href="{{ route('hospital.login') }}">Already registered? Login</a>
                <a href="/">Back to Home</a>
            </div>
        </div>
    </div>

</body>
</html>
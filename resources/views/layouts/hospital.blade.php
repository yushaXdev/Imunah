<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Panel') - Imunah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <style>
        :root {
            --bg-body: #0B1120;
            --bg-sidebar: #111827;
            --bg-card: #1F2937;
            --accent: #0D9488;
            --accent-light: rgba(13, 148, 136, 0.1);
            --text-main: #F9FAFB;
            --text-muted: #9CA3AF;
            --border: #1F2937;
            --sidebar-width: 260px;
            --topbar-height: 70px;
            --transition: all 0.2s ease-in-out;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            font-size: 0.95rem;
        }

        a { text-decoration: none; color: inherit; }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: var(--transition);
        }

        .sidebar-logo {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo img {
            height: 35px;
            width: auto;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 20px 12px;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 0px;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 8px;
            padding-left: 12px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            color: var(--text-muted);
            font-weight: 500;
            transition: var(--transition);
            margin-bottom: 2px;
        }

        .sidebar-nav a:hover {
            background: var(--bg-card);
            color: var(--text-main);
        }

        .sidebar-nav a.active {
            background: var(--accent-light);
            color: var(--accent);
            font-weight: 600;
        }

        .nav-icon {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px;
            background: transparent;
            color: #EF4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            cursor: pointer;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            height: var(--topbar-height);
            background: var(--bg-body);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .topbar-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-main);
        }

        .page-content {
            padding: 32px;
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            padding: 14px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: 500;
            margin-bottom: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .toast-success { background: #10B981; }
        .toast-error { background: #EF4444; }

        .mobile-toggle {
            display: none;
            font-size: 1.5rem;
            color: var(--text-main);
            background: none;
            border: none;
            cursor: pointer;
            margin-right: 15px;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .mobile-toggle {
                display: block;
            }
            .topbar {
                padding: 0 20px;
            }
            .page-content {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .user-name {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    @if(session('success'))
    <div class="toast-container"><div class="toast toast-success"><i class="fa-solid fa-check-circle"></i> {{ session('success') }}</div></div>
    @endif
    @if(session('error'))
    <div class="toast-container"><div class="toast toast-error"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div></div>
    @endif

    <div class="layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('logo.png') }}" alt="Imunah Logo">
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main Menu</div>
                    <a href="{{ route('hospital.dashboard') }}" class="{{ request()->routeIs('hospital.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fa-solid fa-border-all"></i></span>
                        Dashboard
                    </a>
                    <a href="{{ route('hospital.requests') }}" class="{{ request()->routeIs('hospital.requests') || request()->routeIs('hospital.test.result*') || request()->routeIs('hospital.vaccination*') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fa-regular fa-calendar-check"></i></span>
                        Patient Requests
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('hospital.logout') }}" class="btn-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </a>
            </div>
        </aside>

        <div class="main-content">
            <header class="topbar">
                <div style="display: flex; align-items: center;">
                    <button class="mobile-toggle" id="mobileToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                </div>

                <div class="user-profile">
                    <span class="user-name">{{ $hospitalName ?? 'Hospital' }}</span>
                    <div class="user-avatar">
                        {{ substr($hospitalName ?? 'H', 0, 1) }}
                    </div>
                </div>
            </header>
            
            <main class="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.getElementById('mobileToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @stack('scripts')
</body>
</html>
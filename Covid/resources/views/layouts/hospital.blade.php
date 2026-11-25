<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Panel') - COVIDCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>

    @if(session('success'))
    <div class="toast-container"><div class="toast toast-success">{{ session('success') }}</div></div>
    @endif
    @if(session('error'))
    <div class="toast-container"><div class="toast toast-error">{{ session('error') }}</div></div>
    @endif

    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('hospital-logo-design.avif') }}" alt="COVIDCare" style="width:40px;height:40px;border-radius:8px;object-fit:contain;">
                <div class="logo-text">COVID<span>Care</span><br><small style="color:var(--text-muted);font-size:0.7rem;font-weight:500;">Hospital Panel</small></div>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main</div>
                    <a href="{{ route('hospital.dashboard') }}" class="{{ request()->routeIs('hospital.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        </span>
                        Dashboard
                    </a>
                    <a href="{{ route('hospital.requests') }}" class="{{ request()->routeIs('hospital.requests') || request()->routeIs('hospital.test.result*') || request()->routeIs('hospital.vaccination*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </span>
                        Patient Requests
                    </a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('hospital.logout') }}" class="btn btn-danger btn-sm btn-block">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </a>
            </div>
        </aside>

        <div class="main-content">
            <header class="topbar">
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-user">
                    <span class="user-name">{{ $hospitalName ?? 'Hospital' }}</span>
                    <div class="user-avatar">H</div>
                </div>
            </header>
            <main class="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
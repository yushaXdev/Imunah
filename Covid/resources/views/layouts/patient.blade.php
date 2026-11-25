<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Panel') - COVIDCare</title>
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
            <!-- UPDATED SIDEBAR LOGO SECTION -->
            <div class="sidebar-logo" style="display: flex; align-items: center; justify-content: center; gap: 12px; padding: 20px 0;">
                <img src="{{ asset('hospital-logo-design.avif') }}" alt="COVIDCare" style="width:40px;height:40px;border-radius:8px;object-fit:contain; flex-shrink: 0;">
                <div class="logo-text" style="line-height: 1.2;">
                    COVID<span>Care</span><br><small style="color:var(--text-muted);font-size:0.7rem;font-weight:500;">Patient Panel</small>
                </div>
            </div>
            <!-- END UPDATED SECTION -->

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main</div>
                    <a href="{{ route('patient.dashboard') }}" class="{{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </span>
                        Dashboard
                    </a>
                    <a href="{{ route('patient.search') }}" class="{{ request()->routeIs('patient.search') || request()->routeIs('patient.book*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        Search Hospital
                    </a>
                    <a href="{{ route('patient.appointments') }}" class="{{ request()->routeIs('patient.appointments') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        My Appointments
                    </a>
                    <a href="{{ route('patient.results') }}" class="{{ request()->routeIs('patient.results') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        My Results
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Account</div>
                    <a href="{{ route('patient.profile') }}" class="{{ request()->routeIs('patient.profile') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        Profile
                    </a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('patient.logout') }}" class="btn btn-danger btn-sm btn-block">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </a>
            </div>
        </aside>

        <div class="main-content">
            <header class="topbar">
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-user">
                    <span class="user-name">{{ $patientName ?? 'Patient' }}</span>
                    <div class="user-avatar">P</div>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - COVIDCare</title>
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
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
               <div style="display: flex; justify-content: center; align-items: center;">
              <img src="{{ asset('hospital-logo-design.avif') }}" alt="COVIDCare" style="width: 56px; height: 56px; border-radius: 50%; object-fit: contain;">
           </div>
                <div class="logo-text">COVID<span>Care</span><br><small style="color:var(--text-muted);font-size:0.7rem;font-weight:500;">Admin Panel</small></div>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main</div>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        </span>
                        Dashboard
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Management</div>
                    <a href="{{ route('admin.hospitals') }}" class="{{ request()->routeIs('admin.hospitals') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </span>
                        Hospitals
                    </a>
                    <a href="{{ route('admin.patients') }}" class="{{ request()->routeIs('admin.patients') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        Patients
                    </a>
                    <a href="{{ route('admin.vaccines') }}" class="{{ request()->routeIs('admin.vaccines*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </span>
                        Vaccines
                    </a>
                    <a href="{{ route('admin.bookings') }}" class="{{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </span>
                        Bookings
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Analytics</div>
                    <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </span>
                        Reports
                    </a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm btn-block">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </a>
            </div>
        </aside>

        <!-- Main -->
        <div class="main-content">
            <header class="topbar">
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-user">
                    <span class="user-name">{{ $adminName ?? 'Admin' }}</span>
                    <div class="user-avatar">A</div>
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
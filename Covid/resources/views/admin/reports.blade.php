@extends('layouts.admin')

@section('title', 'Reports')
@section('page-title', 'Reports & Analytics')

@section('content')
<div class="page-header">
    <h1>Reports & Analytics</h1>
    <p>Comprehensive data about tests, vaccinations, and trends.</p>
</div>

<!-- Test Reports -->
<div class="card" style="margin-bottom:24px;">
    <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
        <span>COVID Test Reports</span>
        <a href="{{ route('admin.reports.export', 'tests') }}" class="btn btn-outline btn-sm">Export CSV</a>
    </div>
    <div class="stat-grid" style="margin-bottom:0;">
        <div class="stat-card teal">
            <div class="stat-icon teal">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div class="stat-info">
                <h3>{{ $totalTests }}</h3>
                <p>Total Tests</p>
            </div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon red">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            </div>
            <div class="stat-info">
                <h3>{{ $positiveCases }}</h3>
                <p>Positive Cases</p>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon green">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-info">
                <h3>{{ $negativeCases }}</h3>
                <p>Negative Cases</p>
            </div>
        </div>
    </div>
    <div style="margin-top:20px;">
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Tests Conducted</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Today</td><td><strong>{{ $todayTests }}</strong></td></tr>
                    <tr><td>This Week</td><td><strong>{{ $weekTests }}</strong></td></tr>
                    <tr><td>This Month</td><td><strong>{{ $monthTests }}</strong></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Daily Tests Chart (CSS bar chart) -->
<div class="chart-container" style="margin-bottom:24px;">
    <h3>Daily Tests (Last 7 Days)</h3>
    <div style="display:flex;align-items:flex-end;gap:12px;height:200px;padding-top:20px;">
        @foreach($dailyTests as $day)
        <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:6px;">
            <span style="font-size:0.8rem;font-weight:700;color:var(--accent);">{{ $day['count'] }}</span>
            <div style="width:100%;background:var(--accent);border-radius:6px 6px 0 0;height:{{ max($day['count'] * 15, 4) }}px;min-height:4px;transition:height 0.5s ease;opacity:0.85;"></div>
            <span style="font-size:0.7rem;color:var(--text-muted);">{{ $day['date'] }}</span>
        </div>
        @endforeach
    </div>
</div>

<!-- Vaccination Reports -->
<div class="card" style="margin-bottom:24px;">
    <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
        <span>Vaccination Reports</span>
        <a href="{{ route('admin.reports.export', 'vaccinations') }}" class="btn btn-outline btn-sm">Export CSV</a>
    </div>
    <div class="stat-grid" style="margin-bottom:0;">
        <div class="stat-card teal">
            <div class="stat-icon teal">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            </div>
            <div class="stat-info">
                <h3>{{ $totalVaccinations }}</h3>
                <p>Total Vaccinations</p>
            </div>
        </div>
    </div>
    <div style="margin-top:20px;">
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Vaccinations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Today</td><td><strong>{{ $todayVaccinations }}</strong></td></tr>
                    <tr><td>This Week</td><td><strong>{{ $weekVaccinations }}</strong></td></tr>
                    <tr><td>This Month</td><td><strong>{{ $monthVaccinations }}</strong></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Daily Vaccinations Chart -->
<div class="chart-container" style="margin-bottom:24px;">
    <h3>Daily Vaccinations (Last 7 Days)</h3>
    <div style="display:flex;align-items:flex-end;gap:12px;height:200px;padding-top:20px;">
        @foreach($dailyVaccinations as $day)
        <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:6px;">
            <span style="font-size:0.8rem;font-weight:700;color:var(--success);">{{ $day['count'] }}</span>
            <div style="width:100%;background:var(--success);border-radius:6px 6px 0 0;height:{{ max($day['count'] * 15, 4) }}px;min-height:4px;transition:height 0.5s ease;opacity:0.85;"></div>
            <span style="font-size:0.7rem;color:var(--text-muted);">{{ $day['date'] }}</span>
        </div>
        @endforeach
    </div>
</div>

<!-- Hospital Wise -->
<div class="chart-grid">
    <div class="card">
        <div class="card-header">Hospital-wise Bookings</div>
        @if($hospitalWise->count() > 0)
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr><th>Hospital</th><th>Bookings</th></tr>
                </thead>
                <tbody>
                    @foreach($hospitalWise as $hw)
                    <tr>
                        <td>{{ $hw->name }}</td>
                        <td><strong>{{ $hw->appointments_count }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--text-muted);padding:20px;">No data available.</p>
        @endif
    </div>
    <div class="card">
        <div class="card-header">Vaccine-wise Bookings</div>
        @if($vaccineWise->count() > 0)
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr><th>Vaccine</th><th>Bookings</th></tr>
                </thead>
                <tbody>
                    @foreach($vaccineWise as $vw)
                    <tr>
                        <td>{{ $vw->vaccine_name }}</td>
                        <td><strong>{{ $vw->appointments_count }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p style="color:var(--text-muted);padding:20px;">No data available.</p>
        @endif
    </div>
</div>
@endsection
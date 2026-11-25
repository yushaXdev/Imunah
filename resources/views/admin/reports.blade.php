@extends('layouts.admin')

@section('title', 'Reports')
@section('page-title', 'Reports & Analytics')

@push('styles')
<style>
    .admin-header {
        margin-bottom: 32px;
    }
    .admin-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 8px;
    }
    .admin-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .grid-2col {
        display: grid;
        /* Yeh trick grid ko responsive aur todne se bachati hai */
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 500px), 1fr));
        gap: 24px;
        margin-bottom: 32px;
        align-items: stretch;
    }

    .section-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        min-width: 0; /* Grid overflow fix */
    }

    .section-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap; /* Agar jagah kam ho toh button neeche aa jaye */
        gap: 12px;
        background: rgba(255, 255, 255, 0.02);
    }

    .section-header h2 {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .section-header h2 i {
        color: var(--accent);
    }

    .btn-export {
        background: rgba(13, 148, 136, 0.1);
        color: var(--accent);
        border: 1px solid rgba(13, 148, 136, 0.2);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        flex-shrink: 0; /* Button squeeze hone se bachega */
        white-space: nowrap;
    }

    .btn-export:hover {
        background: var(--accent);
        color: #fff;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        padding: 24px;
        border-bottom: 1px solid var(--border);
    }

    .stat-card {
        background: var(--bg-body);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .icon-teal { background: rgba(13, 148, 136, 0.1); color: #0D9488; }
    .icon-red { background: rgba(239, 68, 68, 0.1); color: #EF4444; }
    .icon-green { background: rgba(16, 185, 129, 0.1); color: #10B981; }
    .icon-purple { background: rgba(139, 92, 246, 0.1); color: #8B5CF6; }

    .stat-info h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-info p {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
        flex: 1;
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    .modern-table th {
        text-align: left;
        padding: 16px 24px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        font-weight: 700;
        border-bottom: 1px solid var(--border);
    }

    .modern-table td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .modern-table tr:last-child td {
        border-bottom: none;
    }

    .modern-table tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    .modern-table td strong {
        color: var(--text-main);
        font-weight: 600;
    }

    .chart-area {
        padding: 24px;
        flex: 1;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 12px;
        min-height: 250px;
    }

    .bar-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
        gap: 8px;
        min-width: 0;
    }

    .bar-value {
        font-size: 0.85rem;
        font-weight: 700;
    }

    .bar-fill {
        width: 100%;
        max-width: 45px;
        border-radius: 6px 6px 0 0;
        transition: all 0.3s ease;
        min-height: 4px;
    }

    .fill-teal { background: linear-gradient(to top, rgba(13, 148, 136, 0.2), #0D9488); }
    .fill-green { background: linear-gradient(to top, rgba(16, 185, 129, 0.2), #10B981); }

    .bar-wrapper:hover .bar-fill {
        filter: brightness(1.2);
    }

    .bar-date {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .no-data-msg {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        min-height: 200px;
    }

    .no-data-msg i {
        font-size: 2.5rem;
        opacity: 0.2;
        margin-bottom: 12px;
    }

    @media (max-width: 768px) {
        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <h1>Reports & Analytics</h1>
    <p>Comprehensive data about tests, vaccinations, and system trends.</p>
</div>

<div class="grid-2col">
    <div class="section-card">
        <div class="section-header">
            <h2><i class="fa-solid fa-vial-virus"></i> COVID Test Reports</h2>
            <a href="{{ route('admin.reports.export', 'tests') }}" class="btn-export">
                <i class="fa-solid fa-download"></i> Export CSV
            </a>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-teal"><i class="fa-solid fa-notes-medical"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalTests }}</h3>
                    <p>Total Tests</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-red"><i class="fa-solid fa-virus"></i></div>
                <div class="stat-info">
                    <h3>{{ $positiveCases }}</h3>
                    <p>Positive</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green"><i class="fa-solid fa-shield-virus"></i></div>
                <div class="stat-info">
                    <h3>{{ $negativeCases }}</h3>
                    <p>Negative</p>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="modern-table">
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

    <div class="section-card">
        <div class="section-header">
            <h2><i class="fa-solid fa-chart-column"></i> Daily Tests (Last 7 Days)</h2>
        </div>
        <div class="chart-area">
            @if(!empty($dailyTests) && count($dailyTests) > 0)
                @foreach($dailyTests as $day)
                <div class="bar-wrapper">
                    <span class="bar-value" style="color: var(--accent);">{{ $day['count'] }}</span>
                    <div class="bar-fill fill-teal" style="height: {{ max($day['count'] * 15, 4) }}px;"></div>
                    <span class="bar-date">{{ $day['date'] }}</span>
                </div>
                @endforeach
            @else
                <div class="no-data-msg">
                    <i class="fa-solid fa-chart-bar"></i>
                    <p>No test data available for the last 7 days.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="grid-2col">
    <div class="section-card">
        <div class="section-header">
            <h2><i class="fa-solid fa-syringe"></i> Vaccination Reports</h2>
            <a href="{{ route('admin.reports.export', 'vaccinations') }}" class="btn-export">
                <i class="fa-solid fa-download"></i> Export CSV
            </a>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-purple"><i class="fa-solid fa-syringe"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalVaccinations }}</h3>
                    <p>Total Vaccinations</p>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="modern-table">
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

    <div class="section-card">
        <div class="section-header">
            <h2><i class="fa-solid fa-chart-simple"></i> Daily Vaccinations (Last 7 Days)</h2>
        </div>
        <div class="chart-area">
            @if(!empty($dailyVaccinations) && count($dailyVaccinations) > 0)
                @foreach($dailyVaccinations as $day)
                <div class="bar-wrapper">
                    <span class="bar-value" style="color: #10B981;">{{ $day['count'] }}</span>
                    <div class="bar-fill fill-green" style="height: {{ max($day['count'] * 15, 4) }}px;"></div>
                    <span class="bar-date">{{ $day['date'] }}</span>
                </div>
                @endforeach
            @else
                <div class="no-data-msg">
                    <i class="fa-solid fa-chart-bar"></i>
                    <p>No vaccination data available for the last 7 days.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="grid-2col">
    <div class="section-card">
        <div class="section-header">
            <h2><i class="fa-solid fa-hospital"></i> Hospital-wise Bookings</h2>
        </div>
        @if($hospitalWise->count() > 0)
        <div class="table-responsive">
            <table class="modern-table">
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
        <div class="no-data-msg">
            <i class="fa-solid fa-hospital-user"></i>
            <p>No hospital data available.</p>
        </div>
        @endif
    </div>

    <div class="section-card">
        <div class="section-header">
            <h2><i class="fa-solid fa-syringe"></i> Vaccine-wise Bookings</h2>
        </div>
        @if($vaccineWise->count() > 0)
        <div class="table-responsive">
            <table class="modern-table">
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
        <div class="no-data-msg">
            <i class="fa-solid fa-syringe"></i>
            <p>No vaccine data available.</p>
        </div>
        @endif
    </div>
</div>
@endsection
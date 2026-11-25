@extends('layouts.patient')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .dashboard-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 6px;
        letter-spacing: -0.5px;
    }

    .dashboard-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .btn-new-booking {
        background: var(--accent);
        color: #fff;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(13, 148, 136, 0.2);
    }

    .btn-new-booking:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.3);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-icon.teal {
        background: rgba(13, 148, 136, 0.1);
        color: var(--accent);
    }

    .stat-icon.blue {
        background: rgba(59, 130, 246, 0.1);
        color: #3B82F6;
    }

    .stat-icon.green {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
    }

    .stat-info h3 {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1.2;
    }

    .stat-info p {
        font-size: 0.9rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .section-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 32px;
    }

    .section-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255, 255, 255, 0.02);
    }

    .section-header h2 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .section-header a {
        font-size: 0.9rem;
        color: var(--accent);
        font-weight: 500;
    }

    .section-header a:hover {
        text-decoration: underline;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
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
        background: rgba(0, 0, 0, 0.1);
    }

    .modern-table td {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .modern-table tr:last-child td {
        border-bottom: none;
    }

    .modern-table tr {
        transition: background 0.2s ease;
    }

    .modern-table tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    .modern-table td strong {
        color: var(--text-main);
        font-weight: 600;
    }

    .hospital-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hospital-avatar {
        width: 36px;
        height: 36px;
        background: var(--bg-body);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        border: 1px solid var(--border);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #F59E0B;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-approved {
        background: rgba(59, 130, 246, 0.1);
        color: #3B82F6;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .status-completed {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .empty-box {
        padding: 48px 24px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .empty-box-icon {
        font-size: 2.5rem;
        color: var(--text-muted);
        opacity: 0.4;
        margin-bottom: 16px;
    }

    .empty-box h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .empty-box p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 20px;
    }

    .btn-outline-small {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border: 1px solid var(--border);
        color: var(--text-main);
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .btn-outline-small:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .modern-table th {
            padding: 12px 16px;
        }
        .modern-table td {
            padding: 16px;
        }
    }
</style>
@endpush

@section('content')

<div class="dashboard-header">
    <div>
        <h1>Welcome back, {{ $patientName }}</h1>
        <p>Here is a quick overview of your health and appointments.</p>
    </div>
    <a href="{{ route('patient.search') }}" class="btn-new-booking">
        <i class="fa-solid fa-plus"></i> New Booking
    </a>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon teal">
            <i class="fa-regular fa-calendar-check"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $upcoming->count() }}</h3>
            <p>Upcoming Appointments</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-check-double"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $completed->count() }}</h3>
            <p>Completed Services</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-user-shield"></i>
        </div>
        <div class="stat-info">
            <h3>Active</h3>
            <p>Profile Status</p>
        </div>
    </div>
</div>

<div class="section-card">
    <div class="section-header">
        <h2>Upcoming Appointments</h2>
        <a href="{{ route('patient.appointments') }}">View All</a>
    </div>
    
    @if($upcoming->count() > 0)
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Hospital</th>
                    <th>Service</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcoming as $appt)
                <tr>
                    <td>
                        <div class="hospital-cell">
                            <div class="hospital-avatar"><i class="fa-solid fa-hospital"></i></div>
                            <strong>{{ $appt->hospital->name ?? 'N/A' }}</strong>
                        </div>
                    </td>
                    <td>{{ $appt->service_type }}</td>
                    <td>
                        <div style="color: var(--text-main); font-weight: 500;">{{ $appt->appointment_date }}</div>
                        <div style="font-size: 0.8rem; margin-top: 4px;">{{ $appt->appointment_time ?? 'TBA' }}</div>
                    </td>
                    <td>
                        <span class="status-badge status-{{ strtolower($appt->status) }}">
                            {{ $appt->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-box">
        <i class="fa-regular fa-calendar-xmark empty-box-icon"></i>
        <h3>No upcoming appointments</h3>
        <p>You don't have any appointments scheduled at the moment.</p>
        <a href="{{ route('patient.search') }}" class="btn-outline-small">
            <i class="fa-solid fa-magnifying-glass"></i> Book a Hospital
        </a>
    </div>
    @endif
</div>

@if($completed->count() > 0)
<div class="section-card">
    <div class="section-header">
        <h2>Recently Completed</h2>
        <a href="{{ route('patient.results') }}">View Results</a>
    </div>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Hospital</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completed as $appt)
                <tr>
                    <td>
                        <div class="hospital-cell">
                            <div class="hospital-avatar"><i class="fa-solid fa-hospital"></i></div>
                            <strong>{{ $appt->hospital->name ?? 'N/A' }}</strong>
                        </div>
                    </td>
                    <td>{{ $appt->service_type }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td>
                        <span class="status-badge status-completed">Completed</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
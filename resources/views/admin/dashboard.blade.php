@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

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
        letter-spacing: -0.5px;
    }
    .admin-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
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
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        border-color: var(--accent);
    }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .icon-teal { background: rgba(13, 148, 136, 0.1); color: #0D9488; }
    .icon-blue { background: rgba(59, 130, 246, 0.1); color: #3B82F6; }
    .icon-amber { background: rgba(245, 158, 11, 0.1); color: #F59E0B; }
    .icon-red { background: rgba(239, 68, 68, 0.1); color: #EF4444; }
    .icon-green { background: rgba(16, 185, 129, 0.1); color: #10B981; }
    .icon-purple { background: rgba(139, 92, 246, 0.1); color: #8B5CF6; }

    .stat-info h3 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1.1;
        margin-bottom: 4px;
    }

    .stat-info p {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .section-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .section-header {
        padding: 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255, 255, 255, 0.02);
    }

    .section-header h2 {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header h2 i {
        color: var(--accent);
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
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
        background: rgba(0, 0, 0, 0.1);
    }

    .modern-table td {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        color: var(--text-muted);
        font-size: 0.95rem;
        vertical-align: middle;
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

    .patient-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .patient-avatar {
        width: 36px;
        height: 36px;
        background: var(--bg-body);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        border: 1px solid var(--border);
        font-size: 0.9rem;
        font-weight: 600;
    }

    .modern-table td strong {
        color: var(--text-main);
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #F59E0B;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-approved, .status-confirmed {
        background: rgba(59, 130, 246, 0.1);
        color: #3B82F6;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .status-completed {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-rejected, .status-cancelled {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .empty-box {
        padding: 60px 24px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .empty-box-icon {
        font-size: 3rem;
        color: var(--text-muted);
        opacity: 0.3;
        margin-bottom: 16px;
    }

    .empty-box h3 {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .empty-box p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .section-header {
            padding: 20px;
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
<div class="admin-header">
    <h1>Dashboard Overview</h1>
    <p>Welcome back, <strong>{{ $adminName }}</strong>. Here is what's happening in your system today.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-teal">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $totalPatients }}</h3>
            <p>Total Patients</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-blue">
            <i class="fa-solid fa-hospital"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $totalHospitals }}</h3>
            <p>Approved Hospitals</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-amber">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $pendingHospitals }}</h3>
            <p>Pending Approvals</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-purple">
            <i class="fa-solid fa-vial-virus"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $totalTests }}</h3>
            <p>Total Test Bookings</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-teal">
            <i class="fa-solid fa-syringe"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $totalVaccinations }}</h3>
            <p>Total Vaccinations</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-green">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $todayTests }}</h3>
            <p>Tests Today</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-teal">
            <i class="fa-solid fa-calendar-plus"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $todayVaccinations }}</h3>
            <p>Vaccinations Today</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-red">
            <i class="fa-solid fa-arrow-trend-up"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $recentBookings->count() }}</h3>
            <p>Recent Bookings</p>
        </div>
    </div>
</div>

<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-solid fa-list-check"></i> Recent Bookings Activity</h2>
    </div>
    
    @if($recentBookings->count() > 0)
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Hospital</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentBookings as $booking)
                <tr>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                {{ substr($booking->patient->name ?? 'P', 0, 1) }}
                            </div>
                            <strong>{{ $booking->patient->name ?? 'N/A' }}</strong>
                        </div>
                    </td>
                    <td>
                        <i class="fa-solid fa-hospital" style="color: var(--accent); margin-right: 6px; font-size: 0.85rem;"></i>
                        {{ $booking->hospital->name ?? 'N/A' }}
                    </td>
                    <td>
                        <span style="background: var(--bg-body); border: 1px solid var(--border); padding: 4px 10px; border-radius: 6px; font-size: 0.85rem;">
                            {{ $booking->service_type }}
                        </span>
                    </td>
                    <td>
                        <div style="color: var(--text-main); font-weight: 500;">{{ $booking->appointment_date }}</div>
                    </td>
                    <td>
                        <span class="status-badge status-{{ strtolower($booking->status) }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-box">
        <i class="fa-solid fa-inbox empty-box-icon"></i>
        <h3>No bookings yet</h3>
        <p>When patients book appointments, they will appear right here.</p>
    </div>
    @endif
</div>
@endsection
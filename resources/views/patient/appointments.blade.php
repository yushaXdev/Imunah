@extends('layouts.patient')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')

@push('styles')
<style>
    .page-header {
        margin-bottom: 32px;
    }
    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }
    .page-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
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
    }

    .section-header h2 {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header .badge-count {
        background: var(--accent-light);
        color: var(--accent);
        font-size: 0.85rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
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

    .modern-table td strong {
        color: var(--text-main);
        font-weight: 600;
        font-size: 1rem;
    }

    .hospital-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hospital-avatar {
        width: 40px;
        height: 40px;
        background: var(--bg-body);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        border: 1px solid var(--border);
        font-size: 1.1rem;
    }

    .date-cell div:first-child {
        color: var(--text-main);
        font-weight: 500;
    }

    .date-cell div:last-child {
        font-size: 0.8rem;
        margin-top: 4px;
        color: var(--text-muted);
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
        opacity: 0.4;
        margin-bottom: 20px;
    }

    .empty-box h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .empty-box p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 24px;
        max-width: 400px;
    }

    .btn-primary-small {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--accent);
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .btn-primary-small:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
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
<div class="page-header">
    <h1>My Appointments</h1>
    <p>View all your booked appointments, testing, and vaccination history.</p>
</div>

@if($appointments->count() > 0)
<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-regular fa-calendar-days" style="color: var(--accent);"></i> All Bookings</h2>
        <span class="badge-count">{{ $appointments->count() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hospital</th>
                    <th>Service Details</th>
                    <th>Schedule</th>
                    <th>Booked On</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $index => $appt)
                <tr>
                    <td style="color: var(--text-muted); font-weight: 600;">{{ $index + 1 }}</td>
                    <td>
                        <div class="hospital-cell">
                            <div class="hospital-avatar"><i class="fa-solid fa-hospital"></i></div>
                            <strong>{{ $appt->hospital->name ?? 'N/A' }}</strong>
                        </div>
                    </td>
                    <td>
                        <div style="color: var(--text-main); font-weight: 500;">{{ $appt->service_type }}</div>
                        <div style="font-size: 0.8rem; margin-top: 4px; color: var(--accent);">
                            {{ $appt->vaccine->vaccine_name ?? '-' }}
                        </div>
                    </td>
                    <td class="date-cell">
                        <div>{{ $appt->appointment_date }}</div>
                        <div><i class="fa-regular fa-clock"></i> {{ $appt->appointment_time ?? 'TBA' }}</div>
                    </td>
                    <td>
                        {{ $appt->created_at->format('M d, Y') }}
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
</div>
@else
<div class="section-card">
    <div class="empty-box">
        <i class="fa-regular fa-folder-open empty-box-icon"></i>
        <h3>No appointments found</h3>
        <p>You haven't booked any tests or vaccinations yet. Search for a nearby hospital to get started.</p>
        <a href="{{ route('patient.search') }}" class="btn-primary-small">
            <i class="fa-solid fa-magnifying-glass"></i> Search Hospital & Book
        </a>
    </div>
</div>
@endif
@endsection
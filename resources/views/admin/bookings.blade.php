@extends('layouts.admin')

@section('title', 'Bookings')
@section('page-title', 'All Bookings')

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

    .badge-count {
        background: var(--accent-light);
        color: var(--accent);
        font-size: 0.85rem;
        padding: 6px 14px;
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
        font-size: 0.95rem;
    }

    .service-info div:first-child {
        color: var(--text-main);
        font-weight: 500;
    }

    .service-info div:last-child {
        font-size: 0.8rem;
        margin-top: 4px;
        color: var(--accent);
    }

    .schedule-info div:first-child {
        color: var(--text-main);
        font-weight: 500;
    }

    .schedule-info div:last-child {
        font-size: 0.8rem;
        margin-top: 4px;
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

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }

    .btn-approve {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
        border-color: rgba(16, 185, 129, 0.2);
    }

    .btn-approve:hover {
        background: #10B981;
        color: #fff;
    }

    .btn-reject {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border-color: rgba(239, 68, 68, 0.2);
    }

    .btn-reject:hover {
        background: #EF4444;
        color: #fff;
    }

    .no-action-text {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-style: italic;
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
</style>
@endpush

@section('content')
<div class="admin-header">
    <h1>All Bookings</h1>
    <p>Manage and track every appointment booked on the platform.</p>
</div>

<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-solid fa-calendar-check"></i> Appointment List</h2>
        <span class="badge-count">{{ $bookings->count() }} Total</span>
    </div>
    
    @if($bookings->count() > 0)
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Hospital</th>
                    <th>Service & Vaccine</th>
                    <th>Schedule</th>
                    <th>Booked On</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $index => $booking)
                <tr>
                    <td style="color: var(--text-muted); font-weight: 600;">{{ $index + 1 }}</td>
                    
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                {{ substr($booking->patient->name ?? 'P', 0, 1) }}
                            </div>
                            <strong>{{ $booking->patient->name ?? 'N/A' }}</strong>
                        </div>
                    </td>
                    
                    <td>
                        <i class="fa-solid fa-hospital" style="color: var(--accent); font-size: 0.85rem; margin-right: 6px;"></i>
                        {{ $booking->hospital->name ?? 'N/A' }}
                    </td>
                    
                    <td class="service-info">
                        <div>{{ $booking->service_type }}</div>
                        <div>
                            <i class="fa-solid fa-syringe" style="font-size: 0.75rem;"></i> 
                            {{ $booking->vaccine->vaccine_name ?? 'No Vaccine' }}
                        </div>
                    </td>
                    
                    <td class="schedule-info">
                        <div>{{ $booking->appointment_date }}</div>
                        <div><i class="fa-regular fa-clock"></i> {{ $booking->appointment_time ?? 'TBA' }}</div>
                    </td>
                    
                    <td>{{ $booking->created_at->format('M d, Y') }}</td>
                    
                    <td>
                        <span class="status-badge status-{{ strtolower($booking->status) }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                    
                    <td>
                        @if($booking->status === 'Pending')
                        <div class="action-buttons">
                            <form method="POST" action="{{ route('admin.approve.booking', $booking->appointment_id) }}">
                                @csrf
                                <button type="submit" class="btn-action btn-approve" onclick="return confirm('Approve this booking?')">
                                    <i class="fa-solid fa-check"></i> Accept
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.reject.booking', $booking->appointment_id) }}">
                                @csrf
                                <button type="submit" class="btn-action btn-reject" onclick="return confirm('Reject this booking?')">
                                    <i class="fa-solid fa-xmark"></i> Decline
                                </button>
                            </form>
                        </div>
                        @else
                        <span class="no-action-text"><i class="fa-solid fa-lock"></i> Locked</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-box">
        <i class="fa-regular fa-calendar-times empty-box-icon"></i>
        <h3>No bookings yet</h3>
        <p>Appointments will appear here as soon as patients book them.</p>
    </div>
    @endif
</div>
@endsection
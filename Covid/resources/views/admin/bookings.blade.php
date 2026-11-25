@extends('layouts.admin')

@section('title', 'Bookings')
@section('page-title', 'All Bookings')

@section('content')
<div class="page-header">
    <h1>All Bookings</h1>
    <p>View and manage every appointment booked on the platform.</p>
</div>

<div class="card">
    <div class="card-header">Total Bookings ({{ $bookings->count() }})</div>
    @if($bookings->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Hospital</th>
                    <th>Service</th>
                    <th>Vaccine</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Booked On</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->patient->name ?? 'N/A' }}</td>
                    <td>{{ $booking->hospital->name ?? 'N/A' }}</td>
                    <td>{{ $booking->service_type }}</td>
                    <td>{{ $booking->vaccine->vaccine_name ?? '-' }}</td>
                    <td>{{ $booking->appointment_date }}</td>
                    <td>{{ $booking->appointment_time ?? '-' }}</td>
                    <td>{{ $booking->created_at->format('M d, Y') }}</td>
                    <td><span class="badge badge-{{ strtolower($booking->status) }}">{{ $booking->status }}</span></td>
                    <td>
                        @if($booking->status === 'Pending')
                        <form method="POST" action="{{ route('admin.approve.booking', $booking->appointment_id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve this booking?')">Accept</button>
                        </form>
                        <form method="POST" action="{{ route('admin.reject.booking', $booking->appointment_id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject this booking?')">Decline</button>
                        </form>
                        @else
                        <span style="color:var(--text-muted);font-size:0.85rem;">--</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3>No bookings yet</h3>
        <p>Appointments will appear here when patients book them.</p>
    </div>
    @endif
</div>
@endsection
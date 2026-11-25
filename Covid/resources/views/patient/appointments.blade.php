@extends('layouts.patient')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')

@section('content')
<div class="page-header">
    <h1>My Appointments</h1>
    <p>View all your booked appointments and their status.</p>
</div>

@if($appointments->count() > 0)
<div class="card">
    <div class="card-header">All Appointments ({{ $appointments->count() }})</div>
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hospital</th>
                    <th>Service</th>
                    <th>Vaccine</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Booked On</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $index => $appt)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $appt->hospital->name ?? 'N/A' }}</strong></td>
                    <td>{{ $appt->service_type }}</td>
                    <td>{{ $appt->vaccine->vaccine_name ?? '-' }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td>{{ $appt->appointment_time ?? 'To be assigned' }}</td>
                    <td>{{ $appt->created_at->format('M d, Y') }}</td>
                    <td><span class="badge badge-{{ strtolower($appt->status) }}">{{ $appt->status }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card">
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3>No appointments yet</h3>
        <p><a href="{{ route('patient.search') }}" class="btn btn-primary btn-sm mt-3">Search Hospital & Book</a></p>
    </div>
</div>
@endif
@endsection
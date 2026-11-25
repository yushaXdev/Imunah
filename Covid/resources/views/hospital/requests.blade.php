@extends('layouts.hospital')

@section('title', 'Patient Requests')
@section('page-title', 'Patient Requests')

@section('content')
<div class="page-header">
    <h1>Patient Requests</h1>
    <p>Manage incoming appointment requests from patients.</p>
</div>

@if($appointments->count() > 0)
<div class="card">
    <div class="card-header">All Requests ({{ $appointments->count() }})</div>
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Service</th>
                    <th>Vaccine</th>
                    <th>Requested Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $index => $appt)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $appt->patient->name ?? 'N/A' }}</strong><br>
                        <small style="color:var(--text-muted);">{{ $appt->patient->phone ?? '' }}</small>
                    </td>
                    <td>{{ $appt->service_type }}</td>
                    <td>{{ $appt->vaccine->vaccine_name ?? '-' }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td><span class="badge badge-{{ strtolower($appt->status) }}">{{ $appt->status }}</span></td>
                    <td>
                        @if($appt->status === 'Pending')
                        <div class="inline-form">
                            <input type="time" id="time_{{ $appt->appointment_id }}" value="10:00">
                            <form method="POST" action="{{ route('hospital.approve.request', $appt->appointment_id) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="appointment_time" value="" id="hidden_time_{{ $appt->appointment_id }}">
                                <button type="submit" class="btn btn-success btn-sm" onclick="document.getElementById('hidden_time_{{ $appt->appointment_id }}').value = document.getElementById('time_{{ $appt->appointment_id }}').value;">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('hospital.reject.request', $appt->appointment_id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </div>
                        @elseif($appt->status === 'Approved')
                        @if($appt->service_type === 'Covid Test')
                        <a href="{{ route('hospital.test.result', $appt->appointment_id) }}" class="btn btn-primary btn-sm">Update Result</a>
                        @else
                        <a href="{{ route('hospital.vaccination', $appt->appointment_id) }}" class="btn btn-primary btn-sm">Update Vaccination</a>
                        @endif
                        @else
                        <span style="color:var(--text-muted);font-size:0.85rem;">Done</span>
                        @endif
                    </td>
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
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3>No patient requests</h3>
        <p>When patients book appointments with your hospital, they will appear here.</p>
    </div>
</div>
@endif
@endsection
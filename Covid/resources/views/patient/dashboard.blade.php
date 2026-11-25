@extends('layouts.patient')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Welcome, {{ $patientName }}</h1>
    <p>Manage your COVID tests and vaccinations from here.</p>
</div>

<div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:28px;">
    <a href="{{ route('patient.search') }}" class="btn btn-primary btn-lg">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        Search Hospital
    </a>
    <a href="{{ route('patient.appointments') }}" class="btn btn-outline btn-lg">My Appointments</a>
    <a href="{{ route('patient.results') }}" class="btn btn-outline btn-lg">My Results</a>
</div>

<!-- Upcoming Appointments -->
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">Upcoming Appointments</div>
    @if($upcoming->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Hospital</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcoming as $appt)
                <tr>
                    <td><strong>{{ $appt->hospital->name ?? 'N/A' }}</strong></td>
                    <td>{{ $appt->service_type }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td>{{ $appt->appointment_time ?? 'To be assigned' }}</td>
                    <td><span class="badge badge-{{ strtolower($appt->status) }}">{{ $appt->status }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state" style="padding:30px;">
        <h3>No upcoming appointments</h3>
        <p><a href="{{ route('patient.search') }}">Search a hospital</a> and book your first appointment.</p>
    </div>
    @endif
</div>

<!-- Recent Completed -->
@if($completed->count() > 0)
<div class="card">
    <div class="card-header">Recently Completed</div>
    <div class="table-wrapper">
        <table class="data-table">
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
                    <td><strong>{{ $appt->hospital->name ?? 'N/A' }}</strong></td>
                    <td>{{ $appt->service_type }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td><span class="badge badge-completed">Completed</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
@extends('layouts.hospital')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Hospital Dashboard</h1>
    <p>Welcome, {{ $hospitalName }}. Here's your appointment overview.</p>
</div>

<div class="stat-grid">
    <div class="stat-card amber">
        <div class="stat-icon amber">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $pending }}</h3>
            <p>Pending Requests</p>
        </div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $approved }}</h3>
            <p>Approved</p>
        </div>
    </div>
    <div class="stat-card teal">
        <div class="stat-icon teal">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $completed }}</h3>
            <p>Completed</p>
        </div>
    </div>
    <div class="stat-card teal">
        <div class="stat-icon teal">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $todayAppointments }}</h3>
            <p>Today's Appointments</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Quick Actions</div>
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="{{ route('hospital.requests') }}" class="btn btn-primary">View Patient Requests</a>
    </div>
</div>
@endsection
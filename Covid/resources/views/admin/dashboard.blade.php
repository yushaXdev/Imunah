@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard Overview</h1>
    <p>Welcome back, {{ $adminName }}. Here's what's happening today.</p>
</div>

<div class="stat-grid">
    <div class="stat-card teal">
        <div class="stat-icon teal">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $totalPatients }}</h3>
            <p>Total Patients</p>
        </div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $totalHospitals }}</h3>
            <p>Approved Hospitals</p>
        </div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon amber">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $pendingHospitals }}</h3>
            <p>Pending Approvals</p>
        </div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon red">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $totalTests }}</h3>
            <p>Total Test Bookings</p>
        </div>
    </div>
</div>

<div class="stat-grid" style="margin-top:0;">
    <div class="stat-card teal">
        <div class="stat-icon teal">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $totalVaccinations }}</h3>
            <p>Total Vaccinations</p>
        </div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $todayTests }}</h3>
            <p>Tests Today</p>
        </div>
    </div>
    <div class="stat-card teal">
        <div class="stat-icon teal">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $todayVaccinations }}</h3>
            <p>Vaccinations Today</p>
        </div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon amber">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
        </div>
        <div class="stat-info">
            <h3>{{ $recentBookings->count() }}</h3>
            <p>Recent Bookings</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Recent Bookings</div>
    @if($recentBookings->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
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
                    <td>{{ $booking->patient->name ?? 'N/A' }}</td>
                    <td>{{ $booking->hospital->name ?? 'N/A' }}</td>
                    <td>{{ $booking->service_type }}</td>
                    <td>{{ $booking->appointment_date }}</td>
                    <td><span class="badge badge-{{ strtolower($booking->status) }}">{{ $booking->status }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <h3>No bookings yet</h3>
        <p>When patients book appointments, they will appear here.</p>
    </div>
    @endif
</div>
@endsection
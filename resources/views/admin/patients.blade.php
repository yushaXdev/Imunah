@extends('layouts.admin')

@section('title', 'Patients')
@section('page-title', 'Patient Management')

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
        width: 40px;
        height: 40px;
        background: var(--bg-body);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        border: 1px solid var(--border);
        font-size: 1rem;
        font-weight: 600;
    }

    .modern-table td strong {
        color: var(--text-main);
        font-weight: 600;
        font-size: 1rem;
    }

    .contact-info div {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 4px;
    }
    
    .contact-info div:last-child {
        margin-bottom: 0;
    }

    .contact-info i {
        color: var(--accent);
        font-size: 0.85rem;
        width: 14px;
        text-align: center;
    }

    .address-text {
        max-width: 200px;
        white-space: normal;
        line-height: 1.4;
        font-size: 0.9rem;
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
    <h1>Patient Management</h1>
    <p>View and manage all registered patients on the platform.</p>
</div>

<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-solid fa-users"></i> Registered Patients</h2>
        <span class="badge-count">{{ $patients->count() }} Total</span>
    </div>
    
    @if($patients->count() > 0)
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient Name</th>
                    <th>Contact Info</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $index => $patient)
                <tr>
                    <td style="color: var(--text-muted); font-weight: 600;">{{ $index + 1 }}</td>
                    <td>
                        <div class="patient-cell">
                            <div class="patient-avatar">
                                {{ substr($patient->name, 0, 1) }}
                            </div>
                            <strong>{{ $patient->name }}</strong>
                        </div>
                    </td>
                    <td>
                        <div class="contact-info">
                            <div><i class="fa-regular fa-envelope"></i> {{ $patient->email }}</div>
                            <div><i class="fa-solid fa-phone"></i> {{ $patient->phone }}</div>
                        </div>
                    </td>
                    <td>
                        <i class="fa-solid fa-location-dot" style="color: var(--accent); font-size: 0.85rem; margin-right: 4px;"></i>
                        {{ $patient->city }}
                    </td>
                    <td>
                        <div class="address-text">
                            {{ Str::limit($patient->address, 40) }}
                        </div>
                    </td>
                    <td>{{ $patient->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-box">
        <i class="fa-solid fa-users-slash empty-box-icon"></i>
        <h3>No patients registered</h3>
        <p>Patients will appear here once they create accounts on the portal.</p>
    </div>
    @endif
</div>
@endsection
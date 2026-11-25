@extends('layouts.patient')

@section('title', 'My Results')
@section('page-title', 'My Results')

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
        margin-bottom: 32px;
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
        gap: 12px;
    }

    .section-header h2 i {
        color: var(--accent);
        font-size: 1.3rem;
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
        font-size: 0.95rem;
    }

    .hospital-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hospital-avatar {
        width: 38px;
        height: 38px;
        background: var(--bg-body);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        border: 1px solid var(--border);
        font-size: 1rem;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .badge-positive {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .badge-negative {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #F59E0B;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .badge-completed, .badge-vaccinated {
        background: rgba(13, 148, 136, 0.1);
        color: var(--accent);
        border: 1px solid rgba(13, 148, 136, 0.2);
    }

    .badge-not-vaccinated {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .remarks-text {
        max-width: 250px;
        white-space: normal;
        line-height: 1.5;
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
        font-size: 2.5rem;
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
        max-width: 400px;
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
    <h1>My Health Records</h1>
    <p>View your verified COVID test results and vaccination history.</p>
</div>

<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-solid fa-vial-virus"></i> COVID Test Results</h2>
    </div>
    
    @if($testResults->count() > 0)
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hospital</th>
                    <th>Result</th>
                    <th>Test Date</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testResults as $index => $tr)
                <tr>
                    <td style="color: var(--text-muted); font-weight: 600;">{{ $index + 1 }}</td>
                    <td>
                        <div class="hospital-cell">
                            <div class="hospital-avatar"><i class="fa-solid fa-hospital"></i></div>
                            <strong>{{ $tr->hospital->name ?? 'N/A' }}</strong>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-{{ strtolower($tr->result) }}">
                            {{ $tr->result }}
                        </span>
                    </td>
                    <td>{{ $tr->date }}</td>
                    <td>
                        <div class="remarks-text">
                            {{ $tr->remarks ?? 'No remarks provided' }}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-box">
        <i class="fa-regular fa-file-excel empty-box-icon"></i>
        <h3>No test results available</h3>
        <p>Your COVID test results will appear here as soon as the hospital updates them in the system.</p>
    </div>
    @endif
</div>

<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-solid fa-syringe"></i> Vaccination Certificates</h2>
    </div>
    
    @if($vaccinations->count() > 0)
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hospital</th>
                    <th>Vaccine</th>
                    <th>Dose</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vaccinations as $index => $vs)
                <tr>
                    <td style="color: var(--text-muted); font-weight: 600;">{{ $index + 1 }}</td>
                    <td>
                        <div class="hospital-cell">
                            <div class="hospital-avatar"><i class="fa-solid fa-hospital"></i></div>
                            <strong>{{ $vs->hospital->name ?? 'N/A' }}</strong>
                        </div>
                    </td>
                    <td style="color: var(--text-main); font-weight: 600;">{{ $vs->vaccine->vaccine_name ?? 'N/A' }}</td>
                    <td>
                        <span style="background: var(--bg-body); border: 1px solid var(--border); padding: 4px 10px; border-radius: 6px; font-size: 0.85rem;">
                            {{ $vs->dose }}
                        </span>
                    </td>
                    <td>{{ $vs->date }}</td>
                    <td>
                        <span class="badge badge-{{ strtolower(str_replace(' ', '-', $vs->status)) }}">
                            {{ $vs->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-box">
        <i class="fa-solid fa-shield-virus empty-box-icon"></i>
        <h3>No vaccination records found</h3>
        <p>Your vaccination details will appear here after the hospital updates them.</p>
    </div>
    @endif
</div>
@endsection
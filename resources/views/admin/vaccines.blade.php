@extends('layouts.admin')

@section('title', 'Vaccines')
@section('page-title', 'Vaccine Management')

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

    .form-body {
        padding: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper i {
        position: absolute;
        left: 16px;
        color: var(--text-muted);
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px 14px 46px;
        background: var(--bg-body);
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text-main);
        font-size: 0.95rem;
        outline: none;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.15);
    }

    .input-wrapper:focus-within i {
        color: var(--accent);
    }

    .form-error {
        color: #EF4444;
        font-size: 0.85rem;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .add-form-row {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }

    .add-form-row .form-group {
        flex: 1;
    }

    .btn-primary {
        background: var(--accent);
        color: #fff;
        border: none;
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(13, 148, 136, 0.2);
        height: 48px;
    }

    .btn-primary:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4);
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

    .vaccine-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .vaccine-avatar {
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

    .modern-table td strong {
        color: var(--text-main);
        font-weight: 600;
        font-size: 1rem;
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

    .status-available {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-unavailable, .status-disabled {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }

    .btn-enable {
        background: rgba(16, 185, 129, 0.1);
        color: #10B981;
        border-color: rgba(16, 185, 129, 0.2);
    }

    .btn-enable:hover {
        background: #10B981;
        color: #fff;
    }

    .btn-disable {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border-color: rgba(239, 68, 68, 0.2);
    }

    .btn-disable:hover {
        background: #EF4444;
        color: #fff;
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

    @media (max-width: 768px) {
        .add-form-row {
            flex-direction: column;
        }
        .btn-primary {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <h1>Vaccine Management</h1>
    <p>Add new vaccines to the system and manage their availability status.</p>
</div>

<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-solid fa-plus-circle"></i> Add New Vaccine</h2>
    </div>
    <div class="form-body">
        <form method="POST" action="{{ route('admin.vaccines.store') }}">
            @csrf
            <div class="add-form-row">
                <div class="form-group">
                    <label>Vaccine Name</label>
                    <div class="input-wrapper">
                        <input type="text" name="vaccine_name" class="form-control" placeholder="e.g. Sputnik V, Pfizer, Moderna" required value="{{ old('vaccine_name') }}">
                        <i class="fa-solid fa-syringe"></i>
                    </div>
                    @error('vaccine_name')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-plus"></i> Add Vaccine
                </button>
            </div>
        </form>
    </div>
</div>

<div class="section-card">
    <div class="section-header">
        <h2><i class="fa-solid fa-list"></i> All Vaccines</h2>
        <span class="badge-count">{{ $vaccines->count() }} Total</span>
    </div>
    
    @if($vaccines->count() > 0)
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vaccine Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vaccines as $index => $vaccine)
                <tr>
                    <td style="color: var(--text-muted); font-weight: 600;">{{ $index + 1 }}</td>
                    <td>
                        <div class="vaccine-cell">
                            <div class="vaccine-avatar"><i class="fa-solid fa-syringe"></i></div>
                            <strong>{{ $vaccine->vaccine_name }}</strong>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge status-{{ strtolower($vaccine->status) }}">
                            {{ $vaccine->status }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.vaccines.toggle', $vaccine->vaccine_id) }}">
                            @csrf
                            @if($vaccine->status === 'Available')
                            <button type="submit" class="btn-action btn-disable">
                                <i class="fa-solid fa-ban"></i> Disable
                            </button>
                            @else
                            <button type="submit" class="btn-action btn-enable">
                                <i class="fa-solid fa-check"></i> Enable
                            </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-box">
        <i class="fa-solid fa-syringe empty-box-icon"></i>
        <h3>No vaccines added yet</h3>
        <p>Use the form above to add new vaccines to the system.</p>
    </div>
    @endif
</div>
@endsection
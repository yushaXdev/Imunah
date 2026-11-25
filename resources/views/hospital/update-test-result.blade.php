@extends('layouts.hospital')

@section('title', 'Update Test Result')
@section('page-title', 'Update COVID Test Result')

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

    .form-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        max-width: 600px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .form-header {
        padding: 24px;
        border-bottom: 1px solid var(--border);
        background: rgba(255, 255, 255, 0.02);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-header i {
        color: var(--accent);
        font-size: 1.2rem;
    }

    .form-header h2 {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-main);
        margin: 0;
    }

    .form-body {
        padding: 32px;
    }

    .patient-info-box {
        background: rgba(13, 148, 136, 0.05);
        border: 1px solid rgba(13, 148, 136, 0.2);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .patient-avatar-lg {
        width: 50px;
        height: 50px;
        background: var(--accent);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .patient-info-text h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .patient-info-text p {
        font-size: 0.85rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .patient-info-text p i {
        color: var(--accent);
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        background: var(--bg-body);
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text-main);
        font-size: 0.95rem;
        outline: none;
        transition: all 0.3s ease;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.15);
    }

    .form-control::placeholder {
        color: #6B7280;
    }

    .form-error {
        color: #EF4444;
        font-size: 0.85rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .action-buttons {
        display: flex;
        gap: 16px;
        margin-top: 32px;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(13, 148, 136, 0.2);
        flex: 1;
    }

    .btn-primary:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4);
    }

    .btn-outline {
        background: transparent;
        color: var(--text-muted);
        border: 1px solid var(--border);
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        flex: 1;
    }

    .btn-outline:hover {
        background: var(--bg-body);
        color: var(--text-main);
    }

    @media (max-width: 576px) {
        .action-buttons {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <h1>Update Test Result</h1>
    <p>Enter the COVID test result and add remarks for this patient.</p>
</div>

<div class="form-card">
    <div class="form-header">
        <i class="fa-solid fa-vial-virus"></i>
        <h2>Patient Test Details</h2>
    </div>
    
    <div class="form-body">
        <div class="patient-info-box">
            <div class="patient-avatar-lg">
                {{ substr($appointment->patient->name ?? 'P', 0, 1) }}
            </div>
            <div class="patient-info-text">
                <h4>{{ $appointment->patient->name ?? 'N/A' }}</h4>
                <p>
                    <i class="fa-regular fa-calendar"></i> 
                    {{ $appointment->appointment_date }} 
                    @if($appointment->appointment_time) 
                        at {{ $appointment->appointment_time }} 
                    @endif
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('hospital.test.result.update', $appointment->appointment_id) }}">
            @csrf
            
            <div class="form-group">
                <label>Test Result <span style="color: #EF4444;">*</span></label>
                <select name="result" class="form-control" required>
                    <option value="" disabled selected>Select the test result</option>
                    <option value="Positive" {{ old('result') == 'Positive' ? 'selected' : '' }}>Positive</option>
                    <option value="Negative" {{ old('result') == 'Negative' ? 'selected' : '' }}>Negative</option>
                </select>
                @error('result')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Test Date <span style="color: #EF4444;">*</span></label>
                <input type="date" name="date" class="form-control" required value="{{ old('date', date('Y-m-d')) }}">
                @error('date')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Remarks / Doctor Suggestions</label>
                <textarea name="remarks" class="form-control" placeholder="Write any additional notes, symptoms, or doctor suggestions here...">{{ old('remarks') }}</textarea>
                @error('remarks')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
            </div>

            <div class="action-buttons">
                <a href="{{ route('hospital.requests') }}" class="btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-paper-plane"></i> Submit Result
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
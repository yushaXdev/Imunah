@extends('layouts.hospital')

@section('title', 'Update Test Result')
@section('page-title', 'Update COVID Test Result')

@section('content')
<div class="page-header">
    <h1>Update Test Result</h1>
    <p>Enter the COVID test result for this patient.</p>
</div>

<div class="card" style="max-width:550px;">
    <div class="card-header">Patient: {{ $appointment->patient->name ?? 'N/A' }}</div>
    <div style="margin-bottom:20px;padding:14px;background:var(--bg-input);border-radius:var(--radius-sm);border:1px solid var(--border);">
        <p style="font-size:0.85rem;color:var(--text-secondary);margin-bottom:4px;">Appointment Date</p>
        <p style="font-weight:600;">{{ $appointment->appointment_date }} @if($appointment->appointment_time) at {{ $appointment->appointment_time }} @endif</p>
    </div>
    <form method="POST" action="{{ route('hospital.test.result.update', $appointment->appointment_id) }}">
        @csrf
        <div class="form-group">
            <label>Test Result</label>
            <select name="result" class="form-control" required>
                <option value="">Select Result</option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
            </select>
            @error('result')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Test Date</label>
            <input type="date" name="date" class="form-control" required value="{{ old('date', date('Y-m-d')) }}">
            @error('date')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Remarks / Doctor Suggestions</label>
            <textarea name="remarks" class="form-control" placeholder="Any remarks or suggestions for the patient...">{{ old('remarks') }}</textarea>
            @error('remarks')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary btn-lg">Submit Result</button>
            <a href="{{ route('hospital.requests') }}" class="btn btn-outline btn-lg">Cancel</a>
        </div>
    </form>
</div>
@endsection
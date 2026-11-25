@extends('layouts.hospital')

@section('title', 'Update Vaccination')
@section('page-title', 'Update Vaccination Status')

@section('content')
<div class="page-header">
    <h1>Update Vaccination Status</h1>
    <p>Record the vaccination details for this patient.</p>
</div>

<div class="card" style="max-width:550px;">
    <div class="card-header">Patient: {{ $appointment->patient->name ?? 'N/A' }}</div>
    <div style="margin-bottom:20px;padding:14px;background:var(--bg-input);border-radius:var(--radius-sm);border:1px solid var(--border);">
        <p style="font-size:0.85rem;color:var(--text-secondary);margin-bottom:4px;">Appointment Date</p>
        <p style="font-weight:600;">{{ $appointment->appointment_date }} @if($appointment->appointment_time) at {{ $appointment->appointment_time }} @endif</p>
    </div>
    <form method="POST" action="{{ route('hospital.vaccination.update', $appointment->appointment_id) }}">
        @csrf
        <div class="form-group">
            <label>Vaccine</label>
            <select name="vaccine_id" class="form-control" required>
                <option value="">Select Vaccine</option>
                @foreach($vaccines as $vaccine)
                <option value="{{ $vaccine->vaccine_id }}" {{ old('vaccine_id') == $vaccine->vaccine_id ? 'selected' : '' }}>{{ $vaccine->vaccine_name }}</option>
                @endforeach
            </select>
            @error('vaccine_id')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Dose</label>
            <select name="dose" class="form-control" required>
                <option value="">Select Dose</option>
                <option value="1st Dose">1st Dose</option>
                <option value="2nd Dose">2nd Dose</option>
                <option value="Booster Dose">Booster Dose</option>
            </select>
            @error('dose')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Vaccination Date</label>
            <input type="date" name="date" class="form-control" required value="{{ old('date', date('Y-m-d')) }}">
            @error('date')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Vaccinated">Vaccinated</option>
                <option value="Scheduled">Scheduled</option>
            </select>
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary btn-lg">Submit Vaccination</button>
            <a href="{{ route('hospital.requests') }}" class="btn btn-outline btn-lg">Cancel</a>
        </div>
    </form>
</div>
@endsection
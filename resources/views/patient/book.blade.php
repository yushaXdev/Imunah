@extends('layouts.patient')

@section('title', 'Book Appointment')
@section('page-title', 'Book Appointment')

@section('content')
<div class="page-header">
    <h1>Book Appointment</h1>
    <p>Schedule your COVID test or vaccination at {{ $hospital->name }}.</p>
</div>

@if($errors->any())
<div style="background:var(--danger-light);border:1px solid var(--danger);border-radius:var(--radius-sm);padding:16px 20px;margin-bottom:24px;">
    <ul style="margin:0;padding:0 0 0 20px;list-style:none;">
        @foreach($errors->all() as $error)
        <li style="color:var(--danger);font-size:0.88rem;margin-bottom:4px;">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card" style="max-width:550px;">
    <div style="margin-bottom:20px;padding:16px;background:var(--bg-input);border-radius:var(--radius-sm);border:1px solid var(--border);">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:6px;">{{ $hospital->name }}</h3>
        <p style="font-size:0.85rem;color:var(--text-secondary);">{{ $hospital->address }}, {{ $hospital->city }}</p>
        <p style="font-size:0.85rem;color:var(--text-muted);margin-top:4px;">{{ $hospital->phone }}</p>
    </div>

    <form method="POST" action="{{ route('patient.book.store', $hospital->hospital_id) }}">
        @csrf
        <div class="form-group">
            <label>Service Type</label>
            <select name="service_type" id="service_type" class="form-control" required>
                <option value="">Select Service</option>
                <option value="Covid Test" {{ old('service_type') == 'Covid Test' ? 'selected' : '' }}>COVID Test</option>
                <option value="Vaccination" {{ old('service_type') == 'Vaccination' ? 'selected' : '' }}>Vaccination</option>
            </select>
            @error('service_type')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group" id="vaccine_group" style="display:none;">
            <label>Select Vaccine</label>
            <select name="vaccine_id" class="form-control" id="vaccine_select">
                <option value="">Select Vaccine</option>
                @foreach($vaccines as $vaccine)
                <option value="{{ $vaccine->vaccine_id }}" {{ old('vaccine_id') == $vaccine->vaccine_id ? 'selected' : '' }}>{{ $vaccine->vaccine_name }}</option>
                @endforeach
            </select>
            @error('vaccine_id')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Preferred Date</label>
            <input type="date" name="appointment_date" class="form-control" required value="{{ old('appointment_date') }}">
            @error('appointment_date')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary btn-lg">Book Now</button>
            <a href="{{ route('patient.search') }}" class="btn btn-outline btn-lg">Cancel</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
var serviceSelect = document.getElementById('service_type');
var vaccineGroup = document.getElementById('vaccine_group');
var vaccineSelect = document.getElementById('vaccine_select');

function toggleVaccine() {
    if (serviceSelect.value === 'Vaccination') {
        vaccineGroup.style.display = 'block';
        vaccineSelect.setAttribute('required', 'required');
    } else {
        vaccineGroup.style.display = 'none';
        vaccineSelect.removeAttribute('required');
        vaccineSelect.value = '';
    }
}

toggleVaccine();
serviceSelect.addEventListener('change', toggleVaccine);

var dateInput = document.querySelector('input[type="date"]');
var today = new Date();
dateInput.min = today.toISOString().split('T')[0];
</script>
@endpush
@endsection
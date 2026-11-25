@extends('layouts.patient')

@section('title', 'My Results')
@section('page-title', 'My Results')

@section('content')
<div class="page-header">
    <h1>My Results</h1>
    <p>View your COVID test results and vaccination certificates.</p>
</div>

<!-- Test Results -->
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">COVID Test Results</div>
    @if($testResults->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
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
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $tr->hospital->name ?? 'N/A' }}</strong></td>
                    <td><span class="badge badge-{{ strtolower($tr->result) }}">{{ $tr->result }}</span></td>
                    <td>{{ $tr->date }}</td>
                    <td>{{ $tr->remarks ?? 'No remarks' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state" style="padding:30px;">
        <h3>No test results yet</h3>
        <p>Your COVID test results will appear here after the hospital updates them.</p>
    </div>
    @endif
</div>

<!-- Vaccination Status -->
<div class="card">
    <div class="card-header">Vaccination Certificates</div>
    @if($vaccinations->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
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
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $vs->hospital->name ?? 'N/A' }}</strong></td>
                    <td>{{ $vs->vaccine->vaccine_name ?? 'N/A' }}</td>
                    <td>{{ $vs->dose }}</td>
                    <td>{{ $vs->date }}</td>
                    <td><span class="badge badge-{{ strtolower($vs->status) }}">{{ $vs->status }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state" style="padding:30px;">
        <h3>No vaccination records yet</h3>
        <p>Your vaccination details will appear here after the hospital updates them.</p>
    </div>
    @endif
</div>
@endsection
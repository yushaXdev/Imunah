@extends('layouts.admin')

@section('title', 'Patients')
@section('page-title', 'Patient Management')

@section('content')
<div class="page-header">
    <h1>Patients</h1>
    <p>View all registered patients.</p>
</div>

<div class="card">
    <div class="card-header">All Patients ({{ $patients->count() }})</div>
    @if($patients->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $index => $patient)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $patient->name }}</strong></td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->city }}</td>
                    <td>{{ Str::limit($patient->address, 40) }}</td>
                    <td>{{ $patient->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3>No patients registered</h3>
        <p>Patients will appear here once they create accounts.</p>
    </div>
    @endif
</div>
@endsection
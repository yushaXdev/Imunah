@extends('layouts.admin')

@section('title', 'Hospitals')
@section('page-title', 'Hospital Management')

@section('content')
<div class="page-header">
    <h1>Hospitals</h1>
    <p>Manage hospital registrations and approvals.</p>
</div>

<div class="card">
    <div class="card-header">All Hospitals ({{ $hospitals->count() }})</div>
    @if($hospitals->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hospital Name</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hospitals as $index => $hospital)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $hospital->name }}</strong></td>
                    <td>{{ $hospital->city }}</td>
                    <td>{{ $hospital->phone }}</td>
                    <td>{{ $hospital->email }}</td>
                   <td>{{ $hospital->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                    <td><span class="badge badge-{{ strtolower($hospital->status) }}">{{ $hospital->status }}</span></td>
                    <td>
                        @if($hospital->status === 'Pending')
                        <form method="POST" action="{{ route('admin.approve.hospital', $hospital->hospital_id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve this hospital?')">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.reject.hospital', $hospital->hospital_id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject this hospital?')">Reject</button>
                        </form>
                        @else
                        <span style="color:var(--text-muted);font-size:0.85rem;">No actions</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        </div>
        <h3>No hospitals registered</h3>
        <p>Hospitals will appear here once they register on the platform.</p>
    </div>
    @endif
</div>
@endsection
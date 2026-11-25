@extends('layouts.admin')

@section('title', 'Vaccines')
@section('page-title', 'Vaccine Management')

@section('content')
<div class="page-header">
    <h1>Vaccines</h1>
    <p>Add and manage available vaccines.</p>
</div>

<!-- Add Vaccine Form -->
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">Add New Vaccine</div>
    <form method="POST" action="{{ route('admin.vaccines.store') }}">
        @csrf
        <div style="display:flex;gap:12px;align-items:flex-end;">
            <div class="form-group" style="flex:1;margin-bottom:0;">
                <label>Vaccine Name</label>
                <input type="text" name="vaccine_name" class="form-control" placeholder="e.g. Sputnik V" required value="{{ old('vaccine_name') }}">
                @error('vaccine_name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Vaccine</button>
        </div>
    </form>
</div>

<!-- Vaccine List -->
<div class="card">
    <div class="card-header">All Vaccines ({{ $vaccines->count() }})</div>
    @if($vaccines->count() > 0)
    <div class="table-wrapper">
        <table class="data-table">
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
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $vaccine->vaccine_name }}</strong></td>
                    <td><span class="badge badge-{{ strtolower($vaccine->status) }}">{{ $vaccine->status }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.vaccines.toggle', $vaccine->vaccine_id) }}">
                            @csrf
                            @if($vaccine->status === 'Available')
                            <button type="submit" class="btn btn-danger btn-sm">Disable</button>
                            @else
                            <button type="submit" class="btn btn-success btn-sm">Enable</button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <h3>No vaccines added</h3>
        <p>Use the form above to add vaccines.</p>
    </div>
    @endif
</div>
@endsection

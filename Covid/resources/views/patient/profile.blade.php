@extends('layouts.patient')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="page-header">
    <h1>My Profile</h1>
    <p>Update your personal information.</p>
</div>

<div class="card" style="max-width:550px;">
    <form method="POST" action="{{ route('patient.profile.update') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
            @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Email (cannot change)</label>
            <input type="email" class="form-control" value="{{ $patient->email }}" disabled style="opacity:0.6;">
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" class="form-control" value="{{ $patient->phone }}" required>
            @error('phone')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ $patient->city }}" required>
            @error('city')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control" required>{{ $patient->address }}</textarea>
            @error('address')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Update Profile</button>
    </form>
</div>
@endsection
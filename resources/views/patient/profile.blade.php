@extends('layouts.patient')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@push('styles')
<style>
    .page-header {
        margin-bottom: 32px;
    }
    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }
    .page-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .profile-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 32px;
        max-width: 700px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border);
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-hover));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(13, 148, 136, 0.3);
    }

    .profile-header-info h2 {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .profile-header-info p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 4px;
    }

    .form-group.full-width {
        grid-column: span 2;
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

    textarea.form-control {
        padding-top: 14px;
        resize: vertical;
        min-height: 100px;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.15);
    }

    .input-wrapper:focus-within i {
        color: var(--accent);
    }

    .form-control:disabled {
        background: rgba(255, 255, 255, 0.03);
        color: var(--text-muted);
        cursor: not-allowed;
        border-style: dashed;
    }

    .form-error {
        color: #EF4444;
        font-size: 0.85rem;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-submit {
        width: 100%;
        background: var(--accent);
        color: #fff;
        border: none;
        padding: 16px;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 24px;
        box-shadow: 0 4px 15px rgba(13, 148, 136, 0.2);
    }

    .btn-submit:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4);
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-group.full-width {
            grid-column: span 1;
        }
        .profile-card {
            padding: 24px;
        }
        .profile-header {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>My Profile</h1>
    <p>Update your personal information and contact details.</p>
</div>

<div class="profile-card">
    <div class="profile-header">
        <div class="profile-avatar">
            {{ substr($patient->name ?? 'P', 0, 1) }}
        </div>
        <div class="profile-header-info">
            <h2>{{ $patient->name }}</h2>
            <p>{{ $patient->email }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('patient.profile.update') }}">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="form-group full-width">
                <label>Full Name</label>
                <div class="input-wrapper">
                    <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required placeholder="Enter your full name">
                    <i class="fa-regular fa-user"></i>
                </div>
                @error('name')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Email Address (Read Only)</label>
                <div class="input-wrapper">
                    <input type="email" class="form-control" value="{{ $patient->email }}" disabled>
                    <i class="fa-solid fa-lock"></i>
                </div>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <div class="input-wrapper">
                    <input type="text" name="phone" class="form-control" value="{{ $patient->phone }}" required placeholder="+92 300 1234567">
                    <i class="fa-solid fa-phone"></i>
                </div>
                @error('phone')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>City</label>
                <div class="input-wrapper">
                    <input type="text" name="city" class="form-control" value="{{ $patient->city }}" required placeholder="e.g. Lahore">
                    <i class="fa-solid fa-city"></i>
                </div>
                @error('city')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
            </div>

            <div class="form-group full-width">
                <label>Full Address</label>
                <div class="input-wrapper">
                    <textarea name="address" class="form-control" required placeholder="Enter your complete address">{{ $patient->address }}</textarea>
                    <i class="fa-solid fa-location-dot" style="top: 16px;"></i>
                </div>
                @error('address')<div class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</div>@enderror
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>
    </form>
</div>
@endsection
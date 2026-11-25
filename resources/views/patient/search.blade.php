@extends('layouts.patient')

@section('title', 'Search Hospital')
@section('page-title', 'Search Hospital')

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

    .search-container {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 32px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .search-grid {
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        gap: 20px;
        align-items: end;
    }

    .search-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .search-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .search-control {
        width: 100%;
        background: var(--bg-body);
        border: 1px solid var(--border);
        color: var(--text-main);
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s ease;
    }

    .search-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
    }

    .search-actions {
        display: flex;
        gap: 12px;
    }

    .btn-search {
        background: var(--accent);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .btn-search:hover {
        background: var(--accent-hover);
    }

    .btn-clear {
        background: transparent;
        color: var(--text-muted);
        border: 1px solid var(--border);
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .btn-clear:hover {
        background: var(--bg-body);
        color: var(--text-main);
    }

    .hospital-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
    }

    .hospital-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .hospital-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
        box-shadow: 0 12px 30px rgba(0,0,0,0.2);
    }

    .hospital-title-row {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 20px;
    }

    .hospital-icon-box {
        width: 48px;
        height: 48px;
        background: rgba(13, 148, 136, 0.1);
        color: var(--accent);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .hospital-title-row h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .hospital-title-row .city {
        font-size: 0.85rem;
        color: var(--accent);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .hospital-details {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 24px;
        flex: 1;
    }

    .detail-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.9rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .detail-row i {
        color: var(--text-muted);
        margin-top: 4px;
        width: 16px;
        text-align: center;
    }

    .btn-book {
        width: 100%;
        background: var(--bg-body);
        color: var(--text-main);
        border: 1px solid var(--border);
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .hospital-card:hover .btn-book {
        background: var(--accent);
        color: #fff;
        border-color: var(--accent);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--bg-card);
        border: 1px dashed var(--border);
        border-radius: 16px;
    }

    .empty-icon {
        font-size: 3rem;
        color: var(--text-muted);
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .empty-state p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .search-grid {
            grid-template-columns: 1fr;
        }
        .search-actions {
            flex-direction: column;
        }
        .btn-search, .btn-clear {
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>Find Hospitals</h1>
    <p>Search for approved hospitals near you and book your appointment.</p>
</div>

<div class="search-container">
    <form method="GET" action="{{ route('patient.search') }}">
        <div class="search-grid">
            <div class="search-group">
                <label>City</label>
                <input type="text" name="city" class="search-control" placeholder="e.g. Lahore" value="{{ $city ?? '' }}">
            </div>
            <div class="search-group">
                <label>Hospital Name</label>
                <input type="text" name="name" class="search-control" placeholder="e.g. City Hospital" value="{{ $name ?? '' }}">
            </div>
            <div class="search-actions">
                <button type="submit" class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
                <a href="{{ route('patient.search') }}" class="btn-clear">Clear</a>
            </div>
        </div>
    </form>
</div>

@if($hospitals->count() > 0)
<div class="hospital-grid">
    @foreach($hospitals as $hospital)
    <div class="hospital-card">
        <div class="hospital-title-row">
            <div class="hospital-icon-box">
                <i class="fa-solid fa-hospital"></i>
            </div>
            <div>
                <h3>{{ $hospital->name }}</h3>
                <div class="city">
                    <i class="fa-solid fa-location-dot"></i> {{ $hospital->city }}
                </div>
            </div>
        </div>
        
        <div class="hospital-details">
            <div class="detail-row">
                <i class="fa-solid fa-map"></i>
                <span>{{ Str::limit($hospital->address, 70) }}</span>
            </div>
            <div class="detail-row">
                <i class="fa-solid fa-phone"></i>
                <span>{{ $hospital->phone }}</span>
            </div>
        </div>

        <a href="{{ route('patient.book.form', $hospital->hospital_id) }}" class="btn-book">
            Book Appointment <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
    @endforeach
</div>
@else
<div class="empty-state">
    <div class="empty-icon">
        <i class="fa-solid fa-hospital-user"></i>
    </div>
    <h3>No hospitals found</h3>
    <p>Try searching with a different city or hospital name.</p>
</div>
@endif
@endsection
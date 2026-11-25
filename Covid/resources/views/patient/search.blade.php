@extends('layouts.patient')

@section('title', 'Search Hospital')
@section('page-title', 'Search Hospital')

@section('content')
<div class="page-header">
    <h1>Find Hospitals</h1>
    <p>Search for approved hospitals near you.</p>
</div>

<!-- Search Form -->
<div class="card" style="margin-bottom:24px;">
    <form method="GET" action="{{ route('patient.search') }}">
        <div style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">
            <div class="form-group" style="flex:1;min-width:200px;margin-bottom:0;">
                <label>City</label>
                <input type="text" name="city" class="form-control" placeholder="e.g. Lahore" value="{{ $city ?? '' }}">
            </div>
            <div class="form-group" style="flex:1;min-width:200px;margin-bottom:0;">
                <label>Hospital Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. City Hospital" value="{{ $name ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Search
            </button>
            <a href="{{ route('patient.search') }}" class="btn btn-outline">Clear</a>
        </div>
    </form>
</div>

<!-- Results -->
@if($hospitals->count() > 0)
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px;">
    @foreach($hospitals as $hospital)
    <div class="card" style="display:flex;flex-direction:column;gap:12px;">
        <div>
            <h3 style="font-size:1.15rem;font-weight:700;margin-bottom:4px;">{{ $hospital->name }}</h3>
            <p style="font-size:0.85rem;color:var(--text-secondary);">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;margin-right:4px;"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $hospital->city }}
            </p>
            <p style="font-size:0.85rem;color:var(--text-muted);margin-top:4px;">{{ Str::limit($hospital->address, 60) }}</p>
        </div>
        <div style="display:flex;gap:8px;font-size:0.82rem;color:var(--text-secondary);">
            <span>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;margin-right:3px;"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                {{ $hospital->phone }}
            </span>
        </div>
        <div style="display:flex;gap:8px;margin-top:auto;">
            <a href="{{ route('patient.book.form', $hospital->hospital_id) }}" class="btn btn-primary btn-sm">Book COVID Test</a>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card">
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <h3>No hospitals found</h3>
        <p>Try searching with a different city or hospital name.</p>
    </div>
</div>
@endif
@endsection
@extends('layouts.admin.dashboard')

@section('title', $title)
@section('page-title', $title)

@section('content')
<div class="placeholder-page animate-fadeInUp">
    <div class="placeholder-icon">
        <i class="bi {{ $icon }}"></i>
    </div>
    <h1 class="placeholder-title">{{ $title }}</h1>
    <p class="placeholder-desc">This section is under development. Full functionality will be available soon.</p>
    <a href="{{ route('admin.dashboard') }}" class="btn-primary-solid">
        <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
    </a>
</div>
@endsection

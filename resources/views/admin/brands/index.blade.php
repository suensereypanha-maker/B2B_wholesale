@extends('layouts.admin.dashboard')

@section('title', 'Brand Management')
@section('page-title', 'Brands')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div class="flash-alert flash-success animate-fadeInUp" id="flashSuccess">
    <i class="bi bi-check-circle-fill"></i>
    <span>{{ session('success') }}</span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
</div>
@endif
@if(session('error'))
<div class="flash-alert flash-error animate-fadeInUp" id="flashError">
    <i class="bi bi-exclamation-circle-fill"></i>
    <span>{{ session('error') }}</span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
</div>
@endif

{{-- Page Header --}}
<div class="page-header animate-fadeInUp">
    <div class="page-header-left">
        <div class="page-header-icon" style="background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); color: #fff;">
            <i class="bi bi-award-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">Brand Directory</h1>
            <p class="page-header-subtitle">Manage official hardware manufacturers, brand logos, featured status, and website links.</p>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.brands.create') }}" class="btn-primary-solid ripple-btn" id="btn-create-brand">
            <i class="bi bi-plus-lg me-2"></i> Add New Brand
        </a>
    </div>
</div>

{{-- Summary Stats Cards --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">
    
    {{-- Total Brands --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-award-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['all'] }}</div>
            <div class="roles-stat-label">Total Brands</div>
        </div>
    </div>

    {{-- Active Brands --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['active'] }}</div>
            <div class="roles-stat-label">Active Brands</div>
        </div>
    </div>

    {{-- Featured Brands --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-star-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['featured'] }}</div>
            <div class="roles-stat-label">Featured Brands</div>
        </div>
    </div>

    {{-- Inactive Brands --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--danger-light);color:var(--danger)">
            <i class="bi bi-eye-slash-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['inactive'] }}</div>
            <div class="roles-stat-label">Inactive Brands</div>
        </div>
    </div>

</div>

{{-- Main Panel --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s; margin-top: 24px;">
    
    {{-- Filter Header --}}
    <div class="panel-header" style="flex-wrap: wrap; gap: 16px;">
        <div class="matrix-module-filter" style="border: 1px solid var(--border); padding: 4px; display: inline-flex; border-radius: var(--radius-full);">
            <a href="{{ route('admin.brands.index', ['filter' => 'all', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'all' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               All <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['all'] }}</span>
            </a>
            <a href="{{ route('admin.brands.index', ['filter' => 'active', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'active' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Active <span class="badge ms-1" style="background: var(--emerald-light); color: var(--emerald)">{{ $counts['active'] }}</span>
            </a>
            <a href="{{ route('admin.brands.index', ['filter' => 'featured', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'featured' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Featured <span class="badge ms-1" style="background: var(--warning-light); color: var(--amber)">{{ $counts['featured'] }}</span>
            </a>
            <a href="{{ route('admin.brands.index', ['filter' => 'inactive', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'inactive' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Inactive <span class="badge ms-1" style="background: var(--danger-light); color: var(--danger)">{{ $counts['inactive'] }}</span>
            </a>
        </div>

        {{-- Search Controls --}}
        <form action="{{ route('admin.brands.index') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap ms-auto">
            <input type="hidden" name="filter" value="{{ $filter }}">

            <div class="position-relative">
                <input type="search" name="search" class="search-input search-input-sm" 
                       placeholder="Search brands or website..." value="{{ $search }}" 
                       style="min-width: 240px; padding-left: 36px; height: 38px;">
            </div>

            @if($search || $filter !== 'all')
                <a href="{{ route('admin.brands.index') }}" class="btn-outline-secondary-sm" title="Clear Filters" style="height: 38px; display: inline-flex; align-items: center;">
                    <i class="bi bi-x-circle me-1"></i> Clear
                </a>
            @endif
        </form>
    </div>

    {{-- Data Table --}}
    <div class="table-responsive" style="margin-top: 16px;">
        <table class="table align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">Sort</th>
                    <th>Brand</th>
                    <th>Official Website</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                <tr id="brand-row-{{ $brand->id }}">
                    <td class="text-center font-monospace text-muted">
                        <span class="badge bg-light text-dark border">{{ $brand->sort_order }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="brand-logo-box me-3 shadow-sm" style="width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; background: #fff; border: 1px solid var(--border); color: var(--primary); font-weight: 700;">
                                @if($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" style="width: 100%; height: 100%; object-fit: contain; border-radius: 9px; padding: 4px;">
                                @else
                                    {{ strtoupper(substr($brand->name, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold text-dark fs-6 d-flex align-items-center gap-2">
                                    {{ $brand->name }}
                                </div>
                                <div class="text-muted small">
                                    <code>/brand/{{ $brand->slug }}</code>
                                    @if($brand->description)
                                        <span class="ms-2 text-truncate d-inline-block" style="max-width: 300px; vertical-align: bottom;">— {{ $brand->description }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($brand->website)
                            <a href="{{ $brand->website }}" target="_blank" rel="noopener noreferrer" class="text-primary text-decoration-none small d-inline-flex align-items-center gap-1">
                                <i class="bi bi-globe"></i> {{ parse_url($brand->website, PHP_URL_HOST) ?: $brand->website }}
                                <i class="bi bi-box-arrow-up-right fs-7 text-muted ms-0.5"></i>
                            </a>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.brands.toggle-featured', $brand) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm border-0 bg-transparent p-0" title="Click to toggle featured status">
                                @if($brand->is_featured)
                                    <span class="badge bg-warning-subtle text-amber border border-warning-subtle px-2.5 py-1" style="border-radius: 20px; font-weight: 600;">
                                        <i class="bi bi-star-fill text-warning me-1"></i> Featured
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border px-2.5 py-1" style="border-radius: 20px; font-weight: 500;">
                                        Standard
                                    </span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.brands.toggle-status', $brand) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm border-0 bg-transparent p-0" title="Click to toggle status">
                                @if($brand->is_active)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1" style="border-radius: 20px; font-weight: 500;">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1" style="border-radius: 20px; font-weight: 500;">
                                        <i class="bi bi-slash-circle me-1"></i> Inactive
                                    </span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1 align-items-center">
                            <a href="{{ route('admin.brands.edit', $brand) }}" 
                               class="btn btn-sm btn-light text-dark border" 
                               title="Edit Brand" style="padding: 4px 8px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" 
                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete brand \'{{ $brand->name }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border" 
                                        title="Delete Brand" style="padding: 4px 8px;">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-award display-4 d-block mb-3 opacity-50"></i>
                            <h5>No brands found</h5>
                            <p class="small text-secondary mb-3">Try adjusting your search or filter options, or add a new brand.</p>
                            <a href="{{ route('admin.brands.create') }}" class="btn-primary-solid btn-sm">
                                <i class="bi bi-plus-lg me-1"></i> Add Brand
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

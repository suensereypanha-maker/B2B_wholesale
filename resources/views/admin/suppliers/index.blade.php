@extends('layouts.admin.dashboard')

@section('title', 'Supplier Directory & Approvals')
@section('page-title', 'Suppliers')

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
        <div class="page-header-icon" style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%); color: #fff;">
            <i class="bi bi-truck-front-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">Supplier Directory & Approvals</h1>
            <p class="page-header-subtitle">Manage wholesale vendors, linked portal user accounts (Role ID 7), and supplier approval status.</p>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.suppliers.create') }}" class="btn-primary-solid ripple-btn" id="btn-create-supplier">
            <i class="bi bi-plus-lg me-2"></i> Add New Supplier
        </a>
    </div>
</div>

{{-- Summary Stats Cards --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">
    
    {{-- Total Suppliers --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-truck-front-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['all'] }}</div>
            <div class="roles-stat-label">Total Suppliers</div>
        </div>
    </div>

    {{-- Approved Suppliers --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['approved'] }}</div>
            <div class="roles-stat-label">Approved & Active</div>
        </div>
    </div>

    {{-- Pending Approval --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-clock-history"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['pending'] }}</div>
            <div class="roles-stat-label">Pending Approval</div>
        </div>
    </div>

</div>

{{-- Main Panel --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s; margin-top: 24px;">
    
    {{-- Filter Header --}}
    <div class="panel-header" style="flex-wrap: wrap; gap: 16px;">
        <div class="matrix-module-filter" style="border: 1px solid var(--border); padding: 4px; display: inline-flex; border-radius: var(--radius-full);">
            <a href="{{ route('admin.suppliers.index', ['filter' => 'all', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'all' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               All <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['all'] }}</span>
            </a>
            <a href="{{ route('admin.suppliers.index', ['filter' => 'approved', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'approved' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Approved <span class="badge ms-1" style="background: var(--emerald-light); color: var(--emerald)">{{ $counts['approved'] }}</span>
            </a>
            <a href="{{ route('admin.suppliers.index', ['filter' => 'pending', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'pending' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Pending Approval <span class="badge ms-1" style="background: var(--warning-light); color: var(--amber)">{{ $counts['pending'] }}</span>
            </a>
        </div>

        {{-- Search Controls --}}
        <form action="{{ route('admin.suppliers.index') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap ms-auto">
            <input type="hidden" name="filter" value="{{ $filter }}">

            <div class="position-relative">
                <input type="search" name="search" class="search-input search-input-sm" 
                       placeholder="Search company, contact, email..." value="{{ $search }}" 
                       style="min-width: 240px; padding-left: 36px; height: 38px;">
            </div>

            @if($search || $filter !== 'all')
                <a href="{{ route('admin.suppliers.index') }}" class="btn-outline-secondary-sm" title="Clear Filters" style="height: 38px; display: inline-flex; align-items: center;">
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
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Portal User Account (Role ID 7)</th>
                    <th>Linked Products</th>
                    <th>Approval Status</th>
                    <th class="text-end" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr id="supplier-row-{{ $supplier->id }}">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="supplier-icon-box me-3 shadow-sm" style="width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; background: rgba(219,39,119,0.08); border: 1px solid var(--border); color: #db2777; font-weight: 700;">
                                <i class="bi bi-building"></i>
                            </div>
                            <div>
                                <div class="fw-semibold text-dark fs-6">{{ $supplier->company_name }}</div>
                                <div class="text-muted small">
                                    @if($supplier->address)
                                        <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($supplier->address, 35) }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium text-dark small">{{ $supplier->contact_name ?: '—' }}</div>
                            <div class="text-muted small"><i class="bi bi-telephone me-1"></i>{{ $supplier->phone ?: '—' }}</div>
                        </div>
                    </td>
                    <td>
                        @if($supplier->user)
                            <div>
                                <div class="fw-semibold text-primary small d-flex align-items-center gap-1">
                                    <i class="bi bi-person-badge"></i> {{ $supplier->user->email }}
                                </div>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-0.5" style="font-size: 0.7rem;">
                                    Role ID: {{ $supplier->user->role_id }} (Supplier)
                                </span>
                            </div>
                        @else
                            <span class="badge bg-light text-muted border">No Portal User</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.index', ['supplier_id' => $supplier->id]) }}" class="badge bg-light text-dark border px-2.5 py-1 text-decoration-none hover-shadow">
                            <i class="bi bi-box-seam text-primary me-1"></i> {{ $supplier->products->count() }} Products
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.suppliers.toggle-status', $supplier) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm border-0 bg-transparent p-0" title="Click to toggle approval status">
                                @if($supplier->is_active)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1" style="border-radius: 20px; font-weight: 500;">
                                        <i class="bi bi-check-circle-fill me-1"></i> Approved & Active
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-amber border border-warning-subtle px-2.5 py-1" style="border-radius: 20px; font-weight: 500;">
                                        <i class="bi bi-clock-history me-1"></i> Pending Approval
                                    </span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1 align-items-center">
                            <form action="{{ route('admin.suppliers.toggle-status', $supplier) }}" method="POST" class="d-inline">
                                @csrf
                                @if(!$supplier->is_active)
                                    <button type="submit" class="btn btn-sm btn-success text-white fw-semibold" title="Approve Supplier" style="padding: 4px 10px; font-size: 0.75rem;">
                                        <i class="bi bi-check-lg me-1"></i> Approve
                                    </button>
                                @endif
                            </form>

                            <a href="{{ route('admin.suppliers.edit', $supplier) }}" 
                               class="btn btn-sm btn-light text-dark border" 
                               title="Edit Supplier" style="padding: 4px 8px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST" 
                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete supplier \'{{ $supplier->company_name }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border" 
                                        title="Delete Supplier" style="padding: 4px 8px;">
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
                            <i class="bi bi-truck-front display-4 d-block mb-3 opacity-50"></i>
                            <h5>No suppliers found</h5>
                            <p class="small text-secondary mb-3">Try adjusting your search or filter options.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

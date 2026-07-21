@extends('layouts.admin.dashboard')

@section('title', 'My Supplier Products & Inventory')
@section('page-title', 'My Products')

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
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">My Supply Inventory</h1>
            <p class="page-header-subtitle">
                Vendor: <strong>{{ $supplier?->company_name ?? auth()->user()->name }}</strong> — Manage your supplied hardware items, stock counts, and wholesale pricing.
            </p>
        </div>
    </div>
</div>

{{-- Summary Stats Cards --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">
    
    {{-- Total Products --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['all'] }}</div>
            <div class="roles-stat-label">My Listed Items</div>
        </div>
    </div>

    {{-- In Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['in_stock'] }}</div>
            <div class="roles-stat-label">Healthy Stock (>10)</div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['low_stock'] }}</div>
            <div class="roles-stat-label">Low Stock Alert (≤10)</div>
        </div>
    </div>

    {{-- Out of Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--danger-light);color:var(--danger)">
            <i class="bi bi-slash-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['out_of_stock'] }}</div>
            <div class="roles-stat-label">Out of Stock</div>
        </div>
    </div>

</div>

{{-- Main Panel --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s; margin-top: 24px;">
    
    {{-- Filter Header --}}
    <div class="panel-header" style="flex-wrap: wrap; gap: 16px;">
        <div class="matrix-module-filter" style="border: 1px solid var(--border); padding: 4px; display: inline-flex; border-radius: var(--radius-full);">
            <a href="{{ route('supplier.products', ['filter' => 'all', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'all' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               All Items <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['all'] }}</span>
            </a>
            <a href="{{ route('supplier.products', ['filter' => 'in_stock', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'in_stock' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Healthy <span class="badge ms-1" style="background: var(--emerald-light); color: var(--emerald)">{{ $counts['in_stock'] }}</span>
            </a>
            <a href="{{ route('supplier.products', ['filter' => 'low_stock', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'low_stock' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Low Stock <span class="badge ms-1" style="background: var(--warning-light); color: var(--amber)">{{ $counts['low_stock'] }}</span>
            </a>
            <a href="{{ route('supplier.products', ['filter' => 'out_of_stock', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'out_of_stock' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Out of Stock <span class="badge ms-1" style="background: var(--danger-light); color: var(--danger)">{{ $counts['out_of_stock'] }}</span>
            </a>
        </div>

        {{-- Search Controls --}}
        <form action="{{ route('supplier.products') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap ms-auto">
            <input type="hidden" name="filter" value="{{ $filter }}">

            <div class="position-relative">
                <input type="search" name="search" class="search-input search-input-sm" 
                       placeholder="Search product, SKU..." value="{{ $search }}" 
                       style="min-width: 220px; padding-left: 36px; height: 38px;">
            </div>

            @if($search || $filter !== 'all')
                <a href="{{ route('supplier.products') }}" class="btn-outline-secondary-sm" title="Clear Filters" style="height: 38px; display: inline-flex; align-items: center;">
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
                    <th>Product & SKU</th>
                    <th>Category & Brand</th>
                    <th>Wholesale Price ($)</th>
                    <th>MOQ</th>
                    <th>Current Inventory Stock</th>
                    <th>Stock Alert</th>
                    <th class="text-end" style="width: 140px;">Quick Stock Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr id="product-row-{{ $product->id }}">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-img-box me-3 shadow-sm" style="width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; background: rgba(37,99,235,0.08); border: 1px solid var(--border); color: var(--primary);">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 9px;">
                                @else
                                    <i class="bi {{ $product->category?->icon ?: 'bi-box-seam' }}"></i>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold text-dark fs-6">{{ $product->name }}</div>
                                <div class="text-muted small"><code>SKU: {{ $product->sku }}</code></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <span class="badge bg-light text-dark border align-self-start">
                                {{ $product->category?->name ?? 'Uncategorized' }}
                            </span>
                            @if($product->brand)
                                <span class="small text-secondary fw-semibold">
                                    <i class="bi bi-award me-1"></i> {{ $product->brand->name }}
                                </span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold text-dark fs-6">${{ number_format($product->wholesale_price, 2) }}</div>
                        <div class="text-muted fs-7">Cost: ${{ number_format($product->cost_price, 2) }}</div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border font-monospace px-2.5 py-1">
                            {{ $product->min_order_qty }} pcs
                        </span>
                    </td>
                    <td>
                        <div class="fw-bold fs-5 text-dark font-monospace">{{ $product->stock_qty }} <span class="fs-7 text-muted font-sans-serif">units</span></div>
                    </td>
                    <td>
                        @if($product->stock_qty > 10)
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1">
                                <i class="bi bi-check-circle-fill me-1"></i> In Stock
                            </span>
                        @elseif($product->stock_qty > 0)
                            <span class="badge bg-warning-subtle text-amber border border-warning-subtle px-2.5 py-1">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> Low Stock
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1">
                                <i class="bi bi-slash-circle-fill me-1"></i> Out of Stock
                            </span>
                        @endif
                    </td>
                    <td class="text-end">
                        {{-- Quick Stock Update Form --}}
                        <form action="{{ route('supplier.products.update-stock', $product) }}" method="POST" class="d-inline-flex align-items-center gap-1">
                            @csrf
                            <input type="number" name="stock_qty" value="{{ $product->stock_qty }}" min="0" class="form-control form-control-sm text-center font-monospace" style="width: 70px;" title="Update Stock Qty">
                            <input type="hidden" name="wholesale_price" value="{{ $product->wholesale_price }}">
                            <button type="submit" class="btn btn-sm btn-primary-solid py-1 px-2" title="Save Stock">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-box-seam display-4 d-block mb-3 opacity-50"></i>
                            <h5>No supply products found</h5>
                            <p class="small text-secondary mb-3">You currently have no products listed under your supplier profile.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
